<?php
class TL_Model extends CI_Model {

	function __construct(){
		parent::__construct();		
	}

	public function loadCache(){
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
	}
	
	public function inTime($time,$localTimeZone='a'){
		
		//$time = str_replace('0:','12:',$time);
		if(!is_numeric($localTimeZone)){
			$localTimeZone = $this->input->_request('localTimeZone');
		}
		$_time = strtotime($time);
		if($_time == false || $_time == -1){
			$time = str_replace('00:','12:',$time);
			$time = str_replace('0:','12:',$time);
			//var_dump($time);
			$time = strtotime($time);
		}
		else {
			$time = $_time;
		}
		//var_dump($_time );
		$time = $time + $localTimeZone*3600;
		return $time;
	}
	
	public function outTime($time,$localTimeZone='a'){
		
		//$time = str_replace('12:','0:',$time);
		if(!is_numeric($localTimeZone)){
			$localTimeZone = $this->input->_request('localTimeZone');
		}
		$time = strtotime($time);
		$time = $time - $localTimeZone*3600;
		return $time;
	}
	public function hiaMDYOutTime($time,$localTimeZone='a'){
		$date = date( 'h:i a, M d, Y' , $this->outTime($localTimeZone) );
		//$date = str_replace('12:','0:',$date);
		return $date;
	}
	public function hiaOutTime($time,$localTimeZone='a'){
		$date = date( 'h:i a' , $this->outTime($time,$localTimeZone) );
		//$date = str_replace('12:','0:',$date);
		return $date;
	}

	public function getConfig($getKey = ''){
		$sql = 'SELECT * FROM config';
		$this->loadCache();
		if (  $results = $this->cache->get('config') ) {
			if($getKey){
				return $results[$getKey];
			}
			return $results;
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$results = array();
			foreach ($result as $key => $value) {
				$results[$value['key']] = array('value'=>$value['value'],'desc'=>$value['desc'],'id'=>$value['id']);
			}
			$this->cache->get('config',$results);
		}
		else{
			$results = array();
		}
		if($getKey){
			return $results[$getKey];
		}
		return $results;
	}

	public function saveConfig($data){
		if(isset($data['key'])){
			$data = array($data);
		}
		foreach ($data as $key => $value) {
			if(!isset($value['id'])){
				$sql = $this->db->insert_string('config',$value);
			}
			else{
				$sql = $this->db->update_string('config',$value,'id='.$value['id']);
			}
			@$this->db->query($sql);
		}
		$this->loadCache();
		@$this->cache->delete('config');
	}
}
