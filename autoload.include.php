<?php
spl_autoad_register(function ($classe) {
		
	$base = dirname(__FILE__).'/' ; 
	
	$fichier = $base.$classe.".class.php" ;

	if (file_exists($fichier)) {
		require_once($fichier) ; 
	} else {
		$base .= "../ajax/" ; 
		$fichier = $base.$classe.".class.php" ;
	}

	if (file_exists($fichier)) {
		require_once($fichier) ;
	} else {
		$base .= "..classes" ; 
		$fichier = $base.$classe.".class.php
	}


	
	

}, true ) ;
