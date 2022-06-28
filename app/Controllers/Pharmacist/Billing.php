<?php

namespace App\Controllers\Pharmacist;

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
        $data['content']  = view('pharmacist/billing/index',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function today()
    {
        $date = $date = date('Y-m-d');
        $data['diagnosis'] = $this->diagnosis_model->findAll();
        $data['loadLaboratory'] = $this->laboratory_model->findAll();
        $data['laboratory'] = $this->laboratory_model;
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['billings_today'] = $this->billing_model->where("created_at", $date)->findAll();
        $data['heading'] = $this->heading;
        $data['title'] = 'List';
        $data['content']  = view('pharmacist/billing/index',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function add($id=null) {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add';
        $data['appointment'] = $this->getAppointmentOr404($id);
        $data['patient'] = $this->getPatientOr404($id);
        $data['content']  = view('pharmacist/billing/add',$data);
        return view('pharmacist/layout/main_wrapper',$data);
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
                        'tax' => $this->request->getPost('vax'),
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
                        'billing_id' => $this->billing_model->insertID,
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
        $data['invoice'] = $this->billing_model->find($id);
        $data['invoice_details'] = $this->billing_details_model->where('billing_id', $id)->select('*')->find();
        $data['appointment'] = $this->appointment_model->where('id',  $data['invoice']->appointment_id)->find();
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment'][0]->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('pharmacist/billing/edit',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function update($id = null) {
        $invoice = $this->billing_model->find($id);
        $invoice->fill([
            'discount' => $this->request->getPost('discount'),
            'tax' => $this->request->getPost('tax'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status'),
            'served_by' => $this->session->get('id')
        ]);

        if(!$invoice->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->billing_model->save($invoice)) {
            $details = $this->billing_details_model->where('billing_id', $id)->select('*');

            if($details) {
                $this->billing_details_model->where('billing_id', $id)->select('*')->delete();
            }

            $item_name = $this->request->getPost('item_name');
            $description = $this->request->getPost('description');
            $quantity = $this->request->getPost('quantity');
            $price = $this->request->getPost('price');
            $subtotal = $this->request->getPost('subtotal');

            for ($i=0; $i < sizeof($item_name); $i++)
            {
                if(!empty($item_name[$i]))  
                $this->billing_details_model->save([
                    'billing_id' => $id,
                    'appointment_id' => $this->request->getPost('appointment_code'),
                    'item_name' => $item_name[$i],
                    'description' => $description[$i],
                    'quantity' => $quantity[$i],
                    'price' => $price[$i],
                    'subtotal' => $subtotal[$i]
                ]);
            }
            
            return redirect()->to(base_url("admin/billing"))->with('info', 'Billing updated successfully');
        } else {
            return redirect()->back()->with('error', $pharmacy_billing_model->errors)->with('error', 'Invalid data');
        }
    }

    public function view($id=null) {
        $data['invoice'] = $this->billing_model->find($id);
        $data['invoice_details'] = $this->billing_details_model->where('billing_id', $id)->select('*')->find();
        $data['appointment'] = $this->appointment_model->where('id',  $data['invoice']->appointment_id)->find();
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment'][0]->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacist/billing/view',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function delete($id = null)  {
        $this->billing_model->where('id', $id)->delete();
        $details = $this->billing_details_model->where('billing_id', $id)->select('*');

        if($details) {
            $this->billing_details_model->where('billing_id', $id)->select('*')->delete();
        }
        return redirect()->to(base_url('admin/billing'))->with('info', 'Billing Deleted successfully');
    }

    // Appointment for json
    public function appointmentNow() {
        $appointment_code = $this->request->getPost('appointment_code');
        $appointment = $this->appointment_model->where('appointment_id', $appointment_code)->find();
        if($appointment) {
            $appointment = $appointment[0];
            $patient =$this->getPatientOr404($appointment->patient_id);
            $diagnosis = $this->getDiagnosisOr404($appointment_code);
            $laboratory = $this->getLaboratoryOr404($appointment_code);
            $pharmacy_billing = $this->getPharmacyBillingOr404($appointment_code);
            if($patient) {
                $data = [
                    'status' => 'true',
                    'message' => 'Patient found',
                    'patient' => $patient,
                    'diagnosis_fees' => $diagnosis[0]->visiting_fees,
                    'diagnosis_fees_reason' => $diagnosis[0]->visiting_fees_reason,
                    'laboratory_fees_reason' => $laboratory[0]->fees_reason,
                    'pharmacy_billing_total' => $pharmacy_billing[0]->total,
                    'pharmacy_billing_reason' => 'For drugs',
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

    // Get Laboratory by ID
    public function getPharmacyBillingOr404($appointment_code) {
        $pharmacy_billing = $this->pharmacy_billing_model->where('appointment_id', $appointment_code)->select('*')->find();
        if(!$pharmacy_billing) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pharmacy Billing with Appointment code $appointment_code not found");
        }
        return $pharmacy_billing;
    }

    // Get Billing by ID
    public function getBillingOr404($appointment_code) {
        $billing = $this->billing_details_model->where('appointment_id', $appointment_code)->select('appointment_id, item_name, description, quantity, price, subtotal')->find();
        if(!$billing) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Billing with id $appointment_code not found");
        }
        return $billing;
    }

    
    // Get Laboratory by ID
    public function getLaboratoryOr404($appointment_code) {
        $laboratory = $this->laboratory_model->where('appointment_id', $appointment_code)->select('fees, fees_reason')->find();
        if(!$laboratory) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Laboratory with Appointment code $appointment_code not found");
        }
        return $laboratory;
    }

    // Get Diagnosis by ID
    public function getDiagnosisOr404($appointment_code) {
        $diagnosis = $this->diagnosis_model->where('appointment_id', $appointment_code)->select('visiting_fees, visiting_fees_reason')->find();
        if(!$diagnosis) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Diagnosis with Appointment code $appointment_code not found");
        }
        return $diagnosis;
    }


    // Get Appointment by ID
    public function getAppointmentOr404($appointment_code) {
        $appointment = $this->appointment_model->where("appointment_id", $appointment_code)->find();
        if(!$appointment) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Appointment code $appointment_code not found");
        }
        return $appointment;
    }


    // Get patient by registration_code
    public function getPatientOr404($registration_code) {
        $patient = $this->patient_model->where('registration_code', $registration_code)->select('firstname, lastname, gender, registration_code, phone, mobile, address, age, status')->find();
        if(!$patient) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Patient with Registration code $registration_code not found");
        }
        $patient = $patient;
        return $patient;
    }
}
