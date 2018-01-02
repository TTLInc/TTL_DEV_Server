<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contests extends TL_Controller {
	
	public function __construct(){
        parent::__construct();
		session_start();
		$this->load->model(array('lookup_model'));
		$this->load->model(array('qoute_model'));
		$this->load->helper('cookie');
    }
	
	public function index(){
		if($this->session->userdata('uid')){
			redirect(base_url());
		}
		$this->load->model(array('contests_model','user_model'));
		$this->load->helper('cookie');
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? 'phone' : 'computer');
		$this->geolocater->getlocation();
		if(!isset($_SESSION["multi_lang"])){
			$lang = 'en';
		}else{
			$lang = $_SESSION['multi_lang'];
		} 
		$contests = "";
		$contests = $this->contests_model->getAllContests("active");		
		$this->layout->setLayoutData('linkAttr','contests');
		$this->layout->setData('contests',$contests);
		$this->layout->setData('deviceType',$deviceType);
		$this->layout->view('contests/index');
	}
}
/* End of file index.php */
/* Location: ./application/controllers/index.php */