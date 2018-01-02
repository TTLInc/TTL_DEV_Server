<?php
require(APPPATH.'/libraries/REST_Controller.php');
require_once(FCPATH .'/stripe-php/init.php');
class Api extends REST_Controller
{
	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('api_model','user_model','profile_model')); // Load Client, Profile Model
	}
	
	// Check User Exist or Not
	public function login_post()
	{
	
		// Call loginByEmail Function of user_model
		$result = $this->api_model->loginByEmail(array(
            'email' 	=> $_GET['email'],
            'password'	=> $_GET['password']
        ));
		/*if($result['firebase_regId'] != ''){
					$this->response(array('status' => 10,'firebase_id'=>$result['firebase_regId']));
		}*/
		
		//print_r($result);
        if ($result) {
			if ($result['isconfirmedAccount'] == 0) {
				$this->response(array('status' => 1, "error"=>"Please verify your email address.")); // Failed Result
			} /* else if($result['login'] == 1){
				$this->response(array('status' => 1, "error"=>"You are Logged In other Device.")); // Failed Result
			} */ else{
				
				//$this->response(array('status' => 0)); // Success Result
				//$this->booking_post($result);
				
				$this->response(array('status'=>0,'message'=>"Successfully Login","result"=>$result));
			}
        } else {
			$this->response(array('status' => 1, "error"=>"Invalid Login")); // Failed Result
        }
	}
	
	//facebook Login
	public function fblogin_post(){
		/* $result = $this->user_model->checkEmail($_GET['email']);
		if ($result['success']=="" and isset($result['message'])) {
			$this->response(array('status' => 1, "error"=>$result['message'])); // Email Already Exist.
		} else {
		
		} */
		$result = $this->api_model->loginByfbid(array(
            'email' 	=> $_GET['email'],
            'facebook_id'	=> $_GET['facebook_id']
        ));
		
		/* $chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$ml = '' ;
		while ($i <= 9) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$ml = $ml . $tmp;
			$i++;
		}
			$emails = $ml."@ttlmail.com";
		
		$result = $this->api_model->loginByfbid(array(
            'facebook_id'	=> $_GET['facebook_id']
        )); */
		if ($result) {
			if ($result['isconfirmedAccount'] == 0) {
				$this->response(array('status' => 1, "error"=>"Please verify your email address.")); // Failed Result
			} else {
			
				//$this->response(array('status' => 0)); // Success Result
				//$this->booking_post($result);
				
				$this->response(array('status'=>0,'message'=>"Successfully Login","result"=>$result,'login'=>1));
			}
        } else {
			//$this->response(array('status' => 1, "error"=>"Invalid Login")); // Failed Result
		
		$userform = $_GET;
		$facebook_id = $userform['facebook_id'];
		$firstname = $userform['firstname'];
		$lastname = $userform['lastname'];
		$email = $userform['email'];
		$gender = $userform['gender'];
		$birthday = $userform['birthday'];
		
	    $user = "";
		$this->load->library('session');
	    $this->load->library('facebook');
	    $userId = $this->facebook->getUser();  
	   
       /* if ($userId) {
            try {
                $user = $this->facebook->api('/me?fields=name,email,first_name,last_name,id,gender,birthday,age_range,location,hometown');
            } catch (FacebookApiException $e) {
                $user = "";
            }
        }else {
            $this->facebook->destroySession();
        } */
	
        if($user=="") :
		$ipInfoSESSION = $this->geolocater->getMaxMindlocation();
		//print_r($ipInfoSESSION); exit;
			$userdata = $this->user_model->fnFacebookUser($userform['facebook_id'], $userform['email']);
			//$userdata = $this->user_model->fnFacebookUser($userform['facebook_id']);
			
			//print_r($userdata); exit;
			
			if(empty($userdata)) : 
				$formData['isconfirmedAccount'] = '1';
				$formData['firstName'] = $firstname; 
				$formData['lastName'] = $lastname; 
				$formData['username'] = $email; 
				$formData['email'] = $email; 
				$formData['facebook_id'] = $facebook_id;
				$formData['fb_gender'] = $gender;
				$formData['fb_birthday'] = $birthday;				
				$formData['universal_roleId'] = '0';
				$formData['free_session'] = 'y';
				$formData['is_eligible'] = '1';
				$formData['testAccount'] = '0';
				$formData['roleId'] = '0';
				if($userform['gender'] == 'male'){
					$formData['gender'] = '1';
				}else{
					$formData['gender'] = '0';
				}
				$ipInfoSESSION = $this->geolocater->getMaxMindlocation();
				/* Add Timezone */
				$formData['timezone'] = $ipInfoSESSION['time_zone'];
				$formData['country'] = $ipInfoSESSION['countryId'];
				$formData['city'] = $ipInfoSESSION['geocity'];
				// Insert User Data
				$uid = $this->user_model->register($formData);
				
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				
				/*$ip = "122.170.115.66, 204.246.166.85";
				$Ip = explode(",",$ip);
				$realIp=$Ip[0];
				$cname ='IN';
				$sql = "Select id from countries where iso2 = '{$cname}'";
				$query = $this->db->query($sql);
				$cresult = $query->result_array();
				$cid = $cresult[0]['id'];*/
				//$formData['country'] = "";
				$formData['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				$formData['school_id'] = '0';
				$formData['hRate'] = '3.76';
				$formData['nativeLanguage'] = "English";
				
				$config = $this->profile_model->getConfig();
				$register_promotional_credit = $config['Mobile_promotional_credit']['value'];
				
				$formData['money'] = $register_promotional_credit;
				$formData['coupon_credits'] = $register_promotional_credit;
				
				if (isset($_SESSION['multi_lang_name'])) { 
					$formData['nativeLanguage'] = $_SESSION['multi_lang_name'];
				}
				$this->profile_model->save($formData); // Insert Profile Data
				$uinfo = array(
					'username'=>$formData['username'],
					'welcomeuser'=>$formData['firstName'] ,
					'email'=>$formData['email'],
					'uid'=>$uid,
					'use'=>$uid,
					'user_type' => '',
					'free_session'=> 'y',					
					'pic'=>'',
					'roleId'=>'0',
					'firstTime'=>'y',
					'universal_roleId'=>'0'
				);
				$query = $this->db->query("update user set  is_login=1 where id='{$uid}'");
				$this->session->set_userdata($uinfo);
				$this->session->set_userdata('firstTimeRegister','yes');
				$this->session->set_userdata('sturegister','yes');
				//redirect(base_url('user/studentPopup')); 
				$result = $this->api_model->loginByfbid(array(
					'email' 	=> $_GET['email'],
					'facebook_id'	=> $_GET['facebook_id']
				));
				if ($result) {
					if ($result['isconfirmedAccount'] == 0) {
						$this->response(array('status' => 1, "error"=>"Please verify your email address.")); // Failed Result
					} else {
						$this->response(array('status'=>0,'message'=>"Successfully Login","result"=>$result));
						exit;
					}
				} else {
					$this->response(array('status' => 1, "error"=>"Invalid Login")); // Failed Result
					exit;
	
			}
				      		
			else :    
				
				$uinfo = array(
					'username'=>$userdata['username'],
					'welcomeuser'=>$userdata['firstName'] ,
					'email'=>$userdata['email'],
					'uid'=>$userdata['uid'],
					'use'=>$userdata['uid'],
					'user_type' => '',
					'free_session'=> $userdata['free_session'],					
					'pic'=>$userdata['pic'],
					'roleId'=>$userdata['roleId'],
					'firstTime'=>$userdata['firstTime'],
					'universal_roleId'=>$userdata['universal_roleId']
				);    
				$this->session->set_userdata($uinfo);
				redirect(base_url('user/dashboard'));
				exit;
			endif;
        else :
            //$data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('index'), 
			//'scope' => array("email")));
			$this->response(array('status'=>1,'message'=>"Already Registered."));
			exit;
		endif;
       // redirect(base_url());
		}
    }
	
	public function signout_post(){
		$id = $_GET['uid'];
		$update = $this->db->query("update profile set firebase_regId = null where uid = '{$id}'");
		$update_user = $this->db->query("update user set is_login = 0 ,readytotalk = 0 where id = '{$id}'");
		if ($update) {
			$this->response(array('status' => 0, "message"=>"successfully Logout")); 
		} else {
			$this->response(array('status' => 1, "message"=>"Someting Wrong.")); 
		}
		
	}
	// Check User Email Exist
	
	
	public function emailexist_post()
	{
		// Call register Function of user_model
		$result = $this->user_model->checkEmail($this->input->post('email'));
		if ($result['success']=="" and isset($result['message'])) {
			$this->response(array('status' => 1, "error"=>$result['message'])); // Email Already Exist.
		} else {
			$this->response(array('status' => 0)); // Email Available.
		}
	}
	
	// User Signup
	public function signup_post_backup()
	{
		// Check User Email Exist
		$result = $this->user_model->checkEmail($this->input->post('email'));
		if ($result['success']=="" and isset($result['message'])) {
			$this->response(array('status' => 1, "error"=>$result['message'])); // Email Already Exist.
		} else {
			// Call register Function of user_model
			$result = $this->user_model->register(array(
				'email'				=>	$this->input->post('email'),
				'password'			=>	$this->input->post('password'),
				'roleId'			=>	$this->input->post('roleId'),
				'universal_roleId'	=>	($this->input->post('roleId')==1) ? 1 : 0,
				'refid'				=>	$this->input->post('refid'),
				'free_session'		=>	($this->input->post('roleId')==0) ? 'y' : '',
				'timezone'			=>	$this->input->post('timezone'),
				'is_eligible'		=>	($this->input->post('roleId')==0) ? 1 : 0,
				'testAccount'		=>	(strstr($this->input->post('email'),'ttlmail.com')) ? 1 : 0
			));
			if ($result) {
				$this->response(array('status' => 0)); // Success Result
			} else {
				$this->response(array('status' => 1, "error"=>"Registration Failed")); // Failed Result
			}
		}
	}
	
	// User Signup 
	public function signup_post()
	{
		$result = $this->user_model->checkEmail($_GET['email']);
		if ($result['success']=="" and isset($result['message'])) {
			$this->response(array('status' => 1, "error"=>$result['message'])); // Email Already Exist.
		} else {
			$device_check = $this->api_model->checkdevice($_GET['device_id']);
			if(!empty($device_check)){
				$this->response(array('status' => 1, "error"=>"Device Already Registered."));
			}else{
				
			$this->load->library('geolocater');
			$ip				=	"122.170.115.66, 204.246.166.85";
			$Ip				=	explode(",",$ip);
			$realIp			=	$Ip[0];
			$cname			=	'IN';
			$sql			=	"Select id from countries where iso2 = '{$cname}'";
			$query			=	$this->db->query($sql);
			$cresult		=	$query->result_array();
			$cid			=	$cresult[0]['id'];
			$userModel		=	$this->user_model;
			$profileModel	=	$this->profile_model;
			$formData		=	$_GET;
			$refid			=	'';
			$diffurl		=	'';

			if($formData['roleId'] == ''){
				$formData['roleId'] = '0';
			}
			/* code added by haren for  March scope */
			$testAccount=$_POST['email'];
			$domain = substr(strrchr($testAccount, "@"), 1);
			$domain = mb_strtolower($domain,'UTF-8');
			if($domain == 'ttlmail.com')
			{
				$formData['testAccount']='1';	
			}
			else
			{
				$formData['testAccount']='0';
			}
			/* End haren code */
			 
			if( $formData['password']=='' && $formData['cpassword'] !='')
			{
				$formData['password'] = $formData['cpassword'];
			}
			 
			if (preg_match("/([.]+)/", $formData['refid'], $matches)) {
				$pieces = explode(".",$formData['refid']);		
				$decode =  $this->user_model->decode($pieces[1],"This is a key"); 
				$formData['refid'] = $this->session->userdata('decode');
				$refid = $this->session->userdata('decode');
				$refid  = $decode; 
			} else {
				$decode =  $this->user_model->decode($formData['refid'],"This is a key"); 
				$formData['refid'] = $this->session->userdata('decode');
				$refid = $this->session->userdata('decode');
				$refid  = $decode;
			}
			
			if($refid !='')
			{
				$refdata=$this->user_model->getByUid($refid);
			}
			
			if ($refdata['roleId']==4 && $formData['roleId'] <=1) {
				$formData['refid'] = $refid;
				$diffurl='yes';
			} else {
				$formData['refid'] = 0;
			}
			
			if ($refdata['roleId']!=4) {
				$formData['refid'] = $refid;
			}		
			//$this->session->unset_userdata('decode');
			if ($formData['roleId'] == '-1') {
				$formData['roleId'] =0;
			}
			//$_SESSION['isRegError'] = TRUE;
			//$_SESSION['regError']   = $errorMsg;
			
			if (isset($_POST['regPage']) && $_POST['regPage'] =='ppc') {
				$formData['username'] = $formData['email'];
			}
			$errorMsg = $this->user_model->checkEmail($formData['email']);	// Email Cann't be Empty.
			if ($errorMsg['success']) {
				$errorMsg = $this->user_model->checkPassword($formData['password']);
				if ($errorMsg['success']===false) {
					$this->response(array('status' => 1, "error"=>$errorMsg['message'])); // Password Cann't be Empty.
				}
			}
			$multi_lang = 'en';
			/*if (!isset($_SESSION)) {
				session_start();
			}*/
			
			/*if (isset($_SESSION['multi_lang'])) {
				$multi_lang = $_SESSION['multi_lang'];
			} else {
				$multi_lang = 'en';
			}
			$this->session->set_userdata('firstTimeRegister','yes');
			$this->session->set_userdata('sturegister','yes');*/
			$this->load->model(array('lookup_model'));
			$arrVal = $this->lookup_model->getValue('815', $multi_lang);
			$selecType = $arrVal[$multi_lang];
			if ($formData['roleId']==9) {
				$errorMsg['message'] = $selecType;
				$errorMsg['success'] = false;
			}  
			if ($errorMsg['success'] == false) {
				if (!isset($_POST['regPage'])) {
					echo json_encode($errorMsg);
					exit;
				} else {
					//$_SESSION['isRegError'] = TRUE;
					//$_SESSION['regError']   = $errorMsg['message'];
					//$this->session->set_userdata('RegLink',$errorMsg['message']);
					redirect($_POST['regReturn']);
					exit;
				}
			} else {
				if ($formData['roleId']  == 0) {
					$formData['free_session'] = 'y'; 
					$formData['is_eligible'] = 1;
				} else {
					$formData['free_session'] = 'y';
				}
				
				if ($formData['roleId']  == 1) {
					$formData['universal_roleId'] = '1';
				} else {
					$formData['universal_roleId'] = '0';
				}
				/* Added By Ilyas */	
				/*$formData['universal_roleId'] = 0;
				if ($formData['roleId']  == 1) {
					$formData['universal_roleId'] = 1;
				}*/
				/* end */
				$uid = $userModel->register($formData);
			} 
			if ($uid) { 
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				$formData['country'] = $cid;
				$formData['ipaddress'] = $realIp;
				if ($refdata['roleId']==4) {
					$formData['school_id'] = $refid;
				} else {
					$formData['school_id'] = '0';
				}
				if ($formData['roleId']  == 1) {
					 $formData['hRate'] = '7.50';
				}
				$formData['cell'] = $_GET['cell'];
				$formData['device_id'] = $_GET['device_id'];
				
				$config = $this->profile_model->getConfig();
				$register_promotional_credit = $config['Mobile_promotional_credit']['value'];
				
				$formData['money'] = $register_promotional_credit;
				$formData['coupon_credits'] = $register_promotional_credit;
				$formData['hRate'] = 4.25;
				$profileModel->save($formData);
				$profile = $this->db->query("SELECT uid,firstName,lastName,hRate,pic,Lat,Lng,user.username,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$uid);		
				$profile->result_array();
				$profile_res = $profile->result_array();
				$address = '';
				if ($profile_res[0]['city'] != '') {
					$address = $address.$profile_res[0]['city'].' ';
				}
				if ($profile_res[0]['provice'] != '') {
					$address = $address.$profile_res[0]['provice'].' ';
				}
				if ($profile_res[0]['country'] != '') {
					$address = $address.$profile_res[0]['country'];
				}
				if ($address != '') {
					//$this->getFirstLatLong($uid,$address);
				}
				$uid=base64_encode($formData['uid']);
				if ($formData['roleId'] == 0) {
					$str = "<b>Welcome to TheTalkList.com, where you will speak like a native!</b>   We have worked hard at building the best 1 to 1 learning environment.  Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Your login information:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					$str .= "Password: {$formData['password']}\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New Students Tips: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Schedule your first Free Session.</li>";
					$str .= "<li>Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
					$str .= "<li>Post to our Facebook page to interact with many other users.</li>";
					$str .= "</ul>";
				}
				
				if ($formData['roleId'] == 1) {
					$str = "<b>Welcome to TheTalkList.com, where you will earn money helping people speak like a native!</b>   We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Your login information:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					$str .= "Password: {$formData['password']}\r\n<br/>";
					$str .= "\r\n<br/>";
				}
				
				if ($formData['roleId'] == 4) {
					$str = "<b>Welcome to TheTalkList.com, where you will help learners speak like a native!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New School Tips:\r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Get your tutors to enroll in TheTalkList.</li>";
					$str .= "<li>Login and add your tutors to your School Community.</li>";
					$str .= "<li>Advertise by emailing out your School Link and posting our linkable ad to your website.</li>";
					$str .= "<li>Monitor transactions and earnings through your account page.</li>";
					$str .= "</ul>";
				}
				
				if ($formData['roleId'] == 5) {
					$str = "<b>Welcome to TheTalkList.com, where you will earn money as your referrals learn to speak like a native!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New Affiliate Tips: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Login and view your custom affiliate URL link.</li>";
					$str .= "<li>Download advertisements for distribution </li>";
					$str .= "<li>Advertise by posting our linkable ads to your marketing channels.</li>";
	
					$str .= "<li>Monitor transactions and earnings through your account page.</li>";
					$str .= "</ul>";
				}
				
				if ($formData['roleId'] > 3) {	
					$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Your login information:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					$str .= "Password: {$formData['password']}\r\n<br/>";
					$str .= "\r\n<br/>";
				}
				
				$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
				$str .= "Thank you,\r\n<br/>";
				$str .= "TheTalkList Support Team";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				$this->email->to($formData['email']);
				$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
				$this->email->message($str);
				$this->email->send();
				// End email function code
				 
				//$this->session->set_userdata('RegLink','Please check your email to confirm your registration and jump into our site.');
				//redirect(base_url());
				if ($formData['roleId'] == 4 || $formData['roleId'] == 5) {
					//redirect('user/registeredit');
					$this->response(array('status' => 0,'result'=>$formData['uid'])); //  Success
				}
				if (isset($_POST['regPage']) && $_POST['regPage'] =='ppc'  && $errorMsg['success'] == true) {
					if ($formData['roleId'] == 0) {
						//redirect (base_url('user/studentPopup'));
						$this->response(array('status' => 0,'result'=>$formData['uid'])); //  Success
					} else {
						 //redirect('user/registeredit');
						 $this->response(array('status' => 0,'result'=>$formData['uid'])); //  Success
					}
				} else {
					if ($formData['roleId'] == 0) {
						$this->response(array('status' => 0,'result'=>$formData['uid'])); //  Success
						//echo json_encode(array('success'=>true,'redirect'=>Base_url('user/dashboard')));
					} else {
						$this->response(array('status' => 0,'result'=>$formData['uid']));  // Success
						//echo json_encode(array('success'=>true,'redirect'=>Base_url('user/profile')));
					}
				}
			} else {
				$this->response(array('status' => 1, "error"=>'Something wrong, Please contact to admin please!'));
			}
		}
	}
	}
	
	// User's Scheduled Booking 
	public function booking_post($uInfo){
		if (is_array($uInfo)) {
			$uInfo = $uInfo;
		} else {
			$uInfo = $this->user_model->getUserEmail($this->uri->segment(3));
		}
		
		$uid = $uInfo['id']; // User ID
		if (!$uid) {
			$this->response(array('status' => 1, "message"=>"Something is wrong."));
			exit;
		}
		
		$this->load->model('class_model');
		if ($uInfo['roleId']==0) {
			$classes = $this->class_model->getBySid($uid); // Get Student Schedule Booking Details
		} else {
			$classes = $this->class_model->getByTid($uid); // Get Tutor Schedule Booking Details
		}
		
		$timeNow	=	date('Y-m-d H:i:s',time());
		$timeNowStr	=	strtotime($timeNow);
		$response = array();
		if(count($classes)>0)
		{
			foreach($classes as $class)
			{
				$i = $class['id'];
				
				$respnse[$i]['sid'] = $class['sid'];
				// Get Student Details
				$studentDetails = $this->user_model->getByprofileUid($class['sid']);
				$respnse[$i][$class['sid']]	=	array(
													"firstname"	=>	$studentDetails['firstName'],
													"lastname"	=>	$studentDetails['lastName'],
													"email"		=>	$studentDetails['email'],			  
													"img"		=>	(!empty($studentDetails['pic'])) ? base_url("uploads/images/thumb")."/".$studentDetails['pic'] : "",
													"vedio"		=>	$studentDetails['vedio']
												);
				
				$respnse[$i]['tid'] = $class['tid'];
				// Get Tutor Details
				$tutorDetails = $this->user_model->getByprofileUid($class['tid']);
				$respnse[$i][$class['tid']]	=	array(
													"firstname"	=>	$tutorDetails['firstName'],
													"lastname"	=>	$tutorDetails['lastName'],  
													"email"		=>	$tutorDetails['email'],			  
													"img"		=>	(!empty($tutorDetails['pic'])) ? base_url("uploads/images/thumb")."/".$tutorDetails['pic'] : "",
													"vedio"		=>	$tutorDetails['vedio']
												);				
				
				$respnse[$i]['startTime'] = $class['startTime'];
				$respnse[$i]['endTime'] = $class['endTime'];
				$respnse[$i]['createAt'] = $class['createAt'];
				$respnse[$i]['session_type'] = $class['session_type'];
				$respnse[$i]['Booking'] = $class['Booking'];
			}
		}
		//$this->response($respnse, 200);
		$this->response(array('status' => 0, "uid"=>$uid, "sessions"=>$respnse));
	}
	
	// Update Password
	public function updatepassword_post()
	{
		if (($_GET['uid']!="") and ($_GET['password']!="")) {
			// Check User Exist
			$result = $this->user_model->getUserEmail($_GET['uid']);
			if ($result) {
				$result = $this->user_model->changePassword($_GET['uid'] , $_GET['password']);
				$this->response(array('status' => 0)); // Success Result
			} else {
				$this->response(array('status' => 1, "error"=>"User Not Exist")); // User Not Exist.
			}
		} else {
			$this->response(array('status' => 1,'error'=>'Something Wrong')); // Failed Result
		}
	}
	
	// Reset Password
	public function resetpassword_post(){
		// Check post data

        if ($_GET['email']!="") {
			$multi_lang = 'en'; // Set Lang
			$data	=	array();
			$data['email']	=	$_GET['email'];
			$this->load->model(array('lookup_model'));
			$arrVal					=	$this->lookup_model->getValue('962', $multi_lang);
			$passsent				=	$arrVal[$multi_lang];
			$arrVal					=	$this->lookup_model->getValue('963', $multi_lang);
			$incorrectmail			=	$arrVal[$multi_lang];
			$data['username']		=	$data['email'];
			$corect					=	$this->user_model->checkForgetInfo($data);
            if($corect){
                $info	=	$this->user_model->makeMd5Str($data);
			
                $link	=	Base_url("user/changepw?email=".base64_encode($info['email'])."&str=".base64_encode($info['str'])."&time=".$info['time']);
				
				$str = "A change of password has been requested for your account with Thetalklist.com.  If you initiated this, then click this link or copy it into a new browser:<a href='{$link}'>".$link."</a>\r\n<br/>";
                $str .= "\r\n<br/>";
                $str .= "This change request is good for 24 hours and applies to your account:\r\n<br/>";
                //$str .= "Username:{$info['username']}\r\n<br/>";
                $str .= "Email:{$info['email']}\r\n<br/>";
                $str .= "Request Time:".date('Y-m-d H:i:s',$info['time'])."\r\n<br/>";
                $str .= "\r\n<br/>";
                $str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
                $str .= "Thank you,           TheTalkList Support Team";
				$this->load->library('email');
                $this->email->mailtype = 'html';
                $this->email->from('admin@thetalklist.com','TheTalklist');
                $this->email->to($data['email']);
                $this->email->subject('Forget password in thetalklist.com by '.$info['username']);
                $this->email->message($str);
				$send = $this->email->send();
                if ($send) {
					$this->response(array('status' => 0,'message'=>$passsent)); // Success Result
				} else {
					$this->response(array('status' => 1,'error'=>'Email Sending Failed')); // Failed Result
				}
            } else {
                $this->response(array('status' => 1,'error'=>$incorrectmail)); // Failed Result
            }
        } else {
			$this->response(array('status' => 1,'error'=>'Something Wrong')); // Failed Result
		}
    }
	
	
	// Tutor Search
	public function tutorsearch_post(){
		
		
		
		//==========tutor search in progress =====//
 		
		/*	
			
			
			//$subject = $_GET['subject'];
			
			
			*/
			$user_id = $_GET['id'];
			if($user_id == ''){
				$user_id = '17431';
			}
			$keyword = $_GET['keyword'];
			/* $first_keyword  = substr($keyword, 0, strpos($keyword, ','));
			$second_part = substr($keyword, strpos($keyword, ",") + 1);
			if($first_keyword == '' || $second_part == ''){
				$first_keyword = $keyword;
				$second_part = $keyword;
			}
			$query_con =$this->db->query("select id from countries where country LIKE  '{$second_part}'");
			$result_con = $query_con->row_array(); */
			
			$cnd = "";
			$orderBy = "`user`.`readytotalk` DESC , `user`.`roleId` DESC, `profile`.`avgRate` DESC";
			if (!empty($keyword)) {
				$keywords = explode(',',trim($keyword));
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
					$cnd .= " OR `profile`.`tutoring_subjects` LIKE '%".$val."%' ";					
					$i++;
				}
				$cnd .= " ) ";
			
			//$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`fbshare`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`,`profile`.`nativeLanguage`,`profile`.`otherLanguage`, `profile`.`Lat`, `profile`.`pic`,`profile`.`school_id`, `profile`.`avgRate`, `profile`.`city`, `countries`.`country`, `provices`.`provice` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` INNER JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ";
			
			/*$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country`, `provices`.`provice` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` INNER JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ORDER BY RAND()"; */
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate`, `profile`.`avgRate`,`profile`.`lastName` , `profile`.`pic`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country`  WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`vid_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 and  `user`.`readytotalk` = 1 $cnd order by $orderBy , RAND()";
			}else{
				
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` 	,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country`  WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`vid_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 and  `user`.`readytotalk` = 1 order by $orderBy , RAND()";
				
			}
			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
			
		
			
			
			$query = $this->db->query($sql);
			
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
			//print_r($response['results']);
			//exit;
			$config = $this->profile_model->getConfig();
			foreach ($response['results'] as $res){
				$rate = $res['hRate'];
				$s_id = $res['uid'];
				
				$sqls = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $user_id AND tutor_id = $s_id";
				$queries = $this->db->query($sqls);
				$fav = $queries->result_array();
			//$favres = $this->db->query("select count(id) as isMyFavourite from favourite_tutor where student_id = '{$user_id}' AND tutor_id = '{$s_id}'");

				$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				//$profile_data[] = array_merge($favres,$fee);
				$profile = array_merge($res,$fav[0]);
				$final[] = array_merge($profile,$fee);
			}
	
			if(empty($response['results'])){
				$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>"No Results? Check spelling and limit your criteria."))));
			}else{
				$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$final))));
			}
			//print_r($response['results']);
			//exit;
			/*$this->db->select('nativeLanguage,otherLanguage');
			$this->db->from('profile');
			$this->db->where('uid',$student_id);
			$key = $this->db->get();
			$ret = $key->row_array();
			
			$firstLanguage = $ret['nativeLanguage'];
			$secondLanguage = $ret['otherLanguage'];  */
			
			
			
			/* $this->db->select('id');
			$this->db->from('countries');
			$this->db->like('country',$second_part);
			$key = $this->db->get();
			$ret = $key->row_array(); */
			$id =  $result_con['id'];
			
			$this->db->select('profile.uid,profile.hRate,user.readytotalk,profile.firstName,profile.lastName,profile.avgRate,user.roleId,profile.pic');
			$this->db->from('profile');
			$this->db->join('user',' profile.uid = user.id', 'inner');
			//$this->db->where('user.readytotalk',1);
			$this->db->where_in('user.roleId',array('1','2','3'));
			//$this->db->where('profile.nativeLanguage',$firstLanguage);
			//$this->db->where('profile.otherLanguage',$secondLanguage);
			$this->db->where("(profile.personal LIKE '%".$first_keyword."%' OR profile.professional LIKE '%".$first_keyword."%' OR profile.academic LIKE '%".$first_keyword."%' OR profile.personal LIKE '%".$second_part."%' OR profile.professional LIKE '%".$second_part."%' OR profile.academic LIKE '%".$second_part."%')", NULL, FALSE);
			//$Linkearray = array('profile.personal' => $first_keyword,'profile.professional' => $first_keyword,'profile.academic'=>$first_keyword);
			//$Linkearray2 = array('profile.personal' => $second_part,'profile.professional' => $second_part,'profile.academic'=>$second_part);
			//$this->db->or_like($Linkearray);
			//$this->db->or_like($Linkearray2);
			//$this->db->or_where("(profile.academic LIKE '%".$first_keyword."%' OR profile.professional LIKE '%".$first_keyword."%' OR profile.personal LIKE '%".$first_keyword."%')");
			//$this->db->or_where("(profile.academic LIKE '%".$second_part."%' OR profile.professional LIKE '%".$second_part."%' OR profile.personal LIKE '%".$second_part."%')");
			$query = $this->db->get();
			$result  = $query->result();
			if(empty($result)){
				$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>"No Results? Check spelling and limit your criteria."))));
			}else{
				$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$result))));
			}
			//$result = $query->result();
			
			
		
		
	}
	
	function tutor_readyToTalk_post(){
		$tid = $_GET['uid'];
		
		/* $this->db->select('readytotalk');
		$this->db->from('user');
		$this->db->where('id',$tid);
		$query = $this->db->get();
		$result  = $query->result(); */
		$query=$this->db->query("select readytotalk from user where id = '{$tid}'");
		$result = $query->row_array();
		
		if($result['readytotalk'] == '1'){
			$update = $this->db->query("update user set readytotalk = 0 where id = '{$tid}'");
			$this->response(array('status' => 0,'readytotalk'=>0));
		}else{
			$update = $this->db->query("update user set readytotalk = 1 where id = '{$tid}'");
			$this->response(array('status' => 0,'readytotalk'=>1));
		}
		
	}
	
	// Previous Teachers
	function myteachers_get(){
		//$this->_profile();
		$uid	=	$_GET['user_id'];//$this->uri->segment(3);	// Get Loggedin User ID		
		if ($uid*1 > 0) {
			$this->load->model(array('search_model','myTeacher_model'));	// Load My Teacher Model
			$teachers	=	$this->myTeacher_model->getAll($uid);	// Get My Previous Tutor
			$query  = $this->db->query("select refid from user where id='".$uid."'");
			$result = $query->row_array();
			//$this->layout->setData('Refid',$result['refid']);
			$classquery  = $this->db->query("SELECT exp_session,is_eligible from user where  user.id='".$uid."'");
			$classresult = $classquery->row_array();
			$cdate		 = date('Y-m-d');
			$free		 = '';
			if ($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1) {
				for($i=0;$i<count($teachers);$i++)
				{
					$teachers[$i]['hRate']="0.00";					
					if (!empty($teachers[$i]['pic'])) {
						$teachers[$i]['pic'] = base_url("uploads/images/thumb")."/".$teachers[$i]['pic'];
					}
				}
			} else {
				for($i=0;$i<count($teachers);$i++)
				{
					$markup = $this->search_model->GetSchoolMarkup($uid);
					$teachers[$i]['hRate']=$teachers[$i]['hRate'] + $markup;
					if (!empty($teachers[$i]['pic'])) {
						$teachers[$i]['pic'] = base_url("uploads/images/thumb")."/".$teachers[$i]['pic'];
					}
				}
			}
			$this->response(array('status' => 0,'tutors'=>$teachers));	// Response List of Teachers
		} else {
			$this->response(array('status' => 1,'message'=>"Something is wrong."));	// Response Failed
		}
	}
	
	// Tutor Calendar
	function calendar(){
		$uid	=	$this->uri->segment(3);	// Get Logged In User ID
		if ($uid*1 > 0) {
			$uri=$this->uri->segment(5);
		if ($uri == 'Join') {
			$this->layout->setData('uri',$uri);
		} else {
			$this->layout->setData('uri','');
		}
		$this->_profile();
		$this->load->model('class_model');
		$permisson = $this->getPermission($this->uid);
		if ($permisson=='teacher_public') {
			$this->layout->setData('school_id',$uri);
			$this->layout->setLayoutData('linkAttr','calender');
		}
		$classes = array();
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getBySid($this->uid);break;
			case 'teacher_private':$classes = $this->class_model->getByTid($this->uid);break;
			case 'studdent_public':break;

		}
		$timeNow = date('Y-m-d H:i:s',time());
		$timeNowStr = strtotime($timeNow);
		if (count($classes)>0) {
			$i = 0;
			foreach($classes as $class)
			{
				$classTimeStr = strtotime($class['startTime']);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
				 
				//checks for existing locked users
				$existsLocked = 0;
				if ($class['action'] != '') {
					$action = unserialize($class['action']);
					if ($this->session->userdata('roleId') == 0) {
						if (@$action['studentConnected'] == 1) {
							continue;
						}
					} else {
						if (@$action['tutorConnected'] == 1) {
							continue;
						}
					}
					
					if ($this->session->userdata('roleId') == 0) {
						if (@$action['slocked'] == 1) {
							$existsLocked = 1;
						}
					} else {
						if (@$action['tlocked'] == 1) {
							$existsLocked = 1;
						}
					}
				}
				
				//checks for user enters on class
				$lockedSession = 'locked_'.$class['id'];
				if ($this->session->userdata($lockedSession)) {
					if ($this->session->userdata($lockedSession) == 'No') {
						$sessionUser = 'No';
					} else {
						$sessionUser = 'Yes';
					}
				} else {
					$sessionUser = 'Yes';
				}
				
				if ($classDiffInMin < -3 && $sessionUser == 'Yes' && $existsLocked == 1) { 
					$classes[$i]['locked'] = 1;
					//echo 'here';die;
				} else {
					$classes[$i]['locked'] = 0;
				}
				
				if ($classes[$i]['Is_early'] == 1) {
					$classes[$i]['locked'] = 1;
				}
				$i++;
			}
		}
		
		$schoolTut = $this->profile_model->CheckIsSchoolTutor($this->uid);
		$Ismarkset=0;
		if ($schoolTut['school_id'] > 0) {
			$sql="select pic,curriculum,s_disc from profile where uid={$schoolTut['school_id']}";
			$query = $this->db->query($sql);
			$result = $query->row_array();
			$Ismarkset=$result['curriculum'];
		}
		$this->layout->setData('schtut',$schoolTut['school_id']);
		$this->layout->setData('Ismarkset',$Ismarkset); 
		$ReadyTalk = $this->profile_model->CheckIsonline($this->uid);
		$this->layout->setData('readyTalk',$ReadyTalk['readytotalk']);
		//print_r($classes);die;
		$chkfreesession = $this->search_model->chkfreesession($this->uid);
		$this->layout->setData('chkfreesession',$chkfreesession);		
		$this->layout->setData('classes',$classes);
        //$this->layout->setData('SessionCost','test');
		$uri=$this->uri->segment(5);
		$this->load->model("user_model");
		$config = $this->profile_model->getConfig();
		$configvalues = ((1+$config['VEE_PRICE_PERCENT']['value']) *100);
		//echo $this->uid." : ".$uri." : ".$this->session->userdata('uid');
		if($this->session->userdata('uid') =='')
		{
		}
		else
		{
			$this->layout->setData('SessionCost',$this->user_model->getsesstioncostnew($this->session->userdata('uid'),$configvalues,$this->uid));
		}
		}
		$this->load->helper('date');
		$this->layout->view($this->getViewTemp($this->uid,'user/calendarnew'));			
	}
	
	//DELETE CLASS FUNCTION
	public function deleteclass_post()
	{
		$_data = $this->input->post();
		$result = $this->api_model->checkClassID($_data['cid'], $_data['uid']);
		if(empty($_data['uid']))
		{
			$this->response(array('status' => 1,'error'=>'Something is wrong.')); // Failed Result
		}
		elseif(empty($result))
		{
			$this->response(array('status' => 1,'error'=>'Class is not found.')); // Failed Result
		}
		else
		{
			$this->load->model('class_model');
			$this->load->model('pay_model');
			
			// Call getRoleID Function of api_model
			$result = $this->api_model->getRoleID($_data['uid']);
			
			// TECHNO-SANJAY added below code for update user free session status
			if($result['roleId'] == '2' || $result['roleId'] == '3' || $result['roleId'] == '1')
			{
				$rs = $this->class_model->getByCid($_data['cid']);
				//$this->profile_model->updateFreeSession($rs['sid']);
				$revertfee = $rs['fee'];
				$studentid = $rs['sid'];
			}else
			{
				$rs = $this->class_model->getBySid($_data['uid']);
				if(count($rs) == 1)
				{
					$revertfee = $rs[0]['fee'];
					$studentid = $rs[0]['sid'];
				}else{
					$this->response(array('status' => 1,'error'=>'No scheduled session.')); // Failed Result
				}
			}
			/* Added by haren to Re-generate Free session Coupon */
			$ClsId=$_data['cid'];
			$ClassInfo = $this->class_model->GetClassDetail($ClsId);
			if($ClassInfo !=array())
			{
				$studId=$ClassInfo['sid'];
				if($ClassInfo['session_type']=='free' ||  $ClassInfo['session_type']=='Free' || $ClassInfo['session_type']=='FREE')
				{
				  $this->class_model->RegenerateCoupon($studId);
				}
			}
			if($studentid)
			/* Haren code End   */
			$checkfreesession = "select free_session from user where id = {$studentid}";			
			$checkquery = $this->db->query($checkfreesession);
			if ($checkquery->num_rows() > 0)
			{
				$resultTeachers = $checkquery->result_array();
				if($resultTeachers[0]['free_session'] != 'y'){
					$feeSql = "update profile set money=money+{$revertfee} , frMoney=frMoney-{$revertfee} where uid={$studentid}";
					$query = $this->db->query($feeSql);
				}
			}
			
           	//$this->message_send_cancel_class($this->input->_request('id'));
			$this->class_model->delById($_data['cid'],$_data['uid']);
			
			if($rs)
			{
				$this->pay_model->calcel_disputes($rs);
			}
			$this->response(array('status' => 0,'message'=>'Class has been cancelled successfully.')); // Success Result
		}
	}
	
	
	
	public function index_get()
	{
		// Display all 
		//$this->response($this->db->get('user')->result_array());
		$this->response(NULL, 400);
	}
	
	function user_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 		
        $user = $this->client_model->getMCInfo( $this->get('id') );
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function user_post()
    {
        $result = $this->user_model->update( $this->post('id'), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
         
    }
     
    function users_get()
    {
        $users = $this->user_model->get_all();
         
        if($users)
        {
            $this->response($users, 200);
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function updateRoleID_post(){
		
		if ($_GET['email']!="") {
			// Check User Exist
			$result = $this->api_model->updateUserRole($_GET['email'],$_GET['roleId']);
			$this->response(array('status' => 0)); // Success Result
		} else {
			$this->response(array('status' => 1,'error'=>'Something Wrong')); // Failed Result
		}
	}
	
	function updateProfile_post(){

		if ($_GET['userid']!="") {
			if($_GET['userid'] !="" && $_GET['country'] != "" && $_GET['state'] != "" && $_GET['city'] != "" && $_GET['gender'] != "" && 
			$_GET['language1'] != "" &&	 $_GET['language2'] != "" && $_GET['firstName'] != "" && $_GET['lastName'] != ""){
			// Check User Exist
			$this->db->select('id');
			$this->db->from('countries');
			$this->db->where('country', $_GET['country']);
			$query = $this->db->get();
			$result = $query->row_array();
			
			if($_GET['state'] == 'state'){
				 $result_state['id'] = 2;
			}else{
				$this->db->select('id');
				$this->db->from('provices');
				$this->db->where('provice', $_GET['state']);
				$query_state = $this->db->get();
				$result_state = $query_state->row_array();
			}
			
			$_data['userid'] = $_GET['userid'];
			$_data['country'] = $result['id'];
			
			
			$_data['firstName'] = $_GET['firstName'];
			$_data['lastName'] = $_GET['lastName'];
			$_data['state'] = $result_state['id'];
			$_data['city'] = ucwords($_GET['city']);
			
			$_data['cell'] = $_GET['cell'];
			
			/* if($_GET['gender'] == 'Male'){
				$gender = '1';
			}else{
				$gender = '0';
			} */
			$_data['gender'] = $_GET['gender'];
			
			$_data['language1'] = $_GET['language1'];
			$_data['language2'] = $_GET['language2'];
			//$_data['birthdate'] = $_GET['birthdate'];
			$_data['age'] = $_GET['age'];

			//$dob = $this->input->post('birthdate');
			//$birthdate = strtotime($dob);
			//$nowdate = time();
			//$datediff = $nowdate - $birthdate;
			//$_date['age'] = floor($datediff/(60*60*24*365));

			$result = $this->api_model->updateUserProfile($_data);
			$this->response(array('status' => 0)); // Success Result
			}else{
				$this->response(array('status' => 1,'error'=>'please fill up')); // Failed Result
			}
		} else {
			$this->response(array('status' => 1,'error'=>'Something Wrong')); // Failed Result
		}
	}
	function countries_post(){
	
		$users = $this->api_model->get_countries();
		if($users){
			$this->response(array('status' => 0,'countries'=>$users));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	
	function states_post(){
	
		$users = $this->api_model->get_states();
		if($users){
			$this->response(array('status' => 0,'states'=>$users));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	
	function tutor_list_post(){
		$data = $this->api_model->get_tutors();
		if($users){
			$this->response(array('status' => 0,'tutors'=>$users));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	
	function profile_pic_post(){
		 //$uid = $_GET['uid'];
         //$image = $_GET['image'];
		 
		//$this->load->helper(array('form', 'url'));
		 $uid = $this->input->post('uid');		
		 $image = $this->input->post('image');
		
		$year = date("Y");   
		$month = date("m");   
		$date = date("d");
		
		$img = str_replace('data:image/jpeg;base64,', '', $image);
		$imges = str_replace(' ', '+', $img);
		$data = base64_decode($imges); 
		
		$filename = md5(uniqid(rand(), true));
		if (!file_exists('uploads/images/'.$year)) {
			mkdir('uploads/images/'.$year, 0777, true);
		}
		if (!file_exists('uploads/images/'.$year.'/'.$month)) {
			mkdir('uploads/images/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/images/'.$year.'/'.$month.'/'.$date)) {
			
			mkdir('uploads/images/'.$year.'/'.$month.'/'.$date, 0777, true);
		}
		
		if (!file_exists('uploads/images/thumb/'.$year)) {
			mkdir('uploads/images/'.$year, 0777, true);
		}
		if (!file_exists('uploads/images/thumb/'.$year.'/'.$month)) {
			mkdir('uploads/images/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/images/thumb/'.$year.'/'.$month.'/'.$date)) {
			
			mkdir('uploads/images/thumb/'.$year.'/'.$month.'/'.$date, 0777, true);
		}
		
		if (!file_exists('uploads/images/resized/'.$year)) {
			mkdir('uploads/images/resized/'.$year, 0777, true);
		}
		if (!file_exists('uploads/images/resized/'.$year.'/'.$month)) {
			mkdir('uploads/images/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/images/resized/'.$year.'/'.$month.'/'.$date)) {
			
			mkdir('uploads/images/resized/'.$year.'/'.$month.'/'.$date, 0777, true);
		}
		
		$file = 'uploads/images/'.$year.'/'.$month.'/'.$date.'/'.$filename.'.jpg';
		$file_thumb = 'uploads/images/thumb/'.$year.'/'.$month.'/'.$date.'/'.$filename.'.jpg';
		$file_resized = 'uploads/images/resized/'.$year.'/'.$month.'/'.$date.'/'.$filename.'.jpg';
		$imgname = $year.'/'.$month.'/'.$date.'/'.$filename.'.jpg';
		
	
		/*
		$config['upload_path'] = 'uploads/images/'.$year.'/'.$month.'/'.$date.'/'.$filename;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->response(array('status' => 1,'error'=>$error));
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$sql = "UPDATE profile set pic = '{$imgname}' WHERE uid = '{$uid}' ";
			$query = $this->db->query($sql);
			
			$this->response(array('status' => 0,'upload_success'=> $data));

			//$this->load->view('upload_success', $data);
		}  */
		
		$info = file_put_contents($file, $data);
		$info_thumb = file_put_contents($file_thumb, $data);
		$info_resized = file_put_contents($file_resized, $data);
		
		if($info){
			$sql = "UPDATE profile set pic = '{$imgname}', pic_upload = 1 WHERE uid = '{$uid}' ";
			$query = $this->db->query($sql);
			
			$this->response(array('status' => 0));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		
		} 
	}
	function profile_video_post(){
		$uid = $this->input->post('uid');
		$video = $this->input->post('video');
		//$uid = $_GET['uid'];
		//$video = $_GET['video'];
		//$subject = $this->input->post('subject');
		//$title = $this->input->post('title');
		//$description = $this->input->post('description');

		$year = date("Y");   
		$month = date("m");   
		$date = date("d");
		
		$data = base64_decode($video);
			
		
		$filename = md5(uniqid(rand(), true));
		
	 if (!file_exists('uploads/video/'.$year)) {
			mkdir('uploads/video/'.$year, 0777, true);
		}
		if (!file_exists('uploads/video/'.$year.'/'.$month)) {
			mkdir('uploads/video/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/video/'.$year.'/'.$month.'/'.$date)) {
			mkdir('uploads/video/'.$year.'/'.$month.'/'.$date, 0777, true);
		}
		$file = 'uploads/video/'.$year.'/'.$month.'/'.$date.'/'.$filename.'.mp4';
		$videoname = $year.'/'.$month.'/'.$date.'/'.$filename.'.mp4';
		$info = file_put_contents($file, $data);
		
		if($info){
			/* $data = array(
					'uid'=>$uid,
					'name'=>$title,
					'creat_at'=>date('Y-m-d H:i:s'),
					'desc' => $description,
					'source' => $videoname,
					'subject' =>$subject
				);				 
				$this->db->insert('lessons', $data); */
				$sql = "UPDATE profile set vedio = '{$videoname}' WHERE uid = '{$uid}' ";
				$query = $this->db->query($sql);
			
				$this->response(array('status' => 0));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		
		}
		
	/*	$configVideo['upload_path'] = 'uploads/video/'.$year.'/'.$month.'/'.$date; # check path is correct
		$configVideo['max_size'] = '10000000';
		$configVideo['allowed_types'] = 'mp4|wmv'; # add video extenstion on here
		$configVideo['overwrite'] = FALSE;
		$configVideo['remove_spaces'] = TRUE;
		$video_name = random_string('numeric', 5);
		$configVideo['file_name'] = $video_name;

		$this->load->library('upload', $configVideo);
		$this->upload->initialize($configVideo); 

		if (!$this->upload->do_upload('uploadan')) # form input field attribute
		{
			# Upload Failed
			$this->session->set_flashdata('error', $this->upload->display_errors());
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
		else
		{
			# Upload Successfull
			$url = 'uploads/images/'.$year.'/'.$month.'/'.$date;
			$sql = "UPDATE profile set vedio = '{$url}' WHERE uid = '{$uid}' ";
			$this->session->set_flashdata('success', 'Video Has been Uploaded');
			$this->response(array('status' => 0));
		}  */
		
		
	}		
		
	/*	$vdo = str_replace('data:video/mp4;base64,', '', $video);
		
		$vdo = str_replace(' ', '+', $vdo);
		$data = base64_decode($vdo);

		$filename = md5(uniqid(rand(), true));
		if (!file_exists('uploads/images/'.$year)) {
			mkdir('uploads/images/'.$year, 0777, true);
		}
		if (!file_exists('uploads/images/'.$year.'/'.$month)) {
			mkdir('uploads/images/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/images/'.$year.'/'.$month.'/'.$date)) {
			mkdir('uploads/images/'.$year.'/'.$month.'/'.$date, 0777, true);
		}
		
		$file = 'uploads/images/'.$year.'/'.$month.'/'.$date.'/'.$filename.'.mp4';
		$videoname = $year.'/'.$month.'/'.$date.'/'.$filename.'.mp4';
		$info = file_put_contents($file, $data);
		
		if($info){
			$sql = "UPDATE profile set vedio = '{$videoname}' WHERE uid = '{$uid}' ";
			$query = $this->db->query($sql);
			
			$this->response(array('status' => 0));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		
		}
	} */
	function video_upload_test_post(){
		$uid = $this->input->post('uid');
		//$video = $_GET['video'];
		$subject = $this->input->post('subject');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$bio = $this->input->post('bio');
		$year = date("Y");   
		$month = date("m");   
		$date = date("d");	
			
		if (!file_exists('uploads/video/'.$year)) {
			mkdir('uploads/video/'.$year, 0777, true);
		}
		if (!file_exists('uploads/video/'.$year.'/'.$month)) {
			mkdir('uploads/video/'.$year.'/'.$month, 0777, true);
		}
		if (!file_exists('uploads/video/'.$year.'/'.$month.'/'.$date)) {
			mkdir('uploads/video/'.$year.'/'.$month.'/'.$date, 0777, true);
		}	
		$target_path = 'uploads/video/'.$year.'/'.$month.'/'.$date.'/';		
			
			
			// Path to move uploaded files
			//$target_path = "uploads/";
			 
			// array for final json respone
			$response = array();
			 
			// getting server ip address
			 $server_ip = gethostbyname(gethostname());
			 
			// final file url that is being uploaded
			 $file_upload_url = 'http://' . $server_ip  . '/' . $target_path;
			 
			if (isset($_FILES['video']['name'])) {
				$target_path = $target_path . basename($_FILES['video']['name']);
				$targeted_path = 'uploads/video/'.$year.'/'.$month.'/'.$date.'/' . basename($_FILES['video']['name']).'.jpg';
				// reading other post parameters
				//$email = isset($_POST['email']) ? $_POST['email'] : '';
				//$website = isset($_POST['website']) ? $_POST['website'] : '';
			 
				$response['file_name'] = basename($_FILES['video']['name']);
				//$response['email'] = $email;
				//$response['website'] = $website;
			 
				try {
					// Throws exception incase file is not being moved
					if (!move_uploaded_file($_FILES['video']['tmp_name'], $target_path)) {
						// make error flag true
						$response['error'] = true;
						$response['message'] = 'Could not move the file!';
						$this->response(array('status' => 1,'response'=>$response));
					}else{
					/* $this->load->library('media','upload');
					$translateConfig['image_library'] = 'gd2';
					//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
					$translateConfig['image'] = FCPATH.'uploads/video/images/';
					$translateConfig['path'] = FCPATH.'uploads/video/';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['width'] = 706;
					$translateConfig['height'] = 399;
					$infos = $this->media->translate($translateConfig)->getInfo(); */
					// File successfully uploaded
					if($bio == 1){
						$path = $year.'/'.$month.'/'.$date.'/' .basename($_FILES['video']['name']);
						$query = $this->db->query("update `profile` set `vedio` = '$path' , `vid_upload` = '1' where `uid` = '$uid'");
						$response['message'] = 'File uploaded successfully!';
						$response['error'] = false;
						$response['file_path'] = $file_upload_url . basename($_FILES['video']['name']);
						$response['thumbnail'] = $file_upload_url . basename($_FILES['video']['name']).'.jpg';
						$this->response(array('status' => 0,'response'=>$response));
						
					}else{
						$data = array(
						
							'uid'=>$uid,
							'name'=>$title,
							'creat_at'=>date('Y-m-d H:i:s'),
							'desc' => $description,
							'source' => $year.'/'.$month.'/'.$date.'/' .basename($_FILES['video']['name']),
							'subject' =>$subject
						);				 
						$this->db->insert('lessons', $data);
						$response['message'] = 'File uploaded successfully!';
						$response['error'] = false;
						$response['file_path'] = $file_upload_url . basename($_FILES['video']['name']);
						$response['thumbnail'] = $file_upload_url . basename($_FILES['video']['name']).'.jpg';
						$this->response(array('status' => 0,'response'=>$response));
					}
					}
				} catch (Exception $e) {
					// Exception occurred. Make error flag true
					$response['error'] = true;
					$response['message'] = $e->getMessage();
					$this->response(array('status' => 1,'response'=>$response));
				}
			} else {
				// File parameter is missing
				$response['error'] = true;
				$response['message'] = 'Not received any file!F';
				$this->response(array('status' => 1,'response'=>$response));
			}
			 
			// Echo final json response to client
			//$this->response(array('status' => 0,'response'=>$response));
		
	}
	
	function videolist_post(){
		$uid = $_GET['uid'];
		$videos = $this->api_model->get_videos();
		foreach($videos as $video){
			$vid = $video->id;
			$favres = "select count(id) as isMyFavourite from video_likes where vid = '{$vid}' AND uid = '{$uid}'";
			$query = $this->db->query($favres);
			$response['results'] = $query->row_array();
			$data[] = array_merge((array) $video, (array) $response['results']);
		}
		
		if($videos){
			$this->response(array('status' => 0,'videos'=>$data));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	
	function video_like_post(){
		$uid = $_GET['uid'];
		$vid = $_GET['vid'];
		
		$check_like = $this->api_model->check_like($uid,$vid);
		
		if($check_like['status'] == 1){
			$delete_like = $this->api_model->video_dislike($uid,$vid);			
				if($delete_like){
					$this->response(array('status' => 0,'like'=>1,'message'=>'Successfully Disliked.'));
				}else{
					$this->response(array('status' => 1,'error'=>'Something Wrong'));
				}
		}else{
			$like = $this->api_model->video_like($uid,$vid);
				if($like){
					$this->response(array('status' => 0,'like'=>0,'message'=>'Successfully Liked.'));
				}else{
					$this->response(array('status' => 1,'error'=>'Something Wrong'));
				}
		}
		
		
	} 
	
	function video_views_post(){
		$uid = $_GET['uid'];
		$vid = $_GET['vid'];
		
		$views = $this->api_model->video_views($uid,$vid);
		if($views){
			$this->response(array('status' => 0,'message'=>'User Views Video.'));
		}else{
			$this->response(array('status' => 1,'message'=>'Something Wrong.'));
		}	
	}
	
	
	function videosearch_post(){
		
		$keyword = $_GET['keyword'];
		
		$cnd = "";
			
			if (!empty($keyword)) {
				$keywords = explode(',',trim($keyword));
				//$cnd .= " and ( ";
				$i=1;
				foreach($keywords as $key=>$val){
					if($val==''){
						continue;
					}
					if ($i>1) {
						$cnd .= " OR ";
					}
					$cnd .= " `lessons`.`name` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`firstName` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`lastName` LIKE '%".$val."%' ";	
					$i++;
				}
				//$cnd .= " ) ";
			
			
		$sql = "SELECT `lessons`.`id`,  `lessons`.`name`, `lessons`.`desc`,`lessons`.`source`,`lessons`.`views`,`profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`  from `lessons` INNER JOIN `profile` ON  `lessons`.`uid` = `profile`.`uid` WHERE $cnd";
			}else{
				$sql = "SELECT `lessons`.`id`,  `lessons`.`name`, `lessons`.`desc`,`lessons`.`source`,`lessons`.`views`,`profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`  from `lessons` INNER JOIN `profile` ON  `lessons`.`uid` = `profile`.`uid`";
				
			}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
			if(empty($response['results'])){
				$this->response(json_decode(json_encode(array('status' => 0,'videos'=>"No Results? Check spelling and limit your criteria."))));
			}else{
				$this->response(json_decode(json_encode(array('status' => 0,'videos'=>$response['results']))));
			}
	}
	
	function tutoring_subject_post(){
		$t_id = $_GET['tutor_id'];
		$subject = $this->api_model->get_subject($t_id);
		//foreach($subject as $sub){
		//	$tut = $sub->tutoring_subjects;
		//}
		
		//echo $tut;
		//exit;
		if($subject){
			$this->response(array('status' => 0,'subjects'=>$subject));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	function tutoring_video_post(){
		$t_id = $_GET['tutor_id'];
		$video = $this->api_model->tutor_video($t_id);
		
		if($video){
			$this->response(array('status' => 0,'video'=>$video));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	function firebase_register_post(){
		$user_id = $_GET['user_id'];
		$reg_id = $_GET['reg_id'];
		$query = $this->db->query("update profile set  firebase_regId = '{$reg_id}' where uid='{$user_id}'");
		if($query){
			$this->response(array('status' => 0));
		}else{
			$this->response(array('status' => 1));
		}
		
		
	}
	
	public function tutor_availability_post(){
		$uid = $_GET['uid'];
		$startTime = $_GET['startTime'];
		$endTime = $_GET['endTime'];
		$sunday = $_GET['sunday'];
		$monday = $_GET['monday'];
		$tuesday = $_GET['tuesday'];
		$wednesday = $_GET['wednesday'];
		$thursday = $_GET['thursday'];
		$friday = $_GET['friday'];
		$saturday = $_GET['saturday'];
		
		$check = $this->api_model->tutor_availability_check($uid);
		
		if(!isset($check['uid'])){
			$data = array(
				'uid'=>$uid,
				'start_time'=>$startTime,
				'end_time'=>$endTime,
				'sunday' =>$sunday,
				'monday' =>$monday,
				'tuesday' =>$tuesday,
				'wednesday' =>$wednesday,
				'thursday' =>$thursday,
				'friday' =>$friday,
				'saturday' =>$saturday
				
			);
			$insert = $this->db->insert('tutor_availability', $data);
			if($insert){
				$this->response(array('status' => 0));
			}else{
				$this->response(array('status' => 1));
			}
			
		}else{
			$data = array(
				'start_time'=>$startTime,
				'end_time'=>$endTime,
				'sunday' =>$sunday,
				'monday' =>$monday,
				'tuesday' =>$tuesday,
				'wednesday' =>$wednesday,
				'thursday' =>$thursday,
				'friday' =>$friday,
				'saturday' =>$saturday
				
			);
			$update = $this->api_model->tutor_availability_update($check['uid'],$data);
			if($update){
				$this->response(array('status' => 0));
			}else{
				$this->response(array('status' => 1));
			}
		}
	}
	
	function tutor_availability_info_post(){
		$uid = $_GET['uid'];
		$info = $this->api_model->tutor_availability_info($uid);
		if($info){
			$this->response(array('status' => 0,'info'=>$info));
		}else{
			$this->response(array('status' => 1,'message'=>'Not Set.'));
		}
		
	}
	
	function firebase_call_post(){
		$sender_id = $_GET['sender_id'];
		$receiver_id = $_GET['receiver_id'];
		
		$this->db->select('firstName,pic,firebase_regId');
		$this->db->from('profile');
		$this->db->where('uid', $receiver_id);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1){
			$result = $query->row_array();
		}	
		
		$this->db->select('firstName,pic');
		$this->db->from('profile');
		$this->db->where('uid', $sender_id);
		$query_send = $this->db->get();
		
		if ($query_send->num_rows() == 1){
			$sender = $query_send->row_array();
		}
		
		$this->db->select('readytotalk');
		$this->db->from('user');
		$this->db->where('id', $receiver_id);
		$readytotalk = $this->db->get();
		
		if ($readytotalk->num_rows() == 1){
			$results = $readytotalk->row_array();
		}	
		
		if($results['readytotalk'] == 1){
		if($result){

		/*	$title = "call";
			$message = "call";
			$push_type = "individual";
			
			$firebase = new Firebase();
			$push = new Push();
			
			$include_image = '';

			$push->setTitle($title);
			$push->setMessage($message);
			if ($include_image) {
				$push->setImage($sender['pic']);
			} else {
				$push->setImage('');
			}
			$push->setIsBackground(FALSE);
			//$push->setPayload($payload);
			$push->name($sender['firstName']);
	 	 
			$json = '';
			$response = '';
			if ($push_type == 'topic') {
				$json = $push->getPush();
				$response = $firebase->sendToTopic('global', $json);
			} else if ($push_type == 'individual') {
				$json = $push->getPush();
				$regId = isset($result['firebase_regId']) ? $result['firebase_regId'] : '';
				$response = $firebase->send($regId, $json);
			}				 
			$this->response(array('status' => 0,'detail'=>$result));
		}else{
			$this->response(array('status' => 1));
		} */
		
		$title = "call";
		$message =  "call";
		$push_type = "individual";

		$firebase = new Firebase();
        $push = new Push();
 
        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        $include_image = $sender['pic'];

        //URL
         //$URL = isset($_POST['url']) ? $_POST['url'] : '';
		 $data = array(
			'tid'=>$receiver_id,
			'sid'=>$sender_id,
			'startTime'=>date('Y-m-d H:i:s'),
			'createAt' =>date('Y-m-d H:i:s')
		);
		 
		$this->db->insert('class', $data);
		$class_id = $this->db->insert_id();
       
		$push->setTitle($title);
        $push->setMessage($message);
		$push->setName($sender['firstName']);
		$push->setClassId($class_id);
		$push->setId($sender_id);
        if ($include_image) {
            $push->setImage($sender['pic']);
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
 
 
        $json = '';
        $response = '';
 
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($result['firebase_regId']) ? $result['firebase_regId'] : '';
            $response = $firebase->send($regId, $json);
        }
			$this->response(array('status' => 0,'detail'=>$result,'cid'=>$class_id));
		}else{
			$this->response(array('status' => 1));
		
		
		}
	}else{
		$this->response(array('status' => 1,'error'=>'tutor is not online.'));
	}		
	}
	
	function openTok_connect_post(){
		$apiKey = $data['apiKey'] = '23275932' ;
		//$apiKey = $data['apiKey'] = '45814182';
		$api_secret = "b5aa20702348f20f74465950ead140ccbd4f770c";
		//$api_secret = "4c111382cd5a8794e407490379a31d3638086c2d";
		
		$this->load->model(array('class_model','user_model'));
		$sender_id = $_GET['sender_id'];
		$receiver_id = $_GET['receiver_id'];
		$classId = $_GET['cid'];

			
		$class = $this->class_model->getNearClassById($classId);

		if(!empty($class)){
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);

			if($class['tid'] == $sender_id){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'].$class['sid'];
			}else if($class['sid'] == $sender_id){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'].$class['tid'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');

			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
			    $class['endTime'] = date("Y-m-d H:i:s", strtotime('+1 hour'));
			
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::PUBLISHER, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::PUBLISHER, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
			
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			
			}
			$this->response(array('status' => 0,'token'=>$token,'sessionId'=>$sessionId,'apiKey'=>$apiKey));
		}else{
			$this->response(array('status' => 1));						
		}
	}
	
	function firebase_rejectcall_post(){
		$sender_id = $_GET['sender_id'];
		$receiver_id = $_GET['receiver_id'];
		$classId = $_GET['cid'];
		
		
		$delete = $this->db->query("DELETE FROM class WHERE id ='{$classId}'");
		
		$this->db->select('firebase_regId');
		$this->db->from('profile');
		$this->db->where('uid', $receiver_id);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1){
			$result = $query->row_array();
		}
		
		$firebase = new Firebase();
        $push = new Push();
		
		$push_type = "individual";
		$title = "rejectCall";
		$message = '';
		
        $push->setTitle($title);
        $push->setMessage($message);
     
        $push->setIsBackground(FALSE);
       // $push->setPayload($payload);
		
        $json = '';
        $response = '';
		
		
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($result['firebase_regId']) ? $result['firebase_regId'] : '';
            $response = $firebase->send($regId, $json);
        }
         if ($json != '') {
                  return json_encode($json);
                 } 
                 if ($response != '') { 
                  return  json_encode($response);
                 }
		
	}
	
	function veesession_connect_post(){
		$classId = $_GET['cid'];
		$startTime = date('Y-m-d H:i:s');
		$query = $this->db->query("update class set  startTime =  '{$startTime}'  where id='{$classId}'");
		
		if($query){
			$this->response(array('status' => 0));		
		}else{
			$this->response(array('status' => 1));		
		}
		
	}
	
	function veesession_disconnect_post(){	
		$classId = $_GET['cid'];
		$endTime = date('Y-m-d H:i:s');
		$query = $this->db->query("update class set  endTime =  '{$endTime}' , s_attend = 1 where id='{$classId}'");
		
		if($query){
			$this->response(array('status' => 0));		
		}else{
			$this->response(array('status' => 1));		
		}
	}
		
	function stripe_payment_post(){
		//Test Keys
		
		/*  $stripe_keys = array(
			"secret_key" => "sk_test_T6LaxWB25F7pDgCJhmaAwYnZ",
			"publishable_key" => "pk_test_m2095bSj8vVA0n55nBjcBRDH"
		); */
		//Test Keys Customers
	 /*	$stripe_keys = array(
			"secret_key" => "sk_test_BFk8dfmbsFffFcrDX0coNX05",
			"publishable_key" => "pk_test_lY8qjvjuPEEyX8mX1ovIEsN7"
		); */
		
		//live Keys
		 /*$stripe_keys = array(
			"secret_key" => "sk_live_bdchVamzmkLHkDazMkSSQyrX",
			"publishable_key" => "pk_live_cZQHiFEshZyEHQrIzyqc2rA9"
		); */
		
		$stripe_keys = array(
			"secret_key" => "sk_live_Xc8oddu0JrUKsHho9smfnsVA",
			"publishable_key" => "pk_live_ERuUHGMtI96h5FOLEy0NrU4C"
		); 

		\Stripe\Stripe::setApiKey($stripe_keys["secret_key"]);
		$token = $_GET['access_token'];//$this->input->post("stripeToken");
		$id = $_GET['id'];
		$amount = $_GET['amount'];
		if($amount == '50'){
			$amount = $amount + 2;
		}else if($amount == '100'){
			$amount = $amount + 5;
		}else if($amount == '10'){
			$amount = 10;
		}
		$convert_cent = $amount * 100;
		
		
		try {
		  $charge = \Stripe\Charge::create(array(
			"amount" => $convert_cent, // amount in cents, again
			"currency" => "usd",
			"source" => $token,
			"description" => "User Payment."
			));
			if ($charge) {
				if($amount == 10){
					$feeSql = "update profile set money=money+{$amount},ttl_points = ttl_points+10  where uid={$id}";
					$query = $this->db->query($feeSql);
				}else{
					$feeSql = "update profile set money=money+{$amount} where uid={$id}";
					$query = $this->db->query($feeSql);
				}
				$this->db->where('uid', $id);
				$delete = $this->db->delete('low_balance_notification');
				//$query = $this->db->query("update user set money =  '{$endTime}' , s_attend = 1 where id='{$classId}'");
                echo json_encode(array('status' => 0, 'success' => 'Payment successfully completed.'));
                exit();
            } else {
                echo json_encode(array('status' => 1, 'error' => 'Something went wrong. Try after some time.'));
                exit();
            }
			//$this->response(array('status' => 0));
		  } catch(\Stripe\Error\Card $e) {
				echo json_encode(array('status' => 1, 'error' => 'Invalid Card. Please try again with another credit card'));
                exit();
			//$this->session->set_flashdata("errors", "Invalid Card. Please try again with another credit card");
		  }
			
	}
	function message_post(){
		$sender = $_GET['sender_id'];
		$receiver =  $_GET['receiver_id'];
		$messages =  $_GET['message'];
		$sender_name = $_GET['user_name'];
		date_default_timezone_set('America/Los_Angeles');
		$time = date('Y-m-d H:i:s');
		
		$this->db->select('firebase_regId');
		$this->db->from('profile');
		$this->db->where('uid', $receiver);
		$query = $this->db->get();
		
			if ($query->num_rows() == 1){
				$result = $query->row_array();
			}
		
		$this->db->select('id');
		$this->db->from('chat_room');
		$array = array('participant1_id'=>$sender,'participant2_id'=>$receiver);
		$this->db->where($array);
		//$check = $this->db->get();
		$check = $this->db->get()->row()->id;
		
		$this->db->select('id');
		$this->db->from('chat_room');
		$array = array('participant1_id'=>$receiver,'participant2_id'=>$sender);
		$this->db->where($array);
		//$check = $this->db->get();
		$check_two = $this->db->get()->row()->id;

		
		if($check == '' && $check_two == ''){			
			$data = array(
					'participant1_id'=>$sender,
					'participant2_id'=>$receiver,
					'created_at'=>date('Y-m-d H:i:s')
				);				 
				$this->db->insert('chat_room', $data);
				$chatRoom_id = $this->db->insert_id();
				
		}else{
			$this->db->select('id');
			$this->db->from('chat_room');
			$array = array('participant1_id'=>$receiver,'participant2_id'=>$sender);
			$this->db->where($array);
			$chatRoom_id = $this->db->get()->row()->id;	
			
			if($chatRoom_id == ''){
				$this->db->select('id');
				$this->db->from('chat_room');
				$arrays = array('participant1_id'=>$sender,'participant2_id'=>$receiver);
				$this->db->where($arrays);
				$chatRoom_id = $this->db->get()->row()->id;
			}
		}
		$data = array(
				'chat_room_id'=>$chatRoom_id,
				'user_id'=>$sender,
				'user_name'=>$sender_name,
				'message'=>$messages,
				'time'=>date('Y-m-d H:i:s')
			);				 
		
		$insert = $this->db->insert('messages', $data);
		
		if($insert){
			$query = $this->db->query("update chat_room set  last_message_time = '{$time}'  where id='{$chatRoom_id}'");
			
			
			//================  Firebase Push Notification code ========================//
			
			 $push_type = 'individual';
			$title = 'msg';
			$message = 'msg';
			
			$firebase = new Firebase();
			$push = new Push();
			
			$push->setTitle($title);
			$push->setMessage($messages);
			$push->setImage('');
			
			$push->setuserId($sender);
			$push->setuserMessage($messages);
			$push->setuserName($sender_name);
			$push->setmessageTime($time);
			
			$push->setIsBackground(FALSE);
	 
			$json = '';
			$response = '';
			
			if ($push_type == 'topic') {
				$json = $push->getPushed();
				$response = $firebase->sendToTopic('global', $json);
			} else if ($push_type == 'individual') {
				$json = $push->getPushed();
				$regId = isset($result['firebase_regId']) ? $result['firebase_regId'] : '';
				$response = $firebase->send($regId, $json);
			} 
			
			$this->response(array('status' => 0));
		}else{
			$this->response(array('status' => 1, "error"=>"Something wrong."));
		}
	
	}
	
	function all_messages_post(){
		$sender = $_GET['sender_id'];
		$receiver =  $_GET['receiver_id'];
		
		$this->db->select('id');
		$this->db->from('chat_room');
		$array = array('participant1_id'=>$receiver,'participant2_id'=>$sender);
		//$arrays = array('participant1_id'=>$sender,'participant2_id'=>$receiver);
		$this->db->where($array);
		//$this->db->or_where($arrays);
		//$check = $this->db->get();
		$chatRoom_id = $this->db->get()->row()->id;	
		if($chatRoom_id == ''){
			$this->db->select('id');
			$this->db->from('chat_room');
			$arrays = array('participant1_id'=>$sender,'participant2_id'=>$receiver);
			$this->db->where($arrays);
			$chatRoom_id = $this->db->get()->row()->id;	
		}
		
		$query = $this->db->query("update `messages` set `read` = 1 where `user_id` = '$receiver' AND `chat_room_id` = '$chatRoom_id' ");

		$this->db->select('id,message,user_id,user_name,time');
		$this->db->from('messages');
		$this->db->where('chat_room_id',$chatRoom_id);
		$fetch = $this->db->get();
		$result_fetch = $fetch->result();
		
		$this->db->select('pic,firstName,lastName');
		$this->db->from('profile');
		$this->db->where('uid',$receiver);
		$pic = $this->db->get();
		$tutor_pic = $pic->row_array();
		
		if($result_fetch != ''){
			$this->response(array('status' => 0,'messages'=>$result_fetch,'tutor_pic'=>$tutor_pic['pic'],'tutor_name'=>$tutor_pic['firstName'].' '.$tutor_pic['lastName']));
		}else{
			$this->response(array('status' => 1, "error"=>"Something wrong."));
		}		
	}
	
	function chatroom_list_post(){
		$user = $_GET['sender_id'];
		
		 $sql_q = $this->db->query("SELECT id , participant1_id as participant_id ,participant2_id as participant2_id ,last_message_time FROM chat_room where (participant1_id='$user' AND participant2_id != '$user') or (participant1_id != '$user' AND participant2_id = '$user') order by last_message_time desc");
		
		$result = $sql_q->result(); 

		foreach ( $result as $var ) {
			if($var->participant_id != $user && $var->participant2_id == $user){
				$res_participant = $var->participant_id;
				$res_id[] =  $var->id;
				$last[] = $var->last_message_time;
				$re_id =  $var->id;
				
				$this->db->select('firstName,pic,uid');
				$this->db->from('profile');
				$this->db->where('uid',$res_participant);
				$message_query = $this->db->get();
				$result_message[] = $message_query->result_array();
			}else if($var->participant_id == $user && $var->participant2_id != $user){
				$res_participant = $var->participant2_id;
				$res_id[] =  $var->id;
				$last[] = $var->last_message_time;
				$re_id =  $var->id;
				
				$this->db->select('firstName,pic,uid');
				$this->db->from('profile');
				$this->db->where('uid',$res_participant);
				$message_query = $this->db->get();
				$result_message[] = $message_query->result_array();
			}
			
		}
		
		/* $this->db->select('id,participant2_id as participant_id,last_message_time');
		$this->db->from('chat_room');
		$this->db->where('participant1_id',$user);
		$this->db->order_by("last_message_time", "desc");
		$fetch = $this->db->get();
		$result_fetch = $fetch->result();
		
		$this->db->select('id,participant1_id as participant_id,last_message_time');
		$this->db->from('chat_room');
		$this->db->where('participant2_id',$user);
		$this->db->order_by("last_message_time", "desc");
		$query = $this->db->get();
		$result_query = $query->result();

		$result = array_merge($result_fetch, $result_query); */
		
	/*	foreach ($result as $key => $row) {
			$id[$key] = $row['id'];	
			$participant_id[$key] = $row['participant_id'];
			$last_message_time[$key]    = $row['last_message_time'];
			
		}	
		
		$sort_array = array_multisort($last_message_time, SORT_DESC,$id, SORT_ASC,$participant_id, SORT_ASC, $result);
		print_r($sort_array);
		exit; */

	/*	foreach ( $result as $var ) {
			$res_participant[] =  $var->participant_id;
			//$res_participant1[] =  $var->participant1_id;
			$res_id[] =  $var->id;
			$re_id =  $var->id;
			$this->db->select('last_message_time');
			$this->db->from('chat_room');
			$this->db->where('id',$re_id);
			$sql = $this->db->get();
			$results[] = $sql->result_array();
			/* $sql = "SELECT last_message_time from `chat_room` where `id` = $re_id";
			$query = $this->db->query($sql);
			$time[] = $query->result();
			
			
		}  */
		//$last = array_merge($result, $results); 
		//print_r($res_participant);
		//exit;
		
			$chat = implode(",",$res_id);

			$last_result = array();
			foreach($result_message as $res){
				//$uid = $res['uid'];
				foreach ($res as $domain => $count) {
					$uid = $count['uid'];
					$sqls = "SELECT count(id) as unread from `messages` where `read` = 0  AND `user_id` = '$uid' AND `chat_room_id` IN ($chat)";
				$queries = $this->db->query($sqls);
				$fav['unread'] = $queries->result();
				
				$sql_query = "SELECT last_message_time from `chat_room` where (`participant1_id` = '$uid' AND `participant2_id` = '$user') OR(`participant1_id` = '$user' AND `participant2_id` = '$uid') AND`id` IN ($chat) order by `last_message_time` DESC";
				$queryies = $this->db->query($sql_query);
				$fav['last_message_time'] = $queryies->result();
				
				
				//$last_results[] = array_merge($time, $fav); 
				$last_result[] = array_merge($res, $fav); 
				//$last_results[] = array_merge($last_result, $time); 
			    }	
			}
			
			//$arr2 = array_msort($last_result, array('last_message_time'=>SORT_DESC));
			//print_r($arr2);
			//exit;
			
			//$userid = implode(",",$uid);
			//$last_result = array_merge($result_message, $fav); 
			
			
			
			/*$this->db->select('firstName,pic,uid');
			$this->db->from('profile');
			$this->db->where_in('uid',$res_participant1);
			$message_query_other = $this->db->get(); */
			//$result_message_other = $message_query_other->result(); 
			
			//$last_result = array_merge($result_message, $fav); 
			
			//$merger[] = (object) array_merge((array) $last, (array) $result_time);
		
			/* $this->db->select('last_message_time');
			$this->db->from('chat_room');
			$this->db->where_in('id',$res_id);
			$time = $this->db->get();
			$result_time = $time->result_array();
		
			$last_results = array_merge($last_result, $result_time); 
			 */
			
			$this->response(array('status'=>0,'data'=>$last_result));
			
	}

	function count_messages_post(){
		$user = $_GET['sender_id'];
		
		$this->db->select('id,participant2_id as participant_id');
		$this->db->from('chat_room');
		$this->db->where('participant1_id',$user);
		$fetch = $this->db->get();
		$result_fetch = $fetch->result();
		
		$this->db->select('id,participant1_id as participant_id');
		$this->db->from('chat_room');
		$this->db->where('participant2_id',$user);
		$query = $this->db->get();
		$result_query = $query->result();

		$result = array_merge($result_fetch, $result_query);
		
		if(!empty($result)){
			foreach ( $result as $var ) {
				$res_participant[] =  $var->participant_id;
				$res_id[] =  $var->id;
				$sea = 0;
				
				
				/*$this->db->select('user_id,read');
				$this->db->from('messages');
				$this->db->where('user_id',$res_participant);
				$this->db->where('chat_room_id',$res_id);
				$this->db->where('read',0);
				$this->db->group_by('user_id');
				$fetch_messages = $this->db->get();
				$result_fetch_messages[] = $fetch_messages->result();	*/
						
			}
			$uid = implode(",",$res_id);
			$chat = implode(",",$res_participant);
			
			$sqls = "SELECT distinct(user_id) as unread from `messages` where `read` = 0 AND `chat_room_id` IN ($uid) AND `user_id` !=  $user";
					$queries = $this->db->query($sqls);
					$fav = $queries->result_array();					
			 $total = count($fav);
			 if($total == 0){
				$count = $total;
			 }else{
				 $count = $total;
			 }
			//$data = array_filter($result_fetch_messages);
		
			if(!empty($count)){
				$this->response(array('status'=>0,'unread_count'=>$count));
			}else{
				$this->response(array('status'=>0,'unread_count'=>'0'));
			}
		}else{
			$count = '0';
			$this->response(array('status'=>0,'unread_count'=>$count));
		}
	}
	function count_messages_test_post(){
		$user = $_GET['sender_id'];
		
		$this->db->select('id,participant2_id as participant_id');
		$this->db->from('chat_room');
		$this->db->where('participant1_id',$user);
		$fetch = $this->db->get();
		$result_fetch = $fetch->result();
		
		$this->db->select('id,participant1_id as participant_id');
		$this->db->from('chat_room');
		$this->db->where('participant2_id',$user);
		$query = $this->db->get();
		$result_query = $query->result();

		$result = array_merge($result_fetch, $result_query);
		
		if(!empty($result)){
			foreach ( $result as $var ) {
				$res_participant[] =  $var->participant_id;
				$res_id[] =  $var->id;
				$sea = 0;
				
				
				/*$this->db->select('user_id,read');
				$this->db->from('messages');
				$this->db->where('user_id',$res_participant);
				$this->db->where('chat_room_id',$res_id);
				$this->db->where('read',0);
				$this->db->group_by('user_id');
				$fetch_messages = $this->db->get();
				$result_fetch_messages[] = $fetch_messages->result();	*/
						
			}
			$uid = implode(",",$res_id);
			$chat = implode(",",$res_participant);
			
			$sqls = "SELECT distinct(receiver_id) as unread from `chat_room_count` where `chat_room_read` = 0 AND `chat_room_id` IN ($uid)";
					$queries = $this->db->query($sqls);
					$fav = $queries->result_array();	
			 $total = count($fav);
			 if($total == 0){
				$count = $total;
			 }else{
				$count = $total - 1;
			 }
			//$data = array_filter($result_fetch_messages);
		
			if(!empty($count)){
				$this->response(array('status'=>0,'unread_count'=>$count));
			}else{
				$this->response(array('status'=>0,'unread_count'=>'0'));
			}
		}else{
			$count = '0';
			$this->response(array('status'=>0,'unread_count'=>$count));
		}
	}
	
	function new_video_upload_post(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
		$file_name = $_FILES['myFile']['name'];
		$file_size = $_FILES['myFile']['size'];
		$file_type = $_FILES['myFile']['type'];
		$temp_name = $_FILES['myFile']['tmp_name'];
				
		$location = "uploads/";
			
		move_uploaded_file($temp_name, $location.$file_name);
		$ee = "http://www.simplifiedcoding.16mb.com/VideoUpload/uploads/".$file_name;
		$this->response(array('status'=>0,'unread_count'=>$ee));
		}else{
			
		$this->response(array('status'=>0,'unread_count'=>'error'));
	}

	}
	function favourite_post(){
		$student_id = $_GET['student_id'];
		$tutor_id = $_GET['tutor_id'];
		
		$this->db->select('favourite');
		$this->db->from('favourite_tutor');
		$this->db->where(array('student_id'=>$student_id,'tutor_id'=>$tutor_id));
		$query = $this->db->get();
		$result = $query->row_array();
	
		if($result['favourite'] == 1){
			$delete = $this->db->query("DELETE FROM favourite_tutor WHERE student_id ='{$student_id}' AND tutor_id = '{$tutor_id}'");
			if($delete){
				$this->response(array('status'=>0,'fav'=>0));
			}else{
				$this->response(array('status'=>1,'error'=>'Something wrong.'));
			}
		}else{
			$data = array(
				'student_id'=>$student_id,
				'tutor_id'=>$tutor_id,
				'favourite'=>1
			);
		 
			$insert = $this->db->insert('favourite_tutor', $data);
			if($insert){
				if($tutor_id){
				$this->db->select('firebase_regId,firstName');
				$this->db->from('profile');
				$this->db->where('uid',$tutor_id);
				$querys = $this->db->get();
				$results = $querys->row_array();
				
				$this->db->select('firstName');
				$this->db->from('profile');
				$this->db->where('uid',$student_id);
				$stu_query = $this->db->get();
				$stu_result = $stu_query->row_array();
				
				$push_type = 'individual';
				$title = 'tutorFav';
				$message = 'test';
				$firebase = new Firebase();
				$push = new Push();
		 
				// optional payload

				$include_image = '';

				$push->setTitle($title);
				$push->setMessage($message);
				if ($include_image) {
					$push->setImage('http://api.androidhive.info/images/minion.jpg');
				} else {
					$push->setImage('');
				}
				$push->setIsBackground(FALSE);
				$push->setuserId($student_id);
				$push->setuserMessage('test');
				$push->setuserName($stu_result['firstName']);
				$push->setmessageTime(date('Y-m-d h:i:s'));
				
				$json = '';
				$response = '';
		 
				if ($push_type == 'topic') {
					$json = $push->getPushedmessage();
					$response = $firebase->sendToTopic('global', $json);
				} else if ($push_type == 'individual') {
				
					$json = $push->getPushedmessage();
					$regId = isset($results['firebase_regId']) ? $results['firebase_regId'] : '';
					$response = $firebase->send($regId, $json);
				
				}
				}
				if($student_id){
						$this->db->select('firebase_regId,firstName');
						$this->db->from('profile');
						$this->db->where('uid',$student_id);
						$queryss = $this->db->get();
						$results_data = $queryss->row_array();
						
						$push_types = 'individual';
						$titles = 'studentFav';
						$messages = 'test';
						$firebases = new Firebase();
						$pushs = new Push();
				 
						// optional payload

						$include_images = '';

						$pushs->setTitle($titles);
						$pushs->setMessage($messages);
						if ($include_images) {
							$pushs->setImage('http://api.androidhive.info/images/minion.jpg');
						} else {
							$pushs->setImage('');
						}
						$pushs->setIsBackground(FALSE);
						$pushs->setuserId($tutor_id);
						$pushs->setuserMessage('test');
						$pushs->setuserName($results_data['firstName']);
						$pushs->setmessageTime(date('Y-m-d h:i:s'));
						
						$jsons = '';
						$responses = '';
				 
						if ($push_types == 'topic') {
							$jsons = $pushs->getPushedmessage();
							$responses = $firebases->sendToTopic('global', $jsons);
						} else if ($push_types == 'individual') {
						
							$jsons = $pushs->getPushedmessage();
							$regIds = isset($results_data['firebase_regId']) ? $results_data['firebase_regId'] : '';
							$responses = $firebases->send($regIds, $jsons);
						
						}
					
				}
				
				
				$this->response(array('status'=>0,'fav'=>1,'response'=>$response,'responses'=>$responses));
			}else{
				$this->response(array('status'=>1,'error'=>'Something wrong.'));
			}
		}
		
		
	}
	function list_favourite_tutor_post(){
		$student_id = $_GET['student_id'];
		
		$this->db->select('tutor_id');
		$this->db->from('favourite_tutor');
		$this->db->where('student_id',$student_id);
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){
		foreach($result as $res){
			$tutor_id[] = $res->tutor_id;
			$tut_id = $res->tutor_id;
			//$sqls = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $student_id AND tutor_id = $tut_id";
			//$queries = $this->db->query($sqls);
			//$fav[] = $queries->result_array();
		}

		$this->db->select('profile.uid,profile.hRate,user.readytotalk,profile.firstName,profile.lastName,profile.avgRate,user.roleId,profile.pic');
			$this->db->from('profile');
			$this->db->order_by('profile.firstName');
			$this->db->join('user',' profile.uid = user.id', 'inner');
			$this->db->where_in('profile.uid',$tutor_id);
			$querys = $this->db->get();
			$results = $querys->result();
			
			$array = json_decode(json_encode($results), True);
			
			$config = $this->profile_model->getConfig();
			foreach ($array as $resdata){
				//$rates[] = $resdata->hRate;
				$rate = $resdata['hRate'];
				$t_id = $resdata['uid'];
				$sqls = "SELECT count(id) as isMyFavourite from `favourite_tutor` where `student_id` = '$student_id' AND `tutor_id` = '$t_id'";
				$queries = $this->db->query($sqls);
				$favorate = $queries->result_array();
				
				//$favorate = array('isMyFavourite'=>'1');
				$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				$profile = array_merge($favorate[0],$fee);
				//$profile[] = array_merge($resdata,$favorate);
				$final[] = array_merge($resdata,$profile);
			}
			//$final = array_merge($results,$profile);
			//$profile = array_merge($results,$favorate);
		//print_r($rates);
		if($final){
				
			$this->response(array('status'=>0,'result'=>$final));
		}else{
			$this->response(array('status'=>1,'error'=>'Something wrong.'));
		}
	}else{
		$this->response(array('status'=>1,'error'=>'No one tutor favouite By you.'));
	}
	}
	
	function total_cost_post(){
		$cid = $_GET['cid'];
		$amount = $_GET['amount'];
		$time_sec = $_GET['time'];
		
		$total_amount = $this->api_model->total_money($cid);
		$total_amount_add = $this->api_model->total_money_add($cid);
		$last_session = $this->api_model->last_session_info($cid);
		$ttl_points = $this->api_model->ttl_points($cid,$time_sec);
		
		$now_time =   date('Y-m-d h:i:s', strtotime('-1 hour'));
		
		$this->db->select('tid');
		$this->db->from('class');
		$this->db->where('id',$cid);
		$query = $this->db->get();
		$result  = $query->row_array();
		
		$this->db->select('hRate');
		$this->db->from('profile');
		$this->db->where('uid',$result['tid']);
		$queries = $this->db->get();
		$hRate  = $queries->row_array();
		$hRate['hRate'];
		$rate_per_minute = $hRate['hRate'] / 25;
		$config = $this->profile_model->getConfig();
		$rates = $rate_per_minute * (1+$config['VEE_PRICE_PERCENT']['value']) *100 /100;
		$rate_at_decimal = round($rates,3);
		
		
		
		
		if($last_session['endTime'] < $now_time){
		
			if($time_sec <= 60){
				$time = 0;
				$this->response(array('status'=>0,'amount'=>$time));
			}else{
				$time = $time_sec - 60;
				$minute = ($time / 60);
			
				$whole = floor($minute);
				$fraction = $minute - $whole;
			
				if($fraction > 0){
					$total_minute = $whole + 1;
				}else{
					$total_minute = $minute;
				}
					
				$base =  ( $rate_at_decimal * 100) / (1 + $config['VEE_PRICE_PERCENT']['value']) / 100;
				$total_amount_cost = round(($amount * $total_minute),2);
				$total_amount_cost_add = ($base * $total_minute);
				$cost_tutor =  round($total_amount_cost_add, 2);
				
				
				if($total_amount_cost){
					$sql_log="update class set fee = '$total_amount_cost' , t_hrate = '$cost_tutor' where id = '$cid'";			
					$this->db->query($sql_log);
					$total_amount_deduct = $this->api_model->deduct_from_account($total_amount['uid'],$total_amount_cost);
					$total_amount_add_in = $this->api_model->add_in_account($total_amount_add['uid'],$cost_tutor);
					 if($total_amount_deduct['money'] < 3){
						$data = $this->give_notification($total_amount['uid']);
					} 
					
					$this->response(array('status'=>0,'amount'=>$total_amount_cost,'points'=>$ttl_points));
				}else{
					$this->response(array('status'=>1,'error'=>'Something wrong.'));
				}
			}
		}else{
				$time = $time_sec;
				$minute = ($time / 60);
			
				$whole = floor($minute);
				$fraction = $minute - $whole;
			
				if($fraction > 0){
					$total_minute = $whole + 1;
				}else{
					$total_minute = $minute;
				}
				
				$base =  ( $rate_at_decimal * 100) / (1 + $config['VEE_PRICE_PERCENT']['value']) / 100;
				$total_amount_cost = round(($amount * $total_minute),2);
				$total_amount_cost_add = ($base * $total_minute);
				$cost_tutor =  round($total_amount_cost_add, 2);
				
				if($total_amount_cost){
					$sql_log="update class set fee = '$total_amount_cost' , t_hrate = '$cost_tutor' where id = '$cid'";			
					$this->db->query($sql_log);
					$total_amount_deduct = $this->api_model->deduct_from_account($total_amount['uid'],$total_amount_cost);
					$total_amount_add_in = $this->api_model->add_in_account($total_amount_add['uid'],$cost_tutor);
					 if($total_amount_deduct['money'] < 3){
						$data = $this->give_notification($total_amount['uid']);
					} 
					
					$this->response(array('status'=>0,'amount'=>$total_amount_cost,'points'=>$ttl_points));
				}else{
					$this->response(array('status'=>1,'error'=>'Something wrong.'));
				}
		}
		
		/* $time = $time_sec - 60;
		
		
		
		if($time <= 0){
			$time = 0;
		}
		
		$minute = ($time / 60);
		
		$whole = floor($minute);
		$fraction = $minute - $whole;
		
		if($fraction > 0){
			$total_minute = $whole + 1;
		}else{
			$total_minute = $minute;
		}
		echo $total_amount_cost = ($amount * $total_minute);
		exit;
		$config = $this->profile_model->getConfig();	
		$base = round( ( $amount * 100) / (1 + $config['VEE_PRICE_PERCENT']['value'])) / 100;
		
		$total_amount_cost_add = ($base * $total_minute);
		if($total_amount_cost){
			
			
			
			$total_amount_deduct = $this->api_model->deduct_from_account($total_amount['uid'],$total_amount_cost);
			$total_amount_add_in = $this->api_model->add_in_account($total_amount_add['uid'],$total_amount_cost_add);
			$this->response(array('status'=>0,'amount'=>$total_amount_cost));
		}else{
			$this->response(array('status'=>1,'error'=>'Something wrong.'));
		} */
		
	}
	
	
	function toltal_add_test_post(){
		$cid = $_GET['cid'];
		//$amount = $_GET['amount'];
		$time_sec = $_GET['time'];
		
		//$total_amount = $this->api_model->total_money($cid);
		//$total_amount_add = $this->api_model->total_money_add($cid);
		//$last_session = $this->api_model->last_session_info($cid);
		$ttl_points = $this->api_model->ttl_points($cid,$time_sec);
		
		if($ttl_points){
			$this->response(array('status'=>0,'point'=>$ttl_points));
		}else{
			$this->response(array('status'=>1,'error'=>'Something wrong.'));
		}
		
		
	}

	function critical_balance_notification_post(){
		$getData = $this->api_model->low_balance_users();
		$d2 = date('Y-m-d', strtotime('-30 days'));
				
		foreach ($getData as $data){
			$date = $data->date;
				if($d2 == $date){
						$push_types = 'individual';
						$titles = 'criticalBal';
						$messages = 'Hey your credits on TheTalkList are really low.  Buy more to have instant access to smart members.';
						$firebases = new Firebase();
						$pushs = new Push();
				 
						// optional payload

						$include_images = '';

						$pushs->setTitle($titles);
						$pushs->setMessage($messages);
						if ($include_images) {
							$pushs->setImage('http://api.androidhive.info/images/minion.jpg');
						} else {
							$pushs->setImage('');
						}
						$pushs->setIsBackground(FALSE);
						$pushs->setuserId($data->uid);
						$pushs->setuserMessage('test');
						$pushs->setuserName('name');
						$pushs->setmessageTime(date('Y-m-d h:i:s'));
						
						$jsons = '';
						$responses = '';
				 
						if ($push_types == 'topic') {
							$jsons = $pushs->getPushedmessage();
							$responses = $firebases->sendToTopic('global', $jsons);
						} else if ($push_types == 'individual') {
						
							$jsons = $pushs->getPushedmessage();
							$regIds = isset($data->firebase_regId) ? $data->firebase_regId : '';
							$responses = $firebases->send($regIds, $jsons);
						
						}
			}
		}
		
	}
	
	
	function profile_complete_post(){
		$uid = $_GET['uid'];
		$check	= $this->api_model->profile_check($uid);
		
		if($check){
			if($check['pic_upload'] == 1 && $check['vid_upload'] == 1 && $check['BioGraphy'] == 1 && $check['tutoring_subjects'] == 1){
				$update = $this->db->query("update user set roleId = 1 where id = '{$uid}'");
			}
			$this->response(array('status' => 0,'result'=>$check));
		}else{
			$this->response(array('status' => 1,'message'=>"Something Wrong."));
		}
		
	}
	function student_feedback_form_post(){
		$class_id = $_GET['cid'];
		$student_id = $_GET['sid'];
		$tutor_id = $_GET['tid'];
		$rating = $_GET['user_given_rating'];
		$report = $_GET['report_inappropriate'];
		$session_id = $_GET['session_id'];
		$msg = $_GET['feedback_msg'];
		$feedback_data = array(
				'callId' => $class_id,
				'callerId' 		=> 	$student_id,
				'receiverId' 		=> 	$tutor_id,
				'clearReception'		 	=> 	$rating,
				'polite' 	=> 	$report,
				'msg' 	=> 	$msg,
				'create_at' => date('Y-m-d G:i:s')
			);
		
		$feedback = $this->api_model->feedback_form($feedback_data);
		if($report == 1){
			$this->load->model('user_model');
			$ownUser = $this->user_model->getByUid($student_id);
			$toUser = $this->user_model->getByUid($tutor_id);
			$ownname = $this->user_model->getnameByUid($student_id);
			$toname = $this->user_model->getnameByUid($tutor_id);

			$toEmail = 'support@thetalklist.com';
			//$toEmail = 'saurabhit29@gmail.com';
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from($ownUser['email']);
			$this->email->to( $toEmail );
			$this->email->subject("The feedback from {$ownUser['username']} to {$toUser['username']}");
			//$message = 'Student '.$ownUser['username'].' has reported inappropriate behavior for their Vee-session with Tutor '.$toUser['username'].' that was conducted at 2013-01-21 23:00:00 UTC time';
			//$message = $ownname['firstName'].' '.$ownname['lastName'].' student reports inappropriate behaviour with '.$toname['firstName'].' '.$toname['lastName'].' tutor on '.date('Y-m-d');
			$message = 'Inappropriate behavior reported for Session ID: ' .$session_id. 'between '.$ownUser['username'].' and '.$toUser['username'].' on '.date('Y-m-d');
			$message .= "\r\n";
			$message .= "<br/>";
			$message .= "<br/>";
			$message .= "Message : <br/>";
			$message .= $msg;
			$this->email->message($message);
			$email = $this->email->send();
			//$sendmail = $this->api_model->inappropriate_email($tutor_id,$session_id);
		}
		

		if($feedback){
		
			$this->response(array('status'=>0,'feedback'=>'successful.'));
		}else{
			$this->response(array('status'=>1,'error'=>'Something wrong.'));
		}
		
	}
	
	function tutor_online_post(){
		$bit = $_GET['bit'];
		$id = $_GET['uid'];
		
		if($bit == '1'){
			$sql_log="update user set readytotalk =1 where id = '$id'";			
			$this->db->query($sql_log);
				if($sql_log){
					$this->response(array('status'=>0));
				}else{
					$this->response(array('status'=>1));
				}
		}else{
			$sql_log="update user set readytotalk =0 where id = '$id'";			
			$this->db->query($sql_log);
				if($sql_log){
					$this->response(array('status'=>0));
				}else{
					$this->response(array('status'=>1));
				}		
		}
	}
	
	function minute_rate_post(){
		$rate = $_GET['rate'];
		$id = $_GET['uid'];
	
		/* Mobile rate is per Minute and Website Rate is Per session on 25 min. */
		
		$total_rate = ($rate * 25);
		//$price = number_format($total_rate, 1);
		$insert_rate = $this->api_model->set_rate($total_rate,$id);
		$config = $this->profile_model->getConfig();
		$rates = round($total_rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
		if($insert_rate){
			$this->response(array('status'=>0,'message'=>'successful.','rate'=>$rates));
		}else{
			$this->response(array('status'=>1,'error'=>'Something wrong.'));
		}
		
		
	}
	
	function check_mail_post(){

          $this->load->library('email');
	
		$this->email->from('saurabhisengg@gmail.com','TheTalklist');
		$this->email->to('saurabhit29@gmail.com');
		$this->email->subject('Forget password in thetalklist.com by');
		$this->email->message('Hello');
		$send = $this->email->send(); 
		//$msg = 'Hello';
		//$send = mail("saurabhbhatt29@gmail.com","My subject",$msg);

		
		if ($send) {
			$this->response(array('status' => 10,'message'=>'successfully sent.')); // Success Result
		} else {
			$this->response(array('status' => 1,'error'=>'Email Sending Failed')); // Failed Result
		}

	}
	
	function paypal_cashout_post(){
		$uid = $_GET['uid'];
		$payment_account = $_GET['payment_account'];
		$payAmount = $_GET['trnAmount'];
		
		
		 if ($_GET['trnAmount'] != ''){
			$tdate=date("Y-m-d");
			//$this->session->set_userdata('alertstatus', '1');
			/* Insert Transaction Entry By Ilyas */
			$this->load->model(array('api_model'));
			$nw = date("Y-m-d H:i:s");
			$payAmount = $_GET['trnAmount'];
			$record = array(
				  'user_id' 		=> 	$uid,
				  'amount'		 	=> 	$payAmount,
				  'amount_status' 	=> 	'debit',
				  'type' 			=> 	'Cashout',
				  'payment_status' 	=> 	'Paid',
				  'payment_date' 	=> 	$nw,
				  'summary' 		=> 	"Cashout by User($uid)",
				  'status'			=>	"Pending",
				  'status_comment'	=>	"Cashout pending by Paypal" 
			);
			
			$this->api_model->fnInsertTransaction($record); 	// Insert Transaction Entry
			$this->api_model->fnUpdateProfileCashout($payAmount,array("uid"=>$uid));	//	Update Profile Money
			$this->session->set_userdata('alertstatus', '2');
			// Update Profile Paypal Account
			$formData["payment_account"] = $payment_account;
			$formData['uid'] = $uid;
			$update = $this->profile_model->update($formData);
			if($update){
				$this->db->select('money');
				$this->db->from('profile');
				$this->db->where('uid', $uid);
				$query_state = $this->db->get();
				$result_state = $query_state->row_array();
				
				if($result_state['money'] < 3){
					$this->give_notification($uid);
				}
					
				
				$this->response(array('status' => 0,'money'=>$result_state['money']));
			}else{
				$this->response(array('status' => 1,'error'=>'something Wrong.'));
			}
		}else{
				$this->response(array('status' => 1,'error'=>'Enter Amount.'));			
		}		
		
	}
	
	public function give_notification($id){
		$this->db->select('firebase_regId');
		$this->db->from('profile');
		$this->db->where('uid',$id);
		$query = $this->db->get();
		$result = $query->row_array();
		
		
			$push_types = 'individual';
			$titles = 'criticalBal';
			$messages = 'Hey your credits on TheTalkList are really low.  Buy more to have instant access to smart members.';
			$firebases = new Firebase();
			$pushs = new Push();
	 
			// optional payload

			$include_images = '';

			$pushs->setTitle($titles);
			$pushs->setMessage($messages);
			if ($include_images) {
				$pushs->setImage('http://api.androidhive.info/images/minion.jpg');
			} else {
				$pushs->setImage('');
			}
			$pushs->setIsBackground(FALSE);
			$pushs->setuserId($id);
			$pushs->setuserMessage('test');
			$pushs->setuserName('name');
			$pushs->setmessageTime(date('Y-m-d h:i:s'));
			
			$jsons = '';
			$responses = '';
	 
			if ($push_types == 'topic') {
				$jsons = $pushs->getPushedmessage();
				$responses = $firebases->sendToTopic('global', $jsons);
			} else if ($push_types == 'individual') {
			
				$jsons = $pushs->getPushedmessage();
				$regIds = isset($result['firebase_regId']) ? $result['firebase_regId'] : '';
				$responses = $firebases->send($regIds, $jsons);
			
			}
		
		
	}
	
	
	function subject_post(){
		$users = $this->api_model->get_subjects();
		if($users){
			$this->response(array('status' => 0,'subjects'=>$users));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
	}
	
	function tutor_info_post(){
		$tutor_id = $_GET['tutor_id'];
		
		$tutor_info = $this->api_model->tutor_info($tutor_id);
		
		$profile = array();
		$config = $this->profile_model->getConfig();
			foreach ($tutor_info['results'] as $res){
				$rate = $res['hRate'];
				//$s_id = $res['uid'];
				
				//$sqls = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $user_id AND tutor_id = $s_id";
				//$queries = $this->db->query($sqls);
				//$fav = $queries->result_array();
			//$favres = $this->db->query("select count(id) as isMyFavourite from favourite_tutor where student_id = '{$user_id}' AND tutor_id = '{$s_id}'");
				if($rate == 0){
					$fee['hRate'] = 0;
				}else{
				$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				}	//$profile_data[] = array_merge($favres,$fee);
				$profile[] = array_merge($res,$fee);
				//$final[] = array_merge($profile,$fee);
			}
			
		if($profile){
			$this->response(array('status' => 0,'tutor'=>$profile));
		}else{
			$this->response(array('status' => 1,'error'=>'Something Wrong'));
		}
		//print_r($tutor_info['results']);
		//exit;
		
		
		
	}
	
	function desired_tutor_post(){
		
		$_data['subject'] = $_GET['subject'];
		$_data['lang1'] = $_GET['language1'];
		//$lang2 = $_GET['language2'];
		$_data['gender'] = $_GET['gender'];
		$_data['country'] = $_GET['country'];
		$_data['state'] = $_GET['state'];
		//$con = $_GET['country'];
		//$pro = $_GET['state'];
		$_data['keyword'] = $_GET['keyword'];
		$user_id = $_GET['id'];
		
		
		if($_data['gender'] == 'Male'){
			$_data['gen'] = 1;
		}else{
			$_data['gen'] = 0;
		}
		
		$this->db->select('id');
		$this->db->from('countries');
		$this->db->where('country', $_data['country']);
		$query = $this->db->get();
		$result = $query->row_array();
		$_data['con'] = $result['id'];
		
		if($_data['state'] == 'state'){
			 $result_state['id'] = 2;
		}else{
			$this->db->select('id');
			$this->db->from('provices');
			$this->db->where('provice', $_data['state']);
			$query_state = $this->db->get();
			$result_state = $query_state->row_array();
		} 
		$_data['sta'] = $result_state['id'];
		
		
		$searchData	= $this->api_model->getResult($_data,$user_id);
	
		$config = $this->profile_model->getConfig();
		
			foreach ($searchData['results'] as $res){
				$s_id = $res['uid'];
				
				$sqls = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $user_id AND tutor_id = $s_id";
				$queries = $this->db->query($sqls);
				$fav = $queries->result_array();
				
				$rate = $res['hRate'];
				
				$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				$profile = array_merge($res,$fav[0]);
				$final[] = array_merge($profile,$fee);
				
				
				//$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				//$profile[] = array_merge($res,$fee);
			}
		
		if($searchData['results']){
			$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$final))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Tutor Available.'))));
			
			$searchDatas	= $this->api_model->getResult_advance($_data,$user_id);
		
			foreach ($searchDatas['results'] as $results){
				$s_ids = $results['uid'];
				
				$sqlss = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $user_id AND tutor_id = $s_ids";
				$queriess = $this->db->query($sqlss);
				$favs = $queriess->result_array();
				
				$rates = $results['hRate'];
				
				$fees['hRate'] = round($rates * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				$profiles = array_merge($results,$favs[0]);
				$finals[] = array_merge($profiles,$fees);
				
				
				//$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				//$profile[] = array_merge($res,$fee);
			}
			if($searchDatas['results']){
			$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$finals))));
			}else{
				$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Tutor Available.'))));
				
			/*	$searchDatas_new	= $this->api_model->getResult_advance_fast($_data,$user_id);
			
			foreach ($searchDatas_new['results'] as $results_new){
				$s_ids_new = $results_new['uid'];
				
				$sqlss_new = "SELECT count(id) as isMyFavourite from favourite_tutor where student_id = $user_id AND tutor_id = $s_ids_new";
				$queriess_new = $this->db->query($sqlss_new);
				$favs_new = $queriess_new->result_array();
				
				$rates_new = $results_new['hRate'];
				
				$fees_new['hRate'] = round($rates_new * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				$profiles_new = array_merge($results_new,$favs_new[0]);
				$finals_new[] = array_merge($profiles_new,$fees_new);
				
				
				//$fee['hRate'] = round($rate * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				//$profile[] = array_merge($res,$fee);
			}

			if($searchDatas_new['results']){
				$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$finals_new))));
			}else{	
				$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Tutor Available.'))));
			} */
		}
		}
		
		$language1 = str_replace("_"," ",$lang1);
		//$language2 = str_replace("_"," ",$lang2);
		$country = str_replace("_"," ",$con);
		$state = str_replace("_"," ",$pro);
		
		
		
		$subject = $_GET['subject'];
		$lang1 = $_GET['language1'];
		//$lang2 = $_GET['language2'];
		$gender = $_GET['gender'];
		$con = $_GET['country'];
		$pro = $_GET['state'];
		$keyword = $_GET['keyword'];
		
		$language1 = str_replace("_"," ",$lang1);
		//$language2 = str_replace("_"," ",$lang2);
		$country = str_replace("_"," ",$con);
		$state = str_replace("_"," ",$pro);
			
		if($gender == 'Male'){
			$gen = 1;
		}else{
			$gen = 0;
		}
		
		$this->db->select('id');
		$this->db->from('countries');
		$this->db->where('country', $country);
		$query = $this->db->get();
		$result = $query->row_array();
		
		if($state == 'state'){
			 $result_state['id'] = 2;
		}else if ($state == ''){
			$result_state['id'] = 0;
		}else{
			$this->db->select('id');
			$this->db->from('provices');
			$this->db->where('provice', $state);
			$query_state = $this->db->get();
			$result_state = $query_state->row_array();
		} 

		$this->db->select('profile.uid,profile.hRate,user.readytotalk,profile.firstName,profile.lastName,profile.avgRate,user.roleId,profile.pic');
		$this->db->from('profile');
		$this->db->join('user',' profile.uid = user.id', 'inner');
		$this->db->where_in('user.roleId',array('1','2','3'));
		//$this->db->where('user.readytotalk',1);
		//$Linkearray = array('profile.personal' => $keyword,'profile.professional' => $keyword,'profile.academic'=>$keyword,'profile.firstName'=>$keyword,
		//					'profile.lastName'=>$keyword,'profile.email'=>$keyword,'profile.city'=>$keyword);
	if($pro == ''){
		$this->db->where('profile.country',$result['id']);
		$this->db->where('profile.nativeLanguage',$language1);
		$this->db->where('profile.gender',$gen);
		$this->db->where("(profile.personal LIKE '%".$keyword."%' OR profile.professional LIKE '%".$keyword."%' OR profile.academic LIKE '%".$keyword."%')", NULL, FALSE);
		
	}else if($gender == ''){
		$this->db->where('profile.country',$result['id']);
		$this->db->where('profile.province',$result_state['id']);
		$this->db->where('profile.nativeLanguage',$language1);
		$this->db->where('profile.gender',$gen);
		$this->db->where("(profile.personal LIKE '%".$keyword."%' OR profile.professional LIKE '%".$keyword."%' OR profile.academic LIKE '%".$keyword."%')", NULL, FALSE);
	}else{
		//$this->db->or_where($Linkearray);
		$this->db->where('profile.country',$result['id']);
		$this->db->where('profile.province',$result_state['id']);
		$this->db->where('profile.nativeLanguage',$language1);
		//$this->db->where('profile.otherLanguage',$language2);
		$this->db->where('profile.gender',$gen);
		$this->db->where("(profile.personal LIKE '%".$keyword."%' OR profile.professional LIKE '%".$keyword."%' OR profile.academic LIKE '%".$keyword."%')", NULL, FALSE);
		//$this->db->where(array('profile.firstName'=>$keyword,'profile.lastName'=>$keyword));
		//$this->db->like('profile.lastName',$keyword);
	}	
		$query = $this->db->get();
		$result  = $query->result();
	
		//$result = $query->result();
		if($result){
			$this->response(json_decode(json_encode(array('status' => 0,'tutors'=>$result))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Tutor Available.'))));
		}
		
	}
	
	 function edit_biogrpy_post(){
		 $id = $_GET['id'];
		 $academic = $_GET['academic'];
		 $professional = $_GET['professional'];
		 $personal = $_GET['personal'];
		 
		$update = $this->db->query("update profile set academic = '{$academic}',professional = '{$professional}', personal = '{$personal}', BioGraphy = 1 where 	uid = '{$id}'");
		if ($update) {
			$this->response(array('status' => 0, "academic"=>$academic,'professional'=>$professional,'personal'=>$personal)); 
		} else {
			$this->response(array('status' => 1, "message"=>"Someting Wrong.")); 
		}
		 
	 }
	
	 function history_post(){
		$id = $_GET['id'];
		$page_no = $_GET['page_no'];
		if($page_no == 1){
			$offset = 0;
		}else if($page_no == 2){
			$offset = $page_no * 10;
		}else{
			$offset = (($page_no - 1) * 20);
		}
		$historyData	= $this->api_model->gethistory($id,$offset);
		if($historyData){
			$this->response(json_decode(json_encode(array('status' => 0,'history'=>$historyData))));
	    }else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Data Available.'))));
		}	
		
	} 
	
	function tutoring_subject_list_post(){
		$language	= $this->api_model->subject_list_language();
		$general	= $this->api_model->subject_list_general();
		
		if($language){
			$this->response(json_decode(json_encode(array('status' => 0,'language'=>$language,'general'=>$general))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Tutor Available.'))));
		}	
		
	}
	function save_tutoring_subject_post(){
		$uid = $_GET['id'];
		$subject = $_GET['subject'];
		
		$save_subject	= $this->api_model->save_subject($uid,$subject);
		if($save_subject){
			$this->response(json_decode(json_encode(array('status' => 0,'tutoring_subject'=>$save_subject))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'Something went wrong.'))));
		}	
		
	}
	
	function biography_video_post(){
		$uid = $_GET['uid'];
		
		$biography_video = $this->api_model->biography_video($uid);
		if($biography_video){
			$this->response(json_decode(json_encode(array('status' => 0,'biography_video'=>$biography_video))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>'No Video Available.'))));
		}		 
			 
	}
	
	function reviews_post(){
		$id = $_GET['uid'];
		
		$review	= $this->api_model->get_reviews($id);
	
		$sql = "SELECT count(id) as total_session from class where tid={$id} and s_attend =1";
	
		$result = array();
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		if($review){
			$this->response(array('status' => 0,'review'=>$review,'total_session'=>$result['total_session']));
		}else{
			$this->response(array('status' => 1,'review'=>"something Wrong."));
		}
		
	}
	
	function ttl_points_rewards_credit_post(){
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$date = date('Y-m-d h:i:s');
		$amount = 200;
		$redemption = $_GET['redemption'];
		$opening_amount = $_GET['ttl_points'];
		
		$total_amount =  $opening_amount - $amount;
		
		$data = array(
			'userId' => $uid,
			'Name' => $name,
			'date' => $date,
			'opening_amount' => $opening_amount,
			'amount' => $amount,
			'total_amount' => $total_amount,
			'redemption' => $redemption
		);
		
		$review	= $this->api_model->ttl_points_reward_credit($data);
	
		if($review){
			$this->response(array('status' => 0,'total_points'=>$review['ttl_points'],'total_credits'=>$review['money']));
		}else{
			$this->response(array('status' => 1,'message'=>'Something Wrong.'));
		}
		
	}
	
	function ttl_points_rewards_travel_post(){
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$date = date('Y-m-d h:i:s');
		$amount = 200;
		$redemption = $_GET['redemption'];
		$opening_amount = $_GET['ttl_points'];
		
		$total_amount =  $opening_amount - $amount;
		
		$data = array(
			'userId' => $uid,
			'Name' => $name,
			'date' => $date,
			'opening_amount' => $opening_amount,
			'amount' => $amount,
			'total_amount' => $total_amount,
			'redemption' => $redemption
		);
		
		$review	= $this->api_model->ttl_points_reward_travel($data);

		if($review){
				
				$str = "<b>Hi".$review['firstName']."</b>";
				$str .= "\r\n<br/>";
				$str .= "<p>We will keep you posted on the winner of our drawing that will happen January 31st.
						Good luck and thanks for being part of TheTalkList learning community!</p>";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				$this->email->to($review['email']);
				$this->email->subject('TheTalkList Rewards.');
				$this->email->message($str);
				$this->email->send();
			
			
			$this->response(array('status' => 0,'total_points'=>$review['ttl_points']));
		}else{
			$this->response(array('status' => 1,'message'=>'Something Wrong.'));
		}
		
	}
	function delete_bio_video_post(){
		$video_id = $_GET['video_id'];
		$user_id = $_GET['user_id'];
		
		$videos	= $this->api_model->delete_bio_video($video_id,$user_id);
	
		if($videos){
			$this->response(json_decode(json_encode(array('status' => 0,'biography_video'=>$videos))));
		}else{
			$this->response(json_decode(json_encode(array('status' => 1,'message'=>"No video Delete."))));
		}
		
		
	}
	function check_login_post(){
		$username = $_GET['username'];
		
		$check = $this->db->query("Select id from user where email = '{$username}'");
		$results = $check->row_array();
	
		$checkfirebase = $this->db->query("Select firebase_regId from profile where uid = '{$results["id"]}'");
		$firebases = $checkfirebase->row_array();
	
		$title = 'clear_login';
		$message =  'logged out from other Device.';
		$push_type = "individual";
		
		$firebase = new Firebase();
        $push = new Push();
		
		$include_image = '';
		$push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE); 
 
        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPushedlogout();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPushedlogout();
            $regId = isset($firebases['firebase_regId']) ? $firebases['firebase_regId'] : '';
            $response = $firebase->send($regId, $json);
        }
		$delete = $this->db->query("update profile set firebase_regId = null where uid = '{$results["id"]}'");
		 if ($json != '') {
                  return json_encode($json);
                 } 
                 if ($response != '') { 
                  return  json_encode($response);
                 }
	}
	function notification_post(){
		$title = $_GET['title'];
		$message =  $_GET['message'];
		$push_type = "topic";

		$firebase = new Firebase();
        $push = new Push();
 
        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        $include_image = '';

        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
 
 
        $json = '';
        $response = '';
 
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
         if ($json != '') {
                  return json_encode($json);
                 } 
                 if ($response != '') { 
                  return  json_encode($response);
                 }
	}
}

class Firebase {
 
    // sending push message to single user by firebase reg id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
 
    // Sending message to a topic by topic name
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
 
    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );
 
        return $this->sendPushNotification($fields);
    }
 
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
         
       define('FIREBASE_API_KEY', 'AAAA-2VCbHA:APA91bEhMHG05l8BZOfKFbaLgXg4O0gK2hlKuYmmnvVg1DIuXY2W7Pb_RNFcn136XbnDyDodSqtJeKOxOTlfYroAHr6yNvtI_ff8Ex79jdDrzSxlsEVXeWWGkgF4Ee8nlWPDyYtgB5LE');
 
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
 
        return $result;
    }
}


