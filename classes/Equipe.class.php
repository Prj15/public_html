<?php 

class Equipe {

    private $id = null ; 
    private $nom = null ;

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

    public static function getJoueurs() {
        $array = array() ; 
        $pdo = myPDO::getInstance() ; 

        $rq = $pdo->prepare(<<<SQL
                    SELECT *
                    FROM joueur
                    WHERE idEquipe = :idEquipe
                    ORDER BY idEquipe 
SQL
    );

        $rq->execute(array(':idEquipe'=>$this->id)) ;

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

	return $html ; 

    }

    public function getPhoto() {
        $array = array() ; 
        $pdo =myPDO::.getInstance();

        $rq = $pdo->prepare(<<<SQL
                    SELECT photoEq
                    FROM equipe
                    WHERE idMenu = :idPic
                    ORDER BY idMenu
SQL
    );    
        $rq->execute(array(':idPic'=>$this->id)) ;

        if ($img = $rq->fetch()) !== false){
            return $img; 
        }else{
            throw new Exception('Image non trouvée.');
        }
     }


	//à compléter
}
