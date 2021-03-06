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
 * Throw when controller does not have executed method.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class MethodNotFoundException extends Exception{
	
	/**
	 * Constructor.
	 *
	 * @param string $className
	 * @param string $methodName
	 */
	public function __construct($className,$methodName){
		parent::__construct(9,"Method '".$className."::".$methodName."' not found.","Internal server error.");
	}
}