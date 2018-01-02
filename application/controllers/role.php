<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends TL_Controller {
	public function __construct()
    {
        parent::__construct();
    }
	/*列表*/
	public function index()
	{
		$this->layout->view('role/index');
	}
	/*添加角色页面*/
	public function add()
	{
		$this->layout->view('role/add');
	}
	/*添加*/
	public function addDo()
	{
		
	}
	/*编辑页面*/
	public function edit()
	{
		$this->layout->view('role/edit');
	}
	/*编辑*/
	public function editDo()
	{
		
	}
	/*删除*/
	public function dellDo()
	{
		
	}
}
/* End of file role.php */
/* Location: ./application/controllers/role.php */