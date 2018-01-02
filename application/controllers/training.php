<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training extends TL_Controller {
	public function __construct(){
        parent::__construct();
		session_start();
		$this->load->model('article_model');
		$this->load->model(array('lookup_model'));
		$this->layout->setLayoutData('linkAttr','article');
    }
	public function privacy(){
		$article = $this->article_model->get(1);
		$this->layout->setData('article',$article);
		$this->layout->view('article/privacy');
	}
	public function terms(){
		$article = $this->article_model->get(2);
		$this->layout->setData('article',$article);
		$this->layout->view('article/terms');
	}
	public function contact(){
		$article = $this->article_model->get(3);
		$this->layout->setData('article',$article);
		$this->layout->view('article/contact');
	}
	public function howItWork(){
		$this->user = $this->check_login(false);
		$this->load->model(array('lesson_model'));
		$article = $this->article_model->get_cat(1);
		$this->layout->setData('howItworks',$article);
		$this->layout->view('article/howItWork');
	}
	public function howItWorks(){
		$this->load->model(array('ppc_model'));
		if(!isset($_SESSION["multi_lang"])){
			$lang = 'en';
		}else{
			$lang = $_SESSION['multi_lang'];
		}
		$video = $this->ppc_model->loadVideo($lang);
		$this->layout->setData('video',$video);
		$this->user = $this->check_login(false);
		$this->load->model(array('lesson_model'));
		$article = $this->article_model->get_cat(1);
		$this->layout->setData('howItworks',$article);
		$this->layout->view('article/howItWork');
	}
}
/* End of file training.php */
/* Location: ./application/controllers/training.php */