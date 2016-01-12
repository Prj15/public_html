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
/**
 * Section TABLEAU , Gestion des utilisateurs
 *
 *
 *
 **/
    } else if ($idMenu == 20) {
       $users = Utilisateur::getAll() ;
        //var_dump($users);
        $tableau = "<table id=\"userstab\">" ;
        $tableau.=<<<HTML
            <thead>
                <tr>
                    <th id="t1" class="tri_actuel">Identifiant</th>
                    <th id="t2">Nom</th>
                    <th id="t3">Prenom</th>
                    <th id="t4">AdresseMail</th>
                    <th id="t5">Adresse</th>
                    <th id ="t6">Ville</th>
                    <th id ="t7">CP</th>
                    <th id ="t8">Comm</th>
                    <th id ="t9">login</th>
                    <th id ="t10">Niveau</th>
                    <th id ="Suppr">Suppression</th>
                </tr>
            </thead>
HTML;
        foreach ($users as $user) {
                $idMod ="modifier" . $user[0]->idPers;
                $idSuppr ="supprimer" . $user[0]->idPers;
                $tableau.="<tr  id=\"{$user[0]->idPers}\"><td class =\"idPers\">{$user[0]->idPers}</td>";
                $tableau.="<td class=\"nomPers\">{$user[0]->nomPers}</td>";
                $tableau.="<td class=\"prenomPers\">{$user[0]->prenomPers}</td>";
                $tableau.="<td class=\"adressMailPers\">{$user[0]->adressMailPers}</td>";
                $tableau.="<td class=\"adressPers\">{$user[0]->adressPers}</td>";
                $tableau.="<td class=\"villePers\">{$user[0]->villePers}</td>";
                $tableau.="<td class=\"cpPers\">{$user[0]->cpPers}</td>";
                $tableau.="<td class=\"commentaire\">{$user[0]->commentaire}</td>";
                $tableau.="<td class=\"login\">{$user[0]->login}</td>";
                $tableau.="<td class=\"idNiveau\">{$user[0]->idNiveau}</td>";
                $tableau.="<td class=\"Suppr\"><input class = \"userSuppr\" id=\"{$idSuppr}\" type=\"submit\" value=\"Supprimer\"></td></tr>";
            }

        $tableau .= "</table>" ;
        $warning = "<div id='warning'> <span></span> Attention, en temps qu'administrateur, vous impactez directement la base de données ! Soyez vigilant sur cette page ! </div>" ;
        $resultat = "<div id='reponse'></div>" ;
       $content = $warning.$tableau.$resultat ;
    } else {
        $content = Menu::getContent($idMenu) ;
    }
    echo $content ;
    exit();
} else {
    echo "Y a eu un problème " ;
    exit () ;
}
