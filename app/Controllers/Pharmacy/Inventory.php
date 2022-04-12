<?php

namespace App\Controllers\Pharmacy;

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
        $data['content']  = view('pharmacy/inventory/index',$data);
        return view('layout/main_wrapper',$data);
    }

    public function sale()
    {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add Prescription Sales';
        $data['content'] = view('pharmacy/inventory/AddSale', $data); 
        return view('layout/main_wrapper',$data);
    }

    public function createSale() {
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
        $data['prescription_sale'] = $this->pharmacy_billing_model->where('appointment_id', $id)->select('*')->find();
        $data['prescription_sale_details'] = $this->pharmacy_billing_details_model->where('billing_id', $data['prescription_sale'][0]->id)->select('*')->find();
        $data['appointment'] = $this->appointment_model->find($id);
        $data['patient'] = $this->patient_model->where('registration_code', $data['appointment']->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacy/inventory/view',$data);
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
}
