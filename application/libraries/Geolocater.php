<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CI_Geolocater
 * @author        SK VIRJA
 * @copyright    Copyright (c) 2013, Techno Infonet Guj Pvt Ltd..
 * @license        http://www.technoinfonet.com
 * @link        http://www.technoinfonet.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------
class CI_Geolocater {

    var $CI;

    // --------------------------------------------------------------------

    /**
     * Get CodeIgniter Instance
     *
     * @access    private
     * @return    void
     */

    function CI_Geolocater ()
    {
        $this->CI =& get_instance();
    }
     
    // --------------------------------------------------------------------

    /**
     * Get geo location from IP Address
     *
     * This function always gets the country. Getting the city is optional by param.
     *
     * @access    public
     * @param    string        $int_ipaddress        IP Address to look up
     * @param    boolean        $bol_returnCity        Return city or not
     * @return    void
     */

    function getlocation()
    {
		if(!isset($_SESSION['multi_lang']))
		{
			$ipInfo  = $this->getLocationInfoByIp();
			$country = $ipInfo['country'];
			$ip 	 = $ipInfo['ip'];

			$ci = &get_instance();
			$ci->load->model('user_model');
			$lang = $ci->user_model->getLanguageIp($country);

			$_SESSION['remoteIp'] =  $ip;
			$_SESSION['countryId'] = $lang['id'];
			$_SESSION['multi_lang'] = $lang['Language'];

			if ($ci->uri->segment(1)=="br") {
				$multi_lang = 'pt';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Portuguese';
			}
			else if ($ci->uri->segment(1)=="fr" || $ci->uri->segment(2)=="fr" || $ci->uri->segment(3)=="fr" || $ci->uri->segment(0)=="fr") {
				$multi_lang = 'fr';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'French';
			}
			else if ($ci->uri->segment(1)=="pt" || $ci->uri->segment(2)=="pt" || $ci->uri->segment(3)=="pt" || $ci->uri->segment(0)=="pt") {
				$multi_lang = 'pt';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Portuguese';
			}
			else if ($ci->uri->segment(1)=="jp" || $ci->uri->segment(2)=="jp" || $ci->uri->segment(3)=="jp" || $ci->uri->segment(0)=="jp") {
				$multi_lang = 'jp';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Japanese';
			}
			else if ($ci->uri->segment(1)=="kr" || $ci->uri->segment(2)=="kr" || $ci->uri->segment(3)=="kr" || $ci->uri->segment(0)=="kr") {
				$multi_lang = 'kr';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Korean';
			}
			else if ($ci->uri->segment(1)=="ch" || $ci->uri->segment(2)=="ch" || $ci->uri->segment(3)=="ch" || $ci->uri->segment(0)=="ch") {
				$multi_lang = 'ch';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Chinese Simplified';
			}
			else if ($ci->uri->segment(1)=="tw" || $ci->uri->segment(2)=="tw" || $ci->uri->segment(3)=="tw" || $ci->uri->segment(0)=="tw") {
				$multi_lang = 'tw';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Chinese Traditional';
			}
			else if ($ci->uri->segment(1)=="en" || $ci->uri->segment(2)=="en" || $ci->uri->segment(3)=="en" || $ci->uri->segment(0)=="en") {
				$multi_lang = 'en';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'English';
			}
			else if ($ci->uri->segment(1)=="es" || $ci->uri->segment(2)=="es" || $ci->uri->segment(3)=="es" || $ci->uri->segment(0)=="es") {
				$multi_lang = 'es';
				$_SESSION['multi_lang'] = $multi_lang;
				$_SESSION['multi_lang_name'] = 'Spenish';
			}
			else {
				$multi_lang = 'en';
				$_SESSION['multi_lang'] = 'en';
				$_SESSION['multi_lang_name'] = 'English';
				if ($country == 'IN') {
					$multi_lang = 'en';
					$_SESSION['multi_lang'] = 'en';
					$_SESSION['multi_lang_name'] = 'English';
				} else if ($country == 'CN') {
					$multi_lang = 'ch';
					$_SESSION['multi_lang'] = 'ch';
					$_SESSION['multi_lang_name'] = 'Chinese';
				} else if($country == 'KR') {
					$multi_lang = 'kr';
					$_SESSION['multi_lang'] = 'kr';
					$_SESSION['multi_lang_name'] = 'Korean';
				} else if ($country == 'JP') {
					$multi_lang = 'jp';
					$_SESSION['multi_lang'] = 'jp';
					$_SESSION['multi_lang_name'] = 'Japanese';
				} else if ($country == 'FR') {
					$multi_lang = 'fr';
					$_SESSION['multi_lang'] = 'fr';
					$_SESSION['multi_lang_name'] = 'French';
				} else if ($country == 'BR') {
					$multi_lang = 'pt';
					$_SESSION['multi_lang'] = 'pt';
					$_SESSION['multi_lang_name'] = 'Portuguese';
				}
			}
			return $multi_lang;
		} else {
			$ci = &get_instance();
			if(@$ci->input->uri->segments[0]){
				$_SESSION['multi_lang'] = $ci->input->uri->segments[0];
			} 
		}
    }
	
