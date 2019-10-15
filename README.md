# EasyTranslation

 A simple php class helping to build multilingual websites or apps.

Features:  

- Compatible with PHP 5.5 and later
- Namespaced to prevent name clashes
- client language autodetection
- allow to format messages in JSON format
- allows to force a different language for an specific block of the sites or apps
- loads language data only once - no memory waste
- Error messages in 2 languages and allows users to add more compatible languages

Author: [Alvin Mambele](https://github.com/Easysoft-cd)

## License
This software is distributed under the [LGPL 3.0](https://www.gnu.org/licenses/lgpl-3.0.html) license, along with the [GPL Cooperation Commitment](https://gplcc.github.io/gplcc/). Please read LICENSE for information on the software availability and distribution.

## Why you might need it
To avoid long preparation of error messages that you should use in your website or application, EasyTranslation can be used and saves your time.

In addition to this, EasyTranslation offers the ability to format your Exceptions messages to JSON format.

## A Simple Example
```php
<?php
// Import EasyTranslation namespace at the top of your script,
// to prevent the execution error
use EasyTranslation\EasyTranslation\EasyTranslation;

include('src/EasyTranslation.php');

class Example extends EasyTranslation{

    public function __construct() {
		$this->setLanguage();	// Set a language or by default will check for client language (e.g. French is "fr")
		echo $this->translate('Welcome');
    }
}

new Example();
```

Copyright: Copyright © 2019 Easysoft CD

License: The GPL License (GPL)
