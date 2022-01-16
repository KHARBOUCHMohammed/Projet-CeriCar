<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {
 /**
	* Recuperer l'utilisateur par son ID
	*/

	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		$user = $userRepository->findOneBy(array('id' => $id));	

		return $user; 
	}

	
    /**
	* Ajouter d'un utilisateur
	*/
	public static function ajoutUtilisateur($nom, $prenom, $pseudo, $password){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$utilisateur = new utilisateur();
		$utilisateur->nom = $nom;
		$utilisateur->prenom = $prenom;
		$utilisateur->identifiant = $pseudo;
		$utilisateur->pass = sha1($password);
		//$utilisateur->pass = $password;
		$user = $em->persist($utilisateur);
		$em->flush();
		return $user;
	}
	public static function ajouterUser($nom,$prenom,$identifiant,$pass)
    {
          $em = dbconnection::getInstance()->getEntityManager() ;
     
            $utilisateur = new utilisateur();    
            $utilisateur->nom = $nom;
            $utilisateur->prenom = $prenom;
            $utilisateur->identifiant = $identifiant;
			$utilisateur->pass = $pass;

        $user = $em->persist($utilisateur);  //prépare une Utilir pour le créer
        $em->flush();

        return $user; 
    }


	  /**
	* Recuperer l'utilisateur par son pseudo
	*/

	public static function getUserByLogin($login)
    {
          $em = dbconnection::getInstance()->getEntityManager() ;

        $userRepository = $em->getRepository('utilisateur');
        $user = $userRepository->findOneBy(array('identifiant' => $login));

        return $user; 
    }


	  /**
	* Recuperer l'utilisateur par son pseudo et MDP
	*/

  public static function getUserByLoginAndPass($login,$pass)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$userRepository = $em->getRepository('utilisateur');
	$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	
	
	if ($user == false){
		echo 'Erreur sql';
			   }
	return $user; 
	}

  
}


?>
