<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function getUidByUsername($username){
		$sql = "SELECT id FROM user WHERE `username`='{$username}' or `email`='{$username}'  ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			return 0;
		}
		return $result['id'];
	}
	public function send($toUid,$fromId,$subject,$message,$attach=''){
		
		$create_at = date('Y-m-d H:i:s'); 		
		$sql = $this->db->insert_string("inbox",array(
			'toId' => $toUid,
			'fId' => $fromId,
			'subject' => $subject,
			'message' => $message,
			'createAt' => $create_at,
			'attach' => $attach
		));
		$this->db->query($sql);
		return $this->db->insert_id();
	}
		
	public function getCount($toId){
		$sql = 'SELECT count(id) AS count FROM inbox WHERE `toId` ='  .$toId;
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		if($result['count'] > 50)
		{
			return $result['count']=50;
		}
		else
		{
			return $result['count'];
		}
	}
	public function getResult($toId,$page,$perpage = 10){
		$start = ($page - 1) * $perpage;
		$sql = "SELECT inbox.*,profile.firstName as username FROM inbox LEFT JOIN profile ON profile.uid = inbox.fId WHERE `toId` = {$toId} ORDER BY `id` DESC limit {$start}, {$perpage}";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getResultUnread($toId,$lastid,$page,$perpage = 10){
		$start = ($page - 1) * $perpage;
		if($lastid == 0){
			$sql = "SELECT inbox.*,CONCAT(profile.firstName, '', profile.uid) as username FROM inbox LEFT JOIN profile ON profile.uid = inbox.fId WHERE `toId` = {$toId}  ORDER BY `id` DESC limit {$start}, {$perpage}";
		}else{
			$sql = "SELECT inbox.*,CONCAT(profile.firstName, '', profile.uid) as username FROM inbox LEFT JOIN profile ON profile.uid = inbox.fId WHERE `toId` = {$toId} AND `inbox`.`id` > {$lastid}  ORDER BY `id` DESC limit {$start}, {$perpage}";
		}
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getDetail($toId,$id){
		$sql = "SELECT inbox.*,user.username FROM inbox LEFT JOIN user ON user.id = inbox.fId WHERE `toId` = {$toId} and inbox.id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function getPrev($toId,$id){
		$sql = "SELECT inbox.*,user.username FROM inbox LEFT JOIN user ON user.id = inbox.fId WHERE `toId` = {$toId} and inbox.id<{$id} order by id desc";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function getNext($toId,$id){
		$sql = "SELECT inbox.*,user.username FROM inbox LEFT JOIN user ON user.id = inbox.fId WHERE `toId` = {$toId} and inbox.id>{$id} order by id asc";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function delMessage($toId,$id){
		if(is_array($id)) {
		
						$unlink="select attach,toId from inbox where id in (" . implode($id,','). ") and toId={$toId}";
						$query 	= $this->db->query($unlink);
						if ($query->num_rows() > 0) {
							$result = $query->result_array();
							}
						if(count($result) >0)
						{						
						
							for($i=0; $i<count($result);$i++)
								{
								
									unlink(FCPATH."attachment/".$result[$i]['toId']."/".$result[$i]['attach']);
								}
							
						}
			$sql = "delete from inbox where id in (" . implode($id,','). ") and toId={$toId}";
		}else { 
		
				$unlink="select attach,toId from inbox  where toId={$toId} and id={$id}";
						$query 	= $this->db->query($unlink);
						if ($query->num_rows() > 0) {
							$result = $query->result_array();
							}
						if(count($result) >0)
						{						
						
							for($i=0; $i<count($result);$i++)
								{
								
									unlink(FCPATH."attachment/".$result[$i]['toId']."/".$result[$i]['attach']);
								}
							
						}
		
			$sql = "delete from inbox where toId={$toId} and id={$id}";
		}
		return $query = $this->db->query($sql);
	}
	public function getUnreadMessages($uid){
		$sql = "SELECT COUNT(*) as num FROM inbox WHERE `toId` = {$uid} AND isRead = 0";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function GetByRoleId($uid)
	{
		 
		$sql="select roleId from user where id='{$uid}'";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0 ) {
			$result = $query->row_array();
		} 
		return $result;
	}
	
	//added by haren january scope
	public function SentItem($toUid,$fromId,$subject,$message,$attach='',$messId){
		$create_at = date('Y-m-d H:i:s'); 		
		$sql = $this->db->insert_string("sentbox",array(
			'to' => $toUid,
			'from' => $fromId,
			'subject' => $this->db->escape($subject),
			'message' => $this->db->escape($message),
			'createAt' => $create_at,
			'attach' => $attach,
			'InboxId' => $messId
		));
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	public function GetSentCount($frmid){
		$sql = 'SELECT count(sentbox_id) AS count FROM sentbox WHERE `from` ='  .$frmid;
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		if($result['count'] > 50)
		{
			return $result['count']=50;
		}
		else
		{
			return $result['count'];
		}
	}
	
	public function GetSentItem($frmid,$page,$perpage = 10){
		$start = ($page - 1) * $perpage;
		$sql = "SELECT sentbox.*,profile.firstName as username FROM sentbox LEFT JOIN profile ON profile.uid = sentbox.to WHERE `from` = {$frmid} ORDER BY `sentbox_id` DESC limit {$start}, {$perpage}";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function GetMessageContent($frmid,$id){
		$sql = "SELECT sentbox.*,profile.firstName,profile.lastName,profile.email,profile.uid  FROM sentbox LEFT JOIN profile ON profile.uid = sentbox.to WHERE `from` = {$frmid} and sentbox.sentbox_id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		 
		 
		return $result;
	}
	public function GetFwdDetail($toId,$id){
		 
		$sql = "SELECT sentbox.*,user.username FROM sentbox LEFT JOIN user ON user.id = sentbox.from WHERE `from` = {$toId} and sentbox.sentbox_id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		//echo $this->db->last_query();die;
		return $result;
	}
	
		public function getSentPrev($frm,$id){
			 
		$sql = "SELECT sentbox.*,user.username FROM sentbox LEFT JOIN user ON user.id = sentbox.from WHERE `from` = {$frm} and sentbox.sentbox_id < '{$id}' order by id desc";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	
		public function getSentNext($frm,$id){
		$sql = "SELECT sentbox.*,user.username FROM sentbox LEFT JOIN user ON user.id = sentbox.from WHERE `from` = {$frm} and sentbox.sentbox_id > '{$id}' order by id asc";
		$query = $this->db->query($sql);
		$result = array();
		if ( $query->num_rows() > 0 ) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function deleteSentItem($frm,$id){
		 
		if(is_array($id)) {
		
						$unlink="select * from sentbox where sentbox_id in (" . implode($id,','). ") and `from`='{$frm}'";
						$query 	= $this->db->query($unlink);
						if ($query->num_rows() > 0) {
							$result = $query->result_array();
							}
						if(count($result) >0)
						{						
						
							for($i=0; $i<count($result);$i++)
								{
								
									unlink(FCPATH."attachment/".$result[$i]['from']."/".$result[$i]['attach']);
								}
							
						}
			$sql = "delete from sentbox where sentbox_id in (" . implode($id,','). ") and `from`={$frm}";
		}else { 
		
				$unlink="select * from sentbox  where `from`={$frm} and sentbox_id={$id}";
						$query 	= $this->db->query($unlink);
						if ($query->num_rows() > 0) {
							$result = $query->result_array();
							}
						if(count($result) >0)
						{						
						
							for($i=0; $i<count($result);$i++)
								{
								
									unlink(FCPATH."attachment/".$result[$i]['from']."/".$result[$i]['attach']);
								}
							
						}
		
			$sql = "delete from sentbox where `from`={$frm} and sentbox_id={$id}";
		}
		return $query = $this->db->query($sql);
	}
	
	public function getconcatSearch($keyword)
	{
		$result = array();
		$sql = "select u.email,p.uid from profile as p , user as u where p.uid = u.id AND ( CONCAT(p.firstName ,p.uid) LIKE '{$keyword}%')";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->row_array();
        } 
		 
		return $result;
	}
}
/* End of file inbox_model.php */
/* Location: ./application/model/inbox_model.php */