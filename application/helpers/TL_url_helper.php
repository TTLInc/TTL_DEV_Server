<?php
/*$multi_lang = 'en';
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
$CI =& get_instance();
$this->load->model(array('lookup_model'));
$arrVal = $CI->lookup_model->getValue('3', $multi_lang);
*/
 
   
function tl_url($uri,$uid=''){
	if($uid!='' && $uid > 0){
		$uri .= '/uid/'.$uid;
	}
	return Base_url($uri);
}

function profile_image($pic){
	if(!$pic || $pic ==''){
		return Base_url('images/header.jpg');
	}
	return Base_url('/uploads/images/thumb/'.$pic);
}


function profile_video($source,$type="image"){
  
	if(!$source || $source ==''){
		if($type == 'image'){
			return  Base_url("images/intro.png");
		}
		else { 
			return Base_url("vedio/intro_yellow.mp4");
		}
	}
	else {
		if($type == 'image'){
			return  Base_url("uploads/video/images/{$source}.jpg");
		}
		else if($type == ''){
			return Base_url("uploads/video/{$source}");
		}
		else {
			return Base_url("uploads/video/{$source}.{$type}");
		}
	}
	//return Base_url('/uploads/images/thumb/'.$source);
}


function myprofile_video($source,$type="image"){
	if(!$source || $source ==''){
		if($type == 'image'){
			return  Base_url("images/intro_12.png");
		}
		else {
			return Base_url("video/intro.mp4");
		}
	}
	else {
		if($type == 'image'){
			return  Base_url("uploads/video/images/{$source}.jpg");
		}
		else if($type == ''){
			return Base_url("uploads/video/{$source}");
		}
		else {
			return Base_url("uploads/video/{$source}.{$type}");
		}
	}
	//return Base_url('/uploads/images/thumb/'.$source);
}

