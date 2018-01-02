<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'core/TL_AdminController.php';
class Admin extends TL_AdminController {
	public function __construct()  {
        parent::__construct();
		//added by haren
		  $this->clear_cache();
    }
	//added by haren to clear catch
	
	 function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
	
	public function index() {
		if ($this->session->userdata('roleId')==1001) {
			$this->listsession();
		} else {
			//$this->user();
			$this->layout->view('admin/dashboard');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login');
	}
	public function login() {
		$this->load->model(array('user_model','profile_model','langs_model'));
		$userModel =  $this->user_model;
		$islogin = $userModel->isAdminLogin();

		if($islogin && $this->session->userdata('roleId')>1000){
			//---Detect if Technical Support is logged in
			if($this->session->userdata('roleId')>2000){
				$techSupportData = array('techSupportLogin'  => TRUE, 'techSupportEmail' => $this->session->userdata('email'));
				$this->session->set_userdata($techSupportData);
			}else{
				$techSupportData = array('techSupportLogin'  => FALSE, 'techSupportEmail' => '');
				$this->session->set_userdata($techSupportData);
			}
			//---Detect if Technical Support is logged in
			redirect('admin/index');
		}
		$user = array();
		$errorMsg = array();
		if($this->input->post()) {
			$formData = $this->input->post();
			/*echo "<pre>";
			print_r($formData);
			die();*/
			//check form data
			if($formData['username']=='') {
				$errorMsg['errormsg'] = 'username cannot empty';
			}else if($formData['password']=='') {
				$errorMsg['errormsg'] = 'password cannot empty';
			}else {
				$user = $userModel->login($formData);
			}
			//insert to  the profile table
			if($user){
				$profile = $this->profile_model->getProfile($user['id']);
				$uinfo = array(
                    'adminUsername'=>$user['username'],
                    'adminEmail'=>$user['email'],
                    'adminUid'=>$user['id'],
					'adminPic'=>@$profile['pic'],
				    'roleId'=>$user['roleId']
				);
				if($uinfo['roleId'] < 1000){
					$errorMsg['errormsg'] = 'Permission deny.';
				}
				
				else{
					$this->session->set_userdata($uinfo);
					redirect('admin/index');
				}
			}else {
				$errorMsg['errormsg'] = 'please check your username or password is right.';
			}
		}
		$this->load->view('admin/login',$errorMsg);
	}
	public function banner_list() {
		$this->load->model(array('banner_model'));
		$banners = $this->banner_model->loadBanner();
		$this->layout->setData('banners',$banners);
		 
		$this->layout->view('admin/banner_list');
	}
	public function banner_add() {
		$errormsg = '';
		if($this->input->post()){
			unset($_POST['school']);
			$this->load->model(array('banner_model'));
			if(isset($_FILES) && $_FILES['pic']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/images/';
				$upConfig['allowed_types'] = 'gif|jpg|png|jpeg';
				$upConfig['encrypt_name'] = true;
				$resizeConfig['image_library'] = 'gd2';
				$resizeConfig['new_image'] = FCPATH.'uploads/images/thumb/';
				$resizeConfig['maintain_ratio'] = TRUE;
				$resizeConfig['width'] = 500;
				$resizeConfig['height'] = 335;
				$this->image_lib->resize();
				$this->media->upload($upConfig,'pic')->resize($resizeConfig);
				if(!$this->media->error){
					$data = $this->input->post();
					$data['source'] = $this->media->sqlAddress;
					$this->banner_model->banner_add($data);
					$errormsg = 'Add sccuess.';
				}
				if($this->media->error){
					$errormsg = $this->media->error['error'];
				}else {
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}
			}else{
				$errormsg = 'Pic can`t be empty.';
			}
		}
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/banner_add');
	}
	public function banner_edit() {
		$this->load->model(array('banner_model'));
		$errormsg = '';
		$id = $this->input->_request('id');
		if($this->input->post()){
			unset($_POST['school']);
			$this->load->model(array('banner_model'));
			if(isset($_FILES) && $_FILES['pic']['size']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/images/';
				$upConfig['allowed_types'] = 'gif|jpg|png|jpeg';
				$upConfig['encrypt_name'] = true;
				$resizeConfig['image_library'] = 'gd2';
				$resizeConfig['new_image'] = FCPATH.'uploads/images/thumb/';
				$resizeConfig['maintain_ratio'] = TRUE;
				$resizeConfig['width'] = 140;
				$resizeConfig['height'] = 100;
				$this->image_lib->resize();
				$this->media->upload($upConfig,'pic')->resize($resizeConfig);
				if(!$this->media->error){
					$data = $this->input->post();
					$data['source'] = $this->media->sqlAddress;
					$this->banner_model->banner_edit($data,$this->input->post('id'));
					$errormsg = 'Edit Banner successfully.';
				}
				if($this->media->error){
					$errormsg = $this->media->error['error'];
				}else {
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}
			}else{
				$data = $this->input->post();
				$this->banner_model->banner_edit($data,$id);
				$errormsg = 'Edit Banner successfully.';
			}
		}
		$banner = $this->banner_model->get_banner($id);
		
		//echo "<pre>"; print_r($banner);die;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('banner',$banner);
		$this->load->helper('form');
		$this->layout->view('admin/banner_edit');
	}
	public function banner_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('banner_model'));
		$this->banner_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	//---------Home Banner Management start--------------
	public function home_banner_list() {
		$this->load->model(array('banner_model'));
		$banners = $this->banner_model->loadBannerHome();
		
		$this->layout->setData('banners',$banners);
		
		$this->layout->view('admin/home_banner_list');
	}
	public function home_banner_add() {
		$errormsg = '';
		if($this->input->post()){			
			$this->load->model(array('banner_model'));
			if(isset($_FILES) && $_FILES['pic']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/images/';
				$upConfig['allowed_types'] = 'gif|jpg|png|jpeg';
				$upConfig['encrypt_name'] = true;
				$resizeConfig['image_library'] = 'gd2';
				$resizeConfig['new_image'] = FCPATH.'uploads/images/thumb/';
				$resizeConfig['maintain_ratio'] = TRUE;
				$resizeConfig['width'] = 500;
				$resizeConfig['height'] = 335;
				$this->image_lib->resize();
				$this->media->upload($upConfig,'pic')->resize($resizeConfig);
				if(!$this->media->error){
					$data = $this->input->post();
					$data['source'] = $this->media->sqlAddress;
					$this->banner_model->home_banner_add($data);
					$successmsg = 'Banner is added successfully.';
				}
				if($this->media->error){
					$errormsg = $this->media->error['error'];
				}else {
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}
			}else{
				$errormsg = 'Pic can`t be empty.';
			}
		}
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('successmsg',$successmsg);
		$this->load->helper('form');
		$this->layout->view('admin/home_banner_add');
	}
	public function home_banner_edit() {
		$this->load->model(array('banner_model'));
		$errormsg = '';
		$id = $this->input->_request('id');
		if($this->input->post()){
			$this->load->model(array('banner_model'));
			if(isset($_FILES) && $_FILES['pic']['size']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/images/';
				$upConfig['allowed_types'] = 'gif|jpg|png|jpeg';
				$upConfig['encrypt_name'] = true;
				$resizeConfig['image_library'] = 'gd2';
				$resizeConfig['new_image'] = FCPATH.'uploads/images/thumb/';
				$resizeConfig['maintain_ratio'] = TRUE;
				$resizeConfig['width'] = 140;
				$resizeConfig['height'] = 100;
				$this->image_lib->resize();
				$this->media->upload($upConfig,'pic')->resize($resizeConfig);
				if(!$this->media->error){
					$data = $this->input->post();
					$data['source'] = $this->media->sqlAddress;
					$this->banner_model->home_banner_edit($data,$this->input->post('id'));
					$successmsg = 'Home banner is edited successfully.';
				}
				if($this->media->error){
					$errormsg = $this->media->error['error'];
				}else {
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}
			}else{
				$data = $this->input->post();
				$this->banner_model->banner_edit($data,$id);
				$errormsg = 'Edit Banner successfully.';
			}
		}
		$banner = $this->banner_model->home_get_banner($id);
		
		//echo "<pre>"; print_r($banner);die;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('successmsg',$successmsg);
		$this->layout->setData('banner',$banner);
		$this->load->helper('form');
		$this->layout->view('admin/home_banner_edit');
	}

	public function home_banner_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('banner_model'));
		$this->banner_model->home_banner_del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	//-----------Home Banner Management End---------------------

	public function changeStatusActive()
	{
		$id = $this->input->_request('id');
		$sql = "update banners set status=1 where id={$id}";
		$query = $this->db->query($sql);
		$this->banner_list();
	}
	public function changeStatusInActive()
	{
		$id = $this->input->_request('id');
		$sql = "update banners set status=0 where id={$id}";
		$query = $this->db->query($sql);
		$this->banner_list();
	}
	public function article_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('article_model'));
		$errormsg = '';
		if($this->input->post()){
			$data = $this->input->post();
			$this->article_model->article_edit($data,$id);
			$errormsg = 'Edit Article successfully.';
		}
		$article = $this->article_model->get($id);
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('article',$article);
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->view('admin/article_edit');
	}
	public function howItWork() {
		$this->load->model(array('article_model'));
		$videos = $this->article_model->get_cat(1);
		$this->layout->setData('howItworks',$videos);
		$this->layout->view('admin/howItWork');
	}
	public function how_work_add() {
		$errormsg = '';
		if($this->input->post()) {
			$this->load->model(array('article_model'));
			if(isset($_FILES) && ( $_FILES['video']!='' || $_FILES['pdfs']!='' )) {
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/video/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp';
				$upConfig['encrypt_name'] = true;
				$translateConfig['image_library'] = 'gd2';
				$translateConfig['image'] = FCPATH.'uploads/video/images/';
				$translateConfig['path'] = FCPATH.'uploads/video/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$data = $this->input->post();
				$data['cat'] = 1;
				if($_FILES['video']['size']!=''){
					$infos = $this->media->upload($upConfig,'video')->translate($translateConfig)->getInfo();
					if(!$this->media->error){
						$mediaInfo = $this->media->data['upload_data'];
						$data['source'] = $this->media->sqlAddress;
						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] = $this->session->userdata('adminUid');
						$mediaInfo['address'] = $this->media->sqlAddress;
						$this->media_model->save($mediaInfo);
						$data['length'] = $infos['seconds'];
					}else {
						$errormsg = $this->media->error['error'].'2';
					}
				}
				unset($data['video']);
				if($errormsg == '' && $_FILES['pdfs'] !='' && $_FILES['pdfs']['size'] !=''){
					$upConfig['upload_path'] = FCPATH.'uploads/source/';
					$upConfig['allowed_types'] = 'doc|txt|pdf|all';
					$infos = $this->media->upload($upConfig,'pdfs');
					if(!$this->media->error) {
						$data['pdfs'] = $this->media->sqlAddress;
					}else{
						$errormsg = $this->media->error['error'].'1';
					}
				}else {
					unset($data['pdfs']);
				}
				if(!$errormsg) {
					$this->article_model->article_add($data);
					$errormsg = 'Add successfully.';
				}
			}else{
				$errormsg = 'Video or pdf can`t be empty.';
			}
		}
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->view('admin/how_work_add');
	}
	public function how_work_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('article_model'));
		$errormsg = '';
		if($this->input->post()){
			$data = $this->input->post();
			if(isset($_FILES) && $_FILES['video']['size']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/video/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma';
				$upConfig['encrypt_name'] = true;
				$translateConfig['image_library'] = 'gd2';
				$translateConfig['image'] = FCPATH.'uploads/video/images/';
				$translateConfig['path'] = FCPATH.'uploads/video/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$infos = $this->media->upload($upConfig,'video')->translate($translateConfig)->getInfo();
				if(!$this->media->error){
					$data['source'] = $this->media->sqlAddress;
					$data['length'] = $infos['seconds'];
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}else {
					$errormsg = $this->media->error['error'];
				}
			}
			if($_FILES['pdfs']['size'] !=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/video/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma';
				$upConfig['encrypt_name'] = true;
				$upConfig['upload_path'] = FCPATH.'uploads/source/';
				$upConfig['allowed_types'] = 'doc|txt|pdf|all';
				$infos = $this->media->upload($upConfig,'pdfs');
				if(!$this->media->error) {
					$data['pdfs'] = $this->media->sqlAddress;
				}
			}
			if($errormsg ==''){
				unset($data['video']);
				if($_FILES['pdfs'] !=''){
				}else{
					unset($data['pdfs']);
				}
				$this->article_model->article_edit($data,$id);
				$errormsg = 'Edit successfully.';
			}
		}
		$article = $this->article_model->get($id);
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('how',$article);
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->view('admin/how_work_edit');
	}
	public function how_work_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('article_model'));
		$this->article_model->del($id,1);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function langs(){
		$this->load->model(array('langs_model'));
		$langs = $this->langs_model->getLangs(2);
		$this->layout->setData('langs',$langs);
		$this->layout->view('admin/langs');
	}
	public function langs_add(){
		$errormsg = '';
		if($this->input->post()){
			$this->load->model(array('langs_model'));
			$data = $this->input->post();
			$this->langs_model->lang_add($data);
			$errormsg = 'Add sccuess.';
		}
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/langs_add');
	}
	public function langs_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('langs_model'));
		if($this->input->post()){
			$data = $this->input->post();
			$this->langs_model->lang_edit($data,$id);
			$errormsg = 'Edit Langs successfully.';
		}
		$langs = $this->langs_model->getLang($id);
		$this->layout->setData('langs',$langs);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/langs_edit');
	}
	public function langs_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('langs_model'));
		$this->langs_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function user($sort='id',$sortorder='asc',$page_num=1){
	
		$page_number = $this->uri->segment(5);
		
		if(empty($page_number)) $page_number = 1;
		$start = ($page_number-1) * 20;
	
	
		$this->load->model(array('user_model','class_model'));
		//$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		/*$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}*/
		$search = '';
		$seg = $this->uri->segment(5);
		if(!$this->input->post("search") and $seg==""){
			$search = "";
			$this->session->unset_userdata('searchuser');
		} else if($this->input->post("search")) {
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		} else {			
			$search = $this->session->userdata('searchuser');
		}
		if($sort != 'completedSessionDate'){
		
			if($search != ''){
				$users = $this->user_model->getAllAdminBySearch($start,$search,$sort,$sortorder);
				if(count($users)<=0){
					//reset pagination record if get single record
					$start = 0;
					$users = $this->user_model->getAllAdminBySearch($start,$search,$sort,$sortorder);
				}
			}else{
				$users = $this->user_model->getAllAdmin($start,$sort,$sortorder);
			}
		}else{
			$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete, p.money from user as u,profile as p where u.id = p.uid";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$users = $query->result_array();
			}
		}
		$userTemp = array();
		if(count($users)>0){
			$i = 0;
			foreach($users as $user)
			{		
				if(@$user['expDate'] != ''){
					$cdate = date('Y-m-d h:i:s');					
					$ccdate = strtotime($cdate);					
					$xdate = strtotime(@$user['expDate']);					
					if($ccdate > $xdate){
						$sql = "UPDATE user set roleId = 2 WHERE id= $user[id]"; 
						$query = $this->db->query($sql);
					}
				}
				$completedClass = $this->class_model->completedSession($user['id']);
				
				$completedSessionDate = @$completedClass['startTime'];
				$userTemp[$i] = $user;
				$userTemp[$i]['completedSessionDate'] = $completedSessionDate;
				$i++;
			}
		}
		$users = array();
		$users = $userTemp;
		unset($userTemp);
		if($sort == 'completedSessionDate'){
			$sorder = strtoupper($sortorder);
			$sortField = 'completedSessionDate '.$sorder;
			$users = $this->sort_array_multidim($users,$sortField);
			$so = 0;
			foreach($users as $u)
			{
				if($so > 19){
					unset($users[$so]);
				}
				$so++;
			}
		}
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist','4'=>'School','5'=>'Affiliate','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/user/'.$sort.'/'.$sortorder);
		$config['uri_segment'] = 5;
		if($search != ''){
			$config['total_rows'] = $this->user_model->getCountBySearch($search);
		}else{
			$config['total_rows'] = $this->user_model->getCount();
		}
		$config['per_page'] = 20; 
		$config['use_page_numbers'] = TRUE;
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('types',$types);
		$this->layout->setData('users',$users);
		 
		$this->layout->view('admin/user_list');
	}
	public function sort_array_multidim(array $array, $order_by){
		//TODO -c flexibility -o tufanbarisyildirim : this error can be deleted if you want to sort as sql like "NULL LAST/FIRST" behavior.
		if(!is_array($array[0]))
		throw new Exception('$array must be a multidimensional array!',E_USER_ERROR);
		$columns = explode(',',$order_by);
		foreach ($columns as $col_dir)
		{
			if(preg_match('/(.*)([\s]+)(ASC|DESC)/is',$col_dir,$matches)){
				if(!array_key_exists(trim($matches[1]),$array[0]))
					trigger_error('Unknown Column <b>' . trim($matches[1]) . '</b>',E_USER_NOTICE);
				else{
					if(isset($sorts[trim($matches[1])]))
						trigger_error('Redundand specified column name : <b>' . trim($matches[1] . '</b>'));
					$sorts[trim($matches[1])] = 'SORT_'.strtoupper(trim($matches[3]));
				}
			}else{
				throw new Exception("Incorrect syntax near : '{$col_dir}'",E_USER_ERROR);
			}
		}
		$colarr = array();
		foreach ($sorts as $col => $order)
		{
			$colarr[$col] = array();
			foreach ($array as $k => $row)
			{
				$colarr[$col]['_'.$k] = strtolower($row[$col]);
			}
		}
		$multi_params = array();
		foreach ($sorts as $col => $order)
		{
			$multi_params[] = '$colarr[\'' . $col .'\']';
			$multi_params[] = $order;
		}
		$rum_params = implode(',',$multi_params);
		eval("array_multisort({$rum_params});");
		$sorted_array = array();
		foreach ($colarr as $col => $arr)
		{
			foreach ($arr as $k => $v)
			{
				$k = substr($k,1);
				if (!isset($sorted_array[$k]))
				$sorted_array[$k] = $array[$k];
				$sorted_array[$k][$col] = $array[$k][$col];
			}
		}
		return array_values($sorted_array);
	}
	public function user_add(){
		$user = array();
		$errormsg = '';
		if($this->input->post()){
			$this->load->model(array('user_model'));
			$userModel =  $this->user_model;
			$formData = $this->input->post();
			$formData['username'] = $formData['email'];
			$acc = $this->input->post('hiddenRole');
			if($acc == 1){
			}else{
				$formData['hiddenRole'] = 0;
			}
			$quarantine = $this->input->post('quarantine');
			if($quarantine == 1){
			}else{
				$formData['quarantine'] = 0;
			}
			$errorMsg = $this->user_model->checkUserName($formData['username']);
			if($errorMsg['success']) {
				$errorMsg = $this->user_model->checkEmail($formData['email']);
				if($errorMsg['success']) {
					$errorMsg = $this->user_model->checkPassword($formData['password']);
				}
			}
			if($errorMsg['success'] == false){
				$errormsg = $errorMsg['message'];
				$user = $formData;
			}else {
				unset($formData['cppassword']);
				$formData['password'] = md5($formData['password']);
				/* added by Ilyas */
				if($formData['roleId'] <= '1')
				{
					$formData['universal_roleId'] = $formData['roleId'];
				}
				else if(($formData['roleId'] == '2') or ($formData['roleId'] == '3'))				 
				{
					$formData['universal_roleId'] = '1';
				}
				else
				{
					$formData['universal_roleId'] = '0';
				}
				/* end */
				$uid = $userModel->user_add($formData);
				$errormsg = 'Add sccuess.';
			}
		}
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		$chat = array('1'=>'Yes','0'=>'No');
		$this->layout->setData('types',$types);
		$this->layout->setData('chat',$chat);
		$this->layout->setData('user',$user);
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/user_add');
	}
	
	public function user_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';$successmsg ="";
		$this->load->model(array('user_model','profile_model'));
		//--Check If Accountant
		//--R&D@Dec-05 Check Accountant
		$currentUserRole	= $this->session->userdata['roleId'];
		if($currentUserRole == 1002){ $this->layout->setData('isAccount',TRUE);}else{ $this->layout->setData('isAccount',FALSE); }
		if($this->input->post()){
		  
			$data = $this->input->post();
			
			 
			
			$newDate = date("Y-m-d", strtotime($data['expDate']));

			$acc = $this->input->post('hiddenRole');
			if($acc == 1){
			}else{
				$data['hiddenRole'] = 0;
			}
			$quarantine = $this->input->post('quarantine');

			/* march scope  */
			$testAccount = $this->input->post('testAccount');
			
			if($testAccount == 1){
			}else{
				$data['testAccount'] = 0;
			}
			/* march scope */

			if($quarantine == 1){
			}else{
				$data['quarantine'] = 0;
			}
			
			if($currentUserRole == 1002)
			{
				if($this->input->post('is_eligible')){
					$is_eligible = $this->input->post('is_eligible');
					$data['is_eligible'] = $is_eligible;
				} else {
					$data['is_eligible'] = 0;
				}
			}
			
			//--R&D@Dec-05 Update ExpDate
			if($data['expDate']){
				$this->user_model->updateExpDate($newDate,$id);
			}
			//--R&D@Dec-05 Update ExpDate
			
			
			
			$profileData = array();
			if(isset($data['lms_complete'])){
				$profileData['lms_complete'] = $data['lms_complete'];
			}
			$profileData['uid'] = $id;
			unset($data['lms_complete']);
			
			//--Update Balance
			if(isset($data['money'])){
				$profileData['money'] = $data['money'];
			}
			unset($data['money']);
			unset($data['cur_bal']);
			unset($data['expDate']);
			//--Update Balance
			/* added by Ilyas */
			if($data['roleId'] <= '1')
			{
				$data['universal_roleId'] = $data['roleId'];
			}
			else if(($data['roleId'] == '2') or ($data['roleId'] == '3'))				 
			{
				$data['universal_roleId'] = '1';
			}
			else
			{
				$data['universal_roleId'] = '0';
			}
			/* end */
			$this->user_model->user_edit($data,$id);
			$this->profile_model->update($profileData);
			$successmsg = 'Edit User successfully.';
			$data['money'] = $profileData['money'];
			$data['cur_bal']= $profileData['money'];
		}
		$user = $this->user_model->getByUid($id);
		$profile = $this->profile_model->getProfileJoin($id);
		$userroledata = $user['roleId'];

		
		$user = array_merge($user,$profile);
		
		/*echo $user['roleId'];
		if($currentUserRole == 1002){*/

		$expDateArray = $this->user_model->getExpDateByUid($id);				
		if($expDateArray[0]['expDate'] != "" ){
			$expDate = $expDateArray[0]['expDate'];
		}else{
			$expDate = '';
		}
		
		//echo $expDate;exit;
