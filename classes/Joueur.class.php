<?php

class Joueur { 

    public static function createFromID($id) {
        $pdo = myPDO::getInstance() ; 
        $rq = $pdo->prepare(<<<SQL
                    SELECT * 
                    FROM joueur
                    WHERE id = :id

SQL
    );
        $rq->execute(array(':id'=>$id);
        $rq->setFetchMode(PDO::FETCH_CLASS, 'Joueur');

        if (($obj = $rq->fetch()) !== false) return $obj ;
    }

	public function npHTML(){
		return <<<HTML
	<li>{$this->pnomJoueur} {$this->nomJoueur}</li>
HTML;
	}
	
}
