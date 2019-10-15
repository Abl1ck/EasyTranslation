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

class PDOConnection extends EasyTranslation{
/* DATABASE CONFIGURATION */
const YOUR_DB_HOST = 'localhost';
const YOUR_DB_USERNAME = 'root';		//
const YOUR_DB_PASSWORD = 's';
const YOUR_DB_NAME = 'exemple';

    public function __construct() {
		$this->setLanguage();							//ISO 639-1 2-character language (e.g. French is "fr")
		self::cnx();
    }
	
	private function cnx(){
		$dbhost = self::YOUR_DB_HOST;
		$dbname = self::YOUR_DB_NAME;
		
		try {
			$dbConnection = new \PDO("mysql:host=$dbhost;dbname=$dbname", self::YOUR_DB_USERNAME, self::YOUR_DB_PASSWORD);
			$dbConnection->exec("set names utf8");
			$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, EPDO::ERRMODE_EXCEPTION);
			return $dbConnection;
		}catch (\PDOException $e) {
			echo $this->translate('connect_host');
		}
	}
	
}

new PDOConnection();

?>