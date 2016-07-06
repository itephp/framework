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

use ItePHP\Component\Form\FormFormatter;
use ItePHP\Component\Form\BasicFormFormatter;
use ItePHP\Provider\Request;
use ItePHP\Core\ValidatorService;
use ItePHP\Validator\TextValidator;

/**
 * FormBuilder field
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 * @since 0.15.0
 */
class TextField extends InputField{

    /**
     * {@inheritdoc}
     */
	public function __construct($options){
		$options['type']='text';

		if(!isset($options['validator'])){
			$this->setValidator(new TextValidator());
		}

		parent::__construct($options);
	}

}