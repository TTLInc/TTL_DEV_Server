<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angular_search_model extends TL_Model{

	public function __construct(){
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
		if(!$this->useCached){
			$this->cacheTime = 1;
		}
	}
	protected $useCached = true;
	protected $cacheTime = 3000000;
	// Get List of Users by Search Condition
	public function getResult()
	{
		//----------Enable URL search-----//
		if(	isset($_GET['freeSes'])	 || isset($_GET['langInput1']) || isset($_GET['keywords']) || isset($_GET['sortKeys']) || isset($_GET['langInput2']) || isset($_GET['gender']) || isset($_GET['school']) || isset($_GET['sch']) || isset($_GET['country']) || isset($_GET['province']) || isset($_GET['today']) || isset($_GET['fromTime']) || isset($_GET['toTime'])){
			$content = $this->getParamResult($_GET, 0, 20000);
			return $content;
		}
		//----------Enable URL search-----//
		
		$cnd = "";
		$orderBy = "`readytotalk` DESC, `user`.`roleId` DESC, `nativeLanguage` ASC ";
		$order = "";			
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
		$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd ";
		$queryTotal = $this->db->query($sqlTotal);
		$resultTotal = $queryTotal->result_array();
		$result = array();
		$response['totalCount'] = $resultTotal[0]['total'];
		$response['results'] = array();
		if ($response['totalCount'] > 0) { 
			$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`fbshare`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`Lat`, `profile`.`Lng` $setPrfHrate, `profile`.`pic`, SUBSTRING(`profile`.`professional`,1,130) as `professional`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city`, `countries`.`country`,`countries`.`id` AS `country_id`,`profile`.`academic`,`user`.`username`,`user`.`email`,`profile`.`nativeLanguage`,`profile`.`otherLanguage`,`profile`.`gender`,`profile`.`personal`, `provices`.`id` as `province_id`,`provices`.`provice` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order ";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
				$response['results'] = $this->filterBookedTutors($response['results']);
			}
		}
		return $response;
	}
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
	
	
	
	public function getParamResult($arCnd=array(), $offset=0, $limit=20000)
	{
		$arCnd = $_GET;
		$arCnd['keyword'] = $_GET['keywords'];
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
			if (!empty($arCnd['sch']) && !empty($arCnd['school'])) {
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
			$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`fbshare`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`nativeLanguage` , `profile`.`otherLanguage` , `profile`.`Lat`, `profile`.`Lng` $setPrfHrate, `profile`.`pic`, SUBSTRING(`profile`.`professional`,1,130) as `professional`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city`, `countries`.`country`, `provices`.`provice` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";
			

			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
				$response['results'] = $this->filterBookedTutors($response['results']);
			}
		}
		return $response;
	}
	
	
	
	
	
	
}
