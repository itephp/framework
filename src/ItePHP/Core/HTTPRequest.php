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

use ItePHP\Provider\Session;
use ItePHP\Component\Form\FileUploaded;
use Pactum\ConfigContainer;

/**
 * Provider for request.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class HTTPRequest implements Request{

	/**
	 *
	 * @var string[]
	 */
	private $data=[];

	/**
	 *
	 * @var string[]
	 */
	private $query=[];

	/**
	 *
	 * @var Session
	 */
	private $session;

	/**
	 *
	 * @var mixed[]
	 */
	private $arguments=[];

	/**
	 *
	 * @var string
	 */
	private $url;

	/**
	 *
	 * @var string[]
	 */
	private $headers=[];

	/**
	 *
	 * @var string
	 */
	private $clientIp;

	/**
	 *
	 * @var mixed[]
	 */
	private $files=[];

	/**
	 *
	 * @var ConfigContainer
	 */
	private $config;

	/**
	 *
	 * @param string $url
	 * @param Session $session
	 */
	public function __construct($url,Session $session){
		$this->url=$url;
		$this->session=$session;
		$this->prepare();

	}

    /**
     * {@inheritdoc}
     */
	public function getFile($name){
		if(!isset($this->files[$name])){
			throw new FileNotUploadedException($name);
		}

		return $this->files[$name];
	}

    /**
     * {@inheritdoc}
     */
	public function getUrl(){
		return $this->url;
	}

    /**
     * {@inheritdoc}
     */
	public function getType(){
		return $_SERVER['REQUEST_METHOD'];
	}

    /**
     * {@inheritdoc}
     */
	public function getHeader($name){
		if(!isset($this->headers[strtolower($name)])){
			throw new HeaderNotFoundException($name);			
		}
			
		return $this->headers[strtolower($name)]; 
	}

    /**
     * {@inheritdoc}
     */
	public function getBody(){
		return file_get_contents('php://input');
	}

    /**
     * {@inheritdoc}
     */
	public function setArgument($name,$value){
		$this->arguments[$name]=$value;
	}

    /**
     * {@inheritdoc}
     */
	public function getArguments(){
		return $this->arguments;
	}

    /**
     * {@inheritdoc}
     */
	public function removeArgument($name){
		unset($this->arguments[$name]);
	}

    /**
     * {@inheritdoc}
     */
	public function getSession(){
		return $this->session;
	}

    /**
     * {@inheritdoc}
     */
	public function getConfig(){
		return $this->config;
	}

    /**
     * {@inheritdoc}
     */
	public function setConfig(ConfigContainer $config){
		$this->config=$config;
	}

    /**
     * {@inheritdoc}
     */
	public function getData(){
		return $this->data;
	}

    /**
     * {@inheritdoc}
     */
	public function getQuery(){
		return $this->query;
	}

    /**
     * {@inheritdoc}
     */
	public function getHost(){
		return $_SERVER['HTTP_HOST'];
	}

    /**
     * {@inheritdoc}
     */
	public function getProtocol(){
		return $_SERVER['SERVER_PROTOCOL'];
	}

    /**
     * {@inheritdoc}
     */
	public function isSSL(){
		return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) 
			&& $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) 
			&& $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') || (isset($_SERVER['HTTP_X_SSL_CIPHER'])));
	}

    /**
     * {@inheritdoc}
     */
	public function isAjax(){
		try{
			return strtolower($this->getHeader('x-requested-with'))=='xmlhttprequest';
		}
		catch(HeaderNotFoundException $e){
			return false;
		}

	}

    /**
     * {@inheritdoc}
     */
	public function getClientIp(){
		return $this->clientIp;
	}

    /**
     * {@inheritdoc}
     */
	public function isFullUploadedData(){
		return !(isset($_SERVER['CONTENT_LENGTH']) 
			&& (int) $_SERVER['CONTENT_LENGTH'] > $this->phpSizeToBytes(ini_get('post_max_size')));
	}

    /**
     *
     * @param mixed $size
     * @return int
     */
	private function phpSizeToBytes($size){  
		if (is_numeric( $size)){
			return $size;
		}
		$suffix = substr($size, -1);
		$value = substr($size, 0, -1);
		switch(strtolower($suffix)){
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'p':
				$value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 't':
				$value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
			case 'g':
				$value *= 1024;
            /** @noinspection PhpMissingBreakStatementInspection */
			case 'm':
				$value *= 1024;
			case 'k':
				$value *= 1024;
				break;
		}
		return $value;  
	}

    /**
     *
     */
	private function prepare(){
		$this->data=$_POST;
		$this->query=$_GET;

		foreach($_FILES as $kFile=>$file){
			$fileData=null;
			if(is_array($file['name'])){ //multiple files
				$fileData=[];
				for($i=0; $i<count($file['name']); $i++){
					if($file['tmp_name'][$i]==''){
						continue;
					}

					$metadata=[
						'name'=>$file['name'][$i]
						,'tmp_name'=>$file['tmp_name'][$i]
						,'error'=>$file['error'][$i]
						,'size'=>$file['size'][$i]
						,'type'=>$file['type'][$i]
                    ];
					$fileData[]=new FileUploaded($metadata);
				}
			}
			else{
				if($file['tmp_name']==''){
					continue;
				}
				$fileData=new FileUploaded($file);
			}
			$this->files[$kFile]=$fileData;


		}

		foreach ($_SERVER as $name => $value) { 
			if(substr($name, 0, 5) == 'HTTP_'){ 
				$name = strtolower(str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($name, 5))))); 
				$this->headers[$name] = $value; 
			}
			else if ($name == "CONTENT_TYPE"){ 
				$this->headers["content-type"] = $value; 
			}
			else if ($name == "CONTENT_LENGTH"){ 
				$this->headers["content-length"] = $value; 
			}
		}

		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$this->clientIp = $_SERVER['HTTP_CLIENT_IP'];
		}
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$this->clientIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$this->clientIp = $_SERVER['REMOTE_ADDR'];
		}		
	}
}