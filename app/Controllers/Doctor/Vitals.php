<?php

namespace App\Controllers\Doctor;

use App\Controllers\BaseController;

class Vitals extends BaseController
{
    private $heading = "Vitals";

    // List Vitals
    public function index()
    {
        $data['vitals'] = $this->vitals_model->orderBy('created_at','DESC')->findAll();
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['callfromview'] = $this;
        $data['content']  = view('doctor/vitals/index',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function today()
    {
        $date = $date = date('Y-m-d');
        $data['vitals'] = $this->vitals_model->where("created_at", $date)->findAll();
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('doctor/vitals/today',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    // Add Vitals
    public function add($id=null)
    {
        $data['uri'] = $this->request->uri->getSegment(3);
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['content']  = view('doctor/vitals/add',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function create() {
        $rules = [
            'appointment_id' => [
                'rules' => 'required|is_unique[vitals.appointment_id]',
                'label' => 'Appointment Code'
            ],
            'blood_pressure' => [
                'rules' => 'required',
                'label' => 'Blood Pressure'
            ],
            'pulse' => [
                'rules' => 'required',
                'label' => 'Pulse'
            ],
            'height' => [
                'rules' => 'required',
                'label' => 'Height'
            ],
            'weight' => [
                'rules' => 'required',
                'label' => 'Weight'
            ]
        ];

        if ($this->validate($rules)) {
            $appointment_id = $this->request->getPost('appointment_id');
            $this->getAppointmentOr404($appointment_id);

            $data = [
                'appointment_id' => $appointment_id,
                'blood_pressure' => $this->request->getPost('blood_pressure'),
                'pulse' => $this->request->getPost('pulse'),
                'height' => $this->request->getPost('height'),
                'weight' => $this->request->getPost('weight'),
                'note' => $this->request->getPost('note'),
                'created_by' => $this->session->get('id')
            ];

            if ($this->vitals_model->save($data)) {
                return redirect()->back()->with('info', 'Vitals added successfully');
            } else {
                return redirect()->back()->with('error', $vitals_model->errors)->with('error', 'Invalid data');
            }

        } else {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
    }

    // View Vitals info
    public function view($id) {
        $data['vital'] = $this->vitals_model->find($id);
        $data['appointment'] = $this->appointment_model->find($data['vital']->appointment_id);
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment']->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('doctor/vitals/view',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    // Edit Vitals info
    public function edit($id) {
        $data['vitals']  = $this->vitals_model->find($id);
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('doctor/vitals/edit',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    // Update Vitals info
    public function update($id) {
        $vitals = $this->vitals_model->find($id);
        $vitals->fill($this->request->getPost());

        if(!$vitals->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->vitals_model->save($vitals)) {
            return redirect()->to("/doctor/vitals/view/$id")->with('info', 'Vitals updated successfully');
        } else {
            return redirect()->back()->with('error', $vitals_model->errors)->with('error', 'Invalid data');
        }
    }


    // Delete Vitals by ID
    public function delete($id) {
        $data['post'] = $this->vitals_model->where('id', $id)->delete();
        return redirect()->to( base_url('doctor/vitals'))->with('info', 'Appointment deleted successfully');
    }


    // Get Appointment by ID
    public function getAppointment($id) {
        $appointment = $this->appointment_model->where("appointment_id", $id)->find();
        if($appointment === null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Appointment code $id not found");
        }
        return $appointment;
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
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $patient = $patient['0'];
        if($patient === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        return $patient;
    }
}
