<?php

require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Categorie.class.php') ;

$content = "DEFAULT" ; 

if (isSet($_POST['idCtg'])) {


    $content = Categorie::getContent($_POST['idCtg']) ;
    echo $content ; 
    exit();

} else {

	echo "Y a eu un problème " ; 
	exit () ;
}
