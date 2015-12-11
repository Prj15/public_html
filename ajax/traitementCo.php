<?php
require_once '../classes/Utilisateur.class.php';

    if (isSet($_POST['code'])) {
        $u = Utilisateur::createFromAuthSHA1($_POST['code']);

        echo '<div class="erreur">OK</div>' ;
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


