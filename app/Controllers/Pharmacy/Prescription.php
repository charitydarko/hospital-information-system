<?php

namespace App\Controllers\Pharmacy;

use App\Controllers\BaseController;

class Prescription extends BaseController
{
    private $heading = "Prescription";

    public function index()
    {
        //
    }

    public function request()
    {
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['loadPrescription'] = $this->prescription_model->findAll();
        $data['prescription'] = $this->prescription_model;
        $data['staff'] = $this->employee_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'Requests';
        $data['content']  = view('pharmacy/prescription/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function view($id = null)
    {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['prescription'] = $this->prescription_model->where('diagnosis_id', $id)->select('note, status, served_by')->find();
        $data['staff'] = $this->employee_model;
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment']->patient_id)->select('firstname, lastname, gender, age')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacy/prescription/view',$data);
        return view('layout/main_wrapper',$data);
    }


    public function edit($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['prescription'] = $this->prescription_model;
        $data['patient'] = $this->getPatientOr404($data['appointment']->patient_id);
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacy/prescription/edit',$data);
        return view('layout/main_wrapper',$data);
    }


    public function update($id = null){
        $prescription = $this->prescription_model->find($id);
        $prescription->fill($this->request->getPost());

        if(!$prescription->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->prescription_model->save($prescription)) {
            return redirect()->to("/pharmacy/prescription/request")->with('info', 'Prescription updated successfully');
        } else {
            return redirect()->back()->with('error', $prescription_model->errors)->with('error', 'Invalid data');
        }
    }


    public function delete($id = null)  {
        $this->prescription_model->where('diagnosis_id', $id)->delete();
        return redirect()->to( base_url('/pharmacy/prescription/request'))->with('info', 'Prescription deleted successfully');
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