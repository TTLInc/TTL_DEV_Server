<?php
class TL_AdminController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
		$this->layout->setLayout('layout_admin');
		$this->layout->setlayoutData(
			array(
				'title_for_layout' =>'TheTalkList',
				'login'=>$this->session->userdata('adminUsername'),
				'roleId'=>$this->session->userdata('roleId'),
				'pic'=>$this->session->userdata('pic'),
				'uid'=>$this->session->userdata('uid')
			)
		);
		$this->layout->setData(
			array(
				'title_for_layout' =>'TheTalkList',
				'login'=>$this->session->userdata('adminUsername'),
				'roleId'=>$this->session->userdata('roleId'),
				'pic'=>$this->session->userdata('pic'),
				'uid'=>$this->session->userdata('uid')
			)
		);
		if(!isset($this->input->uri->segments[2]) ||$this->input->uri->segments[2] != 'login' ){
			$this->user = $this->check_login(true);
		}
	}
	/***************
	 * check_login if login return uid and username else redirect to redirect url or return false
	 * 
	 * redirect if redirect
	 * redirectUrl when redirect = true redirect to
	 *************/
	protected function check_login($redirect = false,$redirectUrl = 'admin/login'){
		$username = $this->session->userdata('adminUsername');

		if($username == false) {
			if($redirect) {
				redirect($redirectUrl);
			}
			return false;
		}
		else {
			$uid = $this->session->userdata('uid');
		}
		return compact('username','uid');
	}
}