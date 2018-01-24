	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public $uid = 0;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('pagecounter');
		$this->load->library('minify');
		$this->load->library('slug');
		$this->load->library('pagination');
		$this->load->model('post_model');
		$this->load->model('post_m');
		$this->load->model('group_model');
		$this->load->model('search_model');
		//$this->load->library('Aauth');
		if(!$this->aauth->is_loggedin()){

			redirect('');
		}elseif (!$this->aauth->is_admin()) {
			# code...

			redirect('search');
		}


        $this->uid = $this->session->userdata('id');
	}
	public function index($value='')
	{
		# code...
		redirect('post/listall');
	}
	public function listall($start=0)
	{
		# code...


		$start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$limit = 5;

		$groups = $this->aauth->get_user_groups($this->uid);			
			if($groups){
				foreach ($groups as $key) {
					# code...
					$ids[]= $key->group_id;
				}
			}
	    $total = $this->search_model->page_total();




			            $total_row = $this->search_model->page_total($ids);
						$config['base_url'] = site_url() . "/post/listall";
			            $config['total_rows']=$total_row;
			            $config['per_page'] = $limit;
				        $config["uri_segment"] = 3;
				        $choice = $config["total_rows"]/$config["per_page"];
				        $config["num_links"] = floor($choice);
             
             
			            $this->pagination->initialize($config);
			                 
			            $links = $this->pagination->create_links();
			            //var_dump($links);

			$pages = $this->search_model->find($this->uid,false,$ids,$limit,$start);
			$content = '<table class="table table-bordered">

						<thead><tr><th>Title</th><th>Course</th><th>Year</th><th>Action</th></tr></thead>';

			if(is_array($pages)){

				foreach ($pages as $key) {

						$content .= "<tr>
						<td>$key->title</td>
						<td>$key->name</td>
						<td>$key->year</td>
						<td width='150px;'><a href='' class='btn btn-success'><i class='fa fa-book'></i></a>&nbsp;<a href='' class='btn btn-default'><i class='fa fa-edit'></i></a>&nbsp;<a href='' class='btn btn-danger'><i class='fa fa-remove'></i></a></td></tr>";
				}
			}
			$content .="</table>";


		
		

		$data['content']= $content;
		$data['links']= $links;



		$data['listgroup'] = $this->group_model->group_type(3);

		$data['title'] = 'List all';
		$data['subtitle'] = 'List all';

		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('post/list',$data);
		$this->load->view('admin/default/footer',$data);

	}
	public function create($value='')
	{
		# code...


		$data['listgroup'] = $this->group_model->group_type(3);

		$content = '';
		$data['content'] = $content;
		$data['subtitle']= "THESIS - Abstract";
		$data['username']= $this->session->username;


		$this->load->view('admin/default/header',$data);
		$this->load->view('admin/default/sidemenu',$data);
		$this->load->view('post/new',$data);
		$this->load->view('admin/default/footer',$data);
	}
	public function save()
	{
		# code...
		if ($this->input->post('slug')) {
				# code...
				echo $this->save_other_info();
				exit;
			}
		echo json_encode(array('stats' => false ,'error'=>'Warning: No input received!' ));


			exit();
		if ($this->input->post()) {

			if ($this->input->post('title')) {
				echo $this->save_post();
				exit;
			}elseif ($this->input->post('slug')) {
				# code...
				echo $this->save_other_info();
				exit;
			}else{
				echo json_encode(array('stats' => false ,'error'=>'Warning: No input received!' ));
			}
		}else{
				echo json_encode(array('stats' => false ,'error'=>'Warning: Invalid request!' ));
			}
	}
	public function save_post()
	{
		# code...
		if ($this->input->post()) {
			
			$title = $this->input->post('title');
			$clean_url = $this->slug->create($this->input->post('title'));
			//$tags = $this->input->post('hidden-tags');
			$tags = $this->input->post('tags');
			$group = $this->input->post('group');
			$content = $this->input->post('abstract');
			$year = $this->input->post('selectyear');
			$month = $this->input->post('selectmonth');
			$code_number = $this->input->post('code');
			if(!empty($tags)){
				$tags = $this->slug->create(urldecode($tags));
				$tags =  $tags.'-'.$clean_url;
				$tags = explode('-', $tags);
				$tags = array_unique(array_filter($tags));
			}

			if(!$this->post_model->isExist($title)){
				$result = $this->post_model->save_abstract(array('title'=>$title,'slug'=>$clean_url,'year'=>$year,'month'=>$month,'content'=>$content));
				$id = $result;
				if (is_array($tags)) {
					# code...
					foreach ($tags as $key) {
						# code...
					$insert = $this->post_m->save_tags($key,$id);
					//echo json_encode(array('stats'=>false,'error'=>$insert,'id'=>$id));
					//exit();
						}
					}else{

					$insert = $this->post_m->save_tags($tags,$id);
					}

				$page_permission = $this->post_model->page_permission($id,$group,2);

				if($result){
					return json_encode(array('stats'=>true,'slug'=>$clean_url,'tags'=>$tags));
				}else{
					return json_encode(array('stats'=>false,'error'=>'Unknown Error occured.'));
				}
			}else{
					return json_encode(array('stats'=>false,'error'=>'Title already exist!'));
			}
		}

	}
	public function save_other_info()
	{
		# code...
		$slug = $this->input->post('slug');
		$post_id = $this->post_m->get_id_by_slug($slug);

		$r_name = $this->input->post('researcher');
		$r_pos = $this->input->post('researcher-position');

		if (!empty($r_name[0]) ) {

			$i = 0;
			foreach ($r_name as $key) {
				$researcher[] = array('fullname' =>$key ,'position'=>$r_pos[$i],'post_id'=>$post_id );
				$i++;
			}
			$res = $this->post_m->insert_other_info('post_researcher',$researcher);
		}


		$p_name = $this->input->post('panel');
		$p_pos = $this->input->post('panel-position');

		if (!empty($p_name[0])) {

			$i = 0;
			foreach ($p_name as $key1) {
				$panel[] = array('fullname' =>$key1 ,'position'=>$p_pos[$i],'post_id'=>$post_id );
				$i++;
			}
			$res1 = $this->post_m->insert_other_info('post_panel',$panel);
		}
		
		$c_name = $this->input->post('committee');
		$c_pos = $this->input->post('committee-position');

		if (!empty($c_name[0])) {

			$i = 0;
			foreach ($c_name as $key2) {

				$committees[] = array('fullname' =>$key2 ,'position'=>$c_pos[$i],'post_id'=>$post_id );
				$i++;
			}
			$res2 = $this->post_m->insert_other_info('post_committee',$committees);
		}
		

		//$rating = $this->input->post('rating');
		//	$rate[0] = array('rating'=>$rating,'post_id'=>$post_id);
		//	$res3 = $this->post_m->insert_other_info('post_ratings',$rate);


		return json_encode(array('stats'=>true));
		
		
	}

	public function search_post($tags='')
	{
		# code...

		$tags = $this->input->post('tags');

		$tags ='sdhhhhk sd the sd';
		$tags = $this->slug->create($tags);
		$tags = explode('-', $tags);
		$result = $this->post_m->search_by_tags($tags);
		
		if (count($result) > 0) {

			echo "<ul>";
			foreach ($result as $key) {

				echo "<li>$key->page_id $key->title</li>";
			}
			echo "<ul>";
		}
		echo "No result";

	}

	public function search_names()
	{
		# code...
		$string = $this->input->post('name');

		$msgs = $this->post_m->get_name($string);
			$i = 0;
		$msg = '';
			foreach ($msgs as $key) {
				# code...
				$name = ucwords($key->fullname);
				$msg .="<li id='$i' onclick='get_selected(\"$name\")'>$name</li>";
				$i++;
			}
		
		echo json_encode(array('stats'=>true,'msg'=>$msg));
	}









//class end
}