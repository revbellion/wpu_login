<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->library('form_validation');
		$this->load->model('Menu_model');

	}
	public function index()
	{
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['row'] = $this->db->get('user')->num_rows();
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer' );

	}
	public function role()
	{
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['row'] = $this->db->get('user')->num_rows();
		$data['title'] = 'Role';
		$data['role'] = $this->Menu_model->getAll('user_role')->result_array();	
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/role',$data);
		$this->load->view('templates/footer' );

	}
	public function addRole()
	{
		$this->form_validation->set_rules('role','Role','trim|required');

		if ($this->form_validation->run() == FALSE) {

			$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			$data['row'] = $this->db->get('user')->num_rows();
			$data['title'] = 'Role';
			$data['role'] = $this->Menu_model->getAll('user_role')->result_array();	
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('admin/role',$data);
			$this->load->view('templates/footer' );
		} else {
			$data = [
				'role' => $this->input->post('role')
			];
			$this->Menu_model->insertData('user_role',$data);
			$this->session->set_flashdata('info', '<div class="alert alert-success">New Role has been added !</div>');
			redirect('admin/role');
		}
	}
	public function editRole()
	{
		$id = $this->input->post('id');
		$data = $this->Menu_model->editData('user_role',$id);
		echo json_encode($data);

	}
	public function updateRole()
	{
		$where = $this->input->post('id');

		$data = [
			'role' => $this->input->post('role')
		];
		$this->Menu_model->updateData('user_role',$where,$data);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Role has been updated !</div>');
		redirect('admin/role');
	}
	public function deleteRole($id)
	{

		$this->Menu_model->deleteMenu('user_role',$id);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Role has been deleted !</div>');
		redirect('admin/role');
	}

	public function roleAccess($role_id)
	{
			$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = 'Role Access';
			$data['role'] = $this->Menu_model->editData('user_role',$role_id);
			$this->db->where('id !=', 1);	
			$data['menu'] = $this->Menu_model->getAll('user_menu')->result_array();	
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('admin/role_access',$data);
			$this->load->view('templates/footer' );
	}
	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu',$data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		}else{
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Access Changed !</div>');


	}
	 

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */