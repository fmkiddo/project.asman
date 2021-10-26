<?php
namespace App\Controllers;


class FrontpageController extends BaseController {
	
	// osamjodex_6172d3b6dabf7
	
	const KEYCOOKIETIME	= 2147483647;
	private const token = 'fmkiddo'; 
	
	private function isUserLogged () {
		return get_cookie(CLIENT_USER_COOKIE) !== NULL;
	}
	
	private function clientCheck ($dataConfig) {
		$cookie = get_cookie(CLIENT_CONFIG_NAME);
		if ($cookie == NULL) return ['status' => 401, 'message' => 'Unauthorized Access'];
		else {
			$curlOptions	= [
				'auth'		=> [
					$cookie,
					'',
					'basic'
				],
				'headers'	=> [
					'Accept'		=> 'application/json',
					'Content-Type'	=> 'application/json'
				],
				'json'		=> $dataConfig
			];
			$curlService	= \Config\Services::curlrequest();
			$serverResponse	= $curlService->put (server_url ('api/client-check'), $curlOptions);
			return json_decode ($serverResponse->getBody (), TRUE);
		}
	}
	
	private function verifyClient () {
		$cookie = get_cookie(CLIENT_CONFIG_NAME);
		$response = [];
		if ($cookie == NULL) {
			$requestJSON	= $this->request->getJSON(TRUE);
			$configData		= [];
			foreach ($requestJSON as $data)
				switch ($data['name']) {
					default:
						break;
					case 'client-auth':
						$configData['clientcode'] = $data['value'];
						break;
					case 'client-pass':
						$configData['clientpasscode'] = $data['value'];
						break;
				}
			$authResponse	= $this->authenticate($configData);
			$response['response']	= $authResponse;
			if ($authResponse['status'] != 200)  $response['good'] = FALSE;
			else $response['good'] = TRUE;
		} else {
			$response	= [
				'good'		=> TRUE,
				'response'	=> [
					'status'	=> 202
				]
			];
		}
		return $response;
	}
	
	private function setupCookie ($status) {
		$response = [];
		if (!$status['good']) 
			$response	= [
				'status'	=> 400,
				'message'	=> 'Validated: FALSE!' . serialize($status['response'])
			];
		else {
			if ($status['response']['status'] == 200) {
				$cookieData = base64_encode(json_encode($status['response']['message'][1]));
				set_cookie(CLIENT_CONFIG_NAME, $cookieData, FrontpageController::KEYCOOKIETIME);
			}
			$response = [
				'status'	=> 200,
				'message'	=> [
					'Validated: TRUE!',
					$status['response']['message'][2]
				]
			];
		}
		return $response;
	}
	
	private function isAdminUserSet () {
		$dataOptions = [
			'data-trigger'	=> 'admin-check'
		];
		$response = $this->clientCheck($dataOptions);
		if ($response['status'] == 200) return $response['message'];
		return FALSE;
	}
	
	protected function additionalInitialization() {
		$this->helpers = ['cookie', 'url_helper'];
		$this->assets = [
			'assetUrl'		=> '/assets',
			'assetFolder'	=> '/web',
			'webassets'		=> [
				'styles'		=> [
					'/css/style.login.css'
				],
				'scripts'		=> [
					'/js/functions.js',
					'/js/script.login.js'
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
	
	public function authentication () {
		$cookie = get_cookie(CLIENT_CONFIG_NAME);
		$isClientAuthenticated = ($cookie !== NULL);
		$options = $this->getPageOptions();
		$options['authenticated'] = $isClientAuthenticated;
		if ($isClientAuthenticated && !$this->isAdminUserSet()) return $this->response->redirect(base_url($this->locale . '/client/setup/firsttime'), 'GET');
		elseif ($isClientAuthenticated && $this->isUserLogged()) return $this->response->redirect(base_url($this->locale . '/dashboard/welcome'), 'GET');
		else return view ('frontpage/user-login', $options);
	}
	
	public function doClientUserAuthentication () {
		if ($this->request->getMethod(TRUE) !== 'PUT') ;
		else {
			$json = $this->request->getJSON(TRUE);
			$dataForm = [];
			foreach ($json as $data) $dataForm[$data['name']] = $data['value'];
			$dataOptions = [
				'data-trigger'	=> 'user-verification',
				'data-transmit'	=> [
					'verifier'		=> $dataForm['userVerifier'],
					'form-data'		=> [
						'data-username'	=> $dataForm['username'],
						'data-password'	=> $dataForm['password']
					]
				]
			];
			$response	= $this->clientCheck($dataOptions);
			if ($response['status'] == 200) {
				$cookieData = base64_encode(json_encode($response['message']['data-transmit']));
				set_cookie(CLIENT_USER_COOKIE, $cookieData, CLIENT_TIME_COOKIE);
				$response = [
					'good'	=> TRUE
				];
			}
			$this->response->setJSON ($response);
			$this->response->send ();
		}
	}
	
	public function doClientAuthentication () {
		if ($this->request->getMethod(TRUE) !== 'PUT') 
			$response = [
				'status'	=> 404,
				'message'	=> 'Page Not Found!'
			];
		else $response = $this->setupCookie ($this->verifyClient());
		$this->response->setHeader ('Content-Type', 'application/json');
		$this->response->setJSON ($response);
		$this->response->send ();
	}
	
	public function forgetAuthentication () {
		
	}
	
	public function userLogout () {
		delete_cookie(CLIENT_USER_COOKIE);
		return $this->response->redirect(base_url($this->locale . '/assets/user-login'), 'GET');
	}
	
// 	public function setConfigCookie () {
// 		$this->setupCookie();
// 		return $this->response->redirect(base_url('id/dashboard/welcome'));
// 	}
	
	public function resetCookie () {
		delete_cookie(CLIENT_CONFIG_NAME);
		return $this->response->redirect(base_url($this->locale . '/assets/user-login'), 'GET');
	}
}