function profile_menu($type,$now,$uid='',$topmenu=false){ 

	// Get a reference to the controller object
    $CI =& get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('lookup_model');
	
	$multi_lang = (isset($_SESSION['multi_lang'])) ? $_SESSION['multi_lang'] : "en";
    
	// Call a function of the model
	$arrVal = $CI->lookup_model->getValue('259', $multi_lang); 
	$lngMnuDashboard = $arrVal[$multi_lang]; // Dashboard
	
	$arrVal = $CI->lookup_model->getValue('195', $multi_lang);
	$lngMnuProfile = $arrVal[$multi_lang]; // Profile
	
	$arrVal = $CI->lookup_model->getValue('1092', $multi_lang);
	$lngMnuMyBookings = $arrVal[$multi_lang]; // My Bookings
	
	$arrVal = $CI->lookup_model->getValue('444', $multi_lang);
	$lngMnuBeepbox = $arrVal[$multi_lang]; // Beepbox
	
	$arrVal = $CI->lookup_model->getValue('1054', $multi_lang);
	$lngMnuVideos = $arrVal[$multi_lang]; // Recorded Videos
	
	$arrVal = $CI->lookup_model->getValue('1369', $multi_lang);
	$lngMnuPO = $arrVal[$multi_lang]; // Payment Options
	
	$arrVal = $CI->lookup_model->getValue('777', $multi_lang);
	$lngMnuHistory = $arrVal[$multi_lang]; // History
	
	$arrVal = $CI->lookup_model->getValue('1370', $multi_lang);
	$lngMnuMyTutors = $arrVal[$multi_lang]; // My Tutors
	
	$arrVal = $CI->lookup_model->getValue('1371', $multi_lang);
	$lngMnuTeachers = $arrVal[$multi_lang]; // Teachers
	
	$arrVal = $CI->lookup_model->getValue('1372', $multi_lang);
	$lngMnuSendMessage = $arrVal[$multi_lang]; // Send Message
	
	$arrVal = $CI->lookup_model->getValue('713', $multi_lang);
	$lngMnuSettings = $arrVal[$multi_lang]; // Settings
	
	$staticMenu['s_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/dashboard','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/calendar','class'=>'c_prof','text'=>$lngMnuMyBookings)	,
		array('uri'=>'user/teachers','class'=>'t_prof','text'=>$lngMnuMyTutors)	,
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>$lngMnuBeepbox)	,
		array('uri'=>'user/lessons','class'=>'a_prof','text'=>$lngMnuVideos)	,
		array('uri'=>'user/account','class'=>'p_prof','text'=>$lngMnuPO),
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)	
	);
	if ($topmenu==true) {
		array_push($staticMenu['s_private'],array('uri'=>'user/changeInfo','class'=>'h_prof','text'=>$lngMnuSettings));
	}
	$staticMenu['s_public'] = array(
		array('uri'=>'user/teachers','class'=>'t_prof','text'=>$lngMnuTeachers)	,
		array('uri'=>'user/send_message','class'=>'i_prof','text'=>$lngMnuSendMessage),
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)
	);
	$staticMenu['t_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/dashboard','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/profile','class'=>'p_prof','text'=>$lngMnuProfile)	,
		array('uri'=>'user/calendar','class'=>'c_prof','text'=>$lngMnuMyBookings)	,
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>$lngMnuBeepbox)	,
		
		array('uri'=>'user/lessons','class'=>'l_prof','text'=>$lngMnuVideos)	,
		array('uri'=>'user/account','class'=>'a_prof','text'=>$lngMnuPO)	,
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)
	);
	$staticMenu['sc_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/organization','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/members','class'=>'p_prof','text'=>'My Members')	,
		array('uri'=>'user/promotion_links','class'=>'c_prof','text'=>'Promotions')	,
		array('uri'=>'user/Advertisements','class'=>'i_prof','text'=>'Advertisements')
	);
	$staticMenu['aff_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/dashboard','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/affiliateMembers','class'=>'p_prof','text'=>'My Members')	,
		array('uri'=>'user/affiliatePromotionLinks','class'=>'c_prof','text'=>'Promotions')
	);
	if ($topmenu==true) {
		array_push($staticMenu['t_private'],array('uri'=>'user/changeInfo','class'=>'h_prof','text'=>$lngMnuSettings));
	}
	$staticMenu['t_public'] = array(
		/*array('uri'=>'user/profile','class'=>'p_prof','text'=>'Profile')	,
		 
		array('uri'=>'user/lessons','class'=>'l_prof','text'=>'Lessons')	,
		array('uri'=>'user/history','class'=>'h_prof','text'=>'History')*/
		 
	);
	
	
	if(substr($type, 0,1)=="t") {
		$teacherClass = 'teacher_prof';
	}
	else {
		$teacherClass = '';
	}
	if ($topmenu==false) {		
		$str = '<ul class="student_prof '.$teacherClass.'">';
	} else {
		$str = '<ul>';
	}
	 
	foreach($staticMenu[$type] as $k=>$v){
		$selectedClass = '';
		if($now == 'account'){
			if($teacherClass){
				$now = 'a_prof';
			}
			else{
				$now = 'p_prof';
			}
		}
		
		if($v['class'] == $now) {
			$selectedClass = 'prof_on';
		}
		if ($topmenu==false) {	
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class="'.$v['class'].' '.$selectedClass.'"><span>'.$v['text'].'</span></a></li>';
		} else {
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class=""><span>'.$v['text'].'</span></a></li>';
		}
	}
	$str .= '</ul>';
	return $str;
}

