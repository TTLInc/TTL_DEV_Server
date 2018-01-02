<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angular_search extends TL_Controller 
{
	public function __construct() 
	{
        parent::__construct();
    }
	
	public function get_all_data_old()
	{
		$this->load->model('angular_search_model');
		$this->load->model('user_model');
		$data = $this->angular_search_model->getResult();
		
		//------------bhavik-----------//
		/*$searchData = $data;
		$resFree = $this->user_model->fnGetUser("is_eligible",array("id"=>$this->session->userdata('uid')));
		
		if(isset($searchData['results'])){
			$tutor_search_records_counter = 0;
			foreach($searchData['results']	as $tutor_search_record){
				if(isset($searchData['results'][$tutor_search_records_counter]['school_id'])	&& $searchData['results'][$tutor_search_records_counter]['school_id'] != ''){
					$temp_school_id = 	$searchData['results'][$tutor_search_records_counter]['school_id'];
					$sql 			= 	$this->db->query('SELECT tutor_markup FROM profile WHERE uid="'.$temp_school_id.'"');
					$markup_row		=	$sql->row();
					$markup_value	=	trim($markup_row->tutor_markup);
					$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
					
					if($markup_value > 0) {
						if ($resFree[0]['is_eligible'] != "1") {
							$searchData['results'][$tutor_search_records_counter]['hRate'] 		= number_format($searchData['results'][$tutor_search_records_counter]['hRate'],2,'.','') + number_format($markup_value,2,'.','');
							$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= $searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_mark'] 	= $markup_value;
						}else{
							$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
						}
					}else{
						$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
						$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
						$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
					}
					
					
					
				}
				$tutor_search_records_counter++;
			}
		}
		*/
		//print_r(json_encode($searchData));
		//------------bhavik-----------//
		

		print_r(json_encode($data));
	}
	
	public function get_all_data()
	{
		$this->load->model('angular_search_model');
		$this->load->model('user_model');
		$data = $this->angular_search_model->getResult();
		//------------bhavik-----------//
		$searchData = $data;
		$resFree = $this->user_model->fnGetUser("is_eligible",array("id"=>$this->session->userdata('uid')));
		
		if(isset($searchData['results'])){
			$tutor_search_records_counter = 0;
			foreach($searchData['results']	as $tutor_search_record){
				if(isset($searchData['results'][$tutor_search_records_counter]['school_id'])	&& $searchData['results'][$tutor_search_records_counter]['school_id'] != '' && $searchData['results'][$tutor_search_records_counter]['school_id'] != '0'){
					$temp_school_id = 	$searchData['results'][$tutor_search_records_counter]['school_id'];
					if($temp_school_id != 0 && $temp_school_id != '0'){
						$sql 			= 	$this->db->query('SELECT tutor_markup FROM profile WHERE uid="'.$temp_school_id.'"');
						$markup_row		=	$sql->row();
						$markup_value	=	trim($markup_row->tutor_markup);
						if($markup_value > 0) {
							if ($resFree[0]['is_eligible'] != "1") {
								$searchData['results'][$tutor_search_records_counter]['hRate'] 		= number_format($searchData['results'][$tutor_search_records_counter]['hRate'],2,'.','') + number_format($markup_value,2,'.','');
								$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= $searchData['results'][$tutor_search_records_counter]['hRate'];
								$searchData['results'][$tutor_search_records_counter]['o_mark'] 	= $markup_value;
								$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
								
								if ($resFree[0]['is_eligible'] != "1") {
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 0;
								}else{
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 1;
								}
								
								
								
							}else{
								$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
								$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
								$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
								$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
								
								if ($resFree[0]['is_eligible'] != "1") {
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 0;
								}else{
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 1;
								}
								
								
							}
						}else{
							$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
							$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
							
								if ($resFree[0]['is_eligible'] != "1") {
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 0;
								}else{
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 1;
								}
							
						}
					}else{
							$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
							$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
							$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
							
								if ($resFree[0]['is_eligible'] != "1") {
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 0;
								}else{
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 1;
								}
					}
				}else{
					$searchData['results'][$tutor_search_records_counter]['hRate']		=	$searchData['results'][$tutor_search_records_counter]['hRate'];
					$searchData['results'][$tutor_search_records_counter]['o_hRate'] 	= 	$searchData['results'][$tutor_search_records_counter]['hRate'];
					$searchData['results'][$tutor_search_records_counter]['o_mark'] 	=	'';
					$searchData['results'][$tutor_search_records_counter]['updated'] = 'no';
								if ($resFree[0]['is_eligible'] != "1") {
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 0;
								}else{
									$searchData['results'][$tutor_search_records_counter]['is_eligible'] = 1;
								}
					
				}
				$tutor_search_records_counter++;
			}
		}
		print_r(json_encode($searchData));
		//------------bhavik-----------//
		

		//print_r(json_encode($data));
	}
	public function header()
	{
		header("Cache-Control: no-cache, must-revalidate");
		$this->load->model('lookup_model');
		if($this->session->userdata('multi_lang') && $this->session->userdata('multi_lang')!="")
		{
			$multi_lang =$this->session->userdata('multi_lang');
		}
		else
		{
			$multi_lang ='en';
		}
		$data['multi_lang'] = $multi_lang;
		$this->load->view('angular_search/header',$data);
	}
	public function footer()
	{
		header("Cache-Control: no-cache, must-revalidate");
		$this->load->model('lookup_model');
		if($this->session->userdata('multi_lang') && $this->session->userdata('multi_lang')!="")
		{
			$multi_lang =$this->session->userdata('multi_lang');
		}
		else
		{
			$multi_lang ='en';
		}
		$data['multi_lang'] = $multi_lang;
		$this->load->view('angular_search/footer',$data);
	}
	public function set_language()
	{
		$data = $this->input->post('multiLang');
		$this->session->set_userdata('multi_lang',$data);
	}
}
