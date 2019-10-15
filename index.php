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

include('src/EasyTranslation.php');

class Example extends EasyTranslation{

    public function __construct() {
		$this->setLanguage();							//ISO 639-1 2-character language (e.g. French is "fr")
		echo $this->translate('Welcome');
    }
}

new Example();

?>