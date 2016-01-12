<?php

require_once '../classes/Webpage.class.php' ;

if (isset($_FILES) && isset($_POST)) {

	//Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$nom = $_FILES['fichier']['name'] ;

	//Le type du fichier. Par exemple, cela peut être « fichier/png ».
	$type = $_FILES['fichier']['type'] ;

	//La taille du fichier en octets.
	$size = $_FILES['fichier']['size'] ;

	//L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$tmp = $_FILES['fichier']['tmp_name'] ;

	//Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
	$code = $_FILES['fichier']['error'] ;

	$titre = $_POST['titrePDF'] ; 

	$desc = $_POST['descriptionPDF'] ; 

	$erreur = "DEFAULT" ; 
	$reussite = "DEFAULT" ;

	$extensions_valides = array('pdf');
    $extension_upload = strtolower(substr(strrchr($nom, '.'),1));

    $content = "" ; 

    if (in_array($extension_upload,$extensions_valides)) {
        
        switch($code) {
            case 0 :
                $dir = "../cr" ; 
                $resultat = move_uploaded_file($tmp,"$dir/$titre.$extensions_valides[0]");
                if ($resultat) $content = "<div class='succes'> Fichier correctement uploadé et transféré </div>" ; 
                break ;
            case 3 : 
                $content = "<div class='erreur'> Le fichier n'a été que partiellement téléchargé. </div>" ;
				break ;
            case 4 : 
                $content = "<div class='erreur'> Aucun fichier n'a été téléchargé. </div>" ; 
				break ; 
            default : 
                $content = "<div class='erreur'> Echec de l'upload du PDF ! </div>" ; 
                break ; 
        }

    } else {
        $content .= "<div class='erreur'> Extension invalide, upload impossible ! </div>" ; 
    }

    $p = new WebPage('Upload PDF') ; 
    $p->appendContent($content) ; 

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
	$p->appendContent(<<<HTML
        <button onclick="window.location.href ='../test.php';">Retour à l'accueil</button>
HTML
);
    echo $p->toHTML() ;
} else {
    echo 'Une erreur inconnue est survenue ! ' ; 
}
