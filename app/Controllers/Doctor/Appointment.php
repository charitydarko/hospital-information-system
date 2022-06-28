<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;

class Appointment extends BaseController
{
    private $heading = "Appointment";

    public function index() {
        $data['appointments'] = $this->appointment_model->orderBy('created_at','DESC')->findAll();
        $data['staff'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('doctor/appointment/index',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function today() {
        $date = $date = date('Y-m-d');
        $data['appointments'] = $this->appointment_model->where("created_at", $date)->findAll();
        $data['staff'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'Today\'s List';
        $data['content']  = view('doctor/appointment/index',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function add() {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['content']  = view('doctor/appointment/add',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function create() {
         //validation rules
         $rules = [
            'patient_id' => [
                'rules' => 'required',
                'label' => 'Patient Code'
            ],
            'appointment_id'    => [
                'label' => 'Appointment Code',
                'rules' => 'required|is_unique[appointment.appointment_id]'
            ]
        ];

        if ($this->validate($rules)) {
            $patient_id = $this->request->getPost('patient_id');
            $appointment_id = $this->request->getPost('appointment_id');
            $note = $this->request->getPost('note');

            $data = [
                'patient_id' => $patient_id,
                'appointment_id' => $appointment_id,
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
        $data['vital'] = $this->vitals_model->where('appointment_id', $id)->select('*')->find();
        $data['diagnosis'] = $this->diagnosis_model->where('appointment_id', $id)->select('*')->find();
        $data['prescription'] = $this->prescription_model->where('appointment_id', $id)->select('*')->find();
        $data['laboratory'] = $this->laboratory_model->where('appointment_id', $id)->select('*')->find();
        $data['billings'] = $this->billing_model->where('appointment_id', $id)->select('*')->find();
        $data['staff'] = $this->user_model;
        $data['patient'] = $patient;
        $data['heading'] = $this->heading;
        $data['title'] = 'Profile';
        $data['content']  = view('doctor/appointment/view',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    // Edit Appointment info
    public function edit($id) {
        $appointment = $this->getAppointmentOr404($id);
        $data['appointment'] = $appointment;
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('doctor/appointment/edit',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    // Update Appointment info
    public function update($id) {
        $appointment = $this->appointment_model->where("appointment_id", $id)->find();
        $appointment = $appointment['0'];
        $appointment->fill($this->request->getPost());
  
        if(!$appointment->hasChanged()){
          return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }
  
        if ($this->appointment_model->save($appointment)) {
          return redirect()->to("/doctor/appointment/view/$id")->with('info', 'Appointment updated successfully');
        } else {
          return redirect()->back()->with('error', $appointment_model->errors)->with('error', 'Invalid data');
        }
    }


    // Delete Appointment by ID
    public function delete($id) {
        $appointment = $this->getAppointmentOr404($id);
        $data['post'] = $this->appointment_model->where('appointment_id', $id)->delete();
        return redirect()->to( base_url('appointment'))->with('info', 'Appointment deleted successfully');
    }

     // Get Appointment by ID
     public function getAppointmentOr404($id) {
        $appointment = $this->appointment_model->where("appointment_id", $id)->find();
        $appointment = $appointment['0'];
        if($appointment === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Appointment code $id not found");
        }
        return $appointment;
    }

    // Get patient by registration_code
    public function getPatientOr404($registration_code) {
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, phone, mobile, address, age, date_of_birth, status')->find();
        if(!$patient) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        $patient = $patient['0'];
        return $patient;
    }
}
