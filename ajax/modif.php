<?php
require_once('../classes/Utilisateur.class.php') ;

$idMembre = $_POST['idMembre'];
$modif = $_POST['modif'];
$valeur = $_POST['valeur'];
echo Utilisateur::majInfo($idMembre, $modif, $valeur);
