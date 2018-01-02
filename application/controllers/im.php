<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Im extends TL_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model(array('lookup_model'));
			    $this->layout->setLayoutData('linkAttr','support');
    }
    public function index(){
		//echo 'Instant Messaging';
		$this->im();
	
    }
    public function im(){
		$this->load->model(array('im_model'));
		$ims = $this->im_model->getAllActive();
		$this->layout->setData('ims',$ims);
		$this->layout->view('im/im');
	}

	//--R&D@Sept-19-2013 :Add FAQ	
	public function im_add(){
		$errormsg = '';
		$succrmsg = '';
		$errorStatus = false;
		if($_POST):	
			if(trim($this->input->post('que'))==''){
					$errormsg = 'Enter your question.';
					$errorStatus = true;
			}
			if ($errorStatus == false) {
				if($this->input->post()){
					$this->load->model(array('im_model'));
					$data = $this->input->post();
					$que = array();
					$que['que'] = $data['que'];
					$que['ans'] = '--';
					$que['status'] = 'ACTIVE';
					$this->im_model->im_add_front(($que));
					$succrmsg = 'Message sent successfully.';
				}
				echo json_encode(compact('succrmsg', 'errorStatus'));
			}
		endif;
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
}
/* End of file im.php */
/* Location: ./application/controllers/im.php */