/*		}else{
$expDate = '';
}*/
//--Check If Accountant
		
		
		
		
		$this->layout->setData('user',$user);
		$this->layout->setData('userroledata',$userroledata);
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist','4'=>'School','5'=>'Affiliate','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		$chat = array('1'=>'Yes','0'=>'No');
		$this->layout->setData('chat',$chat);
		$this->layout->setData('types',$types);
		$this->layout->setData('errormsg',$errormsg);		
		$this->layout->setData('successmsg',$successmsg);
		$this->layout->setData('expDate',$expDate);
		$this->load->helper('form');
		$this->layout->view('admin/user_edit');
	}
	
	//--R&D@Dec-05 Added user note
	public function user_addnote(){
		$id 		= $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 	= '';
		$this->load->model(array('user_model','profile_model'));
		if($this->input->post()){
			$data 	= $this->input->post();
			if($data['dispute_id']=="" || $data['note']==""){
				$errormsg = 'Dispute ID and Note are required.';
			}else{
				if ( ! is_numeric ( trim($data['dispute_id'] )) ) {
					$errormsg = 'Dispute ID is invalid.';
				}elseif(strlen($data['note']) > 200){
					$errormsg = 'Note must be less than 200 characters.';
				
				}else{
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
						//$noteRole = $this->session->userdata['adminUsername'];
						$data['role'] = $noteRole;
						$data['user_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->user_addnote($data);
						$errormsg = 'Note has been added successfully.';
						}
				}
			}
		}
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/user_note');
	}
	//--R&D@Dec-05 Added user note
	
	
	public function get_user_note(){
		$this->load->model(array('user_model','profile_model'));
		$id = $this->input->_request('id');
		
		if($id<0){
			$id = 1;
		}
		if($this->input->post()){
			$data 	= $this->input->post();
			if($data['dispute_id']=="" || $data['note']==""){
				$errormsg = 'Dispute ID and Note are required.';
			}else{
				if ( ! is_numeric ( trim($data['dispute_id'] )) ) {
					$errormsg = 'Dispute ID is invalid.';
				}elseif(strlen($data['note']) > 200){
					$errormsg = 'Note must be less than 200 characters.';
				
				}else{
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
						//$noteRole = $this->session->userdata['adminUsername'];
						$data['role'] = $noteRole;
						$data['user_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->user_addnote($data);
						$errormsg = 'Note has been added successfully.';
					}
				}
			}
		}

		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		if($search != ''){
			$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);			
			if(count($usernotes)<=0){
				$start = 0;
				$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);
			}
		}else{
			$usernotes = $this->user_model->getAllUserNotes($start,$sort,$sortorder);
		}
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/user_notes/start');
		$config['uri_segment'] = 5;		
		if($search != ''){
			//$config['total_rows'] = $this->user_model->getNoteCountBySearch($start,$id,$sort,$sortorder);
			$config['total_rows'] = $this->user_model->getNoteCount();
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('id',$id);
		//$note_data = $this->user_model->getUserNote($id);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/usernote_list');
	
	}

	//--R&D@Dec-05 Added user notes
	public function user_notes(){
		$this->load->model(array('user_model','profile_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		if($search != ''){
			$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);
			if(count($users)<=0){
				$start = 0;
				$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);
			}
		}else{
			$usernotes = $this->user_model->getAllUserNotes($start,$sort,$sortorder);
		}
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/user_notes/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->getNoteCountBySearch($search);
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/usernote_list');
	}
	//--R&D@Dec-05 Added user notes
	
	
	
	
	
	
	
	public function user_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function location(){
		$this->load->model(array('location_model'));
		$cid = $this->input->_request('cid',1);
		$location = $this->location_model->getProvices1($cid);
		$country = $this->location_model->getCountries($cid);
		$this->load->helper('form');
		$this->layout->setData('country',$country);
		$this->layout->setData('cid',$cid);
		$this->layout->setData('location',$location);
		$this->layout->setData('cid',$cid);
		$this->layout->view('admin/location');
	}
	public function location_add(){
		$errormsg = '';
		$this->load->model(array('location_model'));
		$cid = $this->input->_request('cid',1);
		if($this->input->post()){
			$data = $this->input->post();
			$this->location_model->provices_add($data);
			$errormsg = 'Add sccuess.';
		}
		$country = $this->location_model->getCountries($cid);
		$this->load->helper('form');
		$this->layout->setData('country',$country);
		$this->layout->setData('cid',$cid);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/location_add');
	}
	public function location_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('location_model'));
		if($this->input->post()){
			$data = $this->input->post();
			$this->location_model->provices_edit($data,$id);
			$errormsg = 'Edit Location successfully.';
		}
		$country = $this->location_model->getCountries();
		$this->load->helper('form');
		$this->layout->setData('country',$country);
		$location = $this->location_model->getProviceById($id);
		$this->layout->setData('location',$location);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/location_edit');
	}
	public function location_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('location_model'));
		$this->location_model->provices_del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function country(){
		$this->load->model(array('location_model'));
		$countries = $this->location_model->getCountries(0);
		$this->layout->setData('countries',$countries);
		$this->layout->view('admin/country');
	}
	public function country_add(){
		$errormsg = '';
		if($this->input->post()){
			$this->load->model(array('location_model'));
			$data = $this->input->post();
			$this->location_model->country_add($data);
			$errormsg = 'Add sccuess.';
		}
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/country_add');
	}
	public function country_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('location_model'));
		if($this->input->post()){
			$data = $this->input->post();
			$this->location_model->country_edit($data,$id);
			$errormsg = 'Edit Country successfully.';
		}
		$country = $this->location_model->getCountryById($id);
		$this->layout->setData('country',$country);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/country_edit');
	}
	public function country_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('location_model'));
		$this->location_model->country_del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function ads() {
		$this->load->model(array('ad_model'));
		$videos = $this->ad_model->getAll();
		$this->layout->setData('howItworks',$videos);
		$this->layout->view('admin/ads');
	}
	
	public function advertise_list() {
	// echo "hi";die();
		$this->load->model(array('ad_model'));
		$videos = $this->ad_model->getAdvertisement();
		$this->layout->setData('howItworks',$videos);
		$this->layout->view('admin/advertise_list');
	}
	
	public function ad_add(){
	  
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
		
			$this->load->model(array('ad_model'));
			$data = $this->input->post();
			if($this->input->post()){
				if(isset($_FILES) && $_FILES['image']!='')
				{
					$this->load->library('media','upload');
					$upConfig['upload_path'] = FCPATH.'uploads/images/';
					$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
					$upConfig['encrypt_name'] = true;
					$translateConfig['image_library'] = 'gd2';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['new_image'] = FCPATH.'uploads/images/ad/';
					$translateConfig['width'] = 245;
					$translateConfig['height'] = 206;
					$this->media->upload($upConfig,'image')->resize($translateConfig);
					if(!$this->media->error){
						$data['source'] = $this->media->sqlAddress;
						unset($data['image']);
						$succrmsg = 'Add successfully.';
						$this->layout->setData('succrmsg',$succrmsg);
					}else {
						//$errormsg = $this->media->error['error'];
					}
				}else{
					//$errormsg = 'Image can`t be empty.';
				}
			}
			$this->ad_model->ad_add($data);
			$succrmsg = 'Add successfully.';
			$this->layout->setData('succrmsg',$succrmsg);
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/ad_add');
	}
	public function advertise(){
	 
	 
	
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
            $cdate = date('Y-m-d');
             //echo $cdate; 			
			$this->load->model(array('ad_model'));
			$data = $this->input->post();
			if($this->input->post()){
			$user=$this->session->userdata['roleId'];
	if($user != 1002){
	
			$data['expdate'] = $cdate;
			}
				if(isset($_FILES) && $_FILES['image']!='')
				{
					$this->load->library('media','upload');
					$upConfig['upload_path'] = FCPATH.'uploads/images/';
					$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
					$upConfig['encrypt_name'] = true;
					$translateConfig['image_library'] = 'gd2';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['new_image'] = FCPATH.'uploads/images/ad/';
					$translateConfig['width'] = 245;
					$translateConfig['height'] = 206;
					$this->media->upload($upConfig,'image')->resize($translateConfig);
					if(!$this->media->error){
						$data['source'] = $this->media->sqlAddress;
						unset($data['image']);
						$succrmsg = 'Add successfully.';
						$this->layout->setData('succrmsg',$succrmsg);
					}else {
						//$errormsg = $this->media->error['error'];
					}
				}else{
					//$errormsg = 'Image can`t be empty.';
				}
			}
			
			$this->ad_model->ad_advertise($data);
			$succrmsg = 'Add successfully.';
			$this->layout->setData('succrmsg',$succrmsg);
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/add_advertise');
	}
	public function ad_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('ad_model'));
		$errormsg = '';
		$succrmsg ='';
		$errorStatus = false;
		if($_POST):
			$data = $this->input->post();
			if ($errorStatus == false){
				if($this->input->post()){		
					if(isset($_FILES) && $_FILES['image']['size']!=''){
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/images/';
						$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
						$upConfig['encrypt_name'] = true;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['new_image'] = FCPATH.'uploads/images/ad/';
						$translateConfig['width'] = 245;
						$translateConfig['height'] = 206;
						$this->media->upload($upConfig,'image')->resize($translateConfig);
						if(!$this->media->error){
							
							$data['source'] = $this->media->sqlAddress;
							//$this->load->model('ad_model');
						}else {
							//$errormsg = $this->media->error['error'];
						}
					}
					if($errormsg ==''){
						unset($data['image']);
						$this->ad_model->ad_edit($data,$id);
						$succrmsg = 'Edit success.';
					}
				}
			}
		endif;
		$ad = $this->ad_model->get($id);
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/ad_edit');
	}
	public function advertisement_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
	 
	$user=$this->session->userdata['roleId'];
	if($user == 1002){
	 
		$this->load->model(array('ad_model'));
		$errormsg = '';
		$succrmsg ='';
		$errorStatus = false;
		if($_POST):
		
			$data = $this->input->post();
			
			if ($errorStatus == false){
				if($this->input->post()){		
					if(isset($_FILES) && $_FILES['image']['size']!=''){
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/images/';
						$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
						$upConfig['encrypt_name'] = true;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['new_image'] = FCPATH.'uploads/images/ad/';
						$translateConfig['width'] = 245;
						$translateConfig['height'] = 206;
						$this->media->upload($upConfig,'image')->resize($translateConfig);
						if(!$this->media->error){
							
							$data['source'] = $this->media->sqlAddress;
							//$this->load->model('ad_model');
						}else {
							//$errormsg = $this->media->error['error'];
						}
					}
					if($errormsg ==''){
						unset($data['image']);
						$this->ad_model->advertise_edit($data,$id);
						$succrmsg = 'Edit success.';
					}
				}
			}
		endif;
		$ad = $this->ad_model->getAdid($id);
		
				if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/advertisement_edit');
		 }
		 else
		 {
		redirect('admin/advertise_list');
		}
	
	}
	public function ad_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('ad_model'));
		$this->ad_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function advertise_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('ad_model'));
		$this->ad_model->delAdvertise($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function price(){
		$this->load->model('ad_model');
		if($this->input->post()){
			$this->ad_model->saveConfig($this->input->post('config'));
			$errorMsg = 'Save sccuess.';
			$this->layout->setData('errormsg',$errorMsg);
		}
		$config = $this->ad_model->getConfig();
		/*echo "<pre>";
		print_r($config);die();*/
		$this->layout->setData('config',$config);
		$this->layout->view('admin/price');
	}
	/*Function name : qoute 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function quotes(){
		$this->load->model(array('qoute_model'));
		$videos = $this->qoute_model->getAll();
		$this->layout->setData('howItworks',$videos);
		$this->layout->view('admin/quotes');
	}
	/*Function name : qoute_add 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function quotes_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):	
			if(trim($this->input->post('quotedby'))==''){
					$errormsg = 'The Quotes By field is required.';
					$errorStatus = true;
			}
			if(trim($this->input->post('quote'))==''){
					$errormsg= 'The Quotes field is required.';
					$errorStatus = true;
			}
			if ($errorStatus == false){
				if($this->input->post()){
					$this->load->model(array('qoute_model'));
					$data = $this->input->post();
					$this->qoute_model->quote_add(($data));
					$succrmsg = 'Add Quotes successfully.';
				}
			}
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/quotes_add');
	}
	/*Function name : qoute_edit 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function quotes_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$this->load->model(array('qoute_model'));
		if($_POST):	
			if(trim($this->input->post('quote'))==''){
				$errormsg= 'The Quotes field is required.';
				$errorStatus = true;
			}
			if(trim($this->input->post('quotedby'))==''){
				$errormsg = 'The Quotes By field is required.';
				$errorStatus = true;
			}
			if ($errorStatus == false){
				if($this->input->post()){
					$data = $this->input->post();
					$this->qoute_model->quote_edit($data,$id);
					$succrmsg = 'Edit Quotes successfully.';
				}
			}
		endif;
		$ad = $this->qoute_model->get($id);
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/quotes_edit');
	}
	/*Function name : qoute_del
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function quotes_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('qoute_model'));
		$this->qoute_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	/*Function name : video 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function video() {
		$this->load->model(array('video_model'));
		$videos = $this->video_model->getAll();
		$this->layout->setData('howItworks',$videos);
		$this->layout->view('admin/video');
	}
	/*Function name : video_add 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function video_add(){
		$timestamp=time();
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('video_model'));
		if($_POST):
			if(trim($this->input->post('title'))==''){
				$errormsg= 'The Title field is required.';
				$errorStatus = true;
			}
			if ($errorStatus == false){
				if($this->input->post()){
					if(isset($_FILES) && $_FILES['video_file']!='') {
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/video/';
						$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp';
						$upConfig['encrypt_name'] = true;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['image'] = FCPATH.'uploads/video/images/';
						$translateConfig['path'] = FCPATH.'uploads/video/';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['width'] = 706;
						$translateConfig['height'] = 399;
						$data = $this->input->post();
						$data['status'] = $this->input->post('status');
						if($_FILES['video_file']['size']!=''){
							$infos = $this->media->upload($upConfig,'video_file')->translate($translateConfig)->getInfo();
							if(!$this->media->error){
								$mediaInfo = $this->media->data['upload_data'];
								$data['video_file'] = $this->media->sqlAddress;
								$this->load->model('media_model');
								$mediaInfo = $this->media->data['upload_data'];
								$mediaInfo['uid'] = $this->session->userdata('adminUid');
								$mediaInfo['address'] = $this->media->sqlAddress;
								$this->media_model->save($mediaInfo);
							}else {
								$errormsg = $this->media->error['error'].'2';
							}
						}
					}else{
						$errormsg = 'Video can`t be empty.';
					}
					if(!$errormsg) {
						$this->video_model->video_add($data);
						$succrmsg = 'Add successfully.';
					}
				}
			}
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/video_add');
	}
	/*Function name : video_edit
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function video_edit(){
		$timestamp=time();
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('video_model'));
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
			if(trim($this->input->post('title'))==''){
				$errormsg= 'The Title field is required.';
				$errorStatus = true;
			}
			if ($errorStatus == false){
				if($this->input->post()){
					$data = $this->input->post();
					if(isset($_FILES) && $_FILES['video_file']['size']!=''){
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/video/';
						$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma';
						$upConfig['encrypt_name'] = true;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['image'] = FCPATH.'uploads/video/images/';
						$translateConfig['path'] = FCPATH.'uploads/video/';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['width'] = 706;
						$translateConfig['height'] = 399;
						$infos = $this->media->upload($upConfig,'video_file')->translate($translateConfig)->getInfo();
						if(!$this->media->error){
							$data['video_file'] = $this->media->sqlAddress;
							$this->load->model('media_model');
							$mediaInfo = $this->media->data['upload_data'];
							$mediaInfo['uid'] = $this->session->userdata('adminUid');
							$mediaInfo['address'] = $this->media->sqlAddress;
							$this->media_model->save($mediaInfo);
						}else {
							$errormsg = $this->media->error['error'];
						}
					}
					if(!$errormsg) {
						unset($data['video_file']);
						$this->video_model->video_edit($data,$id);
						$succrmsg = 'Edit success.';
					}
				}
			}
		endif;
		$ad = $this->video_model->get($id);
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/video_edit');
	}
	/*Function name : video_del
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function video_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('video_model'));
		$this->video_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	/*Function name : qoute_add 
	  Author : TECHNO-MAYA
	  Date :16-05-2013
	*/
	public function settings1(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):	
			if(trim($this->input->post('banded_words'))==''){
					$errormsg = 'The Settings field is required.';
					$errorStatus = true;
			}
			if($errorStatus == false){
				if($this->input->post()){
					$this->load->model(array('settings_model'));
					$data = $this->input->post();
					$this->settings_model->settings_add(($data));
					$succrmsg = 'Add Settings successfully.';
				}
			}
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/settings');
	}
	public function settings(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$this->load->model(array('settings_model'));
		if($_POST):	
			if($this->input->post('banded_words')==''){
				$errormsg= 'The Banded Words field is required.';
				$errorStatus = true;
			}
			if ($errorStatus == false){
				if($this->input->post()){
					$data = $this->input->post();
					$this->settings_model->settings_edit($data);
					$succrmsg = 'Edited banned words successfully.';
				}
			}
		endif;
		$ad = $this->settings_model->get($id);
		if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/settings');
	}
	/*Function name : video 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function dashboardmessages() {
		$this->load->model(array('dashboardmessages_model'));
		$message = $this->dashboardmessages_model->getAll();
		$this->layout->setData('messages',$message);
		$this->layout->view('admin/dashboardmessages');
	}
	/*Function name : chat messages 
	  Author : TECHNO-SANJAY
	  Date :18-06-2013
	*/
	public function chatmessages() {
		$this->load->model(array('dchatmodel'));
		$messages = $this->dchatmodel->getAll();
		$this->layout->setData('messages',$messages);
		$this->layout->view('admin/chatmessages');
	}
	/*Function name : video_add 
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function dashboardmessages_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('dashboardmessages_model'));
		if($_POST):
			if ($errorStatus == false) {
				if($this->input->post()){
					$data = $this->input->post();
					$data['status'] = $this->input->post('status');
					/*if(isset($_FILES) && $_FILES['video_file']!='') 
					{
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/video/';
						$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp';
						$upConfig['encrypt_name'] = true;

						$translateConfig['image_library'] = 'gd2';
						
						$translateConfig['image'] = FCPATH.'uploads/video/images/';
						$translateConfig['path'] = FCPATH.'uploads/video/';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['width'] = 706;
						$translateConfig['height'] = 399;
						if($_FILES['video_file']['size']!=''){
							$infos = $this->media->upload($upConfig,'video_file')->translate($translateConfig)->getInfo();
							if(!$this->media->error){

								$mediaInfo = $this->media->data['upload_data'];
								$data['source'] = $this->media->sqlAddress;

								$this->load->model('media_model');
								$mediaInfo = $this->media->data['upload_data'];
								$mediaInfo['uid'] = $this->session->userdata('adminUid');
								$mediaInfo['address'] = $this->media->sqlAddress;
								$this->media_model->save($mediaInfo);
							}
							else {
								$errormsg = $this->media->error['error'].'2';
							}
						}
					
					}*/
					if(isset($_FILES) && $_FILES['image_file']!='') 
					{
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/images/';
						$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
						$upConfig['encrypt_name'] = true;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['image'] = FCPATH.'uploads/video/images/';
						$translateConfig['path'] = FCPATH.'uploads/video/';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['width'] = 706;
						$translateConfig['height'] = 399;
						if($_FILES['image_file']['size']!=''){
							$infos = $this->media->upload($upConfig,'image_file')->translate($translateConfig)->getInfo();
							if(!$this->media->error){
								$mediaInfo = $this->media->data['upload_data'];
								$data['image'] = $this->media->sqlAddress;
								$this->load->model('media_model');
								$mediaInfo = $this->media->data['upload_data'];
								$mediaInfo['uid'] = $this->session->userdata('adminUid');
								$mediaInfo['address'] = $this->media->sqlAddress;
								$this->media_model->save($mediaInfo);
							}else {
								$errormsg = $this->media->error['error'].'2';
							}
						}
					}
					if(!$errormsg) {
						$this->dashboardmessages_model->dashboardmessages_add($data);
						$succrmsg = 'Add successfully.';
					}
				}
			}
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/dashboardmessages_add');
	}
	/*Function name : video_edit
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function dashboardmessages_edit(){
		$timestamp=time();
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('dashboardmessages_model'));
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
		if ($errorStatus == false) {
		if($this->input->post()){
			$data = $this->input->post();
			if(isset($_FILES) && $_FILES['image_file']['size']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/images/';
				$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
				$upConfig['encrypt_name'] = true;
				$translateConfig['image_library'] = 'gd2';
				$translateConfig['image'] = FCPATH.'uploads/video/images/';
				$translateConfig['path'] = FCPATH.'uploads/video/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;

				$infos = $this->media->upload($upConfig,'image_file')->translate($translateConfig)->getInfo();
				if(!$this->media->error){
					$data['image'] = $this->media->sqlAddress;
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
				}
				else {
					$errormsg = $this->media->error['error'];
				}
			}
			
			if(!$errormsg) {
				unset($data['dashboardmessages_file']);
				$this->dashboardmessages_model->dashboardmessages_edit($data,$id);
				$succrmsg = 'Edit success.';
			}

		}
		
	}
	 endif;
		$ad = $this->dashboardmessages_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/dashboardmessages_edit');
	}
	/*Function name : video_del
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function dashboardmessages_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('dashboardmessages_model'));
		$this->dashboardmessages_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	/*Function name : chatmessage_del
	  Author : TECHNO-SANJAY
	  Date :18-06-2013
	*/
	public function chatmessage_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('dchatmodel'));
		$this->dchatmodel->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	/*Function name : mass messaging functions 
	  Author : TECHNO-SANJAY
	  Date :08-07-2013
	*/

    public function messaging() {
		$this->load->model(array('messaging_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchdisputes');
		
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'date';
		}
		
		$search = '';
		if($this->input->post())
		{
			$search = $this->input->post('search');
			$this->session->set_userdata(array('searchmessages'=>$search));
		}elseif($this->session->userdata('searchmessages'))
		{
			$search = $this->session->userdata('searchmessages');
		}
		
		$total_pages = $this->messaging_model->getTotalMessages($search);
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		
		$targetpage = base_url()."admin/messaging/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page) 
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;
		
		
		$message = $this->messaging_model->getAllAdmin($search,$sortorder,$sort,$start,$limit);
		if(count($message)<=0)
		{
			$start = 0;
			$message = $this->messaging_model->getAllAdmin($search,$sortorder,$sort,$start,$limit);
		}
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('page',$page);
		$this->layout->setData('search',$search);
		
		//$message = $this->messaging_model->getAll();
		
		
		$this->layout->setData('messages',$message);
		$this->layout->view('admin/messaging');
		
	}
	public function messaging_newsletter() {
		$this->load->model(array('messaging_model'));
		
		if($this->input->post()){
		    $data = $this->input->post();
			if($data)
			{
				$updata = array();
				foreach($data as $key => $value)
				{
					$updata[$key] = nl2br($value); 
				}
			}
			if($this->input->post('id'))
			{
				$id = $this->input->post('id');
				
				$templates = $this->messaging_model->editNewsletter($data,$id);
			}else{
				$templates = $this->messaging_model->insertNewsletter($data);
			}
		}
		$newsletter = $this->messaging_model->getAllNewsletter();
		if($newsletter){$newsletter = $newsletter[0];}
		$this->layout->setData('newsletter',$newsletter);
		
		$this->layout->view('admin/messaging_newsletter');
	}
	public function messages_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('messaging_model'));
		$this->messaging_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function messaging_send() {
		$this->load->model(array('messaging_model'));
		if($this->input->post()){
			
		    $data = $this->input->post();
			
			$data['msgtype'] = "general";
			
			//set for affiliate option
			if($data['sendtype'] == 'affiliates')
			{
				$data['func'] = 1;
				$status = $this->messaging_affiliate_send($data);
			}else{
				$status = $this->send_mass_message($data);
			}
			
			//echo $status;exit;
			if($status)
			{
				$this->layout->setData('succrmsg','Message successfully sent.');
			}else{
				$this->layout->setData('errormsg','Error during sending message.');
			}
		}
		
		$message = $this->messaging_model->getAll();
		$this->layout->setData('message',$message);
		$this->layout->view('admin/messaging_send');
	}
	public function messaging_affiliate_send($data = array()) {
		$this->load->model(array('messaging_model'));
		if($this->input->post()){
			if(@$data['func'])
			{}else{
				$data = $this->input->post();
			}
			// set variable for affiliate programme
			if(@$data['subject'] != ''){
				$data['subject'] = $data['subject'];
			}else{
				$data['subject'] = "TheTalklist Affiliate";
			}
			$data['msgtype'] = "affiliate";
			
			$status = $this->send_mass_message($data);
			//echo $status;exit;
				
			if($status)
			{
				$this->layout->setData('succrmsg','Message successfully sent.');
			}else{
				$this->layout->setData('errormsg','Error during sending message.');
			}
		}
		
		//$message = $this->messaging_model->getAll();
		//$this->layout->setData('message',$message);
		if(@$data['func']){
			return $status;
		}else{
			$this->layout->view('admin/messaging_affiliate_send');
		}
	}
	public function send_mass_message($data)
	{
		$this->load->model(array('messaging_model'));
		$group = $data['group'];

		if($data['sendtype'] == 'affiliates')
		{
			$sendType = 'email';
		}else{
			$sendType = $data['sendtype'];
		}
		if($data['msgtype'] == 'general' OR $data['msgtype'] == 'affiliate')
		{	
			$message = nl2br($data['message']);
			$msgData['message'] = $message;
		}
		$subject = $data['subject'];
		if($subject == '')
		{
			$subject = "TheTalklist";
		}
		
		$msgData['subject'] = $subject;
		$msgData['sendto'] = $sendType;
		$msgData['group'] = $group;
		$msgData['date'] = date('Y-m-d H:i:s',time());
		$users = array();
		$success = false;
		if($group!= '')
		{
			if($group == 'allmember')
			{
				$users = $this->messaging_model->getAllMember();
			}elseif($group == 'individualmember')
			{
				$users = $this->messaging_model->getIndividualMember(@$data['email']);
			}elseif($group == 'upgradedtutor')
			{
				$users = $this->messaging_model->getUpgradedTutor();
			}elseif($group == 'alltutor')
			{
				$users = $this->messaging_model->getAllTutor();
			}elseif($group == 'allstudent')
			{
				$users = $this->messaging_model->getAllStudent();
			}
			
		}
		
		if($sendType == 'inbox')
		{
			$this->load->model(array('inbox_model'));
			if(count($users)>0)
			{
				$fromUid = $this->inbox_model->getUidByUsername($this->user['username']);
				$this->load->library('email');
				$uidSendIndividual = '';
				$emailSendIndividual = '';
				foreach($users as $user)
				{
					$this->inbox_model->send($user['id'],$fromUid,$subject,$message);
					
					$personal = "SELECT forwardemail FROM user where id =".$user['id'];
					$perquery = $this->db->query($personal);
					$perresult = $perquery->row_array();
					
					$username = $this->getUsernameByUid($user['id']);
					
					$uidSendIndividual = $user['id'];
					$emailSendIndividual = $username;
					
					if($perresult['forwardemail'] == 1){		
						
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
						$this->email->to($user['email']);
						$this->email->send();
					}
					
					
					
				}
				//for individual users
				if($group == 'individualmember')
				{
					$msgData['name'] = $emailSendIndividual; 
					$msgData['uid'] = $uidSendIndividual; 
				}
				
				$qry = $this->messaging_model->message_add($msgData);
				$success = true;
			}
		}elseif($sendType == 'email')
		{
			$this->load->model(array('inbox_model'));
			$this->load->library('email');
			//print_r($users);
			
			if(count($users)>0)
			{
				if($data['msgtype'] == 'affiliate')
				{
					/*print_r($subject);
					exit;*/
					$this->email->mailtype = 'html';
					$this->email->from('no-reply@thetalklist.com','TheTalklist');
					
					$uidSendIndividual = '';
					$emailSendIndividual = '';
					
					for($i=0; $i<count($users); $i++){
						$name = $this->messaging_model->getUserName($users[$i]['id']);
						
						$uidSendIndividual = $users[$i]['id'];
						$emailSendIndividual = $this->getUsernameByUid($users[$i]['id']);
						
						$str = "";
						$str = "Dear ".$name."\r\n<br/>";
						$str .= "Affiliate #: www.thetalklist.com/".$users[$i]['id']."\r\n<br/>";
						$str .= $message."\r\n<br/>";
						$str .= "\r\n<br/>";
						//print_r($users[$i]['email']);
						$str .= "Thank you,\r\n<br/>";
						$str .= "TheTalkList Support Team<br>";
						$this->email->message($str);
						//echo $users[$i]['email'];
						$this->email->to($users[$i]['email']);
						$this->email->subject($subject);
						//$this->email->to('lopez@igist.com');
						@$this->email->send();
					}
					//echo $str;
					/*foreach($users as $user)
					{
						$name = $this->messaging_model->getUserName($user['id']);
						$str .= "Dear ".$name.":\r\n<br/>";
						$str .= "Affiliate #: www.thetalklist.com/".$user['id']."\r\n<br/>";
						$str .= $message."\r\n<br/>";
						$str .= "\r\n<br/>";
						$str .= "Thank you,\r\n<br/>";
						$str .= "TheTalkList Support Team";
						$this->email->message($str);
						$this->email->to($user['email']);
						@$this->email->send();
					}*/
					
					//for individual users
					if($group == 'individualmember')
					{
						$msgData['name'] = $emailSendIndividual; 
						$msgData['uid'] = $uidSendIndividual; 
					}
					
					$qry = $this->messaging_model->message_add($msgData);
					$success = true;
				}else{
					$str = "";
					$str .= $message;
					$str .= "\r\n<br/>";
					$str .= "Thank you,\r\n<br/>";
					$str .= "TheTalkList Support Team";
					// $this->email->mailtype = 'html';
					// $this->email->from('no-reply@thetalklist.com','TheTalklist');
					// $this->email->subject($subject);
					// $this->email->message($str);
					$uidSendIndividual = '';
					$emailSendIndividual = '';
					
					foreach($users as $user)
					{
						$uidSendIndividual = $user['id'];
						$emailSendIndividual = $this->getUsernameByUid($user['id']);
						
						$this->email->mailtype = 'html';
						$this->email->from('no-reply@thetalklist.com','TheTalklist');
						$this->email->subject($subject);
						$this->email->message($str);
						$this->email->to($user['email']);
						//$this->email->to('lopez@igist.com');
						$this->email->send();
						//break;
					}
					if($group == 'individualmember')
					{
						$msgData['name'] = $emailSendIndividual; 
						$msgData['uid'] = $uidSendIndividual;  
					}
					
					$qry = $this->messaging_model->message_add($msgData);
					$success = true;
				}
			}
		}
		return $success;
	}
	public function getUsernameByUid($uid)
	{
		$sql = "SELECT firstName,LastName from profile where uid = {$uid}";
		$query = $this->db->query($sql);
		$result = array();
		$username = '';
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$username = $result['firstName'].' '.$result['LastName'];
		}
		return $username;
	}
	//WDC NEW COMMIT START BELOW 
	public function multi_lang() {
		$this->load->model(array('lookup_model','langs_model'));
		$selectedLang = 'kr';
		$start = $this->input->_request('start');
		$langreq = trim($this->input->post('langreq'));
		if($langreq){
			$this->session->set_userdata(array('langreq'=>$langreq));
		}else{
			$langreq = $this->session->userdata('langreq');
		}
		$search = '';
		if (!$this->input->post("search") and !$this->uri->segment(4)) {
			$search = '';
			$this->session->unset_userdata('searchlng');
		} else if ($this->input->post("search")) {
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchlng'=>$search));
		} else {
			$search = $this->session->userdata('searchlng');
		}
		if($langreq != ''){
			$selectedLang = $langreq;
		}
		
		if(!$start){
			$start = 0;
		}
		$lookup = $this->lookup_model->getAll($start,"15",$search);
		
		$this->load->library('pagination');
		$errormsg = $this->session->userdata('msg');
		
		$this->session->set_userdata('msg', '');
		$this->session->unset_userdata('mlback');
		
		$config['base_url'] = base_url('admin/multi_lang/start');
		$config['uri_segment'] = 4;
		$config['total_rows'] = $this->lookup_model->getCount($search);
		$config['per_page'] = 15; 
		/* WDC COMMIT START 07-24-2013 */
		$config['num_links'] = 20;
		/* WDC COMMIT START 07-24-2013 */
		$this->pagination->initialize($config); 
		
		
		$langs = $this->langs_model->getLangs(2);
		$options = array();
		$option = '';
		
		
		// foreach($langs as $lng){
			// $optId = $lng['id']; 
			// $optValue = $lng['lang']; 
			// if($optId == $selectedLang){
				// $option .= '<option value="'.$optId.'" selected="selected">'.$optValue.'</option>';
			// }else{
				// $option .= '<option value="'.$optId.'">'.$optValue.'</option>';
			// }
		// }
		$options = array(
                  'en'    => 'English',
				  'es' => 'Español',
				  'ch'   => '简体中文',
                  'tw' => '繁體中文',
				  'jp' => '日本語',
				  'kr'    => '한국어',
                  'pt' => 'Português',
				  'fr' => 'français',
                );
				
		$seloectedlangPass = array();		
		foreach($options as $key => $value){
			$optId = $key; 
			$optValue = $value; 
			if($optId == $selectedLang){
				$option .= '<option value="'.$optId.'" selected="selected">'.$optValue.'</option>';
				$seloectedlangPass['id'] = $selectedLang;
				$seloectedlangPass['value'] = $optValue;
			}else{
				$option .= '<option value="'.$optId.'">'.$optValue.'</option>';
			}
		}
		
		
		$langSelect = '<select name="language" id="language" style="margin-right:10px;height:20px;">'.$option.'</select>';
		$this->layout->setData('langSelect',$langSelect);
		$this->layout->setData('selectedLang',$seloectedlangPass);
		
		$page = $this->pagination->create_links();
		$this->layout->setData('page',$page);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('lookup',$lookup);		
		$this->layout->setData('search',$search);
		$this->layout->view('admin/lookup');
	}
	

	public function multi_edit(){
		
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('lookup_model'));
		
		if(!$back = $this->session->userdata('mlback')){
			$back = $_POST['langreq'];
			$this->session->set_userdata(array('mlback'=>$back));
		}
		
		if($this->input->post() && $_POST['langreq']==''){
			$data = $this->input->post();
			$this->lookup_model->edit_multi($data,$id);
			
			$this->session->set_userdata('msg', 'Edit successful.');
			
			//$errormsg = 'Edit sccuess.';
			//redirect('admin/multi_lang');
			header('Location:'.$back);
		}
		$selectedLang = $this->session->userdata('langreq');
		if($selectedLang == ''){
			$selectedLang = 'kr';
		}
		$options = array(
                  'en'    => 'English',
				  'es' => 'Espanol',
				  'ch'   => '简体中文',
                  'tw' => '繁體中文',
				  'jp' => '日本語',
				  'kr'    => '한국어',
                  'pt' => 'Portuguese',
				  'fr' => 'français',
                );
		$seloectedlangPass = array();		
		$seloectedlangPass['id'] = $selectedLang;
		$seloectedlangPass['value'] = $options[$selectedLang];		
		$this->layout->setData('selectedLang',$seloectedlangPass);
		
		$lookup = $this->lookup_model->getById($id);
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->setData('lookup',$lookup);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/edit_multi');
	}
	//WDC NEW COMMIT COMPLETE
	//SKV NEW COMMIT FOR REVIEW SECTION
	public function reviews() {
		$this->load->model(array('review_model'));
		
		$total_pages = $this->review_model->getTotalReview();
		
		
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		
		$targetpage = base_url()."admin/reviews/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page) 
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		
		$reviews = $this->review_model->getAll($start,$limit);
		
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		$newReviews = array();
		if(count($reviews)>0)
		{	
			$i = 0;
			foreach($reviews as $review)
			{
				$newReviews[$i]['id'] = $review['id'];
				$newReviews[$i]['onTime'] = $review['onTime'];
				$newReviews[$i]['clearReception'] = $review['clearReception'];
				$newReviews[$i]['polite'] = $review['polite'];
				$newReviews[$i]['knowledg'] = $review['knowledg'];
				$newReviews[$i]['freeOfDistraction'] = $review['freeOfDistraction'];
				$newReviews[$i]['msg'] = $review['msg'];
				$newReviews[$i]['student'] = $this->review_model->getUserProfile($review['receiverId']);
				$newReviews[$i]['tutor'] = $this->review_model->getUserProfile($review['callerId']);
				$newReviews[$i]['status'] = $review['status'];
				$newReviews[$i]['create_at'] = $review['create_at'];
				$i++;
			}
		}
		
		
		
		
		$this->layout->setData('reviews',$newReviews);
		$this->layout->view('admin/reviews');
	}
	
	public function paginateReview($targetpage,$total_pages,$limit,$page,$start)
	{
		$adjacents = 3;
		if ($page == 0) $page = 1;					
		$prev = $page - 1;							
		$next = $page + 1;							
		$lastpage = ceil($total_pages/$limit);		
		$lpm1 = $lastpage - 1;						
		
		$pagination = "";
		if($lastpage > 1)
		{
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"$targetpage/page/$prev\">Latest </a>";
			else
				$pagination.= "<span class=\"disabled
				\">Latest </span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage/page/$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage/page/$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage/page/$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage/page/$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage/page/1\">1</a>";
					$pagination.= "<a href=\"$targetpage/page/2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage/page/$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage/page/$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage/page/$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage/page/1\">1</a>";
					$pagination.= "<a href=\"$targetpage/page/2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage/page/$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"$targetpage/page/$next\"> First</a>";
			else
				$pagination.= "<span class=\"disabled\"> First</span>";
			$pagination.= "</div>\n";		
		}
		return $pagination;
	}
	
	public function review_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('review_model'));
		$this->review_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function review_status_update(){
		$id = $this->input->_request('id');
		if($this->input->_request('hstatus'))
		{
			$hstatus = $this->input->_request('hstatus');
			$hstatus = $hstatus[0];
		}else{
			$hstatus = 0;
		}
		$this->load->model(array('review_model'));
		$this->review_model->statusupdate($id,$hstatus);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	//SKV END REVIEW SECTION
	/**
	 * @author SKV start 12 Aug 2013
	 * @package dispute resolution 
	 * @param dispute resolution function 
	 */
	public function disputeResolution(){
		$this->load->model(array('pay_model','profile_model'));
		//$paymentsAll = $this->pay_model->getAll();
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'createAt';
		}
		
		$search = '';
		
		if($this->input->post())
		{
			$search = $this->input->post('search'); 
			$this->session->set_userdata('searchdisputes',$search);
		}elseif($this->session->userdata('searchdisputes'))
		{
			$search = $this->session->userdata('searchdisputes');
		}
		 
		$total_pages = $this->pay_model->getTotalDisputes($search);
		
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 20;
		}
		
		$targetpage = base_url()."admin/disputeResolution/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		//$reviews = $this->review_model->getAll($start,$limit);
		$paymentsAll = $this->pay_model->getAll($start,$search,$limit,$sortorder,$sort);
		if($paymentsAll=='')
		{
			$start = 0;
			$paymentsAll = $this->pay_model->getAll($start,$search,$limit,$sortorder,$sort);
		}
		//paginate review 
		
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		//echo "<pre>"; print_r($paymentsAll);die;
		if($paymentsAll)
		{
			$payments = array();
			$i = 0;
			
			foreach ($paymentsAll as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				//$payments[$i]['tutorhRate'] = @$user1['hRate'];
				$payments[$i]['tutorhRate'] = @$payf['t_hrate'];
				//print_r($user1);exit;
				
				
				$payments[$i]['status'] = @$payf['p_status'];
				$payments[$i]['creatAt'] = @$payf['createAt'];
				$payments[$i]['approve'] = @$payf['approve'];
				$payments[$i]['postpone'] = @$payf['postpone'];
				$payments[$i]['PayDate'] = @$payf['PayDate'];
				$payments[$i]['is_Deleted'] = @$payf['is_Deleted'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['cid'] = @$payf['cid'];
				$payments[$i]['type'] = @$payf['type'];
				
				$payments[$i]['money'] = @$payf['fee'];
				$action = unserialize(@$payf['action']);
				 
				if($action['studentConnected']==1)
				{
					$payments[$i]['sconnect']='Y';
				}
				else
				{
						$payments[$i]['sconnect']='N';
				}
				if($action['tutorConnected']==1)
				{
					$payments[$i]['tconnect']='Y';
				}
				else
				{
						$payments[$i]['tconnect']='Y';
				}
				
				$i++;
			}
		}
		
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		
		$this->layout->setData('search',$search);
		$this->layout->setData('payments',$payments);
		$this->layout->view('admin/disputeResolution');
	}
	/**
	 * @author SKV start 12 Aug 2013
	 * @package dispute resolution 
	 * @param dispute resolution delete function 
	 */
	public function disputes_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('pay_model'));
		$this->pay_model->del_disputes($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	/**
	 * @author SKV start 12 Aug 2013
	 * @package dispute resolution 
	 * @param dispute resolution pospond function 
	 */
	public function disputes_postpond(){
		$id = $this->input->_request('id');
		$id = $id[0];
		$this->load->model(array('pay_model'));
		$this->pay_model->disputes_postpond($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	public function disputes_approve(){
	
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model(array('pay_model','profile_model'));
		$id = $this->input->_request('id');		
		//print_r($id);
		
		$status = $this->input->_request('approveval');
		//print_r($status);
		$disputetutor = $this->pay_model->select_dispute_approve($id[0]);
		$res = $this->profile_model->getProfile($disputetutor['tid']);
		
		if($disputetutor['t_hrate'] > 0){
			/*
			$logger = new PPLoggingManager('MassPay');
			$massPayRequest = new MassPayRequestType();
			$massPayRequest->MassPayItem = array();
			//echo $disputetutor['t_hrate'];
			// exit;
			$masspayItem = new MassPayRequestItemType();	
			$masspayItem->Amount = new BasicAmountType('USD',  $disputetutor['t_hrate']);
			$masspayItem->ReceiverEmail = $res['payment_account'];
			$massPayRequest->MassPayItem[] = $masspayItem;
			$massPayReq = new MassPayReq();
			$massPayReq->MassPayRequest = $massPayRequest;
			$paypalService = new PayPalAPIInterfaceServiceService();
			try {
				$massPayResponse = $paypalService->MassPay($massPayReq);
			} catch (Exception $ex) {
				include_once("../Error.php");
				exit;
			}
			*/
			
			$status = $status[0];
			//echo $status;die;
			//exit;
			if($status == 1)
			{
				$status = 0;
			}else{
				$status = 1;
			}

			$this->load->model(array('pay_model'));
			$tdate=date("Y-m-d");
			$this->pay_model->disputes_approve($id,$status,$tdate);
			$this->pay_model->clear_tutor_payment_approve($disputetutor['tid'],$disputetutor['t_hrate']);
			echo json_encode(array('status'=>true,'ids'=>$id,'val'=>$status));
			
			/*
			if(isset($massPayResponse)) {
			 
				 if($massPayResponse->Ack == 'Success'){
					$this->load->model(array('pay_model'));
					$tdate=date("Y-m-d");
					$this->pay_model->disputes_approve($id,$status,$tdate);
					$this->pay_model->clear_tutor_payment_approve($disputetutor['tid'],$disputetutor['t_hrate']);
					echo json_encode(array('status'=>true,'ids'=>$id,'val'=>$status));
				}
			}
			*/
		}
		else{
			$tdate=date("Y-m-d");
			$status = 1;			
			$this->pay_model->disputes_approve($id,$status,$tdate);
			//$this->pay_model->clear_tutor_payment_approve($disputetutor['tid'],$disputetutor['t_hrate']);			
			echo json_encode(array('status'=>true,'ids'=>$id,'val'=>'1'));
		}
	}
	/**
	 * @author SKV start 19 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking document list function 
	 */
	public function documentlist() {
		$this->load->model(array('lms_model'));
		$documents = $this->lms_model->getAdminAll();
		$this->layout->setData('documents',$documents);
		$this->layout->view('admin/documentlist');
	}
	/**
	 * @author SKV start 19 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking document add function 
	 */
	public function adddocument(){
		$timestamp=time();
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('lms_model'));
		
		if($_POST):
			if(trim($this->input->post('title'))=='')
			{
				$errormsg= 'The Title field is required.';
				$errorStatus = true;
			}
		
			if ($errorStatus == false) 
			{
			if($this->input->post()){
				
				if(isset($_FILES) && $_FILES['document_file']!='') {
					$this->load->library('media','upload');
					$upConfig['upload_path'] = FCPATH.'uploads/LMS/';
					$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|pdf|doc|txt|pdf|xls|jpg|gif|png|all';
					//$upConfig['allowed_types'] = 'all';
					$upConfig['encrypt_name'] = true;

					$translateConfig['image_library'] = 'gd2';
					
					$translateConfig['image'] = FCPATH.'uploads/LMS/images/';
					$translateConfig['path'] = FCPATH.'uploads/LMS/';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['width'] = 706;
					$translateConfig['height'] = 399;
					$data = $this->input->post();
					$data['status'] = $this->input->post('status');
					$videoFlag = 0;
					$fileType = $_FILES['document_file']['type'];
					if($fileType)
					{
						$fileType = explode('/',$fileType);
						if($fileType[0] == 'video')
						{
							$videoFlag = 1;
						}
					}
					if($_FILES['document_file']['size']!=''){
						
						if($videoFlag == 1)
						{
							$infos = $this->media->upload($upConfig,'document_file')->translate($translateConfig)->getInfo();
						}else{
							$infos = $this->media->upload($upConfig,'document_file');
						}
						if(!$this->media->error){

							$mediaInfo = $this->media->data['upload_data'];
							$data['document_file'] = $this->media->sqlAddress;

							$this->load->model('media_model');
							$mediaInfo = $this->media->data['upload_data'];
							$mediaInfo['uid'] = $this->session->userdata('adminUid');
							$mediaInfo['address'] = $this->media->sqlAddress;
							$this->media_model->save($mediaInfo);

						}
						else {
							$errormsg = $this->media->error['error'].'2';
						}
					}
					
				}
				else{
					$errormsg = 'Document can`t be empty.';
				}
				
				if(!$errormsg) {
					$this->lms_model->document_add($data);
					$succrmsg = 'Add successfully.';
				}
				
			}
		 }
	 endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/document_add');
	}
	/**
	 * @author SKV start 19 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking document edit function 
	 */
	public function editdocument(){
		
		$timestamp=time();
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('lms_model'));
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
		if(trim($this->input->post('title'))=='')
		{
			$errormsg= 'The Title field is required.';
			$errorStatus = true;
		}
		if ($errorStatus == false) 
		{
		if($this->input->post()){
			$data = $this->input->post();
		
			if(isset($_FILES) && $_FILES['document_file']['size']!=''){
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/LMS/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|doc|txt|pdf|xls|jpg|gif|png|all';
				$upConfig['encrypt_name'] = true;
				$translateConfig['image_library'] = 'gd2';
				$translateConfig['image'] = FCPATH.'uploads/LMS/images/';
				$translateConfig['path'] = FCPATH.'uploads/LMS/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$videoFlag = 0;
				
				$fileType = $_FILES['document_file']['type'];
				if($fileType)
				{
					$fileType = explode('/',$fileType);
					if($fileType[0] == 'video')
					{
						$videoFlag = 1;
					}
				}
				
				if($videoFlag == 1)
				{
					$infos = $this->media->upload($upConfig,'document_file')->translate($translateConfig)->getInfo();
				}else{
					$infos = $this->media->upload($upConfig,'document_file');
				}
				if(!$this->media->error){
					$data['document_file'] = $this->media->sqlAddress;
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					$mediaInfo['uid'] = $this->session->userdata('adminUid');
					$mediaInfo['address'] = $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);

				}
				else {
					$errormsg = $this->media->error['error'];
				}
			}
			
			if(!$errormsg) {
				//unset($data['document_file']);
				$this->lms_model->document_edit($data,$id);
				$succrmsg = 'Edit success.';
			}

		}
		
	}
	 endif;
		$ad = $this->lms_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/document_edit');
	}
	/*Function name : video_del
	  Author : TECHNO-SANJAY
	  Date :16-05-2013
	*/
	public function document_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('lms_model'));
		$this->lms_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	/**
	 * @author SKV start 21 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking Question list function 
	 */
	public function questionlist() {
		$this->load->model(array('lms_model'));
		
		$total_pages = $this->lms_model->getTotalQuestions();
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		
		$targetpage = base_url()."admin/questionlist/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page) 
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		//$reviews = $this->review_model->getAll($start,$limit);
		$questions = $this->lms_model->getAllAdminQuestion($start,$limit);
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		
		//$questions = $this->lms_model->getAllQuestion();
		$this->layout->setData('questions',$questions);
		$this->layout->view('admin/questionlist');
	}
	/**
	 * @author SKV start 21 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking Question add function 
	 */
	public function addquestion(){
		$timestamp=time();
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('lms_model'));
		
		if($_POST):
			
			$data = $this->input->post();
			
			if(trim($this->input->post('question'))=='')
			{
				$errormsg= 'The Question field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('ans1'))=='')
			{
				$errormsg.= 'The Option  1 field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('ans2'))=='')
			{
				$errormsg.= 'The Option 2 field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('rans'))=='')
			{
				$errormsg.= 'The Correct Answer field is required.';
				$errorStatus = true;
			}
			
			if ($errorStatus == false) 
			{
				if(!$errormsg) {
					$this->lms_model->question_add($data);
					$succrmsg = 'Add successfully.';
				}
			}
		 
	 endif;
		$documents = $this->lms_model->getAll();
		$this->layout->setData('documents',$documents);
		
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/question_add');
	}
	/**
	 * @author SKV start 21 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking Question edit function 
	 */
	public function editquestion(){
		$timestamp=time();
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('lms_model'));
		$id = $this->input->_request('id');	
		if($_POST):
			
			
			$data = $this->input->post();
			
			if(trim($this->input->post('question'))=='')
			{
				$errormsg= 'The Question field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('ans1'))=='')
			{
				$errormsg.= 'The Option  1 field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('ans2'))=='')
			{
				$errormsg.= 'The Option 2 field is required.<br/>';
				$errorStatus = true;
			}
			if(trim($this->input->post('rans'))=='')
			{
				$errormsg.= 'The Correct Answer field is required.';
				$errorStatus = true;
			}
			
			if ($errorStatus == false) 
			{
				if(!$errormsg) {
					$this->lms_model->question_edit($data,$id);
					$succrmsg = 'Add successfully.';
				}
			}
		 
	 endif;
		$question = $this->lms_model->getQuestion($id);
		$this->layout->setData('question',$question);
		
		$documents = $this->lms_model->getAll();
		$this->layout->setData('documents',$documents);
		
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/question_edit');
	}
	/**
	 * @author SKV start 21 Aug 2013
	 * @package LMS Tracking 
	 * @param LMS Tracking Question delete function 
	 */
	public function question_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('lms_model'));
		$this->lms_model->delQuestion($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	
	
	/*
	@author : R&D@Sept-19-2013
	@desc   : FAQ section
	*/
	//--R&D@Sept-19-2013 : Get FAQ list
    public function faq(){
		$this->load->model(array('faq_model'));
		$faqs = $this->faq_model->getAll();
		$this->layout->setData('faqs',$faqs);
		$this->layout->view('admin/faq');
	}
	//--R&D@Sept-19-2013 :Add FAQ	
	public function faq_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		
		if($_POST):	
			if(trim($this->input->post('answer'))==''){
					$errormsg = 'FAQ answer field is required.';
					$errorStatus = true;
			}
			if(trim($this->input->post('question'))==''){
					$errormsg= 'FAQ question field is required.';
					$errorStatus = true;
			}	
			if ($errorStatus == false) {
				if($this->input->post()){
				$this->load->model(array('faq_model'));
				$data = $this->input->post();
				$this->faq_model->faq_add(($data));
				$succrmsg = 'FAQ Added successfully.';
				}
			}
			endif;
			$this->layout->setData('errormsg',$errormsg);
			$this->layout->setData('succrmsg',$succrmsg);
			$this->layout->view('admin/faq_add');
		
	}
	//--R&D@Sept-19-2013 : Edit FAQ
	public function faq_edit(){
		$id = $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 		= '';
		$succrmsg 		= '';
		$errorStatus 	= false;
		
		$this->load->model(array('faq_model'));
		if($_POST):	
		if(trim($this->input->post('question'))==''){
			$errormsg= 'FAQ question field is required.';
			$errorStatus = true;
		}
		if(trim($this->input->post('answer'))==''){
			$errormsg = 'FAQ answer field is required.';
			$errorStatus = true;
		}
		if ($errorStatus == false) {
			if($this->input->post()){
				$data = $this->input->post();
				$this->faq_model->faq_edit($data,$id);
				$succrmsg = 'FAQ has been updated successfully.';
			}
		}
		endif;
		$ad = $this->faq_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/faq_edit');
	}
	
	//--R&D@Sept-19-2013 : Delete FAQ
	public function faq_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('faq_model'));
		$this->faq_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	//---R&D@Oct-24 : Instant Messaging STARTS
    public function im(){
		$this->load->model(array('im_model'));
		$ims = $this->im_model->getAll();
		$unread = $this->im_model->get_unread();
		$this->layout->setData('ims',$ims);
		$this->layout->setData('unread',$unread);
		$this->layout->view('admin/im');
	}
	public function im_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):	
			if(trim($this->input->post('answer'))=='')  { $errormsg = 'Answer field is required.';$errorStatus = true;}
			if(trim($this->input->post('question'))==''){ $errormsg= 'Question field is required.';$errorStatus = true;}	
			if ($errorStatus == false) {
				if($this->input->post()){
					$this->load->model(array('im_model'));
					$data = $this->input->post();
					$this->im_model->im_add(($data));
					$succrmsg = 'Added successfully.';
				}
			}
			endif;
			$this->layout->setData('errormsg',$errormsg);
			$this->layout->setData('succrmsg',$succrmsg);
			$this->layout->view('admin/im_add');
	}

	public function im_edit(){
		$id = $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 		= '';
		$succrmsg 		= '';
		$errorStatus 	= false;
		$this->load->model(array('im_model'));
		if($_POST):	
		if(trim($this->input->post('que'))==''){$errormsg= 'Question field is required.';$errorStatus = true;}
		if(trim($this->input->post('ans'))==''){ $errormsg = 'Answer field is required.';$errorStatus = true;}
		if ($errorStatus == false) {
			if($this->input->post()){
				$data = $this->input->post();
				$this->im_model->im_edit($data,$id);
				$succrmsg = 'Answer has been updated successfully.';
			}
		}
		endif;
		$ad = $this->im_model->get($id);
		if($id < 10){ $index = $id;}else {$index = 0;}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/im_edit');
	}

	public function im_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('im_model'));
		$this->im_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	//---R&D@Oct-24 : Instant Messaging ENDS	

	
	/*
	@author : R&D@Sept-19-2013
	@desc   : Tresources section
	*/
	//--R&D@Sept-19-2013 : Get Teachers'Resource content list
    public function tresources(){
		$this->load->model(array('tresources_model'));
		$tresources = $this->tresources_model->getAll();
		$this->layout->setData('tresources',$tresources);
		$this->layout->view('admin/tresources');
	}
	//--R&D@Sept-19-2013 :Add Teachers'Resource content	
	public function tresources_add(){
	
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		////////viplove 14-2-14 add functionalty  start////////	
		
		if($_POST):	
			if(trim($this->input->post('type'))=='l')
			{
				if(trim($this->input->post('link'))==''){
						$errormsg = 'Link field is required.';
						$errorStatus = true;
				}
				if(trim($this->input->post('ldescription'))==''){
						$errormsg= 'Link description field is required.';
						$errorStatus = true;
				}	
			}
			if(trim($this->input->post('type'))=='v')
			{
			$ftype = 'vfile' ;
				if($_FILES['vfile']['name']=='')
				{
					$errormsg = 'Video is required.';
					$errorStatus = true;
				}
				if(trim($this->input->post('vdescription'))==''){
						$errormsg= 'Video description is required.';
						$errorStatus = true;
				}	
				
			}
			//////////for pdf start///
			if(trim($this->input->post('type'))=='p')
			{
				$ftype = 'pfile' ;
				if($_FILES['pfile']['name']=='')
				{
					$errormsg = 'PDF is required.';
					$errorStatus = true;
				}
				if(trim($this->input->post('pdescription'))=='')
				{
					$errormsg= 'PDF description is required.';
					$errorStatus = true;
				}	
			}
			
			//////////////////pdf end//
			if ($errorStatus == false) 
			{
			   
				if(trim($this->input->post('type'))=='v' || (trim($this->input->post('type'))=='p'))
				{
				   
					$config['upload_path'] = FCPATH.'vedio/support/';
					$config['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|pdf';
					//$config['max_size']	= '100';
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload($ftype))
					{
						$error = array('error' => $this->upload->display_errors());
						

					}
					else
					{
					    
						
						$data = array('upload_data' => $this->upload->data());
						
						$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $data['upload_data']['file_name'];
						$data[$ftype] = $img['file_name'];
						$data[$ftype] =  $data['upload_data']['file_name'];
						
						
//$this->load->view('upload_success', $data);
						
			
					}
				}
				 
				$data['vdescription'] = $this->input->post('vdescription') ;
				$data['pdescription'] = $this->input->post('pdescription') ;
				$data['type']         = $this->input->post('type') ;
				$data['vtitle']       = $this->input->post('vtitle') ;
				$data['ptitle']       = $this->input->post('ptitle') ;
				$data['rType']        = $this->input->post('rType') ;
				$data['ltitle']       = $this->input->post('ltitle') ;
				$data['link']         = $this->input->post('link') ;
				$data['ldescription'] = $this->input->post('ldescription') ;
				$data['status']       = $this->input->post('status') ;
				 
				/*$this->load->model(array('tresources_model'));
				//$data = $this->input->post();
				$this->tresources_model->tresources_add($data);
				$succrmsg = 'Teachers\'Resource content added successfully.';*/

			}
			
			/////////////////////viplove code end//////
			if ($errorStatus == false) 
			{
				
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'vedio/support/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|pdf';
				$upConfig['encrypt_name'] = true;
				$translateConfig['image_library'] = 'gd2';
				//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
				$translateConfig['source_image'] = FCPATH.'vedio/support/images/';
				$translateConfig['path'] = FCPATH.'vedio/support/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$translateConfig['i'] = 399;
				$data = $this->input->post();
				
				if($_FILES['vfile']['size']!=''){
				$infos = $this->media->upload($upConfig,'vfile')->translate($translateConfig)->getInfo();
				}
				
				if($_FILES['pfile']['size']!=''){
				$infos = $this->media->upload($upConfig,'pfile')->translate($translateConfig)->getInfo();
				}
				//echo "<pre>"; print_r($infos);die;
				//print_r($this->media->error);
				//die();
				if(!$this->media->error)
				{
				   if(trim($this->input->post('type'))=='v' || (trim($this->input->post('type'))=='p'))
				   {
					
					$mediaInfo = $this->media->data['upload_data'];
					$fullpath = $mediaInfo['full_path'];
					
					$data['vfile'] = $mediaInfo['file_name']; //$this->media->sqlAddress;
					
					$this->load->model('media_model');
					$mediaInfo = $this->media->data['upload_data'];
					
					$mediaInfo['uid'] 		= $this->session->userdata('adminUid');
					$mediaInfo['address'] 	= $this->media->sqlAddress;
					$this->media_model->save($mediaInfo);
					}
					$this->load->model(array('tresources_model'));
					//$data = $this->input->post();
					
					$this->tresources_model->tresources_add($data);
					$succrmsg = 'Teachers\'Resource content added successfully.';
					//$data['length'] = $infos['seconds'];
				}
				else 
				{
				  
					$errormsg = $this->media->error['error'].'2';
				}
				//}

			}
			endif;	
				/////for pdf start//
				
			/*	if($_FILES['pfile']['size']!=''){
				
			//	echo $_FILES['pfile']['size'];exit;
				
					$infos = $this->media->upload($upConfig,'pfile')->translate($translateConfig)->getInfo();
					
					//print_r($infos);exit;
					
					if(!$this->media->error){

						$mediaInfo = $this->media->data['upload_data'];
						
						//print_r($mediaInfo);exit;
						
						$data['pfile'] = $this->media->sqlAddress;
	//print_r($data['pfile']);exit;
						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] 		= $this->session->userdata('adminUid');
						$mediaInfo['address'] 	= $this->media->sqlAddress;
						
						//echo $mediaInfo['address'] ; exit;
						
						$this->media_model->save($mediaInfo);

						//$data['length'] = $infos['seconds'];
					}
					else {
						$errormsg = $this->media->error['error'].'2';
					}
				}

				
							/////for pdf end//	
				
				
				if($this->input->post()){
				
			//	print_r($this->input->post());
			//	exit;
				$this->load->model(array('tresources_model'));
				$data = $this->input->post();
				$this->tresources_model->tresources_add(($data));
				$succrmsg = 'Teachers\'Resource content added successfully.';
				}
			}
			endif; */
			$this->layout->setData('errormsg',$errormsg);
			$this->layout->setData('succrmsg',$succrmsg);
			$this->layout->view('admin/tresources_add');
		
	}
	//--R&D@Sept-19-2013 : Edit Teachers'Resource content
	public function tresources_edit(){
	
	//////viplove edit functionalty start 14-2-14////
	
		$id = $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 		= '';
		$succrmsg 		= '';
		$errorStatus 	= false;
		
		$this->load->model(array('tresources_model'));
		if($_POST):	
			if(trim($this->input->post('type'))=='l')
			{
				if(trim($this->input->post('link'))=='')
				{
						$errormsg = 'Link field is required.';
						$errorStatus = true;
				}
				if(trim($this->input->post('ldescription'))=='')
				{
						$errormsg= 'Link description field is required.';
						$errorStatus = true;
				}	
				
			}
			if(trim($this->input->post('type'))=='v'){
			$ftype = 'vfile' ;
			
				///FILES validation not required for edit
				/*if($_FILES['vfile']['name']==''){
						$errormsg = 'Video is required.';
						$errorStatus = true;
				}*/
				if(trim($this->input->post('vdescription'))==''){
						$errormsg= 'Video description is required.';
						$errorStatus = true;
				}	
				
			}
			
			if(trim($this->input->post('type'))=='P'){
			
			$ftype = 'pfile' ;
			///FILES validation not required for edit
				/*if($_FILES['pfile']['name']==''){
						$errormsg = 'PDF is required.';
						$errorStatus = true;
				}*/
				if(trim($this->input->post('pdescription'))==''){
						$errormsg= 'PDF description is required.';
						$errorStatus = true;
				}	
				
			}
			
			if ($errorStatus == false) {
			
			
			$config['upload_path'] = FCPATH.'vedio/support/';
		$config['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|pdf';
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if(trim($this->input->post('type'))=='v'){
		
		if ( ! $this->upload->do_upload($ftype))
		{
			$error = array('error' => $this->upload->display_errors());
 
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());
			$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
//$file_name = $upload_data['file_name'];
$data[$ftype] = $img['file_name'];
			
			//$data[$ftype] =  $data['upload_data']['file_name'];
			//echo $data[$ftype];
			//echo "hereeee";
			//exit;
			//print_r($data);
			//exit;
			//$this->load->view('upload_success', $data);
		}
		
		}
		
		
		if(trim($this->input->post('type'))=='P'){
		
		//echo $this->input->post('type')."ok";exit;
		
		if ( ! $this->upload->do_upload($ftype))
		{
			$error = array('error' => $this->upload->display_errors());
 
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());
			$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
//$file_name = $upload_data['file_name'];
$data[$ftype] = $img['file_name'];
			
			//$data[$ftype] =  $data['upload_data']['file_name'];
			//echo $data[$ftype];
			//echo "hereeee";
			//exit;
			//print_r($data);
			//exit;
			//$this->load->view('upload_success', $data);
		}
		
		}
		
		
		
		
		
		
		if(trim($this->input->post('type'))=='P')
		{
		//echo $this->input->post('type')."om";exit;
		$data['pdescription'] = $this->input->post('pdescription') ;
	 	$data['ptitle']       = $this->input->post('ptitle') ;
		$data['rType']        = $this->input->post('rType') ;
		$data['status']       = $this->input->post('status') ;
		
		}
		if(trim($this->input->post('type'))=='l')
		{
		$data['rType']        = $this->input->post('rType') ;
		$data['status']       = $this->input->post('status') ;
		$data['ltitle']       = $this->input->post('ltitle') ;
		$data['link']         = $this->input->post('link') ;
		$data['ldescription'] = $this->input->post('ldescription') ;
		}
		else
		{
		
		$data['vdescription'] = $this->input->post('vdescription') ;
	 	$data['vtitle']       = $this->input->post('vtitle') ;
		$data['rType']        = $this->input->post('rType') ;
		$data['status']       = $this->input->post('status') ;
		}					
			/*$this->load->model(array('tresources_model'));
				//$data = $this->input->post();
				$this->tresources_model->tresources_edit(($data), $id);
				$succrmsg = 'Teachers\'Resource content updated successfully.';*/
$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'vedio/support/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp';
				$upConfig['encrypt_name'] = true;

				$translateConfig['image_library'] = 'gd2';
				//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
				$translateConfig['image'] = FCPATH.'vedio/support/images/';
				$translateConfig['path'] = FCPATH.'vedio/support/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$data = $this->input->post();
				
				if($_FILES['vfile']['size']!=''){
					$infos = $this->media->upload($upConfig,'vfile')->translate($translateConfig)->getInfo();
					if(!$this->media->error){

						$mediaInfo = $this->media->data['upload_data'];
						$data['vfile'] = $this->media->sqlAddress;

						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] 		= $this->session->userdata('adminUid');
						$mediaInfo['address'] 	= $this->media->sqlAddress;
						$this->media_model->save($mediaInfo);

						//$data['length'] = $infos['seconds'];
					}
					else {
						$errormsg = $this->media->error['error'].'2';
					}
				}
