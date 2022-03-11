<?php

namespace App\Controllers\Laboratory;

use App\Controllers\BaseController;

class Request extends BaseController
{
    private $heading = "Laboratory";

    public function index()
    {
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['loadLaboratory'] = $this->laboratory_model->findAll();
        $data['laboratory'] = $this->laboratory_model;
        $data['staff'] = $this->employee_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'Requests';
        $data['content']  = view('laboratory/index',$data);
        return view('layout/main_wrapper',$data);
    }


    public function view($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['laboratory'] = $this->laboratory_model->where('diagnosis_id', $id)->select('note, status, served_by')->find();
        $data['staff'] = $this->employee_model;
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment']->patient_id)->select('firstname, lastname, gender, age')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('laboratory/view',$data);
        return view('layout/main_wrapper',$data);
    }


    public function edit($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['laboratory'] = $this->laboratory_model;
        $data['patient'] = $this->getPatientOr404($data['appointment']->patient_id);
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('/laboratory/edit',$data);
        return view('layout/main_wrapper',$data);
    }


    public function update($id = null){
        $laboratory = $this->laboratory_model->find($id);
        $laboratory->fill($this->request->getPost());

        if(!$laboratory->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->laboratory_model->save($laboratory)) {
            return redirect()->to("/laboratory/request")->with('info', 'Laboratory updated successfully');
        } else {
            return redirect()->back()->with('error', $laboratory_model->errors)->with('error', 'Invalid data');
        }
    }


    public function delete($id = null)  {
        $this->laboratory_model->where('diagnosis_id', $id)->delete();
        return redirect()->to( base_url('/laboratory/request'))->with('info', 'Laboratory deleted successfully');
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
