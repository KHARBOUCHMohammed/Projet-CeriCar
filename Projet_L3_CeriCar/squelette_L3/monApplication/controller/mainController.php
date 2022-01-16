<?php

class mainController
{
    public static function index($request, $context)
        {
            return context::SUCCESS;
        }


    public static function header($request, $context)
        {
            return context::SUCCESS;
        }    


    public static function helloWorld($request,$context)
    {
        $context->mavariable="hello world";

        return context::SUCCESS;
    }

    public static function superTest($request,$context)
    {
        if(!empty($_GET['var1'] && !empty($_GET['var2']))){

        $context->var1=$_GET['var1'];
        $context->var2=$_GET['var2'];
        return context::SUCCESS ;

        }

        else{

        return context::ERROR ;
        }
        
    }


    // ----------------------  étape 2   -----------------------------
/**
 * recuperer l'utilisateur par son id
 */
 
public static function getUserById($request,$context)
{   if(!empty($request["id"]) ) {
            $context->id=$request['id'];    
    
        $context->user=utilisateurTable::getUserById($context->id);

        
            return context::SUCCESS;
            }
}
/**
 * recupérer la resrevation par voyage 
 */
public static function getReservationsByVoyage($request,$context)
    {
        if(!empty($request["id"]) ) {
            $context->id=$request['id'];    
    
        $context->reservations=reservationTable::getReservationsByVoyage($context->id);
        return context::SUCCESS;
    }
    }
    /**
     * recuperer le voyage par un trajet 
     */

    public static function getVoyagesByTrajet($request,$context)
    {
        if(!empty($request["id"]) ) {
            $context->id=$request['id'];
            $context->voyages = voyageTable::getVoyagesByTrajet($context->id); 
            return context::SUCCESS;
            }
    //  $context->voyages=voyageTable::getVoyagesByTrajet(383); //
        //  return context::SUCCESS;
    }

    /**
     * recuperer le trajet par depart et arrivée 
     */

public static function getTrajet($request,$context)
    {  //$context->dep=$request['dep'];
       //$context->arr=$request['arr'];


       if(isset($request['depart']) and isset($request['arrivee'])){
        $context->depart = $request['depart'];
        $context->arrivee = $request['arrivee'];
        $trajet = trajetTable::getTrajet($context->depart, $context->arrivee);
        $context->trajet = $trajet;
        return context::SUCCESS;
    }











      /*  if(!isset($request["depart"]))
        {
            $context->error="Le parametre 'villeDepart' n'a pas été renseign�";
           // return context::ERROR;
        }
        if(!isset($request["arrivee"]))
        {
            $context->error="Le parametre 'villeArrivee' n'a pas été renseign�";
           // return context::ERROR;
        }

        $context->voyages=voyageTable::getVoyagesByTrajet(trajetTable::getTrajet($request["depart"],$request["arrivee"])
        );
            return context::SUCCESS;*/


         //$context->trajet=trajetTable::getTrajet("Dijon","Brest");
            //return context::SUCCESS;


	    //$context->trajet=trajetTable::getTrajet("Paris","Amiens");
            //return context::SUCCESS;
        
        
       /* if(!empty($request["dep"]) && !empty($request["arr"]))
        {
        $context->dep=$request['dep'];
        $context->arr=$request['arr'];
        $context->voyages =trajetTable::getTrajet($context->dep, $context->arr);
        //$context->trj=$trajet->id;
    //  return context::SUCCESS;
        $context->ban ="SUCCESS";
        //echo "hamid";
        }
        else if (empty($request["dep"]) || empty($request["arr"]))  {
           $context->ban ="error";
           
           //return context::ERROR;    
            }
        //return( $context->ban) ;  
        //$context->ban ="SUCCESS";
        
       
        return context::SUCCESS; */
        

    }


    /**
     * recupérer les correspondance 
     */

    public static function ajaxRechercheVoyage($request,$context){
		if($request['depart'] != null && $request['arrivee'] != null){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			if($trajet){
					
					//Recuperer les voyages direct et par correspendance
            $Correspendances = voyageTable::getCorrespondance($request['depart'], $request['arrivee']/*,$request['nbrvoyageurs']*/);

					//Tableau des voyages par correspendance
					$context->voyagesCorrespendance =  new ArrayObject();

					//Tableau des conducteurs
					$context->conducteurs = new ArrayObject();

					//Tableau de voyages
					$context->listvoyages = new ArrayObject();

					//Tableau des heure d'arrivée
					$context->heurearrivee = new ArrayObject();

					for($i=0;$i<count($Correspendances);$i++){

					
							$voyage =voyageTable::getVoyageById($Correspendances[$i]['id']);
							$context->voyagesCorrespendance->append($voyage);
							$context->conducteurs[$voyage->id] = array(utilisateurTable::getUserById($voyage->conducteur->id)); 
							$context->listvoyages[$voyage->id] = array($voyage);
							
							$heure=explode('.',$voyage->trajet->distance/100);
						
							$context->heurearrivee[$voyage->id] = $voyage->heuredepart+$heure[0];
						
					}
					
					
					if($context->voyagesCorrespendance ){
						return context::SUCCESS;
					}
					else{
						$context->ERROR = "Aucun voyage trouvé";
						return context::ERROR;
					}
					
				
				
			}
			else{
			$context->ERROR = "Aucun trajet trouvé";
			return context::ERROR;
			}
		}
		$context->ERROR = "Départ et arrivée non saisis";
		return context::ERROR;
	}







