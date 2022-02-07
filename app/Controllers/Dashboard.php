<?php

namespace App\Controllers;

class Dashboard extends BaseController
{  
  private $heading = "Dashboard";

  public function __construct() {
  }

  public function index() {      

    $data['isPost'] = $this->request->getMethod()=='post'; 
    $data['heading'] = $this->heading;
    $data['title'] = 'Home';
    $data['picture'] = '';
    $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
    $data['content']  = view('home',$data);
    return view('layout/main_wrapper',$data);
  }
}
