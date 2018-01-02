<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends TL_Controller {
	public function __construct(){
		parent::__construct();
		@session_start();
		
		$this->load->model('support_model');
		$this->load->model(array('lookup_model'));
	    $this->layout->setLayoutData('linkAttr','support');
	}

	public function faqs(){
	
		$lan = $_SESSION['multi_lang'];
		if(trim($this->input->post('search')) != ""){
			$faqs = $this->support_model->getAllFaqSearch(trim($this->input->post('search')), $lan);
			echo $faqs;
		}else{
			$faqs = $this->support_model->getAllFaq($lan);
			
			$this->layout->setData('faqs',$faqs);
			$this->layout->view('support/faqs');
		}
	}
	
	public function search(){
		$lan = $_SESSION['multi_lang'];
		$search = $this->support_model->getAllFaqSearch(trim($this->input->post('search')) , $lan);
		$this->layout->setData('faqs',$search);
		$this->layout->setData('query',trim($this->input->post('search')));
		$this->layout->view('support/search');
	}
	
	public function resources(){
		/* Added by Ilyas */
		if(($this->uri->segment(3)=='student') and ($this->session->userdata('universal_roleId')==1)){
			$resources = $this->support_model->getAllResS();
		}/*end */
		else if(!isset($this->session->userdata['roleId']) || $this->session->userdata['roleId'] == 0){
			$resources = $this->support_model->getAllResS();
		}else{
			$resources = $this->support_model->getAllResT();
		}
		$this->layout->setData('resources',$resources);
		$this->layout->view('support/resources');
		
	}
	public function tutor_training(){	 
		$this->load->model('user_model');
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		
		if(!$islogin){
			redirect('user/login');
		}
		else
		{
			$this->layout->view('support/tutor_training');
	    }
	}
	public function training(){
	 	 $this->load->model('user_model');
	 $a= $this->session->userdata('uid');
	 
     $result=$this->user_model->getByUid($a);
	 if($result)
	 $rid=$result['roleId'];
	 else
	  $rid='';
	  
	  $arr = array($a,$rid);
      $data=implode("+",$arr);
	  $arg=base64_encode($data);
	 redirect('https://www.thetalklist.com/10_lms/TutorAccreditation/?uid='.$arg);
	 }
	
	public function getuserpdatectivitytatus(){
		$query 	= $this->db->query("SELECT `status` FROM  `tech_support` WHERE id='1'");
		$result = $query->result_array();
		echo $result[0]['status'];exit;
	}	
}
/* End of file support.php */
/* Location: ./application/controllers/support.php */