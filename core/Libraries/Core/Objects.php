<?php
namespace App\Libraries\Core;


abstract class Objects implements Printable {
	
	private $value;
	
	public function __construct($value) {
		$this->value = $value;
	}
	
	public function print() {
		echo $this->value;
	}
	
	public function getValue () {
		$theValue = $this->value;
		return $theValue;
	}
}