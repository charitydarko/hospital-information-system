<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Noticeboard extends BaseController
{
    private $heading = "Noticeboard";

    public function index()
    {
        $data['title'] = 'Notice List';
        $data['heading'] = $this->heading;
        $data['notice'] = $this->noticeboard_model->findAll();
        $data['staff'] = $this->user_model;
        $data['content'] = view('noticeboard/index', $data);
		return view('layout/main_wrapper',$data);
    }

    public function add() {
        $data['heading'] = $this->heading;
        $data['title'] = 'Add Notice';
        $data['content'] = view('noticeboard/add', $data); 
        return view('layout/main_wrapper',$data);
    }

    public function create() {
        $validate =  $this->validate([
            'title'         => [
                'label' => 'Title',
                'rules' => 'Required'
            ],
            'description'   => [
                'label' => 'Description',
                'rules' => 'required'
            ],
            'start_date'    => [
                'label' => 'Start Date',
                'rules' => 'required'
            ],
            'end_date'      => [
                'label' => 'End Date',
                'rules' => 'required'
            ],
            'status'        => [
                'label' => 'Status',
                'rules' => 'required'
            ]
        ]);

        if(!$validate) {
            $data['validation'] = $this->validator->listErrors();
            return redirect()->back()->withInput()->with('error', $data['validation']);
        } else {
            $this->noticeboard_model->save($this->request->getPost());
            return redirect()->back()->withInput()->with('info', 'Notice Added Successfully');
        }
    }

    public function view($id=null) {
        $notice = $this->getNoticeOr404($id);
        $data['notice'] = $notice;
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['content']  = view('noticeboard/view',$data);
        return view('layout/main_wrapper',$data);
    }

    public function edit($id) {
        $notice = $this->getNoticeOr404($id);
        $data['notice'] = $notice;
        $data['heading'] = $this->heading;
        $data['title'] = 'Edit';
        $data['content']  = view('noticeboard/edit',$data);
        return view('layout/main_wrapper',$data);
    }
    
      public function update($id=null) {
        $notice = $this->noticeboard_model->find($id);
        $notice->fill($this->request->getPost());
    
        if(!$notice->hasChanged()){
          return redirect()->back()->withInput()->with('warning', 'Nothing to update');
        }
    
        if ($this->noticeboard_model->save($notice)) {
          return redirect()->to("/noticeboard/view/$id")->with('info', 'Notice updated successfully');
        } else {
          return redirect()->back()->with('error', $noticeboard_model->errors)->with('error', 'Invalid data');
        }
    }

    public function delete($id) {
        $notice = $this->getNoticeOr404($id);
        $this->noticeboard_model->where('id', $id)->delete();
        return redirect()->to( base_url('noticeboard'));
    }

    public function getNoticeOr404($id) {
        $noticeboard = $this->noticeboard_model->find($id);
        if($noticeboard === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Notice with id $id not found");
        }
        return $noticeboard;
    }
    
}
