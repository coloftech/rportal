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
        $this->uid = $this->session->userdata('id');

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
	public function security($value='')
	{
		# code...
		if ($this->input->post()) {
			# code...
			$input =(object)$this->input->post();
			if($update = $this->aauth->update_user($this->uid,false,$input->password)){
				redirect('setting/security?stats=account-updated-successfully');
			}else{
				$error =  $this->aauth->print_error();
				redirect('setting/security?stats='.$error);
			}
			exit();
		}
		$data['subtitle'] = '';
		$this->load->view('common/header',$data);
		$this->load->view('user/myaccount',$data);
		$this->load->view('common/footer',$data);
	}
}