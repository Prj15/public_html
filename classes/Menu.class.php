<?php

class Menu {

	/**
     * Usine pour fabriquer une instance à partir d'un identifiant
     * Les données sont issues de la base de données
     * @param int $id identifiant BD du menu à créer
     * @return menu instance correspondante à $id
     * @throws Exception si le menu ne peut pas être trouvée dans la base de données
     */
	public static function createFromID($id) {
		$pdo = myPDO::getInstance();
		$requete = $pdo->prepare(<<<SQL
								SELECT idMenu, nomMenu, idCtg, idNiveau
								FROM menu
								WHERE idMenu = :idMenu
SQL
		);
		$requete->execute(array(':idMenu'=>$id));
		$requete->setFetchMode(PDO::FETCH_CLASS, 'menu');

		if (($objet = $requete->fetch()) !== false) {
			return $objet;
		}
	}

	/**
	 * Méthode qui permet d'obtenir la catégorie correspondante à un menu
	 */
	public function getCategorie() {
		return Categorie::createFromID($this->idCtg); 
    }

 public static function getContent($id) {
		$pdo = myPDO::getInstance() ;

		$requete = $pdo->prepare(<<<SQL
						SELECT urlMenu
						FROM menu
						WHERE idMenu = :idMenu
SQL
		) ; 

		$requete->setFetchMode(PDO::FETCH_ASSOC) ; 
		$requete->execute(array(':idMenu'=>$id)) ; 

		$content = $requete->fetch() ; 
		
        if ($content !== false) {
            
			if ($content != null) {
				return $content["urlMenu"] ;
			} else {
				return "Il n'y a pas encore de texte pour cette page" ; 
			}
		}
		
	}


	/**
	 * Mise en forme HTML d'un menu : sous forme d'un li
	 */ 
	public function toHtml() {
		$nomCtg = $this->getCategorie()->nomCtg;
		$menu = <<<HTML
<li id="{$this->idMenu}" class="{$nomCtg} menus">{$this->nomMenu}</li>
HTML;

		return $menu ; 
	}



}
