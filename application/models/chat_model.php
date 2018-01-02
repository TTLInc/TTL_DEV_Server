<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function save($chat) {
		if(isset($chat['localTimeZone'])){
			unset($chat['localTimeZone']);
		}
		$chat['msg'] = preg_replace("/<script[^>].*?>.*?<\/script>/si", "", $chat['msg']);
		if($chat['msg'] == ''){
			return;
		}
		$chat['time'] = time();
		return $query = $this->db->query($this->db->insert_string('chat',$chat));
	}
	public function getByCid($cid,$time=0){
		if($time){
			$sql = "SELECT * FROM chat where classId={$cid} and time > {$time} ORDER BY id ASC";
		}else {
			$sql = "SELECT * FROM chat where classId={$cid}  ORDER BY id ASC";
		}
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
}
/* End of file media_model.php */
/* Location: ./application/model/media_model.php */