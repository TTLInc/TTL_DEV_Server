<?php
/**
* @package    TTL
* @category   Forum
* @author     R&D
* @since      Oct - 2013
**/
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic_model extends TL_Model {
	var $fields = array();
	public function __construct(){
		parent::__construct();
		$this->fields = array(
			'forum_topics' => array(
				'id' => 0,
				'tid'  => '',
				'title'  => '',
				'description' => '',
				'tags' => '',
				'date' => date("Y-m-d H:i:s", time()),
				'username' => 'admin',
				'email' => 'admin@mail.com',
				'messages' => 0,
				'last_mid' => '',
				'last_username' => '',
				'last_date' => date("Y-m-d H:i:s", time()),
				'gid' => '0'
			),
		);
	}
	function get($params = array()){
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
		if (!is_null($params['like'])){
			$this->db->like($params['like']);
		}
		if (!is_null($params['where'])){
			$this->db->where($params['where']);
		}
		$this->db->order_by($params['order_by']);
		$this->db->limit(1);
		$this->db->from('forum_topics');
		$query = $this->db->get();
		if ($query->num_rows() == 0 ){
			$result =  false;
		}else{
			$result = $query->row_array();
		}
		return $result;
	}
	function get_list($params = array()){
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
		if (!is_null($params['like'])){
			$this->db->like($params['like']);
		}
		if (!is_null($params['where'])){
			if(is_array($params['where']) && isset($params['where']['tid'])){
				// to avoid rewrite all call to tid
				$params['where']['forum_topics.tid'] = $params['where']['tid'];
				$params['where']['tid'] = null;
			} 
			$this->db->where($params['where']);
		}
		$this->db->order_by($params['order_by']);
		$this->db->limit($params['limit'], $params['start']);
		$query = $this->db->get('forum_topics');
		$sql = "SELECT * FROM forum_topics";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0 ){
			$result =  false;
		}else{
			$result = $query->result_array();
		}
		return $result;
	}
	function get_listTTL($params = array()){
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
		if (!is_null($params['like'])){
			$this->db->like($params['like']);
		}
		if (!is_null($params['where'])){
			if(is_array($params['where']) && isset($params['where']['tid'])){
				// to avoid rewrite all call to tid
				$params['where']['forum_topics.tid'] = $params['where']['tid'];
				$params['where']['tid'] = null;
			} 
			$this->db->where($params['where']);
		}
		$this->db->order_by($params['order_by']);
		$this->db->limit($params['limit'], $params['start']);
		$query = $this->db->get('forum_topics');
		$sql = "SELECT * FROM forum_topics WHERE category='TheTalklist - Official announcements'  ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0 ){
			$result =  false;
		}else{
			$result = $query->result_array();
			$total  = count($result);
			for($i=0;$i<= $total-1;$i++){
				$tp = $result[$i]['tid'];
				$sql 	= "SELECT `pid` FROM forum_messages WHERE tid='".$tp."'   AND LENGTH(pid) > 4";
				if($tp == 't527c877368b3b'){
					//echo $sql;exit;
				}
				$query 	= $this->db->query($sql);
				$new    = $query->result_array();
				$result[$i]['threadLink'] = @$new[0]['pid'];
			}
		}
		return $result;
	}
	function get_listGENERAL($params = array()){
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
		if (!is_null($params['like'])){
			$this->db->like($params['like']);
		}
		if (!is_null($params['where'])){
			if(is_array($params['where']) && isset($params['where']['tid'])){
				// to avoid rewrite all call to tid
				$params['where']['forum_topics.tid'] = $params['where']['tid'];
				$params['where']['tid'] = null;
			} 
			$this->db->where($params['where']);
		}
		$this->db->order_by($params['order_by']);
		$this->db->limit($params['limit'], $params['start']);
		$query = $this->db->get('forum_topics');
		$sql = "SELECT * FROM forum_topics WHERE category='General Discussion - Questions and help'  ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0 ){
			$result =  false;
		}else{
			$result = $query->result_array();
			$total  = count($result);
			for($i=0;$i<= $total-1;$i++){
				$tp = $result[$i]['tid'];
				$sql 	= "SELECT `pid` FROM forum_messages WHERE tid='".$tp."'   AND LENGTH(pid) > 4";
				if($tp == 't527c877368b3b'){
					//echo $sql;exit;
				}
				$query 	= $this->db->query($sql);
				$new    = $query->result_array();
				$result[$i]['threadLink'] = @$new[0]['pid'];
			}
		}
		return $result;
	}
	function get_total($params = array()){
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
		if (!is_null($params['like'])){
			$this->db->like($params['like']);
		}
		if (!is_null($params['where'])){
			$this->db->where($params['where']);
		}
		$this->db->order_by($params['order_by']);
		$this->db->select('count(id) as cnt');
		$this->db->from('forum_topics');
		$query = $this->db->get();
		$row = $query->row_array();
		$result = $row['cnt'];
		return $result;
	}
	function delete($params = array()){
		$this->db->where($params['where']);
		$this->db->delete('forum_topics');
	}
	function save($data = array()){
		$this->db->set($data);
		$this->db->insert('forum_topics');
	}
	function update($where = array(), $data = array(), $escape = true){
		$this->db->where($where);
		$this->db->set($data, null, $escape);
		$this->db->update('forum_topics');
	}
	function get_topic($tid){
		$topic = $this->get(array('where' =>  array('tid' => $tid)));
		return $topic;
	}
	function delete_topic($tid){
		$this->delete(array('where' => array('tid' => $tid)));
	}
	function update_topic($tid, $data, $escape = true){
		$this->update(array('tid' => $tid), $data, $escape);
	}	
	function get_params($id){
			return false;
	}
	function save_params($params){
		$id = md5($params);
		return $id;
	}
}
/* End of file topic_model.php */
/* Location: ./application/model/topic_model.php */