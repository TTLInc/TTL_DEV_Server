<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lms_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM lms_document where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function document_add($data){
		return $this->db->query($this->db->insert_string('lms_document',$data));
	}
	public function document_edit($data,$id){
		return $this->db->query($this->db->update_string('lms_document',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM lms_document WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM lms_document where status = 'active' ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAdminAll(){
		$sql = "SELECT * FROM lms_document";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	// question management functions
	public function getAllQuestion(){
		$sql = "SELECT * FROM lms_questions WHERE status = 'active' ORDER BY RAND() LIMIT 0,5";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllAdminQuestion($start,$limit){
		$sql = "SELECT * FROM lms_questions LIMIT {$start}, {$limit}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getTotalQuestions(){
		$sql = "SELECT COUNT(*) as num FROM lms_questions  ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		return $result;
	}
	public function getQuestion($id){
		$sql = "SELECT * FROM lms_questions where id={$id} and status = 'active' ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function question_add($data){
		return $this->db->query($this->db->insert_string('lms_questions',$data));
	}
	public function question_edit($data,$id){
		return $this->db->query($this->db->update_string('lms_questions',$data,"id={$id}"));
	}
	public function delQuestion($id ){
		foreach($id as $v){
			$sql = "DELETE FROM lms_questions WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function update_doc_as_read($data){
		return $this->db->query($this->db->insert_string('lms_user_read',$data));
	}
	public function checks_read_doc_complete($did,$uid){
		$sql = "SELECT * FROM lms_user_read where uid={$uid} and docid = {$did}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function updateForComplete($id){
		$sql = "UPDATE profile set lms_complete = 1 WHERE  uid={$id}";
		$this->db->query($sql);
	}
	public function read_doc_ids($uid){
		$sql = "SELECT DISTINCT docid FROM lms_user_read where uid={$uid} ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function get_ans($qid){
		$sql = "SELECT rans FROM lms_questions where id={$qid} ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function get_total_que(){
		$sql = "SELECT count(*) as num FROM lms_questions WHERE status = 'active'";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = array();
		}
		return $result;
	}
	public function update_exam($data,$uid){
		$sql = "SELECT * FROM lms_exams where uid = {$uid}";
		$query = $this->db->query($sql);
		$date = date('Y-m-d H:i:s',time());
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$score = $data['score'];
			$retest = $data['retest'];
			$passed = $data['passed'];
			$answers = $data['answers'];
			$attempts = 1;
			$sql = "UPDATE lms_exams SET score = {$score},retest = {$retest},passed = {$passed},answers = '{$answers}',attempts = attempts + {$attempts},date = '{$date}' where uid = {$uid}";
			$query = $this->db->query($sql);
		}else{
			$score = $data['score'];
			$retest = $data['retest'];
			$passed = $data['passed'];
			$answers = $data['answers'];
			$sql = "INSERT INTO lms_exams(uid,score,retest,passed,answers,attempts,date) VALUES({$uid},{$score},{$retest},{$passed},'{$answers}',1,'{$date}')";
			$query = $this->db->query($sql);
		}
	}
	public function getExam($uid){
		$sql = "SELECT * FROM lms_exams WHERE uid = {$uid}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getReTestCheck($uid){
		$sql = "SELECT * FROM lms_exams WHERE uid = {$uid} and retest = 1 and attempts = 1";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = 'Yes';
		}else{
			$result = 'No';
		}
		return $result;
	}
}
/* End of file lms_model.php */
/* Location: ./application/model/lms_model.php */