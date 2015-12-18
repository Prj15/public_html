<?php
require_once "../classes/Joueur.class.php" ; 

if (isset($_POST['id'])) {
	$id = $_POST['id'] ; 
	$joueur = Joueur::createFromID($id); 

	$html = <<<HTML
	<div id="pj">{$joueur->getPhoto()}</div>
        <ul>
HTML;
	
	$name = $joueur->nomJoueur ; 
	if ($name!=null) {
		$html.="<li>Nom: ".$name."</li>" ; 
	} else {
		$html.="<li class='inconnu'> Nom inconnu !</li>" ; 
	}

	$pname = $joueur->pnomJoueur ; 
	if ($pname!=null) {
		$html.="<li>Prénom: ".$pname."</li>" ; 
	} else {
		$html.="<li class='inconnu'> Prénom inconnu !</li>" ; 
	}

	$naiss = $joueur->dateNaissance ; 
	if ($naiss!=null) {
		$html.="<li>Né(e) le: ".$naiss."</li>" ; 
	} else {
		$html.="<li class='inconnu'> Date de naissance inconnue !</li>" ; 
	}

	$poste = $joueur->poste ; 
	if ($poste!=null) {
		$html.="<li>Poste: ".$poste."</li>" ; 
	} else {
		$html.="<li> Poste inconnu ! </li>" ; 
	}

	$num = $joueur->numero ; 
	if ($num!=null) {
		$html.="<li>Numéro: ".$num."</li>" ;
	} else {
		$html.="<li> Numéro inconnu ! </li>" ; 
	}

	$poids = $joueur->poids ; 
	if ($poids!=null) {
		$html.="<li>Poids: ".$poids."kgs</li>" ;
	} else {
		$html.="<li> Poids inconnu ! </li>" ; 
	}

	$taille = $joueur->taille ; 
	if ($poids!=null) {
		$html.="<li>Taille: ".$taille."cm</li>" ;
	} else {
		$html.="<li> Taille inconnue ! </li>" ; 
	}

	$html.="</ul>" ;

	echo $html ; 

}