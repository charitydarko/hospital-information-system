<?php

namespace App\Controllers;
use App\Entities\PatientEntity;

class Patient extends BaseController
{
  private $heading = "Patient";

    public function index(){
      $data['patients'] = $this->patient_model->findAll();
      $data['heading'] = $this->heading;
      $data['title'] = 'List';
      $data['content']  = view('patient/index',$data);
      return view('layout/main_wrapper',$data);
    }

    public function today() {
      $date = $date = date('Y-m-d');
      $data['patients_today'] = $this->patient_model->where("created_at", $date)->findAll();
      $data['heading'] = $this->heading;
      $data['title'] = 'Today\'s List';
      $data['content']  = view('patient/today',$data);
      return view('layout/main_wrapper',$data);
    }

    public function month() {
      $data['patients_month'] = $this->patient_model->findAll();
      $data['heading'] = $this->heading;
      $data['title'] = 'Month\'s List';
      $data['content']  = view('patient/month',$data);
      return view('layout/main_wrapper',$data);
    }

    // View info
    public function view($registration_code = null) {
      $data['patient'] = $this->getPatientOr404($registration_code);
      $data['documents'] = $this->document_model->where('patient_id', $data['patient']->registration_code)->select('*')->find();
      $data['appointments'] = $this->appointment_model->where('patient_id', $data['patient']->registration_code)->select('*')->find();
      $data['staff'] = $this->user_model;
      $data['heading'] = $this->heading;
      $data['title'] = 'View';
      $data['content']  = view('patient/view',$data);
      return view('layout/main_wrapper',$data);
    }

    // Add New Patient
    public function new() {
      $data['patient'] = new PatientEntity;
      $data['heading'] = $this->heading;
      $data['title'] = 'Add';
      $data['content'] = view('patient/new');
      return view('layout/main_wrapper',$data);
    }

    // Process New Patient
    public function create() {
      $validate = $this->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'gender'  => 'required',
        'age'  => 'required',
        'phone' => 'required',
        'address'    => 'required',
        'registration_code'    => [
          'label' => 'Registration Code',
          'rules' => 'required|is_unique[patient.registration_code]'
        ]
      ]);
      if(!$validate) {
        $data['validation'] = $this->validator->listErrors();
        return redirect()->back()->withInput()->with('error', $data['validation']);
      } else {
        $this->patient_model->save($this->request->getPost());
        return redirect()->back()->withInput()->with('info', 'Patient Registered successfully');
      }
    } 

    // Edit Patient info
    public function edit($registration_code = null) {
      $patient = $this->getPatientOr404($registration_code);
      $data['patient'] = $patient;
      $data['heading'] = $this->heading;
      $data['title'] = 'Edit';
      $data['content']  = view('patient/edit',$data);
      return view('layout/main_wrapper',$data);
    }

     // Update Patient info
     public function update($registration_code = null) {
      $patient = $this->patient_model->where('registration_code', $registration_code)->first();

      $patient->fill($this->request->getPost());

      if(!$patient->hasChanged()){
        return redirect()->back()->withInput()->with('warning', 'Nothing to update');
      }

      if ($this->patient_model->save($patient)) {
        return redirect()->to("/patient/view/$registration_code")->with('info', 'Task updated successfully');
      } else {
        return redirect()->back()->with('error', $patient_model->errors)->with('error', 'Invalid data');
      }

    }

    // Document List
    public function document(){
      $data['documents'] = $this->document_model->findAll();
      $data['staff'] = $this->user_model;
      $data['heading'] = 'Patient Document';
      $data['title'] = 'List';
      $data['content'] = view('patient/document', $data);
      return view('layout/main_wrapper',$data);
    }

    // Add Document
    public function add_document($registration_code = null){
      $patient = $this->getPatientOr404($registration_code);
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = 'Patient Document';
      $data['title'] = 'Add';
      $data['uri'] = $this->request->uri->getSegment(3);
      $data['content'] = view('patient/add_document', $data);
      return view('layout/main_wrapper',$data);
    }

    // Upload Document
    public function document_upload() {
      //validation rules
      $rules = [
        'patient_id' => [
          'rules' => 'required',
          'label' => 'Patient Id'
        ],
        'hidden_attach_file' => [
          'rules' => 'uploaded[hidden_attach_file]|max_size[hidden_attach_file, 20000]',
          'label' => 'Attach File'
        ],
        'category' => [
          'rules' => 'required',
          'label' => 'Category'
        ]
      ];

      if ($this->validate($rules)) {
        $file = $this->request->getFile('hidden_attach_file');
        $patient_id = $this->request->getPost('patient_id');
        $category = $this->request->getPost('category');
        $description = $this->request->getPost('description');

        if($file->isValid() && !$file->hasMoved()) {
          $file->move('./uploads/patient/documents', $file->getRandomName());

          $data = [
            'patient_id' => $patient_id,
            'category' => $category,
            'description' => $description,
            'hidden_attach_file' => $file->getName(),
            'upload_by' => $this->session->get('id')
          ];

          if ($this->document_model->save($data)) {
            return redirect()->back()->with('info', 'Document added successfully');
          } else {
            return redirect()->back()->with('error', $document_model->errors)->with('error', 'Invalid data');
          }

        }
      } else {
        $data['validation'] = $this->validator->listErrors();
        return redirect()->back()->withInput()->with('error', $data['validation']);
      }
    } 

    // Delete Patient by ID
    public function delete($registration_code) {
      $patient = $this->getPatientOr404($registration_code);
      $data['post'] = $this->patient_model->where('registration_code', $registration_code)->delete();
      return redirect()->to( base_url('patient') );
    }

    // Delete document
    public function document_delete($registration_code=null, $file=null) {
      $data['document'] = $this->document_model->where('registration_code', $registration_code)->delete();
      return redirect()->to( base_url('patient/document'))->with('info', 'Deleted successfully');
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
