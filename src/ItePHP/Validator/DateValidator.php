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

/**
 * Validator for date
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class DateValidator extends ValidatorAbstract{
	
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
			return null;
		}

		$d = \DateTime::createFromFormat('Y-m-d', $value);
	    if($d && $d->format('Y-m-d') == $value);
	    else
			return 'Invalid date format.';

        return null;
	}

}
