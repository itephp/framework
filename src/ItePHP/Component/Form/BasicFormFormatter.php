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
 * Formatter for FormBuilder
 *
 * @author Michal Tomczak (michal.tomczak@itephp.com)
 */
class BasicFormFormatter implements FormFormatter{

    /**
     * {@inheritdoc}
     */
	public function renderField(FormField $field){
		$html=$field->render();
		return $html;
	}

    /**
     * {@inheritdoc}
     */
	public function renderFormBegin($tags){
		$template='<FORM ';
		foreach($tags as $kTag=>$tag){
			if($tag!='')
				$template.=$kTag.'="'.$tag.'" ';
		}

		$template.=' >';

		return $template;
	}

    /**
     * {@inheritdoc}
     */
	public function renderFormEnd(){
		return '</FORM>';
	}

    /**
     * {@inheritdoc}
     */
	public function renderSubmit($tags){
		$template='<BUTTON ';
		$value=$tags['value'];
		unset($tags['value']);

		foreach($tags as $kTag=>$tag){
			if($tag!='')
				$template.=$kTag.'="'.$tag.'" ';
		}

		$template.=' >'.$value.'</BUTTON>';

		return $template;

	}
}