<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat extends TL_Controller{
	
	/**
	 * Constructor duh
	 * - loads the model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('chatmodel');
	}
	
	/**
	 * Loads the default page for the XML example
	 * 
	 */
	public function index()
	{		
		$this->load->view('jsonView');
	}
	
	/**
	 * UPDATES the DB
	 * 
	 * @param $_POST array
	 * @return bool
	 */
	public function update()
	{
		//POST up or GTFO
		if(empty($_POST))
		{
			return false;
		}
		
		// Loops through the post array and makes variables equal to the array key
		foreach($_POST AS $key => $value) {
			// sanitize for SQL Injection
		    ${$key} = mysql_real_escape_string($value);
		}
		
		/*
		 * If the key is correct, find the current time and pass all the data to 
		 * the model for insertion
		 */
		if($action == "postmsg"){
			$current = time();		
			$this->chatmodel->insertMsg($name, $message, $current);		
		}
		
		if($html_redirect == "true")
		{
			header('Location: /chat/html');
		}	
	}
	
	function updatealertstatus($id)
	{
		$status = $this->chatmodel->updatealertstatus($id);
	}
	
	/**
	 * Loads the default view for the JSON example
	 * 
	 */
	public function json()
	{
		$this->load->view('jsonView');
	}
	
	/**
	 * Displays the JSON formatted data
	 */
	public function json_backend()
	{
		// Headers for the JSON
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		//get the data
		$query = $this->chatmodel->getMsg();

		//store the results in an array
		$data = $query->result_array();
		
		// update message status
		if(isset($data) && $data !='')
		{
			foreach($data as $ms)
			{
				$this->updatealertstatus($ms['id']);
			}
		}
		//print_r($data);exit;
		//encode the array into json
		$jsonData = json_encode($data);
		
		//JSON sized dump to STDOUT
		echo $jsonData;
	}
	
}
?>