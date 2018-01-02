<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dchatmodel extends TL_Model
{
	function __construct()
	{
		parent::__construct(); 
	}
	
	function getAll()
	{
		$sql = "SELECT * FROM dmessage ORDER BY post_time DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '0';
		}
	}
	function del($id)
	{
		foreach($id as $v){
			$sql = "DELETE FROM dmessage WHERE  message_id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	function deleteChatRecords3()
	{
		$sql = "DELETE FROM dmessage WHERE post_time < date_sub( CURDATE() , INTERVAL 3 day ) ";
		$this->db->query($sql);
		
		
	}
	
	/*function getMsg($last,$cht)
	{
		 
		$sql = "SELECT message_id, chat_id,user_id, user_name, message, post_time" . 
		" FROM dmessage WHERE chat_id = '$cht' AND message_id > '$last' AND post_time BETWEEN date_sub( CURDATE() , INTERVAL 2 day ) AND (CURDATE()+1)";
		$query = $this->db->query($sql);
		 
		return $query;
		
	}*/
	
	function getMsg($last,$cht)
	{
		/*$sql = "SELECT message_id, chat_id,user_id, user_name, message, post_time" . 
		" FROM dmessage WHERE chat_id = '$cht' ORDER BY message_id DESC LIMIT 50";
	*/
		$sql = "SELECT * FROM (
    SELECT * FROM dmessage WHERE chat_id = '$cht' AND message_id > '$last' ORDER BY message_id DESC LIMIT 10
) sub
ORDER BY message_id ASC";
		$query = $this->db->query($sql);
		return $query;
		
	}
	/*
	function insertMsg($chat_id, $user_id, $user_name , $message ,$current)
	{
		$currentNew = $this->inTime($current);
		$currentNew = date('Y-m-d H:i:s',$this->inTime($current));
		$sql = "INSERT INTO dmessage SET chat_id='$chat_id', user_id='$user_id', user_name='$user_name', message='$message', post_time='$currentNew'";
		//$sql = "INSERT INTO dmessage SET chat_id='$chat_id', user_id='$user_id', user_name='$user_name', message='$message', post_time=now()";
		return $this->db->query($sql);
	}*/
	function insertMsg($chat_id, $user_id, $user_name , $message ,$current)
	{
		$currentNew = $this->inTime($current);
		///$sql = "INSERT INTO dmessage SET chat_id='$chat_id', user_id='$user_id', user_name='$user_name', message='$message', post_time='$currentNew'";
		$sql = "INSERT INTO dmessage SET chat_id='$chat_id', user_id='$user_id', user_name='$user_name', message='$message', post_time='$current'";
		//$sql = "INSERT INTO dmessage SET chat_id='$chat_id', user_id='$user_id', user_name='$user_name', message='$message', post_time=now()";
		return $this->db->query($sql);
	}
	function updatealertstatus($id)
	{
		//echo $id;exit;
		$sql = "UPDATE dmessages SET new = 0 WHERE id = {$id}";
		$query = $this->db->query($sql);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
	function checkBlocked($uid)
	{
		$sql = "SELECT chat FROM user WHERE id='$uid'";
		return $this->db->query($sql);
	}
	function checkBandedWords()
	{
		$sql = "SELECT banded_words FROM settings";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return '0';
		}
	}
	function checkExistsGroup($userid,$chatid)
	{
		$sql = "SELECT * FROM dchat_group_user WHERE (userid = '$userid' OR invitedbyuid = '$userid') AND chatid = '$chatid'  ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return 'yes';
		}else{
			return 'no';
		}
	}
	function create_group($data)
	{
		$chat_name = $data['groupname'];
		$owner_message = $data['ownermessage'];
		$uid = $data['uid'];
		
		$sql = "INSERT INTO dchat SET  chat_name='$chat_name', owner_message='$owner_message', user_id='$uid'";
		$query = $this->db->query($sql);
		$gid = $this->db->insert_id();
		return $gid;
	}
	function delete_group($data)
	{
		$gid = $data['gid'];
		$uid = $data['uid'];
		
		$sql = "DELETE FROM dchat WHERE  chat_id='$gid' AND user_id = '$uid' ";
		$query = $this->db->query($sql);
	}
	function delete_invitations($data)
	{
		$gid = $data['gid'];
		$uid = $data['uid'];
		
		$sql = "DELETE FROM dchat WHERE  chat_id='$gid' AND user_id = '$uid' ";
		$query = $this->db->query($sql);
		
		$sql1 = "DELETE FROM dchat_group_user WHERE  chatid='$gid' AND (userid = '$uid' OR invitedbyuid = '$uid') ";
		$query1 = $this->db->query($sql1);
		
	}
	function getGroups($uid)
	{
		$sql = "SELECT * FROM dchat WHERE user_id = '{$uid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return  $query->result_array();
		}else{
			return '0';
		}
	}
	function getGroupsByGid($gid)
	{
		$sql = "SELECT * FROM dchat WHERE chat_id = '{$gid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return  $query->result_array();
		}else{
			return '0';
		}
	}
	function acceptedGroups($uid)
	{
		$sql = "SELECT chatid FROM dchat_group_user WHERE userid = '{$uid}' AND status = 'accepted' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return  $query->result_array();
		}else{
			return '0';
		}
	}
	function getInviteGroup($gid)
	{
		$sql = "SELECT * FROM dchat WHERE chat_id = '{$gid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return  $query->result_array();
		}else{
			return '0';
		}
	}
	function inviteUser($chat,$userid,$uid,$current)
	{
		$sql = "INSERT INTO dchat_group_user SET  userid='$userid',invitedbyuid='$uid', chatid='$chat', status='invited', invitetime=now()";
		$query = $this->db->query($sql);
		$gid = $this->db->insert_id();
		return $gid;
	}
	function getInvitation($userid)
	{
		$sql = "SELECT id,userid, chatid, invitedbyuid " . 
		" FROM dchat_group_user WHERE status = 'invited' AND userid = '$userid' ";
		
		return $this->db->query($sql);
	}
	function getAcceptedInvitation($userid,$chtstatus)
	{
		$sql = "SELECT id,userid, chatid, invitedbyuid " . 
		" FROM dchat_group_user WHERE status = 'accepted' AND invitedbyuid = '$userid' AND chatstarted = 0 ";
		return $this->db->query($sql);
	}
	function getAcceptedInvitation_update($userid,$chatid)
	{
		$sql = "UPDATE dchat_group_user SET chatstarted = 1" . 
		" WHERE status = 'accepted' AND invitedbyuid = '$userid' AND chatstarted = 0 AND chatid = '$chatid' ";
		return $this->db->query($sql);
	}
	function getInvitationByGroup($userid,$gid)
	{
		$sql = "SELECT id,userid, chatid" . 
		" FROM dchat_group_user WHERE status = 'invited' AND userid = '$userid' AND chatid = '$gid' ";
		
		return $this->db->query($sql);
	}
	function updateInvitation($uid,$cht)
	{
		$sql = "UPDATE dchat_group_user SET status = 'accepted'" . 
		" WHERE userid = '$uid' AND chatid = '$cht' ";
		return $this->db->query($sql);
	}
	function getInvitationStatus($userid)
	{
		$sql = "SELECT status" . 
		" FROM dchat_group_user WHERE userid = '$userid' ";
		$query = $this->db->query($sql);
		return  $query->result_array();
	}
	function getInvitationStatusByGroup($userid,$gid)
	{
		$sql = "SELECT status" . 
		" FROM dchat_group_user WHERE userid = '$userid' AND chatid = '$gid' ";
		$query = $this->db->query($sql);
		return  $query->result_array();
	}
	function inTimeChat($time)
	{
		
		$intimeR = date('Y-m-d H:i:s',$this->inTime($time));
		return $intimeR;
	}
	function outTimeChat($time)
	{
		$localTimeZone= 'a';
		//$outtime = date('Y-m-d g:i A',$this->outTime($time));
		//$this->outTime($time,$localTimeZone);
		$outtime = date('Y-m-d g:i A',$this->outTime($time));
		return $outtime;
	}
}