    /*
	public static function trajetByAjax($request, $context)
    {
	
	/*if($_GET["depart"] && $_GET["arrivee"])
	{
			$result = trajetTable::getTrajet($_GET["depart"],$_GET["arrivee"]);
			echo json_encode($result);
			
			return context::NONE;
	}
	*/
     /* 	if(isset($request['depart']) && isset($request['arrivee'])){

			$context->trajet = trajetTable::getTrajet($request['depart'],$request['arrivee']);
			if($context->trajet == true){
                $context->voyages = voyageTable::getVoyagesByTrajet($context->trajet->id);
				if($context->voyages == true){
					$context->retour = "recherche terminée";
				}
				else{
					$context->retour = "pas de voyage pour ce trajet";
				}
			}
			else{
				$context->retour = "trajet n'existe pas";
			}
		}
*/
        
   /* if(!empty($request['depart']) && !empty($request['arrivee']))
    {
        $trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
        if($trajet){

                //Recuperer les voyages direct et par correspendance
                $Correspendances = voyageTable::getCorrespondance($request['depart'], $request['arrivee'],$request['nbrvoyageurs']);

                //Tableau des voyages par correspendance
                $context->voyagesCorrespendance =  new ArrayObject();

                //Tableau des conducteurs
                $context->conducteurs = new ArrayObject();

                //Tableau de voyages
                $context->listvoyages = new ArrayObject();

                //Tableau des heure d'arrivée
                $context->heurearrivee = new ArrayObject();
                for($i=0;$i<count($Correspendances);$i++){

                    if($Correspendances[$i]['correspendance']){

                        $voyage1 = voyageTable::getVoyageById($Correspendances[$i]['id']);
                        $voyage2 = voyageTable::getVoyageById($Correspendances[$i]['correspendancevoyage']);


                        $voyage1->trajet->arrivee = $voyage2->trajet->arrivee;
                        $voyage1->trajet->distance= $voyage1->trajet->distance +$voyage2->trajet->distance;

                        $voyage1->tarif= $voyage1->tarif + $voyage2->tarif;
                        $context->voyagesCorrespendance->append($voyage1);

                        $context->conducteurs[$voyage1->id]= array(utilisateurTable::getUserById($voyage1->conducteur->id),utilisateurTable::getUserById($voyage2->conducteur->id));
                        $context->listvoyages[$voyage1->id] = array($voyage1,$voyage2);

                        $heure=explode('.',$voyage2->trajet->distance/100);

                        $context->heurearrivee[$voyage1->id] = $voyage2->heuredepart+$heure[0];

                        $i++; 


                    }else{
                        $voyage =voyageTable::getVoyageById($Correspendances[$i]['id']);
                        $context->voyagesCorrespendance->append($voyage);
                        $context->conducteurs[$voyage->id] = array(utilisateurTable::getUserById($voyage->conducteur->id)); 
                        $context->listvoyages[$voyage->id] = array($voyage);

                        $heure=explode('.',$voyage->trajet->distance/100);

                        $context->heurearrivee[$voyage->id] = $voyage->heuredepart+$heure[0];
                    }
                }


                if($context->voyagesCorrespendance ){
                    return context::SUCCESS;
                }
                else{
                    $context->ERROR = "Aucun voyage trouvée";
                    return context::ERROR;
                }



        }
        else{
        $context->ERROR = "Aucun trajet trouvée";
        return context::ERROR;
        }
    }
    $context->ERROR = "veulliez saisis depart ou arrvée !";
    return context::ERROR;

*/





/*if(!empty($request["depart"])  )
        {
            $context->error="Le parametre 'villeDepart' n'a pas été renseigné";
            return context::ERROR;
        }
        if(!empty($request["arrivee"]))
        {
            $context->error="Le parametre 'villeArrivee' n'a pas été renseigné";
            return context::ERROR;
        }

        $context->voyages=voyageTable::getVoyagesByTrajet(trajetTable::getTrajet($request["depart"],$request["arrivee"])
        );
            return context::SUCCESS;
	}*/

























/*    public static function getTrajet($request,$context)
    {
        
         //$context->trajet=trajetTable::getTrajet("Paris","Amiens");
            //return context::SUCCESS;
        
        
        if(!empty($request["dep"]) && !empty($request["arr"]))
        {
        $context->dep=$request['dep'];
        $context->arr=$request['arr'];
        $context->trajet=trajetTable::getTrajet($context->dep, $context->arr);
        //$context->trj=$trajet->id;
    //  return context::SUCCESS;
        $context->ban ="SUCCESS";
        //echo "hamid";
        }
        else if (empty($request["dep"]) || empty($request["arr"]))  {
           $context->ban ="error";
           
           //return context::ERROR;    
            }
        //return( $context->ban) ;  
        //$context->ban ="SUCCESS";
        
       
        return context::SUCCESS; 
        

       /* if(!empty($request['dep'] && !empty($request['arr']))){
            $context->dep = $request['dep'];
            $context->arr = $request['arr'];
            $trajet = trajetTable::getTrajet($context->dep,$context->arr);
            
            if($trajet){
                $context->dis = $trajet->distance;
                $context->status = 'success';
            }else
                return context::NONE;
        }else {
            $context->status = 'error';
              }
        return context::SUCCESS;
    }
    
    //public static function getTrajet($request, $context) { // depart=paris&arrivee=Amiens
       // if ($request["dep"] && $request["arr"]) {
        //  $context->dep =$request["dep"] ;
        //  $context->arr = $request["arr"];
        // $context->trajet = trajetTable::getTrajet($request["dep"], $request["arr"]  );
        //  echo $request["dep"] ;
         //   return context::SUCCESS;
       // }
        //return context::ERROR;
       // echo "-----------------------------";
    }
        
    
    */


/*
     public static function Test($request,$context) 
 {

    $context->trajet=trajetTable::getTrajet("Dijon","Brest");
    $context->voyage=voyageTable::getVoyagesByTrajet(383);
    $context->utilisateur=utilisateurTable::getUserById(1);
    $context->reservation=reservationTable::getReservationsByVoyage(1);

    
    return context::SUCCESS;
    
  }*/


