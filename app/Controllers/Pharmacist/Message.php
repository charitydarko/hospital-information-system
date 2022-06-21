<?php

namespace App\Controllers\Pharmacist;

use App\Controllers\BaseController;

class Message extends BaseController
{
    private $heading = "Message";

    public function index()
    {
        $data['title'] = 'Inbox';
        $data['heading'] = $this->heading;
        $data['messages'] = $this->message_model->find(['receiver_id', session()->get('id')]);
        $data['user'] = $this->user_model;
        $data['content'] = view('pharmacist/message/index', $data);
		return view('pharmacist/layout/main_wrapper',$data);
    }

    public function add()
    {
        $data['title'] = 'Add';
        $data['heading'] = $this->heading;
        $data['user_list'] = $this->user_model->findAll();
        $data['content'] = view('pharmacist/message/add', $data);
		return view('pharmacist/layout/main_wrapper',$data);
    }

    public function create() {
        $validate =  $this->validate([
            'receiver_id'         => [
                'label' => 'Receiver Name',
                'rules' => 'Required'
            ],
            'subject'   => [
                'label' => 'Subject',
                'rules' => 'required'
            ],
            'message'    => [
                'label' => 'Message',
                'rules' => 'required'
            ]
        ]);

        if(!$validate) {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
        } else {
            $this->message_model->save($this->request->getPost());
            return redirect()->back()->withInput()->with('info', 'Message Successfully');
        }
    }

    public function sent() {
        $data['title'] = 'Sent';
        $data['heading'] = $this->heading;
        $data['messages'] = $this->message_model->where('sender_id', session()->get('id'))->find();
        $data['user'] = $this->user_model;
        $data['content'] = view('pharmacist/message/sent', $data);
		return view('pharmacist/layout/main_wrapper',$data);
    }

    public function inbox_information($id = null) {
        $data['message'] = $this->message_model->find($id);
        $data['user'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacist/message/view',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }

    public function inbox_information_inbox($id = null) {
        $data = [
            'receiver_status' => 1,
        ];
        $this->message_model->update($id, $data);
        $data['message'] = $this->message_model->find($id);
        $data['user'] = $this->user_model;
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('pharmacist/message/view',$data);
        return view('pharmacist/layout/main_wrapper',$data);
    }
}
