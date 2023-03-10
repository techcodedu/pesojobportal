<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
{
    // Load the validation library
    helper('form');
    $validation = \Config\Services::validation();

    // Load the session library
    $session = \Config\Services::session();

    // Initialize the data array
    $data = [];

    // Check if the form was submitted
    if ($this->request->getMethod() === 'post') {
        // Validate the input data
        $validation->setRules([
            'username_email' => 'required',
            'password' => 'required',
        ]);

        // Run the validation and check if it passes
        if ($validation->withRequest($this->request)->run()) {
            $username_email = $this->request->getVar('username_email');
            $password = $this->request->getVar('password');

            // Load the user model and get the user by email or username
            $userModel = new UserModel();
            $user = $userModel->getUserByUsernameOrEmail($username_email);

            if ($user !== null) {
                if (password_verify($password, $user['password'])) {
                    // User authentication succeeded

                    // Store user data in session
                    $session->set([
                        'isLoggedIn' => true,
                        'user_id' => $user['user_id'],
                        'username' => $user['username'],
                        'userType' => $user['user_type'],
                    ]);

                    // Redirect to the appropriate dashboard
                    if ($user['user_type'] === 'job seeker') {
                        return redirect()->to('jobseeker/dashboard');
                    } elseif ($user['user_type'] === 'employer') {
                        return redirect()->to('employer/dashboard');
                    }
                } else {
                    // Password is incorrect
                    $data['error'] = 'Invalid password';
                }
            } else {
                // User does not exist
                $data['error'] = 'User does not exist';
            }
        } else {
            // Validation failed
            $data['validation'] = $validation;
        }
    }

    // Load the login form view and pass data to it
    // var_dump($data);
    echo view('login', ['data' => $data, 'validation' => $validation]);

}

}