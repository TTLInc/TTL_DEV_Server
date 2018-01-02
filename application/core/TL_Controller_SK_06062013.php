<?php
class TL_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
		$this->layout->setlayoutData(
			array(
				'title_for_layout' =>'TheTalkList – Your Social e-Learning Network',
				'login'=>$this->session->userdata('username'),
				'roleId'=>$this->session->userdata('roleId'),
				'pic'=>$this->session->userdata('pic'),
				'uid'=>$this->session->userdata('uid')
			)
		);
		$this->layout->setData(
			array(
				'title_for_layout' =>'Talk To List',
				'login'=>$this->session->userdata('username'),
				'roleId'=>$this->session->userdata('roleId'),
				'pic'=>$this->session->userdata('pic'),
				'uid'=>$this->session->userdata('uid')
			)
		);
		$cookieTimeZone = $this->input->cookie('localTimeZone');
		$nowTimeZone = $this->input->_request('localTimeZone');
		$lang = $this->input->_request('lang');
		$lang = $lang ? $lang : 'en';
		if(!isset($this->input->uri->segments[1]) || !$this->input->uri->segments[1]){
			$langSub = 'index';
		}
		else{
			$langSub = strtolower($this->input->uri->segments[1]);
		}
		//$this->lang->load($langSub, $lang);
		if(!$cookieTimeZone || ($nowTimeZone && $cookieTimeZone!= $nowTimeZone) ){
			setcookie('localTimeZone',$nowTimeZone,time()+3600*24*5,'/');
		}
		if(rand(0,60) == 5){
			$this->session->userdata('username',$this->session->userdata('username'));
			$this->session->userdata('uid',$this->session->userdata('uid'));
		}
	}
	
	/***************
	 * check_login if login return uid and username else redirect to redirect url or return false
	 * 
	 * redirect if redirect
	 * redirectUrl when redirect = true redirect to
	 *************/
	protected function check_login($redirect = false,$redirectUrl = 'user/login'){
		$username = $this->session->userdata('username');

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
	public function uasortFunction($array,$sortKey,$asc = 0){
		if($asc > 0) {
			$code = 'return $p1["' . $sortKey. '"] > $p2["' . $sortKey. '"];';
		}
		else{
			$code = 'return $p1["' . $sortKey. '"] < $p2["' . $sortKey. '"];';
		}
		$compare = create_function('$p1, $p2', $code);
		//var_dump($compare);
		uasort($array, $compare); 
		return $array;
	}
}
