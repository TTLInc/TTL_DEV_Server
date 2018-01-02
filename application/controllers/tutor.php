<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tutor extends TL_Controller {
	public function __construct(){
        parent::__construct();
		session_start();
		$this->load->model(array('lookup_model'));
		$this->load->model(array('qoute_model'));
    }
    
	public function index() {
		$this->layout->setLayout('layout_index');
		$this->layout->view("tutor/index");
	}
	
	public function undefined() {
		redirect('tutor/index');
	}
	
}
?>