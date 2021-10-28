<?php
namespace App\Controllers;


class SystemSetupController extends BaseController {
	
	protected function additionalInitialization() {
		$this->helpers = ['cookie', 'url_helper'];
		$this->assets = [
			'assetUrl'		=> '/assets',
			'assetFolder'	=> '/web',
			'webassets'		=> [
				'styles'		=> [
					'/css/style.setup.css'
				],
				'scripts'		=> [
					'/js/functions.js',
					'/js/script.setup.js'
				]
			],
			'vendorFolder'		=> '/vendors',
			'vendorassets'		=> [
				'styles'			=> [
					'/bootstrap/css/bootstrap.css',
					'/fontawesome/css/all.css',
					'/now-ui/css/now-ui-dashboard.css'
				],
				'scripts'			=> [
					'/jquery/jquery-3.5.1.js',
					'/bootstrap/js/bootstrap.js',
					'/fontawesome/js/all.js',
					'/now-ui/js/now-ui-dashboard.js'
				]
			]
		];
	}
	
	public function firstTimeSetup () {
		$cookie = get_cookie(CLIENT_CONFIG_NAME);
		if ($cookie == NULL) return $this->response->redirect(base_url($this->locale . '/assets/user-login'), 'GET');
		else {
			$options = $this->getPageOptions();
			return view ('frontpage/firsttime-setup', $options);
		}
	}
	
	public function doFirstTimeSetup () {
		if ($this->request->getMethod(TRUE) !== 'PUT') {
			$response = [
				'status'	=> '404',
				'message'	=> 'Page Not Found!'
			];
		} else {
			$cookie = get_cookie(CLIENT_CONFIG_NAME);
			if ($cookie == NULL) $response = ['status' => 401, 'message' => 'Unauthorized System Access!'];
			else {
				$json = $this->request->getJSON(TRUE);
				if ($json['trigger'] !== 'firsttime-setup') $response = ['status' => 401, 'message' => 'Unauthorized System Access'];
				else {
					$data = $json['transmit'];
					$curlData = [];
					foreach ($data as $asData) if ($asData['name'] !== 'confirm-password') $curlData[$asData['name']] = $asData['value'];
					
					$curlOptions = [
						'auth'		=> [
							$cookie,
							'',
							'basic'
						],
						'headers'	=> [
							'Accept'	=> 'application/json',
							'Content-Type'	=> 'application/json'
						],
						'json'		=> [
							'data-trigger'	=> 'power-overwhelming',
							'data-transmit'	=> $curlData
						]
					];
					$curlService = \Config\Services::curlrequest();
					$serverResponse = $curlService->put (server_url('api/client-setup'), $curlOptions);
					$response = json_decode($serverResponse->getBody (), TRUE);
				}
			}
		}
		$this->response->setJSON ($response);
		$this->response->send ();
	}
}