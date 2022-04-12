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
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['billings'] = $this->billing_model->findAll();
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
        $validate = $this->validate([
            'appointment_code' => 'required'
        ]);

        if(!$validate) {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
          } else {
                $billing_data = 
                    [
                        'appointment_id' => $this->request->getPost('appointment_code'),
                        'discount' => $this->request->getPost('discount'),
                        'tax' => $this->request->getPost('tax'),
                        'total' => $this->request->getPost('total'),
                        'payment_method' => $this->request->getPost('payment_method'),
                        'note' => $this->request->getPost('note'),
                        'status' => $this->request->getPost('status'),
                        'served_by' => $this->session->get('id')
                    ];
                $billing_details_data = 
                    [
                        'appointment_id' => $this->request->getPost('appointment_code'),
                        'item_name' => $this->request->getPost('item_name'),
                        'description' => $this->request->getPost('description'),
                        'quantity' => $this->request->getPost('quantity'),
                        'price' => $this->request->getPost('price'),
                        'subtotal' => $this->request->getPost('subtotal')
                    ];
                
                $item_name = $this->request->getPost('item_name');
                $description = $this->request->getPost('description');
                $quantity = $this->request->getPost('quantity');
                $price = $this->request->getPost('price');
                $subtotal = $this->request->getPost('subtotal');

                $this->billing_model->save($billing_data);

                for ($i=0; $i < sizeof($item_name); $i++)
				{
					if(!empty($item_name[$i]))  
                    $this->billing_details_model->save([
                        'appointment_id' => $this->request->getPost('appointment_code'),
                        'item_name' => $item_name[$i],
                        'description' => $description[$i],
                        'quantity' => $quantity[$i],
                        'price' => $price[$i],
                        'subtotal' => $subtotal[$i]
                    ]);
				}

            return redirect()->back()->withInput()->with('info', 'Patient Billing Successful');
          }
    }

    public function edit($id=null) {
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['billing'] = $this->getBillingOr404($id);
        $data['patient'] = $this->getPatientOr404($id);
        $data['content']  = view('billing/edit',$data);
        return view('layout/main_wrapper',$data);
    }

    public function view($id=null) {
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['billing_details'] = $this->getBillingOr404($id);
        $data['patient'] = $this->getPatientOr404($id);
        $data['content']  = view('billing/view',$data);
        return view('layout/main_wrapper',$data);
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

    // Get Billing by ID
    public function getBillingOr404($appointment_code) {
        $billing = $this->billing_details_model->where('appointment_id', $appointment_code)->select('appointment_id, item_name, description, quantity, price, subtotal')->find();
        if($billing === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Billing with id $id not found");
        }
        return $billing;
    }

    // Get Diagnosis by ID
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