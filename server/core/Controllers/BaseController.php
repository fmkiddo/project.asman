<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

abstract class BaseController extends Controller {

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected $serverModel;
	
	protected function init () { }

	/**
	 * Constructor.
	 */
	public function initController(
	       \CodeIgniter\HTTP\RequestInterface $request, 
	       \CodeIgniter\HTTP\ResponseInterface $response, 
	       \Psr\Log\LoggerInterface $logger) {
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->serverModel = new \App\Models\ServerModel();
		$this->init();
	}

	protected function isFirstTime () {
	    $firstTime = false;
	    $curlClient = \Config\Services::curlrequest();
	    $requestData = 'check-system-user.' . $this->serverModel->getServerKey() . '';
	    $data = [
	        'json' => [
	            'server-request' => $requestData
	        ]
	    ];
	    $response = $curlClient->request('PUT', base_url('server-api'), $data);
	    if ($response->getStatusCode() == 200) {
	        $responseData = json_decode($response->getBody (), TRUE);
	        
	    }
	    return $firstTime;
	}
}
