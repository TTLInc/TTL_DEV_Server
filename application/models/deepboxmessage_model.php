<?php
/**
* @package    TTL
* @category   Forum
* @author     R&D
* @since      Oct - 2013
**/
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deepboxmessage_model extends TL_Model {
	var $fields = array();
	public function __construct(){
		parent::__construct();
	}
        public function timeslot_request__student($dataarray)
        {
            //print_r($dataarray);
            //echo date("Y-m-d",strtotime($dataarray["datetime"]));
            $dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));
            //$msg = "You requested a session on #datetime# with #tutorname#. Please wait for an email confirmation from this tutor.";
			$msg = "You requested a session for #datetime# with #tutorname#. Please wait for an email confirmation from this tutor. If you have any problems please email: support@thetalklist.com. <br><br> Thank you, TheTalkList Support Team.";
            foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }
            //echo $msg;
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"A session on TheTalklist was requested");
        }
        public function timeslot_request__tutor($dataarray)
        {  
			//$dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));
			
			$tutorbooktime = date('Y-m-d H:i:s',$this->inTime($dataarray["datetime"]));
			$this->load->model(array('user_model'));
			$tutorTimezone = $this->user_model->getLastLocalTimeZone($dataarray["tutorid"]);
			$tutor_session_time1 = $this->utc_to_local('g:i A, Y-m-d',$tutorbooktime,$tutorTimezone);

            //$msg = "You received a session request from #studentname# for #datetime#.  Please login to your calendar on TheTalkList to confirm this appointment.";
			$msg = "You received a session request from ".$dataarray['studentname']." for ".$tutor_session_time1.". Please login to your calendar on TheTalkList to confirm this appointment. If you ignore the request, it will time out and you can send a message to the student to coordinate a better time.  If you have any problems please email: support@thetalklist.com. <br><br> Thank you, TheTalkList Support Team.";
            
			/*foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
                //echo $msg; 
            }*/
			
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"A session on TheTalklist was requested");
        }
        public function timeslot_book__mail($datarray,$isfree)
        {
				
            /*
             * Date Time format : 10:00 AM, 2014-06-13
             * $isfree,$datetime,$studentname,$tutorname,$speakinglevel,$conversationtopic
             */
            //print_r($datarray);
            //$datarray["datetime"] = date('h:i A, Y-m-d',$this->inTime($datarray["datetime"]));
            $datarray["datetime"] = date('h:i A, Y-m-d',strtotime($datarray["datetime"]));
            //print_r($datarray);
            $msg = "A learning Vee-session was booked by #studentname# with #tutorname#.";
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time #datetime#.";
			$msg = $msg."<br/>#studentname# is an #speakinglevel# speaker and would like to talk <br/> about #conversationtopic#.\r\n";
			$msg = $msg."<br/><br/>From user Dashboard, join within 15min of session but don’t be late. If you are late by 4min, then session will be locked and you will forfeit credits or earnings. In this case send Beepbox message to partner to reschedule."; 
			$msg = $msg."<br/>Click to Share webcam and mic devices.\r\n"; 
            //$msg = $msg."<br/>#studentname# has #speakinglevel# speaking skills and would like to talk about #conversationtopic#.";
            //$msg = $msg."<br/>If you have any problems please email the support team at: support@thetalklist.com"; 
			$msg = $msg."<br/><br/>If you have any problems please email the support team at: support@thetalklist.com";
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";
            foreach($datarray as $key => $values)
            {
                //echo $key."=>".$values;
                $sources = "#".$key."#";
                $newcontent = $values;
                //echo " : ".$sources." : ".$newcontent." ::::: "; 
                $msg = str_replace($sources,$newcontent,$msg);
            }
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
		
		public function timeslot_book__tutormail($tutordatarray,$isfree)
        {
            //$datarray["datetime"] = date('h:i A, Y-m-d',strtotime($datarray["datetime"]));
			$tutorbooktime = date('Y-m-d H:i:s',$this->inTime($tutordatarray["datetime"]));
			$this->load->model(array('user_model'));
			$tutorTimezone = $this->user_model->getLastLocalTimeZone($tutordatarray["tutorid"]);
			$tutor_session_time1 = $this->utc_to_local('g:i A, Y-m-d',$tutorbooktime,$tutorTimezone);

            //print_r($datarray);
            $msg = "A learning Vee-session was booked by ".$tutordatarray['studentname']." with ".$tutordatarray['tutorname'];
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time ".$tutor_session_time1.".";
            $msg = $msg."<br/>".$tutordatarray['studentname']." has ".$tutordatarray['speakinglevel']." speaking skills and would like to talk about ".$tutordatarray['conversationtopic'].".\r\n";
			$msg = $msg."<br/><br/>From user Dashboard, join within 15min of session but don’t be late. If you are late by 4min, then session will be locked and you will forfeit credits or earnings. In this case send Beepbox message to partner to reschedule."; 
			$msg = $msg."<br/>Click to Share webcam and mic devices.\r\n"; 
            $msg = $msg."<br/>If you have any problems please email the support team at: support@thetalklist.com"; 
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";
           /* foreach($datarray as $key => $values)
            {
                //echo $key."=>".$values;
                $sources = "#".$key."#";
                $newcontent = $values;
                //echo " : ".$sources." : ".$newcontent." ::::: "; 
                $msg = str_replace($sources,$newcontent,$msg);
            }*/
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
		
        public function timeslot_request__student_mail($datarray,$isfree)
        {
            /*
             * Date Time format : 10:00 AM, 2014-06-13
             * $isfree,$datetime,$studentname,$tutorname,$speakinglevel,$conversationtopic
             */
            //print_r($datarray);
            //$datarray["datetime"] = date('h:i A, Y-m-d',$this->inTime($datarray["datetime"]));
            $datarray["datetime"] = date('h:i A, Y-m-d',strtotime($datarray["datetime"]));
            //print_r($datarray);
            /*$msg = "A learning Vee-session was requested by #studentname# with #tutorname#.";
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time #datetime#.";
            $msg = $msg."<br/>#studentname# is an #speakinglevel# speaker and would like to talk about #conversationtopic#.";
            $msg = $msg."<br/>If you have any problems please email the support team at: support@thetalklist.com"; 
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";*/
			$msg = "You requested a session on #datetime# with #tutorname#. Please wait for an email confirmation from this tutor. If you have any problems please email: support@thetalklist.com. <br><br> Thank you, TheTalkList Support Team.";
            foreach($datarray as $key => $values)
            {
                //echo $key."=>".$values;
                $sources = "#".$key."#";
                $newcontent = $values;
                //echo " : ".$sources." : ".$newcontent." ::::: "; 
                $msg = str_replace($sources,$newcontent,$msg);
            }
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"A session on TheTalklist was requested");
        }
		
		public function cancel_session($dataarray){
			//$studentbooktime = date('Y-m-d H:i:s',$this->inTime($dataarray["datetime"]));
			$studentbooktime = $dataarray["datetime"];
			$this->load->model(array('user_model'));
			$studentTimezone = $this->user_model->getLastLocalTimeZone($dataarray["studentid"]);
			$student_session_time1 = $this->utc_to_local('g:i A, Y-m-d',$studentbooktime,$studentTimezone);

            //$msg = $dataarray["tutorname"]." confirmed your Vee-session request for ".$student_session_time1.". Have fun!";
			$msg = "We are sorry but Jacobs had to cancel your Vee-session at ".$student_session_time1.". Please reschedule.";
            /*foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }*/
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session cancelled");

		}

		public function timeslot_request__tutor_mail($datarray,$isfree)
        {
            /*
             * Date Time format : 10:00 AM, 2014-06-13
             * $isfree,$datetime,$studentname,$tutorname,$speakinglevel,$conversationtopic
             */
            //print_r($datarray);
            //$datarray["datetime"] = date('h:i A, Y-m-d',$this->inTime($datarray["datetime"]));
            $datarray["datetime"] = date('h:i A, Y-m-d',strtotime($datarray["datetime"]));
            //print_r($datarray);
            /*$msg = "A learning Vee-session was requested by #studentname# with #tutorname#.";
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time #datetime#.";
            $msg = $msg."<br/>#studentname# is an #speakinglevel# speaker and would like to talk about #conversationtopic#.";
            $msg = $msg."<br/>If you have any problems please email the support team at: support@thetalklist.com"; 
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";*/
			//$msg = "You requested a session on #datetime# with #tutorname#. Please wait for an email confirmation from this tutor. If you have any problems please email: support@thetalklist.com. <br><br> Thank you, TheTalkList Support Team.";
			$msg = "You received a session requests from #studentname# on #datetime#.  Please login to your calendar on TheTalkList to confirm this appointment. If you ignore the request, it will time out and you can send a message to the student to coordinate a better time.  If you have any problems please email: support@thetalklist.com. <br><br> Thank you, TheTalkList Support Team.";
            foreach($datarray as $key => $values)
            {
                //echo $key."=>".$values;
                $sources = "#".$key."#";
                $newcontent = $values;
                //echo " : ".$sources." : ".$newcontent." ::::: "; 
                $msg = str_replace($sources,$newcontent,$msg);
            }
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"A session on TheTalklist was requested");
        }
        public function timeslot_confirm_request__student($dataarray)
        {
            /**
             * Date time format : 11:00 AM, 2014-06-25
             * $datetime,$tutorname
             */
            //print_r($dataarray);
            //$dataarray["datetime"] = date('h:i A, Y-m-d',$this->inTime($dataarray["datetime"]));
			//$dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));

			$studentbooktime = date('Y-m-d H:i:s',$this->inTime($dataarray["datetime"]));
			$this->load->model(array('user_model'));
			$studentTimezone = $this->user_model->getLastLocalTimeZone($dataarray["studentid"]);
			$student_session_time1 = $this->utc_to_local('g:i A, Y-m-d',$studentbooktime,$studentTimezone);

            $msg = $dataarray["tutorname"]." confirmed your Vee-session request for ".$student_session_time1.". Have fun!";
            /*foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }*/
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
		public function timeslot_confirm_request__tutor($dataarray)
        {
            /**
             * Date time format : 11:00 AM, 2014-06-25
             * $datetime,$tutorname
             */
            //print_r($dataarray);
            //$dataarray["datetime"] = date('h:i A, Y-m-d',$this->inTime($dataarray["datetime"]));
            $dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));
            $msg = "You confirmed a Vee-session request with #studentname# for #datetime#. Have fun!";
            foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
        public function timeslot_confirm_request__mail($dataarray)
        {
            /*
             * Date Time format : 10:00 AM, 2014-06-13
             * $isfree,$datetime,$studentname,$tutorname,$speakinglevel,$conversationtopic
             */
            
            $dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));
            $msg = "A learning Vee-session was confirmed by #tutorname# with #studentname#.";
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time #datetime#.";
            //$msg = $msg."<br/>#studentname# has #speakinglevel# speaking skills and would like to talk about #conversationtopic#.";
			$msg = $msg."<br/>#studentname# has #speakinglevel# speaking skills and would like to talk <br /> about #conversationtopic#.\r\n";

			$msg = $msg."<br/><br/>From user Dashboard, join within 15min of session but don’t be late. If you are late by 4min, then session will be locked and you will forfeit credits or earnings. In this case send Beepbox message to partner to reschedule."; 
			$msg = $msg."<br/>Click to Share webcam and mic devices.\r\n"; 

            $msg = $msg."<br/><br/>If you have any problems please email the support team at: support@thetalklist.com"; 
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";
            foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
		
		public function timeslot_confirm_request__studentmail($dataarray)
        {
            /*
             * Date Time format : 10:00 AM, 2014-06-13
             * $isfree,$datetime,$studentname,$tutorname,$speakinglevel,$conversationtopic
             */
            //$dataarray["datetime"] = date('h:i A, Y-m-d',strtotime($dataarray["datetime"]));
			$studentbooktime = date('Y-m-d H:i:s',$this->inTime($dataarray["datetime"]));
			$this->load->model(array('user_model'));
			$studentTimezone = $this->user_model->getLastLocalTimeZone($dataarray["studentid"]);
			$student_session_time1 = $this->utc_to_local('g:i A, Y-m-d',$studentbooktime,$studentTimezone);
			
            $msg = "A learning Vee-session was confirmed by ".$dataarray['tutorname']." with ".$dataarray['studentname'];
            if ($isfree)
            {
                $msg = $msg."<br/>This is a new student booking their FREE session."; 
            }
            $msg = $msg."<br/>The Vee-session start time is at your local time ".$student_session_time1.".";
            $msg = $msg."<br/>".$dataarray['studentname']." has ".$dataarray['speakinglevel']." speaking skills and would like to talk about ".$dataarray['conversationtopic'].".";
            $msg = $msg."<br/>If you have any problems please email the support team at: support@thetalklist.com"; 
            $msg = $msg."<br/>Thank you, TheTalkList Support Team";
            /*foreach($dataarray as $key => $values)
            {
                $sources = "#".$key."#";
                $newcontent = $values;
                $msg = str_replace($sources,$newcontent,$msg);
            }*/
            return array("msg"=>$msg,"fromemailid"=>'admin@thetalklist.com',"fromname"=>'TheTalklist',"subject"=>"Session booking on TheTalklist");
        }
		
		function utc_to_local($format_string, $utc_datetime, $time_zone)
		{
		
			$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
			$date->setTimeZone(new DateTimeZone($time_zone));
			return $date->format($format_string);
		}
}
/* End of file topic_model.php */
/* Location: ./application/model/topic_model.php */