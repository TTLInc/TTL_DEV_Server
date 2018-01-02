<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM ads where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
	public function getAdid($id){
		$sql = "SELECT * FROM advertisement where advertisementid={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	public function ad_advertise($data){
	
	 
		return $this->db->query($this->db->insert_string('advertisement',$data));
	}
   
	public function ad_add($data){
	
		return $this->db->query($this->db->insert_string('ads',$data));
	}
	public function ad_edit($data,$id){
		return $this->db->query($this->db->update_string('ads',$data,"id={$id}"));
	}
	public function advertise_edit($data,$id){
		return $this->db->query($this->db->update_string('advertisement',$data,"advertisementid={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM ads WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function delAdvertise($id ){
		foreach($id as $v){
			$sql = "DELETE FROM advertisement WHERE advertisementid={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM ads ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	public function getAdvertisement(){
	     $today = date('Y-m-d');  
	    $sql2="Update advertisement set status='Inactive' where expdate < '{$today}'";
		$query1 = $this->db->query($sql2);
		$sql = "SELECT * FROM advertisement";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		
		return $result;
	}
	/**
	*@author TECHNO-SANJAY
	*@contains below function loads all ads by position which is passed on this function
	*@date 07 May 2013 
	**/
	public function getAllAds($position){
		$sql = "SELECT * FROM ads WHERE position='{$position}' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
	
	// added by haren
	public function ad_school_advertise($data){
	
	 
		return $this->db->query($this->db->insert_string('school_addvertise',$data));
	}
	public function SchoolAdd(){
	     
		$sql = "SELECT * FROM school_addvertise";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		
		return $result;
	}
	
	public function schoolAddDel($id ){
		foreach($id as $v){
			$sql = "DELETE FROM school_addvertise WHERE id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	
	public function AddLanguageApps($data)
	{

 
		return $this->db->query($this->db->insert_string('languageapp',$data));
	}
	
	public function GetAllApps()
	{
		$sql = "SELECT * FROM languageapp";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) 
		{
				$result = $query->result_array();
		}
		else
		{
			$result = array();
		}
	
		return $result;
	}
	
	public function UpdateAppStatus($lid)
	{
		$sql="select status from languageapp where LanguageAppID = '{$lid}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$Stt=$result['status'];
		if($Stt == 'Active')
		{
			$sql="update languageapp  set status='Deactive' where  LanguageAppID= '{$lid}'";
			$query = $this->db->query($sql);
		}
		else
		{
			$sql="update languageapp  set status='Active' where  LanguageAppID= '{$lid}'";
			$query = $this->db->query($sql);
		}
	}
	
	public function GetAppById($id){
		$sql = "SELECT * FROM languageapp where LanguageAppID={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
	public function UpdateApps($data,$id){
		return $this->db->query($this->db->update_string('languageapp',$data,"LanguageAppID={$id}"));
	}
	
	public function DelApp($id ){
		foreach($id as $v){
		
				$unlink="select Source from  languageapp where LanguageAppID ={$v}";
						$query 	= $this->db->query($unlink);
						if ( $query->num_rows() > 0) {
							$result = $query->row_array();
							 
							unlink(FCPATH.'LanuageApp/'.$result['Source']);
							}	
			$sql = "DELETE FROM languageapp WHERE LanguageAppID={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
}
