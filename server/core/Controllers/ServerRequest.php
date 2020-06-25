<?php
namespace App\Controllers;

class ServerRequest extends BaseRESTController
{

    public function generate_request_key()
    {
        $respond = [
            'status' => 403,
            'message' => 'Forbidden Access',
            'reason' => 'Unauthorised system request logged at ' . date('r')
        ];

        $sysKeyModel = new \App\Models\SystemKeyModel();
        if ($sysKeyModel->validateRequest($this->request)) {
            $newkey = $sysKeyModel->generate(64);
            $respond = [
                'status' => 200,
                'message' => $newkey,
                'reason' => 'Authorized new server key generation executed at ' . date('r')
            ];
        }
        return $this->respond($respond);
    }

    public function index()
    {
        $response = [
            'statusCode' => 403,
            'message' => '',
            'reason' => ''
        ];

        if ($this->request->hasHeader('Content-Type')) {
            $header = $this->request->getHeader('Content-Type');
        }

        return $this->respond($response);
    }
}