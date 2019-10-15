<?php
#-------------------------------------------------------------------------------#
#																				#
# Interpreteur	: PHP 5															#
# Lincence		: GPL															#
# Version		: 1.0.1															#
# Auteur		: Alvin Mambele													#
# Pays			: R.D.Congo														#
# Copyright		: Copyright (C) 2019 Easysoft Cd.								#
# 																	 			#
#-------------------------------------------------------------------------------#
namespace EasyTranslation\EasyTranslation;


class EException extends \Exception{
    /**
     * The array to use for the JSON message.
     * @type array
     */
	private $JSONmessage	= array();
	
    /**
     * The string full text message.
     * @type string
     */
	private $FullTextmessage	= '';
	
	// Redefine the exception so message isn't optional
    public function __construct($message, $format = 'text', $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
		switch(strtolower($format)){
			case 'json':
				$this->JSONmessage = array("MESSAGE"=>$message);
			break;
		}
    }

    public function getJSONMessage() {
        return json_encode($this->JSONmessage);
    }	
	
}

?>