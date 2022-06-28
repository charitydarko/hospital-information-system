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


    // Receptionist Routes
    $routes->get('receptionist/dashboard', 'Receptionist\Dashboard::index');
    $routes->get('receptionist/patient', 'Receptionist\Patient::index');
    $routes->get('receptionist/patient/today', 'Receptionist\Patient::today');
    $routes->get('receptionist/patient/view', 'Receptionist\Patient::view');
    $routes->get('receptionist/patient/view/(:any)', 'Receptionist\Patient::view/$1');
    $routes->get('receptionist/patient/new', 'Receptionist\Patient::new');
    $routes->get('receptionist/patient/create', 'Receptionist\Patient::create');
    $routes->get('receptionist/patient/create/(:any)', 'Receptionist\Patient::create/$1');
    $routes->get('receptionist/patient/edit', 'Receptionist\Patient::edit');
    $routes->get('receptionist/patient/edit/(:any)', 'Receptionist\Patient::edit/$1');
    $routes->get('receptionist/patient/update', 'Receptionist\Patient::update');
    $routes->get('receptionist/patient/update/(:any)', 'Receptionist\Patient::update/$1');
    $routes->get('receptionist/patient/document', 'Receptionist\Patient::document');
    $routes->get('receptionist/patient/add_document', 'Receptionist\Patient::add_document');
    $routes->get('receptionist/patient/add_document/(:any)', 'Receptionist\Patient::add_document/$1');
    $routes->get('receptionist/patient/document_upload', 'Receptionist\Patient::document_upload');
    $routes->get('receptionist/patient/document_upload/(:any)', 'Receptionist\Patient::document_upload/$1');
    $routes->get('receptionist/appointment', 'Receptionist\Appointment::index');
    $routes->get('receptionist/appointment/today', 'Receptionist\Appointment::today');
    $routes->get('receptionist/appointment/add', 'Receptionist\Appointment::add');
    $routes->get('receptionist/appointment/create', 'Receptionist\Appointment::create');
    $routes->get('receptionist/appointment/create/(:any)', 'Receptionist\Appointment::create/$1');
    $routes->get('receptionist/appointment/view', 'Receptionist\Appointment::view');
    $routes->get('receptionist/appointment/view/(:any)', 'Receptionist\Appointment::view/$1');
    $routes->get('receptionist/appointment/edit', 'Receptionist\Appointment::edit');
    $routes->get('receptionist/appointment/edit/(:any)', 'Receptionist\Appointment::edit/$1');
    $routes->get('receptionist/appointment/update', 'Receptionist\Appointment::update');
    $routes->get('receptionist/appointment/update/(:any)', 'Receptionist\Appointment::update/$1');
    $routes->get('receptionist/vitals', 'Receptionist\Vitals::index');
    $routes->get('receptionist/vitals/today', 'Receptionist\Vitals::today');
    $routes->get('receptionist/vitals/month', 'Receptionist\Vitals::month');
    $routes->get('receptionist/vitals/add', 'Receptionist\Vitals::add');
    $routes->get('receptionist/vitals/create', 'Receptionist\Vitals::create');
    $routes->get('receptionist/vitals/create/(:any)', 'Receptionist\Vitals::create/$1');
    $routes->get('receptionist/vitals/view', 'Receptionist\Vitals::view');
    $routes->get('receptionist/vitals/view/(:any)', 'Receptionist\Vitals::view/$1');
    $routes->get('receptionist/vitals/edit', 'Receptionist\Vitals::edit');
    $routes->get('receptionist/vitals/edit/(:any)', 'Receptionist\Vitals::edit/$1');
    $routes->get('receptionist/vitals/update', 'Receptionist\Vitals::update');
    $routes->get('receptionist/vitals/update/(:any)', 'Receptionist\Vitals::update/$1');
    $routes->get('receptionist/message', 'Receptionist\Message::index');
    $routes->get('receptionist/message/add', 'Receptionist\Message::add');
    $routes->get('receptionist/message/create', 'Receptionist\Message::create');
    $routes->get('receptionist/message/create/(:any)', 'Receptionist\Message::create/$1');
    $routes->get('receptionist/message/sent', 'Receptionist\Message::sent');
    $routes->get('receptionist/message/sent/(:any)', 'Receptionist\Message::sent/$1');
    $routes->get('receptionist/message/inbox_information', 'Receptionist\Message::inbox_information');
    $routes->get('receptionist/message/inbox_information/(:any)', 'Receptionist\Message::inbox_information/$1');
    $routes->get('receptionist/message/inbox_information_inbox', 'Receptionist\Message::inbox_information_inbox');
    $routes->get('receptionist/message/inbox_information_inbox/(:any)', 'Receptionist\Message::inbox_information_inbox/$1');
    $routes->get('receptionist/noticeboard', 'Receptionist\Noticeboard::index');
    $routes->get('receptionist/noticeboard/view', 'Receptionist\Noticeboard::view');
    $routes->get('receptionist/noticeboard/view/(:any)', 'Receptionist\Noticeboard::view/$1');
    $routes->get('receptionist/user/view', 'Receptionist/User::view');
    $routes->get('receptionist/user/view/(:any)', 'Receptionist/User::view/$1');
    $routes->get('receptionist/user/edit', 'Receptionist/User::edit');
    $routes->get('receptionist/user/edit/(:any)', 'Receptionist/User::edit/$1');
    $routes->get('receptionist/user/update', 'Receptionist/User::update');
    $routes->get('receptionist/user/update/(:any)', 'Receptionist/User::update/$1');
    $routes->get('receptionist/user/reset_password', 'Receptionist/User::reset_password');
    $routes->get('receptionist/user/reset_password/(:any)', 'Receptionist/User::reset_password/$1');
    $routes->get('receptionist/user/update_password', 'Receptionist/User::update_password');
    $routes->get('receptionist/user/update_password/(:any)', 'Receptionist/User::update_password/$1');


    // Doctor Routes
    $routes->get('doctor/dashboard', 'Doctor\Dashboard::index');
    $routes->get('doctor/patient', 'Doctor\Patient::index');
    $routes->get('doctor/today', 'Doctor\Patient::today');
    $routes->get('doctor/patient/view', 'Doctor\Patient::view');
    $routes->get('doctor/patient/view/(:any)', 'Doctor\Patient::view/$1');
    $routes->get('doctor/patient/new', 'Doctor\Patient::new');
    $routes->get('doctor/patient/create', 'Doctor\Patient::create');
    $routes->get('doctor/patient/create/(:any)', 'Doctor\Patient::create/$1');
    $routes->get('doctor/patient/edit', 'Doctor\Patient::edit');
    $routes->get('doctor/patient/edit/(:any)', 'Doctor\Patient::edit/$1');
    $routes->get('doctor/patient/update', 'Doctor\Patient::update');
    $routes->get('doctor/patient/update/(:any)', 'Doctor\Patient::update/$1');
    $routes->get('doctor/patient/document', 'Doctor\Patient::document');
    $routes->get('doctor/patient/add_document', 'Doctor\Patient::add_document');
    $routes->get('doctor/patient/add_document/(:any)', 'Doctor\Patient::add_document/$1');
    $routes->get('doctor/patient/document_upload', 'Doctor\Patient::document_upload');
    $routes->get('doctor/patient/document_upload/(:any)', 'Doctor\Patient::document_upload/$1');
    $routes->get('doctor/appointment', 'Doctor\Appointment::index');
    $routes->get('doctor/appointment/today', 'Doctor\Appointment::today');
    $routes->get('doctor/appointment/add', 'Doctor\Appointment::add');
    $routes->get('doctor/appointment/create', 'Doctor\Appointment::create');
    $routes->get('doctor/appointment/create/(:any)', 'Doctor\Appointment::create/$1');
    $routes->get('doctor/appointment/view', 'Doctor\Appointment::view');
    $routes->get('doctor/appointment/view/(:any)', 'Doctor\Appointment::view/$1');
    $routes->get('doctor/appointment/edit', 'Doctor\Appointment::edit');
    $routes->get('doctor/appointment/edit/(:any)', 'Doctor\Appointment::edit/$1');
    $routes->get('doctor/appointment/update', 'Doctor\Appointment::update');
    $routes->get('doctor/appointment/update/(:any)', 'Doctor\Appointment::update/$1');
    $routes->get('doctor/vitals', 'Doctor\Vitals::index');
    $routes->get('doctor/vitals/today', 'Doctor\Vitals::today');
    $routes->get('doctor/vitals/month', 'Doctor\Vitals::month');
    $routes->get('doctor/vitals/add', 'Doctor\Vitals::add');
    $routes->get('doctor/vitals/create', 'Doctor\Vitals::create');
    $routes->get('doctor/vitals/create/(:any)', 'Doctor\Vitals::create/$1');
    $routes->get('doctor/vitals/view', 'Doctor\Vitals::view');
    $routes->get('doctor/vitals/view/(:any)', 'Doctor\Vitals::view/$1');
    $routes->get('doctor/vitals/edit', 'Doctor\Vitals::edit');
    $routes->get('doctor/vitals/edit/(:any)', 'Doctor\Vitals::edit/$1');
    $routes->get('doctor/vitals/update', 'Doctor\Vitals::update');
    $routes->get('doctor/vitals/update/(:any)', 'Doctor\Vitals::update/$1');
    $routes->get('doctor/diagnosis', 'Doctor\Diagnosis::index');
    $routes->get('doctor/diagnosis/today', 'Doctor\Diagnosis::today');
    $routes->get('doctor/diagnosis/add', 'Doctor\Diagnosis::add');
    $routes->get('doctor/diagnosis/create', 'Doctor\Diagnosis::create');
    $routes->get('doctor/diagnosis/create/(:any)', 'Doctor\Diagnosis::create/$1');
    $routes->get('doctor/diagnosis/view', 'Doctor\Diagnosis::view');
    $routes->get('doctor/diagnosis/view/(:any)', 'Doctor\Diagnosis::view/$1');
    $routes->get('doctor/diagnosis/edit', 'Doctor\Diagnosis::edit');
    $routes->get('doctor/diagnosis/edit/(:any)', 'Doctor\Diagnosis::edit/$1');
    $routes->get('doctor/diagnosis/update', 'Doctor\Diagnosis::update');
    $routes->get('doctor/diagnosis/update/(:any)', 'Doctor\Diagnosis::update/$1');
    $routes->get('doctor/message', 'Doctor\Message::index');
    $routes->get('doctor/message/add', 'Doctor\Message::add');
    $routes->get('doctor/message/create', 'Doctor\Message::create');
    $routes->get('doctor/message/create/(:any)', 'Doctor\Message::create/$1');
    $routes->get('doctor/message/sent', 'Doctor\Message::sent');
    $routes->get('doctor/message/sent/(:any)', 'Doctor\Message::sent/$1');
    $routes->get('doctor/message/inbox_information', 'Doctor\Message::inbox_information');
    $routes->get('doctor/message/inbox_information/(:any)', 'Doctor\Message::inbox_information/$1');
    $routes->get('doctor/message/inbox_information_inbox', 'Doctor\Message::inbox_information_inbox');
    $routes->get('doctor/message/inbox_information_inbox/(:any)', 'Doctor\Message::inbox_information_inbox/$1');
    $routes->get('doctor/noticeboard', 'Doctor\Noticeboard::index');
    $routes->get('doctor/noticeboard/view', 'Doctor\Noticeboard::view');
    $routes->get('doctor/noticeboard/view/(:any)', 'Doctor\Noticeboard::view/$1');
    $routes->get('doctor/user/view', 'Doctor/User::view');
    $routes->get('doctor/user/view/(:any)', 'Doctor/User::view/$1');
    $routes->get('doctor/user/edit', 'Doctor/User::edit');
    $routes->get('doctor/user/edit/(:any)', 'Doctor/User::edit/$1');
    $routes->get('doctor/user/update', 'Doctor/User::update');
    $routes->get('doctor/user/update/(:any)', 'Doctor/User::update/$1');
    $routes->get('doctor/user/reset_password', 'Doctor/User::reset_password');
    $routes->get('doctor/user/reset_password/(:any)', 'Doctor/User::reset_password/$1');
    $routes->get('doctor/user/update_password', 'Doctor/User::update_password');
    $routes->get('doctor/user/update_password/(:any)', 'Doctor/User::update_password/$1');
    
    // Pharmacist Routes
    $routes->get('pharmacist/dashboard', 'Pharmacist\Dashboard::index');
    $routes->get('pharmacist/dashboard', 'Pharmacist\Dashboard::index');
    $routes->get('pharmacist/patient', 'Pharmacist\Patient::index');
    $routes->get('pharmacist/patient/today', 'Pharmacist\Patient::today');
    $routes->get('pharmacist/patient/view', 'Pharmacist\Patient::view');
    $routes->get('pharmacist/patient/view/(:any)', 'Pharmacist\Patient::view/$1');
    $routes->get('pharmacist/patient/new', 'Pharmacist\Patient::new');
    $routes->get('pharmacist/patient/create', 'Pharmacist\Patient::create');
    $routes->get('pharmacist/patient/create/(:any)', 'Pharmacist\Patient::create/$1');
    $routes->get('pharmacist/patient/edit', 'Pharmacist\Patient::edit');
    $routes->get('pharmacist/patient/edit/(:any)', 'Pharmacist\Patient::edit/$1');
    $routes->get('pharmacist/patient/update', 'Pharmacist\Patient::update');
    $routes->get('pharmacist/patient/update/(:any)', 'Pharmacist\Patient::update/$1');
    $routes->get('pharmacist/patient/document', 'Pharmacist\Patient::document');
    $routes->get('pharmacist/patient/add_document', 'Pharmacist\Patient::add_document');
    $routes->get('pharmacist/patient/add_document/(:any)', 'Pharmacist\Patient::add_document/$1');
    $routes->get('pharmacist/patient/document_upload', 'Pharmacist\Patient::document_upload');
    $routes->get('pharmacist/patient/document_upload/(:any)', 'Pharmacist\Patient::document_upload/$1');
    $routes->get('pharmacist/appointment', 'Pharmacist\Appointment::index');
    $routes->get('pharmacist/appointment/today', 'Pharmacist\Appointment::today');
    $routes->get('pharmacist/appointment/add', 'Pharmacist\Appointment::add');
    $routes->get('pharmacist/appointment/create', 'Pharmacist\Appointment::create');
    $routes->get('pharmacist/appointment/create/(:any)', 'Pharmacist\Appointment::create/$1');
    $routes->get('pharmacist/appointment/view', 'Pharmacist\Appointment::view');
    $routes->get('pharmacist/appointment/view/(:any)', 'Pharmacist\Appointment::view/$1');
    $routes->get('pharmacist/appointment/edit', 'Pharmacist\Appointment::edit');
    $routes->get('pharmacist/appointment/edit/(:any)', 'Pharmacist\Appointment::edit/$1');
    $routes->get('pharmacist/appointment/update', 'Pharmacist\Appointment::update');
    $routes->get('pharmacist/appointment/update/(:any)', 'Pharmacist\Appointment::update/$1');
    $routes->get('pharmacist/vitals', 'Pharmacist\Vitals::index');
    $routes->get('pharmacist/vitals/today', 'Pharmacist\Vitals::today');
    $routes->get('pharmacist/vitals/month', 'Pharmacist\Vitals::month');
    $routes->get('pharmacist/vitals/add', 'Pharmacist\Vitals::add');
    $routes->get('pharmacist/vitals/create', 'Pharmacist\Vitals::create');
    $routes->get('pharmacist/vitals/create/(:any)', 'Pharmacist\Vitals::create/$1');
    $routes->get('pharmacist/vitals/view', 'Pharmacist\Vitals::view');
    $routes->get('pharmacist/vitals/view/(:any)', 'Pharmacist\Vitals::view/$1');
    $routes->get('pharmacist/vitals/edit', 'Pharmacist\Vitals::edit');
    $routes->get('pharmacist/vitals/edit/(:any)', 'Pharmacist\Vitals::edit/$1');
    $routes->get('pharmacist/vitals/update', 'Pharmacist\Vitals::update');
    $routes->get('pharmacist/vitals/update/(:any)', 'Pharmacist\Vitals::update/$1');
    $routes->get('pharmacist/inventory', 'Pharmacist\Inventory::index');
    $routes->get('pharmacist/inventory/today', 'Pharmacist\Inventory::today');
    $routes->get('pharmacist/inventory/sale', 'Pharmacist\Inventory::sale');
    $routes->get('pharmacist/inventory/sale/(:any)', 'Pharmacist\Inventory::sale/$1');
    $routes->get('pharmacist/inventory/createSale', 'Pharmacist\Inventory::createSale');
    $routes->get('pharmacist/inventory/createSale/(:any)', 'Pharmacist\Inventory::createSale/$1');
    $routes->get('pharmacist/inventory/view', 'Pharmacist\Inventory::view');
    $routes->get('pharmacist/inventory/view/(:any)', 'Pharmacist\Inventory::view/$1');
    $routes->get('pharmacist/inventory/edit', 'Pharmacist\Inventory::edit');
    $routes->get('pharmacist/inventory/edit/(:any)', 'Pharmacist\Inventory::edit/$1');
    $routes->get('pharmacist/inventory/update', 'Pharmacist\Inventory::update');
    $routes->get('pharmacist/inventory/update/(:any)', 'Pharmacist\Inventory::update/$1');
    $routes->get('pharmacist/prescription', 'Pharmacist\Prescription::index');
    $routes->get('pharmacist/prescription/request', 'Pharmacist\Prescription::request');
    $routes->get('pharmacist/prescription/view', 'Pharmacist\Prescription::view');
    $routes->get('pharmacist/prescription/view/(:any)', 'Pharmacist\Prescription::view/$1');
    $routes->get('pharmacist/prescription/edit', 'Pharmacist\Prescription::edit');
    $routes->get('pharmacist/prescription/edit/(:any)', 'Pharmacist\Prescription::edit/$1');
    $routes->get('pharmacist/prescription/update', 'Pharmacist\Prescription::update');
    $routes->get('pharmacist/prescription/update/(:any)', 'Pharmacist\Prescription::update/$1');
    $routes->get('pharmacist/message', 'Pharmacist\Message::index');
    $routes->get('pharmacist/message/add', 'Pharmacist\Message::add');
    $routes->get('pharmacist/message/create', 'Pharmacist\Message::create');
    $routes->get('pharmacist/message/create/(:any)', 'Pharmacist\Message::create/$1');
    $routes->get('pharmacist/message/sent', 'Pharmacist\Message::sent');
    $routes->get('pharmacist/message/sent/(:any)', 'Pharmacist\Message::sent/$1');
    $routes->get('pharmacist/message/inbox_information', 'Pharmacist\Message::inbox_information');
    $routes->get('pharmacist/message/inbox_information/(:any)', 'Pharmacist\Message::inbox_information/$1');
    $routes->get('pharmacist/message/inbox_information_inbox', 'Pharmacist\Message::inbox_information_inbox');
    $routes->get('pharmacist/message/inbox_information_inbox/(:any)', 'Pharmacist\Message::inbox_information_inbox/$1');
    $routes->get('pharmacist/noticeboard', 'Pharmacist\Noticeboard::index');
    $routes->get('pharmacist/noticeboard/view', 'Pharmacist\Noticeboard::view');
    $routes->get('pharmacist/noticeboard/view/(:any)', 'Pharmacist\Noticeboard::view/$1');
    $routes->get('pharmacist/user/view', 'Pharmacist/User::view');
    $routes->get('pharmacist/user/view/(:any)', 'Pharmacist/User::view/$1');
    $routes->get('pharmacist/user/edit', 'Pharmacist/User::edit');
    $routes->get('pharmacist/user/edit/(:any)', 'Pharmacist/User::edit/$1');
    $routes->get('pharmacist/user/update', 'Pharmacist/User::update');
    $routes->get('pharmacist/user/update/(:any)', 'Pharmacist/User::update/$1');
    $routes->get('pharmacist/user/reset_password', 'Pharmacist/User::reset_password');
    $routes->get('pharmacist/user/reset_password/(:any)', 'Pharmacist/User::reset_password/$1');
    $routes->get('pharmacist/user/update_password', 'Pharmacist/User::update_password');
    $routes->get('pharmacist/user/update_password/(:any)', 'Pharmacist/User::update_password/$1');

    // Laboratorist Routes
    $routes->get('laboratorist/dashboard', 'Laboratorist\Dashboard::index');
    $routes->get('laboratorist/patient', 'Laboratorist\Patient::index');
    $routes->get('laboratorist/patient/today', 'Laboratorist\Patient::today');
    $routes->get('laboratorist/patient/view', 'Laboratorist\Patient::view');
    $routes->get('laboratorist/patient/view/(:any)', 'Laboratorist\Patient::view/$1');
    $routes->get('laboratorist/patient/new', 'Laboratorist\Patient::new');
    $routes->get('laboratorist/patient/create', 'Laboratorist\Patient::create');
    $routes->get('laboratorist/patient/create/(:any)', 'Laboratorist\Patient::create/$1');
    $routes->get('laboratorist/patient/edit', 'Laboratorist\Patient::edit');
    $routes->get('laboratorist/patient/edit/(:any)', 'Laboratorist\Patient::edit/$1');
    $routes->get('laboratorist/patient/update', 'Laboratorist\Patient::update');
    $routes->get('laboratorist/patient/update/(:any)', 'Laboratorist\Patient::update/$1');
    $routes->get('laboratorist/patient/document', 'Laboratorist\Patient::document');
    $routes->get('laboratorist/patient/add_document', 'Laboratorist\Patient::add_document');
    $routes->get('laboratorist/patient/add_document/(:any)', 'Laboratorist\Patient::add_document/$1');
    $routes->get('laboratorist/patient/document_upload', 'Laboratorist\Patient::document_upload');
    $routes->get('laboratorist/patient/document_upload/(:any)', 'Laboratorist\Patient::document_upload/$1');
    $routes->get('laboratorist/appointment', 'Laboratorist\Appointment::index');
    $routes->get('laboratorist/appointment/today', 'Laboratorist\Appointment::today');
    $routes->get('laboratorist/appointment/add', 'Laboratorist\Appointment::add');
    $routes->get('laboratorist/appointment/create', 'Laboratorist\Appointment::create');
    $routes->get('laboratorist/appointment/create/(:any)', 'Laboratorist\Appointment::create/$1');
    $routes->get('laboratorist/appointment/view', 'Laboratorist\Appointment::view');
    $routes->get('laboratorist/appointment/view/(:any)', 'Laboratorist\Appointment::view/$1');
    $routes->get('laboratorist/appointment/edit', 'Laboratorist\Appointment::edit');
    $routes->get('laboratorist/appointment/edit/(:any)', 'Laboratorist\Appointment::edit/$1');
    $routes->get('laboratorist/appointment/update', 'Laboratorist\Appointment::update');
    $routes->get('laboratorist/appointment/update/(:any)', 'Laboratorist\Appointment::update/$1');
    $routes->get('laboratorist/vitals', 'Laboratorist\Vitals::index');
    $routes->get('laboratorist/vitals/today', 'Laboratorist\Vitals::today');
    $routes->get('laboratorist/vitals/month', 'Laboratorist\Vitals::month');
    $routes->get('laboratorist/vitals/add', 'Laboratorist\Vitals::add');
    $routes->get('laboratorist/vitals/create', 'Laboratorist\Vitals::create');
    $routes->get('laboratorist/vitals/create/(:any)', 'Laboratorist\Vitals::create/$1');
    $routes->get('laboratorist/vitals/view', 'Laboratorist\Vitals::view');
    $routes->get('laboratorist/vitals/view/(:any)', 'Laboratorist\Vitals::view/$1');
    $routes->get('laboratorist/vitals/edit', 'Laboratorist\Vitals::edit');
    $routes->get('laboratorist/vitals/edit/(:any)', 'Laboratorist\Vitals::edit/$1');
    $routes->get('laboratorist/vitals/update', 'Laboratorist\Vitals::update');
    $routes->get('laboratorist/vitals/update/(:any)', 'Laboratorist\Vitals::update/$1');
    $routes->get('laboratorist/message', 'Laboratorist\Message::index');
    $routes->get('laboratorist/message/add', 'Laboratorist\Message::add');
    $routes->get('laboratorist/message/create', 'Laboratorist\Message::create');
    $routes->get('laboratorist/message/create/(:any)', 'Laboratorist\Message::create/$1');
    $routes->get('laboratorist/message/sent', 'Laboratorist\Message::sent');
    $routes->get('laboratorist/message/sent/(:any)', 'Laboratorist\Message::sent/$1');
    $routes->get('laboratorist/message/inbox_information', 'Laboratorist\Message::inbox_information');
    $routes->get('laboratorist/message/inbox_information/(:any)', 'Laboratorist\Message::inbox_information/$1');
    $routes->get('laboratorist/message/inbox_information_inbox', 'Laboratorist\Message::inbox_information_inbox');
    $routes->get('laboratorist/message/inbox_information_inbox/(:any)', 'Laboratorist\Message::inbox_information_inbox/$1');
    $routes->get('laboratorist/noticeboard', 'Laboratorist\Noticeboard::index');
    $routes->get('laboratorist/noticeboard/view', 'Laboratorist\Noticeboard::view');
    $routes->get('laboratorist/noticeboard/view/(:any)', 'Laboratorist\Noticeboard::view/$1');
    $routes->get('laboratorist/user/view', 'Laboratorist/User::view');
    $routes->get('laboratorist/user/view/(:any)', 'Laboratorist/User::view/$1');
    $routes->get('laboratorist/user/edit', 'Laboratorist/User::edit');
    $routes->get('laboratorist/user/edit/(:any)', 'Laboratorist/User::edit/$1');
    $routes->get('laboratorist/user/update', 'Laboratorist/User::update');
    $routes->get('laboratorist/user/update/(:any)', 'Laboratorist/User::update/$1');
    $routes->get('laboratorist/user/reset_password', 'Laboratorist/User::reset_password');
    $routes->get('laboratorist/user/reset_password/(:any)', 'Laboratorist/User::reset_password/$1');
    $routes->get('laboratorist/user/update_password', 'Laboratorist/User::update_password');
    $routes->get('laboratorist/user/update_password/(:any)', 'Laboratorist/User::update_password/$1');
    $routes->get('laboratorist/request', 'Laboratorist\Request::index');
    $routes->get('laboratorist/request/view', 'Laboratorist\Request::view');
    $routes->get('laboratorist/request/view/(:any)', 'Laboratorist\Request::view/$1');
    $routes->get('laboratorist/request/edit', 'Laboratorist\Request::edit');
    $routes->get('laboratorist/request/edit/(:any)', 'Laboratorist\Request::edit/$1');
    $routes->get('laboratorist/request/update', 'Laboratorist\Request::update');
    $routes->get('laboratorist/request/update/(:any)', 'Laboratorist\Request::update/$1');

    // Cashier Routes
    $routes->get('cashier/dashboard', 'Cashier\Dashboard::index');
    $routes->get('cashier/patient', 'Cashier\Patient::index');
    $routes->get('cashier/patient/today', 'Cashier\Patient::today');
    $routes->get('cashier/patient/view', 'Cashier\Patient::view');
    $routes->get('cashier/patient/view/(:any)', 'Cashier\Patient::view/$1');
    $routes->get('cashier/patient/new', 'Cashier\Patient::new');
    $routes->get('cashier/patient/create', 'Cashier\Patient::create');
    $routes->get('cashier/patient/create/(:any)', 'Cashier\Patient::create/$1');
    $routes->get('cashier/patient/edit', 'Cashier\Patient::edit');
    $routes->get('cashier/patient/edit/(:any)', 'Cashier\Patient::edit/$1');
    $routes->get('cashier/patient/update', 'Cashier\Patient::update');
    $routes->get('cashier/patient/update/(:any)', 'Cashier\Patient::update/$1');
    $routes->get('cashier/patient/document', 'Cashier\Patient::document');
    $routes->get('cashier/patient/add_document', 'Cashier\Patient::add_document');
    $routes->get('cashier/patient/add_document/(:any)', 'Cashier\Patient::add_document/$1');
    $routes->get('cashier/patient/document_upload', 'Cashier\Patient::document_upload');
    $routes->get('cashier/patient/document_upload/(:any)', 'Cashier\Patient::document_upload/$1');
    $routes->get('cashier/appointment', 'Cashier\Appointment::index');
    $routes->get('cashier/appointment/today', 'Cashier\Appointment::today');
    $routes->get('cashier/appointment/add', 'Cashier\Appointment::add');
    $routes->get('cashier/appointment/create', 'Cashier\Appointment::create');
    $routes->get('cashier/appointment/create/(:any)', 'Cashier\Appointment::create/$1');
    $routes->get('cashier/appointment/view', 'Cashier\Appointment::view');
    $routes->get('cashier/appointment/view/(:any)', 'Cashier\Appointment::view/$1');
    $routes->get('cashier/appointment/edit', 'Cashier\Appointment::edit');
    $routes->get('cashier/appointment/edit/(:any)', 'Cashier\Appointment::edit/$1');
    $routes->get('cashier/appointment/update', 'Cashier\Appointment::update');
    $routes->get('cashier/appointment/update/(:any)', 'Cashier\Appointment::update/$1');
    $routes->get('cashier/vitals', 'Cashier\Vitals::index');
    $routes->get('cashier/vitals/today', 'Cashier\Vitals::today');
    $routes->get('cashier/vitals/month', 'Cashier\Vitals::month');
    $routes->get('cashier/vitals/add', 'Cashier\Vitals::add');
    $routes->get('cashier/vitals/create', 'Cashier\Vitals::create');
    $routes->get('cashier/vitals/create/(:any)', 'Cashier\Vitals::create/$1');
    $routes->get('cashier/vitals/view', 'Cashier\Vitals::view');
    $routes->get('cashier/vitals/view/(:any)', 'Cashier\Vitals::view/$1');
    $routes->get('cashier/vitals/edit', 'Cashier\Vitals::edit');
    $routes->get('cashier/vitals/edit/(:any)', 'Cashier\Vitals::edit/$1');
    $routes->get('cashier/vitals/update', 'Cashier\Vitals::update');
    $routes->get('cashier/vitals/update/(:any)', 'Cashier\Vitals::update/$1');
    $routes->get('cashier/billing/today', 'Cashier\Billing::today');
    $routes->get('cashier/billing/add', 'Cashier\Billing::add');
    $routes->get('cashier/billing/create', 'Cashier\Billing::create');
    $routes->get('cashier/billing/create/(:any)', 'Cashier\Billing::create/$1');
    $routes->get('cashier/billing/edit', 'Cashier\Billing::edit');
    $routes->get('cashier/billing/edit/(:any)', 'Cashier\Billing::edit/$1');
    $routes->get('cashier/billing/update', 'Cashier\Billing::update');
    $routes->get('cashier/billing/update/(:any)', 'Cashier\Billing::update/$1');
    $routes->get('cashier/billing/view', 'Cashier\Billing::view');
    $routes->get('cashier/billing/view/(:any)', 'Cashier\Billing::view/$1');
    $routes->get('cashier/message', 'Cashier\Message::index');
    $routes->get('cashier/message/add', 'Cashier\Message::add');
    $routes->get('cashier/message/create', 'Cashier\Message::create');
    $routes->get('cashier/message/create/(:any)', 'Cashier\Message::create/$1');
    $routes->get('cashier/message/sent', 'Cashier\Message::sent');
    $routes->get('cashier/message/sent/(:any)', 'Cashier\Message::sent/$1');
    $routes->get('cashier/message/inbox_information', 'Cashier\Message::inbox_information');
    $routes->get('cashier/message/inbox_information/(:any)', 'Cashier\Message::inbox_information/$1');
    $routes->get('cashier/message/inbox_information_inbox', 'Cashier\Message::inbox_information_inbox');
    $routes->get('cashier/message/inbox_information_inbox/(:any)', 'Cashier\Message::inbox_information_inbox/$1');
    $routes->get('cashier/noticeboard', 'Cashier\Noticeboard::index');
    $routes->get('cashier/noticeboard/view', 'Cashier\Noticeboard::view');
    $routes->get('cashier/noticeboard/view/(:any)', 'Cashier\Noticeboard::view/$1');
    $routes->get('cashier/user/view', 'Cashier/User::view');
    $routes->get('cashier/user/view/(:any)', 'Cashier/User::view/$1');
    $routes->get('cashier/user/edit', 'Cashier/User::edit');
    $routes->get('cashier/user/edit/(:any)', 'Cashier/User::edit/$1');
    $routes->get('cashier/user/update', 'Cashier/User::update');
    $routes->get('cashier/user/update/(:any)', 'Cashier/User::update/$1');
    $routes->get('cashier/user/reset_password', 'Cashier/User::reset_password');
    $routes->get('cashier/user/reset_password/(:any)', 'Cashier/User::reset_password/$1');
    $routes->get('cashier/user/update_password', 'Cashier/User::update_password');
    $routes->get('cashier/user/update_password/(:any)', 'Cashier/User::update_password/$1');

    // Accountant Routes
    $routes->get('accountant/dashboard', 'Accountant\Dashboard::index');
    $routes->get('accountant/patient', 'Accountant\Patient::index');
    $routes->get('accountant/patient/today', 'Accountant\Patient::today');
    $routes->get('accountant/patient/view', 'Accountant\Patient::view');
    $routes->get('accountant/patient/view/(:any)', 'Accountant\Patient::view/$1');
    $routes->get('accountant/patient/new', 'Accountant\Patient::new');
    $routes->get('accountant/patient/create', 'Accountant\Patient::create');
    $routes->get('accountant/patient/create/(:any)', 'Accountant\Patient::create/$1');
    $routes->get('accountant/patient/edit', 'Accountant\Patient::edit');
    $routes->get('accountant/patient/edit/(:any)', 'Accountant\Patient::edit/$1');
    $routes->get('accountant/patient/update', 'Accountant\Patient::update');
    $routes->get('accountant/patient/update/(:any)', 'Accountant\Patient::update/$1');
    $routes->get('accountant/patient/document', 'Accountant\Patient::document');
    $routes->get('accountant/patient/add_document', 'Accountant\Patient::add_document');
    $routes->get('accountant/patient/add_document/(:any)', 'Accountant\Patient::add_document/$1');
    $routes->get('accountant/patient/document_upload', 'Accountant\Patient::document_upload');
    $routes->get('accountant/patient/document_upload/(:any)', 'Accountant\Patient::document_upload/$1');
    $routes->get('accountant/appointment', 'Accountant\Appointment::index');
    $routes->get('accountant/appointment/today', 'Accountant\Appointment::today');
    $routes->get('accountant/appointment/add', 'Accountant\Appointment::add');
    $routes->get('accountant/appointment/create', 'Accountant\Appointment::create');
    $routes->get('accountant/appointment/create/(:any)', 'Accountant\Appointment::create/$1');
    $routes->get('accountant/appointment/view', 'Accountant\Appointment::view');
    $routes->get('accountant/appointment/view/(:any)', 'Accountant\Appointment::view/$1');
    $routes->get('accountant/appointment/edit', 'Accountant\Appointment::edit');
    $routes->get('accountant/appointment/edit/(:any)', 'Accountant\Appointment::edit/$1');
    $routes->get('accountant/appointment/update', 'Accountant\Appointment::update');
    $routes->get('accountant/appointment/update/(:any)', 'Accountant\Appointment::update/$1');
    $routes->get('accountant/vitals', 'Accountant\Vitals::index');
    $routes->get('accountant/vitals/today', 'Accountant\Vitals::today');
    $routes->get('accountant/vitals/month', 'Accountant\Vitals::month');
    $routes->get('accountant/vitals/add', 'Accountant\Vitals::add');
    $routes->get('accountant/vitals/create', 'Accountant\Vitals::create');
    $routes->get('accountant/vitals/create/(:any)', 'Accountant\Vitals::create/$1');
    $routes->get('accountant/vitals/view', 'Accountant\Vitals::view');
    $routes->get('accountant/vitals/view/(:any)', 'Accountant\Vitals::view/$1');
    $routes->get('accountant/vitals/edit', 'Accountant\Vitals::edit');
    $routes->get('accountant/vitals/edit/(:any)', 'Accountant\Vitals::edit/$1');
    $routes->get('accountant/vitals/update', 'Accountant\Vitals::update');
    $routes->get('accountant/vitals/update/(:any)', 'Accountant\Vitals::update/$1');
    $routes->get('accountant/billing/today', 'Accountant\Billing::today');
    $routes->get('accountant/billing/add', 'Accountant\Billing::add');
    $routes->get('accountant/billing/create', 'Accountant\Billing::create');
    $routes->get('accountant/billing/create/(:any)', 'Accountant\Billing::create/$1');
    $routes->get('accountant/billing/edit', 'Accountant\Billing::edit');
    $routes->get('accountant/billing/edit/(:any)', 'Accountant\Billing::edit/$1');
    $routes->get('accountant/billing/update', 'Accountant\Billing::update');
    $routes->get('accountant/billing/update/(:any)', 'Accountant\Billing::update/$1');
    $routes->get('accountant/billing/view', 'Accountant\Billing::view');
    $routes->get('accountant/billing/view/(:any)', 'Accountant\Billing::view/$1');
    $routes->get('accountant/message', 'Accountant\Message::index');
    $routes->get('accountant/message/add', 'Accountant\Message::add');
    $routes->get('accountant/message/create', 'Accountant\Message::create');
    $routes->get('accountant/message/create/(:any)', 'Accountant\Message::create/$1');
    $routes->get('accountant/message/sent', 'Accountant\Message::sent');
    $routes->get('accountant/message/sent/(:any)', 'Accountant\Message::sent/$1');
    $routes->get('accountant/message/inbox_information', 'Accountant\Message::inbox_information');
    $routes->get('accountant/message/inbox_information/(:any)', 'Accountant\Message::inbox_information/$1');
    $routes->get('accountant/message/inbox_information_inbox', 'Accountant\Message::inbox_information_inbox');
    $routes->get('accountant/message/inbox_information_inbox/(:any)', 'Accountant\Message::inbox_information_inbox/$1');
    $routes->get('accountant/noticeboard', 'Accountant\Noticeboard::index');
    $routes->get('accountant/noticeboard/view', 'Accountant\Noticeboard::view');
    $routes->get('accountant/noticeboard/view/(:any)', 'Accountant\Noticeboard::view/$1');
    $routes->get('accountant/user/view', 'Accountant\User::view');
    $routes->get('accountant/user/view/(:any)', 'Accountant\User::view/$1');
    $routes->get('accountant/user/edit', 'Accountant\User::edit');
    $routes->get('accountant/user/edit/(:any)', 'Accountant\User::edit/$1');
    $routes->get('accountant/user/update', 'Accountant\User::update');
    $routes->get('accountant/user/update/(:any)', 'Accountant\User::update/$1');
    $routes->get('accountant/user/reset_password', 'Accountant\User::reset_password');
    $routes->get('accountant/user/reset_password/(:any)', 'Accountant\User::reset_password/$1');
    $routes->get('accountant/user/update_password', 'Accountant\User::update_password');
    $routes->get('accountant/user/update_password/(:any)', 'Accountant\User::update_password/$1');

    // Accountant Routes
    $routes->get('admin/dashboard', 'Admin\Dashboard::index');
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
