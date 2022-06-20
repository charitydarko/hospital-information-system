<?php

namespace App\Controllers\Doctor;

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
        $data['content'] = view('doctor/noticeboard/index', $data);
		return view('doctor/layout/main_wrapper',$data);
    }

    public function view($id=null) {
        $notice = $this->getNoticeOr404($id);
        $data['notice'] = $notice;
        $data['heading'] = $this->heading;
        $data['title'] = 'View';
        $data['staff'] = $this->user_model;
        $data['content']  = view('doctor/noticeboard/view',$data);
        return view('doctor/layout/main_wrapper',$data);
    }

    public function getNoticeOr404($id) {
        $noticeboard = $this->noticeboard_model->find($id);
        if($noticeboard === null) {
          throw new \CodeIgniter\Exceptions\PageNotFoundException("Notice with id $id not found");
        }
        return $noticeboard;
    }
}
