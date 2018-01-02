<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	/**
	 *
	 * save media info
	 * @param $userinfo
	 */
	public function save($mediaInfo) {
		$media = array();
		$media['uid'] = $mediaInfo['uid'];
		if($mediaInfo['is_image']) {
			$media['type'] = 'images';
		}
		else {
			$media['type'] = 'vedios';
		}
		$media['src'] = $mediaInfo['address'];
		$media['creatAt'] = date('Y-m-d H:i:s');
//echo $media['src'] ;exit;
		return $query = $this->db->query($this->db->insert_string('media',$media));


	}

}
/* End of file media_model.php */
/* Location: ./application/model/media_model.php */