<?php
require_once('../classes/Utilisateur.class.php') ;
require_once('../classes/myPDO.class.php') ;
require_once('../inc/myPDO.include.php') ;
require_once('../classes/Menu.class.php') ;
require_once('../classes/Equipe.class.php');
require_once('../functions/calendar.function.php');

$content = "DEFAULT" ; 
$idMenu = $_POST['idMenu'] ;
if (isSet($idMenu)) {
   // var_dump($idMenu) ;
    if ($idMenu >= 5 && $idMenu <= 8) {
        $equipe1 = Equipe::createFromID($idMenu);
        
        $content = <<<HTML
            <h1>Equipe {$equipe1->getNomEquipe()}</h1>
            <div id="photoE">{$equipe1->getPhoto()}</div>
            {$equipe1->joueursToHTML()}
HTML;
    } else if($idMenu == 13) {
        $month = date('m');
        $year = date('Y');
        $date = mktime(0,0,0, $month, 1, $year);
        $displayYear = false;
        $monthName = strftime($displayYear ? "%B %Y" : "%B", $date);

        if (isset($_GET['month']) && !empty($_GET['month']) && ctype_digit($_GET['month'])) {
            $month = (int) $_GET['month'];
        }
        
        $prev = $month -1;
        $next = $month +1;

        $content = <<<HTML
                <h1>Calendrier du mois de {$monthName} {$year}</h1>
                <div id="prev"></div>
                <div id="next"></div>
HTML;
        $content .= calendar($month, $year);

    } else if ($idMenu == 20) {
        $users = Utilisateur::getAll() ;
        var_dump($users);

        $tableau = "<table>" ;
       //Identifiant 
        $tableau .= "<tr> <th> Identifiant </th>" ;
        
        foreach ($users as $user) {
            $tableau.= "<td>".$user[0]->idPers."</td>" ;
        }

        $tableau .= "</tr>" ;

        //Nom
$tableau .= "<tr> <th> Nom </th>" ;
        
        foreach ($users as $user) {
            $tableau.= "<td>".$user[0]->nomPers."</td>" ;
        }

        $tableau .= "</tr>" ;

        


        $tableau .= "</table>" ;

       $content = $tableau ;  
    } else {
        $content = Menu::getContent($idMenu) ; 
    }
    echo $content ; 
    exit();
} else {
    echo "Y a eu un problème " ; 
    exit () ;
}

