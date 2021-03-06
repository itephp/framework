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

namespace ItePHP\Command;

/**
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class OutputStreamConsole implements OutputStream{

	/**
	 *
	 * @param string
	 */
	private $buffer="";

    /**
     * {@inheritdoc}
     */
	public function write($data){
		$this->buffer.=$data;
	}

    /**
     * {@inheritdoc}
     */
	public function flush(){
		echo $this->buffer;
		$this->buffer="";
	}
}