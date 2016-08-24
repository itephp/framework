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

namespace ItePHP\Test;

/**
 * Throw when BorwserEmulator detect invalid field name in form.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class InvalidFieldNameException extends \Exception{

    /**
     * Constructor.
     */
    public function __construct(){
        parent::__construct("Invalid field name");
    }
}