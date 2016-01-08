<?php
require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Menu.class.php') ;
require_once('../classes/Equipe.class.php');
require_once('../functions/calendar.function.php');

$idMembre = $_POST["idMembre"];
$modif = $_POST['modif'];
$valeur = $_POST['valeur'];
var_dump($_POST);
$membre = Utilisateur::createFromID($idMembre);
$membre->majInfo($modif, $valeur);
