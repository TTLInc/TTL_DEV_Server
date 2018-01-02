<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends TL_Model{

	public function __construct(){
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		if(!$this->useCached){
			$this->cacheTime = 1;
		}
	}
	protected $useCached = true;
	protected $cacheTime = 3000000;
	protected function mkKey($searchData){
		ksort($searchData);
		$str = '';
		$keys = array('langs','hRateStart','hRateEnd','availableTobook','online','gender','country','province','keyword','rating','school');
		foreach($searchData as $k=>$v){
			if(!in_array($k,$keys)){
				continue;
			}
			$str .= $k.'_|_'.$v; 
		}//echo $str;die;
		return md5($str);
	}
	
	
	// Get List of Users by Search Condition
	public function getResult($arCnd=array(), $offset=0, $limit=20)
	{
		$cnd = "";
		// Check Order By
		$orderBy = "`readytotalk` DESC, `user`.`roleId` DESC, `nativeLanguage` ASC ";
		$order = "";			
		if (!empty($arCnd)) {
			if (!empty($arCnd['sort']) and $arCnd['sort'] != "select") {
				$orderBy = $arCnd['sort'];
				if ($orderBy == "avgRate") {
					$order = "DESC";
				} else {
					$order = "ASC";
				}
			}
			
			
			if (isset($arCnd['today']) and (!empty($arCnd['today']))) {
				$startdtfrm = $arCnd['today'].' '.$arCnd['fromTime'];
				$enddtfrm	= $arCnd['today'].' '.$arCnd['toTime'];
				$start		= date('Y-m-d H:i:s',strtotime($startdtfrm));
				$end		= date('Y-m-d H:i:s',strtotime($enddtfrm));
				$start		= date('Y-m-d H:i:s',$this->inTime($start));
				$end		= date('Y-m-d H:i:s',$this->inTime($end));				
				$qryTimeSlot = " JOIN `timeslot` ON  `profile`.`uid` = `timeslot`.`uid` ";
			}
			if (!empty($arCnd['langInput1'])) {
				$cnd .= " and (`profile`.`nativeLanguage` = '".$arCnd['langInput1']."' OR `profile`.`otherLanguage` = '".$arCnd['langInput1']."')";
			}
			if (!empty($arCnd['langInput2'])) {
				$cnd .= " and (`profile`.`otherLanguage` = '".$arCnd['langInput2']."' OR `profile`.`nativeLanguage` = '".$arCnd['langInput2']."') ";
			}
			if (!empty($arCnd['keyword'])) {
				$keywords = explode(' ',trim($arCnd['keyword']));
				$cnd .= " and ( ";
				$i=1;
				foreach($keywords as $key=>$val){
					if($val==''){
						continue;
					}
					if ($i>1) {
						$cnd .= " OR ";
					}
					$cnd .= " `profile`.`academic` LIKE '%".$val."%' ";
					$cnd .= " OR `profile`.`professional` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`personal` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`firstName` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`lastName` LIKE '%".$val."%' ";
					$cnd .= " OR `user`.`username` LIKE '%".$val."%' ";
					$cnd .= " OR `user`.`email` LIKE '%".$val."%' ";
					$cnd .= " OR `profile`.`city` LIKE '%".$val."%' ";	
					$i++;
				}
				$cnd .= " ) ";
			}
			if (($arCnd['gender']!="") and ($arCnd['gender']!="all") ) {
				$cnd .= " and (`profile`.`gender` = '".$arCnd['gender']."') ";
			}
			if (!empty($arCnd['country'])) {
				$cnd .= " and (`profile`.`country` = '".$arCnd['country']."') ";
			}
			if (!empty($arCnd['province'])) {
				$cnd .= " and (`profile`.`province` = '".$arCnd['province']."') ";
			}
			if (!empty($arCnd['sch'])) {
				$cnd .= " and (`profile`.`school_id` = '".$arCnd['sch']."') ";
			}
		}
		$cnd .= " and (`profile`.`pic` != '') and (`profile`.`BioGraphy` != '0') and `quarantine` != '1' and `hiddenRole` = '0'";
		$selectChkFreeSession = "";
		$setPrfHrate = ", `profile`.`hRate` "; 
		if ($this->session->userdata('uid')) {
			
			// Now Display Own Profile in Search
			$cnd .= " and `user`.`id` != '".$this->session->userdata('uid')."'";
			
			
			$this->load->model('user_model');
			$resFree = $this->user_model->fnGetUser("is_eligible",array("id"=>$this->session->userdata('uid')));
			if ($resFree[0]['is_eligible']=="1") {
				$selectChkFreeSession = ", 'Yes' as chkfreesession ";
				$cnd .= " and `user`.`free_session` = 'y' ";
				$setPrfHrate = ", '0.00' as `hRate` ";
			}
		}
		/*$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` $qryTimeSlot LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ";		*/
		$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd ";
		$queryTotal = $this->db->query($sqlTotal);
		$resultTotal = $queryTotal->result_array();
		$result = array();
		$response['totalCount'] = $resultTotal[0]['total'];
		$response['results'] = array();
		if ($response['totalCount'] > 0) { 
			$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`Lat`, `profile`.`Lng` $setPrfHrate, `profile`.`pic`, SUBSTRING(`profile`.`professional`,1,130) as `professional`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city`, `countries`.`country`, `provices`.`provice` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";
			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
				$response['results'] = $this->filterBookedTutors($response['results']);
			}
		}
		return $response;
	}
	
	// If Tutor is Booked then turn Green Icon to Grey Icon from data of tutors.
	public function filterBookedTutors($content=array())
	{
		// Get List of Booked tutor in Current Time
		$cnd = "";
		if($this->session->userdata("uid")){
			$cnd .= " and ((`sid` != '".$this->session->userdata("uid")."') or (`tid` != '".$this->session->userdata("uid")."')) ";
		}
		//$filterBookTutorQry = "SELECT `sid`,`tid` FROM `class` where `Intent`!='2' $cnd and DATE_SUB(now(), INTERVAL '05:25' HOUR_MINUTE) between `startTime` and `endTime` and (`action` NOT LIKE '%tlocked%') order by `id` DESC";
		$filterBookTutorQry = "SELECT `sid`,`tid` FROM `class` where `Intent`!='2' $cnd and (DATE_ADD(now(), INTERVAL '00:05' HOUR_MINUTE) between `startTime` and `endTime`) and (`action` NOT LIKE '%tlocked%') order by `id` DESC";
		$bookTutorQry = $this->db->query($filterBookTutorQry);
		if ($bookTutorQry->num_rows() > 0) {
			foreach($bookTutorQry->result_array() as $bookedTut)
			{
				foreach($content as $key=>$val)
				{
					if($this->session->userdata("uid") and ($val['id']!=$this->session->userdata("uid"))) {
						if(in_array($val['id'],$bookedTut) or in_array($val['tid'],$bookedTut)){
							$content[$key]['readytotalk'] = '0';
						}
					}
				}
			}
		}
		return $content;
	}
	
	public function getTeachers(){
		$sql = "SELECT * FROM user WHERE roleId=2 OR roleId=1 OR roleId=3 ";
		$query = $this->db->query($sql);
		$results = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results['id'][] = $v['id'];
				$results['roleId'][$v['id']] = $v['roleId'];
			}
		}
		return $results;
	}
	public function getOnlineTeacher(){
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		$teachers = $this->getTeachers();
		$sql = "select uid from ci_sessions where uid in (".implode(',',$teachers['id']).")";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results[] = $v['uid'];
			}
		}
		$this->cache->save('onlineTeacher', $results, $this->cacheTime);
		return $results;
	}
	public function CheckMarkup($tid,$sid,$markup)
	{
			//echo $markup;die();
		$stuid=$this->session->userdata['uid'];
		if($stuid > 0)
		{
		$sql="select refid from user where id={$stuid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) 
		{
			$result = $query->row_array();
		}
		$refid=$result['refid'];
		if($refid > 0)
		{
			$sql="select uid from profile where uid={$refid} and pbalance > 0";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) 
			{
				$result = $query->row_array();
			}
			$schid=$result['uid'];
			if($sid == $schid)
			{
				return $result='0';
			}	
			else
			{
				return $result=$markup;
			}
			  
		}
		else
		{
			return $result=$markup;
			
		}
		}
	}
	public function getOnlineUser(){
		if (  !$results = $this->cache->get('onlineUser') ) {
			$sql = "select uid from ci_sessions where uid!=''";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
				foreach($result as $k=>$v){
					$results[] = $v['uid'];
				}
			}
			$this->cache->save('onlineUser', $results, $this->cacheTime);
			return $results;
		}
		else {
			return $results;
		}
	}
	public function getFetureTeachers(){
		 
		$sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , provices.provice ,profile.city,user.roleId,profile.hRate,profile.school_id FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id LEFT JOIN newtutors ON newtutors.uid = profile.uid  WHERE (newtutors.uid = profile.uid OR user.roleId = 3 )   AND user.`hiddenRole` = 0  AND user.`quarantine` =0 order by RAND()";
		$query = $this->db->query($sql);
		$results = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results['uid'][] = $v['uid'];
				$results['result'][$v['uid']] = $v;
				$results['result'][$v['uid']]['lesson_name'] = '';
				$results['result'][$v['uid']]['lesson_desc'] = '';
				$results['result'][$v['uid']]['avgRate'] = $this->getAvgRating($v['uid']);
				$results['result'][$v['uid']]['online'] = $this->checkOnline($v['uid']);
				
				$suid=$this->session->userdata['uid'];
				if($suid=='')
				{
				$results['result'][$v['uid']]['chkfreesession']= $this->chkfreesessionhome_search($v['uid']);
			    }
				
			}
		}
		$this->cache->save('fetureTeachers', $results, 300);
		return $results;
	}
	// free session feature teachers start
	public function getFreeFetureTeachers(){
		//$sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , provices.provice ,profile.city,profile.school_id,user.roleId,profile.hRate FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id WHERE profile.free_session = 'y' AND user.roleId = 2 AND user.`hiddenRole` = 0 order by RAND()";
		$sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , provices.provice ,profile.city,profile.school_id,user.roleId,profile.hRate FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id  LEFT JOIN newtutors ON newtutors.uid = profile.uid WHERE (newtutors.uid = profile.uid OR user.roleId = 3 ) AND profile.free_session = 'y' AND user.roleId = 2 AND user.`hiddenRole` = 0 order by RAND()";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results['uid'][] = $v['uid'];
				$results['result'][$v['uid']] = $v;
				$results['result'][$v['uid']]['lesson_name'] = '';
				$results['result'][$v['uid']]['lesson_desc'] = '';
				$results['result'][$v['uid']]['hRate'] = '0.00';
				$results['result'][$v['uid']]['avgRate'] = $this->getAvgRating($v['uid']);
			
			
			}
		}
		$this->cache->save('freeFetureTeachers', $results, $this->cacheTime);
		return $results;
	}
	public function getAvgRating($id) {
		if (  !$results = $this->cache->get('getAvgRating'.$id) ) {
			$sql = "select * from feedback where callerId={$id} AND status = 1";
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
				$avgRate =  0;
			}else{
				$avgRate =  round($rateTotal/($total*2)) ;
			}
			$this->cache->save('getAvgRating'.$id, $avgRate, $this->cacheTime);
			return $avgRate;
	    }else {
			return $results;
		}
	}
	public function getFetureTeacherLessons(){
		$teachers = $this->getFetureTeachers();
		if(!$teachers['uid']){
			return array();
		
		}
		//print_r($teachers);die();
		$sql = "SELECT `uid`,`name`,`desc` FROM lessons WHERE uid IN (".implode(',',$teachers['uid']).")  ";
		$query = $this->db->query($sql);
		$resultLesson = array();
		/*if ($query->num_rows() > 0) {
			$resultLesson = $query->result_array();				
		}*/
		$resultTeacherTemp = $teachers['result'];
		$resultTeacher  = $teachers['result'];			
		foreach($resultLesson as $k=>$v){
			$resultTeacherTemp[$v['uid']]['lesson_name'] = $v['name'];
			$resultTeacherTemp[$v['uid']]['lesson_desc'] = $v['desc'];
			if(isset( $resultTeacher[ $v['uid'] ]) ){
				unset( $resultTeacher[ $v['uid'] ] );
			}
			//skvirja checks for online users
			$online = $this->checkOnline($v['uid']);
			$resultTeacherTemp[$v['uid']]['online'] = $online;
			
			 $personalprofile = $this->checkpersonalprofile($v['uid']);
			$resultTeacherTemp[$v['uid']]['personal'] = $personalprofile;
			
			
			
			$resultTeacher[] = $resultTeacherTemp[$v['uid']];
		}
		//checks for have session
		if(count($resultTeacher)>0){
			foreach($resultTeacher as $rt)
			{
				$hasSession = $this->hasSession($rt['uid']);
				$resultTeacher[$rt['uid']]['hasSession'] = $hasSession;
				$resultTeacher[$rt['uid']]['readytotalk'] = $this->checkreadytalk($rt['uid']);
				
				
				   
			    
			   $resultTeacher[$rt['uid']]['personal'] = $this->checkpersonalprofile($rt['uid']);
				
			}
		}
		$results = $resultTeacher;
		unset($resultTeacherTemp);
		$this->cache->save('fetureTeacherLessons', $results, $this->cacheTime);
		return $results;
	}
	public function getFreeFetureTeacherLessons(){
		$teachers = $this->getFreeFetureTeachers();
		if(!$teachers['uid']){
			return array();
		}
		$sql = "SELECT `uid`,`name`,`desc` FROM lessons WHERE uid IN (".implode(',',$teachers['uid']).")";
		$query = $this->db->query($sql);
		$resultLesson = array();
		/*if ($query->num_rows() > 0) {
			$resultLesson = $query->result_array();				
		}*/
		$resultTeacherTemp = $teachers['result'];
		$resultTeacher  = $teachers['result'];			
		foreach($resultLesson as $k=>$v){
			$resultTeacherTemp[$v['uid']]['lesson_name'] = $v['name'];
			$resultTeacherTemp[$v['uid']]['lesson_desc'] = $v['desc'];
			if(isset( $resultTeacher[ $v['uid'] ]) ){
				unset( $resultTeacher[ $v['uid'] ] );
			}
			//skvirja checks for online users
			$online = $this->checkOnline($v['uid']);
			$resultTeacherTemp[$v['uid']]['online'] = $online;
			$resultTeacher[] = $resultTeacherTemp[$v['uid']];
		}
		//checks for have session
		if(count($resultTeacher)>0){
			foreach($resultTeacher as $rt)
			{
				$hasSession = $this->hasSession($rt['uid']);
				$resultTeacher[$rt['uid']]['hasSession'] = $hasSession;
				/////
				  $chkfreesession = $this->chkfreesession($rt['uid']);
				   $resultTeacher[$rt['uid']]['chkfreesession'] = 'Yes';
				   
				   ///
				  $resultTeacher[$rt['uid']]['readytotalk'] = $this->checkreadytalk($rt['uid']);
				  //echo $resultTeacher[$rt['uid']]['readytotalk'];
				  //die();
				  
				   $personalprofile = $this->checkpersonalprofile($rt['uid']);
				  $resultTeacher[$rt['uid']]['personal'] = $personalprofile;
			}
		}
		$results = $resultTeacher;
		unset($resultTeacherTemp);
		$this->cache->save('freeFetureTeacherLessons', $results, $this->cacheTime);
		//print_r($results);
		//die();
		return $results;
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
        return $result;
	}
	public function getAllProfile(){
		$result = array();
		$sql = "select Lat,Lng from profile";
        $query = $this->db->query($sql);
		$result = $query->row_array();
        return $result;
	}
	public function getVideoResult1($searchData){
		//$select = "SELECT p.firstName,p.lastName,u.quarantine,p.pic,l.source,l.desc,l.price,l.uid FROM  lessons as l ,user as u, profile as p WHERE 1=1 AND ";
		$select = "SELECT p.firstName,p.lastName,u.quarantine,p.pic,l.source,l.desc,l.price,l.uid FROM  lessons as l left join profile as p on l.uid=p.uid left join user as u on u.id=p.uid WHERE 1=1 AND ";
		$wherefields = '';
		if($this->session->userdata['uid'])
		{
			$logUid = $this->session->userdata['uid'];
			$wherefields .= " l.uid != ".$logUid." AND ";
		}
		// filter language
		if($searchData['langInput1'] != '' || $searchData['langInput2'] != ''){
			if($searchData['langInput1'] != ''){
				$lsearch = $searchData['langInput1'];
			}
			if($searchData['langInput2'] != ''){
				if($searchData['langInput2'] != 'English' AND $searchData['langInput2'] != '0'){
					$lsearch1 = $searchData['langInput2'];
				}
			}
			$wherefields .= " (p.`nativeLanguage` LIKE '%{$lsearch}%' AND p.`otherLanguage` LIKE '%{$lsearch1}%' OR p.`nativeLanguage` LIKE '%{$lsearch1}%' AND p.`otherLanguage` LIKE '%{$lsearch}%') AND";
		}
		// filter keyword search
		if($searchData['fltr_business'] == 'true'){
			$wherefields .= " (`l`.`name` like '%business%' OR `l`.`desc` like '%business%') AND ";
		}
		if($searchData['fltr_medical'] == 'true'){
			$searchData['keyword'] = $searchData['keyword'].' medical';
			$wherefields .= " (`l`.`name` like '%medical%' OR `l`.`desc` like '%medical%') AND ";
		}
		if($searchData['fltr_finance'] == 'true'){
			$searchData['keyword'] = $searchData['keyword'].' finance';
			$wherefields .= " (`l`.`name` like '%finance%' OR `l`.`desc` like '%finance%') AND ";
		}
		if($searchData['fltr_software'] == 'true'){
			$searchData['keyword'] = $searchData['keyword'].' software';
			$wherefields .= " (`l`.`name` like '%software%' OR `l`.`desc` like '%software%') AND ";
		}
		if($searchData['keyword'] != ''){
			$keyword = explode(',',$searchData['keyword']);
			$keyword = explode(' ',trim($searchData['keyword']));
			$where = '';
			foreach($keyword as $k=>$v){
				if($v==''){
					continue;
				}
				$where .= " `l`.`name` LIKE '%{$v}%' OR `l`.`desc` like '%{$v}%' OR ";
			}
			$where = substr($where,0,-3);
			$wherefields .= " ({$where}) AND ";
		}
		//filter maximum cost usd
		
		if($searchData['hRateStart'] != ''){
			$config = $this->getConfig();
			$searchData['hRateStart'] = round($searchData['hRateStart'] / (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
			$searchData['hRateEnd'] = round($searchData['hRateEnd'] / (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
			$wherefields .= "`l`.`price` >= {$searchData['hRateStart']} and `l`.`price` <= {$searchData['hRateEnd']} AND ";
		}
		// filter author
		if($searchData['author'] != ''){
			if($searchData['author'] != 'Enter Author'){
				$author = $searchData['author'];
				$wherefields .= " (`p`.`firstName` like '%{$author}%' OR `p`.`lastName` like '%{$author}%') AND ";
			}
		}
		$wherefields .= " p.uid = l.uid AND l.status = '1' AND l.`visibility` = '1' and u.quarantine != 1 ";
		$sqlFinal =  $select.$wherefields;
		//echo $sqlFinal;
		$query = $this->db->query($sqlFinal);
		 
		$resultLessons = array();
		if ($query->num_rows() > 0) {
			$resultLessons = $query->result_array();
			//echo $this->db->last_query();die;
			$count = count($resultLessons);
					
			for($i = 0;$i<=$count;$i++)
			{
				$uid = $resultLessons[$i]['uid'];
				if($uid){
					$checkPremimumT = $this->checkPremiumTutorlessons($uid);
					if($checkPremimumT == 0){
						unset($resultLessons[$i]);
					}
				}
			}
		}
		 

		return $resultLessons;
	}
	public function getVideoLessonsUids(){
		$sql = "SELECT DISTINCT `uid` FROM lessons WHERE name!='' ";
		$query = $this->db->query($sql);
		$resultLesson = array();
		if ($query->num_rows() > 0) {
			$resultLesson = $query->result_array();	
			$vuids['id'] = array();
			foreach($resultLesson as $less)
			{
				$vuids['id'][] = $less['uid'];
			}
		}
		return $vuids;
	}
	/**
	* @author SKVIRJA
	* @package check for user is online or not 
	* @date 20 Sep 2013
	**/
	public function checkOnline($uid){
		$sql = "select DISTINCT uid from ci_sessions where uid = {$uid}";
		$query = $this->db->query($sql);
		$found = 0;
		if ($query->num_rows() > 0) {
			$found = 1;
		}
		return $found;
	}
	/**
	* @author SKVIRJA
	* @package delete opened class and update status 
	* @date 23 Sep 2013
	**/
	public function removeNow($uid){
		$sql = "update user set readytotalk = 0 where id = {$uid}";
		$query = $this->db->query($sql);
		
		
		
		
		//delete user sessions
		$sql = "DELETE FROM ci_sessions where uid = {$uid}";
		$query = $this->db->query($sql);
		//$sql = "DELETE FROM class where tid = {$uid} AND type = 'now' AND startTime = '0000-00-00 00:00:00' AND endTime = '0000-00-00 00:00:00' ";
		//$query = $this->db->query($sql);
	}
	public function getCurrentActiveClassTutors(){
		$start = date('Y-m-d H:i:s',time());
		$end = date('Y-m-d H:i:s',strtotime($start) + 25*60);
		$sql = "select * from class where (startTime BETWEEN '{$start}' AND '{$end}' OR endTime BETWEEN '{$start}' AND '{$end}') AND type = 'now' ";
		$query = $this->db->query($sql);
		
		$tids = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			
			foreach($result as $rs){
				if($rs['action'] == ''){
					$tids[] = $rs['tid'];
				}else{
					$actionClass = unserialize($rs['action']);
					if(@$actionClass['tutorConnected'] == 0){
						//if(@$actionClass['studentConnected'] == 1){
							$tids[] = $rs['tid'];
						/*}else{
							continue;
						}*/
					}else{
						$tids[] = $rs['tid'];
					}
				}
			}
		}
		return $tids;
	}
	//skvirja checks for premium tutors video lessons
	public function checkPremiumTutorlessons($uid){
		$sql = "select roleId from user where id = {$uid}";
		$query = $this->db->query($sql);
		$return = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$roleId = $result['roleId'];
			if($roleId == 1 || $roleId == 2 || $roleId == 3){
				$return = 1;
			}			
		}
		return $return;
	}
	//skvirja checks for tutor has opened session
	public function hasSession($uid){
		$return = 'No';
		$now = date('Y-m-d H:i:s',time());
		$start = date('Y-m-d H:i:s',$this->inTime($now));
		$sstart = date("Y-m-d H:i:s", strtotime("$start + 1 day"));

		// get all opened timeslot greater then current time 
		$sql = "SELECT * from timeSlot WHERE uid = {$uid} AND startTime>='{$sstart}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			if(count($result)>0){
				//checks for booked class and escape this one.
				foreach($result as $timeslot)
				{
					$t_startTime = $timeslot['startTime'];
					$t_endTime = $timeslot['endTime'];
					$t_uid = $timeslot['uid'];
					$sql1 = "SELECT COUNT(*) as num from class where startTime = '{$t_startTime}' AND endTime = '{$t_endTime}' AND tid = {$t_uid}";
					$query1 = $this->db->query($sql1);
					if ($query1->num_rows() > 0) {
						$result1 = $query1->row_array();
						$num = $result1['num'];
						if($num<=0){
							$return = 'Yes';		
						}
					}else{
						$return = 'Yes';
					}
				}
			}
		}
		return $return;
	}
	
	// function added by haren
	public function getAllData()
	{
		$teachers = $this->GetTutorData();
		if(!$teachers['uid'])
		{
			return array();
		}
		$sql = "SELECT `uid`,`name`,`desc` FROM lessons WHERE uid IN (".implode(',',$teachers['uid']).")";
		$query = $this->db->query($sql);
		$resultLesson = array();
		if ($query->num_rows() > 0) 
		{
			$resultLesson = $query->result_array();				
		}
		$resultTeacherTemp = $teachers['result'];
		$resultTeacher  = $teachers['result'];			
		foreach($resultLesson as $k=>$v)
		{
			$resultTeacherTemp[$v['uid']]['lesson_name'] = $v['name'];
			$resultTeacherTemp[$v['uid']]['lesson_desc'] = $v['desc'];
			if(isset( $resultTeacher[ $v['uid'] ]) ){
				unset( $resultTeacher[ $v['uid'] ] );
			}
			
			$online = $this->checkOnline($v['uid']);
			$resultTeacherTemp[$v['uid']]['online'] = $online;
			$resultTeacher[] = $resultTeacherTemp[$v['uid']];
		}
		
		if(count($resultTeacher)>0)
		{
			foreach($resultTeacher as $rt)
			{
				$hasSession = $this->hasSession($rt['uid']);
				$resultTeacher[$rt['uid']]['hasSession'] = $hasSession;
			}
		}
		$results = $resultTeacher;
		unset($resultTeacherTemp);
		$this->cache->save('freeFetureTeacherLessons', $results, $this->cacheTime);
		
		return $results;
	}
	public function GetTutorData(){
		 $sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , provices.provice ,profile.city,user.roleId,profile.hRate FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id WHERE user.roleId >= 1 AND user.roleId < 4 AND user.`hiddenRole` = 0 order by RAND()";
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results['uid'][] = $v['uid'];
				$results['result'][$v['uid']] = $v;
				$results['result'][$v['uid']]['lesson_name'] = '';
				$results['result'][$v['uid']]['lesson_desc'] = '';
				$results['result'][$v['uid']]['hRate'] = '0.00';
				$results['result'][$v['uid']]['avgRate'] = $this->getAvgRating($v['uid']);
			}
		}
		$this->cache->save('freeFetureTeachers', $results, $this->cacheTime);
		return $results;
	}
	
	public function getFetureTeacherLessonsearch($whereField){
	
	  
	json_encode($whereField);
	$count =  count($whereField);
	
	 $home_search = $this->session->userdata('uid');
    
  	 if($count!=0)
	 { 
	  
			
		 $teachers = $this->getFetureTeachersearchwh($whereField);
		 
	 }
	 else
		{  
		// echo "here11"; die();
		$teachers = $this->getFetureTeachersearch();
	   }
	  //print_r($teachers);
	  //echo "oo";
	  //die();
		if(!$teachers['uid']){
			return array();
		
		}
		//echo "<pre>"; print_r($teachers);die();
		//$sql = "SELECT  `uid`,`name`,`desc` FROM lessons WHERE uid IN (".implode(',',$teachers['uid']).")  ";
		//$query = $this->db->query($sql);
		$resultLesson = array();
		/*if ($query->num_rows() > 0) {
			$resultLesson = $query->result_array();				
		}*/
		// echo "<pre>";print_r($resultLesson);die();
		$resultTeacherTemp = $teachers['result'];
		$resultTeacher  = $teachers['result'];
		foreach($resultLesson as $k=>$v){
			$resultTeacherTemp[$v['uid']]['lesson_name'] = $v['name'];
			$resultTeacherTemp[$v['uid']]['lesson_desc'] = $v['desc'];
			if(isset( $resultTeacher[ $v['uid'] ]) ){
				// unset( $resultTeacher[ $v['uid'] ] );
			}
			//skvirja checks for online users
			$online = $this->checkOnline($v['uid']);
			$resultTeacherTemp[$v['uid']]['online'] = $online;
			$resultTeacher[] = $resultTeacherTemp[$v['uid']];
			
			

			
		}
		
			  // print_r($teachers['result']);
			    //echo $home_search."oo";
	 // die();
		
		//checks for have session
		 if(count($resultTeacher)>0){
			 foreach($resultTeacher as $rt)
			 {
			 
					$hasSession = $this->hasSession($rt['uid']);
				 $resultTeacher[$rt['uid']]['hasSession'] = $hasSession;
				 if( $home_search!='')
				 {
				 // $chkfreesession = $this->chkfreesession($rt['uid']);
				 // $resultTeacher[$rt['uid']]['chkfreesession'] = $chkfreesession;
				  }
				  
				 if( $home_search=='')
				 {
				  $chkfreesessionhome_search = $this->chkfreesessionhome_search($rt['uid']);
				  $resultTeacher[$rt['uid']]['chkfreesession'] = $chkfreesessionhome_search;
				 }
				  
				  
				  
				   $checkreadytalk = $this->checkreadytalk($rt['uid']);				   
				  $resultTeacher[$rt['uid']]['readytotalk'] = $checkreadytalk;
				  
				   $personalprofile = $this->checkpersonalprofile($rt['uid']);
				  $resultTeacher[$rt['uid']]['personal'] = $personalprofile;
			 }
		 }
		$results = $resultTeacher;
			   // echo count($results);
			  // print_r($results);die();
		unset($resultTeacherTemp);
		$this->cache->save('fetureTeacherLessons', $results, $this->cacheTime);
		return $results;
	}
	public function getFetureTeachersearchwh($whereField){
	//echo "<pre>"; print_r($whereField);die;
	
    $home_search = $this->session->userdata('uid');	
	
 	$currenttime = date('Y-m-d h:i:s');
	
	$sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , 
profile.city,user.roleId,profile.hRate,profile.free_session,profile.tutor_markup,profile.school_id,readytotalk,nativeLanguage,'id2' OrderKey FROM  profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id
where (roleId = 3 or  roleId = 2 or  roleId =1)  AND user.`hiddenRole` = 0 AND `profile`.`pic` != '' and user.`quarantine`!='1' and ".implode(" AND ",$whereField) ." ORDER BY nativeLanguage ASC, readytotalk DESC, roleId DESC"; // roleid desc

	 /*$sql = "select profile.personal,profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country, 
provices.provice ,profile.city,user.roleId,profile.hRate,profile.free_session,profile.school_id,readytotalk,nativeLanguage ,'id1' OrderKey FROM timeSlot, profile LEFT JOIN user ON user.id = profile.uid and (`user`.roleId = 3 or  `user`.roleId = 2 or  `user`.roleId =1) LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where   user.id = timeSlot.uid  and  timeSlot.`stid` = 0 and user.`quarantine`!=1 AND `profile`.`pic_upload` = 1 AND `profile`.`vid_upload` =1 AND profile.`BioGraphy` = 1 and  ".implode(" AND ",$whereField) ."
UNION ALL select profile.personal, profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , 
provices.provice ,profile.city,user.roleId,profile.hRate,profile.free_session,profile.school_id,readytotalk,nativeLanguage,'id2' OrderKey FROM  profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where user.`id` NOT IN (select  uid from timeSlot)  and (roleId = 3 or  roleId = 2 or  roleId =1) and user.`quarantine`!=1 AND `profile`.`pic_upload` = 1 AND `profile`.`vid_upload` =1 AND profile.`BioGraphy` = 1 and ".implode(" AND ",$whereField) ."
ORDER BY nativeLanguage ASC, readytotalk DESC, roleId DESC"; // ORDER BY OrderKey, roleid desc";*/
	//die();and timeslot.startTime >='{$currenttime}'
		/* $sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country, 
provices.provice ,profile.city,user.roleId,profile.hRate ,profile.tutor_markup,profile.school_id ,'id1' OrderKey FROM timeSlot, profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where   user.id = timeSlot.uid  and  timeSlot.`stid` = 0 and timeSlot.startTime >='{$currenttime}' and ".implode(" AND ",$whereField) ."
UNION ALL select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , 
provices.provice ,profile.city,user.roleId,profile.hRate ,profile.tutor_markup,profile.school_id,'id2' OrderKey FROM  profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where user.`id` NOT IN (select  uid from timeSlot)  and (roleId = 3 or  roleId = 2 or  roleId =1) and user.`quarantine`!= 1 and ".implode(" AND ",$whereField) ."
ORDER BY OrderKey, roleid desc";*/

		
		$query = $this->db->query($sql);
		 
		 
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			
		
			
			foreach($result as $k=>$v){
			//echo $v['uid'] ;die;
				$results['uid'][] = $v['uid'];
				$results['result'][$v['uid']] = $v;
				//$results['result'][$v['uid']]['lesson_name'] = '';
				//$results['result'][$v['uid']]['lesson_desc'] = '';
				$results['result'][$v['uid']]['online'] = $this->checkOnline($v['uid']);
				$results['result'][$v['uid']]['avgRate'] = $this->getAvgRating($v['uid']);
				$results['results'][$v['uid']]['readytotalk'] = $this->checkreadytalk($v['uid']);
				 
			   
				if($home_search!='')
				{
				$chkfreesession = $this->chkfreesession($v['uid']);
		        $results[$v['uid']]['chkfreesession'] = $chkfreesession;
				}
				 
				$personalprofile = $this->checkpersonalprofile($v['uid']);
				$results[$v['uid']]['personal'] = $personalprofile;
			  //$results['results']['chkfreesession'] = $chkfreesession;
			}
		
		}
		
			 
		
		$this->cache->save('fetureTeachers', $results, 300);
		return $results;
	}
	
	//////
	
	public function getFetureTeachersearch(){$currenttime = date('Y-m-d h:i:s');
	$sql = "select profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country  ,profile.city,user.roleId,profile.hRate ,profile.tutor_markup,profile.school_id,readytotalk,nativeLanguage,'id2' OrderKey FROM  profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id 
where (roleid = 3 or  roleid = 2 or  roleid =1) AND user.`hiddenRole` = 0 AND `profile`.`pic` != '' and user.`quarantine`!= '1' ORDER BY nativeLanguage, readytotalk, roleId desc";/*OrderKey, roleid desc";*/
	/*$sql = "select profile.personal,profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , 
provices.provice ,profile.city,user.roleId,profile.hRate ,profile.tutor_markup,profile.school_id,readytotalk,nativeLanguage  ,'id1' OrderKey FROM timeSlot, profile LEFT JOIN user ON user.id = profile.uid and (`user`.roleId = 3 or  `user`.roleId = 2 or  `user`.roleId =1) LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where   user.id = timeSlot.uid  and user.`quarantine`!= 1 AND `profile`.`pic_upload` = 1 AND `profile`.`vid_upload` =1 AND profile.`BioGraphy` = 1 and  timeSlot.`stid` = 0 and timeSlot.startTime >='{$currenttime}'  
UNION ALL
select profile.personal,profile.uid,profile.pic,profile.firstName,profile.lastName,profile.Lat,profile.Lng,countries.country , 
provices.provice ,profile.city,user.roleId,profile.hRate ,profile.tutor_markup,profile.school_id,'id2' OrderKey FROM  profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN 
countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id 
where user.`id` NOT IN (select  uid from timeSlot) and user.`quarantine`!= 1 AND `profile`.`pic_upload` = 1 AND `profile`.`vid_upload` =1 AND profile.`BioGraphy` = 1 and  (roleid = 3 or  roleid = 2 or  roleid =1)  
ORDER BY nativeLanguage, readytotalk, roleId desc"; // ORDER BY OrderKey, roleid desc";*/
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			
		
			
			foreach($result as $k=>$v){
				$results['uid'][] = $v['uid'];
				$results['result'][$v['uid']] = $v;
				//$results['result'][$v['uid']]['lesson_name'] = '';
				//$results['result'][$v['uid']]['lesson_desc'] = '';
				$results['result'][$v['uid']]['online'] = $this->checkOnline($v['uid']);
				$results['result'][$v['uid']]['avgRate'] = $this->getAvgRating($v['uid']);
				$results['result'][$v['uid']]['readytotalk'] = $this->checkreadytalk($v['uid']);
				
				//$personalprofile = $this->checkpersonalprofile($v['uid']);
				//$results['result'][$v['uid']]['personal'] = $this->checkpersonalprofile($v['uid']);
			}
		
		}
		
			//print_r($results);die();
		
		$this->cache->save('fetureTeachers', $results, 500);
		return $results;
	}
	
	/////
	public function chkfreesession($uid)
	{
		//echo $uid;die;
		
		$currenttime = date('Y-m-d h:i:s');
		
		 $sid = $this->session->userdata('uid'); 
		 
		 /* 7 march addded yb haren */
		 
		 $sql="select free_session from user where id='{$uid}'";
		 $checkAllow = $this->db->query($sql);				
		 $res = $checkAllow->row_array();
		 
		 if($res['free_session'] == 'n')
		 {
				return $return = 'NO';
		 }	 
		 /* end haren code */
		 if($sid=='')
		{ 
			 $q= "SELECT exp_session,is_eligible from user where  user.id='{$uid}'";
			//$q= "SELECT exp_session,is_eligible from user where  user.id='{$uid}' AND roleid=0";
			$classquery = $this->db->query($q);				
			$classresult = $classquery->row_array();
			$cdate=date('Y-m-d');
			if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
			{
				$return ='Yes';
			}
			else{
				$return = 'NO';
			}
			 	return $return;		
		 } 
		 $q= "SELECT exp_session,is_eligible from user where  user.id='{$sid}'";
		//$q= "SELECT exp_session,is_eligible from user where  user.id='{$sid}' AND roleid=0";
		$classquery = $this->db->query($q);
		$classresult = $classquery->row_array();
		$cdate=date('Y-m-d');
		if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
		{
		  $return ='Yes';
		}
		else{
			 $return = 'NO';
		} 
		 return $return;
 	}
	public function chkfreesession12($uid)
	{ 
		$currenttime = date('Y-m-d h:i:s');
		$sid = $this->session->userdata('uid');
		if($sid=='')
		{
			$sql1 = "SELECT free_session from profile where uid = {$uid} ";
			$query1 = $this->db->query($sql1);
			$result1 = $query1->result_array();
			if($result1[0]['free_session']=='y')
			{
				$return = 'Yes';	
			}
			else
			{
				$return = 'No';
			}
			return $return;	
			 		
		}
		$sql = "SELECT profile.free_session from profile,user  WHERE profile.uid = {$sid} AND user.id = {$sid} AND user.exp_session >='{$currenttime}' ";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		if($result[0]['free_session']=='y'){			
			$sql1 = "SELECT free_session from profile where uid = {$uid} ";
			$query1 = $this->db->query($sql1);
			$result1 = $query1->result_array();
			if($result1[0]['free_session']=='y')
			 {
				$return = 'Yes';	
			 }
			 else
			 {
				$return = 'No';
			 }
			return $return;	 
		}		
		return $return = 'NO';		
 	}
	
	public function checkreadytalk($uid)
	{
	
	//$sid = $this->session->userdata('uid');
	//echo $uid;die();
	$sql = "SELECT readytotalk from user  WHERE  id = {$uid}   "  ;
		$query = $this->db->query($sql);
		
			$result = $query->result_array();
			//print_r($result);
			///die();
			return $result; 
			
	}
	
	public function chectutormarkup($sid)
	{
	$sql = "SELECT tutor_markup from profile  WHERE  uid = {$sid}   "  ;
		$query = $this->db->query($sql);
		
			$result = $query->result_array();
			//print_r($result);die();
			return $result; 
	}
	public function checkpersonalprofile($uid)
	{
		$sql = "SELECT  professional as personal from profile  WHERE  uid = {$uid}";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$result[0]['personal']=substr($result[0]['personal'], 0, 85);
		if(strlen($result[0]['personal'])>=85)
		{
			$result[0]['personal']=$result[0]['personal']."...";
		}
		return $result; 			
	}

	public function chkfreesessionhome_search($uid)
	{
	  
		//$currenttime = date('Y-m-d h:i:s');
	
	//$sid = $this->session->userdata('uid');
	//if($sid=='')
	//{
		//return $return = 'NO';		
	//}
	//$sql = "SELECT profile.free_session from profile,user  WHERE profile.uid = {$sid} AND user.id = {$sid} AND user.exp_session >='{$currenttime}' "  ;
		//$query = $this->db->query($sql);
		
			//$result = $query->result_array();
			  //print_r($result);die();
			  //echo $result[0]['free_session'];die();
			//if($result[0]['free_session']=='y'){
			
				$sql1 = "SELECT free_session from profile where uid = {$uid} ";
					$query1 = $this->db->query($sql1);
					$result1 = $query1->result_array();
						// print_r($result1['free_session']);die();
						// echo $result1[0]['free_session'];die();
			     if($result1[0]['free_session']=='y')
				 {
				 $return = 'Yes';	
				 }
				 else
				 {
				 $return = 'No';
				 }
					
					return $return;	 
	//	}		
		return $return = 'NO';		
	 	}
		
		
		/* function added by  haren for geting markup of school */
		
		public function GetSchoolMarkup($sid)
		{
			$result1 =array();
			$sql="select tutor_markup from profile where uid='{$sid}'";
			$query1 = $this->db->query($sql);
			$result1 = $query1->row_array();
			if($result1 != array())
			{
					return $result1['tutor_markup'];
			}
			
		}
	
	// Update AvgRating in Profile Table
	function updateAvgRating()
	{
		$result1 =array();
		$sql = "SELECT `callerId` , (SUM( `onTime` ) + SUM( `clearReception` )), ROUND( (SUM( `onTime` ) + SUM(`clearReception` ) ) / ( count( `callerId` ) *2 )) as `avgRate` FROM `feedback` GROUP BY `callerId` order by `callerId` ASC ";
		$qry = $this->db->query($sql);
		if ($qry->num_rows() > 0){
			$result = $qry->result_array();
			foreach($result as $data)
			{
				$sqlPro = "Update `profile` SET `avgRate` = '".$data['avgRate']."' WHERE `uid` = '".$data['callerId']."'";
				$qryPro = $this->db->query($sqlPro);
			}
		}
	}
}
/* End of file search_model.php */
/* Location: ./application/model/search_model.php */