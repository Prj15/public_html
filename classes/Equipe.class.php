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
      
	   $html = "<div id='joueurs'><ul>"; 

	foreach ($joueurs as $joueur) {
		$html.=$joueur->npHTML() ; 
	}

    $html .=<<<HTML
    </ul></div>
    <div id='details'>
        
    </div>
HTML;

	return $html ; 

    }

    /**
     * Retourne la photo de l'équipe 
     * @return img $photo, photo de l'équipe.
     */
    public function getPhoto() {
        $photo = $this->photoEq ; 
        if ($photo != null) {
            return <<<HTML
            <img src="{$photo}">
HTML;
        } else {
            return <<<HTML
            <img src="img/equipes/none.jpg">
HTML;
        }
    }

    /**
     * Retourne le nom de l'équipe 
     * @return string $nom, nom de l'équipe.
     */
    public function getNomEquipe(){
        $nom = $this->nomEquipe;
        if($nom != null) {
            return <<<HTML
                {$nom}
HTML;
        } else {
            return <<<HTML
                <p>Pas de nom!</p>
HTML;
        }
    }

}
