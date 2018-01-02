<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function getGImage($q='thetalklist'){
		
		$this->loadCache();
		if(!class_exists('Google_Client')){
			require FCPATH .'/gapi/Google_Client.php';
		}
		if(!class_exists('Google_CustomsearchService')) {
			require FCPATH .'gapi/contrib/Google_CustomsearchService.php';
		}
		try{
			$client = new Google_Client();
			$client->setApplicationName('thetalklist');
			
			$search = new Google_CustomsearchService($client);
			echo $q;
			// Example executing a search with your custom search id.
			$result = $search->cse->listCse('burrito', array(
			  'cref' =>'',
			  'num'=>10,
			  'searchType'=>'image',
			  'start'=>1,
			  'safe'=>'high',
			  'filter'=>1,
			  'excludeTerms'=>'ass',
			  'siteSearchFilter'=>'e',
			  'q'=>$q
			));
			
			
			$result1 = $search->cse->listCse('burrito', array(
			  'cref' =>'',
			  'num'=>10,
			  'searchType'=>'image',
			  'start'=>11,
			  'safe'=>'high',
			  'filter'=>1,
			  'excludeTerms'=>'ass',
			  'siteSearchFilter'=>'e',
			  'q'=>$q
			));
			
			$results = array_merge($result['items'],$result1['items']);

			if($q == 'thetalklist'){
				$this->cache->save('imgSearch_'.$q, $results, 3600*12);
			}else {
				$this->cache->save('imgSearch_'.$q, $results, 600);
			}
		}
		 
		catch(Exception $e){
			$results = array();
		}
		
		return $results;
	}
	public function getLangs(){
		$this->loadCache();
		if ( $results = $this->cache->get('trLangs') ) {
			if( count($results)>1){
				//return $results;
			}
		}
		if(!class_exists('Google_Client')){
			require FCPATH .'/gapi/Google_Client.php';
		}
		if(!class_exists('Google_CustomsearchService')) {
			require FCPATH .'gapi/contrib/Google_TranslateService.php';
		}
		try{
			 
			$client = new Google_Client();
			$client->setApplicationName('thetalklist');
			$service = new Google_TranslateService($client);
			$langs = $service->languages->listLanguages(array('target'=>'en'));
			$this->cache->save('trLangs', $langs, 3600*24);
		}
		catch(Exception $e){
		
			$langs = array();
		}
		
		//echo "<pre>";print_r($langs);die();
		return $langs;
	}
	public function gTranslate($q,$target,$source=''){
		$this->loadCache();
		$keyStr = md5($target.'__'.$source.'__'.$q);
		if ( $results = $this->cache->get($keyStr) ) {
			if( count($results)>1){
				return $results;
			}
		}
		if(!class_exists('Google_Client')){
			require FCPATH .'/gapi/Google_Client.php';
		}
		if(!class_exists('Google_CustomsearchService')) {
			require FCPATH .'gapi/contrib/Google_TranslateService.php';
		}
		try{
			$client = new Google_Client();
			$client->setApplicationName('thetalklist');
			$service = new Google_TranslateService($client);
			if($source!=''){
				$opt['source'] = $source;
			}else{
				$opt = array();
			}
			$langs = $service->translations->listTranslations($q,$target,$opt);
			$this->cache->save($keyStr, $langs, 3600*24);
		}catch(Exception $e){
			$langs = array();
		}
		return $langs;
		$translations = $service->translations->listTranslations('ces', 'zh',array('source'=>'zh-TW'));
	}
}
/* End of file tool_model.php */
/* Location: ./application/model/tool_model.php */