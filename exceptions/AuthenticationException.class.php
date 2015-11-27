<?php

class AuthenticationException extends Exception {

	/*public function __construct ($message, $code = 0) {
		parent::__construct ($message, $code);
	}

	public function toString() {
		return __CLASS__ . " : {$this->message} , code : {$this->code} ";
	}
	
	//petit test
	public static function isUserReturned() {
		$user = User::createFromAuth(array ("login"=>"esos001", "pass"=>"coucou"));
		
		if ($user==null) {
			throw new AuthenticationException("Cet utilisateur n'existe pas, ou le mdp n'est pas correct", 0); 	
		} else {
			return "ok";
		}

	}*/
}


/*try {
	echo AuthenticationException::isUserReturned();
} catch (AuthenticationException $e) {
	echo $e->toString();
}*/



