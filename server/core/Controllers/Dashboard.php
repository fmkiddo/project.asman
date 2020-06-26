<?php
namespace App\Controllers;

class Dashboard extends BaseController
{

    private $persistenceData = [];

    private function doSetup(array $post = []) : bool {
        $setupSuccess = false;
        $put = [
            'json' => $post
        ];
        $curl = \Config\Services::curlrequest();
        $response = $curl->request('put', base_url('server-api'), $put);
        return $setupSuccess;
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Controllers\BaseController::init()
     */
    protected function init() {
        // TODO Auto-generated method stub
        $router = \Config\Services::router();
        $this->persistenceData['assetsFolder'] = base_url('assets');
        $this->persistenceData['routes'] = $router;
        $this->validator = \Config\Services::validation();
    }

    public function index() {
        return view('dashboard', $this->persistenceData);
    }

    public function setup() {
        $this->persistenceData['formAction'] = base_url('system/setup');
        if ($this->request->hasHeader('Content-Type')) {
            $header = $this->request->getHeader('Content-Type');
            if (strcmp($header->getValue(), 'application/x-www-form-urlencoded') == 0 && strcmp($this->request->getMethod(TRUE), 'POST') == 0) {
                $post = $this->request->getPost();
                if ($this->validator->run($post, 'setup'))
                    if ($this->doSetup($post)) { // if setup success
                        $this->persistenceData['success'] = '';
                        redirect()->to(base_url('dashboard/signin'));
                    } else
                        $this->persistenceData['errors'] = '';
                else
                    $this->persistenceData['errors'] = $this->validator->listErrors();
            }
        }
        return view('setup', $this->persistenceData);
    }

    public function test() {
        $data = 'abdD2';

        echo $data . '<br />';

        echo preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\s\d]).+$/', $data) == 1 ? 'match' : 'not match';
    }
}