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
// Import EasyTranslation namespace at the top of your script,
// to prevent the execution error
use EasyTranslation\EasyTranslation\EasyTranslation;

include('src/EasyTranslation.php');

class Example extends EasyTranslation{

    public function __construct() {
		$this->setLanguage();							// (e.g. French is "fr")
		echo $this->translate('Welcome');
    }
}

new Example();

?>