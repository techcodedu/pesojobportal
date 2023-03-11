<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Employer extends BaseController
{
    public function index()
    {
        // Get the current session
        $session = session();

        // Get the user ID from the session
        $user_id = $session->get('user_id');

        // Load the UserModel and retrieve the user's data
        $userModel = new UserModel();
        $user = $userModel->find($user_id);

        // Pass the user's data to the dashboard view
        $data = [
            'user' => $user
        ];

        return view('employer/dashboard', $data);
    }
}