// organization menu haren
function organization_menu($type,$now,$uid=''){

	$staticMenu['o_private'] = array(
		// added a new dashboard link BY haren for organization
        array('uri'=>'user/organization','class'=>'p_dasb','text'=>'Dashboard')	,
		
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>'Inbox'),
		
		array('uri'=>'user/account','class'=>'a_prof','text'=>'Account'),
		array('uri'=>'user/history','class'=>'h_prof','text'=>'History'),
		array('uri'=>'user/Advertisements','class'=>'ad_prof','text'=>'addvertise')
	);
	
	if(substr($type, 0,1)=="o") {
		$teacherClass = 'teacher_prof';
	}
	else {
		$teacherClass = '';
	}
	$str = '<ul class="student_prof '.$teacherClass.'">';
	foreach($staticMenu[$type] as $k=>$v){
		$selectedClass = '';
		if($now == 'account'){
			if($teacherClass){
				$now = 'a_prof';
			}
			else{
				$now = 'p_prof';
			}
		}
		
		if($v['class'] == $now) {
			$selectedClass = 'prof_on';
		}
		//echo $v['class'];
		//echo $selectedClass;
		//die();
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class="'.$v['class'].' '.$selectedClass.'"><span>'.$v['text'].'</span></a></li>';
	}
	$str .= '</ul>';
	return $str;
}


//Affiliate menu haren
function Affiliate_menu($type,$now,$uid=''){

	$staticMenu['a_private'] = array(
		// added a new dashboard link BY haren for organization
        array('uri'=>'user/Affiliate','class'=>'p_dasb','text'=>'Dashboard')	,
		
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>'Inbox'),
		
		array('uri'=>'user/account','class'=>'a_prof','text'=>'Account'),
		array('uri'=>'user/history','class'=>'h_prof','text'=>'History'),
		array('uri'=>'user/Advertisements','class'=>'ad_prof','text'=>'addvertise')
	);
	
	if(substr($type, 0,1)=="a") {
		$teacherClass = 'teacher_prof';
	}
	else {
		$teacherClass = '';
	}
	$str = '<ul class="student_prof '.$teacherClass.'">';
	foreach($staticMenu[$type] as $k=>$v){
		$selectedClass = '';
		if($now == 'account'){
			if($teacherClass){
				$now = 'a_prof';
			}
			else{
				$now = 'p_prof';
			}
		}
		
		if($v['class'] == $now) {
			$selectedClass = 'prof_on';
		}
		//echo $v['class'];
		//echo $selectedClass;
		//die();
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class="'.$v['class'].' '.$selectedClass.'"><span>'.$v['text'].'</span></a></li>';
	}
	$str .= '</ul>';
	return $str;
}



function outTime($time,$localTimeZone='a') {
	if(!is_numeric($localTimeZone)){
		$CI =& get_instance();
		$localTimeZone = $CI->input->_request('localTimeZone');
		if($localTimeZone=="")
		{
			$localTimeZone = "+7";
		}
	}
	//$time = str_replace('12:','0:',$time);
	$time = strtotime($time);
	$time = $time - $localTimeZone*3600;
	return $time;
}

function hiaOutTime($time,$localTimeZone='a'){
	$date = date( 'h:i a, M d, Y' , outTime($time,$localTimeZone) );
	//$date = str_replace('12:','0:',$date);
	return $date;
}

function hiaOutTimedash($time,$localTimeZone='a'){
	$date = date( 'M. d-h:ia ' , outTime($time,$localTimeZone) );
	$ndate = explode("-",$date);
	$date = $ndate[0]."&nbsp;&nbsp;".$ndate[1];
	//$date = str_replace('12:','0:',$date);
	return $date;
}

function hrstosecond($time,$localTimeZone='a'){
	$date = date( 'h:i a' , outTime($time,$localTimeZone) );
	//$date = str_replace('12:','0:',$date);
	return $date;
}


