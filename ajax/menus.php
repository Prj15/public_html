<?php
require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Menu.class.php') ;
require_once('../classes/Equipe.class.php');
$content = "DEFAULT" ; 
$idMenu = $_POST['idMenu'] ;
if (isSet($idMenu)) {
    //var_dump($idMenu) ;
    if ($idMenu >= 5 && $idMenu <= 8) {
        $equipe1 = Equipe::createFromID($idMenu);
        
       $content = <<<HTML
<div id="photoE">{$equipe1->getPhoto()}</div>
<div id="joueurs">{$equipe1->joueursToHTML()}</div>
HTML;
    } else {
    $content = Menu::getContent($idMenu) ; 
    }
    echo $content ; 
    exit();
} else {
    echo "Y a eu un problème " ; 
    exit () ;
}

