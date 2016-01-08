<?php 
//coucou
$base = dirname(__FILE__).'/' ;
require_once $base.'../inc/myPDO.include.php' ;
require_once 'myPDO.class.php' ;
require_once 'Personne.class.php' ;
require_once $base.'../exceptions/AuthenticationException.class.php' ;
require_once $base.'../exceptions/NotInSessionException.class.php' ;
require_once $base.'../exceptions/SessionException.class.php' ;
class Utilisateur extends Personne {
	const session_key = "__utilisateur__";
	/**
	 * Retourne le prenom de de l'utilisateur
	 */
	public function nom(){
		return $this->prenomPers;
	}
	/**
	 * Retourne le niveau de l'utilisateur sous forme d'un chiffre
	 */
	public function niveau() {
		return $this->idNiveau ; 
	}
	/**
	 * Retourne un mot descriptif pour le niveau de l'utilisateur
	 */
	public function niveauDesc() {
		switch ($this->idNiveau) {
			case 1 : 
				return 'Invité' ; 
				break ; 
			case 2 : 
				return 'Membre' ; 
				break ; 
			case 3 : 
				return 'Bureau' ;
				break ;
			case 4 : 
				return 'Administrateur' ;
				break ;
		}
	}
	/**
	 * Méthode de test qui affiche toutes les informations d'un utilisateur
	 */
	public function profil(){
		$profil =<<<HTML
		<div>
			<p>Nom : {$this->nomPers}</p>
			<p>Prénom : {$this->prenomPers}</p>
			<p>Login : {$this->login}</p>
			<p>Mail : {$this->adressMailPers}</p>
			<p>Adresse : {$this->adressPers}</p>
			<p>Ville : {$this->villePers}</p>
			<p>CP : {$this->cpPers}</p>
			<p>Niveau : {$this->idNiveau}</p>
			<p>Commentaire : {$this->commentaire}</p>
		</div>
HTML;
		return $profil;
	}
	
