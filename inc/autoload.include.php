<?php
// Niveau d'erreur maximal pour développer
error_reporting(E_ALL | E_STRICT) ;
// Fuseau horaire par défaut pour ne pas avoir de problème avec les fonctions sur dates
date_default_timezone_set('Europe/Paris') ;

// Tentative de chargement magique du fichier contenant la classe non définie
spl_autoload_register(function ($classe) {

	if (strpos($classe, 'exception')) {
		require_once '/../exceptions/'.$classe.'/.class.php' ;
	}

});