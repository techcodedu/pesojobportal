<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployerModel extends Model
{
    protected $table = 'employers';
    protected $primaryKey = 'employer_id';
    protected $allowedFields = ['user_id', 'company_name', 'company_description', 'company_logo', 'website', 'address', 'number_of_employees','completed_registration'];

    public function createEmployer($data)
    {
        return $this->insert($data);
    }
    public function getAllowedNumberOfEmployees()
    {
        $builder = $this->db->table('information_schema.COLUMNS');
        $builder->select("COLUMN_TYPE")
                ->where('TABLE_SCHEMA', $this->db->database)
                ->where('TABLE_NAME', 'employers')
                ->where('COLUMN_NAME', 'number_of_employees');
        $result = $builder->get()->getResult();

        $allowedValues = str_replace("'", "", substr($result[0]->COLUMN_TYPE, 5, -1));
        $allowedValues = explode(',', $allowedValues);

        return $allowedValues;
    }

   
}
