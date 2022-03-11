<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Billing extends BaseController
{
    private $heading = "Billing";

    public function index()
    {
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['loadLaboratory'] = $this->laboratory_model->findAll();
        $data['laboratory'] = $this->laboratory_model;
        $data['staff'] = $this->employee_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('billing/index',$data);
        return view('layout/main_wrapper',$data);
    }


    public function add($id=null) {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['appointment'] = $this->getAppointmentOr404($id);
        $data['patient'] = $this->getPatientOr404($id);
        $data['content']  = view('billing/add',$data);
        return view('layout/main_wrapper',$data);
    }


    public function create() {
        dd($this->request->getPost());
    }

    
    // Appointment for json
    public function appointmentNow() {
        $appointment_code = $this->request->getPost('appointment_code');
        $appointment = $this->appointment_model->find($appointment_code);
        if($appointment) {
            $patient =$this->getPatientOr404($appointment->patient_id);
            $diagnosis = $this->getDiagnosisOr404($appointment_code);
            if($patient) {
                $data = [
                    'status' => 'true',
                    'message' => 'Patient found',
                    'patient' => $patient,
                    'diagnosis_fees' => $diagnosis[0]->visiting_fees,
                    'diagnosis_fees_reason' => $diagnosis[0]->visiting_fees_reason
                ];
                return json_encode($data); 
            } else {
                $data = [
                    'status' => 'false',
                    'message' => 'Patient not found'
                ];
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 'false',
                'message' => 'Appointment code invalid'
            ];
            return json_encode($data);
        }
    }

    // Get Appointment by ID
    public function getDiagnosisOr404($appointment_code) {
        $diagnosis = $this->diagnosis_model->where('appointment_id', $appointment_code)->select('visiting_fees, visiting_fees_reason')->find();
        if($diagnosis === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Diagnosis with Appointment code $id not found");
        }
        return $diagnosis;
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
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, registration_code, phone, mobile, address, age, status')->find();
        $patient = $patient;
        if($patient === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        return $patient;
    }
}
