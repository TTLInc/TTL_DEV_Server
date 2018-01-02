<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{

	var $obj;
	var $layout;
	public $layoutData = array();
	public $data = array();
	function Layout($layout = "layout_main")
	{
		$this->obj =& get_instance();
		$this->layout = $layout;
	}

	function setLayout($layout)
	{
		$this->layout = $layout;
	}
	/***************************
	 * appendFile append file in the <head>
	 * type string css/javascript
	 * type string the css/javascript`s address
	 * extra array the other param like rel=>stylesheet
	 ***************************/
	public function appendFile($type,$url,$extra = array()){
		if(stripos($url,'http://') === false){
			$url = Base_url($url);
		}
		if($type == 'javascript'){
			$this->layoutData['javascripts'][] = array_merge(array('src'=>$url),$extra);
		}
		else {
			$this->layoutData['links'][] = array_merge(array('href'=>$url),$extra);
		}
	}

	/***************************
	 * appendScript append script in the <head>
	 * value string javascript script
	 ***************************/
	public function appendScript($value){
		$this->layoutData['scripts'][] = $value;
	}

	/***************************
	 * appendStyle append style in the <head>
	 * value string style script
	 ***************************/
	public function appendStyle($value){
		$this->layoutData['styles'][] = $value;
	}
	/***************************
	 * setLayoutData set layout's Variable
	 * data mixed(array|string) if array it's Variable£¬if string it's key=>val
	 * value mixed if data is string it's the value
	 ***************************/
	public function setLayoutData($data,$value = '')
	{
		if (is_array($data)) {
			$this->layoutData = array_merge($this->layoutData, $data);
		}
		else{
			$this->layoutData[$data] = $value; 
		}
	}
	/***************************
	 * setData  set view data 
	 * data mixed(array|string)  if array it's Variable£¬if string it's key=>val
	 * value mixed  if data is string it's the value
	 ***************************/
	public function setData($data,$value = '')
	{
		if (is_array($data)) {
			$this->data = array_merge($this->data, $data);
		}
		else {
			$this->data[$data] = $value; 
		}
	}

	function view($view, $data=null, $return=false)
	{
		if (is_array($data)) {
			$this->data = array_merge($this->data, $data);
		}
		if($this->layout == 'none' || $this->layout == false){
			if($return) {
				$output = $this->obj->load->view($view,$this->data,true);
				return $output;
			}
			else {
				$this->obj->load->view($view,$this->data,false);
			}
		}
		else {
		
			$this->layoutData['content_for_layout'] = $this->obj->load->view($view,$this->data,true);
			
			if($return) {
				$output = $this->obj->load->view($this->layout, $this->layoutData, true);
				return $output;
			}
			else {
				$this->obj->load->view($this->layout, $this->layoutData, false);
			}
		}
	}
}