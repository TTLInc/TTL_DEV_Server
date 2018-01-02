<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	/************
	 * getCountries get all z
	 *

	 *
	 ***/
	 public function getCountries($type = 1){
		$sql = 'SELECT id,country,Country_Code FROM countries order by country asc';
		$query = $this->db->query($sql);

		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			//var_dump($result);

				foreach($result as $k=>$v){
					if(!$type){
						$results[$v['id']] = $v['country'];
					}
					else{
						$firstChar = substr($v['country'],0,1);
						if( !isset( $results[$firstChar] ) ){
							$results[$firstChar] = array();
						}
						$results[$firstChar][$v['id']] = $v['country'];
					}

			}
		}
		else {
			$results = array();
		}
		return $results;
	}
/*
 * Country_Code 2013.2.20 调用国家的 Country_Code
 */
	public function getCountryCode($cid){
		$sql = 'SELECT id,country,Country_Code FROM countries where id='.$cid;
		$query = $this->db->query($sql);
        $countryCode = '';
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$countryCode = $v['Country_Code'];
			}
		}

		return $countryCode;
	}
	/*
	 * Country_Code 2013.2.20 调用省份的 Area_Code
	 */
	public function getAreaCode($pid){
		$sql = 'SELECT id,provice,Area_Code FROM provices where id = '.$pid ;
		$query = $this->db->query($sql);
        $AreaCode = '';
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();

			foreach($result as $k=>$v){
				$AreaCode = $v['Area_Code'];
			}
		}

		return $AreaCode;
	}
  
	/************
	 * getProvice get all provice by country id
	 *
	 * @cid  country id
	 ***/
	public function getProvices($cid) {
		$sql = 'SELECT id,provice,Area_Code FROM provices WHERE `cid` = '  .$cid .' order by provice asc';
		if(!$cid){
			$sql = 'SELECT id,provice FROM provices  order by provice asc';
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results[$v['id']] = $v['provice'];
			}
		}
		else {
			$results = array();
		}
		return $results;
	}
	public function getProvices1($cid) {
		$sql = 'SELECT id,provice,Area_Code FROM provices WHERE `cid` = '  .$cid .' order by provice asc';
		if(!$cid){
			$sql = 'SELECT id,provice,Area_Code FROM provices  order by provice asc';
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$results = $query->result_array();
			/*foreach($result as $k=>$v){
				$results[$v['id']] = array();
				$results[$v['id']]['provice'] = $v['provice'];
				$results[$v['id']]['Area_Code'] = $v['Area_Code'];
			}*/
		}
		else {
			$results = array();
		}
		return $results;
	}

	public function getProviceById($id){
		$sql = "select * from provices where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	public function provices_add($data){
		return $this->db->query($this->db->insert_string('provices',$data));
	}
	public function provices_edit($data,$id){
		return $this->db->query($this->db->update_string('provices',$data,"id={$id}"));
	}
	public function provices_del($id){
		foreach($id as $v){
			$sql = "DELETE FROM provices WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}

	public function getCountryById($id){
		$sql = "select * from countries where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	public function country_add($data){
		return $this->db->query($this->db->insert_string('countries',$data));
	}
	public function country_edit($data,$id){
		return $this->db->query($this->db->update_string('countries',$data,"id={$id}"));
	}
	public function country_del($id){
		foreach($id as $v){
			$sql = "DELETE FROM countries WHERE  id={$v}";
			$this->db->query($sql);
			$sql = "DELETE FROM provices WHERE  cid={$v}";
			$this->db->query($sql);
		}
		return $id;
	}

	public function GetTimezone()
	{
		$sql = 'SELECT * FROM timezone';
		$query = $this->db->query($sql);

		if ( $query->num_rows() > 0) {
			$results = $query->result_array();
		}
		else {
			$results = array();
		}
		return $results;
	}
	
	public function DogetCountrycode($id)
	{
		$sql = "SELECT Country_Code from countries where id='{$id}'";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$results = $query->row_array();
		}
		else {
			$results['Country_Code']='1';
		}
		return $results;
	}
}
