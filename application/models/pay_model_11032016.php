<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay_model extends TL_Model{
	public function __construct(){
		parent::__construct();
	}
	
	/**	
	*
	* save media info
	* @param $userinfo
	*/
	public function save($pay) {
		$pay['creatAt'] = date('Y-m-d H:i:s');
		$query = $this->db->query($this->db->insert_string('pay',$pay));
		$payId = $this->db->insert_id();
		$nw = date("Y-m-d H:i:s");
		/* Insert Transaction Entry By Ilyas */
		$this->load->model(array('user_model'));
		$record = array(
			  'user_id' 		=> 	$pay['uid'],
			  'amount'		 	=> 	$pay['money'],
			  'amount_status' 	=> 	'credit',
			  'type' 			=> 	'Credit Purchase',
			  'payment_status' 	=> 	'Paid',
			  "payment_date"	=>	$nw,
			  "Summary"			=>	"Amount Paid to admin.",
			  'ref_table'		=>	'pay',
			  'ref_id'			=>	$payId,
			  'status'			=> 	'Done',
			  'status_comment'	=>	$pay['token'],
			  
		);
		$trnsId = $this->user_model->fnInsertTransaction($record);
		/* End */
		return $query;
	}
	public function bs_save($pay) {
		$pay['creatAt'] = date('Y-m-d H:i:s');
		return $query 	= $this->db->query($this->db->insert_string('pay',$pay));
	}

	public function update($pay) {
		if($pay['money'] == '30')
		{
			$pay['money'] = '25';
		}
		//echo '<pre>';print_r($pay);exit;
		$query = $this->db->query($this->db->update_string('pay',$pay,"token='{$pay['token']}'"));
		/* Update Transaction Entry By Ilyas */
		$this->load->model(array('user_model'));
		$this->user_model->fnUpdateTransaction(array("payment_status"=>"Process","Summary"=>"Payment Process","status"=>"Process"),array('status_comment'=>$pay['token']));
		/* End */
		return $query;
	}
	
	public function findByToken($token) {
		$sql 	= "SELECT * from pay WHERE token = '{$token}'";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function findByProfileId($profileId) {
		$sql 	= "SELECT * from pay WHERE profileId = '{$profileId}'";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}

	public function updateProofileMoney($money){
		$uid 	= $this->session->userdata('uid');
		$sql 	= "SELECT money from profile WHERE uid = '{$uid}'";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result 	= $query->row_array();
			@$result1 	= @$result['money'] + $money;
			$sql 		= "UPDATE profile SET money = '{$result1}' WHERE uid = '{$uid}'";
			$query 		= $this->db->query($sql);
			
			/* Update Transaction Entry By Ilyas */
			$nw = date("Y-m-d H:i:s");
			$this->load->model(array('user_model'));
			//$this->user_model->fnUpdateTransaction(array("payment_status"=>"Paid","payment_date"=>$nw,"Summary"=>"Amount Updated to User($uid) Account.","status"=>"Done"),array('status_comment'=>$pay['token']));
			/* End */
		}
	}
	
	public function updateTutorGold($id)
	{
		$sql 		= "UPDATE user SET roleId = '3' WHERE id = '{$id}'";
		$query 		= $this->db->query($sql);
	}

	public function addPremiumMonth($givendate,$day=0,$mth=0,$yr=0) {
		$cd 		= strtotime($givendate);
		$newdate 	= date('Y-m-d h:i:s', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth, date('d',$cd)+$day, date('Y',$cd)+$yr));
		return $newdate;
	}

	public function  updateTutorMonths($month , $id){
		$sqlPay 	= "SELECT * FROM `pay` WHERE `uid`={$id} ORDER BY id DESC LIMIT 0";
		$queryPay 	= $this->db->query($sqlPay);
		if ($queryPay->num_rows() > 0) {
			$totalTransactions 	= $queryPay->result_array();
			$oldDate 			= $totalTransactions['expDate'];
			$tId 				= $totalTransactions['id'];
			$newDate 			= addPremiumMonth($oldDate,$day=0,$mth=$month,$yr=0);
			$sqlPay 			= "UPDATE  `pay` SET (`expDate` = {$newDate})WHERE `id`={$tId}";
			$queryPay 			= $this->db->query($sqlPay);
		}
	}

	/*public function getAll($start,$search = '',$limit,$sortorder,$sort) {
		if($search == ''){
			$sql = "SELECT * from disputes order by {$sort} {$sortorder}";
		}else{
			$sql = "SELECT d.* from disputes as d,user as u,profile as p WHERE d.sid = u.id and d.sid = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstName like '{$search}' OR p.lastName like '{$search}') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;	
	}*/
	/*public function getAll($start,$search = '',$limit,$sortorder,$sort) {
		
		if($search == ''){
			$sql = "SELECT * from disputes order by {$sort} {$sortorder}";
		}else{
			$sql = "SELECT distinct d.id, d.* from disputes as d,user as u,profile as p WHERE (d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstName like '{$search}' OR p.lastName like '{$search}') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}*/
	/*public function getAll($start,$search = '',$limit,$sortorder,$sort) {
		if($search == ''){
			$sql = "SELECT * from disputes order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}else{
			//$sql = "SELECT distinct  CONCAT(firstName, ' ', lastName) as 'full_name' ,d.id, d.* from disputes as d,user as u,profile as p WHERE (d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (u.id like '{$search}' OR u.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
			$sql = "SELECT distinct d.createAt,d.id, d.* from disputes as d,user as u,profile as p WHERE (d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (u.id like '{$search}' OR u.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//%{$search}%
		//echo $this->db->last_query();die;
		return $result;
	}*/
	
	public function getAll($start,$search = '',$limit,$sortorder,$sort) {
	
		 if($search == ''){
			
			//$sql = "SELECT * from disputes where is_completed=1 order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
			$sql = "SELECT disputes.*,class.action  from disputes left join class on disputes.cid=class.id where is_completed=1 order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}else{
			//$sql = "SELECT distinct d.createAt,d.id, d.* from disputes as d,user as u,profile as p WHERE d.is_completed=1 AND (d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (d.id like '{$search}' OR u.id like '{$search}' OR u.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
			$sql = "SELECT distinct d.createAt,d.id, d.*,class.action from disputes as d , user as u,profile as p,class  WHERE d.is_completed=1 AND class.id=d.cid AND(d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (d.id like '{$search}' OR u.id like '{$search}' OR u.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//echo $this->db->last_query(); 
		return $result;
	}
	
	public function getNotPayed() {
		$sql 	= "SELECT * from disputes WHERE is_completed=1 AND paystatus = 0 AND postpone = 0 AND approve = 0 AND cid IN (select id from class) AND is_Deleted != 1 order by createAt desc ";
		$query 	= $this->db->query($sql);

		$result = false;

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		/*echo "<pre>";
		print_r($result);
		exit;*/
		return $result;
	}
	
	/*public function getReturnPayed() {
		$sql 	= "SELECT * from disputes WHERE paystatus = 0 AND postpone = 0 AND approve = 0 order by createAt desc ";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}*/

	/*
	public function getTotalDisputes($search = ''){
		if($search == ''){
			$sql = "SELECT COUNT(*) as num FROM disputes";
		}else{
			$sql = "SELECT COUNT(*) as num FROM disputes as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid AND ( u.email like '{$search}' OR u.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' )";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		return $result;
	}*/
	public function getTotalDisputes($search = ''){
		if($search == ''){
			$sql = "SELECT COUNT(*) as num FROM disputes where is_completed=1";
		}else{
			$sql = "SELECT COUNT(*) as num FROM disputes as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid AND is_completed=1 AND ( u.email like '{$search}' OR u.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' )";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		//echo $this->db->last_query();die;
		return $result;
	}
	
	public function update_disputes($tid,$sid) {
		$sql 	= "SELECT id,fee from disputes WHERE tid={$tid} AND sid = {$sid} order by createAt desc limit 0,1";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$idu 	= $result['id'];
			$fee 	= $result['fee'];
			// update disputes
			$sql 	= "UPDATE disputes SET approve = 0 , postpone =1, paymentstatus = 'Unpaid' WHERE id={$idu}";
			$query 	= $this->db->query($sql);
			
			// updates tutor fees
			$feeSql = "update profile set money=money-{$fee} , frMoney=frMoney+{$fee} where uid={$tid}";
			$query 	= $this->db->query($feeSql);

			// updates student fees
			$feeSql = "update profile set money=money+{$fee} , frMoney=frMoney-{$fee} where uid={$sid}";
			$query = $this->db->query($feeSql);
		}
	}
	
	public function update_return_disputes($tid,$sid,$createAt) {
		$sql 	= "SELECT id,fee from disputes WHERE tid={$tid} AND sid = {$sid} AND createAt = '{$createAt}'";		
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$idu 	= $result['id'];
			$fee 	= $result['fee'];			

			// updates student fees
			/*$feeSql = "update profile set money=money+{$fee} , frMoney=frMoney-{$fee} where uid={$sid}";
			$query = $this->db->query($feeSql);*/
			// approve 2 means - session rate has been added in student's account
			/*$updatedis = "UPDATE disputes SET approve = 2 WHERE tid={$tid} AND sid = {$sid} AND createAt = '{$createAt}'";
			$updatedisquery = $this->db->query($updatedis);*/
		}
	}
	
	public function update_tutor_disputes($tid,$sid,$createAt) {
		$sql 	= "SELECT id,fee,t_hrate from disputes WHERE tid={$tid} AND sid = {$sid} AND approve = 1 AND createAt = '{$createAt}'";		
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$idu 	= $result['id'];
			$fee 	= $result['fee'];
			$hrate 	= $result['t_hrate'];

			$feeSql = "update profile set money=money+{$hrate} , frMoney=frMoney-{$hrate} where uid={$tid}";
			$query = $this->db->query($feeSql);
		}
	}
	
	public function del_disputes($id ){
		foreach($id as $v){
			//$sql = "DELETE FROM disputes WHERE  id={$v}";
			$sql="update disputes set is_Deleted=1 where id={$v} ";
			$this->db->query($sql);
			
			$sql="select sid,tid,t_hrate,cid from disputes where id={$v}";
			$query 	= $this->db->query($sql);
			$result = $query->row_array();

			$result['t_hrate'] = $result['t_hrate'] + ($result['t_hrate'] * 0.33);

			$feeSql = "update profile set money=money+{$result['t_hrate']} , frMoney=frMoney-{$result['t_hrate']} where uid={$result['sid']}";
			$query = $this->db->query($feeSql);
			
			//update class table, set isDenied value
			$densql = "update class set isDenied=1 where id={$result['cid']}";
			$dquery = $this->db->query($densql);
			//$InsDate=date('Y-m-d');

			//$sqlInsert = "insert into Stu_Tut_Add (Stu_id,Tut_id,Disput_id,Rate,Date) values ('{$result['sid']}','{$result['tid']}','{$v}','{$result['t_hrate']}','{$InsDate}')";
			//$InsertResult = $this->db->query($sqlInsert);
			//$feeSql = "update profile set money=money-{$result['t_hrate']}   where uid={$result['tid']}";
			//$query = $this->db->query($feeSql);
			
		}
		return $id;
	}
	
	public function calcel_disputes($rs){
		if(count($rs)>0){
			$rs = $rs[0];
		}
		$tid 		= $rs['tid'];
		$sid 		= $rs['sid'];
		$createdAt 	= $rs['createAt'];
		$sql 		= "DELETE FROM disputes WHERE sid='{$sid}' AND tid = '{$tid}' AND createAt = '{$createdAt}'";
		$this->db->query($sql);
	}

	public function disputes_postpond($id) {
		$sql 	= "SELECT id,fee,sid,tid,paymentstatus,`type` from disputes WHERE id={$id}  order by createAt desc limit 0,1";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$idu 	= $result['id'];
			$fee 	= $result['fee'];
			$tid 	= $result['tid'];
			$sid 	= $result['sid'];
			$type 	= $result['type'];
			//--R&DDec20
			$isChangedBefore = $result['paymentstatus'];
			//--R&DDec20

			// update disputes
			$sql 	= "UPDATE disputes SET approve = 0 , postpone =1, paymentstatus = 'Unpaid' WHERE id={$idu}";
			$query 	= $this->db->query($sql);
			
			/* Update Transaction Entry By Ilyas */
			$this->load->model(array('user_model'));
			$statusCmt = "Vee Session Completed";
			if ($type=="Video") {
				$statusCmt = "Video Payment Postponed.";
			}
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"Postpone","status"=>"Complete","status_comment"=>$statusCmt, "summary"=>"Postpone payment of Tutor by admin"),array('ref_table'=>'dispute', 'ref_id'=>$idu));
			/* End */
			
			//--R&DDec20 : For Mantis bug 285
			if($isChangedBefore == 'Paid'){
				// updates tutor fees
				$feeSql = "update profile set money=money-{$fee} , frMoney=frMoney+{$fee} where uid={$tid}";
				$query 	= $this->db->query($feeSql);

				// updates student fees
				$feeSql = "update profile set money=money+{$fee} , frMoney=frMoney-{$fee} where uid={$sid}";
				$query 	= $this->db->query($feeSql);
				
				/* Update Transaction Entry By Ilyas */
				$result = $this->user_model->fnSelectTransaction("inner_rel_id",array('ref_table'=>'dispute','ref_id'=>$idu));
				foreach ($result as $row)
				{
					$statusCmt = "Vee Session Invalid";
					if ($type=="Video") {
						$statusCmt = "Video Invalid.";
					}
					$nw = date("Y-m-d H:i:s");
					$this->user_model->fnUpdateTransaction(array("payment_status"=>"Refund","payment_date"=>$nw,"Summary"=>"Changed Payment Status to Paid Before Payment","status"=>"Invalid","status_comment"=>$statusCmt),array('id'=>$row->inner_rel_id));
					$this->user_model->fnUpdateTransaction(array("payment_status"=>"Deduct","payment_date"=>$nw,"Summary"=>"Changed Payment Status to Paid Before Payment","status"=>"Invalid","status_comment"=>$statusCmt),array('ref_table'=>'dispute','ref_id'=>$idu));
				}
				/* End */
			}
			//--R&DDec20
		}
	}

	public function select_dispute_approve($id){
		$sql 	= "SELECT tid,t_hrate from disputes WHERE id={$id}";
		$query 	= $this->db->query($sql);
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
/*
	public function disputes_approve($id,$status ){
		foreach($id as $v){
			$sql = "UPDATE disputes SET approve = '{$status}', p_status = 'paid'  WHERE  id='{$v}'";
			$this->db->query($sql);
		}
		return $id;
	}
	*/
	public function disputes_approve($id,$status,$tdate){
	
		foreach($id as $v){
			$sql = "UPDATE disputes SET PayDate='{$tdate}',approve = '{$status}', p_status = 'paid' WHERE id='{$v}'";
			$this->db->query($sql);
			/* Update Transaction Entry By Ilyas */
			$this->load->model(array('user_model'));
			$result = $this->user_model->fnSelectTransaction("inner_rel_id",array('ref_table'=>'dispute','ref_id'=>$v));
			foreach ($result as $row)
			{
				$this->user_model->fnUpdateTransaction(array("status"=>"Done","status_comment"=>"Done with Payment of Both."),array('id'=>$row->inner_rel_id));
				$this->user_model->fnUpdateTransaction(array("payment_status"=>"Paid","payment_date"=>$tdate,"status"=>"Done","status_comment"=>"Done with Payment of Both.", "summary"=>"Paid to Tutor by admin"),array('ref_table'=>'dispute', 'ref_id'=>$v));
			}
			/* End */
		}
		return $id;
	}
	
	public function updatePayedDisputes($id,$status,$tdate){
		$sql = "UPDATE disputes SET PayDate='{$tdate}',paystatus = 1,p_status = 'paid', p_ack = '{$status}' WHERE  id={$id}";
		$this->db->query($sql);
		return $id;
	}
	
	public function getTotalreferral($search = ''){
	  $dat = date('Y-m-d');
	 $m = date_parse_from_format("Y-m-d", $dat);
        $month=$m["month"];
		if($search == ''){
			//$sql = "SELECT COUNT(*) as num FROM affiliate where MONTH(createAt)={$month} GROUP BY refid";
		    $sql = "SELECT COUNT(*) as num FROM affiliate where   paid=0 GROUP BY refid";
		}else{
		 
			//$sql = "SELECT COUNT(*) as num FROM affiliate as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid  AND ( u.email like '{$search}' OR u.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' )";
		   // $sql = "SELECT COUNT(*) as num FROM affiliate as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid and d.refid = u.id and MONTH(createAt)={$month}  AND ( u.email like '%{$search}%' OR u.id like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' ) GROUP BY d.refid";
		    $sql = "SELECT COUNT(*) as num FROM affiliate as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid and d.refid = u.id and  paid=0   AND ( u.email like '%{$search}%' OR u.id like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' ) GROUP BY d.refid";
		
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		return $result;
	}
	
	public function getAllreferral($start,$search = '',$limit,$sortorder,$sort) {
		$dat = date('Y-m-d');
		$m = date_parse_from_format("Y-m-d", $dat);
        $month=$m["month"];
	
		if($sort =="id")
		{
			$sort= "affiliate.id";
		}
		else if($sort =="name")
		{
			$sort= "profile.firstName";
		}
		
		else if($sort =="type")
		{
			$sort= "type";
		}
		
		else if($sort =="total")
		{
			$sort= "amount";
		}
		else if($sort =="mode")
		{
			$sort= "profile.payment_type";
		}
		else if($sort =="pdate")
		{
			$sort= "affiliate.paid_date";
		}
		else if($sort =="paid")
		{
			$sort= "affiliate.paid";
		}
		else
		{	
			$sort= "refid";
		}

		if($search == ''){
		    $sql = "SELECT affiliate.id,affiliate.PaidAmount,affiliate.paid_date,affiliate.paid,affiliate.paid_date,profile.payment_type,profile.firstName,refid,sid,sum(amount)as amount,type,createAt from affiliate left join profile on profile.uid=affiliate.refid where amount > 0 AND refid != 0 GROUP BY affiliate.id order by {$sort} {$sortorder}";
		}else{
			$sql = "SELECT affiliate.id,affiliate.PaidAmount,affiliate.paid_date,affiliate.paid,affiliate.paid_date,profile.payment_type,profile.firstName,refid,sid,sum(amount)as amount,type,createAt from affiliate left join profile on profile.uid=affiliate.refid where amount > 0 AND refid != 0 and (affiliate.id like '%{$search}%' OR profile.payment_type like '%{$search}%' OR amount like '%{$search}%' OR profile.email like '%{$search}%' OR profile.firstName like '%{$search}%' OR profile.lastName like '%{$search}%')  GROUP BY affiliate.id order by {$sort} {$sortorder}";
		}

		$query 	= $this->db->query($sql);
		 
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		 
		return $result;	
	}
	public function getAllschool($start,$search = '',$limit,$sortorder,$sort) {
	    
		if($search == ''){
			$sql = "SELECT  * ,count(tid) as tsession,sum(s_markup) as tpayment  from disputes where School_id > 0 AND is_completed=1  GROUP BY School_id order by School_id {$sortorder} ";
			//$sql ="SELECT user.*,user.id as myid,disputes.*,count(tid) as tsession,sum(s_markup) as tpayment FROM `disputes` RIGHT JOIN user ON user.id = disputes.School_id WHERE roleid =4 GROUP BY user.id  order by user.id {$sortorder}";
		}else{
			$sql = "SELECT  * ,count(tid) as tsession,sum(s_markup) as tpayment  from disputes where School_id > 0 AND is_completed=1 and  MONTH(disputes.createAt)={$search} GROUP BY School_id  order by School_id {$sortorder}";
			//$sql ="SELECT user.*,user.id as myid,disputes.*,count(tid) as tsession,sum(s_markup) as tpayment FROM `disputes` RIGHT JOIN user ON user.id = disputes.School_id WHERE roleid =4  and  MONTH(disputes.createAt)={$search} GROUP BY user.id  order by School_id {$sortorder}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;	
	}
	public function GetSchoolForSearch($start,$search = '',$limit,$sortorder,$sort) {
	  //$sql = "SELECT  disputes.* ,count(disputes.tid)as tsession,sum(s_markup) as tpayment  from disputes   join profile on profile.uid = disputes.School_id  where disputes.School_id > 0 AND is_completed=1 and (disputes.School_id like '%{$search}%' or profile.firstName like '%{$search}%' or profile.lastName like '%{$search}%')  GROUP BY disputes.School_id";
		$sql ="SELECT user.*,user.id as myid,disputes.*,count(tid) as tsession,sum(s_markup) as tpayment FROM `disputes` RIGHT JOIN user ON user.id = disputes.School_id  left join profile on profile.uid=user.id WHERE roleid =4     AND(user.id like '%{$search}%' or profile.firstName like '%{$search}%' or profile.lastName like '%{$search}%')  GROUP BY user.id";
		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;	
	}
	
		
	
		public function getAllaffi($start,$search = '',$limit,$sortorder,$sort) {
		if($sort =="id")
		{
			$sort="profile.uid";
		}
		else
		{
			$sort="profile.firstName";
		}	
		if($search == ''){
			$sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 GROUP BY profile.uid order by {$sort} {$sortorder}";
		}else{
			$sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 and (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstName like '{$search}' OR profile.lastName like '{$search}') GROUP BY profile.uid order by {$sort} {$sortorder}";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;	
	}
	
	public function getAllaffiDate($start,$search = '',$limit,$sortorder,$sort) {
	if($sort =="id")
		{
			$sort="profile.uid";
		}
		else
		{
			$sort="profile.firstName";
		}
		
	   $sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 and MONTH(user.add_time)={$search} GROUP BY profile.uid order by {$sort} {$sortorder}";
		
		$query 	= $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;	
	}
	
	public function cancel_disputes($cid){		
		$sql = "DELETE FROM disputes WHERE cid='{$cid}'";
		$this->db->query($sql);
		
		/* Update Transaction Entry By Ilyas */
		$this->load->model(array('user_model'));
		$result = $this->user_model->fnSelectTransaction("id",array('ref_table'=>'class','ref_id'=>$cid));
		foreach ($result as $row)
		{
			$nw = date("Y-m-d H:i:s");
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"Refund","payment_date"=>$nw,"status"=>"Canceled","status_comment"=>"Vee Session Canceled from Class Room"),array('ref_table'=>'class','ref_id'=>$cid));
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"None","payment_date"=>$nw,"status"=>"Canceled","status_comment"=>"Vee Session Canceled from Class Room"),array('inner_rel_id'=>$row->id));
		}
		/* End */
	}
	
	public function clear_tutor_payment_approve($tid,$hrate) {		
		$uid = $tid;
		$feeSql = "update profile set money=money+{$hrate} , frMoney=frMoney-{$hrate} where uid={$uid}";
		$query = $this->db->query($feeSql);
	}
	
	public function GetUncompleteSession($start,$search = '',$limit,$sortorder,$sort,$dsearch) {
		
		 
		if($sort=="id")
		{
			$sort="c.id";
		}
		if($sort=="Date")
		{
			$sort="startTime";
		}
		if($sort=="sname")
		{
			$sort="p.firstName";
		}
		if($sort=="email")
		{
			$sort="p.email";
		} 
		if($sort=='tname')
		{
			$sort="p.firstName";
		}
		 
				if($dsearch=='')
				{	
					$cdate=date('Y/m');
					$cdate=explode("/",$cdate);
					$mon=$cdate[1];
					$year=$cdate[0];
				}
				else
				{
					$a=explode("/",$dsearch);
					$mon=$a[0];
					$year=$a[1];
				}
				if($search=='')	
				{	
					$sql = "SELECT  c.*, p.firstName,p.email from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and s_attend=0 OR (session_type = 'free' and s_attend = 0) group by c.id  order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
				}
				else
				{
						$sql = "SELECT  c.*, p.firstName,p.email from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and s_attend=0 OR (session_type = 'free' and s_attend = 0) and (c.id like '{$search}' OR p.uid like '{$search}' OR p.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%')group by c.id  order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
				}
		$query 	= $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			 
		}
		 
		return $result;
	}
	
	public function GetTotalAttemptedSession($search,$dsearch){
	 $result = 0;
		if($dsearch=='')
				{	
					$cdate=date('Y/m');
					$cdate=explode("/",$cdate);
					$mon=$cdate[1];
					$year=$cdate[0];
				}
				else
				{
					$a=explode("/",$dsearch);
					$mon=$a[0];
					$year=$a[1];
				}
				if($search=='')	
				{	
					//$sql = "select count(c.id)as num from class as c,profile as p  where (c.sid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and (s_attend=0 OR session_type = 'free')";
					$sql = "select count(DISTINCT c.`id` )as num from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and (s_attend=0 OR session_type = 'free')";
				}
				else
				{
					//$sql = "SELECT count(c.id) as num from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and  s_attend=0  OR session_type = 'free' and (c.id like '{$search}' OR p.uid like '{$search}' OR p.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%')";
					$sql = "SELECT count(DISTINCT c.`id`) as num from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and MONTH(c.createAt)='{$mon}' and YEAR(c.createAt)='{$year}' and  (s_attend=0  OR session_type = 'free') and (c.id like '{$search}' OR p.uid like '{$search}' OR p.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%')";
				}
 
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		 
		 
		return $result;
	}
	
	public function GetUncompleteSessionCSV($sortorder,$sort) {
		
		//$sql = "SELECT distinct c.*, p.firstName,p.email from class as c,profile as p  where (c.sid = p.uid  or c.tid = p.uid) and s_attend=0 order by {$sort} {$sortorder}";
		//$sql = "SELECT  c.*, p.firstName,p.email from class as c,profile as p  where (c.sid = p.uid) and s_attend=0 order by {$sort} {$sortorder} ";
		$sql = "SELECT  c.*, p.firstName,p.email from class as c,profile as p  where (c.sid = p.uid or c.tid = p.uid) and (s_attend=0 OR session_type = 'free') group by c.id  order by {$sort} {$sortorder}";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetSessionoftutor($sid,$dsearch)
	{
		
		if($dsearch !='')
		{
				$dt=explode('/',$dsearch);
				$mon=$dt[0];
				$yr=$dt[1];
		}
		else
		{
				$date=date('Y/m');
				$dt=explode('/',$date);
				
				$mon=$dt[1];
				$yr=$dt[0];
		}
		$result='0';
		$sql = "SELECT  * ,count(tid) as tsession,sum(s_markup) as tpayment  from disputes where MONTH(createAt)='{$mon}' AND YEAR(createAt) ='{$yr}' AND School_id = '{$sid}' AND is_completed=1 AND schoolPaid=0 GROUP BY School_id order by School_id {$sortorder} ";
		$query 	= $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		 
		 return $result;
	}
	
	public function GetAffiStudent($schoolId,$dsearch)
	{ 
		
		if($dsearch !='')
		{
				$dt=explode('/',$dsearch);
				$mon=$dt[0];
				$yr=$dt[1];
		}
		else
		{
				$date=date('Y/m');
				$dt=explode('/',$date);
				
				$mon=$dt[1];
				$yr=$dt[0];
		}
		$result='0';
		$sql = "SELECT sum(purchaseamount) as spayment from  affiliate where refid='{$schoolId}' AND MONTH(createAt)='{$mon}' AND YEAR(createAt) ='{$yr}' and is_paid=0";
		$query 	= $this->db->query($sql);
		 
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$result['spayment']=$result['spayment']*0.05;
		}
		 
		return $result;
		
	}
	
	public function GetAppfiSession($schoolId,$dsearch)
	{
		if($dsearch !='')
		{
				$dt=explode('/',$dsearch);
				$mon=$dt[0];
				$yr=$dt[1];
		}
		else
		{
				$date=date('Y/m');
				$dt=explode('/',$date);
				
				$mon=$dt[1];
				$yr=$dt[0];
		}
		$result='0';
		$sql = "SELECT  count(disputes.sid) as ssession from user LEFT JOIN disputes on disputes.sid=user.id where   MONTH(createAt)='{$mon}' AND YEAR(createAt) ='{$yr}' AND user.refid='{$schoolId}' and user.roleId=0 and  	disputes.is_completed=1";
		$query 	= $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		 return $result;
	}
	
	public function getTotalDisputesVideo($search = ''){
		if($search == ''){
			$sql = "SELECT COUNT(*) as num FROM disputes where `type` = 'Video'";
		}else{
			$sql = "SELECT COUNT(*) as num FROM disputes as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid AND d.`type`='Video' AND ( u.email like '{$search}' OR u.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' )";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		//echo $this->db->last_query();die;
		return $result;
	}
	
	public function getAllVideo($start,$search = '',$limit,$sortorder,$sort) {	
		 if ($search == '') {
			//$sql = "SELECT disputes.*,class.action  from disputes left join class on disputes.cid=class.id where is_completed=1   order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
			$sql = "SELECT * from `disputes` where `type`='Video' order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}else{
			//$sql = "SELECT distinct d.createAt,d.id, d.*,class.action from disputes as d , user as u,profile as p,class  WHERE d.is_completed=1   AND class.id=d.cid AND(d.sid = u.id  or d.tid = u.id) and (d.sid = p.uid  or d.tid = p.uid) and (d.id like '{$search}' OR u.id like '{$search}' OR u.email like '%{$search}%' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
			$sql = "SELECT d.* from `disputes` as d, user as u, profile as p WHERE d.`type` = 'Video' AND (d.sid = u.id) and (u.id = p.uid) and (d.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' OR CONCAT(firstName, ' ', lastName) LIKE '%{$search}%') group by d.`id` order by {$sort} {$sortorder} LIMIT {$start}, {$limit} ";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function updatepaywallMoney($payinfo){
		$uid 	= $payinfo['uid'];
		$money = $payinfo['money'];
		$sql 	= "SELECT money from profile WHERE uid = '{$uid}'";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result 	= $query->row_array();
			@$result1 	= @$result['money'] + $money;
			$sql 		= "UPDATE profile SET money = '{$result1}' WHERE uid = '{$uid}'";
			$query 		= $this->db->query($sql);
			
			/* Update Transaction Entry By Ilyas */
			$nw = date("Y-m-d H:i:s");
			$this->load->model(array('user_model'));
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"Paid","payment_date"=>$nw,"Summary"=>"Amount Updated to User($uid) Account.","status"=>"Done"),array('status_comment'=>$payinfo['token']));
			/* End */
		}
	}
	
	
	public function deductpaywallMoney($payinfo){
		$uid 	= $payinfo['uid'];
		$money 	= $payinfo['money'];
		$sql 	= "SELECT money from profile WHERE uid = '{$uid}'";
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result 	= $query->row_array();
			@$result1 	= @$result['money'] + $money;
			$sql 		= "UPDATE profile SET money = '{$result1}' WHERE uid = '{$uid}'";
			$query 		= $this->db->query($sql);
			
			/* Update Transaction Entry By Ilyas */
			$nw = date("Y-m-d H:i:s");
			$this->load->model(array('user_model'));
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"Refund","payment_date"=>$nw,"Summary"=>"Amount Deducted from User($uid) Account.","status"=>"Done"),array('status_comment'=>$payinfo['token']));
			/* End */
		}
	}
}
/* End of file pay_model.php */
/* Location: ./application/model/pay_model.php */