<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JobCategoryModel;
use App\Models\JobTypeModel;
use App\Models\JobPostingModel;
use App\Models\EmployerModel;
use App\Models\UserModel;

class JobPosting extends BaseController
{
    protected $helpers = ['form'];
    protected $employerModel;
    protected $jobPostingModel;
    protected $session;

    public function __construct()
    {
        // Load the form helper
        helper('form');
       
        $this->employerModel = new EmployerModel();
        $this->jobPostingModel = new JobPostingModel();
        $this->session = \Config\Services::session();
        $this->validator = \Config\Services::validation();
        $pager = \Config\Services::pager();

    }
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
    
        // Get the authenticated employer's ID
        $employer = $this->employerModel->where('user_id', $userId)->first();
        $employerId = $employer['employer_id'];
    
        // Get all job postings created by the authenticated employer, including the job category and job type names
        $jobPostingModel = new JobPostingModel();
        $jobPostings = $jobPostingModel
                ->select('job_postings.*, job_categories.name as category_name, job_types.name as job_type_name')
                ->join('job_categories', 'job_postings.category_id = job_categories.id')
                ->join('job_types', 'job_postings.job_type_id = job_types.id')
                ->where('employer_id', $employerId)
                ->findAll();

        // Pass the job postings data to the view
        $data['jobPostings'] = $jobPostings;
    
        // Load the view to display the job postings
        return view('employer/job_postings/index', $data);
    }
    
    public function create()
    {
        // Load the model for job categories and job types
        $jobCategoryModel = new JobCategoryModel();
        $jobTypeModel = new JobTypeModel();

        // Retrieve all job categories and job types
        $jobCategories = $jobCategoryModel->findAll();
        $jobTypes = $jobTypeModel->findAll();

        // Modify the job types and job categories arrays to have name as option text
        $jobTypesOptions = [];
        foreach ($jobTypes as $jobType) {
            $jobTypesOptions[$jobType['id']] = $jobType['name'];
        }

        $jobCategoriesOptions = [];
        foreach ($jobCategories as $jobCategory) {
            $jobCategoriesOptions[$jobCategory['id']] = $jobCategory['name'];
        }


        // Pass the data to the view
        $data = [
            'jobCategories' => $jobCategoriesOptions,
            'jobTypes' => $jobTypesOptions,
            'jobTypesList' => $jobTypes,
            'validation' => $this->validator,
        ];

        return view('employer/job_postings/create', $data);
    }
    public function store()
    {
        $jobPostingModel = new JobPostingModel();
    
        // Set the validation rules
        $rules = $jobPostingModel->validationRules;
    
        // Run the validation
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            $jobCategoryModel = new JobCategoryModel();
            $jobTypeModel = new JobTypeModel();
            $jobTypes = $jobTypeModel->findAll();
            $jobTypesList = [];
            foreach ($jobTypes as $jobType) {
                $jobTypesList[$jobType['id']] = $jobType;
            }
            $data['jobTypesList'] = $jobTypesList;
            $jobCategories = $jobCategoryModel->findAll();
            $jobCategoriesOptions = [];
            foreach ($jobCategories as $jobCategory) {
                $jobCategoriesOptions[$jobCategory['id']] = $jobCategory['name'];
            }
            $data['jobCategories'] = $jobCategoriesOptions;
            return view('employer/job_postings/create', $data);
        }
    
        // Get the form data
        $postData = $this->request->getPost();
    
        // Get the employer ID from the current user
        $session = session();
        $userId = $session->get('user_id');
        $employerModel = new EmployerModel();
        $employer = $employerModel->where('user_id', $userId)->first();

        // Check if the employer was found
        // if (!$employer) {
        //     // Handle the error here (e.g. redirect to an error page) need to complete registration first
        //     return redirect()->to('/employer/registration');
        // }
        $postData['employer_id'] = $employer['employer_id'];
    
        // Insert the data
        $jobPostingModel->insert($postData);
    
        // Set a flash message and redirect to the job postings index page
        session()->setFlashdata('success', 'Job posting created successfully!');
        return redirect()->to('/employer/job_postings');
    }

    public function delete($jobPostingId)
    {
        // Delete the job posting with the given ID from the database
        $jobPostingModel = new JobPostingModel();
        $jobPostingModel->delete($jobPostingId);

        // Redirect back to the job postings index page
        return redirect()->to('/employer/job_postings');
    }

    public function edit($id)
    {
        // Load the job posting with the given ID from the database
        $jobPostingModel = new JobPostingModel();
        $jobPosting = $jobPostingModel->find($id);

        // Load the model for job categories and job types
        $jobCategoryModel = new JobCategoryModel();
        $jobTypeModel = new JobTypeModel();

        // Retrieve all job categories and job types
        $jobCategories = $jobCategoryModel->findAll();
        $jobTypesList = $jobTypeModel->findAll();

        // Modify the job types and job categories arrays to have name as option text
        $jobTypeOptions = [];
        foreach ($jobTypesList as $jobType) {
            $jobTypeOptions[$jobType['id']] = $jobType['name'];
        }

        $jobCategoryOptions = [];
        foreach ($jobCategories as $jobCategory) {
            $jobCategoryOptions[$jobCategory['id']] = $jobCategory['name'];
        }

        // Render a view that allows the user to edit the job posting details
        return view('employer/job_postings/edit', [
            'jobPosting' => $jobPosting,
            'jobTypesList' => $jobTypesList,
            'jobTypeOptions' => $jobTypeOptions,
            'jobCategories' => $jobCategoryOptions,
            'validation' => $this->validator
        ]);
    }
        public function update($id)
        {
            // Load the job posting with the given ID from the database
            $jobPostingModel = new JobPostingModel();
            $jobPosting = $jobPostingModel->find($id);

            // Run the validation on the input data
            if (!$this->validate($jobPostingModel->validationRules)) {
                $data['validation'] = $this->validator;
                $jobCategoryModel = new JobCategoryModel();
                $jobTypeModel = new JobTypeModel();
                $jobTypes = $jobTypeModel->findAll();
                $jobTypesList = [];
                foreach ($jobTypes as $jobType) {
                    $jobTypesList[$jobType['id']] = $jobType;
                }
                $data['jobTypesList'] = $jobTypesList;
                $jobCategories = $jobCategoryModel->findAll();
                $jobCategoriesOptions = [];
                foreach ($jobCategories as $jobCategory) {
                    $jobCategoriesOptions[$jobCategory['id']] = $jobCategory['name'];
                }
                $data['jobCategories'] = $jobCategoriesOptions;
                $data['jobPosting'] = $jobPosting;
                return view('employer/job_postings/edit', $data);
            }

            // Get the form data
            $postData = $this->request->getPost();

            // Update the job posting
            $jobPostingModel->update($id, $postData);

            // Set a flash message and redirect to the job postings index page
            session()->setFlashdata('success', 'Job posting updated successfully!');
            return redirect()->to('/employer/job_postings');
        }




}
