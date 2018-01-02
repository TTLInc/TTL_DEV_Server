<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');




// GET User Current Location (Country)
function currentLocation($ip = "")
{
	$params = getopt('l:i:');
	if (!isset($params['l'])) $params['l'] = 'LqyA4aik3WTl';
	if (!isset($params['i'])) $params['i'] = $ip;
	$query = 'https://geoip.maxmind.com/a?' . http_build_query($params);
	$curl = curl_init();
		curl_setopt_array($curl,array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $query,
		CURLOPT_USERAGENT => 'MaxMind PHP Sample',
		CURLOPT_SSL_VERIFYPEER => false
	));
	if(!curl_exec($curl)){
		die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
	}
	$resp = curl_exec($curl);
	return $resp;
 	if (curl_errno($curl)) {
		throw new Exception(
			'GeoIP request failed with a curl_errno of '
			. curl_errno($curl)
		);
	}
	$insights_values = str_getcsv($resp);
	$insights_values = array_pad($insights_values, sizeof($insights_keys), '');
	$insights = array_combine($insights_keys, $insights_values);	
}

// GET User IP Address
function get_ip() {
	//Just get the headers if we can or else use the SERVER global
	if ( function_exists( 'apache_request_headers' ) ) {
		$headers = apache_request_headers();
	} else {
		$headers = $_SERVER;
	}

	//Get the forwarded IP if it exists
	if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
		$the_ip = $headers['X-Forwarded-For'];
	} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
	) {
		$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
	} else {
		$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	}
	return $the_ip;
}

$userCountry = currentLocation(get_ip());
define('USER_CNT',	$userCountry); // Define Country Constant for Map

/* End of file constants.php */
/* Location: ./application/config/constants.php */