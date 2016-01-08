<?php
require_once('../classes/Utilisateur.class.php') ;

if(isSet($_POST['idJoueur'])){
    if(Utilisateur::deleteFromID($_POST['idJoueur'])) {
        echo "Le joueur d'id '".$_POST['idJoueur']."' a été correctement supprimé !";
        exit() ; 
    } else {
        echo "Le joueur d'id '".$_POST['idJoueur']."' n'a pas pu être supprimé !";
        exit() ; 
    }
}