	// GET User IP
    public function getRealIP() {
        $ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		
		$ipaddress = explode(',',$ipaddress);
		//$ip = '179.234.212.22';
		$ip = $ipaddress[0];
        return $ip;
    }
	
	// Get Location By IP Using GEOPlugin.net
	function getLocationInfoByIp(){
		$ip = $this->getRealIP();
		$ci = &get_instance();
		$ci->load->model("user_model");
		$ip_data = $ci->user_model->getCountryInfoByGeoIp($ip);		
		//$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
		$result  = array('country'=>'', 'city'=>'', 'ip'=>'');
		//print_r($ip_data);
		//if($ip_data && $ip_data->geoplugin_countryName != null){
		if($ip_data && $ip_data->ip_country_code != null){
			$result['country'] = $ip_data->ip_country_code;
			//$result['city'] = $ip_data->geoplugin_city;
			$result['ip'] = $ip;
		}
		return $result;
	}
	
	// Get Location By MaxMind API 
	function getMaxMindlocation()
	{
		$ip = $this->getRealIP();
		$params = getopt('l:i:');
		if (!isset($params['l'])) $params['l'] = 'LqyA4aik3WTl';
		if (!isset($params['i'])) $params['i'] = $ip;
		
		$query = 'https://geoip.maxmind.com/geoip/v2.1/city/'.$ip;
		
		$insights_keys =array(
		'Country code',
		'Country name',
		'region_code',
		'region_name',
		'city_name',
		'latitude',
		'longitude',
		'metro_code',
		'area_code',
		'time_zone',
		'continent_code',
		'postal_code',
		'isp_name',
		'organization_name',
		'domain',
		'as_number',
		'netspeed',
		'user_type',
		'accuracy_radius',
		'country_confidence',
		'city_confidence',
		'region_confidence',
		'postal_confidence',
		'error'
		); 
		$curl = curl_init();
			curl_setopt_array($curl,array(
			CURLOPT_HTTPAUTH=> CURLAUTH_BASIC,
			CURLOPT_USERPWD=> "95357:LqyA4aik3WTl", //Your credentials goes here
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $query,
			CURLOPT_USERAGENT => 'MaxMind PHP Sample',
		));

		if(!curl_exec($curl)){
			die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
		}
		$resp = curl_exec($curl);
		
		$obj = json_decode($resp);
		$country = $obj->country->iso_code;
		
		$time_zone = $obj->location->time_zone;
		$ipInfoSESSION['time_zone'] = "";
		if ($time_zone) {
			$ipInfoSESSION['time_zone'] = $time_zone;
		}
		
		$check = strpos($ip, '177');
		$ci = &get_instance();
		$ci->load->model('user_model');
		$lang = $ci->user_model->getLanguageIp($country);
		$ipInfoSESSION['remoteIp'] =  $ip;
		$ipInfoSESSION['countryId'] = $lang['id'];
		$ipInfoSESSION['geocity'] = "";
		if ($obj->city->names->en) {
			$ipInfoSESSION['geocity'] = $obj->city->names->en;
		}
		$ipInfoSESSION['longitude'] = "";
		if ($obj->location->longitude) {
			$ipInfoSESSION['longitude'] = $obj->location->longitude;
		}
		$ipInfoSESSION['latitude'] = "";
		if ($obj->location->latitude) {
			$ipInfoSESSION['latitude'] = $obj->location->latitude; 
		}
		if ($ci->uri->segment(1)=="br") {
			$multi_lang = 'pt';
			$ipInfoSESSION['multi_lang'] = $multi_lang;
			$ipInfoSESSION['multi_lang_name'] = 'Portuguese';
		} else {
			$multi_lang = 'en';
			$ipInfoSESSION['multi_lang'] = 'en';
			$ipInfoSESSION['multi_lang_name'] = 'English';
			//$multi_lang = 'cn';
			if($country == 'IN')
			{
				$multi_lang = 'en';
				$ipInfoSESSION['multi_lang'] = 'en';
				$ipInfoSESSION['multi_lang_name'] = 'English';
			}elseif($country == 'CN')
			{
				$multi_lang = 'ch';
				$ipInfoSESSION['multi_lang'] = 'ch';
				$ipInfoSESSION['multi_lang_name'] = 'Chinese';
			}elseif($country == 'KR')
			{
				$multi_lang = 'kr';
				$ipInfoSESSION['multi_lang'] = 'kr';
				$ipInfoSESSION['multi_lang_name'] = 'Korean';
			}elseif($country == 'JP')
			{
				$multi_lang = 'jp';
				$ipInfoSESSION['multi_lang'] = 'jp';
				$ipInfoSESSION['multi_lang_name'] = 'Japanese';
			}
			elseif($country == 'FR')
			{
				$multi_lang = 'fr';
				$ipInfoSESSION['multi_lang'] = 'fr';
				$ipInfoSESSION['multi_lang_name'] = 'French';
			}
			elseif($country == 'BR')
			{
				$multi_lang = 'pt';
				$ipInfoSESSION['multi_lang'] = 'pt';
				$ipInfoSESSION['multi_lang_name'] = 'Portuguese';
			}
		}
		return $ipInfoSESSION;
    }
}
// END CI_Geolocater class
?>