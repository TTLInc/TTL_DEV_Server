<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tresources_model extends TL_Model{
	
	public function __construct(){
		parent::__construct();
	}
	//--R&D@Sept-19-2013 : Get Teachers'resource by ID
	public function get($id){
		$sql = "SELECT * FROM tresources where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	//--R&D@Sept-19-2013 : Add Teachers'resource
	public function tresources_add($data){
	//print_r($data);
		return $this->db->query($this->db->insert_string('tresources',$data));
	}
	//--R&D@Sept-19-2013 : Edit Teachers'resource by ID
	public function tresources_edit($data,$id){
	/*print_r($data);
	print_r($id);
	exit;*/
			//return $this->db->query($this->db->update_string('tresources',$data,"id={$id}"));
			$sql = "update tresources set vfile='".$data['pfile']."' where id={$id}";
			return $this->db->query($sql);
			
	}
	
	public function del($id ){
		foreach($id as $v){
			//$sql = "DELETE FROM tresources WHERE test_scenario_id='{$v}'";
			$sql = "DELETE FROM tresources WHERE id='{$v}'";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql 	= "SELECT * FROM tresources ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	//--R&D@Sept-19-2013 : GetAll Active Teachers'resource
	public function getAllAds($position){
		$sql 	= "SELECT * FROM tresources WHERE status='{$position}' ORDER BY id DESC";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	
	public function AddTetsScenarios($data){
	//print_r($data);
		return $this->db->query($this->db->insert_string('test_scenario',$data));
	}
	public function GetTestScenario($start,$limit,$sortorder,$sort){
		
		if($sort=='categories')
		{
				$sort='guide_categories.name';
		}	
		
		$sql 	= "SELECT test_scenario.*,guide_categories.name FROM test_scenario left join guide_categories on  test_scenario.categories = guide_categories_id order by {$sort} {$sortorder} limit {$start} ,{$limit}";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
	 
		 
		return $result;
	}

	public function GetTestScenarioedit($id){
		$sql = "SELECT * FROM test_scenario where test_scenario_id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function EditTestScenario($data,$id){
			return $this->db->query($this->db->update_string('test_scenario',$data,"test_scenario_id={$id}"));
	}
	public function DelTestScenario($id ){
		foreach($id as $v){
			$sql = "DELETE FROM test_scenario WHERE  test_scenario_id='{$v}'";
			$this->db->query($sql);
		}
		return $id;
	}
	
	function GetCatagory()
	{
		$result=array();
		$sql="select * from guide_categories where status='Active' order by name asc";
		$qry=$this->db->query($sql);
		$result=$qry->result_array();
		return $result;
	}
}
/* End of file tresources_model.php */
/* Location: ./application/model/tresources_model.php */