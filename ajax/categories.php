<?php

require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Categorie.class.php') ;

$content = Categorie::getAccueil() ;
if (isSet($_POST['idCtg'])) {
	$idCtg = $_POST['idCtg'];

	if(!Categorie::hasMenus($idCtg)){
		$content = Categorie::getContent($_POST['idCtg']);
	} 

	if ($idCtg == 5) {
		// On récupère les photos présentes dans le dossier ressources.
		$pictures = glob('../img/album/*.{jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG}',GLOB_BRACE);

		// Initialisation du réceptacle du slideshow.
		$content = <<<HTML
			<div id="slideshow">
				<ul id="images">
HTML;

		// Pour chaque image, on l'affiche dans un item de liste.
		foreach ($pictures as $picture) {
			$content .= "<li><img src='$picture' alt='picture'></li>";
		}

		// Fermeture du réceptacle.
		$content .= <<<HTML
				</ul>
			</div>
			<div id = "slideButtons">
				<button name="previous" id="slidePrev">
				<button name="next" id="slideNext">			
			</div>
HTML;
	}

    echo $content ;
    exit();

} else {

	echo "Y a eu un problème " ;
	exit () ;
}
