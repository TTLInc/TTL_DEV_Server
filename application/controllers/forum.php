<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Forum extends TL_Controller {
	public function __construct(){
		parent::__construct();
		@session_start();
		$this->template['module']	= 'forum';
		$this->load->model('forum_model', 'forum');
		$this->load->model('topic_model', 'topic');
		$this->load->model('message_model', 'message');
		$this->load->model('inbox_model', 'inbox');
		$this->load->model('user_model','user');
		$this->load->library("bbcode");
		$this->load->model(array('lookup_model'));
		$this->layout->setLayoutData('linkAttr','support');
	}

	function index(){$this->topics();}

	
	function topics(){
	    $un = 'admin';
		$this->layout->setData('title',"Forum");
		$params = array(
			'where' => "username =  '" . $un . "'  ",
			'order_by' => 'title'
		);
		$paramsGENERAL = array(
			'where' => "category =  'General Discussion - Questions and help' ",
			'order_by' => 'title'
		);
		$paramsTTL = array(
			'where' => "category =  'TheTalklist - Official announcements' ",
			'order_by' => 'title'
		);
		
		
		//$this->layout->setData('rows',$this->topic->get_list($params));
		$this->layout->setData('rowsTTL',$this->topic->get_listTTL($paramsTTL));
		$this->layout->setData('rowsGENERAL',$this->topic->get_listGENERAL($paramsGENERAL));
		$this->layout->view('topic/list');
	}

	function topic($action = null, $start = 0){
		switch ($action){
			case "add":
			case "create":
				$this->chkULogin();
				$tid = $start;
				$this->layout->setData('title',"Create a new topic");
				$this->layout->setData('topic',$this->topic->fields['forum_topics']);
				if($tid !== 0){
					$this->layout->setData('topic',$this->topic->get_topic($tid));
				}
				if($this->session->userdata('username') != ""){
					$this->layout->view('topic/create');
				}else{
					$this->layout->view('forum/error');
				}

				
			break;
			case "save":
				$data = array();
				$data['category'] = $this->input->post('category');
				if($tid = $this->input->post('tid')){
					$topic = $this->topic->get_topic($tid);
					$data['tid'] = $topic['tid'];
				}
				foreach($this->topic->fields['forum_topics'] as $key => $val){
					if($this->input->post($key) !== FALSE){
						$data[$key] = $this->input->post($key);
					}
				}
				if($data['tid']){
					$this->topic->update_topic($data['tid'], $data);
				}
				else{
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$ue    = $fUser[0];
				
					//$data['date'] 			= gmdate('d M Y H:i:s \G\M\T', time());
					$data['date'] 			   = date("Y-m-d H:i:s", time());
					$data['username'] 		= $un;
					$data['email'] 			= $ue;
					$data['tid'] = uniqid('t');
					$this->topic->save($data);
					
					//---Add New Message to Topic
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$um    = $fUser[0];
					$dataM['mid'] 			= uniqid('m');
					$dataM['username'] 		= $un;
					$dataM['email'] 		= $um;
					$dataM['last_date'] 	= date("Y-m-d H:i:s", time());
					$dataM['date'] 			= date("Y-m-d H:i:s", time());
					$dataM['last_username'] = $un;
					$dataM['last_mid'] 		= $dataM['mid'];
					$dataM['notify'] 		= $this->input->post('notify');
					$dataM['title'] 		= $this->input->post('title');
					$dataM['tid'] 			= $data['tid'];
					$dataM['message'] 		= $this->input->post('description');

					$this->message->save($dataM);
					$this->topic->update_topic($dataM['tid'], array('last_mid' => $this->db->escape($dataM['last_mid']), 'last_username' => $this->db->escape($un), 'last_date' => $this->db->escape($dataM['last_date']), 'messages' => '1'), false);
	
					//---Add New Message to Topic
					
					
					
					
				}
				$this->session->set_flashdata("Topic saved succesfully");
				//redirect('forum/topics');
				redirect('forum/topic/' . $data['tid']);
				//redirect('forum/message/' . $dataM['mid']);
				break;
			case "delete":
				$this->template['title'] = "Delete topic";
				$tid = $start;
				if($tid === 0){
					$this->layout->setData('message',"Please specify a topic");
					$this->layout->view('forum/error');
					return;
				}
				//$this->check_level('forum', LEVEL_DEL);
				$messages = $this->message->get_total(array('where' => array ('tid' => $tid)));
				if ($nb_msg >0){
					$this->layout->setData('message',"The topic is not empty. Delete all messages in it then try again.");
					$this->layout->view('forum/error');
					return;
				}

				if($confirm > 0){
					$this->topic->delete(array('tid' => $tid));
					$this->session->set_flashdata('notification', "Topic deleted successfully");
					redirect('forum/topics');
					return;

				}
				else{
					$this->layout->view('topic_delete');
					return;
				}
			break;
			case "edit":
				$tid = $start;
				if($tid === 0){
					$this->layout->setData('message',"Please specify a topic.");
					$this->layout->view('forum/error');
					return;
				}
				//$this->user->check_level('forum', LEVEL_EDIT);
				if($topic = $this->topic->get(array('where' => array('tid' => $tid), 'limit' =>1))){
					$this->layout->setData('topic',$topic);
					$this->layout->view('topic_add');
				}
				else{
					$this->layout->setData('message',"Topic not found.");
					$this->layout->view('forum/error');
					return;

				}
			break;

			default:
				$tid = $action;
				if (is_null($tid) || $tid === 0){
					redirect ('forum/topics');
					return true;
				}
				$per_page = 20;
				$un = 'admin';
				$params = array(
				//'where' => "tid = '" . $tid . "' AND (username = '" .$un. "') ",
				'where' => "tid = '" . $tid . "'",
				'order_by' => 'title'
				);

				
				if ($topic = $this->topic->get($params)){
					$this->layout->setData('topic',$topic);
				}
				else{
					$this->layout->setData('title',"Not authorized");
					$this->layout->setData('message',"You cannot view this topic or the topic does not exist.");
					$this->layout->view('forum/error');
				}

				//now get messages
				$params = array(
				//'where' => "tid = " . $this->db->escape($topic['tid']) . " AND pid = '' ",
				'where' => "tid = " . $this->db->escape($topic['tid']) . "  ",
				'order_by' => 'id asc',
				'limit' => $per_page,
				'start' => $start
				);


				if($messages = $this->message->get_list($params)){
					$this->load->library('pagination');
					$config['uri_segment'] 		= 4;
					$config['first_link'] 		= 'First';
					$config['last_link'] 		= 'Last';
					$config['base_url'] 		= base_url() . 'forum/topic/' . $tid ;
					$config['total_rows'] 		= $this->message->get_total($params);
					$config['per_page'] 		= $per_page;

					$this->pagination->initialize($config);
					
					$this->layout->setData('messages',$messages);
					$this->layout->setData('title',$topic['title']);
					$this->layout->setData('category',$topic['category']);
					$this->layout->setData('start',$start);
					$this->layout->setData('pager',$this->pagination->create_links());
					$this->layout->view('topic/index');
				}else{
					//echo 'Hi';exit;
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message available in this topic<br/>");
					$this->layout->setData('idAddNew',$tid);
					$this->layout->view('forum/error');
				}
			break;
		}

	}

	function _write_header()
	{
	return true;
	}


	function message($action = 'list', $start = 0, $confirm = 0){
		switch($action){
			case "reply":
				//$this->user->require_login();
			    $mid = $start;
			    $quote = $confirm;
			    if ($mid === 0){
					$this->layout->setData('title',"Reply error");
					$this->layout->setData('message',"You did not choose a message to reply to");
					$this->layout->view('forum/error');
					return;
			    }
			    $message = $this->message->get_message($mid);
			    if($message === false){
					$this->layout->setData('title',"Reply error");
					$this->layout->setData('message',"Message not found");
					$this->layout->view('forum/error');
					return;
			    }
			    $reply = $this->message->fields['forum_messages'];
			    if ($quote !== 0 && $tmp = $this->message->get_message($quote)){
					$reply['message'] = "\n\n[quote]\n" . $tmp['message'] . "\n[/quote]";
					$reply['message'] = "\n\n[quote]\n" . $tmp['message'] . "\n[/quote]";
			    }
			    $reply['pid'] = $message['mid'];
			    $reply['title'] = "Re: " . $message['title'];

				//$un = 'admin';
				$fUser = $this->chkULogin();
				$un    = $fUser[1];
				$ue    = $fUser[0];
				
			    $params = array(
			    'where' => "tid = '" . $message['tid'] . "' AND (username = '" . $un . "' ) ",
			    'order_by' => 'title'
			    );
			    $topic = $this->topic->get($params);
			    if($topic === false){
					$this->layout->setData('title',"Posting error");
					$this->layout->setData('message',"You are not allowed to reply the message");
					$this->layout->view('forum/error');
					return;
			    }
				$this->layout->setData('topic',$topic);
				$this->layout->setData('message',$reply);
				$this->layout->setData('title',$reply['title']);
				$this->layout->view('message/create');

			break;
			case "add":
			case "new":
				//$this->user->require_login();
				$this->chkULogin();
				$this->layout->setData('title',"Create a new message");
				$tid = $start;
				$topic = false;
				if ($tid != '0'){
					//$un = 'admin';
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$ue    = $fUser[0];
					$params = array(
					'where' => "tid = '" . $tid . "' AND (username = '" . $un . "') ",
					'order_by' => 'title'
					);
					$topic = $this->topic->get($params);
				}
				//$un = 'admin';
				$fUser = $this->chkULogin();
				$un    = $fUser[1];
				$ue    = $fUser[0];
				
				
				$this->layout->setData('message',$this->message->fields['forum_messages']);
				$params = array(
					'where' => "(username = '" . $un . "') ",
					'order_by' => 'title'
					);
				$topics = $this->topic->get_list($params);

				if($topics === false){
					$this->layout->setData('title',"Posting error");
					$this->layout->setData('message',"There is no topic available");
					$this->layout->view('forum/error');
				    return;
				}
				$this->layout->setData('topic',$topic);
				$this->layout->setData('topics',$topics);
				
				if($this->session->userdata('username') != ""){
					$this->layout->view('message/create');
				}else{
					$this->layout->setData('title',"Not authorized");
					$this->layout->setData('message',"Please login to enter Forum issues.");
					$this->layout->view('forum/error');
				}
				return;

			break;
			case "edit":

				$mid = $start;
				if($mid === 0){
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
					'where' => "tid = '" . $message['tid'] . "'"
				);
				
				$topic = $this->topic->get($params);
				/*
				if($this->user->level['forum'] < LEVEL_EDIT && !isset($this->user->forum_level[ $topic['tid'] ]) && ($message['username'] != $this->user->username))
				{
					$this->template['title'] = __("Error", "forum");
					$this->template['message'] = __("You cannot edit this message", "forum");
					$this->layout->load($this->template, 'error');
					return;
				}
				*/
				$this->layout->setData('title','Edit message');
				$this->layout->setData('topic',$topic);
				$this->layout->setData('message',$message);
				$this->layout->view('message/create');
				
				return;
			break;
			case "save":
				//$this->user->require_login();
				$title 		= strip_tags($this->input->post('title'));
				$message 	= strip_tags($this->input->post('message'));
				$tid 		= $this->input->post('tid');
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
					'tid' 		=> $tid,
					'pid' 		=> $this->input->post('pid'),
					'date' 		=> date("Y-m-d H:i:s", time()),
					'title' 	=> $title,
					'message' 	=> $message
				);
				
				if($this->input->post('mid')){
					$data['mid'] = $this->input->post('mid');
					$this->message->update_message($data['mid'], $data);
				}
				else{
					//$un 					= 'admin';
					//$um 					= 'admin@mail.com';
					//echo '<pre>';print_r($_POST);exit;
					$fUser = $this->chkULogin();
					$un    = $fUser[1];
					$um    = $fUser[0];
					
					
					$data['mid'] 			= uniqid('m');
					$data['username'] 		= $un;
					$data['email'] 			= $um;
					$data['last_date'] 		= $data['date'];
					$data['last_username'] 	= $un;
					$data['last_mid'] 		= ($data['pid'])? $data['pid'] . '#' . $data['mid']: $data['mid'];
					$data['notify'] 		= $this->input->post('notify');
					$this->message->save($data);
					$this->topic->update_topic($tid, array('last_mid' => $this->db->escape($data['last_mid']), 'last_username' => $this->db->escape($un), 'last_date' => $this->db->escape($data['date']), 'messages' => 'messages+1'), false);
					if($data['pid']){
						$this->message->update_message($data['pid'],  array('last_mid' => $this->db->escape($data['last_mid']), 'last_username' => $this->db->escape($un), 'last_date' => $this->db->escape($data['date']), 'replies' => ' replies + 1'), false);
					}
					if($data['pid']) $this->message->notify($data['pid']);
				}
				//--Send beep box
				$t 				= $this->topic->get_topic($tid);
				$uIdm 			= $this->user->getEmail($t['email']);
				$toMessageId 	= $uIdm['id'];
				$fromMessageId 	= $fUser[2];
				$subject        = 'Re:'.$t['title'];
				$message        = $t['title'];
				
				if($toMessageId != "" && $fromMessageId !=""){
				
				$this->inbox->send($toMessageId,$fromMessageId,$subject,$this->input->post('message'));
				}
				//--Send beep box
				
				
				redirect('forum/topic/' . $tid);
				//redirect('forum/message/' . $this->input->post('pid'));
			break;
			case "delete":
				
				$mid = $start;
				if($mid === 0){
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message to delete");
					$this->layout->view('forum/error');
					return;
				}
				if(!$message = $this->message->get_message($mid)){
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message to delete");
					$this->layout->view('forum/error');
					return;
				}

				$params = array(
					'where' => "tid = '" . $message['tid'] . "'"
				);
				
				$topic = $this->topic->get($params);
					/*
				if($this->user->level['forum'] < LEVEL_DEL && !isset($this->user->forum_level[ $topic['tid'] ]))
				{
				

					
					$this->layout->setData('title',"Error");
					$this->layout->setData('message',"You cannot delete this message");
					$this->layout->view('error');
					
					return;
				}
				*/
				//

				if ( $confirm > 0 ){
					$this->message->delete(array('where' =>array('mid' => $mid)));
					$this->session->set_flashdata('notification', 'The message  has been deleted.');
					if($message['pid']){
						redirect('forum/message/' . $message['pid'], 'refresh');
						return;
					}else{
						redirect('forum/topic/' . $message['tid'], 'refresh');
						return;
					}
				}else{
					$this->layout->setData('title',"Delete message?");
					$template['children'] = false;
					if($message['pid'] == ''){
						$message['children'] = $this->message->get_total(array('where' => array('pid' => $message['mid'])));
					}
						$this->layout->setData('message',$message);
						$this->layout->view('message/delete');
				}
			break;
			case "search":

				if($start != 0){
					$tosearch = $start;
				}
				elseif ($this->input->post('tosearch')){
					$tosearch = $this->input->post('tosearch');
				}else{
					$this->layout->setData('title',"Search");
					$this->layout->view('forum/search');
					return;
				}
				$searchfield = array('title', 'message', 'username');
				if($infield = $this->input->post('infield')){
					if(in_array($infield, $searchfield)){
						if($this->input->post('exactsearch') == 'on'){
							$params['where'] =  $infield . " = '" . $this->input->post('tosearch') . "'";
						}else{
							$params['where'] =   $infield . " LIKE '%" . $this->input->post('tosearch') . "%'";
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
						$params['or_where']["username"]= $tosearch ;
					}else{
						//$params['where'] = "title LIKE   '%" . $tosearch . "%' OR tags LIKE   '%" . $tosearch . "%' OR message LIKE   '%" . $tosearch . "%' OR username LIKE   '%" . $tosearch . "%'";
						$params['where'] = "title LIKE   '%" . $tosearch . "%'  OR message LIKE   '%" . $tosearch . "%' OR username LIKE   '%" . $tosearch . "%'";
					}
				}
				//echo '<pre>';print_r($params);exit;
				$search_id = $this->message->save_params(serialize($params));
				//echo $search_id;exit;
				$this->results($search_id);
				return;
			break;
			case "list":
				if (is_null($mid)){
					redirect ('forum/topics');
					return true;
				}
			break;
			default:
				$mid = $action;
				$per_page = 20;
				// allowed to read the message?
				// the only way to get that is from its topic

				$message = $this->message->get(array('where' => array('mid' => $mid)));
				///$un = 'admin';
				$fUser = $this->chkULogin();
				$un    = $fUser[1];
				$ue    = $fUser[0];
				
				
				$params = array(
				//'where' => "tid = '" . $message['tid'] . "' AND (username = '" . $un . "') ",
				'where' => "tid = '" . $message['tid'] . "'  ",
				'order_by' => 'title'
				);

				if ($topic = $this->topic->get($params)){
					$this->layout->setData('topic',$topic);
				}else{
					$this->layout->setData('title',"Not authorized");
					$this->layout->setData('message',"You cannot view this message or the message does not exist.");
					$this->layout->view('forum/error');
					return;
				}

				//now get messages
				$params = array(
				'where' => "mid = '" . $message['mid'] . "' OR pid = '" . $message['mid'] . "' ",
				'order_by' => 'id',
				'limit' => $per_page,
				'start' => $start
				);


				if($messages = $this->message->get_list($params)){
					$this->load->library('pagination');
					$config['uri_segment'] = 4;
					$config['first_link'] = 'First';
					$config['last_link'] = 'Last';
					$config['base_url'] = base_url() . 'forum/message/' . $mid ;
					$config['total_rows'] = $this->message->get_total($params);
					$config['per_page'] = $per_page;

					$this->pagination->initialize($config);				
					$this->layout->setData('messages',$messages);
					$this->layout->setData('title',$message['title']);
					$this->layout->setData('start',$start);
					$this->layout->setData('pager',$this->pagination->create_links());
					$this->layout->view('message/index');
					$this->message->update("mid = '" . $message['mid'] . "' OR pid = '" . $message['mid'] . "' ", array('hits' => 'hits+1'), false);
				}else{
					echo '540';exit;
					$this->layout->setData('title',"No message found");
					$this->layout->setData('message',"There is no message available in this topic");
					$this->layout->view('forum/error');
				}
			break;
		}

	}

	// message search
	function results($search_id = 0, $start = 0){
		$params = array();
		//sorting
		if ($search_id !== 0 && $tmp = $this->message->get_params($search_id)){
			$params = unserialize( $tmp);
		}
		$per_page = 20;
		$params['start'] = $start;
		$params['limit'] = $per_page;
		//echo '<pre>';print_r($params);exit;
		$this->layout->setData('rows',$this->message->get_list($params));
		//echo $this->db->last_query();
		$this->layout->setData('title',"Search result");
		$config['first_link'] = 'First';
		$config['last_link'] = "Last";
		$config['total_rows'] = $this->message->get_total($params);
		$config['per_page'] = $per_page;
		$config['base_url'] = base_url() . 'forum/results/' . $search_id;
		$config['uri_segment'] = 4;
		$config['num_links'] = 20;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$this->layout->setData('pager',$this->pagination->create_links());
		$this->layout->setData('start',$start);
		$this->layout->setData('total',$config['total_rows']);
		$this->layout->setData('per_page',$config['per_page']);
		$this->layout->setData('total_rows',$config['total_rows']);
		$this->layout->view('forum/results');
	}

	function search(){
		$this->layout->setData('title',"Search forum");
		$this->layout->view('forum/search');
		return;
	}

	function unsubscribe($mid){
		//$un = 'admin';
		$fUser = $this->chkULogin();
		$un    = $fUser[1];
		$ue    = $fUser[0];
		
		//$this->user->require_login();
		$where = " `notify` = 'Y' AND `username` = '" . $un . "' AND ( `mid` = '" . $mid . "' OR `pid` = '" . $mid . "') ";
		$data = array('notify' => 'N');
		$this->message->update($where, $data);
		$this->layout->setData('title',"Unsubscribed");
		$this->layout->setData('message',"You will no longer receive notification about that message");
		$this->layout->view('forum/error');
	}
	
	
	public function chkULogin(){
		if($this->session->userdata('username') == ""){
			$this->layout->setData('title',"Not authorized");
			$this->layout->setData('message',"Please login to enter Forum issues.");
			$this->layout->setData('auth',false);
			return array('admin@mail.com','admin');
		}else{
			return array($this->session->userdata('email'),$this->session->userdata('welcomeuser'), $this->session->userdata('uid'));
		}
	}
}
/* End of file forum.php */
/* Location: ./application/controllers/forum.php */
