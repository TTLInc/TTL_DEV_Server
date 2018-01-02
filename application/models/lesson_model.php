<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lesson_model extends TL_Model{
	public function __construct(){
		parent::__construct();
	}
		
	public function getAll($uid,$page = 1,$perPage = 50) {
		
		 
		 
		$start 	= intval($page - 1) * $perPage;
		
		//$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons left join profile on profile.uid = lessons.uid where lessons.uid={$uid}  and lessons.status =1  limit {$start},{$perPage}";
		//$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,user.quarantine FROM lessons left join profile on profile.uid = lessons.uid left join user on user.id=profile.uid where lessons.uid={$uid}  and lessons.status =1 and user.quarantine=0  limit {$start},{$perPage}";
		$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,user.quarantine FROM lessons left join profile on profile.uid = lessons.uid left join user on user.id=profile.uid where lessons.uid={$uid} and lessons.status =1 and lessons.upload_status =2 and lessons.name != '' limit {$start},{$perPage}";

		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getAllBySid($sid,$page = 1,$perPage = 10) {
		//echo $sid;die;
		$start 	= intval($page - 1) * $perPage;
		//$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,`archived_lessons`.id as alid FROM lessons LEFT JOIN profile ON profile.uid = lessons.uid LEFT JOIN `archived_lessons` ON `archived_lessons`.lid = lessons.id  where `archived_lessons`.sid={$sid}  order by creat_at desc limit {$start},{$perPage}";
		$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,`archived_lessons`.id as alid FROM lessons LEFT JOIN profile ON profile.uid = lessons.uid LEFT JOIN `archived_lessons` ON `archived_lessons`.lid = lessons.id LEFT JOIN user on user.id=lessons.uid  where `archived_lessons`.sid={$sid}  and user.quarantine !=1  order by creat_at desc limit {$start},{$perPage}";
		$query 	= $this->db->query($sql);
		//echo $this->db->last_query();die;
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
		
	public function getOne($lesson_id){
		$sql 	="select lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons left join profile on profile.uid = lessons.uid  where lessons.id = {$lesson_id}";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function update($data){
		unset($data['localTimeZone']);
		return $this->db->query($this->db->update_string('lessons',$data,"id={$data['id']} and uid={$data['uid']}"));
	}
	
	public function delLession($id,$uid){
		$sql 	= "UPDATE lessons SET status = 0 WHERE id={$id} and uid={$uid}";
		$query 	= $this->db->query($sql);
		return array('status'=>true);
	}
	
	public function getOneBySid($lid,$sid){
		$sql 	="SELECT `archived_lessons`.id FROM `archived_lessons` WHERE `lid`={$lid} AND `sid`={$sid}";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = true;
		}
		return $result;
	}
	
	public function buy_lesson($lesson_id,$sid){
		$lesson = $this->getOne($lesson_id);	
		if($lesson == false){
			return array('status'=>false,'msg'=>'The lesson is not found.');
		}
		if( $this->getOneBySid($lesson_id,$sid) ){
			return array('status'=>false,'msg'=>'The lesson is already in your purchased lessons.');
		}
		
		//get student's money
		$sql 		= "SELECT money from profile where uid={$sid}";
		$query 		= $this->db->query($sql);
		$result 	= array('money'=>0);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		$feePersent = $this->getConfig('LES_PRICE_PERCENT');
		$feePersent = $feePersent['value'];
		$getMoney 	= round($lesson['price'] * (1+$feePersent) *100) /100;
		$creat_at 	= date('Y-m-d H:i:s');
		if($result['money'] < $getMoney){
			return array('status'=>false,'msg'=>'Not enough money.');
		}else{
			//--Add Dispute for video
			//$feeSql 	= "UPDATE profile SET money=money+{$lesson['price']}  WHERE uid={$lesson['uid']}";
			//$query 		= $this->db->query($feeSql);		
			
			$tid 			= $lesson['uid'];
			$fee 			= $lesson['price'];
			$disputesSql 	= "INSERT INTO `disputes` (`sid` , `tid` , `createAt` , `fee` , `approve` , `paymentstatus` , `paystatus` , `postpone` , `p_ack` , `p_status` , `type`,`t_hrate` )  VALUES ('{$sid}', '{$tid}', '{$creat_at}'  , '{$getMoney}'  , '0'         , 'Unpaid'        , '0'           ,  '0'         , ''      , ''         , 'Video','{$fee}')";
			$disputesQuery 		= $this->db->query($disputesSql);
			$disputeId = $this->db->insert_id(); // Ilyas
			//student
			$feeSql 	= "UPDATE profile SET money=money-{$getMoney}  WHERE uid={$sid}";
			$query 		= $this->db->query($feeSql);
		}
		$sql 			= "INSERT INTO `archived_lessons` (`lid`,`sid`,`price`,`creat_at`) VALUES ({$lesson['id']},{$sid},{$lesson['price']},'{$creat_at}')";

		if($this->db->query($sql)){
			$archvId = $this->db->insert_id();
			/* Added By Ilyas */
			// Call Transaction Insert Function for insert record - Ilyas
			$CI =& get_instance();
			$CI->load->model('user_model');
			$nw = date("Y-m-d H:i:s");
			$record = array(
				  'user_id' 		=> 	$sid,
				  'amount'		 	=> 	$getMoney,
				  'amount_status' 	=> 	'debit',
				  'type' 			=> 	'Video Purchase',
				  'payment_status' 	=> 	'Paid',
				  'payment_date' 	=> 	$nw,
				  'summary' 		=> 	"Paid to Seller ($tid) by Student($sid)",
				  'ref_table'		=>	'archived_lessons',
				  'ref_id'			=>	$archvId
			);
			$relId = $this->user_model->fnInsertTransaction($record);
			
			$record2 = array(
				  'user_id'			=> 	$tid,
				  'amount'			=> 	$fee,
				  'amount_status'	=> 	'Credit',
				  'type'			=> 	'Video Sell',
				  'payment_status'	=> 	'Pending',
				  'summary'			=> 	"Pending Tutor Payment ($tid) by admin",
				  'ref_table'		=>	'dispute',
				  'ref_id'			=>	$disputeId,
				  'inner_rel_id' 	=> 	$relId
			);
			$this->user_model->fnInsertTransaction($record2);
			/* End */
			return array('status'=>true,'slid'=>$archvId);
		}else {
			return array('status'=>false,'msg'=>'There has something wrong!Please contact to admin.');
		}
	}
	
	public function lessonVedio($lesson_id , $uid,$source,$length=0){
		//$length = 0;
		if($lesson_id == 0){
			$creat_at 	= date('Y-m-d H:i:s');
			//$length 	= 10;
			$sql 		= "INSERT INTO lessons (`source`,`length`,`creat_at`,`uid`) values ('{$source}','{$length}','{$creat_at}',{$uid})";
		}else {
			$sql 		= "update lessons set source = '{$source}' ,length='{$length}' where id={$lesson_id}";
		}
		$this->db->query($sql);
		if($lesson_id){
			return $lesson_id;
		}
		return $this->db->insert_id();
	}
	public function delArchiveVideo($archId) {
		$this->db->query("delete from `archived_lessons` where `id` = '".$archId."'");
		return;
	}
	public function countVideos() {
		$sql = "SELECT count(*) as `total` FROM lessons, profile, user where `profile`.`uid` = `lessons`.`uid` and `user`.`id` = `profile`.`uid` and `user`.`quarantine` = '0' and `lessons`.`status` = '1' order by `creat_at` DESC";
		$query 	= $this->db->query($sql);
		$result = $query->result_array();
		return $result[0]['total'];
	}
	
	public function getAllVideos($offset, $limit) {
		$sql = "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons, profile, user where `profile`.`uid` = `lessons`.`uid` and `user`.`id` = `profile`.`uid` and `lessons`.`status` = '1' and `lessons`.`name` != '' order by `creat_at` DESC";
		
		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function chngvideostatus($id)
	{
		$sql = "update `lessons` set `visibility` = !`visibility` where `id` = '".$id."'";
		$query 	= $this->db->query($sql);
		if ($query) {
			return "true";
		} else {
			return "false";
		}
		
		return $query;
	}
	
	public function chnghomevideostatus($id)
	{
		$sql = "update `lessons` set `homevisible` = !`homevisible` where `id` = '".$id."'";
		$query 	= $this->db->query($sql);
		if ($query) {
			return "true";
		} else {
			return "false";
		}
		
		return $query;
	}
	
	public function chngdashvideostatus($id)
	{
		$sql = "update `lessons` set `dashboardc6` = !`dashboardc6` where `id` = '".$id."'";
		$query 	= $this->db->query($sql);
		if ($query) {
			return "true";
		} else {
			return "false";
		}
		return $query;
	}
	
	public function delvideoLession($id){
		if(!is_array($id))
		{
			$id = explode(" ",$id);
		}
			
		$sql 	= "UPDATE lessons SET status = 0 WHERE id IN (".implode(",",$id).")";
		$query 	= $this->db->query($sql);
		return array('status'=>true);
	}
	
	public function getHomeVideo($id)
	{
		$sql = "select * from `lessons` where `homevisible` = 1";
		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getAllSession($data) {
		
		if($data['keywords'] != '' OR $data['sortKeys'] != '' OR $data['langInput1'] != ''){
			if($data['keywords'] != ''){
				$keywords = $data['keywords'];
				$cnd = 'and (lessons.desc like "%'.$keywords.'%" OR lessons.name like "%'.$keywords.'%")';
			}

			if($data['langInput1'] != ''){
				$cnd .= " and lessons.language = ".$data['langInput1'];
			}

			if($data['sortKeys'] == 'popular_1'){
				$cnd .= " ORDER BY lessons.views DESC";
			}else if($data['sortKeys'] == 'latest_1'){
				$cnd .= " ORDER BY lessons.id DESC";
			}else{
				$cnd .= " ORDER BY lessons.id DESC";
			}

			$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons INNER JOIN profile ON profile.uid = lessons.uid where lessons.visibility = 1 AND lessons.upload_status = 2 AND lessons.status = 1 ".$cnd;
			
		}else if($data['id'] != ''){
			if($data['id'] != ''){
				$cnd .= " and lessons.id < ".$data['id']." ORDER BY lessons.id DESC";
			}

			$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons INNER JOIN profile ON profile.uid = lessons.uid where lessons.visibility = 1 AND lessons.upload_status = 2 AND lessons.status = 1 ".$cnd." LIMIT 15";
			
		}else{
			//$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons left join profile on profile.uid = lessons.uid where lessons.visibility = 1 AND lessons.upload_status = 2 AND lessons.status = 1 ORDER BY lessons.id DESC LIMIT 15";
			$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid FROM lessons INNER JOIN profile ON profile.uid = lessons.uid where lessons.visibility = 1 AND lessons.upload_status = 2 AND lessons.status = 1 ORDER BY lessons.id DESC LIMIT 15";
		}
/*echo $sql;
exit;*/
		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
	
		return $result;
	}
	
	public function getPlaylesson($vid) {

		$sql 	= "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,user.readytotalk FROM lessons left join profile on profile.uid = lessons.uid left join user on user.id=lessons.uid where lessons.visibility=1 AND lessons.id=".$vid;

		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
			$result = $result[0];
		}
		return $result;
	}
	
	public function getLastVideo($vid) {

		$sql = "SELECT lessons.*,profile.firstName,profile.lastName,profile.uid,user.readytotalk FROM lessons left join profile on profile.uid = lessons.uid left join user on user.id=lessons.uid where lessons.visibility=1 AND upload_status = 2 AND dashboardc6 = 1 ORDER BY lessons.id DESC LIMIT 0,1";
		

		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
			$result = $result[0];
		}
		return $result;
	}
	
	public function UpdateLikeCounter($id,$uid)
	{
	    $sql = "SELECT likes FROM lessons WHERE id='$id'";
		$query = $this->db->query($sql);
	    if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}

		$sql = "INSERT INTO video_likes (`vid`,`uid`,`status`) values ('{$id}','{$uid}','1')";
		$this->db->query($sql);

		$adnum=$result[0]['likes']+1;
		$sql1 = "UPDATE lessons SET likes = '{$adnum}' WHERE id = '{$id}'";
		$query11 = $this->db->query($sql1);
		
		return array('status'=>true);
	}
	
	public function UpdateViewCounter($id)
	{
	    $sql   = "SELECT views FROM lessons WHERE id='$id'";
		$query = $this->db->query($sql);
	    if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		$adnum=$result[0]['views']+1;
		$sql1 = "UPDATE lessons SET views = '{$adnum}' WHERE id = '{$id}'";
		$query11 = $this->db->query($sql1);
	}
}
/* End of file lesson_model.php */
/* Location: ./application/model/lesson_model.php */