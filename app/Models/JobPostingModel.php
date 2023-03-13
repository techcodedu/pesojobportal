<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\JobCategoryModel;
use App\Models\JobTypeModel;

class JobPostingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'job_postings';
    protected $primaryKey       = 'job_posting_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'description', 'requirements', 'salary', 'location', 'job_type_id', 'category_id','employer_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => [
            'label' => 'Title',
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Please enter a {field}.',
                'min_length' => 'The {field} must be at least {param} characters.',
                'max_length' => 'The {field} must not exceed {param} characters.'
            ]
        ],
        'description' => [
            'label' => 'Description',
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => 'Please enter a {field}.',
                'min_length' => 'The {field} must be at least {param} characters.'
            ]
        ],
        'requirements' => [
            'label' => 'Requirements',
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => 'Please enter {field}.',
                'min_length' => 'The {field} must be at least {param} characters.'
            ]
        ],
        'salary' => [
            'label' => 'Salary',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Please enter a {field}.',
                'numeric' => 'The {field} must be a number.'
            ]
        ],
        'location' => [
            'label' => 'Location',
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Please enter a {field}.',
                'min_length' => 'The {field} must be at least {param} characters.',
                'max_length' => 'The {field} must not exceed {param} characters.'
            ]
        ],
        'job_type_id' => [
            'label' => 'Job Type',
            'rules' => 'required',
            'errors' => [
                'required' => 'Please select a {field}.'
            ]
        ],
        'category_id' => [
            'label' => 'Category',
            'rules' => 'required',
            'errors' => [
                'required' => 'Please select a {field}.'
            ]
        ]
    ];

    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function jobType()
    {
        return $this->belongsTo(JobTypeModel::class);
    }

    public function category()
    {
        return $this->belongsTo(JobCategoryModel::class);
    }
    public function is_valid_job_type(int $job_type_id)
    {
        $model = new JobTypeModel();
        return $model->find($job_type_id) !== null;
    }

    public function is_valid_job_category(int $category_id)
    {
        $model = new JobCategoryModel();
        return $model->find($category_id) !== null;
    }

}
