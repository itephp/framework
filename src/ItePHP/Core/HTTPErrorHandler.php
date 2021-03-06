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

namespace ItePHP\Core;

use ItePHP\Error\ErrorHandler;
use ItePHP\Presenter\HTML as HTMLPresenter;
use Onus\ClassLoader;
use Pactum\ConfigContainer;

/**
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class HTTPErrorHandler implements ErrorHandler{
	
	/**
	 *
	 * @var ClassLoader
	 */ 
	private $classLoader;

	/**
	 *
	 * @var Request
	 */ 
	private $request;

	/**
	 *
	 * @param ClassLoader $classLoader
	 * @param Request $request
	 */
	public function __construct(ClassLoader $classLoader, Request $request){
		$this->classLoader=$classLoader;
		$this->request=$request;
	}

    /**
     * {@inheritdoc}
     */
	public function execute(\Exception $exception){
		if(!$this->classLoader->get('environment')->isSilent()){
			error_log($exception->getMessage()." ".$exception->getFile()."(".$exception->getLine().")");
		}

		$presenter=$this->getPresenter($this->request->getUrl());

		$response=new Response();
		$response->setStatusCode(500);
		$response->setContent($exception);
		if($exception instanceof HTTPException){
			$response->setStatusCode($exception->getStatusCode());
		}

		$event=new ExecutePresenterEvent($this->request,$response);
		$this->classLoader->get('eventManager')->fire('executePresenter',$event);

		$presenter->render($this->request,$response);

	}

	/**
	 *
	 * @param string $url
	 * @return Presenter
	 */
	private function getPresenter($url){
        /**
         * @var ConfigContainer $config
         */
        $config=$this->classLoader->get('config');
		foreach($config->getArray('error') as $error){
            /**
             * @var ConfigContainer $error
             */
			if(!preg_match('/^'.$error->getValue('pattern').'$/',$url)){
				continue;
			}
			$presenterName=$error->getValue('presenter');
            /**
             * @var Presenter $presenterObject
             */
            $presenterObject=$this->classLoader->get('presenter.'.$presenterName);
			return $presenterObject;
		}

		return new HTMLPresenter($this->classLoader->get('environment'));

	}

}