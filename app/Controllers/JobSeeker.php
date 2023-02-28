<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class JobSeeker extends BaseController
{
    public function index()
    {
        //
        return view('jobseeker/dashboard');
    }
        public function viewProfile()
    {
        // Load the job seeker profile view
        return view('job_seeker_profile');
    }

    public function editProfile()
    {
        // Load the job seeker profile edit view
        return view('job_seeker_profile_edit');
    }

    public function viewJobPostings()
    {
        // Load the job postings view
        return view('job_postings');
    }

    public function applyForJob($jobId)
    {
        // Load the job application view
        return view('job_application', ['jobId' => $jobId]);
    }

    public function viewJobApplicationStatus()
    {
        // Load the job application status view
        return view('job_application_status');
    }

    public function logout()
    {
        // Clear user session data and redirect to login page
        session()->destroy();
        return redirect()->to('/login');
    }
}