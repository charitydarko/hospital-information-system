<?php

namespace App\Controllers\Cashier;

use App\Controllers\BaseController;

class Appointment extends BaseController
{
    private $heading = "Appointment";

    public function index() {
        $data['appointments'] = $this->appointment_model->findAll();
        $data['staff'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('cashier/appointment/index',$data);
        return view('cashier/layout/main_wrapper',$data);
    }

    public function today() {
        $date = $date = date('Y-m-d');
        $data['appointments'] = $this->appointment_model->where("created_at", $date)->findAll();
        $data['staff'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'Today\'s List';
        $data['content']  = view('cashier/appointment/index',$data);
        return view('cashier/layout/main_wrapper',$data);
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
        $data['content']  = view('cashier/appointment/view',$data);
        return view('cashier/layout/main_wrapper',$data);
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
        $patient = $patient['0'];
        if($patient === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        return $patient;
    }
}
