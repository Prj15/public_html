<?php
	if (!isSet($_POST['loginCo'], $_POST['passCo'])) {
			
			echo '<div class="erreur">C\'est pas possible ça l\'ami !</div>' ;
			exit();
			
	} else {
										
		if ($_POST['loginCo'] == "") {
			echo '<div class="erreur">Vous devez remplir le champ login !</div>' ;
			exit(); 					
		} else if ($_POST['passCo'] == "") {

			echo '<div class="erreur">Vous devez remplir le champ mot de passe !</div>' ;
			exit();
		} else if (!Utilisateur::chercherLogin($_POST['loginCo'])) {
			echo '<div> class="erreur">Ce login n\'existe pas !</div>' ;
			exit();
		} 
	}


