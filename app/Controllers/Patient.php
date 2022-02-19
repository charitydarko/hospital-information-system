<?php

namespace App\Controllers;
use App\Entities\PatientEntity;

class Patient extends BaseController
{
  private $heading = "Patient";

  public function __construct() {
    $this->model = new \App\Models\PatientModel;
    $this->employee_model = model(UserModel::class);
    $this->document_model = model(DocumentModel::class);
  }

    public function index(){
      $data['patients'] = $this->model->findAll();
      $data['heading'] = $this->heading;
      $data['title'] = 'List';
      $data['content']  = view('patient/index',$data);
      return view('layout/main_wrapper',$data);
    }

    // View Profile info
    public function profile($id) {
      $patient = $this->getPatientOr404($id);
      $data['patient'] = $patient;
      $data['heading'] = $this->heading;
      $data['title'] = 'Profile';
      $data['content']  = view('patient/profile',$data);
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
        'registration_code'    => 'required|is_unique[patient.registration_code]'
      ]);
      if(!$validate) {
        $data['validation'] = $this->validator->listErrors();
        return redirect()->back()->withInput()->with('error', $data['validation']);
      } else {
        $this->model->save($this->request->getPost());
        return redirect()->back()->withInput()->with('info', 'Patient Registered successfully');
      }
    } 

    // Edit Patient info
    public function edit($id) {
      $patient = $this->getPatientOr404($id);
      $data['patient'] = $patient;
      $data['heading'] = $this->heading;
      $data['title'] = 'Edit';
      $data['content']  = view('patient/edit',$data);
      return view('layout/main_wrapper',$data);
    }

     // Update Patient info
     public function update($id) {
      $patient = $this->model->find($id);
      $patient->fill($this->request->getPost());

      if(!$patient->hasChanged()){
        return redirect()->back()->withInput()->with('warning', 'Nothing to update');
      }

      if ($this->model->save($patient)) {
        return redirect()->to("/patient/profile/$id")->with('info', 'Task updated successfully');
      } else {
        return redirect()->back()->with('error', $model->errors)->with('error', 'Invalid data');
      }

    }

    // Document List
    public function document(){
      $data['documents'] = $this->document_model->findAll();
      $data['staff'] = $this->employee_model;
      $data['heading'] = 'Patient Document';
      $data['title'] = 'List';
      $data['content'] = view('patient/document', $data);
      return view('layout/main_wrapper',$data);
    }

    // Add Document
    public function add_document($id = null){
      $patient = $this->getPatientOr404($id);
      $data['isPost'] = $this->request->getMethod()=='post'; 
      $data['heading'] = 'Patient Document';
      $data['title'] = 'Add';
      $request = service('request');
      $data['uri'] = $request->uri->getSegment(3);
      // $data['doctor_list'] = $this->employee_model->find(2);

      // $doctors = [];
      // foreach ($data['doctor_list'] as $doctor) {
      //   $fullname = $doctor['firstname'] . ' ' . $doctor['lastname'];
      //   array_push($doctors, $fullname);
      // }
      // $data['doctor_list'] = $doctors;
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
            return redirect()->back()->with('error', $model->errors)->with('error', 'Invalid data');
          }

        }
      } else {
        $data['validation'] = $this->validator->listErrors();
        return redirect()->back()->withInput()->with('error', $data['validation']);
      }
    } 

    // Delete Patient by ID
    public function delete($id) {
      $patient = $this->getPatientOr404($id);
      $data['post'] = $this->model->where('id', $id)->delete();
      return redirect()->to( base_url('patient') );
    }

    // Delete document
    public function document_delete($id=null, $file=null) {
      $data['document'] = $this->document_model->where('id', $id)->delete();
      return redirect()->to( base_url('patient/document'))->with('info', 'Deleted successfully');
    }

    // Get patient by ID
    public function getPatientOr404($id) {
      $patient = $this->model->find($id);
      if($patient === null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with id $id not found");
      }
      return $patient;
    }

  }
