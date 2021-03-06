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

/**
 * Provider for session.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
interface SessionProvider{

	/**
	 * Get id session
	 *
	 * @return string
	 */
	public function getId();

	/**
	 * Get session value.
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Set session value.
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key,$value);

	/**
	 * Remove session value.
	 *
	 * @param string $key
	 */
	public function remove($key);

	/**
	 * Remove all session values.
	 */
	public function clear();

}