function sec2min($sec){
	$min = floor($sec / 60);
	$sec = $sec % 60;
	$hour = 0;
	if($min > 60){
		$hour = floor($min  / 60);
		$min = $min % 60;
	}
	$str = '';
	if($hour > 0){
		$str .=  $hour.'hour ';
	}
	if($min > 0 || $hour > 0 ){
		$str .=  $min.'min ';
	}
	$str .=  $sec.'sec ';
	return $str;
}
function mailAptBtn($chkfreesession,$uid)
{
	
	if(isset($_SESSION['multi_lang'])){
		$multi_lang = $_SESSION['multi_lang'];
	}else{
		$multi_lang = 'en';	
	}
	$aptData = '<div class="btns">';
	 //$aptData .= '<a id="tt_beep_tip" title="Message this tutor." href="'.base_url().'user/send_message/id/'.$uid.'" ><span class="mail_span"><img src="'.Base_url('images/beepbox.png').'" alt="01" /></span></a>';
	if($chkfreesession == 'Yes'){
		//$aptData .= '<a id="tt_cr_app" title="View tutor\'s calendar to book session" href="'.base_url().'user/calendar/uid/'.$uid.'" ><span id="tutorCreAppBtn" class="app_span app_span2 req-app-nw" style="background:url(\'http://cdn-dev.thetalklist.com/images/btn-srch-02-bg.png\') no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;"></span></a>';
	//$aptData .= '<a    onclick="addToPotential('.$uid.')"  ><span id="tutorReqAppBtn" class="app_span req-app-nw "></span></a>';
	 if($multi_lang == 'ch'){
			$aptData .= '<span class="free-sesn serch-pop">免费会议<span class="classic free-sec-open">
            	<p>这个导师提供一个免费的会话(无需信用卡)</p>
                <p>选择任意一种方法</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>时间表</h2>
                     <h3>(从导师的日历未来的约会)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>现在谈</h2>
                     <h3>(如果绿色开始教训<br>在5分钟内)</h3>
                </div>
                
            </span></span>';
		}elseif($multi_lang == 'kr'){
			$aptData .= '<span class="free-sesn serch-pop">무료 세션 <span class="classic free-sec-open">
            	<p>이 교사는 무료 세션을 제공합니다 (無需信用卡)</p>
                <p>방법 중 하나를 선택</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>예정</h2>
                     <h3>(교사의 달력에서 미래의 약속)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>지금 이야기</h2>
                     <h3>(녹색 레슨을 시작하는 경우<br>오분의)</h3>
                </div>
                
            </span></span>';
		}elseif($multi_lang == 'jp'){
			$aptData .= '<span class="free-sesn serch-pop">無料のセッション<span class="classic free-sec-open">
            	<p>この教師は、無料のセッションを提供しています(不要クレジットカードません)</p>
                <p>どちらの方法を選択してください</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>スケジュール</h2>
                     <h3>(家庭教師のカレンダーからの将来の予定)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>今話します。</h2>
                     <h3>(緑色の始動レッスンの場合<br>5分で)</h3>
                </div>
                
            </span>span>';
		}elseif($multi_lang == 'pt'){
			$aptData .= '<span class="free-sesn serch-pop" style="font-size:12px;">SESSÃO GRÁTIS <span class="classic free-sec-open">
            	<p>Este tutor oferece uma sessão gratuita (nenhum cartão de crédito necessário)</p>
                <p>Escolha qualquer um dos métodos</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>Agendar</h2>
                     <h3>(futuras nomeações do calendário de tutor)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>Converse agora</h2>
                     <h3>(se lição início verde<br>em 5 minutos)</h3>
                </div>
                
            </span></span>';
		}elseif($multi_lang == 'tw'){
			$aptData .= '<span class="free-sesn serch-pop">免費會議 <span class="classic free-sec-open">
            	<p>這個導師提供一個免費的會話 (無需信用卡)</p>
                <p>選擇任意一種方法</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>時間表</h2>
                     <h3>(從導師的日曆未來的約會)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>現在談</h2>
                     <h3>(如果綠色開始教訓<br>在5分鐘內)</h3>
                </div>
                
            </span></span>';
		}elseif($multi_lang == 'es'){
			$aptData .= '<span class="free-sesn serch-pop" style="font-size:12px;">SESIÓN GRATUITA <span class="classic free-sec-open">
            	<p>Este tutor ofrece una sesión gratuita(no requiere tarjeta de crédito)</p>
                <p>Elegir uno u otro método</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>horario</h2>
                     <h3>(futuras citas de calendario del tutor)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>Hablar ahora</h2>
                     <h3>(si la lección de inicio verde<br>en 5 minutos)</h3>
                </div>
                
            </span></span>';
		}else{
			$aptData .= '<span class="free-sesn serch-pop">FREE SESSION 
			
			<span class="classic free-sec-open">
            	<p>This tutor offers a FREE session (no credit card required)</p>
                <p>Choose either method</p>
                <div class="scd-img one">
					<img src="'.Base_url('images/pop-img-cal.png').'" alt="01" />
                     <h2>Schedule</h2>
                     <h3>(future appointments from tutors calendar)</h3>
                </div>
                <div class="scd-img">
					<img src="'.Base_url('images/pop-img-hst.png').'" alt="01" />
                     <h2>Talk Now</h2>
                     <h3>(if green start lesson<br>in 5 minutes)</h3>
                </div>
                
            </span>
			
			
			
			</span>';
		}
	}else{
	}
	$aptData .= '</div>';
	return $aptData;
}
function sendmessage($uid,$f_n)
{
 $q="'";
 $url = base_url('/user/calendar/uid/'.$uid);
	$aptData = '<a onclick="sendBeepBoxMessage('.$uid.')"><span style="float:right;font-size:20px;" >SendMessage</span></a>';
     $aptData .= '<a onclick="bookNow('.$uid.','.$q.$f_n.$q.')"><span style="float:right;font-size:20px;" >Talk Now</span></a>';
	 $aptData .= '<a  href="'.$url.'"><span style="float:right;font-size:20px;" >Schedule</span></a>';
	return $aptData;
	
}

