<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends TL_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model','lesson_model'));
	}

	public function index(){
		$own = true;
		$uid =  $this->input->_request('uid');
		if($uid != false){
			$own = false;
		}
		else {
			$uid = $this->session->userdata('uid');
		}
		$lessons = $this->lesson_model->getAll($uid);
		$this->layout->view('lessons/index',array('own'=>$own,'lessons'=>$lessons));
	}

	public function ajax_lessons(){
		$own = true;
		$uid =  $this->input->_request('uid');
		if($uid != false) {
			$own = false;
		}
		else {
			$uid = $this->session->userdata('uid');
		}
		$page = $this->input->_request->getAll($uid,$page);
	}

	public function buy_class(){
	
	}

	public function edit_lessons(){
		$data = $this->input->_requestBy(array('desc','name','hours'));
		$data['uid'] = $this->session->userdata('uid');
		$this->lesson_model->update($data);
	}
}
/* End of file lessons.php */
/* Location: ./application/controllers/lessons.php */