<?php

namespace App\Controllers;

class Auth extends BaseController {
  
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

      $user = $this->user_model->where('email', $email)->find();

      if($user === null) {
        return redirect()->back()->withInput()->with('error', 'User not found');
      } else {
        if(password_verify($password, $user[0]->password)){
          $session_data = [
            'id' => $user[0]->id,
            'firstname' => $user[0]->firstname,
            'lastname' => $user[0]->lastname,
            'email' => $user[0]->email,
            'user_role' => $user[0]->user_role,
            'isLoggedIn' => TRUE
          ];
          $this->session->set($session_data);

          switch($user[0]->user_role) {
            case("1"): {
              return redirect()->to('/dashboard');
            }
            case("2"): {
              return redirect()->to('doctor/dashboard');
            }
            case("3"): {
              return redirect()->to('accountant/dashboard');
            }
            case("4"): {
              return redirect()->to('cashier/dashboard');
            }
            case("5"): {
              return redirect()->to('pharmacist/dashboard');
            }
            case("6"): {
              return redirect()->to('laboratorist/dashboard');
            }
            case("7"): {
              return redirect()->to('receptionist/dashboard');
            }
            default: 
              return redirect()->back();
          }

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
      $data = [
        'firstname' => $this->request->getVar('firstname'),
        'lastname'  => $this->request->getVar('lastname'),
        'email'     => $this->request->getVar('email'),
        'phone'     => $this->request->getVar('phone'),
        'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
      ];

       $this->user_model->save($data);

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
