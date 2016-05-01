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

namespace ItePHP\Validator;
use ItePHP\Core\Validator;
use ItePHP\Exception\ValueNotFoundException;

/**
 * Validator for telephone
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 * @since 0.24.0
 */
class TelephoneValidator extends Validator{

	/**
	 * {@inheritdoc}
	 */
	public function validate($value){

		$empty=false;

		try{
			$empty=$this->getOption('empty');
		}
		catch(ValueNotFoundException $e){
			//ignore
		}

		if(!$value && $empty){
			return;
		}

		if(!preg_match("/^[1-9][0-9]{8}$/",$value))
			return "Invalid telephone format.";
	}
	
}