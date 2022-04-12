<?php

namespace App\Controllers;

class Dashboard extends BaseController
{  
  private $heading = "Dashboard";

  public function __construct() {
  }

  public function index() {      
    $data['heading'] = $this->heading;
    $data['title'] = 'Home';
    $data['doctors'] = sizeof($this->user_model->find(['user_role',2]));
    $data['patients'] = sizeof($this->patient_model->findAll());
    $data['appointments'] = sizeof($this->appointment_model->findAll());
    $data['prescriptions'] = sizeof($this->prescription_model->findAll());
    $data['notice'] = $this->noticeboard_model->findAll();
    $data['staff'] = $this->user_model;
    $data['messages'] = $this->message_model->find(['receiver_id', session()->get('id')]);
    $data['content']  = view('home',$data);
    return view('layout/main_wrapper',$data);
  }
}
