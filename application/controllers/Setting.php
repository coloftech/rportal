<?php 

/**
* 
*/
class Setting extends CI_Controller
{
	public $uid;
	function __construct()
	{
		# code...
		parent::__construct();
		$this->init();

	}
	public function init()
	{

		if (!$this->aauth->is_loggedin()){
        	redirect();
        }

	}
	public function index($value='')
	{
		# code...
	}
	public function user_access($value='')
	{
		# code...
		$data['title']= "Resource Portal - user access";
		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/menu',$data);
		$this->load->view('admin/setting/user_access',$data);
		$this->load->view('admin/default/footer',$data);
	}
}