<?php

require_once "voyage.class.php";

class voyageTable {

  public static function getVoyagesByTrajet($trajet){
        $con = dbconnection::getInstance()->getEntityManager();
            $voyageRepository = $con->getRepository('voyage');
            $Listvoyages  = $voyageRepository->findBy(array('trajet' => $trajet));

            return $Listvoyages;    

}

/**
 * recuperer les places restants 
 */
	public static function updateNbplaces($voyage){
        $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
        $query = $em->prepare("select nbplace from jabaianb.voyage where id =".$voyage.";");
        $bool = $query->execute();
        $res = $query->fetchAll();
        $a = $res[0]["nbplace"];
        if ($a <=0 ){
            return 0;

        }
        $query = $em->prepare("update jabaianb.voyage set nbplace = (nbplace-1) where id =".$voyage." and nbplace>0;");
        $bool = $query->execute();
        return 1;
    }





/**
 * récupération des correspondance 
 */
public static function getCorrespondance($depart,$arrivee){
	$nbrvoyageurs=1;
  $em = dbconnection::getInstance()->getEntityManager()->getConnection() ;
  
   $query = $em->prepare(" select * from main('{$depart}','{$arrivee}',{$nbrvoyageurs}) order by main.num_corres;");
   
   $bool = $query->execute();
   if ($bool == false){
     return NULL;
   }
   $voyages = $query->fetchAll();
   return $voyages; 
 }

 /**
  * récupération d'un voyage par son ID
  */
 public static function getVoyageById($id){
    
  $em = dbconnection::getInstance()->getEntityManager() ;
  $voyageRepository = $em->getRepository('voyage');
  $voyages = $voyageRepository->findOneBy(array('id' => $id));  
  
  
  return $voyages;
}


  /**
	* Recuperer les voyages d'un utilisateurs
	*/
	public static function getVoyagesByUser($id) {
		$em = dbconnection::getInstance()->getEntityManager();
		$voyageRepository = $em->getRepository('voyage');
		$voyages = $voyageRepository->findBy(array('conducteur' => $id));
		return $voyages;
	}
/**
 * ajouter un nouveau voyage 
 */

  public static function nouveauVoyage($depart, $arrivee, $heuredepart, $nbplace, $price, $contraintes, $user){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$voyageRepository = $em->getRepository('voyage');
		$trajet = trajetTable::getTrajet($depart,$arrivee);
		$tarif = $price * $trajet->distance;
		if($trajet && $user && $tarif>0){
			$voyage = new voyage();
			$voyage->trajet = $trajet;
			$voyage->conducteur = $user;
			$voyage->nbplace = $nbplace;
			$voyage->heuredepart = $heuredepart;
			$voyage->tarif = $tarif;
			$voyage->contraintes = trim($contraintes);
			$em->persist($voyage);
			$em->flush();
			return $voyage;
		}
		return null;
	}

}

?>