<?php

namespace App\Controllers;
use App\Entities\PatientEntity;

class Patient extends BaseController
{
  private $model;
  private $heading = "Patient";

  public function __construct() {
    $this->model = new \App\Models\PatientModel;
    $this->employee_model = model(UserModel::class);
  }

    public function index(){
      $data['patients'] = $this->model->readAll();
      
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'List';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['content']  = view('patient/index',$data);
      return view('layout/main_wrapper',$data);
    }

    // View Profile info
    public function profile($id) {
      $patient = $this->getPatientOr404($id);
      $data['patient'] = $patient;
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Profile';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['content']  = view('patient/profile',$data);
      return view('layout/main_wrapper',$data);
    }

    // Add New Patient
    public function new() {
      $data['patient'] = new PatientEntity;
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Add';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['content'] = view('patient/new');
      return view('layout/main_wrapper',$data);
    }

    // Process New Patient
    public function create() { 
      $data['heading'] = $this->heading;
      $data['title'] = 'New';
      $data['content'] = view('patient/new');
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['isPost'] = $this->request->getMethod()=='post'; 

      $val = $this->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'age'  => 'required',
        'phone' => 'required',
        'address'    => 'required',
        'registration_code'    => 'required'
      ]);

      if (!$val)
      {
        $data['validation'] = $this->validator;
        return view('layout/main_wrapper', $data);
      }
      else
      {
        $patientEntity = PatientEntity($this->request->getPost());
        $this->model->save($patientEntity);

        $this->session->setFlashdata('message', 'Patient Registered successfully');
        return redirect()->to('/patient/new'); 
      }

    } // end create 

    // Edit Patient info
    public function edit($id) {
      $patient = $this->getPatientOr404($id);
      $data['patient'] = $patient;
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Edit';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['content']  = view('patient/edit',$data);
      return view('layout/main_wrapper',$data);
    }

     // Edit Patient info
     public function update($id) {
      $patient = $this->getPatientOr404($id);
      $data['patient'] = $patient;
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Edit';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');

      $patient = $this->model->find($id);

      $patient->fill($this->request->getPost());

      if(!$patient->hasChanged()){
        return redirect()->back()->with('message', 'Nothing to update')->withInput;
      }

      if ($this->model->save($patient)) {
        return redirect()->to("/patient/profile/$id")->with('message', 'Task updated successfully');
      } else {
        return redirect()->back()->with('error', $model->errors)->with('warning', 'Invalid data');
      }

    }

    public function document(){
      $data['patient'] = new PatientEntity;
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Add';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $data['uri'] = new \CodeIgniter\HTTP\URI();
      $data['content'] = view('patient/document');
      return view('layout/main_wrapper',$data);
    }

    public function add_document($id = null){
      $data['patient'] = new PatientEntity;
      $patient = $this->getPatientOr404($id);
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = $this->heading;
      $data['title'] = 'Add';
      $data['picture'] = '';
      $data['fullname'] = $this->session->get('firstname') . ' ' . $this->session->get('lastname');
      $request = service('request');
      $data['uri'] = $request->uri->getSegment(3);
      $data['doctor_list'] = $this->employee_model->read(2);
      $data['content'] = view('patient/add_document', $data);
      return view('layout/main_wrapper',$data);
    }

    public function delete($id) {
      $patient = $this->getPatientOr404($id);
      $data['post'] = $this->model->where('id', $id)->delete();
      return redirect()->to( base_url('patient') );
    }

    public function getPatientOr404($id) {
      $patient = $this->model->find($id);
      if($patient === null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with id $id not found");
      }
      return $patient;
    }

  }
