<?php

namespace App\Controllers\HumanResources;

use App\Controllers\BaseController;

class Employee extends BaseController
{
  private $heading = "Human Resources";
  private $model;

  public function __construct() {
    helper(['form']);
    $this->session = session();
    $this->uri = new \CodeIgniter\HTTP\URI();
    $this->employee_model = model(UserModel::class);

    if ($this->session->get('isLoggedIn') != null) {
      $data['heading'] = $this->heading;
      $data['userRoles'] = $this->user_roles();
      $data['heading'] = $this->heading;
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['content']  = view('human_resources/form',$data);
    }
  }

  public function index($user_role = 'Representative') { 	 
		$data['title'] = 'List';
		$role_id     = $this->user_roles($user_role);
		#-------------------------------#
    $data['isPost'] = $this->request->getMethod()=='post';
		$data['employees'] = $this->employee_model->read($role_id);
    $data['userRoles'] = $this->user_roles();
		$data['content'] = view('human_resources/view', $data);
		return view('layout/main_wrapper',$data);
	}

  // Default function
  public function form() {    
    if ($this->session->get('isLoggedIn') === null && $this->session->get('user_role') != '1') {
      return redirect()->to('auth/login');
    }
    // Continue if user is authenticated
    $data['title'] = 'Add Employee';
    $data['isPost'] = $this->request->getMethod()=='post';
    $data['content'] = view('human_resources/form');
    $rules = [
      'firstname'         => 'required|min_length[2]|max_length[50]',
      'lastname'          => 'required|min_length[2]|max_length[50]',
      'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
      'mobile'             => 'required|min_length[10]|max_length[13]',
      'password'          => 'required'
    ];

    if ($this->validate($rules)) {
      $model = model(UserModel::class);
    } else {
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['validation'] = '$this->validator';
      return view('layout/main_wrapper',$data);
    }   
    
  }

  // User roles
  public function user_roles($user_role = null) {
		$user_list = array(
			'Admin'          => 1,
			'Doctor'         => 2,
			'Accountant'     => 3,
			'Cashier'        => 4,
			'Pharmacist'     => 5,
			'Laboratorist'   => 6,
			'Receptionist'   => 7,
		);

		if (!empty($user_role)) {
			$user_role = ucfirst($user_role);
			if (array_key_exists($user_role, $user_list)) {
				return $user_list[$user_role];
			} else {
				return null;
			}			
		} else {
			return array_flip($user_list);
		}
	}	
}