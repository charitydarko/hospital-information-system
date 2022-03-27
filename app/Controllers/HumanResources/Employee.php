<?php

namespace App\Controllers\HumanResources;

use App\Controllers\BaseController;

class Employee extends BaseController
{

  private $heading = "Human Resources";

  public function index($user_role = 'Representative') { 	 
		$data['title'] = 'List';
    $data['heading'] = $this->heading;
    $data['userRoles'] = $this->user_roles();
		$role_id     = $this->user_roles($user_role);
		$data['employees'] = $this->employee_model->find($role_id);
    $data['userRoles'] = $this->user_roles();
		$data['content'] = view('human_resources/index', $data);
		return view('layout/main_wrapper',$data);
	}

  // Default function
  public function add() {
      $data['userRoles'] = $this->user_roles();
      $data['heading'] = $this->heading;
      $data['title'] = 'Add Employee';
      $data['content'] = view('human_resources/add', $data); 
      return view('layout/main_wrapper',$data);
  }

  public function create () {
    $validate =  $this->validate([
      'firstname'         => 'required|min_length[2]|max_length[50]',
      'lastname'          => 'required|min_length[2]|max_length[50]',
      'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
      'mobile'             => 'required|min_length[10]|max_length[13]',
      'password'          => 'required'
    ]);

    if(!$validate) {
      $data['validation'] = $this->validator->listErrors();
      return redirect()->back()->withInput()->with('error', $data['validation']);
    } else {
      $this->employee_model->save($this->request->getPost());
      return redirect()->back()->withInput()->with('info', 'New Employee Added Successfully');
    }
  }

  public function view($id=null) {
    $employee = $this->getEmployeeOr404($id);
    $data['employee'] = $employee;
    $data['heading'] = $this->heading;
    $data['title'] = 'View';
    $data['content']  = view('human_resources/view',$data);
    return view('layout/main_wrapper',$data);
  }

  public function edit($id) {
    $data['userRoles'] = $this->user_roles();
    $employee = $this->getEmployeeOr404($id);
    $data['employee'] = $employee;
    $data['heading'] = $this->heading;
    $data['title'] = 'Edit';
    $data['content']  = view('human_resources/edit',$data);
    return view('layout/main_wrapper',$data);
  }

  public function update($id=null) {
    $employee = $this->employee_model->find($id);
    $employee->fill($this->request->getPost());

    if(!$employee->hasChanged()){
      return redirect()->back()->withInput()->with('warning', 'Nothing to update');
    }

    if ($this->employee_model->save($employee)) {
      return redirect()->to("/humanresources/employee/view/$id")->with('info', 'Employee Info updated successfully');
    } else {
      return redirect()->back()->with('error', $employee_model->errors)->with('error', 'Invalid data');
    }
  }


  public function delete($id) {
    $employee = $this->getEmployeeOr404($id);
    $this->employee_model->where('id', $id)->delete();
    return redirect()->to( base_url('/humanresources/employee/') );
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

  public function getEmployeeOr404($id) {
    $employee = $this->employee_model->find($id);
    if($employee === null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("Employee with id $id not found");
    }
    return $employee;
  }
}