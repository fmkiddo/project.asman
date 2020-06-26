<?php
namespace App\Controllers;

class ServerLogin extends BaseController {

    private $persistenceData = [];

    /**
     *
     * {@inheritdoc}
     * @see \App\Controllers\BaseController::init()
     */
    protected function init() {
        // TODO Auto-generated method stub
        $router = \Config\Services::router();
        $this->persistenceData['pageTitle'] = '';
        $this->persistenceData['assetsFolder'] = base_url('assets');
        $this->persistenceData['routes'] = $router;
    }

    public function index() {
        if ($this->request->hasHeader('Content-Type')) {
            $header = $this->request->getHeader('Content-Type');
            if (strcmp($header->getValue(), 'application/x-www-form-urlencoded') == 0 && strcmp($this->request->getMethod(TRUE), 'POST') == 0) {
                $post = $this->request->getPost();
            }
        } else if ($this->isFirstTime())
            return redirect()->to(base_url('system/setup'));

        return view('login', $this->persistenceData);
    }
} 