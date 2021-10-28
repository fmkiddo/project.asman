<?php
namespace App\Controllers;

use CodeIgniter\Controller;

// ClientKey Qf9XuqN/aDGeVlUV3BZ/0SaSv4almbUNcvxxn8BQl3Y=
// ClientCode osamjodex_617906f1d431f
// DBUser osam_jodexTH77
// DBPassword WZWntI6Nev8ONm6p

abstract class BaseController extends Controller {

	protected $helpers = [];
	protected $charset = 'UTF-8';
	protected $locale;
	protected $config;
	protected $pageData;
	protected $assets = [];
	private $pageAssets;
	
	private function runinit () {
		if (count ($this->helpers) > 0)
			helper($this->helpers);
		if (count ($this->assets) > 0) 
			$this->pageAssets = new \App\Libraries\Core\PageAssets($this->assets);
			
		$urlLocale = $this->request->getLocale();
		$this->locale = $urlLocale !== NULL ? $urlLocale : $this->request->getDefaultLocale();
		
	}
	
	protected function getPageAssets ($assetType=NULL) {
		if ($assetType === 'stylesheets') return $this->pageAssets->getStyles();
		elseif ($assetType === 'javascripts') return $this->pageAssets->getScripts();
		else return $this->pageAssets;
	}
	
	protected function getPageOptions () {
		$options = [];
		$options['locale'] = $this->locale;
		$options['charset'] = $this->charset;
		$options['pageAssets'] = $this->getPageAssets();
		return $options;
	}

	protected function additionalInitialization () { }
	
	protected function validateKey ($data): bool {
		$options	= [
			'auth'		=> [
				$data,
				'',
				'basic'
			],
			'headers'	=> [
				'Accept'		=> 'application/json',
				'Content-Type'	=> 'application/json'
			],
			'json'		=> [
				'client'		=> 'keycheck'
			]
		];
		$curl = \Config\Services::curlrequest();
		$serverResponse = $curl->put (server_url('api/clientkey-verification'), $options);
		return (json_decode($serverResponse->getBody (), TRUE)['message']);
	}
	
	protected function authenticate ($passData = array ()) {
		$options = [
			'auth'		=> [
				'fmkiddo_' . base64_encode(json_encode($passData)),
				'',
				'basic'
			],
			'header'	=> [
				'Accept'		=> 'application/json',
				'Content-Type'	=> 'application/json'
			]
		];
		
		$curl = \CodeIgniter\Config\Services::curlrequest();
		$serverResponse = $curl->put(server_url('api/client-authentication'), $options);
		return json_decode($serverResponse->getBody (), TRUE);
	}
	
	protected function dataRequest ($data = array(), $urlTraget='client/api/request-data', $curlType = 'JSON'): array {
		$cookieData = get_cookie(CLIENT_CONFIG_NAME);
		
		$curlOptions = [
			'auth'		=> [
				$cookieData,
				'',
				'basic'
			],
			'headers'	=> [
				'Accept'		=> 'application/json',
				'Content-Type'	=> 'application/json'
			]
		];
		switch ($curlType) {
			default: 
				$curlOptions['json'] = $data;
				break;
			case 'multipart':
				$curlOptions['multipart'] = $data;
				break;
		}
		
		$curl	= \CodeIgniter\Config\Services::curlrequest();
		$serverResponse = $curl->put(server_url($urlTraget), $curlOptions);
		$responseData = json_decode($serverResponse->getBody (), TRUE);
		$returnData = [];
		if ($responseData['status'] == 200) 
			$returnData = unserialize(base64_decode($responseData['message']));
		else $returnData = [];
		return $returnData;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \CodeIgniter\Controller::initController()
	 */
	public function initController(
			\CodeIgniter\HTTP\RequestInterface $request, 
			\CodeIgniter\HTTP\ResponseInterface $response, 
			\Psr\Log\LoggerInterface $logger) {
		parent::initController($request, $response, $logger);
		$this->config = \Config\Services::request()->config;
		$this->additionalInitialization();
		$this->runinit();
	}
	
}