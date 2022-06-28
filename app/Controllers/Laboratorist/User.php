<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    private $heading = "User";

  public function index($role=null) { 	 
		$data['title'] = 'List';
    $data['heading'] = $this->heading;
    $data['userRoles'] = $this->user_roles();
    if (isset($role)) {
      $data['users'] = $this->user_model->where('user_role', $role)->findAll();
    } else {
      $data['users'] = $this->user_model->findAll();
    }
    $data['userRoles'] = $this->user_roles();
		$data['content'] = view('admin/user/index', $data);
		return view('admin/layout/main_wrapper',$data);
	}

  public function list($role=null) {
    $data['users'] = $this->user_model->find(['user_role', $role]);
  }

  // Default function
  public function add() {
      $data['userRoles'] = $this->user_roles();
      $data['heading'] = $this->heading;
      $data['title'] = 'Add User';
      $data['content'] = view('admin/user/add', $data); 
      return view('admin/layout/main_wrapper',$data);
  }

  public function create () {
    $validate =  $this->validate([
      'firstname'         => 'required|min_length[2]|max_length[50]',
      'lastname'          => 'required|min_length[2]|max_length[50]',
      'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
      'mobile'            => 'required|min_length[10]|max_length[13]',
      'password'          => 'required',
      'status'          => 'required'
    ]);

    $data = [
      'firstname'         => $this->request->getPost('firstname'),
      'lastname'          => $this->request->getPost('lastname'),
      'email'             => $this->request->getPost('email'),
      'mobile'            => $this->request->getPost('mobile'),
      'password'          => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
      'phone'             => $this->request->getPost('phone'),
      'user_role'         => $this->request->getPost('user_role'),
      'address'           => $this->request->getPost('address'),
      'gender'            => $this->request->getPost('gender'),
      'age'               => $this->request->getPost('age'),
      'date_of_birth'          => $this->request->getPost('date_of_birth'),
      'picture' => $this->request->getPost('picture'),
      'status' => $this->request->getPost('status'),
    ];

    if(!$validate) {
      $data['validation'] = $this->validator->listErrors();
      return redirect()->back()->withInput()->with('error', $data['validation']);
    } else {
      $this->user_model->save($data);
      return redirect()->back()->withInput()->with('info', 'New User Added Successfully');
    }
  }

  public function view($id=null) {
    $user = $this->getUserOr404($id);
    $data['user'] = $user;
    $data['heading'] = $this->heading;
    $data['title'] = 'View';
    $data['content']  = view('admin/user/view',$data);
    return view('admin/layout/main_wrapper',$data);
  }

  public function edit($id) {
    $data['userRoles'] = $this->user_roles();
    $user = $this->getUserOr404($id);
    $data['user'] = $user;
    $data['heading'] = $this->heading;
    $data['title'] = 'Edit';
    $data['content']  = view('admin/user/edit',$data);
    return view('admin/layout/main_wrapper',$data);
  }

  public function update($id=null) {
    $user = $this->user_model->find($id);
    $user->fill($this->request->getPost());

    if(!$user->hasChanged()){
      return redirect()->back()->withInput()->with('warning', 'Nothing to update');
    }

    if ($this->user_model->save($user)) {
      return redirect()->to("/admin/user/view/$id")->with('info', 'User Info updated successfully');
    } else {
      return redirect()->back()->with('error', $user_model->errors)->with('error', 'Invalid data');
    }
  }


  public function delete($id) {
    $user = $this->getUserOr404($id);
    $this->user_model->where('id', $id)->delete();
    return redirect()->to( base_url('admin/user/') );
  }

  public function reset_password() {
    $data['heading'] = $this->heading;
    $data['title'] = 'Password';
    $data['content']  = view('admin/user/reset_password',$data);
    return view('admin/layout/main_wrapper',$data);
  }

  public function update_password() {
    $user_id = session()->get('id');
    $data = [
      "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ];

    $user = $this->user_model->find($user_id);
    $user->fill($data);

    if(!$user->hasChanged()){
      return redirect()->back()->withInput()->with('warning', 'Nothing to update');
    }

    if ($this->user_model->save($user)) {
      return redirect()->to("/admin/user/view/$user_id")->with('info', 'User Info updated successfully');
    } else {
      return redirect()->back()->with('error', $user_model->errors)->with('error', 'Invalid data');
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

  public function getUserOr404($id) {
    $user = $this->user_model->find($id);
    if($user === null) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found");
    }
    return $user;
  }
}