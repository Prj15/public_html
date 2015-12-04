<?php
/*CETTE PAGE EST TEMPORAIRE ET FAIT PARTIE DU SYSTEME DE TEST */
require_once 'classes/Webpage.class.php' ;
require_once 'classes/Utilisateur.class.php' ;
//coucou
$p = new Webpage('Authentification') ;
$deco = Utilisateur::logoutForm('test.php');
try {
    // Tentative de connexion
	$utilisateur = Utilisateur::createFromAuthSHA1($_REQUEST) ;
	$utilisateur->saveIntoSession();	
    $p->appendContent(<<<HTML
<div>Salut {$utilisateur->nom()}</div>

<form action="test.php" method="post">
	<input type="submit" value="retour">
</form>

{$deco}
HTML
) ;
}
catch (AuthenticationException $e) {
    // Récuperation de l'exception si connexion échouée
    $p->appendContent("Échec d'authentification&nbsp;: {$e->getMessage()}") ;
}
catch (Exception $e) {
    $p->appendContent("Un problème est survenu&nbsp;: {$e->getMessage()}") ;
}



// Envoi du code HTML au navigateur du client
echo $p->toHTML() ;




