<?php

namespace Test\Error;

use ItePHP\Error\ErrorManager;
use Test\Asset\Error\TestHandler;

class ErrorManagerTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var ErrorManager
     */
	private $errorManager;

	protected function setUp(){
		$this->errorManager=new ErrorManager();
	}

	public function testGetHandlers(){

		$handler=new TestHandler();
		$this->errorManager->addHandler($handler);
		$handlers=$this->errorManager->getHandlers();
		$this->assertCount(1,$handlers);

		$this->assertEquals(spl_object_hash($handler),spl_object_hash($handlers[0]));

	}

	public function testRemoveHandler(){

		$handler=new TestHandler();
		$this->errorManager->addHandler($handler);
		$this->errorManager->removeHandler($handler);
		$handlers=$this->errorManager->getHandlers();
		$this->assertCount(0,$handlers);


	}

	public function testException(){

		$handler=new TestHandler();
		$this->errorManager->addHandler($handler);

		ob_start();
		$this->errorManager->exception(new \Exception('test'));
		$result=ob_get_clean();
		ob_flush();

		$this->assertEquals('test',$result);


	}

}