  /**
   * faire la recherche d'un voyage 
   */
public static function rechercheVoyages($request,$context)
    {
       /* if(key_exists("depart",$request) && key_exists("arrivee",$request)){
			$trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
			$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);
			if($context->voyages ) return context::SUCCESS;
			return context::ERROR;
		}
		
		return context::SUCCESS;
*/

        mainController::getTrajet($request, $context);
		$voyages = voyageTable::getVoyagesByTrajet($context->trajet);
		foreach( $voyages as $voyage ){
			$voyage->nbPlaceRestant = voyageTable::updateNbplaces($voyage->id);
		}
		$context->voyages = $voyages;
		return context::SUCCESS;
      

    }


    /**
     * pour permettre à l'utilisateur d'authentifier 
     */

    public static function identifier($request,$context)
	{
		if(key_exists("identifiant",$request) && key_exists("password",$request)){


                        $context->identifiant =  $request['identifiant'];

                        $context->password =  $request['password'];

                    $utilisateur = utilisateurTable::getUserByLoginAndPass($context->identifiant, $context->password);

                    if($utilisateur == true){
                        
                        unset($_SESSION["user_id"]);
			        	unset($_SESSION["user_prenom"]);
                        $context->setSessionAttribute('user_id',$utilisateur->id);
                        $context->setSessionAttribute('user_prenom',$utilisateur->prenom);
                        
                        
                        return context::SUCCESS;
                    }
                    else{
                        $context->errorMSG = "Identifiant ou mot de passe est incorrect";
                      
                    }
                }
                return context::SUCCESS;
	}

/**
 * faire inscription des nouveaux utilisateurs 
 */
    public static function inscription($request,$context)
	{
		if(key_exists("nom",$request) && key_exists("prenom",$request) && key_exists("pseudo",$request) && key_exists("pwd1",$request)){
			$context->nom = $request['nom'];
			$context->prenom =  $request['prenom'];
			$context->identifiant =  $request['pseudo'];
			$context->password =  $request['pwd1'];
			if(utilisateurTable::getUserByLogin($request['pseudo'])){
				$context->errorMSG = "Pseudo déjà utilisé";
				//return context::ERROR;
			}
			else{																						
				$user = utilisateurTable::ajoutUtilisateur($context->nom, $context->prenom, $context->identifiant, $context->password);
				$context->success = true;																 		
			}
		} 
		return context::SUCCESS;

	}

