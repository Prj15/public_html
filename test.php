<?php
//var_dump(getcwd()) ;
/*CETTE PAGE EST TEMPORAIRE ET FAIT PARTIE DU SYSTEME DE TEST */
require_once 'classes/Webpage.class.php' ;
require_once 'classes/Utilisateur.class.php' ;

//REGLAGES DE LA PAGE
$page = new Webpage('Test');
$page->appendCssUrl('css/style.css');
$page->appendJsUrl('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
$page->appendJsUrl('js/script.js');

//NIVEAU PAR DEFAUT
$niveau = 1 ;

//FORMULAIRES
$deco = Utilisateur::logoutform('test.php');     

Utilisateur::logoutIfRequested();

if (!Utilisateur::isConnected()) {
	$form = Utilisateur::loginFormSHA1('ajax/traitementCo.php') ;	  
	$inscription = Utilisateur::signIn('ajax/traitement.php');

    $page->appendContent(<<<HTML
				<div id='connexionB'>Connexion</div>
				<div id='inscriptionB'>Inscription</div>
HTML
);

	//FORMULAIRE DE CONNEXION/CREATION DE COMPTE S'IL N'Y PAS D'UTILISATEUR CONNECTE
	$page->appendContent(<<<HTML
	    {$form} 
	    {$inscription}
HTML
	);	
} else {

        $utilisateur = Utilisateur::createFromSession();
        $page->appendJs(<<<JAVASCRIPT
            $($.fn.cacherBoutons = function() {
                $('.iden').hide();
            });
JAVASCRIPT
        );

        //LA VALEUR DE NIVEAU EST CHANGEE SI L'UTILISATEUR EST CONNECTE
        $niveau = $utilisateur->idNiveau;

        $page->appendContent(<<<HTML
        {$deco}
HTML
    );

}

//AJOUT DU PANEL QUOI QU'IL ADVIENNE
$page->appendPanel($niveau) ; 

$page->appendContent(<<<HTML

<section id="content"> 
    <p> 
        Ferrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better.
        Ferrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better. 
    </p>
    <p> 
        Ferrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better.
        Ferrars all spirits his imagine effects amongst neither. It bachelor cheerful of mistaken. Tore has sons put upon wife use bred seen. Its dissimilar invitation ten has discretion unreserved. Had you him humoured jointure ask expenses learning. Blush on in jokes sense do do. Brother hundred he assured reached on up no. On am nearer missed lovers. To it mother extent temper figure better. 
    </p> 
</section>
HTML
);

$page->appendToFooter(<<<HTML
    
HTML
);

echo $page->toHTML();
