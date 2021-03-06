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

namespace Test\Asset\Action\ArgumentEvent;

use ItePHP\Mapper\MapperAbstract;

/**
 * Base class for mapper. Cast value to another value.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class NumberMapper extends MapperAbstract{

    /**
     * {@inheritdoc}
     */
	public function cast($value){
		if(!is_numeric($value)){
			throw new \Exception('Invalid value '.$value.'.');
		}

		return $value+1;

	}

}