<?php
/**
* @package    TTL
* @category   Forum
* @author     R&D
* @since      Oct - 2013
**/
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Message_model extends TL_Model {
	var $fields = array();	
	public function __construct(){
		parent::__construct();
		$this->fields = array(
			'forum_messages' => array(
				'mid'  			=> '',
				'pid'  			=> '',
				'tid'  			=> '',
				'title'  		=> '',
				'message' 		=> '',
				'date' 			=> date("Y-m-d H:i:s", time()),
				'username' 		=> 'admin',
				'email' 		=> 'admin@mail.com',
				'messages' 		=> 0,
				'last_mid' 		=> '',
				'last_username' => '',
				'last_date' 	=> date("Y-m-d H:i:s", time()),
				'notify' 		=> ''
			)
		);
	}
	function get($params = array()){
		$this->load->driver('cache');
		$default_params = array(
			'order_by' => 'id DESC',
			'limit' => 1,
			'start' => null,
			'where' => null,
			'like' => null,
		);
		foreach ($default_params as $key => $value){
			$params[$key] = (isset($params[$key]))? $params[$key]: $default_params[$key];
		}
		$hash = md5(serialize($params));
		if(!$result = $this->cache->get('get' . $hash, 'messages')){
			if (!is_null($params['like'])){
				$this->db->like($params['like']);
			}
			if (!is_null($params['where'])){
				$this->db->where($params['where']);
			}
			$this->db->order_by($params['order_by']);
			$this->db->limit(1);
			$this->db->from('forum_messages');
			$query = $this->db->get();
			if ($query->num_rows() == 0 ){
				$result =  false;
			}else{
				$result = $query->row_array();
			}
			$this->cache->file->save('get' . $hash, $result, 'messages', 0);
		}
		return $result;
	}
	function get_list($params = array()){
		if(isset($_POST['tosearch'])  && $_POST['tosearch'] != ""){
			$q = $_POST['tosearch'];
			if($_POST['infield'] ==""){
					$qr =" 
					SELECT * FROM 
					forum_topics,forum_messages 
					WHERE (forum_topics.title LIKE '%{$q}%' 
						   or forum_topics.description LIKE '%{$q}%' 
						   or forum_topics.tags LIKE '%{$q}%' 
						   or forum_messages.username LIKE '%{$q}%' 
						   ) 
							AND (forum_topics.tid = forum_messages.tid )  GROUP BY forum_topics.tid  DESC";
			}elseif($_POST['infield'] =="title"){
				$qr =" 
				SELECT * FROM 
				forum_topics,forum_messages 
				WHERE (forum_topics.title LIKE '%{$q}%' 
 ) 
							AND (forum_topics.tid = forum_messages.tid )  GROUP BY forum_topics.tid   DESC";			
			}elseif($_POST['infield'] =="Everywhere"){
				$qr =" 
				SELECT * FROM 
				forum_topics,forum_messages 
				WHERE (forum_topics.title LIKE '%{$q}%' 
					   or forum_topics.description LIKE '%{$q}%' 
					   or forum_topics.tags LIKE '%{$q}%' 
					   or forum_messages.username LIKE '%{$q}%' 
							AND (forum_topics.tid = forum_messages.tid )  GROUP BY forum_topics.tid  DESC";			
			}elseif($_POST['infield'] =="message"){
				$qr =" 
				SELECT * FROM 
				forum_topics,forum_messages 
				WHERE (forum_messages.username LIKE '%{$q}%' 
					   or forum_messages.title LIKE '%{$q}%') 
							AND (forum_topics.tid = forum_messages.tid )   GROUP BY forum_topics.tid DESC";			
			
			}elseif($_POST['infield'] =="username"){
				$qr =" 
				SELECT * FROM 
				forum_topics,forum_messages 
				WHERE (forum_messages.username LIKE '%{$q}%' 
				OR forum_topics.username LIKE '%{$q}%') 
							AND (forum_topics.tid = forum_messages.tid )   GROUP BY forum_topics.tid  DESC";			
			}else{
				$qr = '';
			}
			$query = $this->db->query($qr);
			if ($query->num_rows() == 0 ){
				$result =  false;
			}else{
				$result = $query->result_array();
			}
			$this->cache->file->save('get_list' . $hash, $result, 'messages', 0);
			return $result;
		}
		$this->load->driver('cache');
		$default_params = array(
			'order_by' => 'id DESC',
			'limit' => null,
			'start' => null,
			'where' => null,
			'like' => null,
		);
		foreach ($default_params as $key => $value){
			$params[$key] = (isset($params[$key]))? $params[$key]: $default_params[$key];
		}
		$hash = md5(serialize($params));
		if(!$result = $this->cache->get('get_list' . $hash, 'messages')){
			if (!is_null($params['like'])){
				$this->db->like($params['like']);
			}
			if (!is_null($params['where'])){
				$this->db->where($params['where']);
			}
			$this->db->order_by($params['order_by']);
			$this->db->limit($params['limit'], $params['start']);
			$this->db->from('forum_messages');
			$query = $this->db->get();
			if ($query->num_rows() == 0 ){
				$result =  false;
			}else{
				$result = $query->result_array();
			}
			$this->cache->file->save('get_list' . $hash, $result, 'messages', 0);
		}
		return $result;
	}
	function get_total($params = array()){
		$this->load->driver('cache');
		$default_params = array(
			'order_by' => 'id DESC',
			'limit' => null,
			'start' => null,
			'where' => null,
			'like' => null,
		);
		foreach ($default_params as $key => $value){
			$params[$key] = (isset($params[$key]))? $params[$key]: $default_params[$key];
		}
		$hash = md5(serialize($params));
		if(!$result = $this->cache->file->get('get_total' . $hash, 'messages')){
			if (!is_null($params['like'])){
				$this->db->like($params['like']);
			}
			if (!is_null($params['where'])){
				$this->db->where($params['where']);
			}
			$this->db->order_by($params['order_by']);
			$this->db->select('count(id) as cnt');
			$this->db->from('forum_messages');
			$query = $this->db->get();
			$row = $query->row_array();
			$result = $row['cnt'];
			$this->cache->file->save('get_total' . $hash, $result, 'messages', 0);
		}
		return $result;
	}
	function delete($params = array()){
		$this->load->driver('cache');
		$this->db->where($params['where']);
		$this->db->delete('forum_messages');
	}
	function save($data = array()){
		$this->load->driver('cache');
		$this->db->set($data);
		$this->db->insert('forum_messages');
	}
	function update($where = array(), $data = array(), $escape = true){
		$this->load->driver('cache');
		$this->db->where($where);
		$this->db->set($data, null, $escape);
		$this->db->update('forum_messages');
	}
	function get_message($mid){
		return $this->get(array('where' =>  array('mid' => $mid)));
	}
	function delete_message($id){
		$this->delete(array('id' => $id));
	}
	function update_message($mid, $data, $escape = true){
		$this->update(array('mid' => $mid), $data, $escape);
	}
	function get_params($id){
		$this->load->driver('cache');
		if($params = $this->cache->file->get($id, 'message_search_cache')){
			return $params;
		}else{
			return false;
		}
	}
	function save_params($params){
		$this->load->driver('cache');
		if(is_array($params)) $params = serialize($params);
		$id = md5($params);
		if($this->cache->file->get($id, 'message_search_cache')){
			return $id;
		}else{
			$this->cache->file->save($id, $params, 'message_search_cache', 0);
		}
		return $id;
	}
	function notify($pid){
		//get all notified message
		$un = 'admin';
		$query = $this->db->query("SELECT DISTINCT username, email FROM " . $this->db->dbprefix('forum_messages') . " WHERE ( pid='" . $pid . "' OR mid='" . $pid . "' ) AND notify='Y' AND username <> '" . $un . "'");
		if($query->num_rows() > 0){
			$this->load->library('email');
			foreach($query->result_array() as $row){
				$this->email->clear();
				$this->email->from($this->system->admin_email, "Admin " . $this->system->site_name );
				$this->email->to($row['email']);
				$subject = '[' . $this->system->site_name . '] ' . sprintf("Reply from %s", $this->user->username);
				$this->email->subject($subject);
				$message = sprintf("Hello %s,\n\nYour message has been replied by %s.\n To read the message click the link below\n\n%s\n\n. If you don't want to receive any further notification, go to link below.\n\n%s\n\nThank you.\nAdministrator", $row['username'], $this->user->username, site_url('forum/message/' . $pid), site_url('forum/unsubscribe/' . $pid));
				$this->email->message($message);
				$this->email->send();
			}
		}
	}
}
/* End of file message_model.php */
/* Location: ./application/model/message_model.php */