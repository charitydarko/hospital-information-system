<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Laboratory extends BaseController
{
    private $heading = "Laboratory";

    public function index()
    {
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['loadLaboratory'] = $this->laboratory_model->findAll();
        $data['laboratory'] = $this->laboratory_model;
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'Requests';
        $data['content']  = view('admin/laboratory/index',$data);
        return view('admin/layout/main_wrapper',$data);
    }


    public function view($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['laboratory'] = $this->laboratory_model->where('diagnosis_id', $id)->select('*')->find();
        $data['staff'] = $this->user_model;
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment']->patient_id)->select('firstname, lastname, gender, age')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('admin/laboratory/view',$data);
        return view('admin/layout/main_wrapper',$data);
    }


    public function edit($id = null) {
        $data['diagnosis'] = $this->diagnosis_model->find($id);
        $data['appointment'] = $this->appointment_model->find($data['diagnosis']->appointment_id);
        $data['laboratory'] = $this->laboratory_model;
        $data['patient'] = $this->getPatientOr404($data['appointment']->patient_id);
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('/admin/laboratory/edit',$data);
        return view('admin/layout/main_wrapper',$data);
    }


    public function update($id = null){
        $rules = [
            'status' => [
              'rules' => 'required',
              'label' => 'Status'
            ],
            'note' => [
                'rules' => 'required',
                'label' => 'Note'
            ],
            'category' => [
                'rules' => 'required',
                'label' => 'Category'
            ],
            'attach_file' => [
              'rules' => 'uploaded[attach_file]|max_size[attach_file, 20000]',
              'label' => 'Attach File'
            ]
        ];

        if ($this->validate($rules)) {
            $patient_id = $this->request->getPost('patient_id');
            $file = $this->request->getFile('attach_file');
            $status = $this->request->getPost('status');
            $category = $this->request->getPost('category');
            $description = $this->request->getPost('note');
            $lab_fees = $this->request->getPost('laboratory_fees');
            $lab_fees_reason = $this->request->getPost('laboratory_fees_reason');

            if($file->isValid() && !$file->hasMoved()) {
                $file->move('./uploads/patient/laboratory', $file->getRandomName());

                $data_lab_model = [
                    'note' => $description,
                    'status' => $status,
                    'attach_file' => $file->getName(),
                    'served_by' => $this->session->get('id'),
                    'fees' => $lab_fees,
                    'fees_reason' => $lab_fees_reason,
                  ];
      
                $laboratory = $this->laboratory_model->find($id);
                $laboratory->fill($data_lab_model);

                if(!$laboratory->hasChanged()){
                    return redirect()->back()->withInput()->with('warning', 'Nothing to update');
                }
                if ($this->laboratory_model->save($laboratory)) {
                    return redirect()->to("/admin/laboratory")->with('info', 'Laboratory updated successfully');
                } else {
                    return redirect()->back()->with('error', $laboratory_model->errors)->with('error', 'Invalid data');
                }
            }
        } else {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
        }
    }


    public function delete($id = null)  {
        $this->laboratory_model->where('diagnosis_id', $id)->delete();
        return redirect()->to( base_url('/admin/laboratory'))->with('info', 'Laboratory deleted successfully');
    }

    // Get patient by registration_code
    public function getPatientOr404($registration_code) {
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        if(!$patient) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        $patient = $patient['0'];
        return $patient;
    }
}
