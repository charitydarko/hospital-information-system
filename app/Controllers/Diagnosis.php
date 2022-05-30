<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Diagnosis extends BaseController
{
    private $heading = "Diagnosis";

    public function index()
    {
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('diagnosis/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function today()
    {
        $data['diagnosis_today'] = $this->diagnosis_model->findAll();
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('diagnosis/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function month()
    {
        $data['diagnosis_month'] = $this->diagnosis_model->findAll();
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('diagnosis/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function add($id=null) {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['uri'] = $id;
        $data['vitals'] = $this->getVitalsOr404($id);
        $data['appointment'] = $this->getAppointmentOr404($data['vitals']->appointment_id);
        $data['patient'] = $this->getPatientOr404($data['appointment']->patient_id);
        $data['content']  = view('diagnosis/add',$data);
        return view('layout/main_wrapper',$data);
    }


    public function create() {
        $rules = [
            'appointment_id' => [
                'rules' => 'required',
                'label' => 'Appointment Id'
            ],
            'complain' => [
                'rules' => 'required',
                'label' => 'complain'
            ],
            'diagnosis' => [
                'rules' => 'required',
                'label' => 'Diagnosis'
            ],
            'prescription' => [
                'rules' => 'required',
                'label' => 'Prescription'
            ]
        ];

        if ($this->validate($rules)) {
            $data = [
                'appointment_id' => $this->request->getPost('appointment_id'),
                'complain' => $this->request->getPost('complain'),
                'diagnosis'  => $this->request->getPost('diagnosis'),
                'prescription'  => $this->request->getPost('prescription'),
                'laboratory'  => $this->request->getPost('laboratory'),
                'visiting_fees'  => $this->request->getPost('visiting_fees'),
                'visiting_fees_reason'  => $this->request->getPost('visiting_fees_reason'),
                'created_by' => $this->session->get('id')
            ];

            if ($this->diagnosis_model->save($data)) {
                $insert_id = $this->diagnosis_model->insertID();
                $data_other = [
                    'appointment_id' => $this->request->getPost('appointment_id'),
                    'diagnosis_id' => $insert_id,
                    'status' => 0
                ];

                $this->prescription_model->save($data_other);
                $this->laboratory_model->save($data_other);

                return redirect()->back()->with('info', 'Diagnosis added successfully');
            } else {
                return redirect()->back()->with('error', $diagnosis_model->errors)->with('error', 'Invalid data');
            }
        } else {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
    }


    public function view($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['vital'] = $this->getVitalsOr404($data['diagnosis']->appointment_id);
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['patient'] = $this->patient_model->find(['registration_code', $data['appointment']->patient_id]);
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('diagnosis/view',$data);
        return view('layout/main_wrapper',$data);
    }

    public function edit($id = null) {
        $data['diagnosis']  = $this->diagnosis_model->find($id);
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['vitals'] = $this->getVitalsOr404($data['diagnosis']->appointment_id);
        $data['appointment'] = $this->getAppointmentOr404($data['diagnosis']->appointment_id);
        $data['patient'] = $this->getPatientOr404($data['appointment']->patient_id);
        $data['content']  = view('diagnosis/edit',$data);
        return view('layout/main_wrapper',$data);
    }

    public function update($id) {
        $diagnosis = $this->diagnosis_model->find($id);
        $diagnosis->fill($this->request->getPost());

        if(!$diagnosis->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->diagnosis_model->save($diagnosis)) {
            return redirect()->to("/diagnosis/view/$id")->with('info', 'Diagnosis updated successfully');
        } else {
            return redirect()->back()->with('error', $diagnosis_model->errors)->with('error', 'Invalid data');
        }
    }

    public function delete($id) {
        $this->diagnosis_model->where('id', $id)->delete();
        return redirect()->to( base_url('diagnosis'))->with('info', 'Diagnosis deleted successfully');
    }

    // Get Vitals by appointment_id
    public function getVitalsOr404($appointment_id) {
        $vitals = $this->vitals_model->where('appointment_id', $appointment_id)->select()->find();
        $vitals = $vitals['0'];
        if($vitals === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Vitals with Appointment code $registration_code not found");
        }
        return $vitals;
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
