<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CodeIgniter
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
			$ip = $_SERVER['REMOTE_ADDR'];
			
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "ipinfo.io"); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); 
			curl_close($ch);

			$output = json_decode($output);
			@$country = $output->country;
			//$country = 'IN';
			//session_start();
			$multi_lang = 'en';
			
			if($country == 'IN')
			{
				$multi_lang = 'en';
				$_SESSION['multi_lang'] = 'en';
				
			}elseif($country == 'CN')
			{
				$multi_lang = 'ch';
				$_SESSION['multi_lang'] = 'ch';
			}elseif($country == 'KR')
			{
				$multi_lang = 'kr';
				$_SESSION['multi_lang'] = 'kr';
			}elseif($country == 'JP')
			{
				$multi_lang = 'jp';
				$_SESSION['multi_lang'] = 'jp';
			}
			
			return $multi_lang;
		}
    }
	public function getRealIP() {
        $ipaddress = '';
        if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ipaddress =  $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ipaddress = $_SERVER['HTTP_X_REAL_IP'];
        }
        else if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
	public function currentLocation($ip = "")
	{
		if($ip == "") {
            $ip = $this->getRealIP();			
        }
        $url = "http://api.codehelper.io/ips/?php&ip=".$ip;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($output);
		return $data;
	}
}

// END CI_Geolocater class

?>