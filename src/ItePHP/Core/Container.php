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

use Onus\ClassLoader;
use Onus\InstanceNotFoundException;
use Pactum\ConfigContainer;


/**
 * Container for snippets and services.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class Container{

	/**
	 *
	 * @var ClassLoader
	 */
	private $classLoader;

    /**
     * Constructor.
     *
     * @param ClassLoader $classLoader
     */
	public function __construct(ClassLoader $classLoader){

		$this->classLoader=$classLoader;
	}

	/**
	 * Get Environment
	 *
	 * @return Environment
	 */
	public function getEnvironment(){
		return $this->classLoader->get('environment');
	}

	/**
	 * Get Event manager
	 *
	 * @return EventManager
	 */
	public function getEventManager(){
		return $this->classLoader->get('eventManager');
	}

    /**
     *
     * @param string $name service name
     * @return object
     * @throws ServiceNotFoundException
     */
	public function getService($name){
		try{
			return $this->classLoader->get('service.'.$name);
		}
		catch(InstanceNotFoundException $e){
			throw new ServiceNotFoundException($name);
		}
	}

    /**
     * @return ConfigContainer
     */
    public function getConfig()
    {
        return $this->classLoader->get('config');
    }
}