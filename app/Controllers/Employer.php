<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\EmployerModel;


class Employer extends BaseController
{
    protected $session;
 
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validator = \Config\Services::validation();

        helper(['form']);
    }
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        // Load the EmployerModel
        $employerModel = new EmployerModel();

        // Get the employer data
        $employer = $employerModel->where('user_id', $userId)->first();

        // Check if the employer has completed the registration
        if (empty($employer) || empty($employer['completed_registration'])) {
            // Redirect to the registration page
            return redirect()->to('employer/registration');
        }

        $username = $session->get('username');
        $data = [];

        if ($username) {
            $data['username'] = $username;
        }

        // Get the flashdata message
        $message = $session->getFlashdata('success');

        // If there is a message, add it to the data array to be passed to the view
        if ($message) {
            $data['message'] = $message;
        }

        return view('employer/dashboard', $data);
    }


    public function registration()
    {
        $employerModel = new EmployerModel();

        // Get the allowed values for the 'number_of_employees' field
        $numberOfEmployees = $employerModel->getAllowedNumberOfEmployees();

        $username = $this->session->get('username');
        $data = [
            'numberOfEmployees' => $numberOfEmployees
        ];
        if (!empty($username)) {
            $data['username'] = $username;
        }

        return view('employer/complete_registration',$data);
    }
    public function profile()
    {
        // Load the EmployerModel
        $employerModel = new EmployerModel();

        // Get the employer data
        $userId = $this->session->get('user_id');
        $employer = $employerModel->where('user_id', $userId)->first();

        // Pass the employer data to the view
        $data = [
            'employer' => $employer,
        ];

        return view('employer/profile', $data);
    }
    public function edit()
    {
        // Load the EmployerModel
        $employerModel = new EmployerModel();

        // Get the employer data
        $userId = $this->session->get('user_id');
        $employer = $employerModel->where('user_id', $userId)->first();

        // Get the allowed number of employees
        $numberOfEmployees = $employerModel->getAllowedNumberOfEmployees();

        // Pass the employer data to the view
        $data = [
            'employer' => $employer,
            'numberOfEmployees' => $numberOfEmployees,
        ];

        return view('employer/edit_profile', $data);
    }
    public function update()
    {
        $employerModel = new EmployerModel();

        // Get the allowed number of employees
        $numberOfEmployees = $employerModel->getAllowedNumberOfEmployees();

        // Get the user ID
        $userId = $this->session->get('user_id');

        // Get the employer data
        $employer = $employerModel->where('user_id', $userId)->first();

        // Check if the form has been submitted
        $method = $this->request->getMethod(true);

        if ($method === 'POST') {
            // Set the validation rules
            $rules = [
                'company_name' => [
                    'label' => 'Company Name',
                    'rules' => 'required|max_length[255]',
                ],
                'company_description' => [
                    'label' => 'Company Description',
                    'rules' => 'required',
                ],
                'website' => [
                    'label' => 'Company Website',
                    'rules' => 'required|valid_url',
                ],
                'address' => [
                    'label' => 'Company Address',
                    'rules' => 'required',
                ],
                'number_of_employees' => [
                    'label' => 'Number of Employees',
                    'rules' => 'required',
                ],
                'company_logo' => [
                    'label' => 'Company Logo',
                    'rules' => 'max_size[company_logo,2048]|ext_in[company_logo,png,jpg,jpeg,gif]',
                ]
            ];
            

            // Use the withRequest method for validation
            $validation = \Config\Services::validation()->withRequest($this->request)->setRules($rules);

            if ($validation->run()) {
                // If the validation is successful, update the data in the database

                $data = [
                    'company_name' => $this->request->getPost('company_name'),
                    'company_description' => $this->request->getPost('company_description'),
                    'website' => $this->request->getPost('website'),
                    'address' => $this->request->getPost('address'),
                    'number_of_employees' => $this->request->getPost('number_of_employees'),
                ];

                // Handle the company logo
                if ($this->request->getFile('company_logo')->isValid()) {
                    $newLogoName = $this->request->getFile('company_logo')->getRandomName();
                    $this->request->getFile('company_logo')->move(ROOTPATH.'public/uploads/employer_logos/', $newLogoName);
                    $data['company_logo'] = 'uploads/employer_logos/' . $newLogoName;
                }

                // Update the record
                $employerModel->update($employer['employer_id'], $data);

                // Set a success message
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Your profile has been updated successfully.');
                var_dump($session->getFlashdata('success'));


                // Redirect to the profile page
                return redirect()->to('employer/dashboard/profile');
            } else {
                // Display validation errors
                $data = [
                    'employer' => $employer,
                    'numberOfEmployees' => $numberOfEmployees,
                    'validation' => $validation
                ];

                return view('employer/edit_profile', $data);
            }
        }

        // If the form has not been submitted or the validation has failed, render the edit profile view
        $data = [
            'employer' => $employer,
            'numberOfEmployees' => $numberOfEmployees
        ];

        return view('employer/edit_profile', $data);
    }

    public function completeRegistration()
    {
        // Load the EmployerModel
        $employerModel = new EmployerModel();

        // Get the allowed number of employees
        $numberOfEmployees = $employerModel->getAllowedNumberOfEmployees();

        // Check if the user has already completed the registration
        $session = \Config\Services::session();

        $userId = $this->session->get('user_id');
        $employer = $employerModel->where('user_id', $userId)->first();
        if (!empty($employer)) {
            // Set the tempdata message
            $session->setTempdata('warning', 'You have already completed the registration', 300);

            // Get the tempdata message in the next request
            $warningMessage = $session->getTempdata('warning');

            return redirect()->to('employer/dashboard');
        }

        // Check if the form has been submitted
        $request = service('request');

        $method = $request->getMethod(true);

        if ($method) {

            // Set the validation rules
            $rules = [
                'company_name' => [
                    'label' => 'Company Name',
                    'rules' => 'required|max_length[255]',
                ],
                'company_description' => [
                    'label' => 'Company Description',
                    'rules' => 'required',
                ],
                'website' => [
                    'label' => 'Company Website',
                    'rules' => 'required|valid_url|is_unique[employers.website]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists, please choose another.'
                    ]
                ],
                'address' => [
                    'label' => 'Company Address',
                    'rules' => 'required',
                ],
                'number_of_employees' => [
                    'label' => 'Number of Employees',
                    'rules' => 'required',
                ],
                'company_logo' => [
                    'label' => 'Company Logo',
                    'rules' => 'uploaded[company_logo]|max_size[company_logo,2048]|ext_in[company_logo,png,jpg,jpeg,gif]',
                ]
                
                
            ];

            // Validate the data
            $validation = $this->validate($rules);
            if ($validation) {
                // If the validation is successful, save the data to the database

              
               // Prepare the data to be saved
                $data = [
                    'user_id' => $this->session->get('user_id'),
                    'company_name' => $this->request->getPost('company_name'),
                    'company_description' => $this->request->getPost('company_description'),
                    'company_logo' => 'uploads/employer_logos/' . $this->request->getFile('company_logo')->getName(),
                    'website' => $this->request->getPost('website'),
                    'address' => $this->request->getPost('address'),
                    'number_of_employees' => $this->request->getPost('number_of_employees'),
                    'completed_registration' => true
                ];


                // Save the data and get the created employer ID
                $employerId = $employerModel->createEmployer($data);

                // Save the uploaded company logo file
                        $companyLogoFile = $this->request->getFile('company_logo');
                        $companyLogoFile->move(WRITEPATH . 'uploads/employer_logos', $companyLogoFile->getName());

                        // Set a success message
                        $session->setFlashdata('success', 'Your registration has been completed successfully.');

                        // Redirect to the dashboard
                        return redirect()->to('employer/dashboard/profile');
                    }
                }

                // If the form has not been submitted or the validation has failed, render the complete registration view
                $data = [
                    'numberOfEmployees' => $numberOfEmployees,
                    'validation' => $this->validator,
                ];

                return view('employer/complete_registration', $data);
            }

}
