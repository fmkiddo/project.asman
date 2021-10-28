<?php
namespace App\Libraries\Core;


class Asset extends Objects {
	
	private $assetName = '';
	private $assetType;
	
	public function __construct($value, $type, $name='') {
		parent::__construct($value);
		$this->assetType = $type;
		$this->assetName = $name;
	}
	
	public function getName () {
		$theName = $this->assetName;
		return $theName;
	}
	
	public function getType () {
		$theType = $this->assetType;
		return $theType;
	}
}