<?php 

require_once "Joueur.class.php" ;
class Equipe {

    public static function createFromID($idMenu) {
        $pdo = myPDO::getInstance() ; 
        $rq = $pdo->prepare(<<<SQL
                    SELECT * 
                    FROM equipe
                    WHERE idMenu = :id

SQL
    );
        $rq->execute(array(':id'=>$idMenu));
        $rq->setFetchMode(PDO::FETCH_CLASS, 'Equipe');

        if (($obj = $rq->fetch()) !== false) return $obj ;
     }

    public function getJoueurs() {
        $array = array() ; 
        $pdo = myPDO::getInstance() ; 

        $rq = $pdo->prepare(<<<SQL
                    SELECT *
                    FROM joueur
                    WHERE idEquipe = :idEquipe
                    ORDER BY idEquipe 
SQL
    );

        $rq->execute(array(':idEquipe'=>$this->idEquipe)) ;

        while (($data = $rq->fetch()) !== false) {
            array_push($array, Joueur::createFromID($data['idJoueur']));
        }

        return $array ; 
        
     }

    public function joueursToHTML() {

	   $joueurs = $this->getJoueurs() ;
      
	   $html = "<ul>" ; 

	foreach ($joueurs as $joueur) {
		$html.=$joueur->npHTML() ; 
	}

	$html .= "</ul>" ; 

    $html .=<<<HTML
    <div id="details">
        <div id="pj"></div>
        <ul>
            <li id="naiss">Né(e) le :</li>
            <li id="poste">Poste : </li>
            <li id="numéro">Numéro : </li>
            <li id="pds">Poids : </li>
            <li id="taille">Taille : </li>
        </ul>
    </div>
HTML;

	return $html ; 

    }

    public function getPhoto() {
        $photo = $this->photoEq ; 
        if ($photo != null) {
            return <<<HTML
            <img src="{$photo}">
HTML;
        } else {
            return <<<HTML
            <img src="img/none.jpg">
HTML;
        }
    }
}