	/**
	 * Retourne le code HTML d'un formulaire de deconnexion
	 */
	public static function logoutForm($action, $text = "Deconnexion") {
		$deco = <<<HTML
		<form id="deco" name="logout" action="{$action}" method="post" >
			<button type="submit" id="decoB" name="logout">{$text}</button>
		</form>
HTML;
		
		return $deco;
	}
	/**
	 * Retourne un formulaire de test d'inscription
	 */
	public static function signIn($action, $submitText="S'inscrire") {
		$form = <<<HTML
	<form action ="{$action}" method="post" id="inscription" class="forms">
		<h2>Inscription</h2>
		<fieldset>
			<legend>Identité</legend>
			<ul>
				<li>
					<label for="nom">Nom</label>	
					<input type="text" id="nom" name="nom">	
				</li>
				<li>
					<label for="prenom">Prénom</label>
					<input type="text" id="prenom" name="prenom">
				</li>
				<li>
					<label for="login">Login</label>
					<input type="text" id="login" name="login">
				</li>
				<li>
					<label for="password">Mot de passe</label>
					<input type="password" id="mdp" name="mdp">
				</li>	
				<li>
					<label for="email">E-Mail</label>
					<input type="text" id="mail" name="mail" placeholder="exemple.domaine.com">
				</li>
			<ul>
		</fieldset>
		<fieldset>
			<legend>Adresse postale</legend>
			<ul>
				<li>
					<label for="adresse">Adresse</label>
					<textarea type="text" id="adresse" name="adresse" rows=2></textarea>
				</li>
				<li>
					<label for="ville">Ville</label>
					<input type="text" id="ville" name="ville">
				</li>
				<li>
					<label for="CP">Code postal</label>
					<input type="text" id="CP" name="CP">
				</li>
			</ul>
		</fieldset>
		<fieldset>		
			<legend>Commentaire</legend>
			<ul>
				<li>
					<textarea type"text" id="commentaire" name="commentaire" rows=3></textarea>
				</li>
			</ul>
		</fieldset>
		<div class = "messagesinsc">
		</div>
		<fieldset>
			<input type="submit" name="{$submitText}">
		</fieldset>
	</form>
HTML;
		return $form;
	}
	/**
	 * Méthode qui permet d'ajouter un utilisateur dans la base de données
	 * IMPORTANT : je pense que le paramètre $niveau est temporaire, à voir à l'avenir
	 * @param le niveau de l'utilisateur à ajouter
	 */ 
	public static function ajoutUtilisateur($niveau) {
		if (!isSet($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['mdp'],
			$_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['CP'], $_POST['commentaire'])) {
			return "";
		} else {
			//informations
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$login = $_POST['login'];
			$mdp = $_POST['mdp'];
			$mail = $_POST['mail'];
			$adresse = $_POST['adresse'];
			$ville = $_POST['ville'];
			$cp = $_POST['CP'];
			$com = $_POST['commentaire'];
			$pdo = myPDO::getInstance();
	/* Section ajout de personne */
			$request = $pdo->prepare(<<<SQL
							INSERT INTO personne (idPers, nomPers, prenomPers, adressMailPers, adressPers, villePers, cpPers) 
							VALUES (NULL, :nom , :prenom, :mail, :adresse, :ville, :cp);			
SQL
			);
			$r1 = $request->execute(array(':nom' => $nom, ':prenom' => $prenom, ':mail' => $mail, 
							  ':adresse'=>$adresse, ':ville'=>$ville, ':cp'=>$cp));
	/* Section ajout d'un utilisateur */
			$request = $pdo->prepare(<<<SQL
			INSERT INTO utilisateur (idPers, idNiveau, commentaire, login, mdp)
							VALUES (NULL, :niveau, :commentaire, :login, :mdp);
SQL
			);
			
			$r2 = $request->execute(array(':login'=>$login, ':niveau'=>$niveau, ':commentaire'=>$com, ':mdp'=>sha1($mdp)));
	/* Test */
			if ($r1 && $r2) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	//si session id ==" " tester headers sent :: + robuste //// si session deja démarée :: ne rien faire
	public static function startSession() {
		if (session_id()=="") {
			if (headers_sent()) {
				throw new SessionException("La session ne peut pas être démarrée, les entêtes HTTP sont déjà loin :) !");	
            } else {
				session_start();
			}
		}	
	}
	
	/**
	 * Cette fonction permet de savoir si le login passé en paramètre existe déjà
	 * @param : le login recherché
	 */
    public static function chercherLogin($login) {
		$pdo = myPDO::getInstance();
		$request = $pdo->prepare(<<<SQL
					SELECT idPers
					FROM utilisateur
					WHERE login = :login
SQL
		);
        $request->execute(array(':login'=>$login));

        return $request->fetch() ;
       
	}
    public static function isConnected() {
        
        try {
            self::startSession();
        } catch (SessionException $e ) {
        }
		if (isSet($_SESSION['connected'])) {
			return true;
		} else {
			return false;
		}		
	}
	public static function logoutIfRequested() {			
		if (isSet($_POST['logout'])) {
			self::startSession();
			session_unset();
		}				
	}
	public function saveIntoSession() {
        self::startSession();
        if (isSet($_SESSION['connected'])) {
			$_SESSION['utilisateur'] = $this ;
		}
	}
	public static function createFromSession() {
		self::startSession();
		if (isSet($_SESSION['utilisateur'])) {
			
			return $_SESSION['utilisateur'];
		} else {
			throw new notInSessionException("La variable de session 'utilisateur' n'est pas initialisée !");
		}
	}
	public static function randomString($size) {
		$res = "";
		
		for ($i = 0 ; $i<$size ; $i++) {
			$randomMinuscule = rand(97,122);
			$randomMajuscule = rand(65,90);
			$randomChiffre = rand(49,57);
			$ternaire = rand(1,3);
		
			switch ($ternaire) {
			case 1:
				$res .= chr($randomMinuscule);
				break;
			case 2:
				$res .= chr($randomMajuscule);
				break;
			case 3:
				$res .= chr($randomChiffre);
				break;
			}
		}
		return $res;
	}
	public static function loginFormSHA1($action, $submitText = 'OK') {
        
	    self::startSession();
       $_SESSION[self::session_key]['challenge'] = self::randomString(20) ;
		$html = <<<HTML
<script type='text/javascript' src='js/sha1.js'></script>
<script type='text/javascript'>
	function cryptage(form, challenge) {
		if (form.login.value.length && form.pass.value.length) {
			form.code.value = SHA1(SHA1(form.pass.value)+challenge+SHA1(form.login.value)) ;
            form.login.value = form.pass.value = '' ;
			return true;
		}
		return false ;
	}
</script>
<form action="{$action}" method="post"  onSubmit="return cryptage(this, '{$_SESSION[self::session_key]['challenge']}')" id = "connexion" class="forms">
			
				<h2>Connexion</h2>
				<fieldset>
					<legend></legend>
					<ul>
						<li>
							<label for="login">Login</label>
							<input type="text" id="loginCo" name="login" placeholder="login">
						</li>
						<li>
							<label for="pass">Mot de passe</label>
							<input type="password" id="passCo" name="pass" placeholder="mot de passe">
							<input type='hidden' id ="code" name='code'>
						</li>
					</ul>
				</fieldset>
				<div class = "messagesCo">
				</div>
				<fieldset>
					<input type="submit" value="{$submitText}">
				</fieldset>
			</form>
</form>
HTML;
		return $html;		
	}
	public static function createFromAuthSHA1($data) {
		
		if (isset($data['code'])) {
            self::startSession();
            $pdo = myPDO::getInstance(); 
            $requete = $pdo->prepare(<<<SQL
                            SELECT p.idPers, p.nomPers, p.prenomPers, p.adressMailPers, 
                            p.adressPers, p.villePers, p.cpPers, u.commentaire, u.login, u.idNiveau
                            FROM utilisateur u , personne p 
                            WHERE u.idPers = p.idPers
                            AND SHA1(CONCAT(u.mdp, :challenge, SHA1(u.login))) = :code
SQL
		);
		
            $requete->execute(array(':challenge' => $_SESSION[self::session_key]['challenge'], 
                                    ':code' => $data['code']));
            $requete->setFetchMode(PDO::FETCH_CLASS, 'utilisateur') ;
            
            
            if (($user = $requete->fetch()) !== false) {
                self::startSession();
                $_SESSION['connected']=true;
                return $user ;
            } else {
                throw new AuthenticationException("Login ou mot de passe incorrect !!") ;
            }

        } else { 
            throw new AuthenticationException("login ou mdp non renseigné") ;
    }
    }
    public static function unsetChallenge(){
        if(isSet($_SESSION[self::session_key]['challenge'])) unset($_SESSION[self::session_key]['challenge']);
    }

    public static function getAll() {
        $users = array() ;
        $request = myPDO::getInstance()->prepare(<<<SQL
               SELECT p.idPers, p.nomPers, p.prenomPers, p.adressMailPers, 
               p.adressPers, p.villePers, p.cpPers, u.commentaire, u.login, u.idNiveau
               FROM utilisateur u , personne p 
               WHERE u.idPers = p.idPers
               ORDER BY 1
SQL
    );
        $request->execute() ; 
        
         while (($data = $request->fetch()) !== false) {
             array_push($users, self::createFromID($data['idPers']));
         }

        return $users ; 

    }

    public static function createFromID($id) {
        $rq = myPDO::getInstance()->prepare(<<<SQL
            SELECT p.idPers, p.nomPers, p.prenomPers, p.adressMailPers, 
            p.adressPers, p.villePers, p.cpPers, u.commentaire, u.login, u.idNiveau
            FROM utilisateur u , personne p 
            WHERE u.idPers = p.idPers
            AND p.idPers = :id
            ORDER BY 1
SQL
    );
        $rq->execute(array(':id' => $id)) ;
        $rq->setFetchMode(PDO::FETCH_CLASS, 'utilisateur');

        if(($obj = $rq->fetchAll()) !== false) return $obj;

    }

    public static function deleteFromID($id) {
        $rq = myPDO::getInstance()->prepare(<<<SQL
                    DELETE FROM utilisateur
                    WHERE idPers = :id 
SQL
    );
        $succes1 = $rq->execute(array(':id'=>$id)) ; 

        $rq = myPDO::getInstance()->prepare(<<<SQL
                    DELETE FROM personne
                    WHERE idPers = :id 
SQL
    );
        $succes2 = $rq->execute(array(':id'=>$id)) ; 

        return $succes1&&$succes2 ; 

    }
}
