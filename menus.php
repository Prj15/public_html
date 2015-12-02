<?php

require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Menu.class.php') ;

$content = "DEFAULT" ; 

if (isSet($_POST['idMenu'])) {

    var_dump($_POST['idMenu']) ;

    $content = Menu::getContent($_POST['idMenu']) ; 
    echo $content ; 
    exit();

} else {

	echo "Y a eu un problème " ; 
	exit () ;
}




