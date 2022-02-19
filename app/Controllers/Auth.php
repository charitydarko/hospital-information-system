<?php

namespace App\Controllers;

class Auth extends BaseController {

  public function __construct() {
    $this->model = model(UserModel::class);
  }
  
  //Default function to load
  public function index() {
    return redirect()->to('auth/login');
  }

  public function login() {
    return view('auth/login');
  } // End Login

  public function confirm_login() {
    $validate = $this->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    if (!$validate) {
      $data['validation'] = $this->validator->listErrors();
      return redirect()->back()->withInput()->with('error', $data['validation']);
    }else {
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');

      $user = $this->model->where('email', $email)->first();

      if($user === null) {
        return redirect()->back()->withInput()->with('error', 'User not found');
      } else {
        if(password_verify($password, $user->password)){
          $session_data = [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'user_role' => $user->user_role,
            'isLoggedIn' => TRUE
          ];
          $this->session->set($session_data);
          return redirect()->to('/dashboard');
        } else {
          return redirect()->back()->withInput()->with('error', 'Incorrect password');
        }
      }
    }
  }// End confirm login

  // Register a new Admin
  public function register_admin() {
    // set validation rules
    $rules = [
      'firstname'         => 'required|min_length[2]|max_length[50]',
      'lastname'          => 'required|min_length[2]|max_length[50]',
      'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
      'phone'             => 'required|min_length[10]|max_length[13]',
      'password'          => 'required',
      'confirmpassword'   => 'matches[password]',
      'access_code'       => 'matches[valid_access_code]'
    ];

    if ($this->validate($rules)) {
      // If it passes validation
      $model = model(UserModel::class);

      $data = [
        'firstname' => $this->request->getVar('firstname'),
        'lastname'  => $this->request->getVar('lastname'),
        'email'     => $this->request->getVar('email'),
        'phone'     => $this->request->getVar('phone'),
        'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
      ];

       $model->save($data);

      return redirect()->to('/auth');
    } else {
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['validation'] = $this->validator;
      return view('auth/register_admin', $data);
    }
    
  } // End register admin


  // Logout
  public function logout() { 
    $this->session->destroy(); 
    return redirect()->to('auth/login');
  }

}//End Class
