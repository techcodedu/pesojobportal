<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployerModel extends Model
{
    protected $table = 'employers';
    protected $primaryKey = 'employer_id';
    protected $allowedFields = ['user_id', 'company_name', 'company_description', 'company_logo', 'website'];

    public function createEmployer($data)
    {
        return $this->insert($data);
    }
}