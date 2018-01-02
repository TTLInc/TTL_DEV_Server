<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chatmodel extends TL_Model
{
	function __construct()
	{
		parent::__construct(); 
	}
	
	
	function getMsg($limit = 10)
	{
		//$sql = "SELECT * FROM messages ORDER BY id DESC LIMIT $limit";		
		$sql = "SELECT * FROM messages WHERE new = 1 ORDER BY id ASC";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		
		// update message status
		if(isset($data) && $data !='')
		{
			foreach($data as $ms)
			{
				$this->updatealertstatus($ms['id']);
			}
		}	
		return $this->db->query($sql);
	}
	
	function insertMsg($name, $message, $current)
	{
		$sql = "INSERT INTO messages SET user='$name', msg='$message', time='$current'";
		return $this->db->query($sql);
	}
	function updatealertstatus($id)
	{
		//echo $id;exit;
		$sql = "UPDATE messages SET new = 0 WHERE id = {$id}";
		$query = $this->db->query($sql);
		if($query)
		{
			return true;
		}else{
			return false;
		}
	}
}

