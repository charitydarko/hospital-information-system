<?php

namespace App\Controllers\Pharmacist;

use App\Controllers\BaseController;

class Patient extends BaseController
{
    private $heading = "Patient";

    public function index() {
      $data['patients'] = $this->patient_model->orderBy('created_at','DESC')->findAll();
      $data['heading'] = $this->heading;
      $data['title'] = 'List';
      $data['content']  = view('pharmacist/patient/index',$data);
      return view('pharmacist/layout/main_wrapper',$data);
    }

    public function today() {
        $date = $date = date('Y-m-d');
        $data['patients_today'] = $this->patient_model->where("created_at", $date)->findAll();
        $data['heading'] = $this->heading;
        $data['title'] = 'Today\'s List';
        $data['content']  = view('pharmacist/patient/today',$data);
        return view('pharmacist/layout/main_wrapper',$data);
      }
  
      // View info
      public function view($registration_code = null) {
        $data['patient'] = $this->getPatientOr404($registration_code);
        $data['documents'] = $this->document_model->where('patient_id', $data['patient']->registration_code)->select('*')->find();
        $data['appointments'] = $this->appointment_model->where('patient_id', $data['patient']->registration_code)->select('*')->find();
        $data['staff'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacist/patient/view',$data);
        return view('pharmacist/layout/main_wrapper',$data);
      }
  
  
      // Document List
      public function document(){
        $data['documents'] = $this->document_model->orderBy('created_at','DESC')->findAll();
        $data['staff'] = $this->user_model;
        $data['heading'] = 'Patient Document';
        $data['title'] = 'List';
        $data['content'] = view('pharmacist/patient/document', $data);
        return view('pharmacist/layout/main_wrapper',$data);
      }
  
      // Add Document
      public function add_document($registration_code = null){
        $patient = $this->getPatientOr404($registration_code);
        $data['isPost'] = $this->request->getMethod()=='post'; 
        $data['heading'] = 'Patient Document';
        $data['title'] = 'Add';
        $data['uri'] = $this->request->uri->getSegment(3);
        $data['content'] = view('pharmacist/patient/add_document', $data);
        return view('pharmacist/layout/main_wrapper',$data);
      }
  
      // Get patient by ID
      public function getPatientOr404($registration_code = null) {
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('*')->find();
        $patient = $patient['0'];
        if($patient === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
          return $patient;
      }
}
