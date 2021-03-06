<?php

namespace Test\Action;

use ItePHP\Action\PermissionDeniedException;

class PermissionDeniedExceptionTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var PermissionDeniedException
     */
	private $exception;

	public function setUp(){
		$this->exception=new PermissionDeniedException();
	}
	
	public function testGetCode(){
		$this->assertEquals(311,$this->exception->getCode());
	}

	public function testGetMessage(){
		$this->assertEquals('Permission denied',$this->exception->getMessage());
	}

	public function testGetSafeMessage(){
		$this->assertEquals('Permission denied',$this->exception->getSafeMessage());
	}

}