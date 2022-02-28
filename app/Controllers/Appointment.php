<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Appointment extends BaseController
{
    private $heading = "Appointment";

    public function index() {
        $data['appointments'] = $this->appointment_model->findAll();
        $data['staff'] = $this->employee_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('appointment/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function add() {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['content']  = view('appointment/add',$data);
        return view('layout/main_wrapper',$data);
    }

    public function create() {
        //validation rules
        $rules = [
            'patient_id' => [
            'rules' => 'required',
            'label' => 'Patient Id'
            ]
        ];

        if ($this->validate($rules)) {
            $patient_id = $this->request->getPost('patient_id');
            $note = $this->request->getPost('note');

            $data = [
                'patient_id' => $patient_id,
                'note' => $note,
                'created_by' => $this->session->get('id')
            ];

            $this->getPatientOr404($patient_id);

            if ($this->appointment_model->save($data)) {
                return redirect()->back()->with('info', 'Appointment added successfully');
            } else {
                return redirect()->back()->with('error', $appointment_model->errors)->with('error', 'Invalid data');
            }
    
        } else {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
        }
    }

    // View appointmen info
    public function view($id) {
        $appointment = $this->getAppointmentOr404($id);
        $patient = $this->getPatientOr404($appointment->patient_id);
        $data['appointment'] = $appointment;
        $data['patient'] = $patient;
        $data['heading'] = $this->heading;
        $data['title'] = 'Profile';
        $data['content']  = view('appointment/view',$data);
        return view('layout/main_wrapper',$data);
    }

    // Edit Appointment info
    public function edit($id) {
        $appointment = $this->getAppointmentOr404($id);
        $data['appointment'] = $appointment;
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('appointment/edit',$data);
        return view('layout/main_wrapper',$data);
    }

    // Update Appointment info
    public function update($id) {
        $appointment = $this->appointment_model->find($id);
        $appointment->fill($this->request->getPost());
  
        if(!$appointment->hasChanged()){
          return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }
  
        if ($this->appointment_model->save($appointment)) {
          return redirect()->to("/appointment/view/$id")->with('info', 'Appointment updated successfully');
        } else {
          return redirect()->back()->with('error', $appointment_model->errors)->with('error', 'Invalid data');
        }
    }


    // Delete Appointment by ID
    public function delete($id) {
        $appointment = $this->getAppointmentOr404($id);
        $data['post'] = $this->appointment_model->where('id', $id)->delete();
        return redirect()->to( base_url('appointment'))->with('info', 'Appointment deleted successfully');
    }

     // Get Appointment by ID
     public function getAppointmentOr404($id) {
        $appointment = $this->appointment_model->find($id);
        if($appointment === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Appointment code $id not found");
        }
        return $appointment;
    }

    // Get patient by registration_code
    public function getPatientOr404($registration_code) {
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $patient = $patient['0'];
        if($patient === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        return $patient;
    }
}
