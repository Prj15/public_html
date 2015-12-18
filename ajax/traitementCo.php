<?php
require_once '../classes/Utilisateur.class.php';

    try {
    	$utilisateur = Utilisateur::createFromAuthSHA1($_REQUEST) ;
        $utilisateur->saveIntoSession();
        Utilisateur::unsetChallenge();
        
    	echo 'OK';
	} catch (AuthenticationException $e) {
		echo '<div class="erreur">Échec d\'authentification&nbsp;:'.$e->getMessage().'</div>' ;
	} catch (Exception $e) {
	    echo '<div class="erreur">Un problème est survenu&nbsp;:'.$e->getMessage().'</div>' ;
	}
	


    	/*if (!isSet($_POST['login'], $_POST['pass'])) {
			echo '<div class="erreur">C\'est pas possible ça l\'ami !</div>' ;
			exit();
			
	} else {
										
		if ($_POST['login'] == "") {
			echo '<div class="erreur">Vous devez remplir le champ login !</div>' ;
			exit(); 					
		} else if ($_POST['pass'] == "") {

			echo '<div class="erreur">Vous devez remplir le champ mot de passe !</div>' ;
			exit();
		} else if (!Utilisateur::chercherLogin($_POST['login'])) {
			echo '<div class="erreur">Ce login n\'existe pas !</div>' ;
            exit();
        }
    }*/


