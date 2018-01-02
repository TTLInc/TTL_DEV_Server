<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Langs_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	private function clearCache(){
		$this->loadCache();
		$this->cache->save('langs','');
		$this->cache->save('langs2', '');
	}
	public function getLang($id){
		$sql = "select * from langs where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function lang_add($data){
		$this->clearCache();
		return $this->db->query($this->db->insert_string('langs',$data));
	}
	public function lang_edit($data,$id){
		$this->clearCache();
		return $this->db->query($this->db->update_string('langs',$data,"id={$id}"));
	}
	public function getCount(){
		$sql = "select count(id) as count from langs";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function getLangs($type = 1){
		$this->loadCache();
		if (  $results = $this->cache->get('langs') && $type != 2 && isset($results) && count($results)>1) {
			return $results;
		}
		if (  $results = $this->cache->get('langs2') && $type == 2  && isset($results) &&  count($results)>1) {
			return $results;
		}
		//if ( ! $results = $this->cache->get('langs')) {
		$sql = 'SELECT id,lang FROM langs ';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			if($type !== 2){
				foreach($result as $k=>$v){
					$results[$v['lang']] = $v['lang'];
				}
				$this->cache->save('langs', $results, 300);
			}
			else {
				$results = $result;
				$this->cache->save('langs2', $results, 300);
			}
		}
		else {
			$results = array();
		}

			
		//}
		
		return $results;
	}
	public function del($id){
		foreach($id as $v){
			$sql = "DELETE FROM langs WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	/************
	 * getProvice get all provice by country id
	 *
	 * @cid  country id
	 ***/
	public function getProvice($cid) {
		$sql = 'SELECT id,provice FROM provices WHERE `cid` '  .$cid;
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else {
			$result = array();
		}
		return $result;
	}
}
