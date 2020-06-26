<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

abstract class BaseRESTController extends ResourceController {

    protected $format = 'json';

    protected $helpers = [];

    protected function init() {}

    public function initController(
            \CodeIgniter\HTTP\RequestInterface $request, 
            \CodeIgniter\HTTP\ResponseInterface $response, 
            \Psr\Log\LoggerInterface $logger) {
        // Do NOT Edit THis Line
        parent::initController($request, $response, $logger);

        $this->init();
    }
}