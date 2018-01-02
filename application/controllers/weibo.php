<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weibo extends TL_Controller {

	public function __construct() {
        parent::__construct();
		
    }
    public function index(){
		define( "WB_AKEY" , '2334834970' );
		define( "WB_SKEY" , '0cd1b797f946042a9ccd372b459a9e97' );
		define( "WB_CALLBACK_URL" , 'http://techno-sanjay/dev.thetalklist.com/weibo/callback.php' );
		$this->load->library('weibo');
    }
	
	public function callback(){
		define( "WB_AKEY" , '2334834970' );
		define( "WB_SKEY" , '0cd1b797f946042a9ccd372b459a9e97' );
		define( "WB_CALLBACK_URL" , 'http://techno-sanjay/dev.thetalklist.com/weibo/callback' );
		$this->load->library('weibo');
		$this->load->library('session');
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		if (isset($_REQUEST['code'])) {
			$keys 					= array();
			$keys['code'] 			= $_REQUEST['code'];
			$keys['redirect_uri'] 	= WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
		}
		if ($token) {
			$_SESSION['token'] = $token;
			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			$c 				= new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$ms  			= $c->home_timeline(); // done
			$uid_get 		= $c->get_uid();
			$uid 			= $uid_get['uid'];
			$user_message 	= $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
			$user_message2 	= $c->show_profile_by_id( $uid);//根据ID获取用户等基本信息
			
			foreach($user_message as $key =>$value){ 
				if($key != 'status'){
					$this->session->set_userdata('_weibo_'.$key, $value);
				}
			}
			echo '<pre>';
			print_r($user_message);
			print_r($user_message2);
		}
		exit;
		
			//echo '<script type="text/javascript">self.close();</script>';
			redirect('user/register');
	}
}
/* End of file weibo.php */
/* Location: ./application/controllers/weibo.php */