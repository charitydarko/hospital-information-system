<?php

namespace App\Controllers;

class Auth extends BaseController {
  private $access_code = '348987';

  //Default function to load
  public function index() {
    return redirect()->to('auth/login');
  }

  public function login() {
    $data['isPost'] = $this->request->getMethod()=='post'; 

    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');
    $model = model(UserModel::class);
    $data = $model->where('email', $email)->first();

    if(!$data) {
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $this->session->setFlashdata('message', 'Email does not exist.');
      return view('login', $data);
    } else {
      $pass = $data['password'];
      $authenticatePassword = password_verify($password, $pass);
     
      if(!$authenticatePassword) {
        $data['isPost'] = $this->request->getMethod()=='post'; 
        $this->session->setFlashdata('message', 'Password is incorrect.');
        return view('login', $data);
      } else {
        $ses_data = [
          'user_id' => $data['user_id'],
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'email' => $data['email'],
          'user_role' => $data['user_role'],
          'isLoggedIn' => TRUE
        ];

        $this->session->set($ses_data);

        switch ($data['user_role']) {
          case 1:
            return redirect()->to('/dashboard');
            break;
          case 2:
            return redirect()->to('receptionist_dashboard/Home');
            break;
          case 3:
            return redirect()->to('doctor_dashboard/Home');
            break;
          case 4:
            return redirect()->to('pharmacist_dashboard/Home');
            break;
          case 5:
            return redirect()->to('laboratorist_dashboard/Home');
            break;
          case 6:
            return redirect()->to('cashier_dashboard/Home');
            break;
          case 7:
            return redirect()->to('accountant_dashboard/Home');
            break;
        }

      }
    }

  } // End Login

  // Register a new Admin
  public function register_admin() {
    // set validation rules
    $rules = [
      'firstname'         => 'required|min_length[2]|max_length[50]',
      'lastname'          => 'required|min_length[2]|max_length[50]',
      'email'             => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
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
      return view('register_admin', $data);
    }
    
  } // End register admin


  // Logout
  public function logout() { 
    $this->session->destroy(); 
    return redirect()->to('auth/login');
  }

}//End Class
