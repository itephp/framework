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

namespace ItePHP\Component\Form;

/**
 * Support for uploaded file.
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class FileUploaded{

	/**
	 * File name.
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * File name in tmp dir.
	 *
	 * @var string $tmpName
	 */
	private $tmpName;

	/**
	 * Error code
	 *
	 * @var int $error
	 */
	private $error;

	/**
	 * File size in bytes.
	 *
	 * @var int $size
	 */
	private $size;

	/**
	 * Mime type file.
	 *
	 * @var string $extension
	 */
	private $extension;

	/**
	 * Constructor.
	 *
	 * @param mixed[] $data
	 */
	public function __construct($data){
		$this->name=$data['name'];
		$this->tmpName=$data['tmp_name'];
		$this->error=$data['error'];
		$this->size=$data['size'];

		if($this->tmpName){
			$fileInfo = new \finfo(FILEINFO_MIME);
			$this->extension=$fileInfo->buffer(file_get_contents($this->tmpName));			
		}
 
	}

	/**
	 * Save uploaded file to destiny dir
	 *
	 * @param string $path path dir to save file
	 * @param string $name file name if is empty then set name on origin name
	 * @throws FileFailSavedException
	 */
	public function save($path,$name=null){
		if(!file_exists($path)){
			mkdir($path,0777,true);
		}

		$destinationPath=rtrim($path, '/');
		if($name){
			$destinationPath.='/'.$name;
		}
		else{
			$destinationPath.='/'.$this->name;
		}

		if(!copy($this->tmpName, $destinationPath)){
			//detect error reason
			$reason='Unknown';
			if(!file_exists($path)){
				$reason='Path "'.$path.'" not exists.';
			}
			else if(!is_writeable($path))
				$reason='Path "'.$path.'" required permission to write.';

			throw new FileFailSavedException($reason);
		}
	}

	/**
	 * Return true if is has error on uploaded, else return false.
	 *
	 * @return boolean
	 * @since 0.12.0
	 */
	public function isError(){
		return $this->error!='0';
	}

	/**
	 * Return error message if fail uploaded.
	 *
	 * @return string
	 * @since 0.12.0
	 */
	public function getError(){
		return $this->error;
	}

	/**
	 * Get origin file name.
	 *
	 * @return string
	 * @since 0.12.0
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * Get file size in bytes.
	 *
	 * @return int
	 * @since 0.17.0
	 */
	public function getSize(){
		return $this->size;
	}

	/**
	 * Get file extension (mime/type).
	 *
	 * @return string
	 * @since 0.17.0
	 */
	public function getExtension(){
		return $this->extension;
	}
}