function getmeta()
{
	$CI =& get_instance();
	$CI->load->model(array('metatag_model'));
	if(isset($_SESSION['multi_lang']) and $_SESSION['multi_lang']!="en"){
		$multi_lang = $_SESSION['multi_lang'];
		$selData = $multi_lang."_title as `title`,".$multi_lang."_keywords as `keywords`,".$multi_lang."_descriptions as `descriptions`";
	}else{
		$multi_lang = 'en';	
		$selData = "`title`,`keywords`,`descriptions`";
	}
	$cUrl = current_url();
	$arrVal = $CI->metatag_model->selectData($selData, array("url"=>mysql_real_escape_string($cUrl)));
	ob_start();
	
	?>
	<meta name="description" content="<?php echo @$arrVal[0]['descriptions'];?>">
	<meta name="keywords" content="<?php echo @$arrVal[0]['keywords'];?>">
	<title><?php echo @$arrVal[0]['title'];?></title>
	<?php
	$meta = ob_get_contents();
	ob_clean();
	echo $meta;
}

function profile_menu_search_page($type,$now,$uid='',$topmenu=false){ 

	// Get a reference to the controller object
    $CI =& get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('lookup_model');
	
	$multi_lang = (isset($_SESSION['multi_lang'])) ? $_SESSION['multi_lang'] : "en";
    
	// Call a function of the model
	$arrVal = $CI->lookup_model->getValue('259', $multi_lang); 
	$lngMnuDashboard = $arrVal[$multi_lang]; // Dashboard
	
	$arrVal = $CI->lookup_model->getValue('195', $multi_lang);
	$lngMnuProfile = $arrVal[$multi_lang]; // Profile
	
	$arrVal = $CI->lookup_model->getValue('1092', $multi_lang);
	$lngMnuMyBookings = $arrVal[$multi_lang]; // My Bookings
	
	$arrVal = $CI->lookup_model->getValue('444', $multi_lang);
	$lngMnuBeepbox = $arrVal[$multi_lang]; // Beepbox
	
	$arrVal = $CI->lookup_model->getValue('1403', $multi_lang);
	$lngMnuVideos = $arrVal[$multi_lang]; // Recorded Videos
	
	$arrVal = $CI->lookup_model->getValue('1369', $multi_lang);
	$lngMnuPO = $arrVal[$multi_lang]; // Payment Options
	
	$arrVal = $CI->lookup_model->getValue('777', $multi_lang);
	$lngMnuHistory = $arrVal[$multi_lang]; // History
	
	$arrVal = $CI->lookup_model->getValue('1370', $multi_lang);
	$lngMnuMyTutors = $arrVal[$multi_lang]; // My Tutors
	
	$arrVal = $CI->lookup_model->getValue('1371', $multi_lang);
	$lngMnuTeachers = $arrVal[$multi_lang]; // Teachers
	
	$arrVal = $CI->lookup_model->getValue('1372', $multi_lang);
	$lngMnuSendMessage = $arrVal[$multi_lang]; // Send Message
	
	$arrVal = $CI->lookup_model->getValue('713', $multi_lang);
	$lngMnuSettings = $arrVal[$multi_lang]; // Settings
	
	$staticMenu['s_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/dashboard','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/calendar','class'=>'c_prof','text'=>$lngMnuMyBookings)	,
		array('uri'=>'user/teachers','class'=>'t_prof','text'=>$lngMnuMyTutors)	,
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>$lngMnuBeepbox)	,
		array('uri'=>'user/lessons','class'=>'a_prof','text'=>$lngMnuVideos)	,
		array('uri'=>'user/account','class'=>'p_prof','text'=>$lngMnuPO),
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)	
	);
	if ($topmenu==true) {
		array_push($staticMenu['s_private'],array('uri'=>'user/changeInfo','class'=>'h_prof','text'=>$lngMnuSettings));
	}
	$staticMenu['s_public'] = array(
		array('uri'=>'user/teachers','class'=>'t_prof','text'=>$lngMnuTeachers)	,
		array('uri'=>'user/send_message','class'=>'i_prof','text'=>$lngMnuSendMessage),
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)
	);
	$staticMenu['t_private'] = array(
		// added a new dashboard link BY TECHNO-SANJAY
		array('uri'=>'user/dashboard','class'=>'p_dasb','text'=>$lngMnuDashboard)	,
		array('uri'=>'user/profile','class'=>'p_prof','text'=>$lngMnuProfile)	,
		array('uri'=>'user/calendar','class'=>'c_prof','text'=>$lngMnuMyBookings)	,
		array('uri'=>'user/inbox','class'=>'i_prof','text'=>$lngMnuBeepbox)	,
		
		array('uri'=>'user/lessons','class'=>'l_prof','text'=>$lngMnuVideos)	,
		array('uri'=>'user/account','class'=>'a_prof','text'=>$lngMnuPO)	,
		array('uri'=>'user/history','class'=>'h_prof','text'=>$lngMnuHistory)
	);
	if ($topmenu==true) {
		array_push($staticMenu['t_private'],array('uri'=>'user/changeInfo','class'=>'h_prof','text'=>$lngMnuSettings));
	}
	$staticMenu['t_public'] = array(
		/*array('uri'=>'user/profile','class'=>'p_prof','text'=>'Profile')	,
		 
		array('uri'=>'user/lessons','class'=>'l_prof','text'=>'Lessons')	,
		array('uri'=>'user/history','class'=>'h_prof','text'=>'History')*/
		 
	);
	
	
	if(substr($type, 0,1)=="t") {
		$teacherClass = 'teacher_prof';
	}
	else {
		$teacherClass = '';
	}
	if ($topmenu==false) {		
		$str = '<ul class="student_prof '.$teacherClass.'">';
	} else {
		$str = '<ul>';
	}
	 
	foreach($staticMenu[$type] as $k=>$v){
		$selectedClass = '';
		if($now == 'account'){
			if($teacherClass){
				$now = 'a_prof';
			}
			else{
				$now = 'p_prof';
			}
		}
		
		if($v['class'] == $now) {
			$selectedClass = 'prof_on';
		}
		if ($topmenu==false) {	
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class="'.$v['class'].' '.$selectedClass.'">'.$v['text'].'</a></li>';
		} else {
		$str .= '<li><a href="'. tl_url($v['uri'],$uid).'" class="">'.$v['text'].'</a></li>';
		}
	}
	$str .= '</ul>';
	return $str;
}

 ?>
  