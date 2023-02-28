<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisterController extends BaseController
{   
     public function __construct()
    {
       helper(['form']);
       
    }
    public function index()
    {
        //
        return view('registernew');
    }
    public function register()
    {
        $model = new UserModel();
        $rules = [
        'username' => [
            'label' => 'Username',
            'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
            'errors' => [
                'is_unique' => 'The {field} already exists, please choose another.'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'is_unique' => 'The {field} already exists, please choose another.'
            ]
        ],
        'password' => 'required|min_length[8]',
        'password_confirm' => 'required|matches[password]'
        ];
        

        if ($this->validate($rules)) {
            $model->save([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash(strval($this->request->getPost('password')), PASSWORD_DEFAULT),
            'user_type' => $this->request->getPost('user_type')
]);


            $session = session();
            $session->setFlashdata('success', 'Successful Registration');
            return redirect()->to('/login');
        } else {
            return view('registernew');
        }
    }
}