class Push {
 
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         
    }
 
    public function setTitle($title) {
        $this->title = $title;

    }
 
    public function setMessage($message) {
        $this->message = $message;

    }
 
    public function setImage($imageUrl) {
        $this->image = $imageUrl;

    }
 
    public function setPayload($data) {
        $this->data = $data;

    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }

    public function setURL($URL) {
        $this->URL = $URL;

    }
	public function setName($name) {
        $this->name = $name;

    }
	public function setId($ID) {
        $this->ID = $ID;

    }
	public function setClassId($cid) {
        $this->cid = $cid;

    }
	
	public function setuserId($uid) {
        $this->uid = $uid;

    }
	public function setuserName($uname) {
        $this->uname = $uname;

    }
	public function setuserMessage($umessage) {
        $this->umessage = $umessage;

    }
	public function setmessageTime($m_time) {
        $this->m_time = $m_time;

    } 
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        $res['data']['URL'] = $this->URL;
		$res['data']['name'] = $this->name;
		$res['data']['ID'] = $this->ID;
		$res['data']['cid'] = $this->cid;
		$res['data']['uid'] = $this->uid;
		$res['data']['uname'] = $this->uname;
		$res['data']['umessage'] = $this->umessage;
		$res['data']['m_time'] = $this->m_time;
        return $res;
    }
	public function getPushed(){
		$res = array();
		$res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
		$res['data']['image'] = $this->image;
		$res['data']['uid'] = $this->uid;
		$res['data']['uname'] = $this->uname;
		$res['data']['umessage'] = $this->umessage;
		$res['data']['m_time'] = $this->m_time;
		return $res;
	}
	public function getPushedmessage(){
		$res = array();
		$res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
		$res['data']['image'] = $this->image;
		$res['data']['uid'] = $this->uid;
		$res['data']['uname'] = $this->uname;
		$res['data']['umessage'] = $this->umessage;
		$res['data']['m_time'] = $this->m_time;
		return $res;
	}
	public function getPushedlogout(){
		$res = array();
		$res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
		$res['data']['image'] = $this->image;
		return $res;
	}
 
}

?>