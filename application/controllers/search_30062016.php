<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends TL_Controller {
	public function __construct(){
        parent::__construct();
		session_start();
        $this->load->model(array('lookup_model', 'search_model', 'profile_model', 'lesson_model','user_model'));
		
    }
	public function index(){
		$this->search();
	}
	
	/*Search*/
	public function search()
	{
		$multi_lang = 'en';
		if (isset($_SESSION['multi_lang'])) {
			$multi_lang = $_SESSION['multi_lang'];
		}
		$arrVal = $this->lookup_model->getValue('906', $multi_lang); $secondlang = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('907', $multi_lang); $ucost = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('908', $multi_lang); $allcntry = $arrVal[$multi_lang];
		
		$this->load->model(array('location_model','langs_model'));
		$langs= $this->langs_model->getLangs(2);
		// TECHNO-SANJAY added new language array for display languages on search page
		$langsAll2= $this->langs_model->getLangs();
		if(isset($langsAll2['A'])) {
			$langsAll2['A'][0] = $secondlang;
			ksort($langsAll2['A']);
		}else{
			$langsAll2['A'] = array('0'=>$secondlang);
			ksort($langsAll2);
		}
		$langsAll= $this->langs_model->getLangs();
		$sessionSearchData = array();
		if($this->session->userdata('langInput1') or $this->input->get('langInput1')){
			//$sessionSearchData['langInput1Selected'] = $this->session->userdata('langInput1');			
			$sessionSearchData['langInput1Selected'] = $this->input->get('langInput1');
			$this->session->unset_userdata('langInput1');
		}
		if($this->session->userdata('langInput2') or $this->input->get('langInput2')){
			//$sessionSearchData['langInput2Selected']=$this->session->userdata('langInput2');					
			$sessionSearchData['langInput2Selected'] = $this->input->get('langInput2');
			$this->session->unset_userdata('langInput2');
		}
		if($this->session->userdata('hRateEnd') or $this->input->get('hRateEnd')){
			//$sessionSearchData['hRateEndSelected'] = $this->session->userdata('hRateEnd');
			$sessionSearchData['hRateEndSelected'] = $this->input->get('hRateEnd');
			$this->session->unset_userdata('hRateEnd');
		}
		if($this->input->get('gender')!=""){
			$sessionSearchData['genderSelected'] = $this->input->get('gender');
		}
		if($this->session->userdata('sname') or $this->input->get('school')){
			$sessionSearchData['sname'] = $this->input->get('school');
			$this->session->unset_userdata('sname');
		}
		if($this->session->userdata('sid') or $this->input->get('sch')){
			$sessionSearchData['sid'] = $this->input->get('sch');
			$this->session->unset_userdata('sid');
		}
		if($this->session->userdata('country') or $this->input->get('country')){
			//$sessionSearchData['countrySelected'] = $this->session->userdata('country');
			$sessionSearchData['countrySelected'] = $this->input->get('country');
			$this->session->unset_userdata('country');
		}
		if($this->session->userdata('province') or $this->input->get('province')){
			//$sessionSearchData['provinceSelected'] = $this->session->userdata('province');
			$sessionSearchData['provinceSelected'] = $this->input->get('province');
			$this->session->unset_userdata('province');
		}
		if($this->session->userdata('online') or $this->input->get('online')){
			//$sessionSearchData['onlineSelected'] = $this->session->userdata('online');
			$sessionSearchData['onlineSelected'] = $this->input->get('online');
			$this->session->unset_userdata('online');
		}
		if($this->session->userdata('keyword') or $this->input->get('keywords')){
			//$sessionSearchData['keywordSelected'] = $this->session->userdata('keyword');
			$sessionSearchData['keywordSelected'] = $this->input->get('keywords');
			$this->session->unset_userdata('keyword');
		}
		if($this->session->userdata('keydisplay') or $this->input->get('keydisplay')){
			//$sessionSearchData['keydisplaySelected'] = $this->session->userdata('keydisplay');
			$sessionSearchData['keydisplaySelected'] = $this->input->get('keydisplay');
			$this->session->unset_userdata('keydisplay');
		}
		if($this->session->userdata('page') or $this->input->get('page')){
			//$sessionSearchData['pageSelected'] = $this->session->userdata('page');
			$sessionSearchData['keydisplaySelected'] = $this->input->get('page');
			$this->session->unset_userdata('page');
		}
		if($this->session->userdata('perPage')){
			$sessionSearchData['perPageSelected'] = $this->session->userdata('perPage');
			$this->session->unset_userdata('perPage');
		}
		if($this->session->userdata('last_toefl_score')){
			$sessionSearchData['last_toefl_scoreSelected'] = $this->session->userdata('last_toefl_score');
			$this->session->unset_userdata('last_toefl_score');
		}
		if($this->session->userdata('last_toiec_score')){
			$sessionSearchData['last_toiec_scoreSelected'] = $this->session->userdata('last_toiec_score');
			$this->session->unset_userdata('last_toiec_score');
		}
		if($this->session->userdata('fltr_business')){
			$sessionSearchData['fltr_businessSelected'] = $this->session->userdata('fltr_business');
			$this->session->unset_userdata('fltr_business');
		}
		if($this->session->userdata('fltr_medical')){
			$sessionSearchData['fltr_medicalSelected'] = $this->session->userdata('fltr_medical');
			$this->session->unset_userdata('fltr_medical');
		}
		if($this->session->userdata('fltr_finance')){
			$sessionSearchData['fltr_financeSelected'] = $this->session->userdata('fltr_finance');
			$this->session->unset_userdata('fltr_finance');
		}
		if($this->session->userdata('fltr_software')){
			$sessionSearchData['fltr_softwareSelected'] = $this->session->userdata('fltr_software');
			$this->session->unset_userdata('fltr_software');
		}
		if($this->session->userdata('readytotalk')){
			$sessionSearchData['readytotalknowSelected'] = false;
			$this->session->unset_userdata('readytotalk');
		}
		
		if($this->session->userdata('anytutor')){
			$sessionSearchData['anytutorSelected'] = $this->session->userdata('anytutor');
			$this->session->unset_userdata('anytutor');
		}
		if($this->session->userdata('datetime')){
			$sessionSearchData['datetimeSelected'] = $this->session->userdata('datetime');
			$this->session->unset_userdata('datetime');
		}
		if($this->session->userdata('today') or $this->input->get('today')){
			//$sessionSearchData['todaySelected'] = $this->session->userdata('today');
			$sessionSearchData['todaySelected'] = $this->input->get('today');
			$this->session->unset_userdata('today');
		}
		if($this->session->userdata('fromTime') or $this->input->get('fromTime')){
			//$sessionSearchData['fromTimeSelected'] = $this->session->userdata('fromTime');
			$sessionSearchData['fromTimeSelected'] = $this->input->get('fromTime');
			$this->session->unset_userdata('fromTime');
		}
		if($this->session->userdata('toTime') or $this->input->get('toTime')){
			//$sessionSearchData['toTimeSelected'] = $this->session->userdata('toTime');
			$sessionSearchData['toTimeSelected'] = $this->input->get('toTime');
			$this->session->unset_userdata('toTime');
		}
		if($this->session->userdata('sortKeys') or $this->input->get('sortKeys')){
			//$sessionSearchData['toTimeSelected'] = $this->session->userdata('toTime');
			$sessionSearchData['sortKeys'] = $this->input->get('sortKeys');
			$this->session->unset_userdata('sortKeys');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);
		$price = array();
		$i = 0;
		while($i<= 100){
			$price[$i] = $i;
			if($i<50){
				$i = $i+5;
			}else if($i<100){
				$i = $i+10;
			}else {
				$i = $i+100;
			}
		}
		$price[50000] = $ucost;
		$countries= $this->location_model->getCountries();
		if(isset($countries['A'])) {
			$countries['A'][0] = $allcntry;
			ksort($countries['A']);
		}else{
			$countries['A'] = array('0'=>$allcntry);
			ksort($countries);
		}
		$countries['A'][2] = 'USA';
		ksort($countries['A']);
		unset($countries['U'][2]);
		$cidP =  2;
		$provinces = $this->location_model->getProvices($cidP);
		$provinces[0] = 'All States';
		ksort($provinces);
		// checks for delted events to revert free session
		$cellNumber = '';
		
		if($this->session->userdata('uid')){
		 
			if($this->session->userdata('roleId') == '0'){
				$updateUserSessionData = array();
				$getUserSessionByDb = $this->profile_model->getProfile($this->session->userdata('uid'));
				$updateUserSessionData['free_session'] = $getUserSessionByDb['free_session'];
				$updateUserSessionData['firstTime'] = 'y';
				$this->session->set_userdata($updateUserSessionData);
				$cellNumber = $getUserSessionByDb['cell'];
			}
		}
		$this->layout->setData('cellNumber',$cellNumber);	
		$this->layout->setData('langs',$langs);
		$this->layout->setData('langsAll',$langsAll);
		$this->layout->setData('langsAll2',$langsAll2);
		$this->layout->setData('price',$price);
		$this->layout->setData('countries',$countries);
		$this->layout->setData('provinces',$provinces);
		$config = $this->location_model->getConfig();
		$this->layout->setData('config',$config);
		$this->load->helper('form');
		
		if(isset($_GET['frm']) and !empty($_GET['frm'])) {
			$this->load->model(array('category_model'));	
			$kewords = $_GET['keywords'];
			if ($_GET['keywords'] == "college") {
				$kewords = "Academic";
			}
			$selcategory = $this->category_model->selCategory(" `category` like '".$kewords."%'");
			$this->layout->setData('selcategory',$selcategory);
		}
		
		//$searchData = $this->search_model->getResult();
		$this->layout->setLayoutData('linkAttr','search');
		$this->layout->view('search/search');
	}
	
	
	public function doSearch(){
		$this->load->model(array('user_model'));
		$_data = $this->input->_requestAll();
	 	$this->session->set_userdata($_data);
		$multi_lang = 'en';
		if (isset($_SESSION['multi_lang'])) {
			$multi_lang = $_SESSION['multi_lang'];
		}
		
		$arrVal = $this->lookup_model->getValue('916', $multi_lang); $exp = $arrVal[$multi_lang];
		if (trim($_data['keyword']) == $exp) {
			$_data['keyword'] = '';
		}
		
		$this->load->model(array('location_model','langs_model'));
		//escape default selected language value
		if ($_data['langInput2'] == '0' ) {
			$_data['langInput2'] = '';
			$langInput2 = "";
		}
		
		// SKVIRJA checks for existing email id using keyword search
		$_data['searchBy'] = 'keyword'; 
		/*if ($_data['keyword'] != '') {
			$emailExistsByKeyword = $this->user_model->getEmail($_data['keyword']);
			if($emailExistsByKeyword)
			{
				$_data['searchBy'] = 'email'; 
			}
			else
			{
				$_data['searchBy'] = 'keyword'; 
			}
		}*/
		$currenttime = date('Y-m-d h:i:s');
		//$featureTeachers = array();
		$uid = $this->session->userdata('uid');
		if ($uid !='') {
			// Set Search Result in DB
			$ardata = array(
				"langInput1"	=> $_data['langInput1'],
				"keyword"		=> $_data['keyword'],
				"langInput2"	=> $langInput2,
				"gender"		=> $_data['gender'],
				"school"		=> $_data['school'],
				"schoolId"		=> $_data['sch'],				
				"country"		=> $_data['country'],				
				"province"		=> $_data['province'],			
				"today"			=> $_data['today'],			
				"fromTime"		=> $_data['fromTime'],			
				"toTime"		=> $_data['toTime'],
			);
			$jsondata = json_encode($ardata);
			// Insert/Update Search Record in recent_search Table
			$this->user_model->fnUpdateSearchData(array("user_id"=>$uid,"searchdata"=>$jsondata));
			
			/*$q= "SELECT exp_session,is_eligible from user where  user.id='{$uid}' AND user.exp_session >='{$currenttime}' AND is_eligible=1 AND roleid=0";
			$query = $this->db->query($q);
			$resultmoney = 0;
			if ($query->num_rows() > 0) {
				$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
				$_data['freeSes'] = 'y';
				$_data['freeSesUser'] = 'y'; 
			} else {
				if (strlen($_data['freeSes']) > 0) {
					$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
				} else {
					$featureTeachers = $this->search_model->getFetureTeacherLessons();
				}
			}*/
		} else {
			/*$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
			$_data['freeSes'] = 'y';
			$_data['freeSesUser'] = 'y';*/
		}
		//$featureTeachersCount = count($featureTeachers);
		
		
		$data['perPage'] = $perpage = isset($_data['perPage']) ? $_data['perPage'] : 6;
		//$data['totalCount'] = count($searchData) * ceil (count($searchData)/($perpage-$featureTeacherPerCount));
		//$data['totalCount'] = count($searchData) * ceil (count($searchData)/$perpage) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$offset = ($page-1)*$perpage;
		//$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$searchData = $this->search_model->getResult($_data, $offset, $perpage);
		$data['count'] = $searchData['totalCount'];
		$data['totalCount'] = $searchData['totalCount'];
		foreach($searchData['results'] as $searchresult){
			$scid = $searchresult['school_id'];
			$sql = "SELECT tutor_markup FROM profile WHERE uid= ".$scid;
			$query 			= $this->db->query($sql);
			$resdata  = $query->result_array();
			$searchData['results']['markup'] = $resdata[0]['tutor_markup'];
		}
		$data['rows']['result'] = $searchData['results'];
		/*if (count($searchData)<=0) {
			$featureTeachersCount = 0;
			unset($featureTeachers); 
			$featureTeachers = array();
		}*/
		$data['sname']	= $_data['school'];
		$data['sid']	= $_data['sch'];
		$schoolName		= $_data['school'];
		$schoolId		= $_data['sch'];
		$data['rows']['schoolVal']	= $schoolName;
		$data['rows']['schoolidval']= $schoolId;
		
		if ($_data['school'] !='' && $_data['sch']!='') {
			$this->session->set_userdata('sname',$_data['school']);
			$this->session->set_userdata('sid',$_data['sch']);
			/*$featureTeachersCount = 0;
			unset($featureTeachers); 
			$featureTeachers = array();*/
		} else {
			//$this->session->unset_userdata('sname','');
			//$this->session->unset_userdata('sid','');
		}
		
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;

		/*if ($sortKey!='select') {
			$searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		}*/
		
		//$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		/*if ($featureTeachersCount == 0) {
		} else if ($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount) {
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		} else if($featureTeacherPerCount*$page > $featureTeachersCount) {
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['rows']['feature'] =  array_slice($featureTeachers,($page-1)*$featureTeacherPerCount,$featureTeacherPerCount);*/
		//$data['count'] = count($data['rows']['feature'])+count($data['rows']['result']);
		//$data['count'] = count($data['rows']['result']);
		//$data['count'] =  count($searchData);
		echo json_encode($data);
	}
	
	
	public function fnReset()
	{
		$this->session->unset_userdata('langInput1');
		$this->session->unset_userdata('keyword');
		$this->session->unset_userdata('langInput2');
		$this->session->unset_userdata('gender');
		$this->session->unset_userdata('sname');
		$this->session->unset_userdata('sid');
		$this->session->unset_userdata('country');
		$this->session->unset_userdata('province');
		$this->session->unset_userdata('today');
		$this->session->unset_userdata('fromTime');
		$this->session->unset_userdata('toTime');
		redirect('search/search');
	}
	
	//public function freeSearch($firstTime=null)
	public function freeSearch(){
		$this->load->model(array('location_model','langs_model','search_model'));
		$langs= $this->langs_model->getLangs(2);
		$langsAll= $this->langs_model->getLangs();
		$price = array();
		$i = 0;
		while($i<=1000){
			$price[$i] = $i;
			if($i<50){
				$i = $i+5;
			}else if($i<100){
				$i = $i+10;
			}else {
				$i = $i+100;
			}
		}
		$this->search_model->getOnlineUser();
		$countries= $this->location_model->getCountries();
		$this->layout->setData('langsAll',$langsAll);
		$this->layout->setData('langs',$langs);
		$this->layout->setData('price',$price);
		$this->layout->setData('countries',$countries);
		$this->load->helper('form');
		$this->layout->view('search/freeSearch');
	}
	public function doFreeSearch(){
	
	
	$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		 $this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('916', $multi_lang);
		$exp = $arrVal[$multi_lang];
		$featureTeacherPerCount = 2;
		$_data = $this->input->_requestAll();
		if($_data['keyword'] == $exp){
			$_data['keyword'] = '';
		}
		$this->load->model(array('location_model','langs_model','search_model'));
		$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
		$featureTeachersCount = count($featureTeachers);
		$searchData = $this->search_model->getResult($_data);
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;
		$searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		$data['perPage'] = $perpage =isset($_data['perPage']) ? $_data['perPage'] : 6;
		$data['totalCount'] = count($searchData) + $featureTeacherPerCount * ceil (count($searchData)/($perpage-$featureTeacherPerCount)) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$perpage -= 2; 
		$startRow = ($page-1)*$perpage;
		$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		if($featureTeachersCount == 0){
		}else if($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount){
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		}else if($featureTeacherPerCount*$page > $featureTeachersCount){
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['rows']['feature'] =  array_slice($featureTeachers,($page-1)*$featureTeacherPerCount,$featureTeacherPerCount);
		$data['count'] = count($data['rows']['feature'])+count($data['rows']['result']);
		$data['count1'] =  count($searchData) ;;
		echo json_encode($data);
	}
	/**
	 * @author SKVIRJA
	 * @package map do search
	 * @param  date : 04 Jan 2013
	 */
	public function doSearchMap(){
	//echo "here";die();
	//error_reporting(1);
	    $this->load->model(array('user_model'));
		$featureTeacherPerCount = 2;
		$_data = $this->input->_requestAll();
		
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		 $this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('916', $multi_lang);
		$exp = $arrVal[$multi_lang];
		
		if($_data['keyword'] == $exp){
			$_data['keyword'] = '';
		}
		if($_data['langInput2'] == '0' ){
			$_data['langInput2'] = 'English';
		}
		// SKVIRJA checks for existing email id using keyword search
		$_data['searchBy'] = 'keyword'; 
		if($_data['keyword'] != ''){
			$emailExistsByKeyword = $this->user_model->getEmail($_data['keyword']);
			if($emailExistsByKeyword){
				$_data['searchBy'] = 'email'; 
			}else{
				$_data['searchBy'] = 'keyword'; 
			}
		}
		$this->load->model(array('location_model','langs_model','search_model'));
		if($this->session->userdata('free_session') == 'y' ){
			$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
			$_data['freeSes'] = 'y';
			$_data['freeSesUser'] = 'y';
		}else{
			if(strlen($_data['freeSes']) > 0){	
				$featureTeachers = $this->search_model->getFreeFetureTeacherLessons();
			}else{
				$featureTeachers = $this->search_model->getFetureTeacherLessons();
			}
		}
		$featureTeachersCount = count($featureTeachers);
		//echo "<pre>";print_r($featureTeachers);die();
		$searchData = $this->search_model->getResult($_data);
		
		//echo "<pre>";print_r($searchData);die();
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;
		$searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		$data['perPageMap'] = $perpage =isset($_data['perPageMap']) ? $_data['perPageMap'] : 6;
		$data['totalCount'] = count($searchData) + $featureTeacherPerCount * ceil (count($searchData)/($perpage-$featureTeacherPerCount)) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$perpage -= 2; 
		$startRow = ($page-1)*$perpage;
		$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		if($featureTeachersCount == 0){
		}else if($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount){
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		}else if($featureTeacherPerCount*$page > $featureTeachersCount){
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['rows']['feature'] =  array_slice($featureTeachers,($page-1)*$featureTeacherPerCount,$featureTeacherPerCount);
		$data['count'] = count($data['rows']['feature'])+count($data['rows']['result']);
		$data['count1'] =  count($searchData);
	     
		
		echo json_encode($data);
	}
	public function doSearchMapFeatured(){
		$featureTeacherPerCount = 2;
		$_data = $this->input->_requestAll();
		$this->load->model(array('location_model','langs_model','search_model'));
		$featureTeachers = $this->search_model->getFetureTeacherLessons();
		$featureTeachersCount = count($featureTeachers);
		$searchData = $this->search_model->getResult($_data);
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;
		$searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		$data['perPage'] = $perpage =isset($_data['perPage']) ? $_data['perPage'] : 6;
		$data['totalCount'] = count($searchData) + $featureTeacherPerCount * ceil (count($searchData)/($perpage-$featureTeacherPerCount)) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$perpage -= 2; 
		$startRow = ($page-1)*$perpage;
		$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		if($featureTeachersCount == 0){
		}else if($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount){
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		}else if($featureTeacherPerCount*$page > $featureTeachersCount){
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['rows']['feature'] =  array_slice($featureTeachers,($page-1)*$featureTeacherPerCount,$featureTeacherPerCount);
		$data['count'] = count($data['rows']['feature'])+count($data['rows']['result']);
		$data['count1'] =  count($searchData);
		$d = $data['rows']['result'];
		$lattmp = 0;
		$longtmp = 0;
		$ik = 0;
		foreach ($data['rows']['result'] as $newsuffledata)
		{
			$lat = $newsuffledata['Lat'];
			$long = $newsuffledata['Lng'];
			if(($lat - $lattmp) <= 1){
				$lat = $lat + 2;
			}
			if(($long - $longtmp) <= 1){
				$long = $longtmp + 2;
			}
			$lattmp = $lat;
			$longtmp= $long;
			$replacement=rand(40000,1000000000);
			$lat=substr($lat, 0, -6).$replacement;  
			$long=substr($long, 0, -6).$replacement;  
			$data['rows']['result'][$ik]['Lat'] =  $lat;
			$data['rows']['result'][$ik]['Lng'] =  $long;
		}
		echo json_encode($data);
	}
	//--T9_Get Profile Details
	/**
	 * @param user id
	 * @return profile
	 */
	public function getCname($cId){
		$sql = "SELECT country FROM countries WHERE id= ".$cId;
		$query 			= $this->db->query($sql);
		$resultCountry  = $query->result_array();
		return $resultCountry[0]['country'];
	}
	public function getPname($pId){
		$sql = "SELECT provice FROM provices WHERE id= ".$pId;
		$query 			= $this->db->query($sql);
		$resultProvice  = $query->result_array();
		return $resultProvice[0]['provice'];
	}
	// ------------------------------------------
	// converts a string with a stret address
	// into a couple of lat, long coordinates.
	// ------------------------------------------
	public function getLatLong($id , $address){
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    $_url = sprintf('https://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	    $_result = false;
	    if($_result = file_get_contents($_url)) {
	        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
	        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
			$_coords['lat'] = $_match[1];
	        $_coords['long'] = $_match[2];
		}
		$sql 		= "UPDATE profile set Lat ='{$_coords['lat']}' , Lng='{$_coords['long']}' WHERE uid= '{$id}'";
		$query 		= $this->db->query($sql);
	}
	public function getUserProfile(){
		$_data = $this->input->_requestAll();
		$userid = $_data['user_id']	;
		$sql = "SELECT country ,province ,city  FROM profile WHERE uid= ".$userid;
		$query 			= $this->db->query($sql);
		$resultUser     = $query->result_array();
		$dataUser = array();
		$dataUser['country'] 	= $this->getCname($resultUser[0]['country']);
		$dataUser['province'] 	= $this->getPname($resultUser[0]['province']);
		$dataUser['city'] 		= $resultUser[0]['city'];
		$addressString = $dataUser['city'].",".$dataUser['province'].",".$dataUser['country'];
		$coords = $this->getLatLong($userid , $addressString);
		echo json_encode($cords);
	}
	//--T9_Get Profile Details
	public function storeL(){
		$udata 		= $this->input->_requestAll();
		$userid 	= $udata['user_id'];
		$lat 		= $udata['lat'];
		$long 		= $udata['long'];
		$get = "SELECT Lat FROM profile WHERE Lat IS NULL AND uid= ".$userid;
		$query = $this->db->query($get);
		if ($query->num_rows() <= 0) {
			$replacement=rand(40000,1000000000);
			$lat=substr($lat, 0, -6).$replacement;  
			$long=substr($long, 0, -6).$replacement;  
			$sql 		= "UPDATE profile SET Lat =".$lat.", Lng=".$long." WHERE uid= ".$userid;
			$query 		= $this->db->query($sql);	
			json_encode($sql);
		}
		echo $get;
	}
	public function getL(){
		$udata 		= $this->input->_requestAll();
		$sql = "SELECT id,uid,firstName,midName,lastName,country,province,city,Lat,Lng,hRate  FROM profile WHERE uid= ".$udata['user_id'];
		$query 			= $this->db->query($sql);
		$resultUser     = $query->result_array();
		echo json_encode($resultUser);
		return $resultUser;
	}
	public function getHIS(){
		$cid =  $this->input->_request('cid');
		if($cid){
			$sql = "SELECT p.id,p.uid,p.firstName,p.midName,p.lastName,c.country,pr.provice as provice ,p.city,p.Lat,p.Lng,p.hRate,p.pic  FROM profile as p ,provices as pr, countries c WHERE p.country = c.id AND p.province = pr.id AND p.uid IN ( ".$cid.")";
			$query 			= $this->db->query($sql);
			$resultUser     = $query->result_array();
			$data = array();
			$data['rows']['result'] = $resultUser;
		}else{
			$data['rows']['result'] = '';
		}
		echo json_encode($data);
		return $data;
	}
	/**
	* @author Techno-Sanjay 
	* @ package  video search
	* @ param  date 14 Aug 2013
	**/
	public function videosearch_old(){
		$this->layout->setLayoutData('linkAttr','videosearch');
		$this->load->model(array('location_model','langs_model','search_model','profile_model'));
		$langs= $this->langs_model->getLangs(2);
		$langsAll2= $this->langs_model->getLangs();
		if(isset($langsAll2['A'])) {
			$langsAll2['A'][0] = 'Optional:2nd language';
			ksort($langsAll2['A']);
		}else{
			$langsAll2['A'] = array('0'=>'Optional:2nd language');
			ksort($langsAll2);
		}
		$langsAll= $this->langs_model->getLangs();
		// create a session array for selected values
		$sessionSearchData = array();
		if($this->session->userdata('langInput1')){
			$sessionSearchData['langInput1Selected'] = $this->session->userdata('langInput1');
			$this->session->unset_userdata('langInput1');
		}
		if($this->session->userdata('langInput2')){
			$sessionSearchData['langInput2Selected'] = $this->session->userdata('langInput2');
			$this->session->unset_userdata('langInput2');
		}
		if($this->session->userdata('hRateEnd')){
			$sessionSearchData['hRateEndSelected'] = $this->session->userdata('hRateEnd');
			$this->session->unset_userdata('hRateEnd');
		}
		if($this->session->userdata('gender')){
			$sessionSearchData['genderSelected'] = $this->session->userdata('gender');
			$this->session->unset_userdata('gender');
		}
		if($this->session->userdata('country')){
			$sessionSearchData['countrySelected'] = $this->session->userdata('country');
			$this->session->unset_userdata('country');
		}
		if($this->session->userdata('province')){
			$sessionSearchData['provinceSelected'] = $this->session->userdata('province');
			$this->session->unset_userdata('province');
		}
		if($this->session->userdata('online')){
			$sessionSearchData['onlineSelected'] = $this->session->userdata('online');
			$this->session->unset_userdata('online');
		}
		if($this->session->userdata('keyword')){
			$sessionSearchData['keywordSelected'] = $this->session->userdata('keyword');
			$this->session->unset_userdata('keyword');
		}
		if($this->session->userdata('keydisplay')){
			$sessionSearchData['keydisplaySelected'] = $this->session->userdata('keydisplay');
			$this->session->unset_userdata('keydisplay');
		}
		if($this->session->userdata('page')){
			$sessionSearchData['pageSelected'] = $this->session->userdata('page');
			$this->session->unset_userdata('page');
		}
		if($this->session->userdata('perPage')){
			$sessionSearchData['perPageSelected'] = $this->session->userdata('perPage');
			$this->session->unset_userdata('perPage');
		}
		if($this->session->userdata('last_toefl_score')){
			$sessionSearchData['last_toefl_scoreSelected'] = $this->session->userdata('last_toefl_score');
			$this->session->unset_userdata('last_toefl_score');
		}
		if($this->session->userdata('last_toiec_score')){
			$sessionSearchData['last_toiec_scoreSelected'] = $this->session->userdata('last_toiec_score');
			$this->session->unset_userdata('last_toiec_score');
		}
		if($this->session->userdata('fltr_business')){
			$sessionSearchData['fltr_businessSelected'] = $this->session->userdata('fltr_business');
			$this->session->unset_userdata('fltr_business');
		}
		if($this->session->userdata('fltr_medical')){
			$sessionSearchData['fltr_medicalSelected'] = $this->session->userdata('fltr_medical');
			$this->session->unset_userdata('fltr_medical');
		}
		if($this->session->userdata('fltr_finance')){
			$sessionSearchData['fltr_financeSelected'] = $this->session->userdata('fltr_finance');
			$this->session->unset_userdata('fltr_finance');
		}
		if($this->session->userdata('fltr_software')){
			$sessionSearchData['fltr_softwareSelected'] = $this->session->userdata('fltr_software');
			$this->session->unset_userdata('fltr_software');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);
		$price = array();
		$i = 0;
		while($i<= 100){
			$price[$i] = $i;
			if($i<50){
				$i = $i+5;
			}else if($i<100){
				$i = $i+10;
			}else {
				$i = $i+100;
			}
		}
		
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		 $this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('907', $multi_lang);
		$uncost = $arrVal[$multi_lang];

		$price[$i] = $uncost;
		$this->search_model->getOnlineUser();
		$countries= $this->location_model->getCountries();
		if(isset($countries['A'])) {
			$countries['A'][0] = 'All Countries';
			ksort($countries['A']);
		}else{
			$countries['A'] = array('0'=>'All Countries');
			ksort($countries);
		}
		$cidP =  2;
		$provinces = $this->location_model->getProvices($cidP);
		$provinces[0] = 'All States';
		ksort($provinces);
		// checks for delted events to revert free session
		if($this->session->userdata('uid')){
			if($this->session->userdata('roleId') == '0'){
				$updateUserSessionData = array();
				$getUserSessionByDb = $this->profile_model->getProfile($this->session->userdata('uid'));
				$updateUserSessionData['free_session'] = $getUserSessionByDb['free_session'];
				$updateUserSessionData['firstTime'] = 'y';
				$this->session->set_userdata($updateUserSessionData);
			}
		}
		$this->layout->setData('langs',$langs);
		$this->layout->setData('langsAll',$langsAll);
		$this->layout->setData('langsAll2',$langsAll2);
		$this->layout->setData('price',$price);
		$this->layout->setData('countries',$countries);
		$this->layout->setData('provinces',$provinces);
		$config = $this->location_model->getConfig();
		$this->layout->setData('config',$config);
		$this->load->helper('form');
		$this->layout->view('search/videosearch');
	}

	public function videosearch(){
		/*echo "<pre>";
		print_r($_GET['v']);
		exit;*/
		
		$sessionSearchData = array();
		if($this->session->userdata('langInput1')){
			$sessionSearchData['langInput1'] = $this->session->userdata('langInput1');
			$this->session->unset_userdata('langInput1');
		}
		if($this->session->userdata('keywords') or $this->input->get('keywords')){
			$sessionSearchData['keywords'] = $this->input->get('keywords');
			$this->session->unset_userdata('keywords');
		}
		if($this->session->userdata('sortKeys') or $this->input->get('sortKeys')){
			$sessionSearchData['sortKeys'] = $this->input->get('sortKeys');
			$this->session->unset_userdata('sortKeys');
		}
		
		$this->layout->setData('sessionSearchData',$sessionSearchData);

		$this->layout->setLayoutData('linkAttr','videosearch');
		$this->load->model(array('lesson_model'));

		if($this->session->userdata('toTime')){
			$sessionSearchData['toTimeSelected'] = $this->session->userdata('toTime');
			$this->session->unset_userdata('toTime');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);

		if(isset($_GET)){
			//print_r($_GET);
			$_data = $this->input->_requestAll();
			$lessons = $this->lesson_model->getAllSession($_data);
		}else{
			$lessons = $this->lesson_model->getAllSession();
		}
		
		if($_GET['v']){
			$vid = $_GET['v'];
			$playlesson = $this->lesson_model->getPlaylesson($vid);
			$result=$this->lesson_model->UpdateViewCounter($vid);

			$tutorprofile = $this->profile_model->getTutorProfile($playlesson['uid']);
		}
		// create a session array for selected values
		
		$this->layout->setData('lessons',$lessons);
		$this->layout->setData('playlesson',$playlesson);
		$this->layout->setData('tutorprofile',$tutorprofile);
	
		$this->layout->view('search/videosearch');
		exit;
	}
	
	public function videosearchmore(){
		
		/*echo "<pre>";
		print_r($_GET['v']);
		exit;*/
		
		$sessionSearchData = array();
		if($this->session->userdata('langInput1')){
			$sessionSearchData['langInput1Selected'] = $this->session->userdata('langInput1');
			$this->session->unset_userdata('langInput1');
		}
		if($this->session->userdata('keywords') or $this->input->get('keywords')){
			$sessionSearchData['keywords'] = $this->input->get('keywords');
			$this->session->unset_userdata('keywords');
		}
		if($this->session->userdata('sortKeys') or $this->input->get('sortKeys')){
			$sessionSearchData['sortKeys'] = $this->input->get('sortKeys');
			$this->session->unset_userdata('sortKeys');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);

		$this->layout->setLayoutData('linkAttr','videosearch');
		$this->load->model(array('lesson_model'));

		if($this->session->userdata('toTime')){
			$sessionSearchData['toTimeSelected'] = $this->session->userdata('toTime');
			$this->session->unset_userdata('toTime');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);

		if(isset($_GET)){
			//print_r($_GET);
			$_data = $this->input->_requestAll();
			$lessons = $this->lesson_model->getAllSession($_data);
		}else{
			$lessons = $this->lesson_model->getAllSession();
		}

		//print_r($lessons);
		if($_GET['v']){
			$vid = $_GET['v'];
			$playlesson = $this->lesson_model->getPlaylesson($vid);
			$result=$this->lesson_model->UpdateViewCounter($vid);
		}

		// create a session array for selected values
		//print_r($lessons);
		$this->layout->setData('lessons',$lessons);
		$this->layout->view('search/videosearchmore');
		exit;
	}

	public function doVideoSearch(){
		$this->load->model(array('user_model'));
		$featureTeacherPerCount = 2;
		$_data = $this->input->_requestAll();
		//print_r($_data);
		// TECHNO-SANJAY checks for default keyword
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('916', $multi_lang);
		$exp = $arrVal[$multi_lang];

		
		if($_data['keyword'] == $exp){
			$_data['keyword'] = '';
		}
		if($_data['author'] == $exp){
			$_data['keyword'] = '';
		}
		$this->load->model(array('location_model','langs_model','search_model'));
		if($_data['langInput2'] == '0' ){
			$_data['langInput2'] = 'English';
		}
		$featureTeachers = $this->search_model->getFetureTeacherLessons();
		$featureTeachersCount = count($featureTeachers);
		$searchData = $this->search_model->getVideoResult1($_data);
		//print_r($searchData);
		//exit;
		if(count($searchData)<=0){
			$featureTeachersCount = 0;
			unset($featureTeachers); 
			$featureTeachers = array();
		}
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;
		$searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		$data['perPage'] = $perpage =isset($_data['perPage']) ? $_data['perPage'] : 6;
		$data['totalCount'] = count($searchData) * ceil (count($searchData)/($perpage)) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$perpage -= 2; 
		$startRow = ($page-1)*$perpage;
		$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		$featureTeachersCount = 0;
		if($featureTeachersCount == 0){
		}else if($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount){
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		}else if($featureTeacherPerCount*$page > $featureTeachersCount){
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['count'] = count($data['rows']['result']);
		$data['count1'] =  count($searchData);
		echo json_encode($data);
	}
	
	public function nowtalksearch(){
	
	
	if(!$this->session->userdata('username')){
			if($this->session->userdata('email')){
				$this->session->set_userdata(array('username'=>$this->session->userdata('email')));
				redirect('search/search');
			}
		}
		
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		 $this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('906', $multi_lang);
		$secondlang = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('907', $multi_lang);
		$ucost = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('908', $multi_lang);
		$allcntry = $arrVal[$multi_lang];
		
		
		$this->layout->setLayoutData('linkAttr','search');
		$this->load->model(array('location_model','langs_model','search_model','profile_model'));
		$langs= $this->langs_model->getLangs(2);
		// TECHNO-SANJAY added new language array for display languages on search page
		$langsAll2= $this->langs_model->getLangs();
		if(isset($langsAll2['A'])) {
			$langsAll2['A'][0] = $secondlang;
			ksort($langsAll2['A']);
		}else{
			$langsAll2['A'] = array('0'=>$secondlang);
			ksort($langsAll2);
		}
		$langsAll= $this->langs_model->getLangs();
		// create a session array for selected values
		
		// echo @$this->session->userdata('readytotalk');exit;
	//	echo  $this->session->userdata('anytutor');exit;
		
		$sessionSearchData = array();
		if($this->session->userdata('langInput1')){
			$sessionSearchData['langInput1Selected'] = $this->session->userdata('langInput1');
			$this->session->unset_userdata('langInput1');
		}
		if($this->session->userdata('langInput2')){
			$sessionSearchData['langInput2Selected'] = $this->session->userdata('langInput2');
			$this->session->unset_userdata('langInput2');
		}
		if($this->session->userdata('hRateEnd')){
			$sessionSearchData['hRateEndSelected'] = $this->session->userdata('hRateEnd');
			$this->session->unset_userdata('hRateEnd');
		}
		if($this->session->userdata('gender')){
			$sessionSearchData['genderSelected'] = $this->session->userdata('gender');
			$this->session->unset_userdata('gender');
		}
		if($this->session->userdata('country')){
			$sessionSearchData['countrySelected'] = $this->session->userdata('country');
			$this->session->unset_userdata('country');
		}
		if($this->session->userdata('province')){
			$sessionSearchData['provinceSelected'] = $this->session->userdata('province');
			$this->session->unset_userdata('province');
		}
		if($this->session->userdata('online')){
			$sessionSearchData['onlineSelected'] = $this->session->userdata('online');
			$this->session->unset_userdata('online');
		}
		if($this->session->userdata('keyword')){
			$sessionSearchData['keywordSelected'] = $this->session->userdata('keyword');
			$this->session->unset_userdata('keyword');
		}
		if($this->session->userdata('keydisplay')){
			$sessionSearchData['keydisplaySelected'] = $this->session->userdata('keydisplay');
			$this->session->unset_userdata('keydisplay');
		}
		if($this->session->userdata('page')){
			$sessionSearchData['pageSelected'] = $this->session->userdata('page');
			$this->session->unset_userdata('page');
		}
		if($this->session->userdata('perPage')){
			$sessionSearchData['perPageSelected'] = $this->session->userdata('perPage');
			$this->session->unset_userdata('perPage');
		}
		if($this->session->userdata('last_toefl_score')){
			$sessionSearchData['last_toefl_scoreSelected'] = $this->session->userdata('last_toefl_score');
			$this->session->unset_userdata('last_toefl_score');
		}
		if($this->session->userdata('last_toiec_score')){
			$sessionSearchData['last_toiec_scoreSelected'] = $this->session->userdata('last_toiec_score');
			$this->session->unset_userdata('last_toiec_score');
		}
		if($this->session->userdata('fltr_business')){
			$sessionSearchData['fltr_businessSelected'] = $this->session->userdata('fltr_business');
			$this->session->unset_userdata('fltr_business');
		}
		if($this->session->userdata('fltr_medical')){
			$sessionSearchData['fltr_medicalSelected'] = $this->session->userdata('fltr_medical');
			$this->session->unset_userdata('fltr_medical');
		}
		if($this->session->userdata('fltr_finance')){
			$sessionSearchData['fltr_financeSelected'] = $this->session->userdata('fltr_finance');
			$this->session->unset_userdata('fltr_finance');
		}
		if($this->session->userdata('fltr_software')){
			$sessionSearchData['fltr_softwareSelected'] = $this->session->userdata('fltr_software');
			$this->session->unset_userdata('fltr_software');
		}
		if($this->session->userdata('readytotalk')){
			$sessionSearchData['readytotalknowSelected'] = $this->session->userdata('readytotalk');
			$this->session->unset_userdata('readytotalk');
		}
		
		
		
		if($this->session->userdata('anytutor')){
			$sessionSearchData['anytutorSelected'] = false;
			$this->session->unset_userdata('anytutor');
		}
		if($this->session->userdata('datetime')){
			$sessionSearchData['datetimeSelected'] = $this->session->userdata('datetime');
			$this->session->unset_userdata('datetime');
		}
		if($this->session->userdata('today')){
			$sessionSearchData['todaySelected'] = $this->session->userdata('today');
			$this->session->unset_userdata('today');
		}
		if($this->session->userdata('fromTime')){
			$sessionSearchData['fromTimeSelected'] = $this->session->userdata('fromTime');
			$this->session->unset_userdata('fromTime');
		}
		if($this->session->userdata('toTime')){
			$sessionSearchData['toTimeSelected'] = $this->session->userdata('toTime');
			$this->session->unset_userdata('toTime');
		}
		$this->layout->setData('sessionSearchData',$sessionSearchData);
		$price = array();
		$i = 0;
		while($i<= 100){
			$price[$i] = $i;
			if($i<50){
				$i = $i+5;
			}else if($i<100){
				$i = $i+10;
			}else {
				$i = $i+100;
			}
		}
		$price[50000] = $ucost;
		$countries= $this->location_model->getCountries();
		if(isset($countries['A'])) {
			$countries['A'][0] = $allcntry;
			ksort($countries['A']);
		}else{
			$countries['A'] = array('0'=>$allcntry);
			ksort($countries);
		}
		$countries['A'][2] = 'USA';
		ksort($countries['A']);
		unset($countries['U'][2]);
		$cidP =  2;
		$provinces = $this->location_model->getProvices($cidP);
		$provinces[0] = 'All States';
		ksort($provinces);
		// checks for delted events to revert free session
		$cellNumber = '';
		if($this->session->userdata('uid')){
			if($this->session->userdata('roleId') == '0'){
				$updateUserSessionData = array();
				$getUserSessionByDb = $this->profile_model->getProfile($this->session->userdata('uid'));
				//$updateUserSessionData['free_session'] = $getUserSessionByDb['free_session'];
				
				//added by haren new scope
				
				$q= "SELECT exp_session,is_eligible from user where  user.id='{$uid}' AND user.exp_session >='{$currenttime}' AND is_eligible=1 AND roleid=0";
				$query = $this->db->query($q);
				$resultmoney = 0;
				if ($query->num_rows() > 0) 
				{
					$updateUserSessionData['free_session'] ='y';
				}
				else
				{
					$updateUserSessionData['free_session'] ='n';
				}
				$updateUserSessionData['firstTime'] = 'y';
				$this->session->set_userdata($updateUserSessionData);
				$cellNumber = $getUserSessionByDb['cell'];
			}
		}
		//print_r($sessionSearchData);exit;
		$nowtalk=true;
		$this->layout->setData('nowtalk',$nowtalk);	
		$this->layout->setData('cellNumber',$cellNumber);	
		$this->layout->setData('langs',$langs);
		$this->layout->setData('langsAll',$langsAll);
		$this->layout->setData('langsAll2',$langsAll2);
		$this->layout->setData('price',$price);
		$this->layout->setData('countries',$countries);
		$this->layout->setData('provinces',$provinces);
		$config = $this->location_model->getConfig();
		$this->layout->setData('config',$config);
		$this->load->helper('form');
		$this->layout->view('search/search');
	}
	
	//search tutor for school added by haren
	
	public function SerchTutor(){
		$this->load->model(array('user_model'));
		$featureTeacherPerCount = 2;
		$_data = $this->input->_requestAll();
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['multi_lang']))
			{
				$multi_lang = $_SESSION['multi_lang'];
			}
			else
			{
				$multi_lang = 'en';	
			}
	
		 $this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('916', $multi_lang);
		$exp = $arrVal[$multi_lang];	
		$this->session->set_userdata($_data);
		if($_data['keyword'] == $exp){
			$_data['keyword'] = '';
		}
		$this->load->model(array('location_model','langs_model','search_model'));
		
		if($_data['langInput2'] == '0' ){
			$_data['langInput2'] = 'English';
		}
		
		$_data['searchBy'] = 'keyword'; 
		if($_data['keyword'] != ''){
			$emailExistsByKeyword = $this->user_model->getEmail($_data['keyword']);
			if($emailExistsByKeyword){
				$_data['searchBy'] = 'email'; 
			}else{
				$_data['searchBy'] = 'keyword'; 
			}
		}
		
		if($this->session->userdata('free_session') == 'y' ) {
			$featureTeachers = $this->search_model->getAllData();
			$_data['freeSes'] = 'y';
			$_data['freeSesUser'] = 'y';
			
		}else{
		   $featureTeachers = $this->search_model->getAllData();
			$_data['freeSes'] = 'y';
			$_data['freeSesUser'] = 'y';
			
		}

		
		$featureTeachersCount = count($featureTeachers);

		 $searchData = $this->search_model->getResult($_data);
    /*     $searchData = array();
	if(count($searchData)<=0){
			$featureTeachersCount = 0;
			unset($featureTeachers); 
			$featureTeachers = array();
		}*/
		$sortKey = (isset($_data['sort']) && $_data['sort']!='')?$_data['sort']:'hRate';
		$sortAsc = isset($_data['sortAsc']) ?$_data['sortAsc']:0;
		// $searchData =  $this->uasortFunction($searchData,$sortKey,$sortAsc);
		$data['perPage'] = $perpage =isset($_data['perPage']) ? $_data['perPage'] : 6;
		$data['totalCount'] = count($searchData) + $featureTeacherPerCount * ceil (count($searchData)/($perpage-$featureTeacherPerCount)) ;
		$data['page'] = $page = isset($_data['page']) ? $_data['page'] : 1;
		$perpage -= 2; 
		$startRow = ($page-1)*$perpage;
		$rowCount = ($startRow + $perpage) > count($searchData)?count($searchData) - $startRow:$perpage;
		$data['rows']['result'] =  array_slice($searchData,$startRow,$rowCount);
		if($featureTeachersCount == 0){
		}else if($featureTeacherPerCount*($page-1) < $featureTeachersCount && $featureTeacherPerCount*$page > $featureTeachersCount){
			$featureTeachers = array_merge($featureTeachers,$featureTeachers);
		}else if($featureTeacherPerCount*$page > $featureTeachersCount){
			$page = $page % ceil($featureTeachersCount / $featureTeacherPerCount) +1;
		}
		$data['rows']['feature'] =  array_slice($featureTeachers,($page-1)*$featureTeacherPerCount,$featureTeacherPerCount);
		$data['count'] = count($data['rows']['feature'])+count($data['rows']['result']);
		$data['count1'] =  count($searchData);
		  //print_r(count($searchData));die();
		echo json_encode($data); 
	}
	
	function cool(){
		
    $text = "Hello <br /> Hello again <br> Hello again again <br/> Goodbye <BR>";
    $breaks = array("<br />","<br>","<br/>");  
    $text = str_ireplace($breaks, "\r\n", $text);  

	echo "<textarea>".$text."</textarea>";
	}
	
	function download(){
		$file_name = "images/header.jpg";
		// make sure it's a file before doing anything!
		
		if(is_file($file_name)) {
			// required for IE
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}

			// get the file mime type using the file extension
			switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
				case 'pdf': $mime = 'application/pdf'; break;
				case 'zip': $mime = 'application/zip'; break;
				case 'jpeg':
				case 'jpg': $mime = 'image/jpg'; break;
				default: $mime = 'application/force-download';
			}
			header('Pragma: public'); 	// required
			header('Expires: 0');		// no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($file_name));	// provide file size
			header('Connection: close');
			readfile($file_name);		// push it out
			exit();
		}
	}
	
	function download1(){
		$this->load->helper('download');
		$data = 'Here is some text!';
		$name = 'mytext.txt';
		//force_download($name, $data);
		force_download('images/header.jpeg',NULL);
	}
	
	// Update AvgRating on Profile Table
	public function cronAvgRating() {
		$this->search_model->updateAvgRating();
		return;
	}
	
	public function incVideoLike(){
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin) {
			$msg = "0";
		}else{
			$vid = $this->input->post('vid');
			$uid = $this->session->userdata('uid');

			$fsql = "SELECT * FROM video_likes where uid = ".$uid." AND vid = ".$vid;
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();			
			if(count($fresult) == 0){
				$result=$this->lesson_model->UpdateLikeCounter($vid, $uid);
			}
			$msg = "1";
		}

		echo $msg;
	}

	public function incVideoView(){
		$vid = $this->input->post('vid');
		$result=$this->lesson_model->UpdateViewCounter($vid);
		json_encode($result);
		die();
	}
}
/* End of file search.php */
/* Location: ./application/controllers/search.php */