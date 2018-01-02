<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ppc extends TL_Controller {
	public function __construct(){
        parent::__construct();
		session_start();
		$this->load->helper(array('form', 'url','date'));
		$this->load->model(array('user_model','profile_model','langs_model'));
		$this->load->model(array('lookup_model'));
		$this->load->library('form_validation');
		$this->load->model(array('lookup_model'));
    }
	public function index(){
		redirect('ppc/naver1');
	}
	
	public function undefined() {
		redirect('ppc/naver1');
	}
	
	
	public function naver1(){
		redirect('http://www.thetalklist.com');
		exit;
		if (date_default_timezone_get()) {
		   //echo $this->config->item('local_timezone');
		}
		$errorMsg = array();
		$errorStatus = false;
		$this->load->model(array('ppc_model'));
		$qoute = $this->ppc_model->loadQoute();
		$this->layout->setData('qoute',$qoute);
		$userModel =  $this->ppc_model;
		$islogin = $userModel->islogin();
		if($islogin){
			redirect('search/search');
		}
		if(!isset($_SESSION["multi_lang"])){
			//$lang = $_SESSION['multi_lang'];
			$lang = 'kr';
		}else{
			$lang = $_SESSION['multi_lang'];
		}
		$video = $this->ppc_model->loadVideo($lang);
		$this->layout->setData('video',$video);
		$button_registration= $this->input->post('registrationaction');
		if(trim($button_registration)=='Sign up'){
			if(isset($_POST) && count($_POST) > 0){ 
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
				if($this->input->post('username')=='' || $this->input->post('username')=='Firstname'){
					$errorMsg[] = 'The Firstname field is required';
					$errorStatus = true;
				}
				if($this->input->post('email')=='' || $this->input->post('email')=='Email'){
					$errorMsg[] = 'The Email field is required';
					$errorStatus = true;
				}
				if($errorStatus == false){
					$regexp = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
					if (!preg_match($regexp, $this->input->post('email'))) {
						$errorMsg[] = 'This email is not valid.';
						$errorStatus = true;
					}else if($this->form_validation->run() == FALSE  && strlen($this->input->post('password'))>5 ){
						$errorMsg[] = 'Account already exists with this email. Please use Forgot password if you already have an account.';
						$errorStatus = true;
					}else{
						$errorMsg = '';
					}
				}
				if($this->input->post('password')=='' || $this->input->post('password')=='Password'){
					$errorMsg[] = 'The Password field is required';
					$errorStatus = true;
				}
				if($this->input->post('password')!='' && strlen($this->input->post('password'))<5){
					$errorMsg[] = 'Password length must be between 5-16 characters';
					$errorStatus = true;
				}
			    if ($errorStatus == false){
					$form = array(
							'username' =>      $this->input->post('username'),
							'password' =>      md5($this->input->post('password')),
							'email' =>         $this->input->post('email'),
							'user_type'=> 'Landding',
							'free_session'=> 'y',
							'add_time' => date('Y-m-d H:i:s', now()),
							'timezone' => $this->config->item('local_timezone'),
							'forwardemail' => '1',
							'roleId' =>  $this->input->post('roleId')
					);
					$this->db->insert('user', $form);
					$islogin = $userModel->islogin();
					if($islogin){
						redirect('search/search');
					}
					$user = array();
					$errorMsg = array();
					$user = $userModel->login($form); 
					$profiledata = array(
							'uid' =>   $user['id'],
							'firstName' =>  $user['username'],
							'new' =>  '1',
							'alerts' =>  '30',
							'textalert' =>  '30',
							'alertType' =>  '11',
							'add_time' => date('Y-m-d H:i:s', now())
					);
					$this->db->insert('profile', $profiledata);
					if($user){
						$profile = $this->profile_model->getProfile($user['id']);
						$uinfo = array(
							'username'=>$form['username'],
							'welcomeuser'=>$form['username'] ,
							'pic'=>$profile['pic'],
							'email'=>$form['email'],
							'uid'=>$user['id'],
							'firstTime'=>$user['user_firsttime'],
							'user_type'=> 'Landding',
							'free_session'=> 'y',
							'add_time' => date('Y-m-d H:i:s', now()),
							'userFrom' => 'landing',
							'new'=>'1',
							'roleId'=>$user['roleId']
						);
						$this->session->set_userdata($uinfo);
						$this->session->set_userdata($button_registration);
						if($user['roleId'] == 1){
							redirect('user/profile');
						}else{
							redirect('search/search');
						}
					}else{
						$errorMsg[] = 'Please check that your username and password are correct.';
					}
				}
				if($this->input->post('formno') == 1 ){
					$errorMsg['reg1Error'] = $this->setErrors($errorMsg);
				}else{
					$errorMsg['reg2Error'] = $this->setErrors($errorMsg);
				}
				$errorMsg['prUsername'] = $this->input->post('username');
				$errorMsg['prEmail'] = $this->input->post('email');
				$errorMsg['prroleId'] = $this->input->post('roleId');
			}
		}
		$button_login= $this->input->post('loginaction');
		if(trim($button_login)=='login'){
			$islogin = $userModel->islogin();
			if($islogin){
				redirect('search/search');
			}
			$user = array();
			$errorMsg = array();
			if($this->input->post()){
				$formData = $this->input->post();
				$formData['email'] = ($formData['email']);
				if($formData['email']=='' || $formData['email']=='Email'){
					$errorMsg[] = 'The Email field is required';
					$errorStatus = true;
				}
				if($formData['password']== '' || $formData['password']=='Password'){
					$errorMsg[] = 'The Password field is required';
					$errorStatus = true;
				}
				if($errorStatus == false){
					$formData['password'] = md5($formData['password']);
					if($user = $userModel->login($formData)){
						$profile = $this->profile_model->getProfile($user['id']);
						$uinfo = array(
							'username'=>$user['username'],
							'welcomeuser'=>$user['username'] ,
							'pic'=>$profile['pic'],
							'email'=>$user['email'],
							'firstTime'=>$user['user_firsttime'],
							'uid'=>$user['id'],
							'user_type'=> $user['user_type'],
							'free_session'=> $user['free_session'],
							'add_time' => date('Y-m-d H:i:s', now()),
							'userFrom' => 'landing',
							'roleId'=>$user['roleId']
						);
						$this->session->set_userdata($uinfo);
						redirect('search/search');
					}else{
						$errorMsg[] = 'Please check that your username and password are correct.';
					}
				}
				$errorMsg['loginError'] = $this->setErrors($errorMsg);
				$errorMsg['pEmail'] = $formData['email'];
				$errorMsg['pPassword'] = $formData['password'];
			}
		}
		$this->layout->setLayout('layout_ppc');
		$this->layout->view('ppc/naver1',$errorMsg);
	}
	function setErrors($errorMsg){
		$errorFinal = '';
		if($errorMsg){
			foreach($errorMsg as $error)
			{
				$errorFinal .= '<span class="Errors">'.$error.'</span>'; 
			}
		}
		return $errorFinal;
	}
	function check_database($password){
		$username = $this->input->post('email');
		$result = $this->ppc_model->login($username, $password);
		if($result){
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
				 'id' => $row->id,
				 'email' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
	    }else{
			$this->form_validation->set_message('check_database', 'Username Already exist!!!');
			return false;
	    }
	}
	function email_exists($key){
        $this->db->where('username',$this->input->post('username'));
        $query = $this->db->get('user');
        if ($query->num_rows() > 0){
			return true;
        }else{
            return false;
			$this->form_validation->set_message('email_exists', 'Email Already exist!!!');
        }
    }
	public function ajaxLang(){
		$_SESSION['multi_lang'] = '';
		$multiLang = $this->input->post('multiLang');
		$_SESSION['multi_lang'] = $multiLang;
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('/ppc/naver1');
	}
}
/* End of file ppc.php */
/* Location: ./application/controllers/ppc.php */