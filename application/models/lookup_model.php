
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lookup_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	private function clearCache(){
		$this->loadCache();
		$this->cache->save('langs','');
		$this->cache->save('langs2', '');
	}
	
	public function getAll($start = 0,$length = 15, $search = ''){
		$result = array();
		$whr = "";
		if($search != "")
		{
			$whr = " where (`name` like '%".$search."%' or `en` like '%".$search."%')";
		}
		$sql = "select * from lookup $whr ORDER BY name limit {$start} , {$length}";
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
			$whr = " where (`name` like '%".$search."%' or `en` like '%".$search."%')";
		}
		$sql = "select count(id) as count from lookup $whr ";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function add_multi($data){
		$this->clearCache();
		return $this->db->query($this->db->insert_string('lookup',$data));
	}
	public function edit_multi($data,$id){
		$this->clearCache();
		return $this->db->query($this->db->update_string('lookup',$data,"id={$id}"));
	}
	
	public function getById($id){
		$result = array();
		$sql = "select * from lookup where id={$id} limit 1";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function del($id){
		foreach($id as $v){
			$sql = "DELETE FROM lookup WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	
	public function getValue($id, $sessLang='en'){
		$result = array();
		if($sessLang == ''){
			$sessLang = 'en';
		}
		$sql = "SELECT ".$sessLang." FROM lookup WHERE id = ".$id." ";
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
