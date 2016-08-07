<?php

namespace Asset\Command;

use ItePHP\Command\OutputStream;

class OutputStreamTest implements OutputStream{

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
     *
     * @param string
     */
	public function getBuffer(){
		return $this->buffer;
	}

    /**
     * {@inheritdoc}
     */
	public function flush(){
	}
}