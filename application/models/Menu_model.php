<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {
	public function getAll($table)
	{
		return $this->db->get($table);
	}
	public function insertData($table,$data)
	{
		$this->db->insert($table, $data);
	}
	public function editData($table,$id)
	{
		$this->db->where('id', $id);
		return $this->db->get($table)->row_array();
	}
	public function updateData($table,$where,$data)
	{
		$this->db->where('id', $where);
		$this->db->update($table, $data);
	}
	public function deleteMenu($table,$id)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}

	public function getSubMenu()
	{
		$this->db->select('menu,user_sub_menu.*');
		$this->db->from('user_menu');
		$this->db->join('user_sub_menu', 'user_sub_menu.menu_id = user_menu.id');
		return $this->db->get()->result_array();
		// $this->db->select('*');
		// $this->db->from('user_sub_menu');
		// $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
		// return $this->db->get()->result_array();
	}
	

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */