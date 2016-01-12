<?php
//var_dump(getcwd()) ;
/*CETTE PAGE EST TEMPORAIRE ET FAIT PARTIE DU SYSTEME DE TEST */
require_once 'classes/Webpage.class.php' ;
require_once 'classes/Utilisateur.class.php' ;
require_once 'classes/Categorie.class.php' ;
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

    $page->appendToButtons(<<<HTML
			<button id='connexionB'>Connexion</button>
			<button id='inscriptionB'>Inscription</button>
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
       
        //LA VALEUR DE NIVEAU EST CHANGEE SI L'UTILISATEUR EST CONNECTE
        $niveau = $utilisateur->idNiveau;

        $page->appendToButtons(<<<HTML
        {$deco}
HTML
);

}

//AJOUT DU PANEL QUOI QU'IL ADVIENNE
$page->appendPanel($niveau); 
$accueil = Categorie::getAccueil() ;
$page->appendContent(<<<HTML

<section id="content"> 
    {$accueil}
</section>
HTML
);

$page->appendToFooter(<<<HTML
    
HTML
);

echo $page->toHTML();
