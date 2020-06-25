<?php
namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{

    private const serverKey = 'bc4f0ae5b082d37604e49d4a4971e7c4a0ec7637e2c2962a67b639f964946f8f1520721ced81abe1dcf1a1d7172c4e22aedefe631fbb3a95335f311ac2a98fc0';

    public function getServerKey()
    {
        return ServerModel::serverKey;
    }
}