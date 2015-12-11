<?php

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
	<li id="{$this->idJoueur}">{$this->pnomJoueur} {$this->nomJoueur}</li>\n
HTML;
	}
	
}
