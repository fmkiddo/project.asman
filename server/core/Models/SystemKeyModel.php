<?php
namespace App\Models;

use CodeIgniter\Model;

class SystemKeyModel extends Model
{

    private const serverKey = 'bc4f0ae5b082d37604e49d4a4971e7c4a0ec7637e2c2962a67b639f964946f8f1520721ced81abe1dcf1a1d7172c4e22aedefe631fbb3a95335f311ac2a98fc0';

    public function generate($length = 64)
    {
        $randKey = openssl_random_pseudo_bytes($length);
        return bin2hex($randKey);
    }

    public function validateRequest(\CodeIgniter\HTTP\IncomingRequest $request)
    {
        $valid = false;
        if ($request->hasHeader('Content-Type')) {
            $header = $request->getHeader('Content-Type');
            if ($header->getValue() == 'application/json') {
                $data = json_decode($request->getBody(), TRUE);
                if (array_key_exists('request-user', $data) && array_key_exists('request-key', $data) && strcmp('fmkiddo', $data['request-user']) == 0 && strcmp('R@z13l64', $data['request-key']) == 0)
                    $valid = true;
            }
        }

        return $valid;
    }

    public function validateSystemKey($key = '')
    {
        return strcmp($key, SystemKeyModel::serverKey) == 0;
    }
}