<?php


namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

class Routes extends BaseConfig
{
    public function initRoutes()
    {
        $routes = Services::routes();  // Get the routes service

        // Auth routes
        $routes->get('/', 'AuthController::login');
        $routes->get('/login', 'AuthController::login');
        $routes->post('/login', 'AuthController::loginUser');

        $routes->get('/register', 'AuthController::register');
        $routes->post('/register', 'AuthController::registerUser');
        $routes->get('/logout', 'AuthController::logout');


        // Group the routes under the 'tasks' prefix and apply the 'auth' filter
        $routes->group('/tasks', ['filter' => 'auth'], function(RouteCollection $routes) {
            // Define the routes inside this group
            $routes->get('/', 'TaskController::main');                
            $routes->get('create', 'TaskController::create');    
            $routes->post('store', 'TaskController::store');    
            $routes->get('edit/(:num)', 'TaskController::create/$1');
            $routes->post('update/(:num)', 'TaskController::store/$1'); 
            $routes->get('delete/(:num)', 'TaskController::delete/$1');
            $routes->post('update_status/(:num)', 'TaskController::update_status/$1');
        });



        // Auth routes
        $routes->get('/admin_login', 'AdminAuthController::login');
        $routes->post('/admin_login', 'AdminAuthController::loginAdmin'); 

        $routes->get('/admin_register', 'AdminAuthController::register');
        $routes->post('/admin_register', 'AdminAuthController::registerAdmin');
        $routes->get('/admin_logout', 'AdminAuthController::logout');


        // Group the routes under the 'tasks' prefix and apply the 'auth' filter
        $routes->group('/users', ['filter' => 'adminAuth'], function(RouteCollection $routes) {
            // Define the routes inside this group
            $routes->get('/', 'UserController::main'); 

            $routes->get('create', 'UserController::create'); 
            $routes->post('store', 'UserController::store');  

            $routes->get('edit/(:num)', 'UserController::create/$1'); 
            $routes->post('update/(:num)', 'UserController::store/$1'); 

            $routes->get('delete/(:num)', 'UserController::delete/$1');
            $routes->get('status/(:num)', 'UserController::status/$1');

            // Email
            $routes->get('emails', 'AdminEmailNotificationController::totalEmail');
        });
    }
}

// Instantiate and call initRoutes() to initialize all routes
$routes = Services::routes();
$customRoutes = new Routes();
$customRoutes->initRoutes();