<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demoveesession extends TL_Controller {

	public function __construct()
	{
		ini_set('error_reporting', 0);
		ini_set('display_errors', 'off');
	    parent::__construct();
	    $this->load->model(array('lookup_model'));
	}
		
	public function index(){
		$this->layout->view('demoveesession/demoveesession');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */