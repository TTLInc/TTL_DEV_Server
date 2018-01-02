<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserChat extends TL_Controller {
	public $user = array();
	public function __construct() {
		parent::__construct();
		$this->load->model(array('user_model','profile_model','langs_model'));
		if($this->input->uri->segments[2] != 'login' && $this->input->uri->segments[2] != 'register'){
			$this->user = $this->check_login(false);
		}
		@$this->uid = $this->input->_request('uid') ? $this->input->_request('uid') : $this->user['uid'];		//var_dump($this->user);

		if( isset($this->user['uid']) && $this->user['uid'] !=null && $this->uid == $this->user['uid'] ){
			$this->own = true;
		}else{
			$this->own = false;
		}
		$this->layout->setData(array('own'=>$this->own));
		$this->layout->setLayoutData('linkAttr','user');
	}
	
	function chat_group()
	{
		//$this->disableLayout = TRUE;
		$this->layout->setLayout('none');
		if(!$this->user){
			redirect('user/login');
		}
		$gid = $this->input->_request('gid');
		$uid = $this->uid;
		
		$this->load->model(array('dchatmodel','profile_model'));
		$this->layout->setData('gid',$gid);
		
		if($gid == '' || $gid == 1)
		{
			$myGroups = $this->dchatmodel->getGroups($uid);
			$this->layout->setData('myGroups',$myGroups);
			
			
		}
		
		$onlineUsersData = $this->getOnlineUsers();
			$onlineUsers = array();
			if($onlineUsersData)
			{
				$u = 0;
				foreach($onlineUsersData as $udataid)
				{
					if($udataid == $uid)
					{
						continue;
					}else{
						$onlineUserDataRecord = $this->profile_model->getProfile($udataid);
						$onlineUsers[$u]['uid'] = $udataid;
						$onlineUsers[$u]['pic'] = $onlineUserDataRecord['pic'];
						$onlineUsers[$u]['welcomeuser'] = $onlineUserDataRecord['firstName'].' '.$onlineUserDataRecord['lastName'];
						$queryInv = $this->dchatmodel->getInvitation($udataid);
						if($queryInv){
							if ($queryInv->num_rows() > 0) {
								$onlineUsers[$u]['invitationStatus'] = 1;
							}else{
								$onlineUsers[$u]['invitationStatus'] = 0;
							}
						}
						$queryInvStatus = $this->dchatmodel->getInvitationStatus($udataid);
						if($queryInvStatus){
							//echo '<pre>';
							//print_r($queryInvStatus);exit;
							$onlineUsers[$u]['chatInvitationStatus'] = $queryInvStatus[0]['status'];
						}
					}
					$u++;
				}
				$this->layout->setData('onlineUsers',$onlineUsers);
			}
		$this->_profile();
		
		$permission = $this->getPermission($this->uid);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$chat_name = '';
		$owner_message = '';
		
		$this->layout->view('userchat/chatgroup');
	}
	public function getOnlineUsers()
	{
		$sql = "select DISTINCT uid from ci_sessions where uid!=''";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results[] = $v['uid'];
			}
			//var_dump($results);
		}
		return $results;
		
	}
	public function _profile() {
		//check session
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$this->uid) {
			redirect('user/login');
		}

		$profileModel = $this->profile_model;
		$uid = $this->uid;//$this->session->userdata('uid');

		/*if($this->input->post()) {
			$formData = $this->input->post();
			$formData['uid'] = $uid;
			$profileModel->update($formData);
		}*/
		$user = $userModel->getByUid($uid);
		$profile = $profileModel->getProfile($uid);
		$data['free_session'] = $profile['free_session'];
		$profile = array_merge($profile,$user);
		$langs = $this->langs_model->getLangs();
		$this->load->model('location_model');
		$countries= $this->location_model->getCountries(0);
		$profile['country'] = isset($profile['country'])?$profile['country']:0;
		$province[$profile['country']] = $this->location_model->getProvices($profile['country']);
		$data['profile'] = $profile;
		$data['langs'] = json_encode($langs);
		$data['countries'] = $countries;
		$data['province'] = $province;
		$this->layout->setData($data);
		$config = $this->location_model->getConfig();
		$this->layout->setData('config',$config);
		//$this->layout->view('user/profile',$data);
	}
	
	public function getPermission($uid){
		$userInfo = $this->user_model->getByUid($uid);
		if(!isset($userInfo['roleId'])){
			return 'invalidUser';
		}
		$role = 'student';
		switch($userInfo['roleId']){
			case 0 : $role = 'student';break;
			case 1 : $role = 'teacher';break;
			case 2 : $role = 'teacher';break;
			default : $role = 'teacher';break;
		}
		$type = 'private';
		if($uid != $this->user['uid']) {
			$type = 'public';
		}
		return  $role.'_'.$type;
	}
	
}
/* End of file user.php */
/* Location: ./application/controllers/user.php */
