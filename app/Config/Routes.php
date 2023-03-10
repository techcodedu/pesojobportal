<?php

namespace Config;

use App\Controllers\HomeController;
use App\Controllers\JobSeeker;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\JobPosting;
use App\Controllers\Employer;

// use App\Controllers\RegistrationController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', [HomeController::class, 'index']);

// employer  protected routes
$routes->get('employer/dashboard', 'Employer::index', ['filter' => 'userType:employer']);
$routes->get('employer/registration', 'Employer::registration', ['filter' => 'userType:employer']);
$routes->post('employer/register/complete', 'Employer::completeRegistration', ['filter' => 'userType:employer']);
$routes->get('employer/dashboard/profile', 'Employer::profile', ['filter' => 'userType:employer']);
//employer profile edit
$routes->get('employer/edit', 'Employer::edit', ['filter' => 'userType:employer']);
$routes->post('employer/update', 'Employer::update', ['filter' => 'userType:employer']);
// protecting the complete registratoin route

// employer job posting
$routes->get('/employer/job_postings/create', 'JobPosting::create',['filter' => 'userType:employer']);
$routes->post('/employer/job_postings', 'JobPosting::store',['filter' => 'userType:employer']);
$routes->get('/employer/job_postings', 'JobPosting::index',['filter' => 'userType:employer']);

// Job post deleted
$routes->get('job_postings/delete/(:num)', 'JobPosting::delete/$1',['filter' => 'userType:employer']);
// Job post editing
$routes->get('job_postings/edit/(:num)', 'JobPosting::edit/$1',['filter' => 'userType:employer']);
$routes->post('job_postings/edit', 'JobPosting::edit',['filter' => 'userType:employer']);






// jobseeker protected routes
$routes->get('jobseeker/dashboard', 'JobSeeker::index', ['filter' => 'userType:job seeker']);


//job seeker
$routes->get('/logout', [JobSeeker::class, 'logout']);
// registration route
$routes->get('/signup', [RegisterController::class, 'index']);
$routes->post('/signup/register', [RegisterController::class, 'register']);
// login route
$routes->get('/login', [LoginController::class, 'index']);
$routes->post('/login', [LoginController::class, 'index']);



if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}