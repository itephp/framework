<?php

/**
 * ItePHP: Framework PHP (http://itephp.com)
 * Copyright (c) NewClass (http://newclass.pl)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the file LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) NewClass (http://newclass.pl)
 * @link          http://itephp.com ItePHP Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace ItePHP\Core;

/**
 * Snippet for validator
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class ValidatorSnippet {
	
	/**
	 * Execute validator
	 *
	 * @param Container $container
	 * @param string $validatorName
	 * @param mixed $value
	 * @return string
	 */
	public function validate(Container $container,$validatorName,$value){
		$validator=new $validatorName();
		return $container->getService('validator')->validate($validator,$value);
	}
}
