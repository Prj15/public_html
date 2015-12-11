<?php:tabnew 

require_once('../classes/Utilisateur.class.php') ;
	if (!isSet($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['mdp'],
			$_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['CP'], $_POST['commentaire'])) {
		
			
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


	} else {
		if ( $_POST['nom'] == "") {
			echo '<div class="erreur">Vous devez remplir le champ \'Nom\' !</div>';
			exit();
		} else if ( $_POST['prenom'] == ""){
			echo '<div class="erreur">Vous devez remplir le champ \'Prénom\' !</div>';
			exit();
		} else if ( $_POST['login'] == "") {
			echo '<div class="erreur">Le champ \'Login\' est essentiel ! </div>';
			exit();
		} else if ( preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/',$_POST['mdp']) == 0 ) {
			echo 
			'<div class="erreur">
				Attention ! Votre mot de passe doit contenir : 
				<ul>
					<li>
						entre 4 et 10 caractères
					</li>
					<li>
						une lettre majuscule minimum
					</li>
					<li>
						une lettre minuscule minimum
					</li>
					<li>
						un caractère numérique minimum
					</li>
				</ul>
			</div>' ;
			exit();
		} else if ( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
			echo '<div class="erreur">Mmmmh .. Ceci n\'est pas une adresse e-mail ... (Ou alors je n\'y connaît rien)</div>' ;
			exit();
		} else {
			Utilisateur::ajoutUtilisateur(2);
			echo '<div class="succes">L\'inscription a réussi !</div>' ;
			exit();
		}
	}

