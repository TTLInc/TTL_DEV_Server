<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Credit_model extends TL_Model{
	public function __construct(){	
		parent::__construct();
	}
	//---Convert USD to TalkList Credit
	public function USD2TTL($USD){
		//$config['USD_TO_TTL']['value']
		//$config['RBM_TO_TTL']['value']
		return $USD 
	}
	//---Convert RBM to TalkList Credit	
	public function RBM2TTL($RBM){
		//$config['USD_TO_TTL']['value']
		//$config['RBM_TO_TTL']['value']
		return $RBM; 
	}
	//---Convert USD to RBM Credit	
	public function USD2RBM($USD){
		//$config['USD_TO_TTL']['value']
		//$config['RBM_TO_TTL']['value']
		//--Convert USD to TTL
		$TTL =( $USD ) * ( $config['USD_TO_TTL']['value'] );
		//--Convert TTL Credits to RBM
		$RBM =( $TTL ) * ( $config['RBM_TO_TTL']['value'] );
		return $RBM;
		//return $USD 
	}
	//---Convert RBM to USD Credit	
	public function RBM2USD($RBM){
		//$config['USD_TO_TTL']['value']
		//$config['RBM_TO_TTL']['value']
		return $RBM; 
	}
}
/* End of file credit_model.php */
/* Location: ./application/model/credit_model.php */