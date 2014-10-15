<?php namespace Informulate\Core;

use App;

class upload{
	
	/*
	 * var $source
	 */	
	private $file;

	/*
	 * var $target
	 */	
	private $target;

	/*
	 * var $type
	 */	
	private $type;

	private allowedImageExt = array('.png','.jpg','jpeg');
	
	private allowedVideoExt = array();

	public function __construct($file,$target,$type){
		$this->file   = $file;
		$this->target = $target;
		$this->type   = $type;
	}

	public function upload(){
	//return Input::file('file')->move(__DIR__.'/storage/',Input::file('file')->getClientOriginalName());
	return $this->source->move($this->target,$this->file->getClientOriginalName());
	}
}
