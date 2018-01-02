<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends TL_Controller {
	
	public $multi_lang;
	public function __construct() {
		parent::__construct();
		$this->load->model(array('lookup_model'));
		if(!isset($_SESSION)) {
			 session_start();
		}
		if(isset($_SESSION['multi_lang'])){
			$this->multi_lang = $_SESSION['multi_lang'];
		}else{
			$this->multi_lang = 'en';	
		}
		
	}

	public function index(){
		$this->layout->view('user/video');
	}
}
/* End of file classroom.php */
/* Location: ./application/controllers/classroom.php */