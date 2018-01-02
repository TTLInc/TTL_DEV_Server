<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Br extends TL_Controller {
	
	public function __construct() {
		parent::__construct();	
		session_start();
		$this->load->model(array('lookup_model'));
		$this->load->model(array('qoute_model'));
		$this->load->helper('cookie');		
	}
	
	public function index()
	{
		$this->load->model(array('user_model','profile_model'));
		$tutors = $this->user_model->GetBrDahboardTutor();
		$this->layout->setData('tutors',$tutors);
		$this->layout->setLayout('layout_mockinterview');
		$this->layout->view('br/index');
	}
	

}?>	