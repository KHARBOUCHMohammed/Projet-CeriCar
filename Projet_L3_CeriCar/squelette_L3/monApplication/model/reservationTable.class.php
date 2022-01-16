<?php

require_once "reservation.class.php";

class reservationTable {

 /**
	* Recuperer les reservations par un voyage
	*/
 public static function getReservationsByVoyage($voyage)
  {
    $em = dbconnection::getInstance()->getEntityManager();
    if($em == null)
      return 'Erreur : La connection à la BDD a échouée';

    $reservationRepository = $em->getRepository('reservation');
    if($reservationRepository == null)
      return "Erreur : La table 'reservation' n'existe pas";

    $reservations = $reservationRepository->findBy(array('voyage' => $voyage)); 

    return $reservations;
  }



  /**
	* Recuperer les reservations d'un voyage
	*/
  public static function getReservationByVoyage($voyage)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;
	
	  $reservationRepository = $em->getRepository('reservation');
	  $reservation = $reservationRepository->findBy(array('voyage' => $voyage));	
  
    return $reservation;

  }
/**
 * ajouter une reservation à la BDD
 */

  public static function addReservation($voyage, $voyageur){
    $em = dbconnection::getInstance()->getEntityManager() ;
    $reservation = new reservation();
    $reservation->voyage = $voyage;
    $reservation->voyageur = $voyageur;
    $reservationInstance = $em->persist($reservation);
    $em->flush();
    echo $reservationInstance;
    return $reservationInstance;
}

/**
* Recuperer les reservations d'un voyageur
*/
public static function getReservationsByVoyageur($voyageur)
{
$em = dbconnection::getInstance()->getEntityManager() ;

$reservationRepository = $em->getRepository('reservation');
$reservation = $reservationRepository->findBy(array('voyageur' => $voyageur));	

return $reservation;

}

    /**
     * function for tha action to reserve a trip (add a new reservation into data base)
     */
    public static function reserveVoyage($voyageReservation, $voyageurReservation){

      $em = dbconnection::getInstance()->getEntityManager();

      $sql = "SELECT reserveVoyage('$voyageReservation', '$voyageurReservation')";
  $stmt = $em->getConnection()->prepare($sql);
  $stmt->execute();
}

}

/**
 * constructeur pour afficher les détails d'un voyage 
 */

 
class VoyageData{
  public $departFormat;
  public $arriveeFormat;
  public $voyage;
  public $dureeFormat;
  public $placeDisponible;
  public $reservations;
  public $placeReserve;
  public $arriveeHeure;
  public $arriveeMinute;
  public function __construct($voyage){
      $this->voyage = $voyage;
      $this->departFormat = (($voyage->heuredepart >= 10)?$voyage->heuredepart:"0".$voyage->heuredepart).":00";
      $this->arriveeHeure = (intdiv ($this->voyage->trajet->distance , 60) + $voyage->heuredepart)%24;
      $this->arriveeMinute = $this->voyage->trajet->distance % 60;
      $heureFormat = ($this->arriveeHeure>=10)?$this->arriveeHeure:"0".$this->arriveeHeure;
      $minuteFormat = ($this->arriveeMinute>=10)?$this->arriveeMinute:"0".$this->arriveeMinute;
      $this->arriveeFormat = "$heureFormat:$minuteFormat";
      $this->placeReserve = $voyage->nbplace - $this->placeDisponible;
      $dureeHeure = intdiv($this->voyage->trajet->distance , 60);
      $dureeMinute = $this->voyage->trajet->distance % 60;
      $this->dureeFormat = $dureeHeure."h".$dureeMinute;
      $this->reservations = reservationTable::getReservationByVoyage($voyage->id);
  }
}

?>