<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends TL_Controller {
	public function __construct() {
        parent::__construct();
		//$this->load->model('article_model');
		//$this->layout->setLayoutData('linkAttr','article');
    }
	

	public function index() {
		$this->load->model('class_model');
		$notAlertedClass = $this->class_model->getNotAlerted();
		/*echo "<pre>";
		print_r($notAlertedClass);*/
		foreach($notAlertedClass as $k=>$v){
			$startTime = strtotime($v['startTime']);
			$sec = $startTime - time();
			$tAlert = $v['ta'] * 60;
			$sAlert = $v['sa'] * 60;
			$alerted = $v['alerted'];
			$newAlerted = $alerted;
			if($alerted != 1 && $alerted < 3 && $tAlert >= $sec){
				$this->alert($v['tat'],$v,1);
				$newAlerted += 1;
			}
			if($alerted != 2 && $alerted < 3 && $sAlert >= $sec){
				$this->alert($v['sat'],$v,0);
				$newAlerted += 2;
			}
			if($newAlerted != $alerted) {
				$alerted = $newAlerted;
				$this->class_model->updateClass(array('id'=>$v['id'],'alerted'=>$alerted));
			}
		}
	}
	private function alert($type,$class,$toWho) {
		file_put_contents('alert.txt', file_get_contents('alert.txt') . "\r\n" . $type);
		$inbox = @$type[1]; 
		$email = @$type[0];
		$this->load->model(array('class_model','inbox_model','event_model','profile_model','user_model'));
		if($inbox || (!$inbox && !$email)){
			$subject = 'TheTalkList Vee-session will start.';
			if(!$toWho){
				$uid = $class['tid'];
			}else{
				$uid = $class['sid'];
			}
			$profile = $this->profile_model->getProfile($uid);
			$user = $this->user_model->getByUid($uid);
			//$localTimeZone = $user['timezone'];
			$localTimeZone = $this->user_model->getLastLocalTimeZone($uid);
			$dateInLocal = $this->utc_to_local('g:i A, Y-m-d',$class['startTime'],$localTimeZone);

			$message = 'You have a learning Vee-session that will start at ' .$dateInLocal .' local time.';
			if(!$toWho){
				$this->inbox_model->send($class['tid'],1,$subject,$message);
			}else{
				$this->inbox_model->send($class['sid'],1,$subject,$message);
			}
		} 
		if($email){
			$this->class_model->sendAlertEmailCron($class['tid'],$class['sid'],strtotime($class['startTime']),$toWho);	
		}
	}
	public function sms() {
		$this->load->model('class_model');
		$notAlertedClass = $this->class_model->getNotAlerted();
		foreach($notAlertedClass as $k=>$v){
			$startTime = strtotime($v['startTime']);
			$sec = $startTime - time();
			$tAlert = $v['ta'] * 60;
			$sAlert = $v['sa'] * 60;
			$alerted = $v['alerted'];
			$newAlerted = $alerted;
			if($alerted != 1 && $alerted < 3 && $tAlert >= $sec){
				$this->alert($v['tat'],$v,1);
				$newAlerted += 1;
			}
			if($alerted != 2 && $alerted < 3 && $sAlert >= $sec){
				$this->alert($v['sat'],$v,0);
				$newAlerted += 2;
			}
			if($newAlerted != $alerted) {
				$alerted = $newAlerted;
				$this->class_model->updateClass(array('id'=>$v['id'],'alerted'=>$alerted));
			}
		}
	}
	/**
	* @author techno-sanjay
	* @package dispute resolution sent payment to tutor automatically
	* @param date 16 Aug 2013
	**/
	public function cleardisputespayment() {
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model(array('pay_model','profile_model'));
		$disputesAll = $this->pay_model->getNotPayed();
		/*$returndisputesAll = $this->pay_model->getReturnPayed();
		if(count($returndisputesAll) > 0){
			foreach($returndisputesAll as $returndisp)
			{
				$tid = $returndisp['tid'];
				$sid = $returndisp['sid'];
				$createAt = $returndisp['createAt'];
				$this->pay_model->update_return_disputes($tid,$sid,$createAt);
			}
		}*/
		
		//
		
		/*
		echo "<pre>";
		print_r($disputesAll);
		exit;
		*/
		
		if(count($disputesAll)>0){
			$i = 1;
			$nowdate = date('Y-m-d H:i:s',time());
			$nowstr = strtotime($nowdate);
			$payments = array();
			foreach($disputesAll as $disp)
			{
				
				if($disp['createAt']){
					$disstr = strtotime($disp['createAt']);
					// calculate time for 72 hours
					$diff = round(($nowstr - $disstr) / 3600);
					
					//$diff = 80;
					if($diff>=24){
						$user = $this->profile_model->getProfile($disp['tid']);
						//print_r($user);
						
						$payEmail = $user['payment_account'];
						$disputesFee = @$disp['t_hrate'];
						
						//echo (int)$disp['fee'];
						
						if($payEmail){
							if($disp['fee'] == 0){
								// make status payed directly because his price is zero
								$this->pay_model->updatePayedDisputes($disp['id'],'Success');
							}else{
								$payments[$i]['fee'] = $disputesFee;
								$payments[$i]['payemail'] = $payEmail;
								$payments[$i]['id'] = $disp['id'];
								$payments[$i]['tid'] = $disp['tid'];
								$payments[$i]['t_hrate'] = $disp['t_hrate'];
								$i++;
							}
						}
						$tid = $disp['tid'];
						$sid = $disp['sid'];
						$createAt = $disp['createAt'];				
						//$this->pay_model->update_tutor_disputes($tid,$sid,$createAt);
					}
				}
			}
			//print_r($payments);
			//exit;
			// mass pay paypal code start
			if(count($payments)>0){
				$logger = new PPLoggingManager('MassPay');
				$massPayRequest = new MassPayRequestType();
				$massPayRequest->MassPayItem = array();
				for($i=1; $i<=count($payments); $i++) {
					$masspayItem = new MassPayRequestItemType();	
					$masspayItem->Amount = new BasicAmountType('USD', $payments[$i]['t_hrate']);
					$masspayItem->ReceiverEmail = $payments[$i]['payemail'];
					$massPayRequest->MassPayItem[] = $masspayItem;
				}
				$massPayReq = new MassPayReq();
				$massPayReq->MassPayRequest = $massPayRequest;
				$paypalService = new PayPalAPIInterfaceServiceService();
				try {
					$massPayResponse = $paypalService->MassPay($massPayReq);
				} catch (Exception $ex) {
					include_once("../Error.php");
					exit;
				}
				
				//print_r($massPayResponse);
				
				foreach($payments as $pay)
				{
					// update payment status 
					$this->load->model(array('pay_model'));
					$tdate=date("Y-m-d");
					$this->pay_model->updatePayedDisputes($pay['id'],'CreditSuccess',$tdate);
					$this->pay_model->clear_tutor_payment_approve($pay['tid'],$pay['t_hrate']);
				}
				
				
				if(isset($massPayResponse)) {
					echo "<table>";
					echo "<tr><td>Ack :</td><td><div id='Ack'>$massPayResponse->Ack</div> </td></tr>";
					echo "</table>";
					//if($massPayResponse->Ack == 'Success'){
						foreach($payments as $pay)
						{
							// update payment status 
							$this->load->model(array('pay_model'));
							$tdate=date("Y-m-d");
							$this->pay_model->updatePayedDisputes($pay['id'],$massPayResponse->Ack,$tdate);
							$this->pay_model->clear_tutor_payment_approve($pay['tid'],$pay['t_hrate']);
						}
					//}
				}
			}
		}
	}
	/**
	* @author techno-sanjay
	* @package send a message on user beepbox if student and tutors are both not entered in vee-session
	* @param date 11 Sep 2013
	**/
	public function alertNotStartedSession() {
	
		// run also for ready to talk function		
		$this->load->model(array('class_model','inbox_model'));
		$classes = $this->class_model->getNotStartedSessionRT();
		/*
		print_r($classes);
		exit;*/
		if(count($classes)>0){
		
			foreach($classes as $class)
			{
				$action = unserialize($class['action']);
				if(@$action['tutorConnected'] == 1 && @$action['studentConnected']==0)
				{	
				/*if($class['type'] == 'now'){*/
					$revertfee = $class['fee'];
					$studentid = $class['sid'];
					$checkfreesession = "select free_session from user where id = {$studentid}";			
					$checkquery = $this->db->query($checkfreesession);
					if ($checkquery->num_rows() > 0) {
						$resultTeachers = $checkquery->result_array();
						
						if($resultTeachers[0]['free_session'] != 'y'){
							$feeSql = "update profile set money=money+{$revertfee} , frMoney=frMoney-{$revertfee} where uid={$studentid}";
							$query = $this->db->query($feeSql);
						}
					}
				//}
				}

				$sid = $class['sid'];
				$tid = $class['tid'];
				$id = $class['id'];
				$fromUid = 1;
				$subject = "Vee-session";

				//$message = "".$this->getUserName($sid)." booked a session with ".$this->getUserName($tid)." but the session did not take place. In this case, no transfer of credits or funds took place.  Please remember your scheduled Vee-sessions by setting your alerts on your Beepbox page.";
				$message = "".$this->getUserName($sid)." booked a session with ".$this->getUserName($tid)." but the session did not take place. In this case, no transfer of credits or funds took place. Some students generate accidental bookings, but its worth sending them a Beep Box message to see if they want to schedule later.";
				//send message on beepbox

				$toUid = $sid;
				/*
				$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
				//forwar message to email
				$this->forwardEmail($toUid,$message,$subject);
				$toUid = $tid;
				$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
				//forwar message to email
				$this->forwardEmail($toUid,$message,$subject);
				*/
				//update status to session is started so message will not send again
				$this->class_model->updateNotStartedSession($id);
			}
			$this->alertNotStartedSessionRT();
		}
	}
	/**
	* @author techno-sanjay
	* @package send a message on user beepbox if student and tutors are both not entered in vee-session with ready to talk now function
	* @param date 26 Sep 2013
	**/
	public function alertNotStartedSessionRT() {
		$this->load->model(array('class_model','inbox_model'));
		$classes = $this->class_model->getNotStartedSessionRT();
		if(count($classes)>0){
			foreach($classes as $class)
			{
				$sid = $class['sid'];
				$tid = $class['tid'];
				$id = $class['id'];
				$fromUid = 1;
				$subject = "Vee-Session";
				$message = "Booking sessions NOW is a flexible way to practice your conversation skills but neither party connected for this session. Therefore no transfer of credits or funds occurred. Please send a message to your Talkist partner to reconnect for another time.";
				//send message on beepbox
				$toUid = $sid;
				$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
				//forwar message to email
				$this->forwardEmail($toUid,$message,$subject);
				$toUid = $tid;
				$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
				//forwar message to email
				$this->forwardEmail($toUid,$message,$subject);
				//update status to session is started so message will not send again
				$this->class_model->updateNotStartedSession($id);
			}
		}
	}
	public function forwardEmail($uid,$message,$subject){
		$this->load->library('email');
		$personal = "SELECT * FROM user where id =".$uid;
		$perquery = $this->db->query($personal);
		$perresult = $perquery->row_array();
		if($perresult['forwardemail'] == 1){		
			$personal1 = "SELECT firstName,lastName FROM profile where uid =".$uid;
			$perquery1 = $this->db->query($personal1);
			$perresult1 = $perquery1->row_array();
			$username = $perresult1['firstName'].' '.$perresult1['lastName'];
			$str = "";
			$str .= "TalkMaster BlueBob sends this message to you from TheTalkList:\r\n<br/>";
			$str .= $message;
			$str .= "\r\n<br/>";
			$fromName ='TalkMaster BlueBob'; 
			$subject = 'Forward:'.$subject;
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com',$fromName);
			$this->email->subject($subject);
			$this->email->message($str);
			$this->email->to($perresult['email']);
			$this->email->send();
		}
	}
	public function getUserName($uid){
		$sql = "select firstName,lastName,uid from profile where uid = {$uid}";
		$query = $this->db->query($sql);
		$username = '';
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			//$username = @$result['firstName'].' '.$result['lastName'];
			$username = @$result['firstName'].''.$result['uid'];
		}
		return $username;
	}
	function utc_to_local($format_string, $utc_datetime, $time_zone){
		$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
		$date->setTimeZone(new DateTimeZone($time_zone));
		return $date->format($format_string);
	}
	/**
	* @author techno-sanjay
	* @package recurring session email
	* @param date 18 Sep 2013
	**/
	public function recurringSessionAlert(){
		$sql = "select id from user WHERE roleId = 1 OR roleId = 2 ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
            $result = $query->result_array();
		}
		$c_month = date('m',time());
		$c_year  = date('Y',time());
		if(count($result)>0){
			foreach($result as $rs)
			{
				$uid = $rs['id'];
				$this->recurringSessionSendMail($c_month,$c_year,$uid);
			}
		}
	}
	public function recurringSessionSendMail($c_month,$c_year,$uid){
		$this->load->model(array('event_model','user_model','profile_model'));
		$weekdays = array('0','1','2','3','4','5','6');
		$blocks = 48;
		$rstartTimeOriginal = '0:00';
		$time   = strtotime($rstartTimeOriginal);
		$halfHour   = 60 * 30;
		$status = 1;
		$sendEmail = 1;
		while ($blocks) 
		{
			$startTimeIns = date('h:i a', $time);
			$endTimeIns = date('h:i a', ($time + (60*25)));
			$time += $halfHour;
			$blocks--;
			foreach($weekdays as $weekday)
			{
				$weeksInMonths  = $this->get_weeks($c_year, $c_month);
				foreach($weeksInMonths as $weeksInMonth)
				{
					foreach($weeksInMonth as $key => $value )
					{
						if($key == $weekday){
							$dateForThisDay = $value;
							$todayDay = date('d',time());
							if($dateForThisDay >= $todayDay){
								$startDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$startTimeIns;
								$endDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$endTimeIns;
								$status = $this->event_model->checkTimeSlotRecurring($startDateIns,$endDateIns,$uid);
								if($status == 0){
									$sendEmail = 0;
									break;
								}
							}
						}
					}
				}
			}
		}
		if($sendEmail == 1){
			$user = $this->user_model->getByUid($uid);
			$profile = $this->profile_model->getProfile($uid);
			$username = $profile['firstName'].' '.$profile['lastName'];
			$to = $user['email'];
			$str = "Hello {$username}.";
			$str .= "\r\n<br/>";
			$str .= "TheTalkList Tutor Coordinator noticed that your tutoring calendar is not open for new sessions, please login and open more sessions so students can find you. \r\n<br/>";
			$str .= "\r\n<br/>";
			$str .= "You can review our tutorial, 'Preparing to be a Tutor', to see how you can maximize your exposure to our large English learning audience. \r\n<br/> ";	
			$str .= "\r\n<br/>";
			$str .= "Thanks for being a part of our community. \r\n<br/>";
			$str .= "TheTalkList Team";
			echo $str;
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			$this->email->to($to);
			$this->email->subject('TheTalklist open new sessions');
			$this->email->message($str);
			$this->email->send();
			echo '<br/>'.$uid.'<br/>';
			echo 'sendmail';exit;
		}
	}
	function get_weeks($year, $month){
		$days_in_month = date("t", mktime(0, 0, 0, $month, 1, $year));
		$weeks_in_month = 1;
		$weeks = array();
		for ($day=1; $day<=$days_in_month; $day++) {
			$week_day = date("w", mktime(0, 0, 0, $month, $day, $year));//0..6 starting sunday
			$weeks[$weeks_in_month][$week_day] = $day;
			if ($week_day == 6) {
				$weeks_in_month++;
			}
		}
		return $weeks;
	}
	
	////viplove 18-2-14 free session expiration alert start//////
	
	public function freesessionexpirationalert(){
		$this->load->model('messaging_model');
		$emails = $this->messaging_model->free_session_expiration_alert();
		$template = $this->messaging_model->free_session_expiration_alert_template();
		$this->load->library('email');
		for($i=0; $i<count($emails);$i++)
		{ 
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			$this->email->to($emails[$i]['email']);
			$this->email->subject(' Free Session Expiration Alert');
			$this->email->message($template[0]['n7']);
			$this->email->send();
		}
	}
	////viplove 18-2-14 free session expiration alert end//////

	public function notconfirmsendmsg(){
		$this->load->model('messaging_model');
		$ids = $this->messaging_model->not_confirm_send_msg();
		$this->load->model('user_model');
		$this->load->model('inbox_model');
		$this->load->library('email');
		for($i=0;$i<count($ids);$i++)
		{
			$emails_st = $this->user_model->getemailByuserid($ids[$i]['stid']);			
			$emails_tu = $this->user_model->getByprofileUid($ids[$i]['uid']);
			$name = $emails_tu['firstName'].' '.$emails_tu['lastName'];
			$a = strtotime($ids[$i]['startTime']);
			$s_t = date('Y-m-d h:i a', $a);			
			$msg = " $name could not confirm the session request on $s_t, Please select another open session or tutor!";
			$send = $this->inbox_model->send($ids[$i]['stid'],$ids[$i]['uid'],'could not confirm the session request',$msg);
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			$this->email->to($emails_st['email']);
			$this->email->subject('could not confirm the session request');
			$this->email->message($msg);
			$this->email->send();
		}
	}

	public function customerio_register(){
		$session = curl_init();

		//$qry=$this->db->query("SELECT `id`,`email` from `user` where email not like '%ttlmail.com%' AND id > 758");
		
		//$qry=$this->db->query("SELECT user.`id`,user.`email`,user.`roleId`,profile.`nativeLanguage`,profile.`otherLanguage`,profile.`cmp_profile`,profile.`pic_upload`,profile.`BioGraphy`,profile.`Cal_open`,user.`is_eligible`,user.`pilot_user`,user.`groupmailer` from user INNER JOIN profile ON user.id=profile.uid where user.invalidated = 0 AND user.email not like '%ttlmail.com%' AND user.id > 758");
		$qry=$this->db->query("SELECT user.`id`,user.`email`,user.`roleId`,profile.`nativeLanguage`,profile.`otherLanguage`,profile.`cmp_profile`,profile.`pic_upload`,profile.`BioGraphy`,profile.`Cal_open`,user.`is_eligible`,user.`pilot_user`,user.`groupmailer` from user INNER JOIN profile ON user.id=profile.uid where user.email LIKE '%aiesec%' AND user.id > 758");
		$result=$qry->result_array();

		foreach($result as $user){
			
			$customer_id = $user['id']; // You'll want to set this dynamically to the unique id of the user
			$customerio_url = 'https://track.customer.io/api/v1/customers/';
			$site_id = 'a3b9defd81b6a11c9373';
			$api_key = '4df4b03b7433796a6da7';

			$data = array('email' => $user['email'], 'created_at' => time(), 'nativeLanguage' => $user['nativeLanguage'], 'otherLanguage' => $user['otherLanguage'],'free_session' => $user['is_eligible'], 'cmp_profile' => $user['cmp_profile'], 'pic_upload' => $user['pic_upload'], 'BioGraphy' => $user['BioGraphy'], 'Cal_open' => $user['Cal_open'], 'pilot_user' => $user['pilot_user'], 'groupmailer' => $user['groupmailer'], 'roleId' => $user['roleId'], 'aiesec_status' => '1');

			curl_setopt($session, CURLOPT_URL, $customerio_url . $customer_id);
			curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($session, CURLOPT_HTTPGET, 1);
			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($session, CURLOPT_VERBOSE, 1);
			curl_setopt($session, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($session, CURLOPT_USERPWD, $site_id . ':' . $api_key);

			curl_exec($session);
			

		}
		curl_close($session);
	}
}
/* End of file Cron.php */
/* Location: ./application/controllers/Cron.php */