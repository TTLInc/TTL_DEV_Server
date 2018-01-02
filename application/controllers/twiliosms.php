<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twiliosms extends TL_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('twilio');
		$this->load->model('user_model');
	}

	function index()
	{
		/*** Get All Tutors ***/
		$arrTutors	= $this->user_model->getAllTutors();
		//echo "<pre>";print_r($arrTutors);exit();
		
		if(count($arrTutors) > 0)
		{
			$from   = '+16193774807';
			$to	= '';
			
			for($i=0;$i<sizeof($arrTutors);$i++)
			{
				$tutor_id	= $arrTutors[$i]['id'];
				$cell_number	= $arrTutors[$i]['cell'];
				$alerts		= $arrTutors[$i]['alerts'];
				$alert_type	= $arrTutors[$i]['alertType'];
				$time_diff	= $arrTutors[$i]['time_diff'];
				$start_time	= $arrTutors[$i]['startTime'];
				$starting_time	= date('h:i A', strtotime($start_time));
                $curr_time	= $arrTutors[$i]['curr_time'];

				if($alerts == 15 && $time_diff > '00:14:59' && $time_diff <= '00:15:59') /// before 15 mintues
				{
					$to         = $cell_number;
					//$message    = "You have a class after 15 mintues. The class will start at '".$start_time."'";
					//$message    = "Reminder: You have a session on TheTalkList that will start in 15 mintues, at ".$starting_time;
					$message    = "Reminder: You have a session on TheTalkList that will start in 15 minutes at your local time ".$starting_time;
				}
				
				elseif($alerts == 30 && $time_diff > '00:29:59' && $time_diff <= '00:30:59') /// before 30 mintues
				{
					$to         = $cell_number;
					//$message    = "You have a class after 30 mintues. The class will start at '".$start_time."'";
					//$message    = "Reminder: You have a session on TheTalkList that will start in 30 mintues, at ".$starting_time;
					$message    = "Reminder: You have a session on TheTalkList that will start in 30 minutes at your local time ".$starting_time;
				}
				
				elseif($alerts == 60 && $time_diff > '00:59:59' && $time_diff <= '01:00:59') /// before 60 mintues
				{
					$to         = $cell_number;
					//$message    = "You have a class after 1 hour. The class will start at '".$start_time."'";
					//$message    = "Reminder: You have a session on TheTalkList that will start in 1 hour, at ".$starting_time;
					$message    = "Reminder: You have a session on TheTalkList that will start in 1 hour at your local time 8:30pm, 2013-08-30.".$starting_time;
				}
				else
				{
					$to		= '';
					$message	= '';	
				}
				
				if($to != '')
				{
					$this->load->library('twilio');
					$response	= $this->twilio->sms($from, $to, $message);
					if($response->IsError)
					{
						echo 'Error: ' . $response->ErrorMessage;
                                                
                                                $email_message  = 'sms NOT SENT to '.$to;
                                                $email_to 	= 'websitedevelopmentc@gmail.com';
                                                $email_subject	= 'Email for SMS';
                                                $email_body	= $email_message;
                                                $headers  	= 'MIME-Version: 1.0' . "\r\n";
                                                $headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                                $headers 	.= 'From: SMS Reminder <subhra.bhattacharya@webskitters.com>' . "\r\n";
                                                mail($email_to, $email_subject, $email_body, $headers);
                                        }	
					else
					{
						$email_message  = 'sms sent to '.$to;
                                                $email_to 	= 'websitedevelopmentc@gmail.com';
                                                $email_subject	= 'Email for SMS';
                                                $email_body	= $email_message;
                                                $headers  	= 'MIME-Version: 1.0' . "\r\n";
                                                $headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                                $headers 	.= 'From: SMS Reminder <subhra.bhattacharya@webskitters.com>' . "\r\n";
                                                mail($email_to, $email_subject, $email_body, $headers);
					}
				}
			}
		}
	}
	
	public function getAllClass()
	{
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class as c,profile as p where  c.startTime > '{$nowTime}'  ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
		
	}
	
	public function calculateClassTime($uid,$alertmins)
	{
		$this->load->model(array('class_model','user_model','profile_model','event_model'));
		$classes = $this->class_model->getAll(1,5000);
		// calculate time of class
		$nowDate = date('Y-m-d H:i:s',time());
		//$nowDate = date('Y-m-d H:i:s',$this->event_model->outTime($nowDate));
		
		//echo 'Now time--- '.$nowDate.'<br/>';
		//echo '----------------------------------------------------------------<br/>';
		$nowTime = strtotime($nowDate);
		$alertStatus = array();
		$alertStatus['status'] = 0;
		if(count($classes)>0)
		{
			foreach($classes as $class)
			{
				//$classStartTimeDate = date('Y-m-d H:i:s',$this->event_model->outTime($class['startTime']));
				$classStartTimeDate = $class['startTime'];
				$clasStartTime = strtotime($classStartTimeDate);
				//echo 'class-time--- '.$classStartTimeDate.'<br/>';
				//$timeDiffInMin = round(($clasStartTime - $nowTime) / 3600);
				$timeDiffInMin = round(($clasStartTime - $nowTime) / 60);
				/*echo $class['sid']."-";
				echo $uid;*/
				
				//echo 'uid--'.$uid.' timeDiffInMin-- '.$timeDiffInMin.' alertmins--'.$alertmins.'<br/>';
				if($class['sid'] == $uid)
				{
					if($timeDiffInMin <= $alertmins)
					{
						$alertStatus['status'] = 1;
						$alertStatus['startTime'] = $class['startTime'];
					}
				}
				if($class['tid'] == $uid)
				{
					if($timeDiffInMin <= $alertmins)
					{
						$alertStatus['status'] = 1;
						$alertStatus['startTime'] = $class['startTime'];
					}
				}
			}
			//exit;
		}
		return $alertStatus;
	}
	public function sendSms($alerts,$to,$starting_time)
	{
		/*echo $alerts."<br>";
		echo $to."<br>";
		echo $starting_time."<br>";
		exit;*/
		/*
		$starting_time = explode(',',$starting_time);
		$dt_str = $starting_time[0];
		$dt_str_2_array = explode('-',$starting_time[1]);
		$dt_str = $dt_str.' , '.$dt_str_2_array[0].'  - '.$dt_str_2_array[1].' - '.$dt_str_2_array[2];
		$starting_time = $dt_str;
		*/
		if($alerts == 15)
		{
			//$message    = "Reminder: You have a session on TheTalkList that will start in 15 mintues, at ".$starting_time;
			$message    = "Reminder: You have a session on TheTalkList that will start in 15 minutes at your local time ".$starting_time;
		}elseif($alerts == 30 )
		{
			//$message    = "Reminder: You have a session on TheTalkList that will start in 30 mintues, at ".$starting_time;
			$message    = "Reminder: You have a session on TheTalkList that will start in 30 minutes at your local time ".$starting_time;
		}elseif($alerts == 60)
		{
			//$message    = "Reminder: You have a session on TheTalkList that will start in 1 hour, at ".$starting_time;
			$message    = "Reminder: You have a session on TheTalkList that will start in 1 hour at your local time ".$starting_time;
		}else
		{
		}
		/*echo $message;
		exit;*/
		if($to != '')
		{
			//echo 'hi';exit;
			$this->load->library('twilio');
			$from   = '+16193774807';
			
			// hard-coded country code.
			//$to = '+1'.$to;
			$to = $to;
			//$to = '+919998978397';
			//$to = '+919904665258';			
			//echo $message;
			$response	= $this->twilio->sms($from, $to, $message);
			if($response->IsError)
			{
				echo 'Error: ' . $response->ErrorMessage;
			}	
			else
			{
				echo '<pre>';
				print_r($response);
				
			}
			
			// fire test email for confirm cron
			$toemail      = 'virang@technoinfonet.com';
			$subjectemail = 'cron alert for class';
			$messageemail = $message;
			$headers = 'From: info@thetalklist.com' . "\r\n" .
				'Reply-To: info@thetalklist.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			mail($toemail, $subjectemail, $messageemail, $headers);
		}
	}
	function smsalert()
	{
		$this->load->model(array('class_model','user_model','profile_model','event_model'));
		//get all class  uids who comming in within 60 min
		$comingClasses = $this->class_model->getAllComming(1,5000);
		$uids = array();
		if(count($comingClasses)>0){
			$i = 0;
			foreach($comingClasses as $cc)
			{
				$uids[$i] = $cc['tid'];
				$i++;
				$uids[$i] = $cc['sid'];
				$i++;
			}
		}
		$uids = array_unique($uids);
		/*print_r($uids);
		exit;*/
		//checks for which user have sms alert subscribed
		if(count($uids)>0){
			foreach($uids as $uid)
			{
				$profile = $this->profile_model->getProfile($uid);
				$user = $this->user_model->getByUid($uid);
				//$localTimeZone = $user['timezone'];
				
				$localTimeZone = $this->user_model->getLastLocalTimeZone($uid);
				$alertType = $profile['alertType'];
				$alert = substr($alertType,1,strlen($alertType));

				if((int)$alert == 1){
					$alertPeriod = $profile['textalert'];
					$alertCell = $profile['cell'];
					//calculate time for alert
					$alertstatus = $this->calculateClassTime($uid,$profile['textalert']);
					//print_r($alertstatus);
					if($alertstatus['status'] == 1){
						$starting_time = '';
						$starting_time = $alertstatus['startTime'];
						$starting_time = $this->utc_to_local('g:i A, Y/m/d',$starting_time,$localTimeZone);

						/*if($localTimeZone == 'America/Boise'){
							$oldTime 			= time($starting_time);
							$timeAfterOneHour 	= $oldTime-60*60*5.92;
							$starting_time = date("h:i a",$timeAfterOneHour);
						}else{
							//$dateInLocal = $this->event_model->utc_to_local('h:i a',$updatedClass['startTime'],$tutotTimezone);
							$starting_time = $this->utc_to_local('g:i A, Y/m/d',$starting_time,$localTimeZone);
						}*/
						$starting_time = ' '.$starting_time;
						/*if($profile['smstxt'] != 1){*/
							$this->sendSms($alertPeriod,$alertCell,$starting_time);
							$smssentsql = "Update profile set smstxt = 1 where id = ".$uid;							
							$smsquery = $this->db->query($smssentsql);
						//}
					}
				}
			}
		}
		
	}
	function test_sms()
	{
		$this->load->library('twilio');
		$from = '+16193774807';
		//$to = '+16199933082';
		//$to = '+919883015395';
		//$to = '+919712384787';
		$to = '+919998978397';
		$message = 'This is a test sms for twilio.';
		$response = $this->twilio->sms($from, $to, $message);
	
		if($response->IsError)
		{
			echo 'Error: ' . $response->ErrorMessage;
			$email_message = 'Error on sending sms to '.$to.'Error: ' . $response->ErrorMessage;
			$email_to 	= 'subhra.bhattacharya@webskitters.com';
			$email_subject	= 'Email for SMS';
			$email_body	= $email_message;
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: SMS Reminder <birthday@example.com>' . "\r\n";
			
			mail($email_to, $email_subject, $email_body, $headers);
		}
		else
		{
			//echo 'Sent message to ' . $to;
			/*
			echo 'Message Sent';
			$email_message = 'sms sent to '.$to;
			$email_to 	= 'subhra.bhattacharya@webskitters.com';
			$email_subject	= 'Email for SMS';
			$email_body	= $email_message;
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: SMS Reminder <birthday@example.com>' . "\r\n";
			mail($email_to, $email_subject, $email_body, $headers);
			*/
		}
            
            
		
	}
	function retrieve_sms()
	{
		$this->load->library('twilio');
		//$from = '+16193774807';
		//$from = '+16192491384';
		$from = '';
		//$to = '+919998978397';
		$to = '';
		//$dateSent = '2013-08-15';
		$dateSent = '';
		$response = $this->getMessages($from,$to,$dateSent);
		//echo date('Y-m-d H:i:s',strtotime($response[0]->DateSent));
		if($response->HttpStatus == 200)
		{
			$response = $response->ResponseXml->Messages;
			//$response = $response->Message;
			$messages = array();
			if($response->Message)
			{
				foreach($response->Message as $msg)
				{
					$receivedDate = strtotime($msg->DateSent);
					
					$messages[] = $msg;
				}
				$response = $messages;
				
				//$response = $response[0];
				//$responseMsg = trim($response->Body);
			}
		}
		//echo '<pre>';
		//print_r($response);
	
	}
	public function getMessages($from = '',$to = '',$dateSent = '')
	{
		$this->load->config('twilio', TRUE);
		$this->mode        = $this->config->item('mode', 'twilio');
		$this->account_sid = $this->config->item('account_sid', 'twilio');
		$this->auth_token  = $this->config->item('auth_token', 'twilio');
		$this->api_version = $this->config->item('api_version', 'twilio');
		$this->number      = $this->config->item('number', 'twilio');
		$data = array();
			
		if($from != '')
		{
			$data['From'] = $from;
		}
		if($to != '')
		{
			$data['To'] = $to;
		}
		if($dateSent != '')
		{
			$data['DateSent'] = $dateSent;
		}
		
		$response = $this->twilio->request("/$this->api_version/Accounts/$this->account_sid/Messages", "GET",$data);
		// if($response->HttpStatus == 200)
		// {
			// $response = $response->ResponseXml->Messages;
			// //$response = $response->Message;
			// $messages = array();
			// foreach($response->Message as $msg)
			// {
				// $messages[] = $msg;
			// }
			// $response = $messages;
		// }
		
		return $response;
	}
	function utc_to_local($format_string, $utc_datetime, $time_zone)
	{
		$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
		$date->setTimeZone(new DateTimeZone($time_zone));
		return $date->format($format_string);
	}
}
/* End of file twiliosms.php */
/* Location: ./application/controllers/twiliosms.php */