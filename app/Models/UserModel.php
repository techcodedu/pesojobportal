<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'email', 'password', 'user_type'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[20]',
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]|max_length[255]',
        'user_type' => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function getUserByUsernameOrEmail($username_email)
{
    $builder = $this->db->table($this->table);
    $builder->where('email', $username_email)->orWhere('username', $username_email);
    return $builder->get()->getRowArray();
}
}