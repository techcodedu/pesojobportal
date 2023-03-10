<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class UserTypeFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       // Get session and userType value
       $session = Services::session();
       $userType = $session->get('userType');

       // Get current route parameters
       $params = $request->uri->getSegment(1) . '/' . $request->uri->getSegment(2);

       // If not logged in, redirect to login page
       if (!$session->get('isLoggedIn') || $userType === null) {
           return redirect()->to('/login');
       }

       // If user is already logged in, check if they are allowed to access the requested page
       // If not, redirect to their dashboard
       if ($userType === 'employer' && $params === 'jobseeker/dashboard') {
           return redirect()->to('/employer/dashboard');
       } elseif ($userType === 'jobseeker' && $params === 'employer/dashboard') {
           return redirect()->to('/jobseeker/dashboard');
       }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
