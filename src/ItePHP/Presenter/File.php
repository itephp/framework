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

namespace ItePHP\Presenter;

use ItePHP\Core\Environment;
use ItePHP\Core\HeaderNotFoundException;
use ItePHP\Core\Presenter;
use ItePHP\Core\Request;
use ItePHP\Core\Response;

/**
 * Presenter for files.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class File implements Presenter{

    /**
     * @var Environment
     */
    private $environment;

    /**
     * File constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment=$environment;
    }

    /**
     * @param Request $request
     * @param Response $response
     */
	public function render(Request $request, Response $response){

	    if(!$this->environment->isSilent()){
            header('HTTP/1.1 '.$response->getStatusCode().' '.$response->getStatusMessage());
            foreach($response->getHeaders() as $name=>$value){
                header($name.': '.$value);
            }
        }


		if($response->getStatusCode()<299){

			$startRange=0;
			$endRange=filesize($response->getContent())-1;

			try{
				$contentRange=$response->getHeader('Content-Range');

				if(preg_match('/^bytes ([0-9]+)-([0-9]+)\/([0-9]+)$/',$contentRange,$match)){
					$startRange=(int)$match[1];
					$endRange=(int)$match[2];

				}

			}
			catch(HeaderNotFoundException $e){
				//skipp
			}

			$buffer = 1024 * 8;
			$file = @fopen($response->getContent(), 'rb');
			fseek($file, $startRange);
			while(!feof($file) && ($p = ftell($file)) <= $endRange) {
			    if ($p + $buffer > $endRange) {
			        $buffer = $endRange - $p + 1;
			    }
			    set_time_limit(0);
			    echo fread($file, $buffer);
			    flush();
			}
			 
			fclose($file);
		}
	}
}