//echo '<pre>';print_r($data);echo $id;die;
				if($this->input->post()){
				$this->load->model(array('tresources_model'));
			//	$data = $this->input->post();
				$this->tresources_model->tresources_edit(($data), $id);
				$succrmsg = 'Teachers\'Resource content updated successfully.';
				}
					}
					
			endif;
			$ad = $this->tresources_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/tresources_edit');
			
//////viplove edit functionalty end 14-2-14////
		/* if ($errorStatus == false) {
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'vedio/support/';
				$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp';
				$upConfig['encrypt_name'] = true;

				$translateConfig['image_library'] = 'gd2';
				//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
				$translateConfig['image'] = FCPATH.'vedio/support/';
				$translateConfig['path'] = FCPATH.'vedio/support/';
				$translateConfig['maintain_ratio'] = TRUE;
				$translateConfig['width'] = 706;
				$translateConfig['height'] = 399;
				$data = $this->input->post();
				
				if($_FILES['vfile']['size']!=''){
					$infos = $this->media->upload($upConfig,'vfile')->translate($translateConfig)->getInfo();
					if(!$this->media->error){

						$mediaInfo = $this->media->data['upload_data'];
						$data['vfile'] = $this->media->sqlAddress;

						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] 		= $this->session->userdata('adminUid');
						$mediaInfo['address'] 	= $this->media->sqlAddress;
						$this->media_model->save($mediaInfo);

						//$data['length'] = $infos['seconds'];
					}
					else {
						$errormsg = $this->media->error['error'].'2';
					}
				}

				if($this->input->post()){
				$this->load->model(array('tresources_model'));
				$data = $this->input->post();
				$this->tresources_model->tresources_edit(($data), $id);
				$succrmsg = 'Teachers\'Resource content updated successfully.';
				}
		}
		endif;
		$ad = $this->tresources_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/tresources_edit');
 */	
 }
	
	//--R&D@Sept-19-2013 : Delete Teachers'Resource content
	public function tresources_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('tresources_model'));
		$this->tresources_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	/**
	* @package    TTL
	* @category   Forum
	* @author     R&D
	* @since      Oct - 2013
	**/
	function forum(){
		$this->template['module']	= 'forum';
		$this->template['admin'] 	= true;
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		$this->topics();
	}
	function topics(){
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		//$this->user->check_level('forum', LEVEL_EDIT);
		//$this->template['title'] = __("Topic list", "forum");
		$this->template['title'] = "Topic list";
		$params = array(
			'order_by' => 'title'
		);
		//$this->template['rows'] = $this->topic->get_list($params);
		//$this->layout->load($this->template, 'admin/topic/list');
		$this->layout->setData('rows',$this->topic->get_list($params));
		$this->layout->view('admin/topic/list');

	}
	function topic($action = null, $start = 0, $confirm = 0){
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		switch ($action)
		{
			case "add":
			case "create":
				$tid = $start;
				//$this->user->check_level('forum', LEVEL_ADD);

				$this->layout->setData('title',"Create a new topic");
				$this->layout->setData('topic',$this->topic->fields['forum_topics']);
				if($tid !== 0)
				{
					//$this->user->check_level('forum', LEVEL_EDIT);
					$this->layout->setData('topic', $this->topic->get_topic($tid));
				}
				$this->layout->view('admin/topic/create');
				//$this->layout->load($this->template, 'admin/topic/create');
				
				
				
			break;
			case "save":
				$data = array();
				$data['category'] = $this->input->post('category');
				if($tid = $this->input->post('tid'))
				{
					$topic = $this->topic->get_topic($tid);
					if($topic['username'] != $this->user->username)
					{
						//$this->user->check_level('forum', LEVEL_EDIT);
					}
					$data['tid'] = $topic['tid'];
				}

				foreach($this->topic->fields['forum_topics'] as $key => $val)
				{
					if($this->input->post($key) !== FALSE)
					{
						$data[$key] = $this->input->post($key);
					}
				}

				if($data['tid'])
				{
					$this->topic->update_topic($data['tid'], $data);
				}
				else
				{
					$data['date'] = time();
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$um    = $fUser[0];
					
					$data['username'] = $un;
					$data['email'] = $um;

					$data['tid'] = uniqid('t');
					$this->topic->save($data);
				}
				
					//---Add New Message to Topic
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$um    = $fUser[0];
					$dataM['mid'] 			= uniqid('m');
					$dataM['username'] 		= 'admin';
					$dataM['email'] 		= 'admin@admin.com';
					$dataM['last_date'] 	= time();
					$dataM['last_username'] = $un;
					$dataM['last_mid'] 		= $dataM['mid'];
					$dataM['notify'] 		= $this->input->post('notify');
					$dataM['title'] 		= $this->input->post('title');
					$dataM['tid'] 			= $data['tid'];
					$dataM['message'] 		= $this->input->post('description');

					$this->message->save($dataM);
					$this->topic->update_topic($dataM['tid'], array('last_mid' => $this->db->escape($dataM['last_mid']), 'last_username' => $this->db->escape($un), 'last_date' => $dataM['last_date'], 'messages' => '1'), false);
	
					//---Add New Message to Topic
				
				
				
				
				
				
				
				
				
				
				/*
				if($admins = $this->input->post('admins'))
				{
					$this->db->where('tid', $data['tid']);
					$this->db->delete('forum_admins');
					$this->db->query("INSERT INTO " . $this->db->dbprefix('forum_admins') . " (`username`, `tid`) VALUES ('" . join("', '" . $data['tid'] . "'), ('", $admins) . "', '" . $data['tid'] . "')");
					
				}
				*/
				$this->session->set_flashdata("notification","Topic saved succesfully");
				redirect('admin/topics');
				break;
			case "delete":
				$this->layout->setData('title',"Delete topic");
				$tid = $start;
				if($tid === 0)
				{
					$this->layout->setData('message',"lease specify a topic");
					$this->layout->view('forum/error');
					return;
				}
				//$this->user->check_level('forum', LEVEL_DEL);

				$topic = $this->topic->get_topic($tid);
				
				
				if ($topic['messages'] > 0)
				{
					//$this->layout->setData('message', "The topic is not empty. Delete all messages in it then try again.");
					//$this->layout->view("forum/error");
					//return;
				}

				if($confirm > 0)
				{
					$this->topic->delete_topic($tid);
					$this->session->set_flashdata('notification', "Topic deleted successfully");
					redirect('admin/topics');
					return;

				}
				else
				{
					$this->layout->setData('topic',$topic);
					$this->layout->view('admin/topic/delete');
					//$this->template['topic'] = $topic;
					//$this->layout->load($this->template, "admin/topic/delete");
					return;
				}
			break;
			case "edit":
				$tid = $start;
				$this->layout->setData('title',"Modify a topic");
				if($tid === 0)
				{
					$this->layout->setData('message',"Please specify a topic");
					$this->layout->view('forum/error');
					return;
				}
				//$this->user->check_level('forum', LEVEL_EDIT);
				if($topic = $this->topic->get_topic($tid))
				{
					$this->layout->setData('topic',$topic);
					$this->layout->view('admin/topic/create');
					//$this->template['topic'] = $topic;
					//$this->layout->load($this->template, "admin/topic/create");
				}
				else
				{
					$this->layout->setData('message',"Topic not found");
					$this->layout->view('forum/error');
					return;

				}
			break;

			default:
				$tid = $action;
				if (is_null($tid) || $tid === 0)
				{
					redirect ('admin/forum/topics');
					return true;
				}


				$per_page = 20;
				$params = array(
				'where' => "tid = '" . $tid . "' ",
				'order_by' => 'title'
				);

				if ($topic = $this->topic->get($params))
				{
					$this->template['topic'] = $topic;
					$this->layout->setData('topic',$topic);
				}
				else
				{
				$this->layout->setData('title',"Error");
				$this->layout->setData('message',"The topic does not exist.");
				$this->layout->view('forum/error');
					
				}

				//now get messages
				$params = array(
				'where' => "tid = " . $this->db->escape($topic['tid']) . " AND pid = '' ",
				'order_by' => 'id desc',
				'limit' => $per_page,
				'start' => $start
				);
				if($messages = $this->message->get_list($params)){
					$this->load->library('pagination');
					$config['uri_segment'] = 5;
					$config['first_link'] = __('First', 'forum');
					$config['last_link'] = __('Last', 'forum');
					$config['base_url'] = base_url() . 'admin/forum/topic/' . $tid ;
					$config['total_rows'] = $this->message->get_total($params);
					$config['per_page'] = $per_page;
					$this->pagination->initialize($config);
					$this->layout->setData('messages',$messages);
					$this->layout->setData('title',$topic['title']);
					$this->layout->setData('start',$start);
					$this->layout->setData('pager',$this->pagination->create_links());
					$this->layout->view('admin/topic/index');

				}
				else
				{
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message available in this topic". "<br />" . anchor('forum/message/new/' . $tid, "Add a new message"));
					$this->layout->view('forum/error');
				}

			break;
		}

	}
	public function chkULogin(){
		if($this->session->userdata('username') == ""){
			return array('admin@mail.com','admin');
		}else{
			return array($this->session->userdata('username'),$this->session->userdata('welcomeuser'), $this->session->userdata('uid'));
		}
	}
	function message($action = 'list', $start = 0, $confirm = 0){
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		switch($action){
			case "edit":
				$mid = $start;
				if($mid == 0){		
					$this->layout->setData('title',"Error");
					$this->layout->setData('message',"You did not choose a message");
					$this->layout->view('forum/error');				
					return;
				}
				$params = array(
					'where' => "mid = '" . $mid . "'"
				);
				$message = $this->message->get($params);
				$params = array(
					'where' => "tid = '" . $message[$tid] . "'"
				);
				$topic = $this->topic->get($params);
				$this->layout->setData('topic',$topic);
				$this->layout->setData('message',$message);
				$this->layout->view('forum/message_create');
				return;
			break;
			case "save":
				$this->user->require_login();
				$title = strip_tags($this->input->post('title'));
				$message = strip_tags($this->input->post('message'));
				$tid = $this->input->post('tid');
				if(trim($message) == '' ){
					$this->layout->setData('title',"Message required found");
					$this->layout->setData('message',"You forgot to write the message");
					$this->layout->view('forum/error');
					return;
				}
				if($title === false){
					$title = substr($message, 0, 50) . "...";
				}

				$data = array(
					'tid' => $tid,
					'pid' => $this->input->post('pid'),
					'date' => mktime(),
					'title' => $title,
					'message' => $message
				);
				if($this->input->post('mid')){
					$data['mid'] = $this->input->post('mid');
					$this->message->update_message($data['mid'], $data);
				}else{
					$data['mid'] 				= uniqid('m');
					$data['last_date'] 			= $data['date'];
					$data['last_username'] 		= $this->user->username;
					$data['last_mid'] 			= ($data['pid'])? $data['pid'] . '#' . $data['mid']: $data['mid'];

					$this->message->save($data);
					$this->topic->update_topic($tid, array('last_mid' => $this->db->escape($data['last_mid']), 'last_username' => $this->db->escape($this->user->username), 'last_date' => $data['date'], 'messages' => 'messages+1'), false);
					if($data['pid']){
						$this->message->update_message($data['pid'],  array('last_mid' => $this->db->escape($data['last_mid']), 'last_username' => $this->db->escape($this->user->username), 'last_date' => $data['date'], 'replies' => ' replies + 1'), false);
					}
				}
				redirect('admin/forum/topic/' . $tid);
			break;
			case "delete":
				//$this->user->check_level('forum', LEVEL_DEL);
				$mid = $start;
				if($mid == 0){
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message to delete");
					$this->layout->view('forum/error');
					return;
				}
				if ( $confirm > 0 ){
					$this->message->delete(array('mid' => $mid));
					$this->session->set_flashdata('notification','The message  has been deleted.');
					redirect('admin/forum/topic/' . $message['tid'], 'refresh');
					return;
				}else{
					$this->layout->setData('title',"Delete message?");
					$this->layout->setData('children',false);
					if($message['pid'] == ''){
						$this->layout->setData('children',$this->message->get_list(array('where' => array('pid' => $message['mid']))));
					}
					$this->layout->view('admin/message/delete');
				}
			break;
			
			case "search":
				if($start != 0){
					$tosearch = $start;
				}elseif ($this->input->post('tosearch')){
					$tosearch = $this->input->post('tosearch');
				}else{
					$this->layout->setData('title',"Error");
					$this->layout->setData('message',"Nothing to search");
					$this->layout->view('forum/error');
					return;
				}
				$searchfield = array('title', 'message', 'author');
				if($infield = $this->input->post('infield')){
					if(in_array($infield, $searchfield)){
						if($this->input->post('exactsearch') == 'on'){
							$params['where'] = $infield . " = '" . $this->input->post('tosearch') . "'";
						}else{
							$params['where'] = $infield . " LIKE '%" . $this->input->post('tosearch') . "%'";
						}
					}else{
						$this->layout->setData('title',"Error");
						$this->layout->setData('message',"No valid field");
						$this->layout->view('forum/error');
						return;
					}
				}else{
					if($this->input->post('exactsearch') == 'on'){
						$params['where']["title"] = $tosearch ;
						$params['or_where']["message"] = $tosearch ;
						$params['or_where']["author"]= $tosearch ;
					}else{
						$params['where'] = "title LIKE   '%" . $tosearch . "%' OR message LIKE   '%" . $tosearch . "%' OR author LIKE   '%" . $tosearch . "%'";
					}
				}
				$search_id = $this->message->save_params(serialize($params));
				$this->results($search_id);
				return;
			break;
			
			case "list":
			default:
				if (is_null($mid)){
					redirect ('admin/topics');
					return true;
				}
			break;
		}
	}
	// message search
	function results($search_id = 0, $start = 0){
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		$params = array();
		if ($search_id != 0 && $tmp = $this->message->get_params($search_id)){
			$params = unserialize( $tmp);
		}
		$per_page = 20;
		$params['start'] = $start;
		$params['limit'] = $per_page;
		$this->layout->setData('rows',$this->message->get_list($params));
		$this->layout->setData('title',"Search result");
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['total_rows'] = $this->message->get_total($params);
		$config['per_page'] = $per_page;
		$config['base_url'] = base_url() . 'admin/forum/results/' . $search_id;
		$config['uri_segment'] = 5;
		$config['num_links'] = 20;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->layout->setData('pager',$this->pagination->create_links());
		$this->layout->setData('start',$start);
		$this->layout->setData('total',$config['total_rows']);
		$this->layout->setData('per_page',$config['per_page']);
		$this->layout->setData('total_rows',$config['total_rows']);
		$this->layout->view('admin/results');
	}
	function search(){
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		$this->title = "Search messages";
		$this->layout->view('search');
		return;
	}
	//--Update user's activity status
	public function userpdatectivitytatus(){
		$status = $this->input->post('status');
		$query = $this->db->query("UPDATE `tech_support`  SET status='".$status."' WHERE id='1'");
	}
	public function user_export(){
		$this->load->model(array('class_model'));
		$result = array();
		$usersId = $this->input->post('users');
		/*if($usersId == '' ){
			$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid ";
		}else{
			$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid and u.id IN ({$usersId}) ";
		}*/
		
		if($usersId == '' ){
			//$sql = "select distinct user.id,user.roleId,user.email,user.add_time,class.startTime,class.sid,class.tid, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  LEFT JOIN class on (class.sid=user.id || class.tid=user.id) where user.id = profile.uid     group BY user.id DESC,class.startTime DESC";
			//$sql = "select distinct user.id,user.roleId,user.email,user.add_time,max(class.startTime)as mxtime,class.sid,class.tid, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  LEFT JOIN class on (class.sid=user.id || class.tid=user.id) where user.id = profile.uid and user.isconfirmedAccount=1 group BY user.id DESC";
			$sql = "select distinct user.id,user.roleId,user.email,user.add_time, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid where user.id = profile.uid and user.isconfirmedAccount=1 group BY user.id DESC";
		}else{
			
			//$sql = "select distinct user.id,user.roleId,user.email,user.add_time,class.startTime,class.sid,class.tid, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  LEFT JOIN class on (class.sid=user.id || class.tid=user.id) where user.id = profile.uid    and user.id IN ({$usersId})  group BY user.id DESC,class.startTime DESC";
			//$sql = "select distinct user.id,user.roleId,user.email,user.add_time,max(class.startTime)as mxtime,class.sid,class.tid, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  LEFT JOIN class on (class.sid=user.id || class.tid=user.id) where user.id = profile.uid and user.isconfirmedAccount=1 and user.id IN ({$usersId}) group BY user.id DESC";
			$sql = "select distinct user.id,user.roleId,user.email,user.add_time,CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  where user.id = profile.uid and user.isconfirmedAccount=1 and user.id IN ({$usersId}) group BY user.id DESC";
		}
		$nowTime = date('Y-m-d H:i:s');
		//$sql = "select distinct user.id,user.roleId,user.email,user.add_time,max(class.startTime)as mxtime,class.sid,class.tid, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  LEFT JOIN class on (class.sid=user.id || class.tid=user.id) where user.id = profile.uid and user.isconfirmedAccount=1 group BY user.id DESC";
		//$sql = "select distinct user.id,user.roleId,user.email,user.add_time, CONCAT(profile.firstName, ' ',profile.lastName) as usernm , profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid  where user.id = profile.uid and user.isconfirmedAccount=1 group BY user.id DESC";
		$sql = "select distinct user.id,user.roleId,user.email,user.add_time,user.user_firsttime, user.quarantine, user.disputes, profile.firstName, profile.lastName, countries.country, profile.gender, profile.age, profile.lms_complete from user LEFT JOIN profile ON user.id=profile.uid LEFT JOIN countries ON countries.id=profile.country where user.id = profile.uid and user.isconfirmedAccount=1 group BY user.id DESC";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		//echo "<pre>"; print_r($result);die;
		$file = 'users.xls';
		$data ="";
		$data .="UID \t First Name \t Last Name \t Email \t Country \t Sex \t Age \t First Time User \t Quarantine \t Dispute \t Role \t Qualified \t Creation Date \r\n";
		 
		foreach($result as $rs)
		{
			$role = $rs['roleId'];
			if($role == 0){$role = 'Student';}
			elseif($role == 1){$role = 'Bronze Talkist';}
			elseif($role == 2){$role = 'Silver Talkist';}
			elseif($role == 3){$role = 'Gold Talkist';}
			elseif($role == 4){$role = 'School';}
			elseif($role == 5){$role = 'Affiliate';}
			elseif($role == 1001){$role = 'Database manager';}
			else{$role = 'Admin';}

			$gender = $rs['gender'];
			if($gender == 0){$gender = 'Female';}
			elseif($gender == 1){$gender = 'Male';}

			$qualified = $rs['lms_complete'];
			if($qualified == 1){$qualified = 'Yes';}
			else{$qualified = 'No';}
			
			if($rs['quarantine'] == 1){
				$rs['quarantine'] = 'Yes';
			}else{
				$rs['quarantine'] = 'No';
			}

			if($rs['user_firsttime'] == 'y'){
				$rs['user_firsttime'] = 'Yes';
			}else{
				$rs['user_firsttime'] = 'No';
			}

			/*$completedClass = $this->class_model->completedSession($rs['id']);
			$lastsessionquery = "SELECT startTime from class where (tid = ".$rs['id']." OR sid = ".$rs['id'].") AND s_attend = 1 order BY id DESC";
			$lsquery = $this->db->query($lastsessionquery);
			$result = $lsquery->row_array();
			$lastcompletedSessionDate = $result['startTime'];*/

			$data .= $rs['id']." \t ".$rs['firstName']." \t ".$rs['lastName']." \t ".$rs['email']." \t ".$rs['country']." \t ".$gender." \t ".$rs['age']." \t ".$rs['user_firsttime']." \t ".$rs['quarantine']." \t ".$rs['disputes']." \t ".$role." \t ".$qualified." \t ".$rs['add_time'];
			$data .="\r\n";	
		}
		$audience = $data;
		$records = count($audience);
		$exporter_output = $audience;
		$content_type = 'text/x-csv';
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($audience));
		header('Content-Type: '.$content_type);
		header('Content-Disposition: attachment; filename=' . $file);
		header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Pragma: no-cache");
		echo $data;exit;
		
	}
	public function referralpayment(){
		$this->load->model(array('pay_model','profile_model'));
		//$paymentsAll = $this->pay_model->getAll();
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$start = $this->input->_request('start');
		if(!$start){
			$start = 1;
		}
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'createAt';
		}
		
		$search = '';
		if($this->input->post())
		{
			$search = $this->input->post('search');
			$this->session->set_userdata(array('searchdisputes'=>$search));
		}elseif($this->session->userdata('searchdisputes'))
		{
			$search = $this->session->userdata('searchdisputes');
		}
		
		$total_pages = $this->pay_model->getTotalreferral($search);
		/*if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			
		}*/
		$limit = 20;
		$targetpage = base_url()."admin/referralpayment/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		/*$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;	*/							
		
		//$reviews = $this->review_model->getAll($start,$limit);
		$paymentsAll = $this->pay_model->getAllreferral($start,$search,$limit,$sortorder,$sort);
		/* echo "<pre>";
		 print_r($paymentsAll);
		 die();*/
		if($paymentsAll=='')
		{
			$start = 0;
			$paymentsAll = $this->pay_model->getAllreferral($start,$search,$limit,$sortorder,$sort);
		}
		
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		if($paymentsAll)
		{
			$payments = array();
			$i = 0;
			foreach ($paymentsAll as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['tutorhRate'] = @$user1['hRate'];
				//print_r($user1);exit;
				
				$affiliate = $this->profile_model->getProfile(@$payf['refid']);
				$payments[$i]['affiliate'] = @$affiliate['firstName'].' '.@$affiliate['lastName'];
				
				$affiliate_p_t = $this->profile_model->getProfile(@$payf['refid']);
				$payments[$i]['payment_type'] = @$affiliate_p_t['payment_type'];
				
				 $payments[$i]['ref'] = @$payf['refid'];
				 $payments[$i]['type'] = @$payf['type'];
				$payments[$i]['amount'] = @$payf['amount'];
				$payments[$i]['money'] = @$payf['fee'];
				$payments[$i]['status'] = @$payf['paymentstatus'];
				$payments[$i]['creatAt'] = @$payf['createAt'];
				$payments[$i]['approve'] = @$payf['approve'];
				$payments[$i]['postpone'] = @$payf['postpone'];
				$payments[$i]['paid'] = @$payf['paid'];
				$payments[$i]['paid_date'] = @$payf['paid_date'];
				
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['type'] = @$payf['type'];
				$payments[$i]['PaidAmount'] = @$payf['PaidAmount'];
				
				$payments[$i]['paid_date'] = @$payf['paid_date'];
				
				$i++;
			}

		}
		
		/*echo "<pre>";
		print_r($payments);
		die();*/
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('start',$start);
		$this->layout->setData('search',$search);
		$this->layout->setData('payments',$payments);
		$this->layout->view('admin/referralpayment');
	}
	
	public function manageschool(){
		$this->load->model(array('pay_model','profile_model'));
		//$paymentsAll = $this->pay_model->getAll();
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'add_time';
		}
		
		$search = '';
		if($this->input->post())
		{
			$search = $this->input->post('search');
			$this->session->set_userdata(array('searchdisputes'=>$search));
		}elseif($this->session->userdata('searchdisputes'))
		{
			$search = $this->session->userdata('searchdisputes');
		}
		
		//$total_pages = $this->pay_model->getTotalreferral($search);
		$total_pages = $this->profile_model->getTotalschool($search);
		// print_r($total_pages);die();
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		
		$targetpage = base_url()."admin/manageschool/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		//$reviews = $this->review_model->getAll($start,$limit);getAllschool
		//$paymentsAll = $this->pay_model->getAllreferral($start,$search,$limit,$sortorder,$sort);
		$schoolAll = $this->profile_model->getAllschool($start,$search,$limit,$sortorder,$sort); 
		//print_r($paymentsAll);die();
		if($schoolAll=='')
		{
			$start = 0;
			//$paymentsAll = $this->pay_model->getAllreferral($start,$search,$limit,$sortorder,$sort);
			$schoolAll = $this->profile_model->getAllschool($start,$search,$limit,$sortorder,$sort); 
		}
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		//  print_r($schoolAll);die();
		if($schoolAll)
		{
			$schools = array();
			$i = 0;
			foreach ($schoolAll as $school)
			{
				//$user = $this->profile_model->getProfile(@$payf['sid']);
				//$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				$schools[$i]['id'] = @$school['uid'];
				$schools[$i]['firstName'] = @$school['firstName'];
				$schools[$i]['email'] = @$school['email'];
				@$tutor= $this->profile_model->gettutor(@$school['uid']);
				$schools[$i]['total'] = @$tutor[0]['total'];
			 
				$i++;
			}
		}
		
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		
		$this->layout->setData('search',$search);
		$this->layout->setData('schools',$schools);
		$this->layout->view('admin/manageschool');
	}
	
	public function school_add(){
		$user = array();
		$errormsg = '';
		if($this->input->post()){
			$this->load->model(array('user_model'));
			$userModel =  $this->user_model;
			$formData = $this->input->post();
			$formData['firstName'] = $formData['username']; 
			$formData['username'] = $formData['email'];
			$formData['add_time'] = $date = date('Y-m-d H:i:s');
			$acc = $this->input->post('hiddenRole');
			if($acc == 1){
			}else{
				$formData['hiddenRole'] = 0;
			}
			$quarantine = $this->input->post('quarantine');
			if($quarantine == 1){
			}else{
				$formData['quarantine'] = 0;
			}
			 
			 
				$errorMsg = $this->user_model->checkEmail($formData['email']);
				if($errorMsg['success']) {
					$errorMsg = $this->user_model->checkPassword($formData['password']);
				}
				
				$errorMsg = $this->user_model->checkschoolid($formData['UniqueId']);
				if($errorMsg['success']) {
					$errorMsg = $this->user_model->checkPassword($formData['password']);
				}

			if($errorMsg['success'] == false){
				$errormsg = $errorMsg['message'];
				$user = $formData;
			}else {
				unset($formData['cppassword']);
				$formData['password'] = md5($formData['password']);
				$formData['roleid'] = 4;
				$uid = $userModel->school_add($formData);
				$errormsg = 'Add sccuess.';
			}
		}
		$types = array('0'=>'Student','1'=>'Bronze Tutor','2'=>'Silver Tutor','3'=>'Gold Tutor','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		$chat = array('1'=>'Yes','0'=>'No');
		$this->layout->setData('types',$types);
		$this->layout->setData('chat',$chat);
		$this->layout->setData('user',$user);
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/school_add');
	}
	public function genpdf()
	{
		$this->load->model(array('user_model','profile_model','langs_model'));
		$rid = $this->input->_request('id');
		 
		$ref_fn =$this->profile_model->getProfile($rid);
		$refname = $ref_fn['firstName'];
		$dat = date('Y-m-d');
		$m = date_parse_from_format("Y-m-d", $dat);
		$month=$m["month"];
		$sql = "SELECT `firstName`,a.amount as amount,a.createAt as date,user.roleid FROM `profile`,user, affiliate as a WHERE profile.uid=a.sid and user.id=a.sid and paid=0 and a.refid={$rid}";
		$query = $this->db->query($sql);
		$result = $query->result_array();
	 
		 $sqlsum = "SELECT sum(a.amount) as due FROM   affiliate as a WHERE   a.refid={$rid} and paid=0  GROUP BY a.refid ";
		 $querysum = $this->db->query($sqlsum);
		 $resultsum = $querysum->result_array();
	 
		$this->load->library('mpdf/mpdf');                
        $mpdf=new mPDF();
		$img = base_url('images/affiliate.png');
			$demo =  "<table width = '100%' border = '10'  >";
			$demo .= "<tr><td colspan='5'><img src='".$img."'></td></tr>";
			$demo .="<tr><td>Affiliate Name:</td><td>$refname</td> ";  
			$demo .="</tr> "; 
			$demo .="<tr bgcolor='#3399CC' color='white' cellspacing='0' cell-padding='0'><td   color='white' cellspacing='0' cell-padding='0' width='130px' align='center'><b>Name</b></td><td   color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>Amount</b></td> <td  color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>Date</b></td> <td   color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>User Type</b></td> ";  
			$demo .="</tr> ";

				foreach($result as $res)
				{
				if($res['roleid']==0)
				{$type='Student';}else
				{$type='Teacher';}
				$d = date_parse_from_format("Y-m-d", $res['date']);
				$date =  $d['year'].'-'.$d['month'].'-'.$d['day'] ; 
				$demo .="<tr><td align='center'>".$res['firstName']."</td><td align='center'>"."$".number_format($res['amount'],2,'.','')."</td> <td align='center'>".$date."</td> <td align='center'>".$type."</td> ";  
				$demo .="</tr> ";
				}

				$demo .="</tr> "; 
				
				$demo .="<tr><td colspan='5'><hr color='#d7bc4d'></td></tr>";
				$demo .="<tr><td></td><td></td><td></td><td>Total Due   : "."$".number_format($resultsum[0]['due'],2,'.','')."</td></tr>";
				$demo .="</table> ";
				//$demo .="<p style='float:left;'>Total Due   :". "     ".$resultsum[0]['due']."</p>";  

			$mpdf->WriteHTML($demo); 
	
			$mpdf->Output();
	}

	public function affiliate_payment()
	{
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model(array('pay_model','profile_model'));

		$dat = date('Y-m-d');
		$m = date_parse_from_format("Y-m-d", $dat);
		$month=$m["month"];

		$rid = $this->input->_request('id');
   
		 
		$sqlsum = "SELECT  a.refid, a.amount as due FROM affiliate as a WHERE   a.id={$rid[0]} and paid=0";
		$querysum = $this->db->query($sqlsum);
		$resultsum = $querysum->result_array();
		//echo   $resultsum[0]['due'];
		/*echo "<pre>";
		print_r($resultsum);
		die();*/
		
		$res = $this->profile_model->getProfile($resultsum[0]['refid']);
		//echo $res['payment_account'];
		//echo $res['payment_type'];die;
		/*echo "<pre>";
		print_r($res);die();*/
		if($res['payment_type']=="credits")
		{		
			$dates = date('Y-m-d');
			$feeSql = "update profile set money=money+{$resultsum[0]['due']}   where uid={$resultsum[0]['refid']}";
			$query 	= $this->db->query($feeSql);
			$updateSql = "update affiliate set paid=1 ,PaidAmount={$resultsum[0]['due']},paid_date ='{$dates}' where id={$rid[0]}";
			$query 	= $this->db->query($updateSql);
			echo json_encode(array('status'=>true));
		}

		if($res['payment_type']=="paypal")
		{
		 
		
		 //////techno viplove payment code start///////
				$logger = new PPLoggingManager('MassPay');
				$massPayRequest = new MassPayRequestType();
				$massPayRequest->MassPayItem = array();
				 
					$masspayItem = new MassPayRequestItemType();	
					$masspayItem->Amount = new BasicAmountType('USD',  $resultsum[0]['due']);
					$masspayItem->ReceiverEmail = $res['payment_account'];
					//echo  $res['payment_account'];
					//die();
					$massPayRequest->MassPayItem[] = $masspayItem;
				 
				$massPayReq = new MassPayReq();
				$massPayReq->MassPayRequest = $massPayRequest;
				$paypalService = new PayPalAPIInterfaceServiceService();
				try {
					$massPayResponse = $paypalService->MassPay($massPayReq);
				} catch (Exception $ex) {
					include_once("../Error.php");
					exit;
				}
				  
				if(isset($massPayResponse)) {
					 
					 if($massPayResponse->Ack == 'Success'){
					  $dates1 = date('Y-m-d');
					 $updateSql = "update affiliate set paid=1,PaidAmount={$resultsum[0]['due']},paid_date ='{$dates1}'  where id={$rid[0]}";
	                 $query 	= $this->db->query($updateSql);
						 echo json_encode(array('status'=>true));
					 }
				}
		 //////////payment code end/////////
		 }
	}
	
	//added by haren for school advertise
	public function school_advertise(){
	
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
            $cdate = date('Y-m-d');
             //echo $cdate;
			$this->load->model(array('ad_model'));
			$data = $this->input->post();
			if($this->input->post()){
			$user=$this->session->userdata['roleId'];
	
				if(isset($_FILES) && $_FILES['image']!='')
				{
					$this->load->library('media','upload');
					$upConfig['upload_path'] = FCPATH.'uploads/images/';
					$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
					$upConfig['encrypt_name'] = true;
					$translateConfig['image_library'] = 'gd2';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['new_image'] = FCPATH.'uploads/images/ad/';
					 $translateConfig['width'] = 245;
					$translateConfig['height'] = 206;
					$this->media->upload($upConfig,'image')->resize($translateConfig);
					if(!$this->media->error){
						$data['source'] = $this->media->sqlAddress;
						unset($data['image']);
						$succrmsg = 'Add successfully.';
						$this->layout->setData('succrmsg',$succrmsg);
					}else {
						//$errormsg = $this->media->error['error'];
					}
				}else{
					//$errormsg = 'Image can`t be empty.';
				}
			}
			
			$this->ad_model->ad_school_advertise($data);
			$succrmsg = 'Add successfully.';
			$this->layout->setData('succrmsg',$succrmsg);
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/school_advertise');
	}

	public function schoolAdd() {
	// echo "hi";die();
		$this->load->model(array('ad_model'));
		$data = $this->ad_model->SchoolAdd();
		$this->layout->setData('adddata',$data);
		$this->layout->view('admin/schoolAddList');
	}
	
		public function schoolAdd_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('ad_model'));
		$this->ad_model->schoolAddDel($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	
	public function s_summary(){
		$this->load->model(array('user_model','class_model','profile_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'uid';
		}
		if(!$start){
			$start = 1;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		$school = array();
		$school=$this->user_model->getSchoolSummary($sort,$sortorder);
       $payments=array();
		if($school)
		{
			$payments = array();
			$i = 0;
			foreach ($school as $payf)
			{
				$user = $this->profile_model->GetTuorcount(@$payf['uid']);
				$payments[$i]['schoolname'] = @$payf['firstName'].' '.@$payf['lastName'];
				$payments[$i]['id'] = @$payf['uid'];
				$payments[$i]['principle_name'] = @$payf['principle_name'];
				$payments[$i]['email'] = @$payf['email'];
				$payments[$i]['add_time'] = @$payf['add_time'];
				$payments[$i]['pbalance'] = @$payf['pbalance'];
				$payments[$i]['tutors'] = @$user['tut'];
				$user1 = $this->profile_model->Getstudentcount(@$payf['uid']);
				$payments[$i]['students'] = @$user1['stud'];
				$user2 = $this->profile_model->Getsessioncount(@$payf['uid']);
				$payments[$i]['tsession'] = @$user2['session'];
				$tmarkup=$this->profile_model->GetMarkup(@$payf['uid']);
				$payments[$i]['earning'] = @$user2['actualfee'];
				$Affiincome = $this->profile_model->GetSchoolAffiliateIncome(@$payf['uid']);
				if($Affiincome['samt'] !='')
				{
					$payments[$i]['refamount'] =$Affiincome['samt'];
				}
				else
				{
					$payments[$i]['refamount'] = '0';
				}
				$i++;
			}
		}
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/s_summary/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->getCountBySearch($search);
		}else{
			$config['total_rows'] = $this->user_model->getCount();
		}
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('users',$payments);
		$this->layout->view('admin/s_summary');
	}
	public function sch_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->delSchool($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	
	public function get_school_note(){
		$this->load->model(array('user_model','profile_model'));
		$id = $this->input->_request('id');
		
		if($id<0){
			$id = 1;
		}
		if($this->input->post()){
			$data 	= $this->input->post();
			
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
						//$noteRole = $this->session->userdata['adminUsername'];
						$data['role'] = $noteRole;
						$data['school_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->school_addnote($data);
						$errormsg = 'Note has been added successfully.';
					}
				
			
		}

		//$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		
		 $usernotes = $this->user_model->GetAllSchoolNotes($start,$sort,$sortorder);
		
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/school_note/start');
		$config['uri_segment'] = 5;		
		if($search != ''){
			//$config['total_rows'] = $this->user_model->getNoteCountBySearch($start,$id,$sort,$sortorder);
			$config['total_rows'] = $this->user_model->getNoteCount();
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('id',$id);
		//$note_data = $this->user_model->getUserNote($id);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/school_note');
	
	}
	
	public function get_payment_note(){
		$this->load->model(array('user_model','profile_model'));
		$id = $this->input->_request('id');
		
		if($id<0){
			$id = 1;
		}
		if($this->input->post()){
			$data 	= $this->input->post();
			
				if(strlen($data['note']) > 200){
					$errormsg = 'Note must be less than 200 characters.';
				
				}else{
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
						//$noteRole = $this->session->userdata['adminUsername'];
						$data['role'] = $noteRole;
						$data['school_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->school_addnote($data);
						$errormsg = 'Note has been added successfully.';
					}
				}
			
		}

		//$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		if($search != ''){
			$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);			
			if(count($usernotes)<=0){
				$start = 0;
				$usernotes = $this->user_model->getAllUserNotesBySearch($start,$search,$sort,$sortorder);
			}
		}else{
			$usernotes = $this->user_model->getAllUserNotes($start,$sort,$sortorder);
		}
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/get_payment_note/start');
		$config['uri_segment'] = 5;		
		if($search != ''){
			//$config['total_rows'] = $this->user_model->getNoteCountBySearch($start,$id,$sort,$sortorder);
			$config['total_rows'] = $this->user_model->getNoteCount();
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('id',$id);
		//$note_data = $this->user_model->getUserNote($id);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/payment_note');
	
	}
	
	
	
	
	public function get_Affinote(){
		$this->load->model(array('user_model','profile_model'));
		$id = $this->input->_request('id');
		
		if($id<0){
			$id = 1;
		}
		if($this->input->post()){
			$data 	= $this->input->post();
			
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
					
						$data['role'] = $noteRole;
						$data['school_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->Affi_addnote($data);
						$errormsg = 'Note has been added successfully.';
					}
				
			
		}

		
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		
		
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		
	   $usernotes = $this->user_model->GetAffinote();
		
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/get_payment_note/start');
		$config['uri_segment'] = 5;		
		if($search != ''){
			//$config['total_rows'] = $this->user_model->getNoteCountBySearch($start,$id,$sort,$sortorder);
			$config['total_rows'] = $this->user_model->getNoteCount();
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('id',$id);
		//$note_data = $this->user_model->getUserNote($id);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/payment_note');
	
	}
	
	
	public function schoolpayment(){
		$this->load->model(array('pay_model','profile_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$sortorder = $this->input->_request('sortorder');
		if(!$start){
			$start = 1;
		}
		if(!$sortorder)
		{
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'id';
		}
		$search = '';
		$dsearch='';
		if($this->input->post())
		{
			$search = $this->input->post('search');
			$dsearch = $this->input->post('dsearch');
			$this->session->set_userdata(array('searchdisputes'=>$search));
		}elseif($this->session->userdata('searchdisputes'))
		{
			$search = $this->session->userdata('searchdisputes');
		}
		$d = date_parse_from_format("Y-m-d",$dsearch);
		$dat=$d["month"];
		$total_pages = $this->pay_model->getTotalDisputes($search);
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		$targetpage = base_url()."admin/schoolpayment/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		if($search !='')
		{
			$paymentsAll = $this->pay_model->GetSchoolForSearch($start,$search,$limit,$sortorder,$sort);
		}
		else
		{
			$paymentsAll = $this->pay_model->getAllschool($start,$dat,$limit,$sortorder,$sort);
		}
		if($paymentsAll=='')
		{
			$start = 0;
			$paymentsAll = $this->pay_model->getAllschool($start,$dat,$limit,$sortorder,$sort);
		}
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		if($paymentsAll)
		{
			$payments = array();
			$i = 0;
			foreach ($paymentsAll as $payf)
			{
				if($search !='')
				{
					$user = $this->profile_model->getProfileSearch(@$payf['School_id'],$search);
					$payments[$i]['schoolname'] = @$user[0]['firstName'].' '.@$user[0]['lastName'];
				}
				else
				{
					$user = $this->profile_model->getProfileData(@$payf['School_id'],$sortorder,$sort);
					$payments[$i]['schoolname'] = @$user['firstName'].' '.@$user['lastName'];	
				}
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['tutorhRate'] = @$user1['hRate'];
				$user2= $this->profile_model->getTutorSession(@$payf['School_id']);
				$payments[$i]['tsession'] = @$user2['tsession'];
				$payments[$i]['ssession'] = @$user2['ssession'];
				$payments[$i]['fees'] = @$user2['fees'];
				$payments[$i]['totalpayments'] = @$user2['TutorIncome'];
				$payDue= $this->profile_model->GetSchoolDuePayment(@$payf['School_id']);
				$payments[$i]['dues'] = @$payDue['Dueamt'] ;
				$payments[$i]['money'] = @$payf['fee'];
				$payments[$i]['status'] = @$payf['p_status'];
				$payments[$i]['creatAt'] = @$payf['createAt'];
				$payments[$i]['approve'] = @$payf['approve'];
				$payments[$i]['postpone'] = @$payf['postpone'];
				$payments[$i]['School_id'] = @$payf['School_id'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['type'] = @$payf['type'];
				$i++;
			}
		}
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('dsearch',$dsearch);
		$this->layout->setData('search',$search);
		$this->layout->setData('payments',$payments);
		$this->layout->setData('start',$start);
		$this->layout->view('admin/schoolpayment');
	}
	
	
	public function a_summary(){
		$this->load->model(array('user_model','class_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'uid';
		}
		if(!$start){
			$start = 1;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		
		$affi = array();
		$payments = array();
		$affi=$this->user_model->affiSummary($search,$sort,$sortorder);
			if($affi)
		{
			$payments = array();
			$i = 0;
			foreach ($affi as $payf)
			{
			
				//$user = $this->profile_model->getProfile(@$payf['School_id']);
				$payments[$i]['affiname'] = $payf['firstName']. $payf['lastName'];
				$payments[$i]['id'] = $payf['id'];
				$payments[$i]['principle_name'] = $payf['principle_name'];
				$payments[$i]['email'] = $payf['email'];
   				$payments[$i]['add_time'] = $payf['add_time'];
				$data=$this->user_model->getAffiAmount($payf['id']);
         //print_r($data). "ff";
				$payments[$i]['sid'] = @$data['stid'];
				$payments[$i]['amount'] = @$data['total'];
				//$payments[$i]['status'] = @$payf['p_status'];
				//$payments[$i]['creatAt'] = @$payf['createAt'];
				//$payments[$i]['approve'] = @$payf['approve'];
				//$payments[$i]['postpone'] = @$payf['postpone'];
				
				$i++;
			}
		}
        /*echo "<pre>";
		print_r($payments);
		die();*/
				
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/a_summary/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->getCountBySearch($search);
		}else{
			$config['total_rows'] = $this->user_model->getCount();
		}
		$config['per_page'] = 20; 
		
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		
		$this->layout->setData('users',$payments);
		//print_r($users);die();
		$this->layout->view('admin/a_summary');
	}
	
	
	public function Affi_payment(){
		$this->load->model(array('pay_model','profile_model','user_model'));
		
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		
		$sortorder = $this->input->_request('sortorder');
		if(!$start){
			$start = 1;
		}
		if(!$sortorder)
		{
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'uid';
		}
		
		$search = '';
		$dsearch ='';
		
		
		
		if($this->input->post())
		{
		
			$search = $this->input->post('search');
			$dsearch = $this->input->post('dsearch');
			
		
			//die();
			$this->session->set_userdata(array('searchdisputes'=>$search));
		}elseif($this->session->userdata('searchdisputes'))
		{
			$search = $this->session->userdata('searchdisputes');
		}
		
		$total_pages = $this->pay_model->getTotalDisputes($search);
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		
		$targetpage = base_url()."admin/Affi_payment/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		if($dsearch != '')
		{
			
			$d = date_parse_from_format("Y-m-d",$dsearch);
			$dat=$d["month"];
			$paymentsAll = $this->pay_model->getAllaffiDate($start,$dat,$limit,$sortorder,$sort);
		}
		else
		{
			$paymentsAll = $this->pay_model->getAllaffi($start,$search,$limit,$sortorder,$sort);
		}
		if($paymentsAll=='')
		{
			$start = 0;
			$paymentsAll = $this->pay_model->getAllaffi($start,$search,$limit,$sortorder,$sort);
		}
		
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		
		if($paymentsAll)
		{
			$payments = array();
			$i = 0;
			foreach ($paymentsAll as $payf)
			{
			
				
				$payments[$i]['affiname'] = $payf['firstName']. $payf['lastName'];
				$payments[$i]['id'] = $payf['id'];
   				
				$data=$this->user_model->getAffiAmount($payf['id']);
         
				$payments[$i]['sid'] = @$data['stid'];
				$payments[$i]['amount'] = @$data['total'] - @$data['pamount'];
				$payments[$i]['paid'] = @$data['paid'];
				
				
				
				$i++;
			}
		}
		
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
				$this->layout->setData('start',$start);
		$this->layout->setData('search',$search);
		$this->layout->setData('dsearch',$dsearch);
		$this->layout->setData('payments',$payments);
		$this->layout->view('admin/Affi_payment');
	}
	public function Memberpay(){
		$this->load->model(array('user_model','class_model'));
		if($this->input->_request('limit')) {
			$limit = $this->input->_request('limit');
		} else {
			$limit = 20;
		}
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;
		
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'asc';
		}
		
		$targetpage = base_url()."admin/Memberpay/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		// Types of Member
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist');		
		$search = '';
		$dsearch	=	date('m/Y');		
		if ($this->input->post('dsearch')) {
			$search = $this->input->post('search'); 
			$dsearch=  $this->input->post('dsearch'); 
			$this->session->set_userdata("searchuser",$search);
			$this->session->set_userdata("dispdsearch",$dsearch);
		} else if($this->session->userdata("dispdsearch")){
			$dsearch = $this->session->userdata("dispdsearch");
			$search = $this->session->userdata("searchuser");
		} 
		
		$users = $this->user_model->fnGetAllMemeber($start,$sort,$sortorder,$limit,$search);	
		$userdata = array();
		if ($users) {
			$i = 0;
			foreach ($users as $userVal) {
				$userdata[$i]['usernm'] = $userVal['firstName']." ". $userVal['lastName'];
				$userdata[$i]['id'] 	= $userVal['uid'];
				$userdata[$i]['curBal'] = $userVal['money'];
				$userdata[$i]['role'] = $types[$userVal['roleId']];
				
				// Opening Balance of Month
				$opBal = $this->user_model->fnGetOpBal($userVal['uid'], $dsearch); // UserId & CurrMonth&Year
				$userdata[$i]['opBal'] =  @$opBal;
				
				// Total Amount addition in Month
				$addBal = $this->user_model->fnGetMonthBal($userVal['uid'],$dsearch,"credit");	
				$userdata[$i]['addBal'] =  $addBal;
				
				// Total Amount deduction in Month
				$subBal = $this->user_model->fnGetMonthBal($userVal['uid'],$dsearch,"debit");
				$userdata[$i]['subBal'] =  $subBal;
				
				// End Balance of Month
				$userdata[$i]['endBal'] =  $userdata[$i]['opBal'] + $userdata[$i]['addBal'] - $userdata[$i]['subBal'];
				
				$i++; // Increment Data index
			}
		}
		
		
		
		// Pagination
		$total_pages = $this->user_model->fnGetTotalMemeber($search);
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('search',$search);
		$this->layout->setData('dsearch',$dsearch);
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('users',$userdata);
		$this->layout->view('admin/memberpaylist');
	}
	public function Memberpay_old(){
		$this->load->model(array('user_model','class_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 1;
		}
		$search = '';
		$dsearch='';
		$substufee=0;
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$dsearch = trim($this->input->post('dsearch'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		if($search != ''){
				$users = $this->user_model->GetAllMemeberSearch($start,$search,$sort,$sortorder);
				if(count($users)<=0){
					$start = 0;
					$users = $this->user_model->GetAllMemeberSearch($start,$search,$sort,$sortorder);
				}
			}
			else{
			
				$users = $this->user_model->GetAllMemeber($start,$sort,$sortorder);
			}
		$userTemp = array();
		$payments = array();
		if($users)
		{
			$payments = array();
			$i = 0;
			foreach ($users as $payf)
			{
				$payments[$i]['usernm'] = $payf['firstName']." ". $payf['lastName'];
				$payments[$i]['id'] = $payf['uid'];
				$payments[$i]['money'] = $payf['money'];
   				if($payf['uid'] == '')
				{
					$payments[$i]['pay']=0;
					$stuadd=0;
					$payments[$i]['earning'] =0 ;
					$payments[$i]['affi'] =0 ;
				}
				else
				{
					if($dsearch == '')
					{
						$dsearch=date('m/Y');
					}

					$data=$this->user_model->getSessionAttendAmount($payf['uid'],$dsearch);
					$payments[$i]['earning'] = @$data['earning'];
					$payments[$i]['endbal'] = @$payf['money'];
					$data1=$this->user_model->getAffiIncome($payf['uid'],$dsearch);
					
					
					
					if($payf['roleId'] == 0)
					{
						$payments[$i]['affi'] = @$data1['total'];
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
						
						//echo $dsearch;
						$substu=$this->user_model->getSubstu($payf['uid'],$dsearch);
						//print_r($substu);die;
						if(count($substu)>0)
						{
						$substufee=$substu[0]['stufee'];
						}
						else
						{
							$substufee=0;
						}	
						 
						$payments[$i]['sub'] =$substufee;
						if ($dsearch == '07/2014'){
							$payments[$i]['sub'] = '0';
						}
						$addstu=$this->user_model->GetaddStu($payf['uid'],$dsearch);
					    $affistu=$this->user_model->GetaddStuaffi($payf['uid'],$dsearch);
						$stuadd=0;
						$stuadd1=0;
						 if(count($addstu) > 0)
						 {
							$stuadd=$addstu[0]['pmoney'];
							if($stuadd == 30.00){
								$stuadd	= 25.00;
							}
						 }
						 if(count($affistu) > 0)
						 {
							$stuadd1=$affistu[0]['amt'];
						 }
						$payments[$i]['addstu'] = $stuadd+$stuadd1;	

						$uid = $payments[$i]['id'];
						$month = $dsearch;
						$dt=explode('/',$month);
						$mon=$dt[0];
						$premon = $dt[0] - 1;
						//$selectsql = "select endbal from memberpay where userid = '{$uid}' AND month = '0{$premon}'";			

						if($mon == 1){
							$selectsql = "Select money from users_end where uid =".$uid." AND month = '12'";
						}else{
							$selectsql = "Select money from users_end where uid =".$uid." AND month = '{$premon}'";
						}
						$selectquery = $this->db->query($selectsql);

						$bigresult = $selectquery->result_array();
						$EndBal = (@$bigresult[0]['endbal']+$payments[$i]['addstu'])-$payments[$i]['sub'];

						$payments[$i]['BigBal'] = @$bigresult[0]['money'];	

						$selectcsql = "select endbal from memberpay where userid = '{$uid}' AND month = '{$mon}'";						
						$selectcquery = $this->db->query($selectcsql);
						if ($selectcquery->num_rows() == 0) {
							$sql = "insert into memberpay SET userid = '{$uid}', month = '{$mon}', endbal = '{$EndBal}'";
							$query11 = $this->db->query($sql);
						}
					}
					else
					{
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
					
						$tutoradd=$this->user_model->GetTutorAdd($payf['uid'],$dsearch);
						$mny=0;
						$hrate=0;
						$stuadd=0;
						$tutorIncome=0;
						if(count($tutoradd)>0)
						{
							$payments[$i]['affi'] =$tutoradd[0]['tuid'];
							$mny=$tutoradd[0]['tuid'];
							$tutorIncome=$tutoradd[0]['tuid'];
						}
						$hrate=$payf['uid'];
						$tutoraffi=0;
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
						$affistu=$this->user_model->GetaddStuaffi($payf['uid'],$dsearch);
						if(count($affistu) > 0)
						 {
							$tutoraffi=$affistu[0]['amt'];
						 }
						$tutoradd=$mny*$hrate; 
						$payments[$i]['affi'] =$tutoradd;
						$payments[$i]['sub'] =0;
								
						//$payments[$i]['addstu'] =(($tutorIncome + $tutoraffi) - $DleAmout);
						$payments[$i]['addstu'] =$tutorIncome + $tutoraffi;
						if ($dsearch == '07/2014'){
							$payments[$i]['addstu'] = '0';
						}
						/*$subtutor=$this->user_model->GetSubTutor($payf['uid'],$dsearch);
						if(count($subtutor)>0)
						{
							$payments[$i]['sub']=$subtutor[0]['paidamt'];
						}
						else
						{
						
						}*/
						$payments[$i]['sub']=0;		
						if ($dsearch == '07/2014'){
							$payments[$i]['sub'] = '0';
						}
						
						$uid = $payments[$i]['id'];
						$month = $dsearch;
						$dt=explode('/',$month);
						$mon=$dt[0];
						$premon = $dt[0] - 1;
						//$selectsql = "select endbal from memberpay where userid = '{$uid}' AND month = '0{$premon}'";						
						
						if($mon == 1){
							$selectsql = "Select money from users_end where uid =".$uid." AND month = '12'";
						}else{
							$selectsql = "Select money from users_end where uid =".$uid." AND month = '{$premon}'";
						}
						$selectquery = $this->db->query($selectsql);
						
						$bigresult = $selectquery->result_array();
						$EndBal = (@$bigresult[0]['endbal']+$payments[$i]['addstu'])-$payments[$i]['sub'];

						
						$payments[$i]['BigBal'] = @$bigresult[0]['money'];
						
						$selectcsql = "select endbal from memberpay where userid = '{$uid}' AND month = '{$mon}'";						
						$selectcquery = $this->db->query($selectcsql);
						if ($selectcquery->num_rows() == 0) {
							$sql = "insert into memberpay SET userid = '{$uid}', month = '{$mon}', endbal = '{$EndBal}'";
							$query11 = $this->db->query($sql);
						}
					}
					 
						$payments[$i]['pay']=0;
				}
					if($dsearch == '07/2014'){
						$beginquery = "Select money from users_end where uid =".$payf['uid'];
						$beginresult = $this->db->query($beginquery);
						$beginpayment = $beginresult->result_array();
						if(count($beginpayment) > 0)
						{
						$payments[$i]['endbal'] = $beginpayment[0]['money'];
						}
						else{$payments[$i]['endbal'] =0;}
					}else{
						$payments[$i]['endbal']= ($payments[$i]['BigBal']+$payments[$i]['addstu'])-$payments[$i]['sub'];
						$payments[$i]['endbal']=number_format($payments[$i]['endbal'],2,'.','');
						if($payments[$i]['endbal'] <0 ){  $payments[$i]['endbal'] = number_format(0,2,'.',''); }else{ $payments[$i]['endbal']; }
					}

					$usersend = "Select money from users_end where uid =".$payf['uid']." AND month = 5";
					$usersendresult = $this->db->query($usersend);
					$usersendpayment = $usersendresult->result_array();
					//print_r($usersendpayment);
					//echo $dsearch;
					if($dsearch == '05/2015'){
					$payments[$i]['endbal'] = $usersendpayment[0]['money'];
					}
					if($dsearch == '06/2015'){
					$payments[$i]['BigBal'] = $usersendpayment[0]['money'];
					}
//exit;
					$payments[$i]['render'] = $payments[$i]['affi']+ $payments[$i]['earning'] +$payments[$i]['pay']+$stuadd ;
					//echo $stuadd;die();
					$payments[$i]['roleId'] =  $payf['roleId'];
					$i++;
			}
		}
        unset($userTemp);
		 
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist');
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/Memberpay/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->GetMemberCountSearch($search);
		}else{
			$config['total_rows'] = $this->user_model->MemberFCount();
		}
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('dsearch',$dsearch);
		$this->layout->setData('page',$page);
		$this->layout->setData('types',$types);
		$this->layout->setData('users',$payments);
		$this->layout->view('admin/memberpaylist');
	}
	 
	public function Member_Edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';$successmsg="";
		$this->load->model(array('user_model','profile_model'));
		if($this->input->post()){
		  
			$data = $this->input->post();
			
			
			
			$newDate = date("Y-m-d", strtotime($data['expDate']));

			$acc = $this->input->post('hiddenRole');
			if($acc == 1){
			}else{
				$data['hiddenRole'] = 0;
			}
			$quarantine = $this->input->post('quarantine');
			if($quarantine == 1){
			}else{
				$data['quarantine'] = 0;
			}
			
			
			if($data['expDate']){
				$this->user_model->updateExpDate($newDate,$id);
			}
			
			
			
			
			$profileData = array();
			$profileData['lms_complete'] = $data['lms_complete'];
			$profileData['uid'] = $id;
			unset($data['lms_complete']);
			
			
			$profileData['money'] = $data['money'];
			unset($data['money']);
			unset($data['cur_bal']);
			unset($data['expDate']);
			

			$this->user_model->user_edit($data,$id);
			$this->profile_model->update($profileData);
			$successmsg = 'Edit User successfully.';
			$data['money'] = $profileData['money'];
			$data['cur_bal']= $profileData['money'];
		}
		$user = $this->user_model->getByUid($id);
		$profile = $this->profile_model->getProfileJoin($id);
		$user = array_merge($user,$profile);

		$currentUserRole	= $this->session->userdata['roleId'];
		if($currentUserRole == 1002){ $this->layout->setData('isAccount',TRUE);}else{ $this->layout->setData('isAccount',FALSE); }
		

		$expDateArray = $this->user_model->getExpDateByUid($id);				
		if($expDateArray[0]['expDate'] != "" ){
			$expDate = $expDateArray[0]['expDate'];
		}else{
			$expDate = '';
		}
		
		$this->layout->setData('user',$user);
		$types = array('0'=>'Student','1'=>'Bronze Talk-ist','2'=>'Silver Talk-ist','3'=>'Gold Talk-ist','4'=>'School','5'=>'Affiliate','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		$chat = array('1'=>'Yes','0'=>'No');
		$this->layout->setData('chat',$chat);
		$this->layout->setData('types',$types);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('successmsg',$successmsg);
		$this->layout->setData('expDate',$expDate);
		$this->load->helper('form');
		$this->layout->view('admin/Member_Edit');
	}
	public function  MemberNote(){
		$this->load->model(array('user_model','profile_model'));
		$id = $this->input->_request('id');
		
		if($id<0){
			$id = 1;
		}
		if($this->input->post()){
			$data 	= $this->input->post();
			
			
			    if(strlen($data['note']) > 200){
					$errormsg = 'Note must be less than 200 characters.';
				
				}else{
				   
					$uRole	= $this->session->userdata['roleId'];
					if($uRole == 1111){$noteRole = 'Admin';
					}elseif($uRole == 1001){$noteRole = 'Database manager';
					}elseif(1002){$noteRole = 'Accountant';
					}else{$noteRole = 'Admin';}
					
					if($errormsg == ""){
						
						$data['role'] = $noteRole;
						$data['user_id'] = $id;
						$data['date'] = date('Y-m-d H:i:s',time());
						$this->user_model->MembersAddNote($data);
						$errormsg = 'Note has been added successfully.';
					}
				}
			
		}

		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		if($search != ''){
			$usernotes = $this->user_model->GetAllMemberNotes($start,$search,$sort,$sortorder);			
			if(count($usernotes)<=0){
				$start = 0;
				$usernotes = $this->user_model->GetAllMemberNotes($start,$search,$sort,$sortorder);
			}
		}else{
			$usernotes = $this->user_model->ListMemberNote($start,$sort,$sortorder);
		}
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/MemberNote/start');
		$config['uri_segment'] = 5;		
		if($search != ''){
			//$config['total_rows'] = $this->user_model->getNoteCountBySearch($start,$id,$sort,$sortorder);
			$config['total_rows'] = $this->user_model->getNoteCount();
		}else{
			$config['total_rows'] = $this->user_model->getNoteCount();
		}
		
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('id',$id);
		//$note_data = $this->user_model->getUserNote($id);
		$this->layout->setData('usernotes',$usernotes);
		$this->layout->view('admin/memberNotelist');
	
	}
	
	public function  affi_pay_approve(){
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model(array('pay_model','profile_model'));

		$rid = $this->input->_request('id');
		$val = $this->input->_request('approveval');
		$res = $this->profile_model->getProfile($rid[0]);

		// if($res['payment_type']=="paypal")
		//{

		//////techno viplove payment code start///////
		$logger = new PPLoggingManager('MassPay');
		$massPayRequest = new MassPayRequestType();
		$massPayRequest->MassPayItem = array();

		$masspayItem = new MassPayRequestItemType();	
		$masspayItem->Amount = new BasicAmountType('USD',  $val[0]);
		$masspayItem->ReceiverEmail = $res['payment_account'];
		$massPayRequest->MassPayItem[] = $masspayItem;

		$massPayReq = new MassPayReq();
		$massPayReq->MassPayRequest = $massPayRequest;
		$paypalService = new PayPalAPIInterfaceServiceService();
		try {
			$massPayResponse = $paypalService->MassPay($massPayReq);
		} catch (Exception $ex) {
			include_once("../Error.php");
			exit;
		}
		//print_r($massPayResponse);die;
		if(isset($massPayResponse)) {

		if($massPayResponse->Ack == 'Success'){
			// echo "done";die;
			$dates1 = date('Y-m-d');
			$updateSql = "update affiliate set paid=1,paid_date ='{$dates1}'  where refid={$rid[0]}";
			$query 	= $this->db->query($updateSql);
			echo json_encode(array('status'=>true));
			//echo json_encode(array('status'=>true,'ids'=>$rid[0],'val'=>$status));
			}
		}
		//////////payment code end/////////
		// }
	
	
	}
	
	public function SchoolUsers(){
		$this->load->model(array('user_model','class_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 1;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
	
		
			if($search != ''){
				$users = $this->user_model->GetSchoolUsers($start,$search,$sort,$sortorder);
				if(count($users)<=0){
					//reset pagination record if get single record
					$start = 0;
					$users = $this->user_model->GetSchoolUsers($start,$search,$sort,$sortorder);
				}
			}else{
				$users = $this->user_model->GetAllschoolData($start,$sort,$sortorder);
			}
		
		
		/*echo "<pre>";
		print_r($users);
		exit;*/
		$userTemp = array();
		if(count($users)>0){
			$i = 0;
			foreach($users as $user)
			{ 
				$userTemp[$i] = $user;
				 
				$i++;
			}
		}
		$users = array();
		$users = $userTemp;
		unset($userTemp);
		 
		$types = array('4'=>'School' );
		
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/SchoolUsers/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->GetcountSchoolSearch($search);
		}else{
			$config['total_rows'] = $this->user_model->GetCountSchool();
/*echo $this->uri->segment(4);
			echo $this->user_model->GetCountSchool();
		*/
		 //$config['total_rows']=21;	
		}
		$config['per_page'] = 20; 
		
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		/*print_r($config);
		die();*/
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('types',$types);
		$this->layout->setData('users',$users);
		 
		$this->layout->view('admin/SchoolUser');
	}
	public function school_user_edit(){
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('user_model','profile_model'));
		if($this->input->post()){
		  $data = $this->input->post();
			$newDate = date("Y-m-d", strtotime($data['expDate']));
			$acc = $this->input->post('hiddenRole');
			if($acc == 1){
			}else{
				$data['hiddenRole'] = 0;
			}
			$quarantine = $this->input->post('quarantine');
			if($quarantine == 1){
			}else{
				$data['quarantine'] = 0;
			}
			if($data['expDate']){
				$this->user_model->updateExpDate($newDate,$id);
			}

			$profileData = array();
			$profileData['lms_complete'] = $data['lms_complete'];
			$profileData['uid'] = $id;
			unset($data['lms_complete']);
			
			//--Update Balance
			$profileData['money'] = $data['money'];
			$profileData['pbalance'] = $data['pbalance'];
			unset($data['money']);
			unset($data['pbalance']);
			unset($data['expDate']);
			//--Update Balance

			$this->user_model->user_edit($data,$id);
			$this->profile_model->update($profileData);
			$errormsg = 'Edit User successfully.';
		}
		$user = $this->user_model->getByUid($id);
		$profile = $this->profile_model->getProfileJoin($id);
		$user = array_merge($user,$profile);
 
		$currentUserRole	= $this->session->userdata['roleId'];
		if($currentUserRole == 1002){ $this->layout->setData('isAccount',TRUE);}else{ $this->layout->setData('isAccount',FALSE); }
		$expDateArray = $this->user_model->getExpDateByUid($id);				
		if($expDateArray[0]['expDate'] != "" ){
			$expDate = $expDateArray[0]['expDate'];
		}else{
			$expDate = '';
		}
		$this->layout->setData('user',$user);
		$types = array('0'=>'Student','1'=>'Bronze Tutor','2'=>'Silver Tutor','3'=>'Gold Tutor','4'=>'School','5'=>'Affiliate','1001'=>'Database manager','1111'=>'Admin', '1002'=>'Accountant' );
		$chat = array('1'=>'Yes','0'=>'No');
		$this->layout->setData('chat',$chat);
		$this->layout->setData('types',$types);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('expDate',$expDate);
		$this->load->helper('form');
		$this->layout->view('admin/school_user_edit');
	}
	 
	public function AproveSchoolPayment()
	{
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model(array('pay_model','profile_model'));
		$dat = date('Y-m-d');
		$m = date_parse_from_format("Y-m-d", $dat);
		$month=$m["month"];
		$rid = $this->input->_request('id');
        $val = $this->input->_request('approveval');
		$Id=$rid[0];		
		$res = $this->profile_model->getProfile($Id);
		
		if($res['payment_type']=="credits")
		{
			$dates = date('Y-m-d');
			$feeSql = "update profile set money=money+{$amt} where uid={$Id}";
			$query 	= $this->db->query($feeSql);
			$updateSql = "update class set is_paid=1 where school_id={$Id}";
			$query 	= $this->db->query($updateSql);
			echo json_encode(array('status'=>true));
		}
		if($res['payment_type']=="paypal")
		{
				$logger = new PPLoggingManager('MassPay');
				$massPayRequest = new MassPayRequestType();
				$massPayRequest->MassPayItem = array();
				 $masspayItem = new MassPayRequestItemType();	
					$masspayItem->Amount = new BasicAmountType('USD',  $amt);
					$masspayItem->ReceiverEmail = $res['payment_account'];
					$massPayRequest->MassPayItem[] = $masspayItem;
				$massPayReq = new MassPayReq();
				$massPayReq->MassPayRequest = $massPayRequest;
				$paypalService = new PayPalAPIInterfaceServiceService();
				try {
					$massPayResponse = $paypalService->MassPay($massPayReq);
				} catch (Exception $ex) {
					include_once("../Error.php");
					exit;
				}
				if(isset($massPayResponse)) {
					 
					 if($massPayResponse->Ack == 'Success'){
						$dates1 = date('Y-m-d');
						$feeSql = "update profile set money=money+{$amt} where uid={$Id}";
						$query 	= $this->db->query($feeSql);
						$updateSql = "update class set is_paid=1 where id={$Id}";
						$query 	= $this->db->query($updateSql);
						 echo json_encode(array('status'=>true));
					 }
				}
		 //////////payment code end/////////
		 }
	}
	
	//added by haren  to generate csv file for dispute resolution 
	public function GenerateCsvDispute(){
	
		$this->load->model(array('class_model','profile_model'));
		$result = array();
		$sql = "select * from  disputes where is_completed=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		$i=0;
		foreach ($result as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['tutorhRate'] = @$payf['t_hrate'];
				$payments[$i]['money'] = @$payf['fee'];
				$payments[$i]['status'] = @$payf['paymentstatus'];
				$payments[$i]['creatAt'] = @$payf['createAt'];
				$payments[$i]['approve'] = @$payf['approve'];
				$payments[$i]['postpone'] = @$payf['postpone'];
				$payments[$i]['is_Deleted'] = @$payf['is_Deleted'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['type'] = @$payf['type'];
				$payments[$i]['PayDate'] = @$payf['PayDate'];
				
				$payments[$i]['money'] = @$payf['fee'];
				$action = unserialize(@$payf['action']);
				 
				if($action['studentConnected']==1)
				{
					$payments[$i]['sconnect']='Y';
				}
				else
				{
						$payments[$i]['sconnect']='N';
				}
				if($action['tutorConnected']==1)
				{
					$payments[$i]['tconnect']='Y';
				}
				else
				{
						$payments[$i]['tconnect']='N';
				}
				if($payments[$i]['PayDate'] =='0000-00-00')
				{
					$payments[$i]['PayDate'] ="-";
				}
				$currentDtStr = strtotime($payments[$i]['creatAt']);
				$hourdiff = 72;
			    $payments[$i]['creatAt']= date('Y-m-d',$currentDtStr + ($hourdiff * 3600) );
				$i++;
			}
		//echo "<pre>"; print_r($payments);die;
		$file = 'DisputeResolution.csv';
		$data ="";
		$data .="   Dispute Resolution    \r\n";
		$data .="ID , Student ,  Tutor , Amount , Payment Status ,Payment Date ,Paid Date , Type , TPresent , SPresent ,Session Amt \r\n";
		foreach($payments as $rs)
		{
			$data .= $rs['id']." , ".$rs['student']." , ".$rs['tutor']." , ".$rs['tutorhRate']." , ".$rs['status']." , ".$rs['creatAt']." , ".$rs['PayDate']." , ".$rs['type']." , ".$rs['tconnect']." , ".$rs['sconnect']." , ".$rs['money'];
			$data .="\r\n";	
		}
		$csvData = $data;
		$records = count($csvData);
		$exporter_output = $csvData;
		$content_type = 'application/csv';
		
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($csvData));
		header('Content-Type: '.$content_type);
		header('Content-Disposition: attachment; filename=' . $file);
		header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Pragma: no-cache");
		echo $data;exit;
		
	}
	
	//added by haren to export memeber payment in csv
	public function ExportMemberpay(){
		$this->load->model(array('user_model','class_model'));
		$users = array();
		$search = '';
		$dsearch='';
		$substufee=0;
		if($this->input->post()){
			$dsearch = trim($this->input->post('month'));
		}
		$users = $this->user_model->GetMemebrDataForCsv($start=0,$sort='id',$sortorder='asc');
		$userTemp = array();
		if(count($users)>0){
			$i = 0;
			foreach($users as $user)
			{		
			 
			}
		}
		$payments = array();
		if($users)
		{
			$payments = array();
			$i = 0;
			foreach ($users as $payf)
			{
				$payments[$i]['usernm'] = $payf['firstName']." ". $payf['lastName'];
				$payments[$i]['id'] = $payf['uid'];
   				if($payf['uid'] == '')
				{
					$payments[$i]['pay']=0;
					$stuadd=0;
					$payments[$i]['earning'] =0 ;
					$payments[$i]['affi'] =0 ;
				}
				else
				{
					if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
					$bigBal=$this->user_model->GetBigBal($payf['uid'],$dsearch);
					if($dsearch > date('07/2014')){
						$beginquery = "Select money from users_end where uid =".$payf['uid'];
						$beginresult = $this->db->query($beginquery);
						$beginpayment = $beginresult->result_array();
						if(count($beginpayment)>0)
						{
						$payments[$i]['BigBal'] = $beginpayment[0]['money'];}
						else{$payments[$i]['BigBal'] = 0;}
					}else{
						$bigBal=$this->user_model->GetBigBal($payf['uid'],$dsearch);
					}
					$data=$this->user_model->getSessionAttendAmount($payf['uid'],$dsearch);
					$payments[$i]['earning'] = @$data['earning'];
					$endbal=$this->user_model->getEndbal($payf['uid']);
                    $payments[$i]['endbal'] = @$endbal[0]['money'];
					$data1=$this->user_model->getAffiIncome($payf['uid'],$dsearch);
					 if($payf['roleId'] == 0)
					{
						$payments[$i]['affi'] = @$data1['total'];
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
						$substu=$this->user_model->getSubstu($payf['uid'],$dsearch);
						if(count($substu)>0)
						{
						$substufee=$substu[0]['stufee'];
						}
						else
						{
							$substufee=0;
						}	
						$payments[$i]['sub'] =$substufee;
						if ($dsearch == '07/2014'){
							$payments[$i]['sub'] = '0';
						}
						$addstu=$this->user_model->GetaddStu($payf['uid'],$dsearch);
					    $affistu=$this->user_model->GetaddStuaffi($payf['uid'],$dsearch);
						$stuadd=0;
						$stuadd1=0;
						 if(count($addstu) > 0)
						 {
							$stuadd=$addstu[0]['pmoney'];
						 }
						 if(count($affistu) > 0)
						 {
							$stuadd1=$affistu[0]['amt'];
						 }
						$payments[$i]['addstu'] = $stuadd+$stuadd1;	
						if ($dsearch == '07/2014'){
							$payments[$i]['addstu'] = '0';
						}
						$uid = $payments[$i]['id'];
						$month = $dsearch;
						$dt=explode('/',$month);
						$mon=$dt[0];
						$premon = $dt[0] - 1;
						$selectsql = "select * from memberpay where userid = '{$uid}' AND month = '0{$premon}'";						
						$selectquery = $this->db->query($selectsql);
						$bigresult = $selectquery->result_array();
						$EndBal = (@$bigresult[0]['endbal']+$payments[$i]['addstu'])-$payments[$i]['sub'];
						if($dsearch > date('07/2014')){						
							$beginquery = "Select money from users_end where uid =".$payf['uid'];
							$beginresult = $this->db->query($beginquery);
							$beginpayment = $beginresult->result_array();
							if(count($beginpayment)>0)
							{
							$payments[$i]['BigBal'] = $beginpayment[0]['money'];
							}
							else
							{
								$payments[$i]['BigBal'] =0;
							}
						}else if ($dsearch == '07/2014'){
							$payments[$i]['BigBal'] = '0';
						}else{
							$payments[$i]['BigBal'] = @$bigresult[0]['endbal'];	
						}
						$selectcsql = "select * from memberpay where userid = '{$uid}' AND month = '{$mon}'";						
						$selectcquery = $this->db->query($selectcsql);
						if ($selectcquery->num_rows() == 0) {
							$sql = "insert into memberpay SET userid = '{$uid}', month = '{$mon}', endbal = '{$EndBal}'";
							$query11 = $this->db->query($sql);
						}
					}
					else
					{
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
						$tutoradd=$this->user_model->GetTutorAdd($payf['uid'],$dsearch);
						$tutoradd1=$this->user_model->Gethrate($payf['uid']);
						$mny=0;
						$hrate=0;
						$stuadd=0;
						$tutorIncome=0;
						if(count($tutoradd)>0)
						{
							$payments[$i]['affi'] =$tutoradd[0]['tuid'];
							$mny=$tutoradd[0]['tuid'];
							$tutorIncome=$tutoradd[0]['tuid'];
						}
						if(count($tutoradd1)>0)
						{
							$hrate=$tutoradd1[0]['hRate'];
						}
						$tutoraffi=0;
						if($dsearch == '')
						{
							$dsearch=date('m/Y');
						}
						$affistu=$this->user_model->GetaddStuaffi($payf['uid'],$dsearch);
						if(count($affistu) > 0)
						 {
							$tutoraffi=$affistu[0]['amt'];
						 }
						$tutoradd=$mny*$hrate; 
						$payments[$i]['affi'] =$tutoradd;
						$payments[$i]['sub'] =0;
						$payments[$i]['addstu'] =$tutorIncome + $tutoraffi;
						if ($dsearch == '07/2014'){
							$payments[$i]['addstu'] = '0';
						}
						$subtutor=$this->user_model->GetSubTutor($payf['uid'],$dsearch);
						if(count($subtutor)>0)
						{
							$payments[$i]['sub']=$subtutor[0]['paidamt'];
						}
						else
						{
						$payments[$i]['sub']=0;		
						}
						if ($dsearch == '07/2014'){
							$payments[$i]['sub'] = '0';
						}
						$uid = $payments[$i]['id'];
						$month = $dsearch;
						$dt=explode('/',$month);
						$mon=$dt[0];
						$premon = $dt[0] - 1;
						$selectsql = "select * from memberpay where userid = '{$uid}' AND month = '0{$premon}'";						
						$selectquery = $this->db->query($selectsql);
						$bigresult = $selectquery->result_array();
						$EndBal = (@$bigresult[0]['endbal']+$payments[$i]['addstu'])-$payments[$i]['sub'];
						if($dsearch > date('07/2014')){
							$beginquery = "Select money from users_end where uid =".$payf['uid'];
							$beginresult = $this->db->query($beginquery);
							$beginpayment = $beginresult->result_array();
							//echo "<pre>"; print_r($beginpayment);die;
							if(count($beginpayment >0))
							{
							$payments[$i]['BigBal'] = @$beginpayment[0]['money'];
							}else{$payments[$i]['BigBal']=0;}
						}else if ($dsearch == '07/2014'){
							$payments[$i]['BigBal'] = '0';
						}else{
							$payments[$i]['BigBal'] = @$bigresult[0]['endbal'];
						}
						$selectcsql = "select * from memberpay where userid = '{$uid}' AND month = '{$mon}'";						
						$selectcquery = $this->db->query($selectcsql);
						if ($selectcquery->num_rows() == 0) {
							$sql = "insert into memberpay SET userid = '{$uid}', month = '{$mon}', endbal = '{$EndBal}'";
							$query11 = $this->db->query($sql);
						}
					}
					if($payf['roleId'] == 0)
					{
						$payments[$i]['pay']=0;
					}
					else
					{
						$payments[$i]['pay']=0;
					}
				}
				if($dsearch == '07/2014'){
					$beginquery = "Select money from users_end where uid =".$payf['uid'];
					$beginresult = $this->db->query($beginquery);
					$beginpayment = $beginresult->result_array();
					$payments[$i]['endbal'] = $beginpayment[0]['money'];
				}else{
					$payments[$i]['endbal']= ($payments[$i]['BigBal']+$payments[$i]['addstu'])-$payments[$i]['sub'];
					$payments[$i]['endbal']=number_format($payments[$i]['endbal'],2,'.','');
					if($payments[$i]['endbal'] <0 ){  $payments[$i]['endbal'] = number_format(0,2,'.',''); }else{ $payments[$i]['endbal']; }
				}
				$payments[$i]['render'] = $payments[$i]['affi']+ $payments[$i]['earning'] +$payments[$i]['pay']+$stuadd ;
				$payments[$i]['roleId'] =  $payf['roleId'];
				if($payments[$i]['roleId'] == 0)
					{
						$payments[$i]['roleId']='Student';
					}
				else if($payments[$i]['roleId'] == 1)
					{
						$payments[$i]['roleId']='Bronze Tutor';
					}
				else if($payments[$i]['roleId'] == 2)
					{
						$payments[$i]['roleId']='Silver Tutor';
					}
					else if($payments[$i]['roleId'] == 3)
					{
						$payments[$i]['roleId']='Gold Tutor';
					}
					else
					{
						$payments[$i]['roleId']='Admin';
					}
					$payments[$i]['endbals']=(($payments[$i]['BigBal']+$payments[$i]['addstu'])-$payments[$i]['sub']);
					$payments[$i]['render']="$".number_format($payments[$i]['render'],2,'.','');
					$payments[$i]['BigBal']="$".number_format($payments[$i]['BigBal'],2,'.','');
					$payments[$i]['addstu']="$".number_format($payments[$i]['addstu'],2,'.','');
					$payments[$i]['sub']="$".number_format($payments[$i]['sub'],2,'.','');
					
					$payments[$i]['endbals']="$".number_format($payments[$i]['endbals'],2,'.','');
					$i++;
				
			}
		}
        unset($userTemp);
		 
		$Mon=explode('/',$dsearch);
		switch($Mon[0])
		{
			case 1 : 
			$Mnth='January';
			break; case 2 : 
			$Mnth='February';
			break;
			case 3 : 
			$Mnth='March';
			break;case 4 : 
			$Mnth='April';
			break;case 5 : 
			$Mnth='May';
			break;case 5 : 
			$Mnth='June';
			break;case 7 : 
			$Mnth='July';
			break;case 8 : 
			$Mnth='August';
			break;case 9 : 
			$Mnth='September';
			break;
			case 10 : 
			$Mnth='October';
			break;
			case 11 : 
			$Mnth='November';
			break;
			case 12 : 
			$Mnth='December';
			break;
			default:$mnth=$mon[0];
		} 
		$file = 'MemberPayment.csv';
		$data ="";
		$data .=" Member Payments  ". "  , " .$Mnth  ."  , " . $Mon[1]. "\r\n";
		$data .="ID ,Name ,Role ,Total Rendered , Beg Bal , Adds , Subs ,End Bal  \r\n";
		foreach($payments as $rs)
		{
			$data .= $rs['id']." , ".$rs['usernm']." , ".$rs['roleId']." , ".$rs['render']." , ".$rs['BigBal']." , ".$rs['addstu']." , ".$rs['sub'] ." , ".$rs['endbals'];
			$data .="\r\n";	
		}
		$csvData = $data;
		$records = count($csvData);
		$exporter_output = $csvData;
		$content_type = 'application/csv';
		
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($csvData));
		header('Content-Type: '.$content_type);
		header('Content-Disposition: attachment; filename=' . $file);
		header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Pragma: no-cache");
		echo $data;exit;
		}
		
		//added by haren to add new test scenario for vee  session
		public function AddTestScenario(){
			$errormsg = '';
			$succrmsg = '';
			$errorStatus = false;
			$this->load->model(array('tresources_model'));
			
			if($_POST):	
			 
				if($this->input->post('type')=='p')
				{ 
				 
					$ftype = 'pfile' ;
					if($_FILES['pfile']['name']=='')
					{
						$errormsg = 'PDF is required.';
						$errorStatus = true;
					}
					if(trim($this->input->post('Description'))=='')
					{
						$errormsg= 'PDF description is required.';
						$errorStatus = true;
					}	
				}
				if ($errorStatus == false) 
				{ 
				   
					if((trim($this->input->post('type'))=='p'))
					{
						
					  
						$config['upload_path'] = FCPATH.'uploads/testscenario/';
						
						$config['allowed_types'] = 'pdf';
						$this->load->library('upload', $config);
						if (! $this->upload->do_upload($ftype))
						{
							
							$error =$this->upload->display_errors();
							 
							$errormsg=$error;
							 
							 
						}
						else
						{
							$data = array('upload_data' => $this->upload->data());
							
							
							$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
							$file_name = $data['upload_data']['file_name'];
							$data[$ftype] = $img['file_name'];
							 
							$data1['pfile'] = $data['upload_data']['file_name'];
							$data[$ftype] =  $data['upload_data']['file_name'];
							$data1['Description'] = $this->input->post('Description') ;
							$data1['Title']       = $this->input->post('Title') ;
							$data1['rtype']        = 'S' ;
							$data1['Status']       = $this->input->post('Status') ;
							$data1['lang']       = $this->input->post('lang') ;
							
							$data1['orderNo']       = $this->input->post('orderNo') ;
							$data1['categories']       = $this->input->post('categories') ;
						
							$this->tresources_model->AddTetsScenarios($data1);
							@$_POST = '';
							$succrmsg = 'Added successfully.';
						}
					}
					else				 
					{
					
					}
				}
				endif;	
				$cat=$this->tresources_model->GetCatagory();
				$this->layout->setData('cat',$cat);
				$this->layout->setData('errormsg',$errormsg);
				$this->layout->setData('succrmsg',$succrmsg);
				$this->layout->view('admin/AddTestScenario');
		}
	
	
	public function ListTestScenario(){
		
		$start = $this->input->_request('start');
		$this->load->model(array('user_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$sortorder = $this->input->_request('sortorder');
		if(!$start){
			$start = 1;
		}
		if(!$sortorder)
		{
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'Title';
		}
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 100;
		}
		$targetpage = base_url()."admin/ListTestScenario/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		
		$this->load->model(array('tresources_model'));
		$search='';
		$TetsScenario = $this->tresources_model->GetTestScenario($start,$limit,$sortorder,$sort);
		//echo "<pre>"; print_r($TetsScenario);die;
		$this->layout->setData('TetsScenario',$TetsScenario);
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('start',$start);
		$this->layout->view('admin/ListTestScenario');
	}
	public function EditTestScenario(){
		$id = $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 		= '';
		$succrmsg 		= '';
		$errorStatus 	= false;
		$this->load->model(array('tresources_model'));
		if($_POST):	
		 if($this->input->post('type')=='p')
			{ 
			 $ftype = 'pfile' ;
				if(trim($this->input->post('Description'))=='')
				{
					$errormsg= 'PDF description is required.';
					$errorStatus = true;
				}	
			}
 			if ($errorStatus == false) 
			{ 
			  
				if((trim($this->input->post('type'))=='p') && $_FILES['pfile']['name'] !='' && $_FILES['pfile']['size'] > 0)
				{
					$config['upload_path'] = FCPATH.'upload/testscenario/';
					$config['allowed_types'] = 'pdf';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload($ftype))
					{
						$error =$this->upload->display_errors();
						 
						$errormsg=$error;
						 
						 
					}
					else
					{
						$unlink="select pfile from test_scenario where test_scenario_id={$id}";
						$query 	= $this->db->query($unlink);
						if ( $query->num_rows() > 0) {
							$result = $query->row_array();
							unlink(FCPATH.'upload\testscenario/'.$result['pfile']);
							}
						 
					    $data = array('upload_data' => $this->upload->data());
						$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $data['upload_data']['file_name'];
						$data[$ftype] = $img['file_name'];
						$data1['pfile'] = $data['upload_data']['file_name'];
						$data[$ftype] =  $data['upload_data']['file_name'];
						$data1['Description'] = $this->input->post('Description') ;
						$data1['Title']       = $this->input->post('Title') ;
						 $data1['orderNo']       = $this->input->post('orderNo') ;
						$data1['rtype']        = 'S' ;
						$data1['Status']       = $this->input->post('Status') ;
						$data1['lang']       = $this->input->post('lang') ;
						$data1['categories']       = $this->input->post('categories') ;
					 
						$this->tresources_model->EditTestScenario($data1,$id);
						$succrmsg = 'Edited successfully.';
					}
				}
				else				 
				{
						$data1['rtype'] = $this->input->post('rtype') ;
						$data1['Title']       = $this->input->post('Title') ;
						$data1['Description']        = $this->input->post('Description') ;
						$data1['rtype']        = 'S' ;
						 $data1['orderNo']       = $this->input->post('orderNo') ;
						$data1['Status']       = $this->input->post('Status') ;
						$data1['lang']       = $this->input->post('lang') ;
						$data1['categories']       = $this->input->post('categories') ;
						$this->tresources_model->EditTestScenario($data1,$id);
						$succrmsg = 'Test scenario edited successfully.';
				}
			 
				
			}
			 
			endif;
			$EditData = $this->tresources_model->GetTestScenarioedit($id);
			if($id < 10){
				$index = $id;
			}
		else {
			$index = 0;
		}
		//echo "<pre>"; print_r($EditData);die;
		$cat=$this->tresources_model->GetCatagory();
		$this->layout->setData('cat',$cat);
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('EditData',$EditData);
		$this->layout->view('admin/editTestScenario');
}


	public function Attempted_Session(){
		$this->load->model(array('pay_model','profile_model'));
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'createAt';
		}
		
		$search = '';
		$dsearch='';
		if($this->input->post('dsearch'))
		{
			$search = $this->input->post('search'); 
			$dsearch=  $this->input->post('dsearch'); 
			 
			$this->session->set_userdata("searchdisputes",$search);
			$this->session->set_userdata("dispdsearch",$dsearch);
		}
		else
		{
			$dsearch = $this->session->userdata("dispdsearch");
			$search = $this->session->userdata("searchdisputes");
		}
		
		$total_pages = $this->pay_model->GetTotalAttemptedSession($search,$dsearch);
		 
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 20;
		}
		
		$targetpage = base_url()."admin/Attempted_Session/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit;
		else
			$start = 0;
		$AttemptData = $this->pay_model->GetUncompleteSession($start,$search,$limit,$sortorder,$sort,$dsearch);
		//echo "<pre>"; print_r($AttemptData);die;
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		if($AttemptData)
		{
			$payments = array();
			$i = 0;
			
			foreach ($AttemptData as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['email'] = @$user['email'];
				$payments[$i]['creatAt'] = @$payf['startTime'];
				$payments[$i]['Is_early'] = @$payf['Is_early'];
				$payments[$i]['type'] = @$payf['type'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['confirmby'] = @$payf['confirmby'];
				$payments[$i]['s_attend'] = @$payf['s_attend'];
				$payments[$i]['session_type'] = @$payf['session_type'];
				$payments[$i]['Intent'] = @$payf['Intent'];
				$payments[$i]['fee'] =@$payf['fee'];
				$payments[$i]['Booking'] =@$payf['Booking'];
				$payments[$i]['session_id'] =@$payf['session_id'];

				$payments[$i]['endTime'] =@$payf['endTime'];
				$payments[$i]['ac'] =@$payf['Action'];
				$action = unserialize(@$payf['action']);

				if($action['studentConnected']==1)
				{
					$payments[$i]['sconnect']='Y';
				}
				else
				{
					$payments[$i]['sconnect']='N';
				}
				if($action['tutorConnected']==1)
				{
					$payments[$i]['tconnect']='Y';
				}
				else
				{
					$payments[$i]['tconnect']='N';
				}$i++;
			}
		}
		/*
		echo "<pre>";
		print_r($payments);
		exit;*/
		 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		
		$this->layout->setData('search',$search);
		$this->layout->setData('dsearch',$dsearch);
		$this->layout->setData('payments',$payments);
		$this->layout->view('admin/Attempted_session');
	}
	public function ExportAttend(){
		$this->load->model(array('pay_model','profile_model'));
		$sortorder = 'desc';
		$sort = 'createAt';
		$search = '';
		$dsearch='';
	    $targetpage = base_url()."admin/Attempted_Session/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		$AttemptData = $this->pay_model->GetUncompleteSessionCSV($sortorder,$sort);
		if($AttemptData)
		{$payments = array();
			$i = 0;
			$edate = date('Y-m-d H:i:s');
			foreach ($AttemptData as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['email'] = @$user['email'];
				$payments[$i]['creatAt']=date("Y-m-d H:i:s", strtotime(@$payf['createAt']));
				$payments[$i]['Is_early'] = @$payf['Is_early'];
				$payments[$i]['type'] = @$payf['type'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['confirmby'] = @$payf['confirmby'];
				$payments[$i]['s_attend'] = @$payf['s_attend'];
				$payments[$i]['session_type'] = @$payf['session_type'];
				$payments[$i]['Intent'] = @$payf['Intent'];
				@$payments[$i]['Booking'] = @$payf['Booking'];
				$payments[$i]['endTime'] =@$payf['endTime'];
				/*if($payments[$i]['s_attend'] == 1)
				{
					$payments[$i]['s_attend']='Yes';
				}	
				else {
					$payments[$i]['s_attend']='No';
				}*/
				if (@$payments[$i]['s_attend'] == 1 && @$payments[$i]['Intent']==0) {
					$payments[$i]['s_attend']='Yes';
				} else if(@$payments[$i]['s_attend'] == 0 && @$payments[$i]['t_attend'] == 1 && @$payments[$i]['session_type'] == 'free') {
					$payments[$i]['s_attend']='Yes';
				} else {
					$payments[$i]['s_attend']='No';
				}
				if (@$payments[$i]['Intent'] >=2 AND @$payments[$i]['session_type'] != 'free') {
					if (@$payments[$i]['type'] == "now") {
						$payments[$i]['Status'] = "Now Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Requested') {
						$payments[$i]['Status'] = "Req Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Booked') {
						$payments[$i]['Status'] = "Sched Aborted";
					}
				} else if (@$payments[$i]['sconnect']=='N'  && @$payments[$i]['tconnect']=='N' && @$payments[$i]['endTime'] < $edate) {
					if (@$payments[$i]['type'] == "now") {
						$payments[$i]['Status'] = "Now Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Requested') {
						$payments[$i]['Status'] = "Req Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Booked') {
						$payments[$i]['Status'] = "Sched Aborted";
					}
				} else if (@$payments[$i]['session_type'] == 'free') {
					$payments[$i]['Status'] = 'Free';
				} else if (@$payments[$i]['Booking'] == 'Booked' && @$payments[$i]['endTime'] < $edate) {
					if (@$payments[$i]['type'] == "now") {
						$payments[$i]['Status'] = "Now Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Requested') {
						$payments[$i]['Status'] = "Req Aborted";
					} else if (@$payments[$i]['type'] == "general" and @$payments[$i]['Booking']=='Booked') {
						$payments[$i]['Status'] = "Sched Aborted";
					}
				} else if (@$payments[$i]['Booking'] == 'Booked' ) {
					$payments[$i]['Status'] = 'Booked';
				} else if(@$payments[$i]['Booking']=='Requested') {
					$payments[$i]['Status'] = 'Requested';
				} else {
					$payments[$i]['Status'] = 'Requested';
				}
				
				
				/*if($payments[$i]['session_type'] == 'free')
				{
					$payments[$i]['Status']= 'Free';
				}
				else if($payments[$i]['session_type'] = 'requested')
				{
					$payments[$i]['Status']= 'Requested';
				}
				else if($payments[$i]['Intent']>=1  && $payments[$i]['s_attend']==0)
				{
					$payments[$i]['Status']= 'Aborted';
				}
				else
				{
					$payments[$i]['Status']='Requested';
				}*/
				$payments[$i]['fee'] =@$payf['fee'];
				$action = unserialize(@$payf['action']);
				 
				if($action['studentConnected']==1)
				{
					$payments[$i]['sconnect']='Y';
				}
				else
				{
					$payments[$i]['sconnect']='N';
				}
				if($action['tutorConnected']==1)
				{
					$payments[$i]['tconnect']='Y';
				}
				else
				{
					$payments[$i]['tconnect']='N';
				}
				$i++;
			}
		}
		$file = 'Attempted_Sessions.csv';
		$data ="";
		$data .="ID ,Student ,Email , Tutor , Date , Type ,Approved ,TPresent,SPresent ,Session Amt  \r\n";
		foreach($payments as $rs)
		{
			$data .= $rs['id']." , ".$rs['student']." , ".$rs['email']." , ".$rs['tutor']." , ".$rs['creatAt']." , ".$rs['Status']." , ".$rs['s_attend']. " , ".$rs['tconnect']." , ".$rs['sconnect']." , ".$rs['fee'];
			$data .="\r\n";	
		}
		$csvData = $data;
		$records = count($csvData);
		$exporter_output = $csvData;
		$content_type = 'application/csv';
		
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($csvData));
		header('Content-Type: '.$content_type);
		header('Content-Disposition: attachment; filename=' . $file);
		header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Pragma: no-cache");
		echo $data;exit; 
	}
	public function DleteTestSAcenario(){
		$id = $this->input->_request('id');
		$this->load->model(array('tresources_model'));
		$this->tresources_model->DelTestScenario($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function addtutor()
	{
			$this->layout->view('admin/newtutor');
	}
	public function GetNewtutorsAdmin()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$this->load->model(array('user_model'));
		$Alldata=$this->user_model->GetNewTutors($ptn);
		//print_r($Alldata);die;
		echo json_encode($Alldata);
		die();
	}
	
	public function AddnewTutor()
	{
		$this->load->model(array('user_model'));
		$uid=$this->input->post('uid');
		$result=$this->user_model->AddTonewUserList($uid);
		if($result)
		{
				echo json_encode(array('success'=>true));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}
	
	public function newtutorlist(){
		$this->load->model(array('user_model','class_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
			
		}
		$users = array();
		$users=$this->user_model->GetAllNewtutor($start,$search,$sort,$sortorder);
		
		//echo "<pre>"; print_r($users);die;
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/newtutorlist/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->GetCountForNewTutor($search);
		}else{
			$config['total_rows'] = $this->user_model->getNewtutorcount();
		}
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('users',$users);
		$this->layout->view('admin/newtutorlist');
	}
	
	
	public function EditNewTutor(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model','profile_model'));
		if($this->input->post()){
		  
			$data = $this->input->post();
			$this->user_model->EditNewtutor($data);
			$errormsg = 'Edit User successfully.';
		}
		$data=array();
		$user = $this->user_model->GetTutorbyId($id);
		if($user !=array())
		{
			$data=$this->user_model->GetDetailData($user['uid']);
		} 
		$this->layout->setData('user',$user);
		$this->layout->setData('prof',$data);
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/newuseredit');
	}
	
	public function DelteNewuser(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->deleteNewtutor($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	
	
/**********	  Lanuage app code start  *** Haren ****/


public function AddLanguageApp(){
	
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		 
            $cdate = date('Y-m-d');
 
			$this->load->model(array('ad_model'));
			$data = $this->input->post();
			$data['CreateDate']=$cdate;
			if($this->input->post() && $data['Title'] !='' && $data['Link'] !=''){
			 
				if(isset($_FILES) && $_FILES['image']['name']!='')
				{
					$this->load->library('media','upload');
					
					$upConfig['upload_path'] = FCPATH.'LanuageApp/';
					//chmod($upConfig['upload_path'],0755);
					$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
					$upConfig['encrypt_name'] = false;
					$translateConfig['image_library'] = 'gd2';
					$translateConfig['maintain_ratio'] = TRUE;
					$translateConfig['new_image'] =  $upConfig['upload_path'];
					$translateConfig['width'] = 245;
					$translateConfig['height'] = 206;
					$this->media->upload($upConfig,'image')->resize(@$translateConfig);
					if(!$this->media->error){
						
						$allData = $this->media;
						$data['Source']=$allData->sqlAddress;
						unset($data['image']);
						$succrmsg = 'Add successfully.';
						$this->layout->setData('succrmsg',$succrmsg);
						$this->ad_model->AddLanguageApps($data);
					}else {
					
							$succrmsg = 'Error in uploading image.please check for valid type';
							$this->layout->setData('succrmsg',$succrmsg);
							$this->layout->view('admin/AddLanguageApp.php');
						}
				}else{
							$succrmsg = 'Please select image to upload';
							$this->layout->setData('succrmsg',$succrmsg);
					  
				}
			}
			
			
			 
			 
		
		$this->layout->view('admin/AddLanguageApp.php');
	}
	
	public function LanguageApp()
	{
		$this->load->model(array('ad_model'));
		$AppData = $this->ad_model->GetAllApps();
		$this->layout->setData('languageapp',$AppData);
		$this->layout->view('admin/applist');
	}
	public function updateStatus()
	{
	
		$lid=$this->input->_request('id');
		$this->load->model(array('ad_model'));
		$status=$this->ad_model->UpdateAppStatus($lid);
		$AppData = $this->ad_model->GetAllApps();
		$this->layout->setData('languageapp',$AppData);
		$this->layout->view('admin/applist');
	}
	public function AppEdit(){
		$id = $this->input->_request('id');
		if(is_numeric($id))
		{
			 
		}
		else{ 
			$this->LanguageApp();
		}
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('ad_model'));
		$errormsg = '';
		$succrmsg ='';
		$errorStatus = false;
		if($_POST):
		
		
			$data = $this->input->post();
			
			if ($errorStatus == false){
				if($this->input->post()){		
					if(isset($_FILES) && $_FILES['image']['size']!=''){
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'LanuageApp/';
						$upConfig['allowed_types'] = 'jpg|jpeg|png|bmp|gif';
						$upConfig['encrypt_name'] = false;
						$translateConfig['image_library'] = 'gd2';
						$translateConfig['maintain_ratio'] = TRUE;
						$translateConfig['new_image'] =$upConfig['upload_path'];
						$translateConfig['width'] = 245;
						$translateConfig['height'] = 206;
						$this->media->upload($upConfig,'image')->resize($translateConfig);
						if(!$this->media->error){
						
						
						$unlink="select Source from  languageapp where LanguageAppID ={$id}";
						$query 	= $this->db->query($unlink);
						if ( $query->num_rows() > 0) {
							$result = $query->row_array();
							 
							unlink(FCPATH.'LanuageApp/'.$result['Source']);
							}
						
							$allData = $this->media;
							$data['Source']=$allData->sqlAddress;
							 
						}else {
						$succrmsg = 'Error in uploading image please check for valid type';
							$errormsg='Error in uploading image please check for valid type.'; 
						}
					}
					if($errormsg ==''){
						unset($data['image']);
						$this->ad_model->UpdateApps($data,$id);
						$succrmsg = 'Edit success.';
					}
				}
			}
		endif;
		$App = $this->ad_model->GetAppById($id);
		
				if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$App);
		$this->layout->view('admin/EditApp');
		 
	
	}
	public function DeleteApp(){
		$id = $this->input->_request('id');
	
		$this->load->model(array('ad_model'));
		
	
		$this->ad_model->DelApp($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	
	/*    Added by Haren for free group session */
	
	
	public function CreateSession()
	{
			$this->load->model(array('user_model'));
			if($_POST)
			{
				$data = $this->input->post();
			 
				if($data !='')
				{
						 
					 
						$time=$data['startTime'];
						$localTimeZone = $this->input->_request('localTimeZone');
						 $actual= strtotime($time);
						 $actual=$actual+(7*3600);
						
						/*$utc=date("Y-m-d H:i:s", $actual); 
						$calfornia=	 strtotime($utc);
						$calf=$actual+($localTimeZone*4800);
						$data['startTime']=date("Y-m-d H:i:s",$calf);  */
						
						$data['startTime']=date("Y-m-d H:i:s",$actual); 
 
						$staus= $this->user_model->InsetSession($data);
						$succrmsg = 'Session created successfully.';
						$this->layout->setData('succrmsg',$succrmsg);
				}	
			}
			$this->load->helper('form');
			$this->layout->view('admin/session_create');
	}
	
	public function ListSession()
	{
			$start = $this->input->_request('start');
			$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		
		$this->load->model(array('user_model','profile_model'));
		
		$SessionData = $this->user_model->GetAllSession($start);
		
		$allData=array();
			$i = 0;
			foreach ($SessionData as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['Tutor1']);
				$allData[$i]['tutor1'] = @$user['firstName'].' '.@$user['lastName'];
				if(@$payf['Tutor2'] == 0)
				{
					
					$allData[$i]['tutor2'] = '';
				}
				else
				{
					$user1 = $this->profile_model->getProfile(@$payf['Tutor2']);
					$allData[$i]['tutor2'] = @$user1['firstName'].' '.@$user1['lastName'];
				}
				$allData[$i]['gropsessionId'] = @$payf['gropsessionId'];
				$allData[$i]['Time'] = @$payf['Time'];
				 $allData[$i]['endTime'] = @$payf['endTime'];
				 $allData[$i]['Topic'] = @$payf['Topic'];
				 $user = $this->profile_model->getProfile(@$payf['isprimary']);
				$allData[$i]['isprimary'] = @$user['firstName'].' '.@$user['lastName'];
				$i++; 
			}

		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/ListSession/start');
		$config['uri_segment'] = 4;
		
		$config['total_rows'] = $this->user_model->Getcountgroup();
		$config['per_page'] = 10; 
		
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('start',$start);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('page',$page);			
		$this->layout->setData('Sessions',$allData);
		$this->layout->view('admin/Sessions');
	}
	public function GetTutorList()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$this->load->model(array('user_model'));
		$Alldata=$this->user_model->GetTutorslist($ptn);
		//print_r($Alldata);die;
		echo json_encode($Alldata);
		die();
	}
	public function SessionEdit(){
	$this->load->helper('form');
		$id = $this->input->_request('id');
		if(is_numeric($id))
		{
			 
		}
		else{ 
			$this->ListSession();
		}
		if($id<0){
			$id = 1;
		}
		 
		$this->load->model(array('user_model','profile_model'));
		$errormsg = '';
		$succrmsg ='';
		$errorStatus = false;
		if($_POST):
		
		
			$data = $this->input->post();
			 
			 
				if($this->input->post()){	
						 
						$time=$data['Time'];
						$localTimeZone = $this->input->_request('localTimeZone');
						$actual= strtotime($time);
						$actual=$actual+(8*3600);
						 
						$data['Time']=date("Y-m-d H:i:s",$actual); 
						
						 
						$this->user_model->UpdateSession($data,$id);
						$succrmsg = 'Edit success.';
					}
				 
			 
		endif;
		$Sessions = $this->user_model->GetSessionbyId($id);
		
		 
				$user = $this->profile_model->getProfile(@$Sessions['Tutor1']);
				$allData['tutora'] = @$user['firstName'].' '.@$user['lastName'];
				if(@$Sessions['Tutor2'] == 0)
				{
					
					$allData['tutorb'] = '';
				}
				else
				{
					$user1 = $this->profile_model->getProfile(@$Sessions['Tutor2']);
					 
					$allData['tutorb'] = @$user1['firstName'].' '.@$user1['lastName'];
				}
				$allData['tutor1'] =@$Sessions['Tutor1'];
				if(@$Sessions['Tutor2']==0){$allData['tutor2']='';}
				else{$allData['tutor2']=@$Sessions['Tutor2'];}
				;
				$allData['gropsessionId'] = @$Sessions['gropsessionId'];
				$allData['Time'] = @$Sessions['Time'];
				 $allData['endTime'] = @$Sessions['endTime'];
				 $allData['Topic'] = @$Sessions['Topic'];
				 $user = $this->profile_model->getProfile(@$Sessions['isprimary']);
				//$allData['isprimary'] = @$user['firstName'].' '.@$user['lastName'];
				$allData['isprimary'] = @$Sessions['isprimary'];
		 
		// echo "<pre>"; print_r($allData);die;
				if($id < 10){
			$index = $id;
		}else {
			$index = 0;
		}
		if($Sessions['Tutor2'] !=0)
		{
			$Primary = array($Sessions['Tutor1']=> $allData['tutora'],$Sessions['Tutor2']=> $allData['tutorb']);
		}
		else
		{
			$Primary = array($Sessions['Tutor1']=> $allData['tutora']);	
		}
		
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('Sessions',$allData);
		$this->layout->setData('Primary',$Primary);
		$this->layout->view('admin/Sessionedit');
		 
	
	}
	public function DeleteSession(){
		$id = $this->input->_request('id');
	
		$this->load->model(array('user_model'));
		
	
		$this->user_model->DeleteSession($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	function MYuNIQTIME($time,$localTimeZone='a') {
	if(!is_numeric($localTimeZone)){
		$CI =& get_instance();
		$localTimeZone = $CI->input->_request('localTimeZone');
	}
	//$time = str_replace('12:','0:',$time);
	$time = strtotime($time);
	$time = $time - $localTimeZone/3600;
	return $time;
}

function TimeGmt($time,$localTimeZone='a'){
	$date = date( 'Y-m-d H:i:s' , $this->MYuNIQTIME($time,$localTimeZone) );
	//$date = str_replace('12:','0:',$date);
	return $date;
}

		public function ExportSession()
		{
				$id = $this->input->_request('id');
				$this->load->model(array('user_model','profile_model'));
				$result = array();
				if($id=='')
				{
					redirect(base_url('admin'));
				} 
				$sql = "select * from  groupattandance where groupSession_id={$id}";
				$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$result = $query->result_array();
						}
			 
				$i=0;
				//print_R($result);die;
		foreach ($result as $payf)
			{
				 
				$user = $this->profile_model->getProfile(@$payf['userId']);
			 
				$payments[$i]['student'] = @$user['firstName'].@$user['uid'];
				$payments[$i]['email'] =@$user['email'];
				
				$ses = $this->user_model->GetSessionbyId(@$payf['groupSession_id']);
				$payments[$i]['start'] = @$ses['Time']; 
				$payments[$i]['end'] = @$ses['endTime']; 
				$payments[$i]['Topic'] = @$ses['Topic'];
				
				$user1 = $this->profile_model->getProfile(@$ses['Tutor1']);
				$payments[$i]['tutor1'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['tutor2'] ='';
				if(@$ses['Tutor2'] !=0)
				{
						$user2 = $this->profile_model->getProfile(@$ses['Tutor2']);
						$payments[$i]['tutor2'] = @$user2['firstName'].' '.@$user2['lastName'];
				}	
				if(@$ses['isprimary'] == $ses['Tutor1']) 
				{
						$payments[$i]['primary'] = $payments[$i]['tutor1'];
				}
				else
				{
						$payments[$i]['primary'] = $payments[$i]['tutor2'];
				}
				$payments[$i]['id'] =@$ses['gropsessionId'];
				$i++;
			}
			 	
		 
		$file = 'Attendee.csv';
		$data ="";
		$data .="   Group Vee-session  \r\n";
		$data .="ID , Attendees , Email, Tutor1 , Tutor2 , Primary ,Topic ,StartTime , EndTime \r\n";
		foreach($payments as $rs)
		{
			$data .= $rs['id']." , ".$rs['student']." ,".$rs['email']." , ".$rs['tutor1']." , ".$rs['tutor2']." , ".$rs['primary']." , ".$rs['Topic']." , ".$rs['start']." , ".$rs['end'];
			$data .="\r\n";	
		}
		$csvData = $data;
		$records = count($csvData);
		$exporter_output = $csvData;
		$content_type = 'application/csv';
		
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($csvData));
		header('Content-Type: '.$content_type);
		header('Content-Disposition: attachment; filename=' . $file);
		header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Pragma: no-cache");
		echo $data;exit;
		
	
		}
		
		//added by haren to get school List
		
	public function GetSchoolList()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$this->load->model(array('user_model'));
		$Alldata=$this->user_model->GetSchoolsSearch($ptn);
		//print_r($Alldata);die;
		echo json_encode($Alldata);
		die();
	}
	
	//added by haren to add tutor to school organization
	
	public function addtoschool()
	{
			$id = $this->input->_request('id');
			if($id ==''){ $id=0;}
			$this->layout->setData('userId',$id);
			$this->layout->view('admin/AddtoSchool');
			
	}
	public function DoAddtoschol()
	{
		$this->load->model(array('user_model'));
		$schoolid=$this->input->post('schoolid');
		$userid=$this->input->post('userid');
		$result=$this->user_model->DoAddtoSchool($schoolid,$userid);
		if($result)
		{
				echo json_encode(array('success'=>true));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}
	public function removefromschool()
	{
		$this->load->model(array('user_model'));
		$userId=$this->input->post('ids');
		$result=$this->user_model->DodeleteFromSchool($userId);
		echo json_encode(array('status'=>true,'ids'=>$userId));
		 
	}
	
	
	public function school_Layout(){
		$this->load->model(array('user_model','profile_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'uid';
		}
		if(!$start){
			$start = 1;
		}
		$search = '';
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
		}elseif($this->session->userdata('searchuser')){
			$search = $this->session->userdata('searchuser');
		}
		$school = array();
		$school=$this->user_model->GetSchoolLayoutData($search,$sort,$sortorder);
       
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/school_Layout/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->GetCountLayout($search);
		}else{
			$config['total_rows'] = $this->user_model->GetCountLayoutNosearch();
		}
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('users',$school);
		$this->layout->view('admin/schoolLayout');
	}
	function updatLayoutStatus()
	{
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->DoupdateStatus($id);
	}
	
	function UpdateCurriculum()
	{
		$id = $this->input->_request('id');
		
		$this->load->model(array('user_model'));
		$this->user_model->DoUpdateCurriculum($id);
	}
	
	public function guide()
	{
		$start = $this->input->_request('start');
		$this->load->model(array('user_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$sortorder = $this->input->_request('sortorder');
		if(!$start){
			$start = 1;
		}
		if(!$sortorder)
		{
			$sortorder = 'asc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'Name';
		}
		$search = '';
		if($this->input->post())
		{
			$search = $this->input->post('search');
		}
		else 
		{
			$search = $this->session->userdata('searchdisputes');
		}
		$total_pages = $this->user_model->gettotalguide($search);
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		$targetpage = base_url()."admin/guide/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		$recordall = $this->user_model->getuserguide($start,$search,$limit,$sortorder,$sort);
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('start',$start);
		$this->layout->setData('search',$search);
		$this->layout->setData('guide',$recordall);
		$this->layout->view('admin/guide');
	}
	
	public function Addguide()
	{
		
	
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$this->load->model(array('user_model'));
		$data = $this->input->post();
		if($this->input->post() && $data['name'] !='')
		{
						$this->user_model->Addguide($data);
						$succrmsg = 'Added successfully.';
						redirect(base_url('admin/guide'));
					 
		} 
		$this->layout->view('admin/Addguide',$succrmsg);
	}
	public function Deleteguide()
	{
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->deleteguide($id);
		echo json_encode(array('status'=>true,'ids'=>$id)); 
	}
	
	public function changestatus()
	{
		$id = $this->input->_request('id');
		$this->load->model(array('user_model')); 
		$this->user_model->changestatus($id);
		redirect(base_url('admin/guide'));
	}
	public function guide_edit(){
		$id = $this->input->_request('id');
		 
		if($id<0){
			$id = 1;
		}
		$errormsg = '';
		$this->load->model(array('user_model'));
		if($this->input->post()){
			$data = $this->input->post();
			 
			$this->user_model->guide_edit($data,$id);
			$errormsg = 'Edit successful.';
		}
		 
		$this->load->helper('form');
		$guide = $this->user_model->getGuidebyId($id);
		$this->layout->setData('guide',$guide);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/guide_edit');
	}
	
	public function newinterviewerlist(){
		$this->load->model(array('user_model','class_model'));
		$start = $this->input->_request('start');
		$this->session->unset_userdata('searchmessages');
		$this->session->unset_userdata('searchdisputes');
		$users = array();
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder){
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort){
			$sort = 'id';
		}
		if(!$start){
			$start = 0;
		}
		$search = '';
		
		if($this->input->post()){
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchuser'=>$search));
			
		}
		$users = array();
		$users=$this->user_model->GetAllNewinterviewers($start,$search,$sort,$sortorder);
		
		//echo "<pre>"; print_r($users);die;
		$this->load->library('paginationadmin');
		$config['base_url'] = base_url('admin/newinterviewerlist/start');
		$config['uri_segment'] = 4;
		if($search != ''){
			$config['total_rows'] = $this->user_model->GetCountForNewinterviewer($search);
		}else{
			$config['total_rows'] = $this->user_model->getNewinterviewercount();
		}
		$config['per_page'] = 20; 
		$this->paginationadmin->initialize($config); 
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('start',$start);
		$this->layout->setData('sort',$sort);
		$page = $this->paginationadmin->create_links();
		$this->layout->setData('search',$search);
		$this->layout->setData('page',$page);
		$this->layout->setData('users',$users);
		$this->layout->view('admin/newinterviewerlist');
	}
	
	public function addinterviewer()
	{
			$this->layout->view('admin/newinterviewer');
	}
	
	public function GetNewinterviewersAdmin()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$this->load->model(array('user_model'));
		$Alldata=$this->user_model->GetNewInterviewers($ptn);
		//print_r($Alldata);die;
		echo json_encode($Alldata);
		die();
	}
	
	public function AddnewInterviewer()
	{
		$this->load->model(array('user_model'));
		$uid=$this->input->post('uid');
		$result=$this->user_model->AddTonewInterviewerList($uid);
		if($result)
		{
				echo json_encode(array('success'=>true));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}
	
	public function EditNewInterviewer(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model','profile_model'));
		if($this->input->post()){
		  
			$data = $this->input->post();
			$this->user_model->EditNewInterviewer($data);
			$errormsg = 'Edit User successfully.';
		}
		$data=array();
		$user = $this->user_model->GetInterviewerbyId($id);
		if($user !=array())
		{
			$data=$this->user_model->GetDetailData($user['uid']);
		} 
		$this->layout->setData('user',$user);
		$this->layout->setData('prof',$data);
		$this->layout->setData('errormsg',$errormsg);
		$this->load->helper('form');
		$this->layout->view('admin/newintervieweredit');
	}
	
	public function DelteNewinterviewer(){
		$id = $this->input->_request('id');
		$this->load->model(array('user_model'));
		$this->user_model->deleteNewinterviewer($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function cash()
	{
		$this->load->model(array('pay_model','profile_model','user_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'id';
		}
		$search = '';
		if ($this->input->post()) {
			$search = $this->input->post('search'); 
			$this->session->set_userdata('searchcash',$search);
		} elseif ($this->session->userdata('searchcash')) {
			$search = $this->session->userdata('searchcash');
		}
		$total_pages = $this->pay_model->getTotalDisputes($search);
		if ($this->input->_request('limit')) {
			$limit = $this->input->_request('limit');
		} else {
			$limit = 20;
		}
		
		$targetpage = base_url()."admin/cash/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		$cnd = " `type`='Cashout' and `payment_status` = 'Paid' and `status` != 'Failed' ";
		if ($search!="") {
			$cnd .= " AND `p`.`firstName` LIKE '%".$search."%'";
		}
		$totalRecords = $this->user_model->fnGetTransaction($cnd);
		if(empty($totalRecords))
		{
			$start = 0;
			$totalRecords = $this->user_model->fnGetTransaction($cnd);
		}
		$totalRecords = sizeof($totalRecords);
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$totalRecords,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		$result = $this->user_model->fnGetTransaction($cnd,$start, $limit, $sort, $sortorder);
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('search',$search);
		$this->layout->setData('results',$result);
		$this->layout->view('admin/cash');
	}
	// Video Control Function - Ilyas
	public function video_control() {
		$this->load->model(array('lesson_model'));
		$totalRecords = $this->lesson_model->countVideos();
		if ($this->input->_request('limit')) {
			$limit = $this->input->_request('limit');
		} else {
			$limit = 20;
		}
		$targetpage = base_url()."admin/video_control";
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		$data['videos'] = $this->lesson_model->getAllVideos($start,$limit);
		//paginate review 
		$pagination = $this->paginateReview($targetpage,$totalRecords,$limit,$page,$start);
		$data['pagination'] = $pagination;
		$data['limit'] = $limit;
		$data['page'] = $page;
		$this->layout->view('admin/video_control',$data);
	}
	
	public function chngvideostatus()
	{
		$this->load->model(array('lesson_model'));
		$id = $this->input->post('id');
		if ($id) {
			echo $this->lesson_model->chngvideostatus($id);
		}
	}
	
	public function delvideo(){
		$id = $this->input->post('id');
		$this->load->model(array('lesson_model'));
		$this->lesson_model->delvideoLession($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	// Video Payment
	public function disputeVideoResolution(){
		$this->load->model(array('pay_model','profile_model'));
		$sortorder = $this->input->_request('sortorder');
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'createAt';
		}
		
		$search = '';
		if($this->input->post())
		{
			$search = $this->input->post('search'); 
			$this->session->set_userdata('searchvid',$search);
		} elseif ($this->session->userdata('searchvid')) {
			$search = $this->session->userdata('searchvid');
		}
		$total_pages = $this->pay_model->getTotalDisputesVideo($search);		
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 20;
		}		
		$targetpage = base_url()."admin/disputeVideoResolution/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;		
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		$paymentsAll = $this->pay_model->getAllVideo($start,$search,$limit,$sortorder,$sort);
		if($paymentsAll=='')
		{
			$start = 0;
			$paymentsAll = $this->pay_model->getAllVideo($start,$search,$limit,$sortorder,$sort);
		}
		//paginate review
		$pagination = $this->paginateReview($targetpage,$total_pages,$limit,$page,$start);
		$this->layout->setData('pagination',$pagination);
		$this->layout->setData('limit',$limit);
		if($paymentsAll)
		{
			$payments = array();
			$i = 0;
			foreach ($paymentsAll as $payf)
			{
				$user = $this->profile_model->getProfile(@$payf['sid']);
				$payments[$i]['student'] = @$user['firstName'].' '.@$user['lastName'];				
				$user1 = $this->profile_model->getProfile(@$payf['tid']);
				$payments[$i]['tutor'] = @$user1['firstName'].' '.@$user1['lastName'];
				$payments[$i]['tutorhRate'] = (@$payf['t_hrate'] > 0) ? @$payf['t_hrate'] : "0.00";
				$payments[$i]['status'] = @$payf['p_status'];
				$payments[$i]['creatAt'] = @$payf['createAt'];
				$payments[$i]['approve'] = @$payf['approve'];
				$payments[$i]['postpone'] = @$payf['postpone'];
				$payments[$i]['PayDate'] = @$payf['PayDate'];
				$payments[$i]['is_Deleted'] = @$payf['is_Deleted'];
				$payments[$i]['id'] = @$payf['id'];
				$payments[$i]['type'] = @$payf['type'];			
				$payments[$i]['money'] = @$payf['fee'];
				$action = unserialize(@$payf['action']);				 
				if($action['studentConnected']==1)
				{
					$payments[$i]['sconnect']='Y';
				}
				else
				{
						$payments[$i]['sconnect']='N';
				}
				$i++;
			}
		}		
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);		
		$this->layout->setData('search',$search);
		$this->layout->setData('payments',$payments);
		$this->layout->view('admin/disputeVideoResolution');
	}
	
	public function testimonials(){
		$this->load->model(array('testimonial_model'));
		$data['testimonials'] = $this->testimonial_model->getAll();
		$this->layout->view('admin/testimonials',$data);
	}
	public function fnAddTestimonial($id=""){
		$this->load->model(array('testimonial_model'));
		if ($this->input->post('title')) {
			$insert['title'] = $this->input->post('title');
			$insert['description'] = $this->input->post('description');
			$insert['author'] = $this->input->post('author');
			$insert['website'] = $this->input->post('website');	
			
			if ($this->input->post('id') > 0) {
				$insert['id'] = $this->input->post('id');
				$this->testimonial_model->updateTestimonial($insert);
			} else {
				$this->testimonial_model->insertTestimonial($insert);
			}
			redirect("admin/testimonials");
			exit;
		}
		$data = array();
		if ($id > 0) {
			$record = $this->testimonial_model->getTestimonial($id);
			$data['testimonial'] = $record[0];
		}			
		//$data['testimonials'] = $this->testimonial_model->getTestimonial($id);
		//$this->layout->setData('errormsg',$errormsg);
		$this->layout->view('admin/addtestimonial', $data);
	}
	public function fnDelTestimonial(){
		$id = $this->input->post('id');
		$this->load->model(array('testimonial_model'));
		$this->testimonial_model->delTestimonial($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function userstatement($userId){
		if(!$this->user){
			redirect('user/login');
		}
		$this->load->model(array('class_model','user_model'));
		$data['profile']= $this->user_model->getByprofileUid($userId);
		$data['transactions'] = $this->class_model->getMemberTransaction($userId);
		$this->layout->view('admin/user_statement', $data);
	}
	
	// List of contests
	public function contests() {
		$this->load->model('contests_model');
		$contests = $this->contests_model->getAll();
		$this->layout->setData('contests',$contests);
		$this->layout->view('admin/contests');
	}
	
	// Contests Add
	public function contests_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('contests_model'));
		if($_POST):
			if ($errorStatus == false) {
				if($this->input->post()){
					$data = $this->input->post();
					$data['status'] = $this->input->post('status');
					if(isset($_FILES) && $_FILES['image_file']!='') 
					{
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/images/';
						$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
						$upConfig['encrypt_name'] = true;
						if($_FILES['image_file']['size']!=''){
							$infos = $this->media->upload($upConfig,'image_file');
							if(!$this->media->error){
								$mediaInfo = $this->media->data['upload_data'];
								$data['image'] = $this->media->sqlAddress;
								$this->load->model('media_model');
								$mediaInfo = $this->media->data['upload_data'];
								$mediaInfo['uid'] = $this->session->userdata('adminUid');
								$mediaInfo['address'] = $this->media->sqlAddress;
								$this->media_model->save($mediaInfo);
							}else {
								$errormsg = $this->media->error['error'].'2';
							}
						}
					}
					if(!$errormsg) {
						$this->contests_model->contests_add($data);
						$succrmsg = 'Add successfully.';
					}
				}
			}
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/contests_add');
	}
	
	
	public function contests_edit(){
		$timestamp=time();
		$id = $this->input->_request('id');
		if($id<0){
			$id = 1;
		}
		$this->load->model(array('contests_model'));
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):
			if ($errorStatus == false) {
				if($this->input->post()){
					$data = $this->input->post();
					if(isset($_FILES) && $_FILES['image_file']['size']!=''){
						$this->load->library('media','upload');
						$upConfig['upload_path'] = FCPATH.'uploads/images/';
						$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
						$upConfig['encrypt_name'] = true;
						$infos = $this->media->upload($upConfig,'image_file');
						if(!$this->media->error){
							$data['image'] = $this->media->sqlAddress;
							$this->load->model('media_model');
							$mediaInfo = $this->media->data['upload_data'];
							$mediaInfo['uid'] = $this->session->userdata('adminUid');
							$mediaInfo['address'] = $this->media->sqlAddress;
							$this->media_model->save($mediaInfo);
						}
						else {
							$errormsg = $this->media->error['error'];
						}
					}
			
					if(!$errormsg) {
						unset($data['contests_file']);
						$this->contests_model->contests_edit($data,$id);
						$succrmsg = 'Edit success.';
					}
				}
		
			}
		endif;
		$ad = $this->contests_model->get($id);
		if($id < 10){
			$index = $id;
		}
		else {
			$index = 0;
		}
		$this->layout->setData('index',$index);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('ad',$ad);
		$this->layout->view('admin/contests_edit');
	}
	
	// Contests Del
	public function contests_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('contests_model'));
		$this->contests_model->del($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function listCategories()
	{
		$start = $this->input->_request('start');
		$this->load->model(array('user_model'));
		$this->session->unset_userdata('searchuser');
		$this->session->unset_userdata('searchmessages');
		$sortorder = $this->input->_request('sortorder');
		if(!$start){
			$start = 1;
		}
		if(!$sortorder)
		{
			$sortorder = 'desc';
		}
		$sort = $this->input->_request('sort');
		if(!$sort)
		{
			$sort = 'id';
		}
		if($this->input->_request('limit'))
		{
			$limit = $this->input->_request('limit');
		}else{
			$limit = 10;
		}
		$targetpage = base_url()."admin/listcategories/sortorder/".$sortorder."/sort/".$sort."/limit/".$limit;
		$page = $this->input->_request('page');
		if($page)
			$start = ($page - 1) * $limit; 			
		else
			$start = 0;								
		
		
		$this->load->model(array('category_model'));
		$search='';
		$categories = $this->category_model->GetCategories($start,$limit,$sortorder,$sort);
		$this->layout->setData('categories',$categories);
		$this->layout->setData('sortorder',$sortorder);
		$this->layout->setData('sort',$sort);
		$this->layout->setData('limit',$limit);
		$this->layout->setData('page',$page);
		$this->layout->setData('start',$start);
		$this->layout->view('admin/listcategories');
	}
	
	public function addCategory(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$this->load->model(array('category_model'));
		if($_POST):
			/*$ftype = 'pfile';
			if ($_FILES['pfile']['name']=='') 	{
				$errormsg = 'PDF is required.';
				$errorStatus = true;
			}
			if (trim($this->input->post('Description'))=='') {
				$errormsg= 'PDF description is required.';
				$errorStatus = true;
			}*/
			if (trim($this->input->post('category'))=='') {
				$errormsg= 'Category is Required.';
				$errorStatus = true;
			}			
		
		
			if ($errorStatus == false and $_FILES['pfile']['name']!="") { 
				$config['upload_path'] = FCPATH.'uploads/categories/';
				$config['allowed_types'] = 'pdf';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("pfile")) {
					$error = $this->upload->display_errors();
					$errormsg = $error;
				} else {
					$data = array('upload_data' => $this->upload->data());
					$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$file_name = $data['upload_data']['file_name'];
					$data["pfile"] = $img['file_name'];
					$data1['pfile'] = $data['upload_data']['file_name'];				
				}				
			}
			//$data1['Description'] = $this->input->post('Description');
			//$data1['Title']       = $this->input->post('Title');
			//$data1['rtype']        = 'S';
			$data1['status']       = $this->input->post('status');
			$data1['ptitle']       = $this->input->post('ptitle');
			
			//$data1['lang']       = $this->input->post('lang');
			//$data1['orderNo']       = $this->input->post('orderNo');
			$data1['category']       = $this->input->post('category');
			$this->category_model->addcategory($data1);
			@$_POST = '';
			$succrmsg = 'Added successfully.';
			redirect("admin/listcategories");
			exit;
		endif;
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->view('admin/addcategory');
	}
	
	public function editcategory(){
		$id = $this->input->_request('id');
		if($id<0){ $id = 1; }
		$errormsg 		= '';
		$succrmsg 		= '';
		$errorStatus 	= false;
		$this->load->model(array('category_model'));
		if($_POST):
			if ($_FILES['pfile']['name'] !='')  
			{
				$config['upload_path'] = FCPATH.'uploads/categories/';
				$config['allowed_types'] = 'pdf';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("pfile")) {
					$error =$this->upload->display_errors();						 
					$errormsg=$error;
				} else {
					$unlink="select pfile from `categories` where `id`={$id}";
					$query 	= $this->db->query($unlink);
					if ( $query->num_rows() > 0) {
						$result = $query->row_array();
						unlink(FCPATH.'uploads/categories/'.$result['pfile']);
					}
					$data = array('upload_data' => $this->upload->data());
					$img = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$file_name = $data['upload_data']['file_name'];
					$data1['pfile'] = $data['upload_data']['file_name'];				
				}
			}
			/*$data1['rtype'] = $this->input->post('rtype') ;
			
			$data1['Description']        = $this->input->post('Description') ;
			$data1['rtype']        = 'S' ;
			$data1['orderNo']       = $this->input->post('orderNo') ;*/
			$data1['status']       = $this->input->post('status') ;
			$data1['ptitle']       = $this->input->post('ptitle') ;
			//$data1['lang']       = $this->input->post('lang') ;
			$data1['category']       = $this->input->post('category') ;
			$this->category_model->editcategory($data1,$id);
			$succrmsg = 'Category edited successfully.';
			redirect("admin/listcategories");
			exit;
		endif;
		$EditData = $this->category_model->Getcategoryedit($id);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('succrmsg',$succrmsg);
		$this->layout->setData('EditData',$EditData);
		$this->layout->view('admin/editcategory');
	}
	
	public function deletecategory(){
		$id = $this->input->_request('id');
		$this->load->model(array('category_model'));
		$this->category_model->delcategory($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	/* languageAndCulture */
	function languageAndCulture() {
		$this->load->model('languageandculture_model');
		$blogs = $this->languageandculture_model->getAllData();
		$this->layout->setData('blogs',$blogs);
		$this->layout->view('admin/languageandcultures');
	}
	
	/* Add/Edit languageAndCulture*/
	public function addLanguageAndCulture(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('languageandculture_model'));
		$edata = array();
		if ($this->uri->segment(3) and $this->uri->segment(3)>0) {
			$edata = $this->languageandculture_model->selectData("*",array("id"=>$this->uri->segment(3)));
		}
		if ($this->input->post()) {
			$data = $this->input->post();
			$edata[0] = $data;
			if (isset($_FILES) && $_FILES['image']!='') {
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/languageandculture/';
				$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
				$upConfig['encrypt_name'] = true;
				if($_FILES['image']['size']!=''){
					$infos = $this->media->upload($upConfig,'image');
					if(!$this->media->error){
						$data['image'] = $this->media->sqlAddress;
						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] = $this->session->userdata('adminUid');
						$mediaInfo['address'] = $this->media->sqlAddress;
						$this->media_model->save($mediaInfo);
						if ($edata[0]['image']) {
							unlink(FCPATH.'uploads/languageandculture/'.$edata[0]['image']);
						}
					}else {
						$errormsg = $this->media->error['error'];
						$this->layout->setData('errormsg',$errormsg);
					}
				}
			}
			if(!$errormsg) {
				if ($this->input->post('id')>0 and $this->uri->segment(3)==$this->input->post('id')) {
					$this->languageandculture_model->updateData($data, "id = '".$this->input->post('id')."'");
					$succrmsg = 'Update Successfully.';
					redirect('admin/languageAndCulture');
				} else {				
					$this->languageandculture_model->insertData($data);
					$succrmsg = 'Add Successfully.';
					redirect('admin/languageAndCulture');
				}
				exit;
			}
		}
		$this->layout->setData('data',$edata);
		$this->layout->view('admin/addlanguageandculture');
	}
	
	// Delete languageAndCulture
	public function delLanguageAndCulture(){
		$id = $this->input->_request('id');
		$this->load->model(array('languageandculture_model'));
		$this->languageandculture_model->delData($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	/* notifications */
	function notifications() {
		$this->load->model('notifications_model');
		$notifications = $this->notifications_model->getAllData();
		$this->layout->setData('notifications',$notifications);
		$this->layout->view('admin/notifications');
	}
	
	/* Add/Edit notifications*/
	public function addnotifications(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		$data = array();
		$this->load->model(array('notifications_model'));
		$edata = array();
		if ($this->uri->segment(3) and $this->uri->segment(3)>0) {
			$edata = $this->notifications_model->selectData("*",array("id"=>$this->uri->segment(3)));
		}
		if ($this->input->post()) {
			$data = $this->input->post();
			if (isset($_FILES) && $_FILES['image']!='') {
				$this->load->library('media','upload');
				$upConfig['upload_path'] = FCPATH.'uploads/notifications/';
				$upConfig['allowed_types'] = 'jpg|png|jpeg|bmp';
				$upConfig['encrypt_name'] = true;
				if($_FILES['image']['size']!=''){
					$infos = $this->media->upload($upConfig,'image');
					if(!$this->media->error){
						$data['image'] = $this->media->sqlAddress;
						$this->load->model('media_model');
						$mediaInfo = $this->media->data['upload_data'];
						$mediaInfo['uid'] = $this->session->userdata('adminUid');
						$mediaInfo['address'] = $this->media->sqlAddress;
						$this->media_model->save($mediaInfo);
						if ($edata[0]['image']) {
							unlink(FCPATH.'uploads/notifications/'.$edata[0]['image']);
						}
					}else {
						$errormsg = $this->media->error['error'].'2';
					}
				}
			}
			if(!$errormsg) {
				if ($this->input->post('id')>0 and $this->uri->segment(3)==$this->input->post('id')) {
					$this->notifications_model->updateData($data, "id = '".$this->input->post('id')."'");
					$succrmsg = 'Update Successfully.';
					redirect('admin/notifications');
				} else {				
					$this->notifications_model->insertData($data);
					$succrmsg = 'Add Successfully.';
					redirect('admin/notifications');
				}
				exit;
			}
		}
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->setData('data',$edata);
		$this->layout->view('admin/addnotifications');
	}
	
	// Delete notifications
	public function delnotifications(){
		$id = $this->input->_request('id');
		$this->load->model(array('notifications_model'));
		$this->notifications_model->delData($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function metatag() {
		$this->load->model(array('metatag_model','langs_model'));
		$selectedLang = 'en';
		$langreq = trim($this->input->post('langreq'));
		if($langreq){
			$this->session->set_userdata(array('langreq'=>$langreq));
		}else{
			$langreq = $this->session->userdata('langreq');
		}
		$search = '';
		if (!$this->input->post("search") and !$this->uri->segment(4)) {
			$search = '';
			$this->session->unset_userdata('searchlng');
		} else if ($this->input->post("search")) {
			$search = trim($this->input->post('search'));
			$this->session->set_userdata(array('searchlng'=>$search));
		} else {
			$search = $this->session->userdata('searchlng');
		}
		if($langreq != ''){
			$selectedLang = $langreq;
		}
		$start = $this->input->_request('start');
		if(!$start){
			$start = 0;
		}
		$metatag = $this->metatag_model->getAll($start,"15",$search);
		// Pagination Start
		$this->load->library('pagination');
		$config['base_url'] = base_url('admin/metatag/start');
		$config['uri_segment'] = 4;
		$config['total_rows'] = $this->metatag_model->getCount($search);
		$config['per_page'] = 15; 
		$config['num_links'] = 20;
		$this->pagination->initialize($config);
		$page = $this->pagination->create_links();
		// Pagination End
		$langs = $this->langs_model->getLangs(2);
		$options = array(
                  'en'    => 'English',
				  'es' => 'Español',
				  'ch'   => '简体中文',
                  'tw' => '繁體中文',
				  'jp' => '日本語',
				  'kr'    => '한국어',
                  'pt' => 'Português',
				  'fr' => 'français',
                );
		$seloectedlangPass = array();		
		foreach($options as $key => $value){
			$optId = $key; 
			$optValue = $value; 
			if($optId == $selectedLang){
				$option .= '<option value="'.$optId.'" selected="selected">'.$optValue.'</option>';
				$seloectedlangPass['id'] = $selectedLang;
				$seloectedlangPass['value'] = $optValue;
			}else{
				$option .= '<option value="'.$optId.'">'.$optValue.'</option>';
			}
		}
		$langSelect = '<select name="language" id="language" style="margin-right:10px;height:20px;">'.$option.'</select>';
		$this->layout->setData('langSelect',$langSelect);
		$this->layout->setData('selectedLang',$seloectedlangPass);
		$this->layout->setData('page',$page);
		$this->layout->setData('errormsg',$errormsg);
		$this->layout->setData('metatag',$metatag);		
		$this->layout->setData('search',$search);
		$this->layout->view('admin/metatag');
	}
	

	public function metatag_add(){
		$this->load->library('ckeditor');
		$ckEditor =  new CKEditor();
		$ckEditor->basePath = base_url('js/ckeditor').'/';
		$this->load->model(array('metatag_model'));		
		if($this->input->post("url")){
			$this->input->post("lng");
			$data1 = array(
				"url"=>$this->input->post("url"),
				"title"=>$this->input->post("title"),
				"keywords"=>$this->input->post("keywords"),
				"descriptions"=>$this->input->post("descriptions"),				
			);
			$lng = $this->input->post("lng");
			$data2 = array();
			if($lng!="en") {
				$data2 = array(
					$lng."_title"=>$this->input->post($lng."_title"),
					$lng."_keywords"=>$this->input->post($lng."_keywords"),
					$lng."_descriptions"=>$this->input->post($lng."_descriptions"),				
				);
			}
			$data = array_merge($data1,$data2);
			if($this->input->post("id")){
				$id = $this->input->post("id");
				$this->metatag_model->updateData($data,array("id" =>$id));
				$this->session->set_flashdata('msg', 'Successfully Updated.');				
				redirect("admin/metatag");	
			} else {
				$id = $this->input->post("id");
				$this->metatag_model->insertData($data,$id);
				$this->session->set_flashdata('msg', 'Successfully Added.');
				redirect("admin/metatag");				
			}
		}
		$edata = array();
		$lng = "en";
		if ($this->uri->segment(3) and $this->uri->segment(3)>0) {
			
			if($this->uri->segment(4)){
				$lng = $this->uri->segment(4);
			}
			$edataAr = $this->metatag_model->selectData("*",array("id"=>$this->uri->segment(3)));
			if(sizeof($edataAr)>0){
				$edata = $edataAr[0];
			}
		}
		$options = array(
                  'en'    => 'English',
				  'es' => 'Espanol',
				  'ch'   => '????',
                  'tw' => '????',
				  'jp' => '???',
				  'kr'    => '???',
                  'pt' => 'Portuguese',
				  'fr' => 'français',
                );
		$seloectedlangPass = array();
		$this->layout->setData('options',$options);
		$this->layout->setData('selectedLang',$lng);
		$this->layout->setData('ckEditor',$ckEditor);
		$this->layout->setData('metatag',$edata);
		$this->layout->view('admin/metatag_edit');
	}
	
	// Delete metatag
	public function metatag_del(){
		$id = $this->input->_request('id');
		$this->load->model(array('metatag_model'));
		$this->metatag_model->delData($id);
		echo json_encode(array('status'=>true,'ids'=>$id));
	}
	
	public function delaffiliate()
	{
		$id = $this->input->_request('id');
		$this->load->model(array('pay_model'));
		$this->pay_model->delaff($id);
		echo json_encode(array('status'=>true,'ids'=>$id)); 
	}
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */