<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends TL_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model(array('article_model','lookup_model'));
    }
	public function privacy(){
		$this->layout->setLayoutData('linkAttr','privacy');
		$article = $this->article_model->get(1);
		$this->layout->setData('article',$article);
		$this->layout->view('article/privacy');
	}
	public function terms(){
		$this->layout->setLayoutData('linkAttr','terms');
		$article = $this->article_model->get(2);
		$this->layout->setData('article',$article);
		$this->layout->view('article/terms');
	}
	public function about(){
		$this->layout->setLayoutData('linkAttr','about');
		$article = $this->article_model->get(4);
		$this->layout->setData('article',$article);
		$this->layout->view('article/about');
	}
	public function case_studies(){
		$article = $this->article_model->get(5);
		$this->layout->setData('article',$article);
		$this->layout->view('article/terms');
	}
	public function site_map(){
		$this->layout->setLayoutData('linkAttr','sitemap');
		$article = array();//$this->article_model->get(6);
		$article['title'] = 'sitemap';
		$article['desc'] = file_get_contents(FCPATH.'/uploads/sitemap.html');
		$this->layout->setData('article',$article);
		$this->layout->view('article/sitemap');
	}
	public function contact(){
		$this->layout->setLayoutData('linkAttr','contact');
		$errorMsg = '';
		if($this->input->post()) {
			$email = $this->input->_request('email');
			$firstName = $this->input->_request('firstName','');
			$lastName = $this->input->_request('lastName','');
			$msg = $this->input->_request('msg','');
			$this->load->library('email');
            $this->email->from('admin@thetalklist.com','TheTalklist');
            $this->email->mailtype = 'html';
            $this->email->reply_to($email,$firstName .' '. $lastName);
            $this->email->to('info@thetalklist.com');
            $this->email->subject('The contact message from  '.$email . '(' .$firstName .' '. $lastName . ') for TheTalklist');
            $this->email->message($msg);
            $this->email->send();
            $errorMsg = "Thanks for sending us a note!";
		}
		$article = $this->article_model->get(3);
		$this->layout->setData('article',$article);
		$this->layout->setData('errorMsg',$errorMsg);
		$this->layout->view('article/contact');
	}
	public function howItWork(){
		$this->layout->setLayoutData('linkAttr','howitworks');
		$this->user = $this->check_login(false);
		$this->load->model(array('lesson_model'));
		$article = $this->article_model->get_cat(1);
		$this->layout->setData('howItworks',$article);		
		$this->layout->view('article/howItWork');
	}
	public function howItWorks(){
		$this->layout->setLayoutData('linkAttr','howitworks');
		$this->user = $this->check_login(false);
		$this->load->model(array('lesson_model'));
		$article = $this->article_model->get_cat(1);
		$this->layout->setData('howItworks',$article);
		$this->layout->view('article/howItWork');
	}
	public function makeSiteMap(){
		$this->layout->setLayoutData('linkAttr','sitemap');
		$data = array();
		$data['Company Content'] = array();
		$data['Company Content'][] = array(TL_URL('article/privacy'),'Privacy');
		$data['Company Content'][] = array(TL_URL('article/terms'),'Terms');
		$data['Company Content'][] = array(TL_URL('article/about'),'About');
		//$data['Company Content'][] = array(TL_URL('article/case_studies'),'Case studies');
		$data['Company Content'][] = array(TL_URL('article/contact'),'Contact');
		$data['Company Content'][] = array(TL_URL('training/howItWorks'),'How it works');
		$data['Homepage'] = array();
		$data['Homepage'][] = array(TL_URL('/'),'Homepage');
		$data['Homepage'][] = array(TL_URL('user/login'),'Login');
		$data['Homepage'][] = array(TL_URL('user/register'),'Register');
		$data['Search'] = array();
		$data['Search'][] = array(TL_URL('search/search'),'Search');
		$html = '';
		$xml = '<?xml version="1.0" encoding="UTF-8"?> ';
		$xml .= '<urlset       xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"       xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9             http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
		foreach ($data as $key => $value) {
			$html .= '<h3>'.$key.'</h3>';
			foreach ($value as $kk => $vv) {
				$html .= '<p> <a href="'.$vv[0].'">'.$vv[1].'</a></p>';
				$xml .= '<url>';
  				$xml .= '	<loc>'.$vv[0].'</loc>';
				$xml .= '</url>';
			}
		}
		$xml .= '</urlset>';
		file_put_contents(FCPATH.'/uploads/sitemap.html', $html);
		file_put_contents(FCPATH.'/uploads/sitemap.xml', $xml);
	}
}
/* End of file article.php */
/* Location: ./application/controllers/article.php */