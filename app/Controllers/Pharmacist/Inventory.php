<?php

namespace App\Controllers\Pharmacist;

use App\Controllers\BaseController;

class Inventory extends BaseController
{
    private $heading = "Pharmacy Inventory";

    public function index()
    {
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['billings'] = $this->pharmacy_billing_model->where('payment_method', 'pharmacy_sale')->select('*')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'Prescription Sales List';
        $data['content']  = view('pharmacist/inventory/index',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function today()
    {
        $date = $date = date('Y-m-d');
        $data['staff'] = $this->user_model;
        $data['appointments'] = $this->appointment_model;
        $data['patients'] = $this->patient_model;
        $data['billings_today'] = $this->pharmacy_billing_model->where(['payment_method' => 'pharmacy_sale', "created_at" => $date])->select('*')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'Today\'s Prescription Sales List';
        $data['content']  = view('pharmacist/inventory/today',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function sale()
    {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add Prescription Sales';
        $data['content'] = view('pharmacist/inventory/AddSale', $data); 
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function createSale() {
        $validate = $this->validate([
            'appointment_code' => [
                'rules' => 'required|is_unique[pharmacy_billing.appointment_id]',
                'label' => 'Appointment Code'
            ]
        ]);

        if(!$validate) {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
          } else {
                $billing_data = 
                    [
                        'appointment_id' => $this->request->getPost('appointment_code'),
                        'discount' => $this->request->getPost('discount'),
                        'tax' => $this->request->getPost('vat'),
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

                $this->pharmacy_billing_model->save($billing_data);

                for ($i=0; $i < sizeof($item_name); $i++)
				{
					if(!empty($item_name[$i]))  
                    $this->pharmacy_billing_details_model->save([
                        'billing_id' => $this->pharmacy_billing_model->insertID,
                        'appointment_id' => $this->request->getPost('appointment_code'),
                        'item_name' => $item_name[$i],
                        'description' => $description[$i],
                        'quantity' => $quantity[$i],
                        'price' => $price[$i],
                        'subtotal' => $subtotal[$i]
                    ]);
				}

            return redirect()->back()->withInput()->with('info', 'Patient Prescription Sale Successful');
        }
    }

    public function view($id = null) {
        $data['prescription_sale'] = $this->pharmacy_billing_model->where('appointment_id', $id)->find();
        $data['prescription_sale'] = $data['prescription_sale'][0];
        $data['prescription_sale_details'] = $this->pharmacy_billing_details_model->where('billing_id', $data['prescription_sale']->id)->select('*')->find();
        $data['appointment'] = $this->appointment_model->where('appointment_id',  $id)->find();
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment'][0]->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacist/inventory/view',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function edit($id = null) {
        $data['prescription_sale'] = $this->pharmacy_billing_model->where('appointment_id', $id)->find();
        $data['prescription_sale'] = $data['prescription_sale'][0];
        $data['prescription_sale_details'] = $this->pharmacy_billing_details_model->where('billing_id', $data['prescription_sale']->id)->select('*')->find();
        $data['appointment'] = $this->appointment_model->where('appointment_id',  $id)->find();
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment'][0]->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('pharmacist/inventory/edit',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function update($id = null) {
        $prescription_sale = $this->pharmacy_billing_model->find($id);
        $prescription_sale->fill([
            'discount' => $this->request->getPost('discount'),
            'tax' => $this->request->getPost('tax'),
            'total' => $this->request->getPost('total'),
            'status' => $this->request->getPost('status'),
            'served_by' => $this->session->get('id')
        ]);

        if(!$prescription_sale->hasChanged()){
            return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }

        if ($this->pharmacy_billing_model->save($prescription_sale)) {
            $details = $this->pharmacy_billing_details_model->where('billing_id', $id)->select('*');

            if($details) {
                $this->pharmacy_billing_details_model->where('billing_id', $id)->select('*')->delete();
            }

            $item_name = $this->request->getPost('item_name');
            $description = $this->request->getPost('description');
            $quantity = $this->request->getPost('quantity');
            $price = $this->request->getPost('price');
            $subtotal = $this->request->getPost('subtotal');

            for ($i=0; $i < sizeof($item_name); $i++)
            {
                if(!empty($item_name[$i]))  
                $this->pharmacy_billing_details_model->save([
                    'billing_id' => $id,
                    'appointment_id' => $this->request->getPost('appointment_code'),
                    'item_name' => $item_name[$i],
                    'description' => $description[$i],
                    'quantity' => $quantity[$i],
                    'price' => $price[$i],
                    'subtotal' => $subtotal[$i]
                ]);
            }
            
            return redirect()->to(base_url("pharmacist/inventory/index"))->with('info', 'Prescription updated successfully');
        } else {
            return redirect()->back()->with('error', $pharmacy_billing_model->errors)->with('error', 'Invalid data');
        }
    }

    // Appointment for json
    public function appointmentNow() {
        $appointment_code = $this->request->getPost('appointment_code');
        $appointment = $this->appointment_model->where('appointment_id', $appointment_code)->find();
        if($appointment) {
            $appointment = $appointment[0];
            $patient =$this->getPatientOr404($appointment->patient_id);

            if($patient) {
                $data = [
                    'status' => 'true',
                    'message' => 'Patient found',
                    'patient' => $patient,
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


    public function delete($id = null)  {
        $this->pharmacy_billing_model->where('id', $id)->delete();
        $details = $this->pharmacy_billing_details_model->where('billing_id', $id)->select('*');

        if($details) {
            $this->pharmacy_billing_details_model->where('billing_id', $id)->select('*')->delete();
        }
        return redirect()->to(base_url('/pharmacist/inventory/index'))->with('info', 'Prescription Sale Deleted successfully');
    }

    // Get Laboratory by ID
    public function getPharmacyBillingOr404($appointment_code) {
        $pharmacy_billing = $this->pharmacy_billing_model->where('appointment_id', $appointment_code)->select('*')->find();
        if(!$pharmacy_billing) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Pharmacy Billing with Appointment code $appointment_code not found");
        }
        return $pharmacy_billing;
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
