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

use Pactum\ConfigContainer;

/**
 * Main class for project controllers
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
abstract class Controller{

	/**
	 * Request
	 *
	 * @var Request $request
	 */
	private $request;

	/**
	 * SessionProvider
	 *
	 * @var SessionProvider $session
	 */
	private $session;

	/**
	 *
	 * @var Container
	 */
	private $container;

	/**
	 * Constructor.
	 *
	 * @param Request $request
	 * @param Container $container
	 */
	public function __construct(Request $request,Container $container){
		$this->request=$request;
		$this->session=$request->getSession();
		$this->container=$container;
	}

	/**
	 *
	 * @return Request
	 */
	public function getRequest(){
		return $this->request;
	}

    /**
     * @return Environment
     */
    public function getEnvironment(){
        return $this->container->getEnvironment();
    }

    /**
     * @return ConfigContainer
     */
    public function getConfig(){
        return $this->container->getConfig();
    }
    
    /**
	 *
	 * @return SessionProvider
	 */
	public function getSession(){
		return $this->session;
	}

	/**
	 * Get Event manager
	 *
	 * @return EventManager
	 */
	public function getEventManager(){
		return $this->container->getEventManager();
	}

	/**
	 * Get service
	 *
	 * @param string $name service name
	 * @return object
	 */
	public function getService($name){
		return $this->container->getService($name);
	}

    /**
     * @param string $url
     * @return Response
     */
	public function redirect($url){
        $response=new Response();
        return $response->redirect($url);
    }

}
