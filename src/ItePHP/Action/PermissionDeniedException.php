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

namespace ItePHP\Action;

use ItePHP\Core\Exception;

/**
 * Throw when event authorization can not allow access.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class PermissionDeniedException extends Exception{
	
	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct(311,'Permission denied');
	}
}
