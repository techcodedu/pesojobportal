<?php

namespace App\Models;

use CodeIgniter\Model;

class JobSeekerModel extends Model
{
    protected $table = 'job_seekers';
    protected $primaryKey = 'job_seeker_id';
    protected $allowedFields = ['user_id', 'first_name', 'last_name', 'resume', 'skills', 'experience'];

    public function createJobSeeker($data)
    {
        return $this->insert($data);
    }
}