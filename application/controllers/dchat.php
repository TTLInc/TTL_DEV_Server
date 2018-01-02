<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dchat extends TL_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('dchatmodel');
	}
	
	public function index()
	{		
		$this->load->view('chatView');		
	}
	
	public function update()
	{
		$this->load->model(array('profile_model','user_model'));
		
		if($islogin)
		{
			redirect('user/login');
		}else{
			if($this->session->userdata('uid'))
			{
				$user_id = $this->session->userdata('uid');
				$user_name = $this->session->userdata('welcomeuser');
			}
		}
		if(empty($_GET))
		{
			return false;
		}
		
		foreach($_GET AS $key => $value) {
			// sanitize for SQL Injection
		    ${$key} = mysql_real_escape_string($value);
		}
		if($message != ""){
			$current = time();		
			$this->dchatmodel->insertMsg($chat, $user_id, $user_name ,$message ,$current );		
		}
		
			
	}
	
	public function get_message()
	{	
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		header("Content-Type: text/xml; charset=utf-8");
		$xml = '<?xml version="1.0" ?><root>';
		
		$this->load->model(array('profile_model','user_model'));
		$last = (isset($_GET['last']) && $_GET['last'] != '') ? $_GET['last'] : 0;
		$cht = $_GET['chat'];
		$query = $this->dchatmodel->getMsg($last,$cht);
		$data = $query->result_array();
		
		if(isset($data) && $data !='')
		{
			foreach($data as $msg)
			{
				$profile = $this->profile_model->getProfile($msg['user_id']);
				if($profile['pic'] == '')
				{
					$profile['pic'] = 'no-img.jpg';
				}
				
				$xml .= '<message id="' . $msg['message_id'] . '">';
				$xml .= '<user>' . htmlspecialchars($msg['user_name']) . '</user>';
				$xml .= '<text>' . htmlspecialchars($msg['message']) . '</text>';
				$xml .= '<time>' . $msg['post_time'] . '</time>';
				$xml .= '<user_id>' . $msg['user_id'] . '</user_id>';
				$xml .= '<user_img>' . $profile['pic'] . '</user_img>';
				$xml .= '</message>';
			}
		}
		$xml .= '</root>';
		echo $xml;
		
	}
	
}
?>