<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends TL_Model{
	var $config = array();
	var $loc    = NULL;
	public function __construct(){
		parent::__construct();
		$this->config 	= $this->getConfig();
		$this->loc 		= $this->geolocater->getlocation();
	}
	/**
	 * add new profile into the table
	 * @param  $profileInfo
	 */
	public function save($profileInfo){
	  
		$fieldSql = 'SHOW FIELDS FROM profile';
		$query = $this->db->query($fieldSql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
		$profileAttr = array();
		foreach($result as $k=>$v){
			if( isset($profileInfo[$v['Field']]) ){
				$profileAttr[$v['Field']] = $profileInfo[$v['Field']];
			}
		}
		$this->db->query($this->db->insert_string('profile',$profileAttr));
		return  $this->db->insert_id();
	}
	public function updateMoney($profileInfo){
		return $this->db->query($this->db->update_string('profile',$profileInfo,"uid={$profileInfo['uid']}"));
	}
	/**
	 * update profile
	 * @param  $profileInfo
	 */
	public function update($profileInfo){
	    
		unset($profileInfo['submit']);
		unset($profileInfo['universal_roleId']);
	
		 return $this->db->query($this->db->update_string('profile',$profileInfo,"uid={$profileInfo['uid']}"));
	}
	
	public function update_profile($profileInfo){
	   
	 
	  //$data=json_decode($profileInfo);
	  
      $personal=trim($profileInfo[skill][0]['desc']);
	  $educational=trim($profileInfo[skill][1]['desc']);
	  $professional=trim($profileInfo[skill][2]['desc']);
	  
	  $a= "I went to school at..."; 
	  if($a==$educational)
	  {
	   $educational='';
	  }
	  $b="I have worked at...";
	  if($b==$professional)
	  {
		$professional='';
	  }
		//$personal=str_replace("'", "", $personal);
		$pattern = "/\"/";
		$replace = "";
		$personal = preg_replace($pattern,$replace,$personal); 
	    $personal = addslashes($personal);
           
	  // $personal = preg_replace( '/<br>/i', "\n", $personal);  
	  
	  
		//$educational=str_replace("'", "", $educational);
		$pattern = "/\"/";
		$replace = "";
		$educational = preg_replace($pattern,$replace,$educational); 
		$educational = addslashes($educational);
		
		//$professional=str_replace("'", "", $professional);
		$pattern = "/\"/";
		$replace = "";
		$professional = preg_replace($pattern,$replace,$professional);
		$professional = addslashes($professional);
	  
	  //$personal=str_replace("<br />", "\k", $personal);
	  
	  
     $uid=$profileInfo['uid'];
		$sql = "UPDATE profile set personal='".$personal."',professional='".$professional."',academic='".$educational."' where uid = {$uid}";
        if($personal !='' && $educational !='' && $professional != '')
		{
				$sqry="update profile set BioGraphy=1 where uid='{$uid}'";
				$this->db->query($sqry);
		}
		//unset($profileInfo['submit']);
		return $this->db->query($sql);
		 //return $this->db->query($this->db->update_string('profile',$profileInfo,"uid={$profileInfo['uid']}"));
	}
	
	public function updateProfileImage($pic,$uid){
		$sql = "UPDATE profile set pic='{$pic}' where uid = {$uid}";
		return $this->db->query($sql);
	}
	public function updateProfileVideo($vedio,$uid){
		$sql = "UPDATE profile set vedio='{$vedio}' where uid = {$uid}";
		return $this->db->query($sql);
	}
	/**
	 * get user profile info
	 * @param $uid
	 */
	public function getProfile($uid){
        
		$result = array();
		$sql = "select * from profile where uid=? limit 1";
                $query = $this->db->query($sql,array($uid));
                if ($query->num_rows() > 0){
                    $result = $query->row_array();

                }
                //echo $uid;die('uid');
                $avgRate = $this->getAvgRating($uid);
                $result['avgRate'] 	= $avgRate;
                $result['money'] 	=$this->USD2RBM( $result['money'] );

                return $result;
	}
        public function getProfilenew($uid,$profiletype)
        {
            $result = array();
            $sql = "select * from profile where uid=? limit 1";
            $query = $this->db->query($sql,array($uid));
            if ($query->num_rows() > 0){
                $result = $query->row_array();

            }
            //echo $uid;die('uid');
            $avgRate = $this->getAvgRating($uid);
            $result['avgRate'] 	= $avgRate;
            $result['money'] 	=$this->USD2RBM( $result['money'] );
            //echo $result["hRate"];
            if ($profiletype != "0")
            {/*
				//echo "here";die();
                $q = "select * from profile where uid = (select school_id from profile where uid=".$uid.") limit 1";
                //echo $q;
                $queryschool = $this->db->query($q);
                if ($queryschool->num_rows() > 0)
                {
                    $resultschool = $queryschool->row_array();
					echo "<pre>";print_r($resultschool);die();
					//echo  $resultschool["hRate"];
					//die();
                    $result["hRate"] = $resultschool["hRate"];
                }*/
				$hrate=0;
				$tmarkup=0;
				$sql="select hRate,email from profile where uid={$uid}";
				$queryschool = $this->db->query($sql);
                if ($queryschool->num_rows() > 0)
                {
                    $resultschool = $queryschool->row_array();
					$hrate = $resultschool['hRate'];
					$temail = $resultschool['email'];
				}
				$q = "select tutor_markup,email from profile where uid = (select school_id from profile where uid=".$uid.") limit 1";
                $queryschool = $this->db->query($q);
                if ($queryschool->num_rows() > 0)
                {
					$resultschool1 = $queryschool->row_array();
					$tmarkup = $resultschool1["tutor_markup"];
					$temail = $resultschool1["email"];
                }
				$result["hRate"]=$tmarkup+$hrate;
				$result["email"]=$temail;
            }
            
            return $result;
	}
	public function getAllProfile(){
		$result = array();
		$sql = "select sum(last_toiec_score) as totalLastToiecScore, sum(last_toefl_score) as totalLastToeflScore, sum(last_oplc_score) as totalLastOpicScore, sum(current_tolec_score) as totalCurrentToiecScore, sum(current_toefl_score) as totalCurrentToeflScore, sum(current_oplc_score) as totalCurrentOpicSCore  from profile";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
	}
	public function getAllCountProfile(){
		$result = array();
		$sql = "SELECT COUNT(last_toiec_score) as countLastToiecScore , COUNT(last_toefl_score) as countLastToeflScore, COUNT(last_oplc_score)  as countLastOpicScore, COUNT(current_tolec_score) as countCurrentToiecScore, COUNT(current_toefl_score) as countCurrentToeflScore, COUNT(current_oplc_score) as countCurrentOpicScore
FROM  `profile` 
WHERE  `last_toiec_score` !=  ''
OR  `last_toefl_score` !=  ''
OR  `last_oplc_score` !=  ''
OR  `current_tolec_score` !=  ''
OR  `current_toefl_score` !=  ''
OR  `current_oplc_score` !=  ''";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            $result = $query->row_array();
        }
        return $result;
	}
	/**
	 * getcriteria
	 * @param $uid
	 * @auther TECHNO-MAYA
	 */
	public function getcriteria($uid){
	
		$result = array();
		$sql = "select * from profile  where uid=? limit 1";
        $query = $this->db->query($sql,array($uid));
        if ($query->num_rows() > 0){
            $chart_data = $query->row_array();
        }
		$sql = "";
		$sql .= "SELECT p.*,c.country,pr.provice FROM `profile` as p ,user as u,countries as c,provices AS pr  WHERE ( ";
		if(isset($chart_data['country']) && $chart_data['country'] != ''){
			$sql .= "  p.`country` = {$chart_data['country']} OR ";
		}
		if(isset($chart_data['city']) && $chart_data['city'] != ''){
			$sql .= "p.`city` LIKE '%{$chart_data['city']}%'  OR ";
		}
		if(isset($chart_data['gender']) && $chart_data['gender'] != ''){
			$sql .= "p.`gender` = {$chart_data['gender']} OR ";
		}
		if(isset($chart_data['province']) && $chart_data['province'] != ''){
			$sql .= "p.`province` = {$chart_data['province']} OR ";
		}
		if(isset($chart_data['interests']) && $chart_data['interests'] != ''){
			$sql .= "p.`interests` LIKE '".str_replace("'","",$chart_data['interests'])."' OR ";
		}
		if(isset($chart_data['hRate']) && $chart_data['hRate'] != ''){
			$sql .= "p.`hRate` LIKE '%{$chart_data['hRate']}%' )";
		}
		$sql .= " AND p.country=c.id AND p.province=pr.id AND u.quarantine = '0' AND p.uid = u.id ";
		$sql .= " AND u.roleId IN (1,2,3)  ORDER BY RAND() DESC LIMIT 0 , 20";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result;
		}
	}
	/**
	* @author TECHNO-SANJAY
	* @package get tutors profile data
	* @date 10 may 2013
	**/
	public function getTutorProfile($uid){
		$result = array();
		//$sql = "select p.uid,p.firstName,p.lastName,p.hRate,p.pic,p.city,c.country,pr.provice from profile AS p JOIN countries as c JOIN  provices AS pr where p.country=c.id AND  p.province=pr.id   AND p.uid=$uid limit 1";
	 //$sql = "select p.uid,p.firstName,p.lastName,p.hRate,p.pic,p.city,c.country,pr.provice,u.readytotalk from profile AS p JOIN countries as c JOIN user as u JOIN  provices AS pr where p.uid=$uid and u.id=$uid  limit 1";		
        //$sql = "select p.uid,p.firstName,p.lastName,p.hRate,p.pic,p.city,c.country,p.province,pr.provice,u.readytotalk from profile AS p JOIN countries as c JOIN user as u JOIN  provices AS pr where p.country=c.id AND  p.uid=$uid and u.id=$uid  limit 1";
		
		$setPrfHrate = ", `profile`.`hRate` "; 
		if ($this->session->userdata('uid')) {
			$this->load->model('user_model');
			$resFree = $this->user_model->fnGetUser("is_eligible",array("id"=>$this->session->userdata('uid')));
			if ($resFree[0]['is_eligible']=="1") {
				$setPrfHrate = ", '0.00' as `hRate` ";
			}
		}
		$sql = "SELECT profile.uid,profile.firstName,profile.lastName,profile.school_id,profile.pic,profile.city,profile.nativeLanguage,profile.otherLanguage,countries.country ,provices.provice,user.readytotalk,user.fbshare $setPrfHrate from profile INNER JOIN user ON  user.id=profile.uid  INNER JOIN countries ON countries.id = profile.country INNER JOIN provices on provices.id = profile.province WHERE profile.uid={$uid} limit 1";
		$query = $this->db->query($sql,array($uid));

        if ($query->num_rows() > 0){
            $result = $query->row_array();
			
        }
		/*$provinceid = $result['province'];
		$province = $this->getProvince($provinceid);
		$result['provice'] = $province['0']['provice'];*/
		$avgRate = $this->getAvgRating($uid);
		$result['avgRate'] = $avgRate;
		$online = $this->checkOnline($uid);
		$result['online'] = $online;
        return $result;
	}
	public function getProvince($id){
		$sql = "select provice from provices where id = {$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return  $result;
	}
	public function getProfileJoin($uid){
		$result = array();
		$sql = "SELECT profile.*,countries.country as countryName , provices.provice as stateName from profile INNER JOIN countries ON countries.id = profile.country INNER JOIN provices on provices.id = profile.province WHERE uid=? limit 1";
        $query = $this->db->query($sql,array($uid));
        if ($query->num_rows() > 0){
            $result = $query->row_array();
        }
		/*print_r($result);
		exit;*/
		$avgRate = $this->getAvgRating($uid);
		$result['avgRate'] = $avgRate;
        return $result;
	}
	public function getRatings($id,$start=0,$length=8){
		$sql = "SELECT feedback.*,profile.firstName,profile.lastName,profile.pic FROM feedback INNER JOIN profile ON profile.uid=feedback.receiverId WHERE callerId={$id} AND feedback.status = 1 ORDER BY feedback.id desc limit {$start},{$length}";
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	public function sessionCount($id,$start=0,$length=8){
		$sql = "SELECT COUNT(feedback.id) as counts FROM feedback   WHERE callerId={$id} AND status = 1 ";
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result['counts'];
	}
	public function getAvgRating($id){
		$sql = "select * from feedback where callerId={$id} AND status = 1";
		 //$sql = "select * from feedback where status = 1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		$rateTotal = 0;
		//echo '<pre>';print_r($result);die;
		foreach($result as $k=>$v){
			$rateTotal += $v['onTime'] + $v['clearReception'];
		}
		$total = count($result);
		
		if($total == 0){
			return 0;
		}else{
			return intval($rateTotal/($total*2));			
		}
        return $result;
	}
	public function getProfileByKeyword($keyword){
		$result = array();
		//$sql = "select p.uid,p.firstName,p.lastName,p.pic,u.email from profile as p , user as u where p.uid = u.id AND ( p.firstName like '{$keyword}%'   or p.uid = '{$keyword}') order by p.firstName asc limit 0,10";
       $sql = "select p.uid,p.firstName,p.lastName,p.pic,u.email from profile as p , user as u where p.uid = u.id AND ( p.firstName like '{$keyword}%'   or p.uid = '{$keyword}' or  CONCAT(p.firstName ,p.uid) LIKE '{$keyword}%') order by p.firstName asc limit 0,10";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->result_array();
        } 
		 
		return @$result;
	}
	public function updateFreeSession($uid){
		//$sql = "update user set free_session = 'y',user_firsttime = 'y' WHERE id={$uid} ";
		$sql = "update user set free_session = 'y' WHERE id={$uid} ";
		$query = $this->db->query($sql);
		$sql1 = "update profile set free_session = 'y' WHERE uid={$uid} ";
		$query = $this->db->query($sql1);
	}
	public function revert_profile_image($uid,$img){
		$sql = "update profile set pic = '{$img}' WHERE uid={$uid} ";
		$query = $this->db->query($sql);
	}
	public function getRoleId($uid){
		$result = array();
		$sql = "select roleId from user where id=? limit 1";
		$query = $this->db->query($sql,array($uid));
		if ($query->num_rows() > 0){
			$result = $query->row_array();	
			$result = $result['roleId'];

		}
		
		return $result;
	}
	/**
	R&D@Oct-09-2013 : TTL Credit Conversion STARTS
	**/
	//---Convert USD to TalkList Credit
	public function USD2TTL($USD){
		if( $this->loc == "ch"){
			$TTL = $USD  *  $this->config['USD_TO_TTL']['value'] ;
			return $TTL;
		}else{			
			return $USD; 
		}
	}
	//---Convert RBM to TalkList Credit	
	public function RBM2TTL($RBM){
		if( $this->loc == "ch"){
		$TTL = $RMD  /  $this->config['RBM_TO_TTL']['value'] ;
			return $TTL; 
		}else{
			return $RBM; 
		}
	}
	//---Convert USD to RBM Credit	
	public function USD2RBM($USD){
		if( $this->loc == "ch"){
			//--Convert USD to TTL
			$TTL = $USD  /  $this->config['USD_TO_TTL']['value'] ;
			//--Convert TTL Credits to RBM
			$RBM = $TTL  *  $this->config['RBM_TO_TTL']['value'] ;
			return $RBM;
		}else{
			return $USD;
		}
	}
	//---Convert RBM to USD Credit	
	public function RBM2USD($RBM){
		if( $this->loc == "ch"){
			//--Convert RMD to TTL
			$TTL = $RMD  /  $this->config['RBM_TO_TTL']['value'] ;
			//--Convert TTL Credits to RBM
			$USD = $TTL  *  $this->config['USD_TO_TTL']['value'] ;
			return $USD;
		}else{
			return $RBM; 
		}
	}
	/**
	R&D@Oct-09-2013 : TTL Credit Conversion ENDS
	**/
	//---Set Variables for Credits
	public function upgradeAccount(){
		$upgradeAccount = array(
		'month' => array('month_1' => '1','month_2' => '2','month_3' => '3'),
		'price' => array('price_1' => $this->USD2RBM('30.00'),'price_2' => $this->USD2RBM('50.00'),'price_3' => $this->USD2RBM('70.00'))
		);
		return $upgradeAccount;
	}
	public function buyCredits(){
		$buyCredits = array(
		'credit' => array('credit_1' => '100','credit_2' => '310','credit_3' => '520','credit_4' => '25'),
		'price' => array('price_1' => $this->USD2RBM('100.00'),'price_2' => $this->USD2RBM('300.00'),'price_3' => $this->USD2RBM('500.00'),'price_4' => $this->USD2RBM('30.00'))
		);
		return $buyCredits;
	}
	
	
	public function getUserExpDate($uid){
		$sql   = "SELECT expDate FROM pay WHERE uid={$uid} order by id DESC LIMIT 0,1";
		$query = $this->db->query($sql);		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	
	public function getcriteriasearch($uid){
	 
		$result = array();
		$sql = "select * from profile  where uid=? limit 1 ";
        $query = $this->db->query($sql,array($uid));
        if ($query->num_rows() > 0){
            $chart_data = $query->row_array();
        }
		$sql = "";
		$sql .= "SELECT p.*,c.country,pr.provice FROM `profile` as p ,user as u,countries as c,provices AS pr  WHERE ( ";
		if(isset($chart_data['country']) && $chart_data['country'] != ''){
			$sql .= "  p.`country` = {$chart_data['country']} OR ";
		}
		if(isset($chart_data['city']) && $chart_data['city'] != ''){
			$sql .= "p.`city` LIKE '%{$chart_data['city']}%'  OR ";
		}
		if(isset($chart_data['gender']) && $chart_data['gender'] != ''){
			$sql .= "p.`gender` = {$chart_data['gender']} OR ";
		}
		if(isset($chart_data['province']) && $chart_data['province'] != ''){
			$sql .= "p.`province` = {$chart_data['province']} OR ";
		}
		if(isset($chart_data['interests']) && $chart_data['interests'] != ''){
			$sql .= "p.`interests` LIKE '".str_replace("'","",$chart_data['interests'])."' OR ";
		}
		if(isset($chart_data['hRate']) && $chart_data['hRate'] != ''){
			$sql .= "p.`hRate` LIKE '%{$chart_data['hRate']}%' )";
		}
		$sql .= " AND p.country=c.id AND p.province=pr.id AND u.hiddenRole = '0' AND u.quarantine = '0' AND p.uid = u.id ";
		$sql .= " AND u.roleId IN (1,2)  ORDER BY RAND() DESC LIMIT 0 , 20 ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result;
		}
	}
	
	public function checkOnline($uid){
		$sql = "select DISTINCT uid from ci_sessions where uid = {$uid}";
		$query = $this->db->query($sql);
		$found = 0;
		if ($query->num_rows() > 0) {
			$found = 1;
		}
		return $found;
	}
	
	//added by haren to get fname and lanem of user
	
	public function getUserName($sid,$tid){
		$sql = "select p.firstName,p.lastName,p.uid from profile p  where uid={$sid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result;
		}
	}

	// function added by haren to get auto-tutor
	
	public function get_Auto_School($keyword)
	{
		$result = array();
		//$sql = "select distinct p.uid,p.firstName,p.lastName,p.pic from profile as p , user as u where p.uid = u.id AND u.roleId=4 AND ( p.firstName like '%{$keyword}%' or p.lastName like '%{$keyword}%' ) GROUP BY p.uid order by p.firstName asc limit 0,4";
		$sql = "select distinct p.uid,p.firstName,p.lastName,p.pic from profile as p , user as u where p.uid = u.id AND u.roleId=4 AND ( p.firstName like '{$keyword}%' ) GROUP BY p.uid order by p.firstName asc limit 0,4";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
		{
            $result = $query->result_array();
        }
		return @$result;
	}
	
	public function getTotalschool($search = ''){
	 
		if($search == ''){
			//$sql = "SELECT COUNT(*) as num FROM user  WHERE `roleId`=4 ";
			$sql = "select COUNT(*) as num from profile   where profile.`uid`in(
SELECT `id` FROM `user` WHERE `roleId`=4
)  ";
		}else{
			//$sql = "SELECT COUNT(*) as num FROM affiliate as d,user as u,profile as p where u.id = d.sid AND p.uid = d.sid  AND ( u.email like '{$search}' OR u.id like '{$search}' OR p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' )";
		    $sql = "select COUNT(*) as num from profile   where profile.`uid`in(
SELECT `id` FROM `user` WHERE `roleId`=4
) AND ( profile.email like '%{$search}%'  OR profile.firstName like '%{$search}%'   ) ";
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
	
	public function getAllschool($start,$search = '',$limit,$sortorder,$sort) {
	//echo $search; die();
		if($search == ''){
			$sql = "select profile.firstName,profile.uid,profile.email from profile   where profile.`uid`in(
SELECT `id` FROM `user` WHERE `roleId`=4
) order by {$sort} {$sortorder}  LIMIT {$start}, {$limit} ";
		}else{
			//$sql = "SELECT d.* from affiliate as d,user as u,profile as p WHERE d.sid = u.id and d.sid = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstName like '{$search}' OR p.lastName like '{$search}') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		     //$sql = "SELECT d.* from affiliate as d,user as u,profile as p WHERE d.sid = u.id and d.sid = p.uid and d.refid = u.id  and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstName like '{$search}' OR p.lastName like '{$search}') order by {$sort} {$sortorder} LIMIT {$start}, {$limit}";
		$sql = "select profile.firstName,profile.uid,profile.email from profile   where profile.`uid`in(
SELECT `id` FROM `user` WHERE `roleId`=4
) AND ( profile.email like '%{$search}%'  OR profile.firstName like '%{$search}%'   ) ";
		}
		$query 	= $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;	
	}
	
	public function  gettutor($schoolid)
	{
	 
	$sql = "SELECT count(school_id) as total  FROM profile WHERE  school_id = {$schoolid}";
	$query 	= $this->db->query($sql);
	$result = $query->result_array();
 
	return $result;	
	}
	
	// added by haren to get school markup
	
	public function GetSchoolMarkup($schoolId)
	{
		
		$sql = "SELECT tutor_markup,pbalance FROM profile WHERE  uid = {$schoolId}";
		$query 	= $this->db->query($sql);
		$result = $query->result_array();
		
		return $result;	
	}
	public function  DelProfile($id)
	{
	
	 $sql="delete from user where id={$id}";
	 $query 	= $this->db->query($sql);
	 $sql="delete from  profile where uid={$id}";
	 $query 	= $this->db->query($sql);
	 return;
	}
	
	public function GetTuorcount($id)
	{
	  $sql="select count(uid) as tut from profile where school_id={$id}";
	  $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		 
		return $result;
	}
	
	public function Getstudentcount($id)
	{
		$sql="select count(id) as stud from user where refid={$id} AND roleId = 0";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	public function Getsessioncount($id)
	{
		$sql="select count(id) as session,sum(s_markup) as actualfee from disputes where school_id={$id} and is_completed=1 and schoolPaid=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	public function GetMarkup($id)
	{
	  $sql="select tutor_markup from profile where uid={$id}";
	  $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	public function getTutorSession($id)
	{
	  $sql="select count(tid) as tsession,count(sid) as ssession,sum(fee) as fees,sum(t_hrate)as TutorIncome,sum(s_markup) as schoolIncome from class where school_id={$id} and s_attend=1 and is_private=0";
	  $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	
	public function getTutorRates($id)
	{
	  $sql="select hRate from profile where uid={$id}";
	  $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		 
		return $result;
	}
	public function setHidden($id)
	{
	          
			$sql = "UPDATE user set hiddenRole='1' where id = {$id}";
        
			return $this->db->query($sql);
	}
	public function removeHidden($id)
	{
		$sql = "UPDATE user set hiddenRole='0' where id = {$id}";
        
		return $this->db->query($sql);
	}
	public function UpdateProfile($id)
	{
		$sql = "UPDATE profile set cmp_profile='1' where uid = {$id}";
        
		return $this->db->query($sql);
	}
	public function getProfileSearch($uid,$search){
       
		$result = array();
		$sql = "select * from profile where (profile.uid like '%{$search}%' OR profile.email like '%{$search}%' OR profile.firstName like '%{$search}%' OR profile.lastName like '%{$search}%')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->result_array();
			
        }
		
		return $result;
	}
	
	public function updateFsession($id,$type)
	{
		$sql = "UPDATE user set free_session='{$type}' where id = {$id}";
        
		return $this->db->query($sql);
		
		
	}
	public function updateFsessionpro($id,$type)
	{
		$sql = "UPDATE profile set free_session='{$type}' where uid = {$id}";
        
		return $this->db->query($sql);
		
		
	}
	public function getProfileData($uid,$sortorder,$sort){
		
		
		$result = array();
		$sql = "select * from profile where uid=? limit 1";
        $query = $this->db->query($sql,array($uid));
        if ($query->num_rows() > 0){
            $result = $query->row_array();
			
        }
		//echo $uid;die('uid');
		$avgRate = $this->getAvgRating($uid);
		$result['avgRate'] 	= $avgRate;
		$result['money'] 	=$this->USD2RBM( $result['money'] );
		
		return $result;
	}
	public function updateTimezone($tzone,$uid)
	{
		$sql= "update user set timezone='{$tzone}' where id={$uid}";
		return $this->db->query($sql);
	}
	public function GetSchoolAffiliateIncome($uid)
	{
		$result=array();
		$sql="select sum(amount)as samt from affiliate where refid={$uid} and is_paid=1";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->row_array();
			
        }
		return $result;
	}
	public function GetSchoolDuePayment($sid)
	{
		$result=array();
		$sql="select sum(s_markup)as Dueamt from class where is_private=0 and s_attend=1 and is_paid=0 and school_id={$sid}";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->row_array();
        }
		return $result;	
	}
	
	public function CheckIsonline($id)
	{
		$result=array();
		$sql="select readytotalk from user  where id={$id}";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->row_array();
			
        }
		return $result;
	}
	
	//haren to check is school tutor or not 
	
	public function CheckIsSchoolTutor($id)
	{
		$result=array();
		$sql="select school_id from profile  where uid={$id}";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $result = $query->row_array();
			
        }
		return $result;
	}
	
	public function GetAllSchoolStu($uid)
	{
		$result = array();
		$sql = "select user.id , profile.firstName, profile.lastName from user left join profile on user.id=profile.uid  where user.refid={$uid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getStudentPurchase($id)
	{
		$sql="select  sum(amount) as total from affiliate where sid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		 
		return $result;
	}
	
	public function GetHiddenRole($uid){
		/*
		$sql = "select hiddenRole from user WHERE id={$uid}";
		$query = $this->db->query($sql);
		$rs = '';
		if ($query->num_rows() > 0){
            $result = $query->result_array();
			$rs  = $result[0]['hiddenRole'];
        }
		return $rs;
		*/
		$result = array();
		$sql = "select hiddenRole from user where id=? limit 1";
		$query = $this->db->query($sql,array($uid));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
			$result = $result['hiddenRole'];
		}
		
		return $result;
	}
	
	public function GroupRating($id,$start=0,$length=8){
		$sql = "SELECT groupfeedback.*,profile.firstName,profile.lastName,profile.pic FROM groupfeedback INNER JOIN profile ON profile.uid=groupfeedback.receiverId WHERE callerId={$id} ORDER BY groupfeedback.groupFeedback_id desc limit {$start},{$length}";
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GroupsessionCount($id,$start=0,$length=8){
		$sql = "SELECT COUNT(groupfeedback.groupFeedback_id) as counts FROM groupfeedback   WHERE callerId={$id} ";
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result['counts'];
	}
	
	public function GetGroupRating($id){
		
		 $sql = "select * from groupfeedback";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
		$rateTotal = 0;
		 
		foreach($result as $k=>$v){
			$rateTotal += $v['onTime'] + $v['clearReception'];
		}
		$total = count($result);
		if($total == 0){
			return 0;
		}else{
			return round($rateTotal/($total*2)) ;
		}
        return $result;
	}
}   
/* End of file profile_model.php */
/* Location: ./application/model/profile_model.php */