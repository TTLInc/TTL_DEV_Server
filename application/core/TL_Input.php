<?php
/***
 * parse the get method's form data
 *
 **/
class TL_Input extends CI_Input {

	private $requestVal = array();

	function __construct(){
		parent::__construct();
		$this->uri =& load_class('URI', 'core');
	}

	public function _request($index,$default=null , $xss_clean = FALSE){
		$this->_requestAll();
		$val = $this->_fetch_from_array($this->requestVal, $index, $xss_clean);
		if(!$val) {
			$val = $default;
		}
		return $val;
	}

	public function _requestBy($indexs , $xss_clean = FALSE){
		$this->_requestAll();
		$default = null;
		$results = array();
		foreach($indexs as $key => $value) {
			if(is_numeric($key)) {
				$index = $key;
				$default = $value;
			}
			else {
				$index = $value;
			}
			$results[$index] = $this->_fetch_from_array($this->requestVal, $index, $xss_clean);
			if( !$results[$index] ) {
				$results[$index] = $default;
			}
		}
		return $results;
	}

	public function _requestAll(){
		if(!$this->requestVal){
			$uri = new CI_URI();
			$_uri_assoc = $this->uri->_uri_to_assoc();
			$cookie = $this->cookies()?$this->cookies():array();
			$post = $this->post()?$this->post():array();
			$get = $this->get()?$this->get():array();
			$this->requestVal = array_merge($_uri_assoc,$cookie,$get,$post);
		}
		return $this->requestVal;
	}
	public function cookies($index = '', $xss_clean = FALSE){
		
		if ($index == NULL AND ! empty($_COOKIE))
		{
			$cookies = array();

			// loop through the full _GET array
			foreach (array_keys($_COOKIE) as $key)
			{
				$cookies[$key] = $this->_fetch_from_array($_COOKIE, $key, $xss_clean);
			}
			//var_dump($cookies);
			return $cookies;
		}
		return $this->_fetch_from_array($_COOKIE, $index, $xss_clean);
	}
}

// END Input Class

/* End of file TL_Input.php */
/* Location: ./application/core/TL_Input.php */