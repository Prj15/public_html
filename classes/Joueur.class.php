<?php
require_once('../inc/myPDO.include.php') ;
class Joueur { 

    public static function createFromID($id) {
        $pdo = myPDO::getInstance() ; 
        $rq = $pdo->prepare(<<<SQL
                    SELECT * 
                    FROM joueur
                    WHERE idJoueur = :id

SQL
    );
        $rq->execute(array(':id'=>$id)) ;
        $rq->setFetchMode(PDO::FETCH_CLASS, 'joueur');

        if (($obj = $rq->fetch()) !== false) return $obj ;
    }

	public function npHTML(){
		return <<<HTML
	<li id="Joueur{$this->idJoueur}">{$this->pnomJoueur} {$this->nomJoueur}</li>\n
HTML;
	}

    public function getPhoto() {
        $photo = $this->photoid ; 
        if ($photo != null) {
            return <<<HTML
            <img src="{$photo}">
HTML;
        } else {
            return <<<HTML
            <img src="img/joueurs/profile.jpg">
HTML;
        }
    }
	
}
