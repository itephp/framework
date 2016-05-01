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
use ItePHP\Component\Form\FormBuilder;

/**
 * Implementation for auto generate field list in FormBuilder
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 * @since 0.18.0
 */
interface Designer{
	
	/**
	 * Method with rules create field for FormBuilder
	 *
	 * @param ItePHP\Component\Form\FormBuilder $formBuilder
	 * @since 0.18.0
	 */
	public function build(FormBuilder $formBuilder);
}