<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	//$config['mode']   = 'sandbox';

	/**
	 * Account SID
	 **/
	//$config['account_sid']   = 'AC791ccf4c542c6cc90efca6029feb4c98'; //'ACdcd3512cec3cdfb221a63020741c1aa1'; //'AC4becff359f511d85b608a4e5e5674aa5';

	/**
	 * Auth Token
	 **/
	//$config['auth_token']    = 'fd1b64d37df19d314c9616a22993d8e7'; //'19f25c37589a677ff45ca4432fad4929'; //'070628e723bac1b71683222573f16a7b';

	/**
	 * API Version
	 **/
        
        $config['mode']         = 'prod';
        $config['account_sid']  = 'ACfff7c32f9e6bf8e7eedf961aa912eb95';
        $config['auth_token']   = 'c72c9f974524edf9bfb6933f44f6f1ad';
        
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/
	$config['number']        = '+16366424850';//'+1484-383-4914'; //1 636-642-4850


/* End of file twilio.php */