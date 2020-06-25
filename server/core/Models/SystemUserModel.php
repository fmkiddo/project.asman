<?php
namespace App\Models;

use CodeIgniter\Model;

class SystemUserModel extends Model
{

    protected $tableName = 'oapusr';

    protected $primaryKey = 'username';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'created_by'
    ];

    public function countSystemUser()
    {
        $result = $this->findAll();
        if ($result == NULL)
            return 0;
        return count($result);
    }
}