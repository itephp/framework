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

namespace ItePHP\Component\Form;

use ItePHP\Core\Exception;

/**
 * Throw when File is too large. Exception for FileValidator
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class FileMaxSizeException extends Exception{
	
	/**
	 * Constructor.
	 *
	 * @param int $maxSize
	 */
	public function __construct($maxSize){
		parent::__construct(17,'Max size for file is too large. Server limit: '.$maxSize.'.');
	}
}