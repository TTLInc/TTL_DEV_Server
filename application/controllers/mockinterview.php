<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mockinterview extends TL_Controller {
	
	public function __construct() {
		parent::__construct();	
		session_start();
		$this->load->model(array('lookup_model'));
		$this->load->model(array('qoute_model'));
		$this->load->helper('cookie');		
	}
	
	public function index()
	{
		$this->load->model(array('banner_model','user_model','profile_model','location_model'));
		$Suggest1 = array();
		$Suggest = $this->user_model->GetSuggestedInterviewer();
		if(!empty($Suggest))
		{
			for($i=0;$i<count($Suggest);$i++)
			{
			  $Suggest1[] = $this->profile_model->getTutorProfile($Suggest[$i]['id']);
			}
		}
		$scId=0;
		$banners = $this->banner_model->loadBannerDashBoard($scId);
		
		if($banners==array())
		{
				$scId=0;
				$banners = $this->banner_model->loadBannerDashBoard($scId);
		}
		$config = $this->location_model->getConfig();
		$this->layout->setData('configdefault',$config);
		$this->layout->setData('banners',$banners);
		$this->layout->setData('suggInterviewers',$Suggest1);
		$this->layout->setLayout('layout_mockinterview');
		$this->layout->view('mockinterview/index');
	}
	

}?>	