<?php
namespace App\Controllers;


class Dashboard extends BaseController {
    
    private $persistenceData = [];
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::init()
     */
    protected function init() { 
        // TODO Auto-generated method stub
        $router = \Config\Services::router();
        $this->persistenceData['assetsFolder'] = base_url('assets');
        $this->persistenceData['routes'] = $router;
    }    
    
    public function index () {
        return view ('dashboard', $this->persistenceData);
    }
    
    public function setup () {
        $this->persistenceData['formAction'] = base_url('system/setup');
        if ($this->request->hasHeader('Content-Type')) {
            $header = $this->request->getHeader('Content-Type');
            if (strcmp ($header->getValue(), 'application/x-www-form-urlencoded') == 0 &&
                    strcmp ($this->request->getMethod(TRUE), 'POST') == 0) {
                $post = $this->request->getPost();
            }
        }
        return view ('setup', $this->persistenceData);
    }
    
    public function test () {
        
    }
}