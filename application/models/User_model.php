<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function updateData($where,$data)
	{
		$this->db->where('email', $where);
		$this->db->update('user', $data);
	}
	

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */