<?php 

/**
* 
*/
class Setting_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_all_setting($id=0)
	{
		# code...
		$this->db->select('*');
		$query = $this->db->get_where('col_settings',array('id'=>$id));
		return $query->result();
	}
	public function save($id=0,$data)
	{
		# code...

		$this->db->where('id', $id);
		return $this->db->update('col_settings', $data);

	}
}