    /**
     * recupérer les reservation d'un voyageurs
     */
	public static function mesReservations($request,$context) {

		$utilisateur = utilisateurTable::getUserById($_SESSION["user_id"]);
		$context->allReservations = reservationTable::getReservationsByVoyageur($utilisateur->id);
		$voyageData = array();
		foreach($context->allReservations  as $reservation){
			
			array_push($voyageData, new voyageData($reservation->voyage));
		}
		$context->voyages = $voyageData;
		return context::SUCCESS;

	}

/**
 * deconnexion 
 */
    public static function logout($request,$context)
	{
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_prenom"]);
		header('location: monApplication.php'); 

    }

    /**
	* Retourner les voyages d'un utilisateur
	*/
	public static function mesVoyages($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		else return context::ERROR;
		$voyagesData = array();
		$voyages = voyageTable::getVoyagesByUser($context->user->id);
		foreach($voyages as $voyage){
			array_push($voyagesData, new voyageData($voyage));
		}
		$context->voyagesData = $voyagesData;
		return context::SUCCESS;
	}


    


    /**
	* Afficher la vue d'ajout d'un nouveau voyage
	*/

	public static function newVoyage($request,$context)
	{
		if($context->getSessionAttribute("user_id")!=NULL) {
			$context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
		}
		else 
			return context::ERROR;
		$context->villes = trajetTable::getVilles();
		return context::SUCCESS;
	}





	/**
	* Ajouter une nouvelle réservation
	*/
	public static function reserverVoyage($request,$context){
		
       
        if($context->getSessionAttribute('user_id')){
       $query = voyageTable::updateNbplaces($request['voyage'][0]);
       if ($query  == false){
           return context::ERROR;
       }
       else{
           $res = reservationTable::addReservation(voyageTable::getVoyageById($request['voyage'][0]), utilisateurTable::getUserById($context->getSessionAttribute('user_id')));
           return context::SUCCESS;
       }
   }
   else{
       return context::ERROR;
   }
		
}

/**
 * Ajouter un nouveau trajet 
 */
public static function newVoyagePost($request, $context){
    $context->success = "false";
    if($context->getSessionAttribute("user_id")!=NULL) $context->user = utilisateurTable::getUserById($context->getSessionAttribute("user_id"));
    else {
        $context->error = "Not connected";
        return context::ERROR;
    }
    
    if(key_exists("depart",$request) && key_exists("tarifparkm",$request) && key_exists("arrivee",$request) && key_exists("heuredepart",$request) && key_exists("nbplace",$request) && key_exists("contraintes",$request)){

        $context->tarifparkm = $request['tarifparkm'];
        $context->depart = $request['depart'];
        $context->arrivee = $request['arrivee'];
        $context->heuredepart = $request['heuredepart'];
        $context->nbplace = $request['nbplace'];
        $context->contraintes = $request['contraintes'];
        if($request['depart']==$request['arrivee']){
            $context->error = "La ville de depart doit etre differente de celle d'arrivée";
            return context::ERROR;
        }
        if($context->tarifparkm<=0){
            $context->error = "Le tarif par km doit etre superieure à 0";
            return context::ERROR;	
        }
        if($context->nbplace<=0){
            $context->error = "Le nombre de places doit etre superieure à 0";
            return context::ERROR;	
        }
        if($context->heuredepart<0 || $context->heuredepart >23){
            $context->error = "Heure de départ incorrect";
            return context::ERROR;	
        }
        else{

            $context->voyage = voyageTable::nouveauVoyage($context->depart, $context->arrivee, $context->heuredepart,$context->nbplace, $context->tarifparkm, $context->contraintes, $context->user);
            if(!$context->voyage){
                $context->error = "ERREUR: Le voyage n'a pas pu etre ajouté";
                return context::ERROR;	
            }
            $context->success = "true";
            return context::SUCCESS;
        }

    }
    $context->error = "Données Incomplete";
    return context::ERROR;
}


/**
	* Afficher les details d'un voyage
	*/
	
	public static function afficherVoyage($request,$context){
		
		
		$context->voyages = new ArrayObject();
		foreach($request['voyage'] as $voy){
			$voyage = voyageTable::getVoyageById($voy);
			$context->voyages->append($voyage);

		}
		$context->depart=$request['depart'];
		$context->arrivee=$request['arrivee'];
		$context->distance=$request['distance'];
		$context->tarif=$request['tarif'];
		$context->heureDepart=$request['heureDepart'];
		$context->heureArrivee=$request['heureArrivee'];
		$context->contraintes=$request['contraintes'];
		$context->conducteurs = new ArrayObject();
		foreach($request['conducteur'] as $con){
			$conducteur = utilisateurTable::getUserById($con);
			$context->conducteurs->append($conducteur);

		}

		return context::SUCCESS;
	}

    




}
