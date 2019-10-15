<?php
#-------------------------------------------------------------------------------#
#																				#
# Interpreteur	: PHP 5															#
# Lincence		: GPL															#
# Version		: 1.0.1															#
# Auteur		: Alvin Mambele													#
# Pays			: R.D.Congo														#
# Copyright		: Copyright (C) 2019 Easysoft Cd. 								#
# 																	 			#
#-------------------------------------------------------------------------------#

namespace EasyTranslation\EasyTranslation;

include('Exception.php');

/**
 * EasyTranslation	: PHP Error translator class.
 *
 * @author  		: Alvin Mambele
 *
 * Pays				: R.D.Congo
 */
class EasyTranslation{
    /**
     * The array language to use if the selected language load.
     * @type array
     */
    private $language   = array();
	
    /**
     * The path for language file being used to translate.
     * @type string
     */
	private $lang_path	= '';
	
	/**
	 * Directory name of the locale files.
	 * @type string
	 */
	private static $langDir = 'languages';
	
    /**
     * The default language message to display if language file is not found.
     * @type array
     */
    private static $defaultLangMessage = array(
		'no_trans'		=> 'The translation required is not found',
		'no_file'		=> 'The language file is not found',
		'no_dir'		=> 'The directory language is not found'
	);
	
    /**
     * The default language to use if the selected language is not found.
     * @type string
     */
    private static $defaultLanguage = 'en';

    /**
     * The state of language loader.
     * @type bool
     */
    private $loadedlang = false;

    /**
     * Create the path for the selected language.
     *
     */
	private function createPath(){
		// Check if language directory exists before starting
		$this->checkIfLanguagesDirExists(self::$langDir);
		//self::$defaultLangMessage = include $this->lang_path . $file_name;

		//The path can be changed depending of the languages files location
		if(getcwd()){
			$this->lang_path = getcwd() . DIRECTORY_SEPARATOR . self::$langDir . DIRECTORY_SEPARATOR;
		}else{
			$this->lang_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . self::$langDir . DIRECTORY_SEPARATOR;
		}
	}
	
    /**
     * Set the language for error messages.
     * Returns false if it cannot load the language file.
     * The class default language is English.
     *
     * @param string $lang  ISO 639-1 2-character language (e.g. French is "fr")
     *
     * @return bool
     */
    public function setLanguage($sel_lang = ''){
		//Create the Path of the language file
		self::createPath();
        //RegEx for Validating the selected language
        if (preg_match('/^[a-z]{2}(?:_[a-zA-Z]{2})?$/', $sel_lang)) {
            $lang = $sel_lang;
        }else{
			$lang = self::getClientLanguage();
		}
		
		if(!$this->loadLocalLanguage('lang-' . $lang . '.php')){
			try {
				throw new EException($this->defaultLangMessage('no_file'));
			}catch(EException $e) {
				die($e->getMessage());
			}
			
		}
	}
	
    /**
     * Load the local language file.
     * Returns true or false if it can (or cannot) load the language file.
	 *
     * @param string $file_name
     *
     * @return bool
     */
	private function loadLocalLanguage($file_name){
		if (file_exists($this->lang_path . $file_name)) {
			include $this->lang_path . $file_name;
			$this->language = $EASY_LANG;	// Affect the array language found
			$this->loadedlang = true;
		} else {
			if (file_exists($this->lang_path . $this->defaultLangFile())){
				include $this->lang_path . $this->defaultLangFile();
				$this->language = $EASY_LANG;	// Affect the array language found
				$this->loadedlang = true;
			}else{
				$this->loadedlang = false;
			}
		}
        return (bool) $this->loadedlang; // Returns true or false if language is (or not) found
	}
	
	private function defaultLangFile(){
		return 'lang-' . self::$defaultLanguage . '.php';
	}
	
    /**
     * Allows for public access to get translate.
	 * To translate make sure to select a language, otherwise it will prompt the result in English
	 *
     * @param string $key
	 *
     * @return string
     */
    public function translate($keyword){
		if($this->loadedlang){
			if (array_key_exists($keyword, $this->language)) {
				return $this->language[$keyword];
			}else{
				try {
					throw new EException($this->defaultLangMessage('no_trans'));
				}catch(EException $e) {
					die($e->getMessage());
				}
			}
		}else{
			try {
				throw new EException($this->defaultLangMessage('no_file'));
			}catch(EException $e) {
				die($e->getMessage());
			}
		}
    }	
	 
	 /**
     * Checks if locale dir exists. If not, throws an exception.
     * @throws Exception
     */
    private function checkIfLanguagesDirExists($dir){
        if (is_dir($dir)){
			return true;
        } else{
			try {
				throw new EException($this->defaultLangMessage('no_dir'));
			}catch(EException $e) {
				die($e->getMessage());
			}
		}
    }
	
    /**
     * Returns the client language code.
     * @return string|null Returns the ISO-639 Language Code followed by ISO-3166 Country Code, like 'en-US'.
     */
    private function getClientLanguage(){
        return (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : null;
    }
	
	private function defaultLangMessage($keyWord){
		return self::$defaultLangMessage[$keyWord];
	}
}

?>