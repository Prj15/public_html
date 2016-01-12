<?php 

require_once 'Menu.class.php' ;

class Categorie {

	 /**
     * Usine pour fabriquer une instance à partir d'un identifiant
     * Les données sont issues de la base de données
     * @param int $id identifiant BD de la catégorie à créer
     * @return categorie instance correspondante à $id
     * @throws Exception si la catégorie ne peut pas être trouvée dans la base de données
     */
	public static function createFromID($id) {
		$pdo = myPDO::getInstance();
		$requete = $pdo->prepare(<<<SQL
								SELECT idCtg, idNiveau, nomCtg
								FROM categorie
								WHERE idCtg = :id
SQL
		);
		$requete->execute(array(':id'=>$id));
		$requete->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

		if (($objet = $requete->fetch()) !== false) {
			return $objet;
		}
	}

	/**
	 * Méthode qui permet de récupérer toutes les catégories qui correspondent à un niveau donné
	 * Le niveau en paramètre correspond au niveau de l'utilisateur connecté
	 *
	 */
	public static function getAll($niveau) {
		$array = array();

		$pdo = myPDO::getInstance();
		$requete = $pdo->prepare(<<<SQL
							SELECT * 
							FROM categorie
							WHERE idNiveau <= :niveau
							ORDER by 1
SQL
		);

		$requete->execute(array(':niveau'=>$niveau));

		while (($donnee = $requete->fetch()) !== false) {
			array_push($array, self::createFromID($donnee['idCtg']));
		}

		return $array;
	}

	/**
	 * Cette fonction permet de récuperer tout les menus d'une catégorie, toujours en fonction d'un niveau en paramètre
	 *
	 */
	public function getMenus($niveau) {
		$array = array();

		$pdo = myPDO::getInstance();
		$requete = $pdo->prepare(<<<SQL
								SELECT * 
								FROM menu
								WHERE idCtg = :idCtg
								AND idNiveau <= :niveau
								ORDER BY idMenu 
SQL
		);

		$requete->execute(array(':idCtg'=>$this->idCtg, ':niveau'=>$niveau));

		while(($donnee = $requete->fetch()) !== false) {
			array_push($array, Menu::createFromID($donnee['idMenu']));
		}

		return $array;
	}

 	public static function hasMenus($id){
		$bool = false;
		$occur = 0;
		$pdo = myPDO::getInstance();
		$requete = $pdo->prepare(<<<SQL
								SELECT m.idCtg
								FROM menu m, categorie c
								WHERE c.idCtg = :idCtg
								AND m.idCtg = c.idCtg
								ORDER BY 1
SQL
		);
		$requete->execute(array(':idCtg'=>$id));
		$content = $requete->fetch();
		if($content != '0') $bool = true;

		return $bool;
	}

	public static function getAccueil(){
		$pdo = myPDO::getInstance();

		$requete = $pdo->prepare(<<<SQL
					SELECT urlCtg
					FROM categorie
					WHERE nomCtg = 'Accueil'
					ORDER BY 1
SQL
		);
		$requete->execute();
		$content = $requete->fetch();

		 if ($content !== false) {
            
			if ($content != null) {
				return $content["urlCtg"] ;
			} else {
				return "Il n'y a pas encore de texte pour cette page" ; 
			}
		}

	}

	public static function stay($post){
		$id = $post['idCtg'];
		$pdo = myPDO::getInstance() ;

		$requete = $pdo->prepare(<<<SQL
						SELECT urlCtg
						FROM categorie
						WHERE idCtg = :idCtg
SQL
		) ; 

		$requete->setFetchMode(PDO::FETCH_ASSOC) ; 
		$requete->execute(array(':idCtg'=>$id)) ; 

		$content = $requete->fetch() ; 
		
        if ($content !== false) {
            
			if ($content != null) {
				return $content["urlCtg"] ;
			} else {
				return "Il n'y a pas encore de texte pour cette page" ; 
			}
		}


	}
 

    public static function getContent($id) {
		$pdo = myPDO::getInstance() ;

		$requete = $pdo->prepare(<<<SQL
						SELECT urlCtg
						FROM categorie
						WHERE idCtg = :idCtg
SQL
		) ; 

		$requete->setFetchMode(PDO::FETCH_ASSOC) ; 
		$requete->execute(array(':idCtg'=>$id)) ; 

		$content = $requete->fetch() ; 
		
        if ($content !== false) {
            
			if ($content != null) {
				return $content["urlCtg"] ;
			} else {
				return "Il n'y a pas encore de texte pour cette page" ; 
			}
		}
		
	}



	/**
	 * Mise en forme html des catégories et des menus : sous forme de listes
	 * Si la catégorie de contient pas de menus, le li correspondant ne contient pas de nouvel emboitement
	 *
     */
    	public function toHtml($niveau) {
		$menus = $this->getMenus($niveau);
		$nomCtg = $this->nomCtg;

		if (count($menus) == 0) {
			return <<<HTML
<li id="Categorie{$this->idCtg}" class="ctgs">{$nomCtg}</li>
HTML;
		} else {
			$categorie = <<<HTML
<li id="Categorie{$this->idCtg}" class="ctgs">{$nomCtg}
	<ul>
HTML;
		
		foreach ($menus as $menu) {
			$categorie .= $menu->toHtml();
		}

		$categorie .= <<<HTML
	</ul>
</li>		
HTML;
		return $categorie;

		}
	}

	}
