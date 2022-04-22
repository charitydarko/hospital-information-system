<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('', ['filter'=>'authGuard'], function($routes){
    $routes->get('', 'Auth::login');

    // User
    $routes->get('user', 'User::index');

    // Dashboard 
    $routes->get('dashboard', 'Dashboard::index');

    // Patient 
    $routes->get('patient', 'Patient::index');

    // Appointment 
    $routes->get('appointment', 'Appointment::index');

    // Vitals 
    $routes->get('vitals', 'Vitals::index');

    // Diagnosis 
    $routes->get('diagnosis', 'Diagnosis::index');

     // Laboratory 
     $routes->get('laboratory', 'Laboratory/Request::index');
     $routes->get('laboratory/request', 'Laboratory/Request::index');
     $routes->get('laboratory/home', 'Laboratory/Home::index');

    // Pharmacy Inventory 
    $routes->get('pharmacy/inventory', 'Pharmacy/Inventory::index');

    // Pharmacy Prescription 
    $routes->get('pharmacy/prescription', 'Pharmacy/Prescription::index');

    // Billing 
    $routes->get('billing', 'Billing::index');

    // Message
    $routes->get('message', 'Message::index');

    // Noticeboard
    $routes->get('noticeboard', 'Noticeboard::index');
    
});

//$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
