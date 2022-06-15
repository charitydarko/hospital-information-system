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
    $routes->get('user/list', 'User::list');
    $routes->get('user/create', 'User::create');
    $routes->get('user/view', 'User::view');
    $routes->get('user/view/(:any)', 'User::view/$1');
    $routes->get('user/edit', 'User::edit');
    $routes->get('user/edit/(:any)', 'User::edit/$1');
    $routes->get('user/update', 'User::update');
    $routes->get('user/update/(:any)', 'User::update/$1');
    $routes->get('user/delete', 'User::delete');
    $routes->get('user/delete/(:any)', 'User::delete/$1');
    $routes->get('user/reset_password', 'User::reset_password');
    $routes->get('user/reset_password/(:any)', 'User::reset_password/$1');
    $routes->get('user/update_password', 'User::update_password');
    $routes->get('user/update_password/(:any)', 'User::update_password/$1');

    // Dashboard 
    $routes->get('dashboard', 'Dashboard::index');

    // Patient 
    $routes->get('patient', 'Patient::index');
    $routes->get('patient/today', 'Patient::today');
    $routes->get('patient/view', 'Patient::view');
    $routes->get('patient/view/(:any)', 'Patient::view/$1');
    $routes->get('patient/new', 'Patient::new');
    $routes->get('patient/create', 'Patient::create');
    $routes->get('patient/create/(:any)', 'Patient::create/$1');
    $routes->get('patient/edit', 'Patient::edit');
    $routes->get('patient/edit/(:any)', 'Patient::edit/$1');
    $routes->get('patient/update', 'Patient::update');
    $routes->get('patient/update/(:any)', 'Patient::update/$1');
    $routes->get('patient/document', 'Patient::document');
    $routes->get('patient/add_document', 'Patient::add_document');
    $routes->get('patient/add_document/(:any)', 'Patient::add_document/$1');
    $routes->get('patient/document_upload', 'Patient::document_upload');
    $routes->get('patient/document_upload/(:any)', 'Patient::document_upload/$1');
    $routes->get('patient/delete', 'Patient::delete');
    $routes->get('patient/delete/(:any)', 'Patient::delete/$1');
    $routes->get('patient/document_delete', 'Patient::document_delete');
    $routes->get('patient/document_delete/(:any)', 'Patient::document_delete/$1');

    // Appointment 
    $routes->get('appointment', 'Appointment::index');
    $routes->get('appointment/today', 'Appointment::today');
    $routes->get('appointment/add', 'Appointment::add');
    $routes->get('appointment/create', 'Appointment::create');
    $routes->get('appointment/create/(:any)', 'Appointment::create/$1');
    $routes->get('appointment/view', 'Appointment::view');
    $routes->get('appointment/view/(:any)', 'Appointment::view/$1');
    $routes->get('appointment/edit', 'Appointment::edit');
    $routes->get('appointment/edit/(:any)', 'Appointment::edit/$1');
    $routes->get('appointment/update', 'Appointment::update');
    $routes->get('appointment/update/(:any)', 'Appointment::update/$1');
    $routes->get('appointment/delete', 'Appointment::delete');
    $routes->get('appointment/delete/(:any)', 'Appointment::delete/$1');

    // Vitals 
    $routes->get('vitals', 'Vitals::index');
    $routes->get('vitals/today', 'Vitals::today');
    $routes->get('vitals/month', 'Vitals::month');
    $routes->get('vitals/add', 'Vitals::add');
    $routes->get('vitals/create', 'Vitals::create');
    $routes->get('vitals/create/(:any)', 'Vitals::create/$1');
    $routes->get('vitals/view', 'Vitals::view');
    $routes->get('vitals/view/(:any)', 'Vitals::view/$1');
    $routes->get('vitals/edit', 'Vitals::edit');
    $routes->get('vitals/edit/(:any)', 'Vitals::edit/$1');
    $routes->get('vitals/update', 'Vitals::update');
    $routes->get('vitals/update/(:any)', 'Vitals::update/$1');
    $routes->get('vitals/delete', 'Vitals::create');
    $routes->get('vitals/delete/(:any)', 'Vitals::create/$1');

    // Diagnosis 
    $routes->get('diagnosis', 'Diagnosis::index');
    $routes->get('diagnosis/today', 'Diagnosis::today');
    $routes->get('diagnosis/add', 'Diagnosis::add');
    $routes->get('diagnosis/create', 'Diagnosis::create');
    $routes->get('diagnosis/create/(:any)', 'Diagnosis::create/$1');
    $routes->get('diagnosis/view', 'Diagnosis::view');
    $routes->get('diagnosis/view/(:any)', 'Diagnosis::view/$1');
    $routes->get('diagnosis/edit', 'Diagnosis::edit');
    $routes->get('diagnosis/edit/(:any)', 'Diagnosis::edit/$1');
    $routes->get('diagnosis/update', 'Diagnosis::update');
    $routes->get('diagnosis/update/(:any)', 'Diagnosis::update/$1');
    $routes->get('diagnosis/delete', 'Diagnosis::delete');
    $routes->get('diagnosis/delete/(:any)', 'Diagnosis::delete/$1');

     // Laboratory 
     $routes->get('laboratory', 'Laboratory/Request::index');
     $routes->get('laboratory/request', 'Laboratory\Request::index');
     $routes->get('laboratory/request/view', 'Laboratory\Request::view');
     $routes->get('laboratory/request/view/(:any)', 'Laboratory\Request::view/$1');
     $routes->get('laboratory/request/edit', 'Laboratory\Request::edit');
     $routes->get('laboratory/request/edit/(:any)', 'Laboratory\Request::edit/$1');
     $routes->get('laboratory/request/update', 'Laboratory\Request::update');
     $routes->get('laboratory/request/update/(:any)', 'Laboratory\Request::update/$1');
     $routes->get('laboratory/request/delete', 'Laboratory\Request::delete');
    $routes->get('laboratory/request/delete/(:any)', 'Laboratory\Request::delete/$1');
     $routes->get('laboratory/home', 'Laboratory\Home::index');

    // Pharmacy Inventory
    $routes->get('pharmacy/inventory', 'Pharmacy\Inventory::index');
    $routes->get('pharmacy/inventory/today', 'Pharmacy\Inventory::today');
    $routes->get('pharmacy/inventory/sale', 'Pharmacy\Inventory::sale');
    $routes->get('pharmacy/inventory/sale/(:any)', 'Pharmacy\Inventory::sale/$1');
    $routes->get('pharmacy/inventory/createSale', 'Pharmacy\Inventory::createSale');
    $routes->get('pharmacy/inventory/createSale/(:any)', 'Pharmacy\Inventory::createSale/$1');
    $routes->get('pharmacy/inventory/view', 'Pharmacy\Inventory::view');
    $routes->get('pharmacy/inventory/view/(:any)', 'Pharmacy\Inventory::view/$1');
    $routes->get('pharmacy/inventory/edit', 'Pharmacy\Inventory::edit');
    $routes->get('pharmacy/inventory/edit/(:any)', 'Pharmacy\Inventory::edit/$1');
    $routes->get('pharmacy/inventory/update', 'Pharmacy\Inventory::update');
    $routes->get('pharmacy/inventory/update/(:any)', 'Pharmacy\Inventory::update/$1');
    $routes->get('pharmacy/inventory/delete', 'Pharmacy\Inventory::delete');
    $routes->get('pharmacy/inventory/delete/(:any)', 'Pharmacy\Inventory::delete/$1');

    // Pharmacy Prescription 
    $routes->get('pharmacy/prescription', 'Pharmacy\Prescription::index');
    $routes->get('pharmacy/prescription/request', 'Pharmacy\Prescription::request');
    $routes->get('pharmacy/prescription/view', 'Pharmacy\Prescription::view');
    $routes->get('pharmacy/prescription/view/(:any)', 'Pharmacy\Prescription::view/$1');
    $routes->get('pharmacy/prescription/edit', 'Pharmacy\Prescription::edit');
    $routes->get('pharmacy/prescription/edit/(:any)', 'Pharmacy\Prescription::edit/$1');
    $routes->get('pharmacy/prescription/update', 'Pharmacy\Prescription::update');
    $routes->get('pharmacy/prescription/update/(:any)', 'Pharmacy\Prescription::update/$1');
    $routes->get('pharmacy/prescription/delete', 'Pharmacy\Prescription::delete');
    $routes->get('pharmacy/prescription/delete/(:any)', 'Pharmacy\Prescription::delete/$1');


    // Billing 
    $routes->get('billing', 'Billing::index');
    $routes->get('billing/today', 'Billing::today');
    $routes->get('billing/add', 'Billing::add');
    $routes->get('billing/create', 'Billing::create');
    $routes->get('billing/create/(:any)', 'Billing::create/$1');
    $routes->get('billing/edit', 'Billing::edit');
    $routes->get('billing/edit/(:any)', 'Billing::edit/$1');
    $routes->get('billing/update', 'Billing::update');
    $routes->get('billing/update/(:any)', 'Billing::update/$1');
    $routes->get('billing/view', 'Billing::view');
    $routes->get('billing/view/(:any)', 'Billing::view/$1');
    $routes->get('billing/delete', 'Billing::delete');
    $routes->get('billing/delete/(:any)', 'Billing::delete/$1');

    // Message
    $routes->get('message', 'Message::index');
    $routes->get('message/add', 'Message::add');
    $routes->get('message/create', 'Message::create');
    $routes->get('message/create/(:any)', 'Message::create/$1');
    $routes->get('message/sent', 'Message::sent');
    $routes->get('message/sent/(:any)', 'Message::sent/$1');
    $routes->get('message/inbox_information', 'Message::inbox_information');
    $routes->get('message/inbox_information/(:any)', 'Message::inbox_information/$1');
    $routes->get('message/inbox_information_inbox', 'Message::inbox_information_inbox');
    $routes->get('message/inbox_information_inbox/(:any)', 'Message::inbox_information_inbox/$1');

    // Noticeboard
    $routes->get('noticeboard', 'Noticeboard::index');
    $routes->get('noticeboard/add', 'Noticeboard::add');
    $routes->get('noticeboard/create', 'Noticeboard::create');
    $routes->get('noticeboard/create/(:any)', 'Noticeboard::create/$1');
    $routes->get('noticeboard/view', 'Noticeboard::view');
    $routes->get('noticeboard/view/(:any)', 'Noticeboard::view/$1');
    $routes->get('noticeboard/edit', 'Noticeboard::edit');
    $routes->get('noticeboard/edit/(:any)', 'Noticeboard::edit/$1');
    $routes->get('noticeboard/update', 'Noticeboard::update');
    $routes->get('noticeboard/update/(:any)', 'Noticeboard::update/$1');
    $routes->get('noticeboard/delete', 'Noticeboard::delete');
    $routes->get('noticeboard/delete/(:any)', 'Noticeboard::delete/$1');
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
