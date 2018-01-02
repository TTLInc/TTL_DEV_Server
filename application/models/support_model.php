<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support_model extends TL_Model{
	public function __construct(){
		parent::__construct();
	}
	public function getAllFaq($lan = 'en'){
		$sql 	= "SELECT * FROM `faq` WHERE `status` = '1' AND lang='".$lan."' ORDER BY `order` ASC ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllFaqSearch($SearchQuery, $lan = 'en'){
		$sql 	= "SELECT * FROM `faq` WHERE `status` = '1' AND `lang` = '".$lan."'  AND(`question` LIKE '%{$SearchQuery}%'  OR  `answer` LIKE '%{$SearchQuery}%')   ORDER BY `order` ASC ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$string = "";
			foreach($result as $faq){ 
				$string .= "<h1>".$faq['question']."</h1>";
				$string .= "<p>".$faq['answer']."</p>";
				$string .="<hr/>";
			} 
			return $string;
		}else{
			return '<h1>No Records Found.</h1>';
		}
	}
	public function getAllRes(){
		$sql 	= "SELECT * FROM `tresources` WHERE `status` = '1' ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllResT(){
		$sql 	= "SELECT * FROM `tresources` WHERE `status` = '1' AND rType='T' ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllResS(){
		$sql 	= "SELECT * FROM `tresources` WHERE `status` = '1' AND rType='S' ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
}
/* End of file support_model.php */
/* Location: ./application/model/support_model.php */