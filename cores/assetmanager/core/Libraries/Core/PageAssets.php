<?php
namespace App\Libraries\Core;


class PageAssets {
	
	private $assets;
	
	public function __construct($params) {
		$this->assets = NULL;
		
		if (array_key_exists('assetUrl', $params)) {
			$this->assets = [];
			
			$assetURL = base_url($params['assetUrl']);
			if (array_key_exists('vendorFolder', $params)) {
				$vendorURL = $assetURL . $params['vendorFolder'];
				$vendorAssets = $params['vendorassets'];
				foreach ($vendorAssets['styles'] as $style) {
					$styleAsset = new \App\Libraries\Core\Asset($vendorURL . $style, 'stylesheets');
					array_push($this->assets, $styleAsset);
				}
				
				foreach ($vendorAssets['scripts'] as $script) {
					$scriptAsset = new \App\Libraries\Core\Asset($vendorURL . $script, 'scripts');
					array_push($this->assets, $scriptAsset);
				}
			}
			
			if (array_key_exists('assetFolder', $params)) {
				$webassetURL = $assetURL . $params['assetFolder'];
				$webassets = $params['webassets'];
				foreach ($webassets['styles'] as $style) {
					$styleAsset = new \App\Libraries\Core\Asset($webassetURL . $style, 'stylesheets');
					array_push($this->assets, $styleAsset);
				}
				
				foreach ($webassets['scripts'] as $script) {
					$scriptAsset = new \App\Libraries\Core\Asset($webassetURL . $script, 'scripts');
					array_push($this->assets, $scriptAsset);
				}
			}
		}
	}
	
	public function getStyles (): array {
		$array = [];
		foreach ($this->assets as $asset):
			if ($asset->getType () === 'stylesheets'):
				array_push($array, $asset);
			endif;
		endforeach;
		return $array;
	}
	
	public function getScripts (): array {
		$array = [];
		foreach ($this->assets as $asset):
			if ($asset->getType () === 'scripts'):
				array_push ($array, $asset);
			endif;
		endforeach;
		return $array;
	}
}