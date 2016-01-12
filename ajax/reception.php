<?php

require_once '../classes/Webpage.class.php' ;
if (isset($_FILES) && isset($_POST)) {

	//Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$nom = $_FILES['image']['name'] ;

	//Le type du fichier. Par exemple, cela peut être « image/png ».
	$type = $_FILES['image']['type'] ;

	//La taille du fichier en octets.
	$size = $_FILES['image']['size'] ;

	//L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$tmp = $_FILES['image']['tmp_name'] ;

	//Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
	$code = $_FILES['image']['error'] ;

	$titre = $_POST['titre'] ; 

	$desc = $_POST['description'] ; 

	$erreur = "DEFAULT" ; 
	$reussite = "DEFAULT" ;

	var_dump($_FILES) ;
	var_dump($image_sizes = getimagesize($tmp)) ;

	$maxwidth = 10000 ; 
    $maxheight = 10000 ;

	$extensions_valides = array('jpg' , 'jpeg' , 'gif' , 'png');
	$extension_upload = strtolower(substr(strrchr($nom, '.'),1));

	if (in_array($extension_upload,$extensions_valides)) {

		$image_sizes = getimagesize($tmp);
		if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";
		else {
			switch ($code) {
				case 0 : 
                $dir = "../img/album" ; 
				$resultat = move_uploaded_file($tmp,"$dir/$nom");
				if ($resultat) $reussite = "Fichier correctement uploadé et transféré" ; 
				break ; 

				case 1 : $erreur = "La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini." ;
				break ;

				case 2 : $erreur = "La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML." ;
				break ;

				case 3 : $erreur = "Le fichier n'a été que partiellement téléchargé." ;
				break ;

				case 4 : $erreur = "Aucun fichier n'a été téléchargé." ; 
				break ; 

				case 6 : $erreur = "Un dossier temporaire est manquant." ; 
				break ; 

				case 7 : $erreur = "Échec de l'écriture du fichier sur le disque." ; 
				break ; 

				case 8 : $erreur = "Une extension PHP a arrêté l'envoi de fichier." ; 
				break ;
			}
		}
	} else {
		$erreur = "Extension invalide, upload impossible !" ; 
	}

	$p = new Webpage('Reception Image') ; 

if ($reussite == "DEFAULT") {
	$p->appendContent(<<<HTML
		<div class="erreur">{$erreur}</div>
HTML
	);

	$p->appendCss(<<<CSS
		.erreur {
		  background-color: rgba(184,0,0,0.7) ;
		  width: inherit-4;
		  text-align: center;
		  border-radius: 5px;
		  border : 2px solid rgb(176,0,0) ;
		  font-variant: small-caps;
		  color: rgb(32,32,32);
		  margin-bottom: 20px;
		}
CSS
	);

} else {

	$p->appendContent(<<<HTML
		<div class="succes">{$reussite}</div>
HTML
	);

	$p->appendCss(<<<CSS
		.succes {
		  background-color: rgba(0, 121, 0, 0.7);
		  width: inherit-4;
		  text-align: center;
		  border-radius: 5px;
		  border : 2px solid rgb(0,144,0) ;
		  font-variant: small-caps;
		  color: rgb(32,32,32);
		  margin-bottom: 20px;
		}
CSS
	);
}

	$p->appendContent(<<<HTML
<button onclick="window.location.href ='../test.php';">Retour à l'accueil</button>

HTML
);
	echo $p->toHTML(); 
	
}
