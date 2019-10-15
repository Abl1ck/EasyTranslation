<?php
#-------------------------------------------------------------------------------#
#																				#
# Interpreteur	: PHP 5															#
# Lincence		: GPL															#
# Version		: 1.0.1															#
# Auteur		: Alvin Mambele													#
# Pays			: R.D.Congo														#
# Copyright		: Copyright (C) 2019 Easysoft Cd. Tous droits reservés			#
# 																				#
#-------------------------------------------------------------------------------#
namespace EasyTranslation\EasyTranslation;

include('../src/EasyTranslation.php');

class loginExample extends EasyTranslation{
/* DATABASE CONFIGURATION */
const YOUR_DB_HOST = 'localhost';
const YOUR_DB_USERNAME = 'root';		//
const YOUR_DB_PASSWORD = '';
const YOUR_DB_NAME = 'exemple';

protected $cnx = '';

    public function __construct() {
		$this->setLanguage();				//Set the language (e.g. French is "fr")
		self::cnnx();
    }
	
	private function cnnx(){
		$dbhost = self::YOUR_DB_HOST;
		$dbname = self::YOUR_DB_NAME;
		
		try {
			$this->cnx = new \PDO("mysql:host=$dbhost;dbname=$dbname", self::YOUR_DB_USERNAME, self::YOUR_DB_PASSWORD);
			$this->cnx->exec("set names utf8");
			$this->cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $this->cnx;
		}catch (\PDOException $e) {
			echo $this->translate('connect_host');
		}
	}
	
	public function userLogin($usernameEmail, $password){
		try{
			$hash_password= hash('sha256', $password); //Password encryption 
			$stmt = $this->cnx->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");
			$stmt->bindParam("usernameEmail", $usernameEmail, \PDO::PARAM_STR) ;
			$stmt->bindParam("hash_password", $hash_password, \PDO::PARAM_STR) ;
			$stmt->execute();
			$count=$stmt->rowCount();

			$data=$stmt->fetch(\PDO::FETCH_OBJ);
			if($count){
				$_SESSION['uid']=$data->uid; // Storing user session value
				return true;
			}else{
				try {
					throw new EException($this->translate('user_connect'));
				}catch(EException $e) {
					die($e->getMessage());
				}
			}
		}catch(\PDOException $e) {
			switch($e->getCode()){
				case '42S02':
					echo $this->translate('no_table');
				break;
				case '42S22':
					echo $this->translate('no_fielad');
				break;
			}
		}	
	}
}

$login=new loginExample();
$login->userLogin('', '');
?>