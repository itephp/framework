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
use ItePHP\Validator\Email;

/**
 * @deprecated 0.18.0
 * @since 0.17.0
 */
class EmailOrEmpty extends Email{

	public function validate($value){
		if($value)
			return parent::validate($value);
	}
	
}