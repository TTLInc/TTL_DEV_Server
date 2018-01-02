<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Metatag_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	private function clearCache(){
		$this->loadCache();
		$this->cache->save('langs','');
		$this->cache->save('langs2', '');
	}
	
	// Insert into DB
	public function insertData($data){
		return $this->db->query($this->db->insert_string('metatag',$data));
	}
	
	// Update DB
	public function updateData($data,$cnd=""){
		return $this->db->query($this->db->update_string('metatag',$data,$cnd));
	}
	// Select Data
	public function selectData($select="*",$cnd="",$orderby="id", $order="Desc"){
		$this->db->select($select);
		$this->db->from('metatag');
		if ($cnd) {
			$this->db->where($cnd);	
		}
		$this->db->order_by($orderby,$order);
		$query = $this->db->get();
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAll($start = 0,$length = 15, $search = ''){
		$result = array();
		$whr = "";
		if($search != "")
		{
			$whr = " where (`title` like '%".$search."%')";
		}
		$sql = "select * from metatag $whr ORDER BY `title` limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getCount($search=""){
		$whr = "";
		if($search != "")
		{
			$whr = " where (`title` like '%".$search."%')";
		}
		$sql = "select count(id) as count from metatag $whr ";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function getById($id){
		$result = array();
		$sql = "select * from metatag where id={$id} limit 1";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	// Del Data
	public function delData($id ){
		foreach($id as $v){
			$this->db->delete('metatag', array('id' => $v)); 
		}
		return $id;
	}
	
	public function getValue($id, $sessLang='en'){
		$result = array();
		if($sessLang == ''){
			$sessLang = 'en';
		}
		$sql = "SELECT ".$sessLang." FROM metatag WHERE id = ".$id." ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			foreach($result as $key=>$value){
				//$value			= addslashes($value);
				$value = str_replace('"',"&quot;",$value);
				$value = str_replace("'","&apos;",$value);
				$value 			= $value;
				$result[$key] 	= trim($value);
			}
		}
		return $result;
	}
	
}
