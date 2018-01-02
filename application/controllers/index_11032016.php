<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends TL_Controller {
	public function __construct(){
        parent::__construct();
		session_start();
		$this->load->model(array('lookup_model'));
		$this->load->model(array('qoute_model'));
		$this->load->helper('cookie');
    }
	public function index(){
		$this->load->model(array('banner_model','ppc_model','user_model','testimonial_model'));
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? 'phone' : 'computer');
		
		/* Set Visitor in Cookie */
		$visitorstatus = $this->user_model->fnGetVisitorStatus();
		$this->layout->setData('visitorstatus',$visitorstatus);
		
		/* Facebook Login Start */
		$this->load->library('facebook');
		$fblogin_url = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('user/fblogin'), 
			'scope' => array("email")));
		$this->layout->setData('fblogin_url',$fblogin_url);
		/* End */	
		$this->geolocater->getlocation();
		
		if(!isset($_SESSION["multi_lang"])){
			$lang = 'en';
		}else{
			$lang = $_SESSION['multi_lang'];
		}
		$SchoolInfo=array();
		$refid = $this->uri->segment(1) ;
		$scId=0;
		
		if($refid =='tu' || $refid =='st' || $refid =='sc' || $refid =='af')
		{	 
			$refid_encode = $this->uri->segment(2) ;
			if($refid=='sc')
			{
				$pieces = explode(".",$refid_encode);
				$refid_encode = $pieces[0];
				
				/* code added by haren */
				
				$schoolUrl=explode(".",$this->uri->segment(2));
				@$schoolid =  $this->user_model->decode($schoolUrl[1],"This is a key"); 
				$SchoolInfo=$this->user_model->GetSchoolInfo($schoolid);
				 
				 $scId=$schoolid;
				 
				 if($scId=='')
				 {
					 $scId=0;
				 }
				/* Haren code end */
			}

			if (preg_match("/([a-z-A-Z0-9]+)/", $refid_encode, $matches))
			{
				$decode =  $this->user_model->decode($refid,"This is a key"); 
				$this->session->set_userdata('decode',$decode);
			}
		}
		
		$nextSession= $this->user_model->GetNextSession();
		$AdvanceSession= $this->user_model->GetAdvanceSession();
		if($AdvanceSession !=array())
		{
			$this->layout->setData('AdvanceSession',$AdvanceSession);
		}
		else
		{
			$this->layout->setData('AdvanceSession',"None");
		}	
		$nxt="no";
		 
		if($nextSession !=array())
		{
			$this->layout->setData('nextSession',$nextSession);
			$start=$nextSession['Time'];
			$timeNow = date('Y-m-d H:i:s');
			$timeNowStr = strtotime($timeNow);
			$classTimeStr = strtotime($start);
			$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
			$Diff=round(abs($classTimeStr - $timeNowStr) / 60,2);
			$dt= date('Y-m-d H:i:s');
			$end= strtotime($start);
			$end=$end+(60*25);
			//echo $start."<br>";
			$end=date("Y-m-d H:i:s", $end);
			if($Diff <=15 && $Diff >=1)
			{
				$nxt="yes";
			}
			else if($dt >= $start && $dt<=$end)
			{ 
				$nxt="yes";
			}			
			else
			{
				$nxt="no";
			}
			 
		}
		else
		{$nextSession='None';
			$this->layout->setData('nextSession',$nextSession);
			
		}

		$this->layout->setData('nxt',$nxt);
		$video = $this->ppc_model->loadVideo($lang);
		$this->layout->setData('video',$video);
		//$banners = $this->banner_model->loadBanner();
		$banners = 0;
		/*$banners = $this->banner_model->loadBannerDashBoard($scId);
		if($banners==array())
		{
			$scId=0;
			$banners = $this->banner_model->loadBannerDashBoard($scId);
		}*/
		
		$testimonials = $this->testimonial_model->getAll();
		$this->layout->setData('testimonials',$testimonials);
		//$arr_quotes = $this->qoute_model->getAllAds('active');
		//$this->layout->setData('arr_quotes',$arr_quotes);
		//$this->layout->setData('banners',$banners);
		$this->layout->setData('deviceType',$deviceType);
		$this->layout->setData('SchoolInfo',$SchoolInfo);
		$this->layout->setLayout('layout_index');
		$this->layout->view('index/index');
	}
	public function test()
	{
	$this->layout->view('index/test');
	}
}
/* End of file index.php */
/* Location: ./application/controllers/index.php */