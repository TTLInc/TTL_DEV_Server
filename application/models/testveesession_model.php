<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testveesession_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getMySessionId($uid,$apiKey,$api_secret)
	{
	
		$sql = "SELECT session_id FROM `user` WHERE id={$uid}";
		$query = $this->db->query($sql);
		$result = array();
		
		if ($query->num_rows() > 0) {
		
			$result = $query->row_array();
			if(!$result['session_id'])
			{
				$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				
				$sql = "update user set session_id='{$sessionId}'  where id={$uid}";
				$this->db->query($sql);
				$result['session_id'] = $sessionId;
			}
			return $result;
		}
		//echo "heer"; print_r($result);
		return $result;
	}
	
	public function GetTestScenario($lang){
		
		 
		if($lang=='en')
		{
			$getlang='3';
		}			
		else if($lang=='es')
		{
			$getlang='8';
		}
		else if($lang=='fr')
		{
			$getlang='4';
		}
		else if($lang=='ch')
				{
					$getlang='1';
				}
		else if($lang=='tw')
				{
					$getlang='2';
				}
		else if($lang=='jp')
				{
					$getlang='5';
				}
		else if($lang=='kr')
				{
					$getlang='6';
				}
		else if($lang=='pt')
				{
					$getlang='7';
				}
		else 
				{
					$getlang='3';
				}
		$result = array();
		$sql = "SELECT * FROM test_scenario where lang='{$getlang}' and Status='1' order by orderNo ASC";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		 
		return $result;
	}
	
	public function Getdynamicscenario($lang,$cat)
	{
		
		$result = array();
		if($cat=='sel')
		{
			$sql = "SELECT * FROM test_scenario where lang='{$lang}'  and Status='1' order by orderNo ASC";
		}
		else
		{
			$sql = "SELECT * FROM test_scenario where lang='{$lang}' and categories='{$cat}' and Status='1' order by orderNo ASC";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		 
		return $result;
	}
}