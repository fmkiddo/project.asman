<?php
namespace App\Libraries;


class DocumentStatus {
	
	private $icons = [
		0	=> 'fas fa-times fa-fw text-white`',
		1	=> 'fas fa-hourglass fa-fw text-dark',
		2	=> 'fas fa-check fa-fw text-white'
	];
	
	private $bgs = [
		0	=> 'bg-danger text-white',
		1	=> 'bg-warning text-dark',
		2	=> 'bg-info text-white',
		3	=> 'bg-secondary text-white',
		4	=> 'bg-success text-white',
		5	=> 'bg-light text-dark'
	];
	
	private $statusText = [];
	
	public function __construct($texts=[]) {
		$this->statusText = $texts;
	}
	
	public function getIcon ($input = 1) {
		if ($input >= 2) return $this->icons[2];
		else return $this->icons[$input];
	}
	
	public function getClass ($input = 1) {
		return $this->bgs[$input];
	}
	
	public function getStatusText ($input = 1) {
		return $this->statusText[$input];
	}
	
	public function isReceived ($input = 1) {
		return $input == 4;
	}
}