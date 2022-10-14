<?php
namespace App\Libraries;

class DocumentType {
	
	private $types = [];
	
	public function __construct ($types = []) {
		$this->types = $types;
	}
	
	public function addType ($id, $value) {
		$this->types[$id] = $value;
	}
	
	public function getType ($id, $locale='id') {
		if (!array_key_exists($id, $this->types)) return '--- not found ---';
		return $this->types[$id][$locale];
	}
}
