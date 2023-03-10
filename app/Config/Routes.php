<?php

namespace Config;

use App\Controllers\HomeController;
use App\Controllers\JobSeeker;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
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

// dashboards
// $routes->get('jobseeker/dashboard', [JobSeeker::class, 'index']);
// $routes->get('employer/dashboard', 'Employer::index', ['filter' => 'auth']);
// $routes->get('jobseeker/dashboard', 'JobSeeker::index', ['filter' => 'auth']);
// $routes->get('employer/dashboard', [Employer::class, 'index']);
$routes->get('employer/dashboard', 'Employer::index', ['filter' => 'userType:employer']);
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