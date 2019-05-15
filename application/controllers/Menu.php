<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		 
		$this->load->model('Menu_model');
		$this->load->library('form_validation');

	}
	public function index()
	{

		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Menu Management';
		$data['menu'] = $this->Menu_model->getAll('user_menu')->result_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('menu/index',$data);
		$this->load->view('templates/footer' );
	}
	public function addMenu()
	{
		$this->form_validation->set_rules('menu','Menu','trim|required');

		if ($this->form_validation->run() == FALSE) {

			$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = 'Menu Management';
			$data['menu'] = $this->Menu_model->getAll('user_menu')->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/index',$data);
			$this->load->view('templates/footer' );
		} else {
			$data = [
				'menu' => $this->input->post('menu')
			];
			$this->Menu_model->insertData('user_menu',$data);
			$this->session->set_flashdata('info', '<div class="alert alert-success">New Menu has been added !</div>');
			redirect('menu');
		}
		
	}
	public function editMenu()
	{
		$id = $this->input->post('id');
		$data = $this->Menu_model->editData('user_menu',$id);
		echo json_encode($data);

	}
	public function updateMenu()
	{
		$where = $this->input->post('id');

		$data = [
			'menu' => $this->input->post('menu')
		];
		$this->Menu_model->updateMenu('user_menu',$where,$data);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Menu has been updated !</div>');
		redirect('menu');
	}
	public function deleteMenu($id)
	{

		$this->Menu_model->deleteMenu('user_menu',$id);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Menu has been deleted !</div>');
		redirect('menu');
	}

	// Modul Submenu

	public function submenu()
	{
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Submenu Management';
		$data['submenu'] = $this->Menu_model->getSubMenu();
		$data['menu'] = $this->Menu_model->getAll('user_menu')->result_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('menu/submenu',$data);
		$this->load->view('templates/footer' );
	}
	public function addSubMenu()
	{
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('url','Url','trim|required');
		$this->form_validation->set_rules('icon','Icon','trim|required');
		$this->form_validation->set_rules('menu','Menu','trim|required');
		$this->form_validation->set_rules('is_active','Status','trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = 'Submenu Management';
			$data['submenu'] = $this->Menu_model->getSubMenu();
			$data['menu'] = $this->Menu_model->getAll('user_menu')->result_array();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('menu/submenu',$data);
			$this->load->view('templates/footer' );
		} else {
			$data = [
				"title" 	=> $this->input->post('title'),
				"menu_id" 		=> $this->input->post('menu'),
				"url" 		=> $this->input->post('url'),
				"icon" 		=> $this->input->post('icon'),
				"is_active" => $this->input->post('is_active')
			];
			$this->Menu_model->insertData('user_sub_menu',$data);
			$this->session->set_flashdata('info', '<div class="alert alert-success">New Sub Menu has been added !</div>');
			redirect('menu/submenu');
		}
		
	}
	public function editSubMenu()
	{
		$id = $this->input->post('id');
		$data = $this->Menu_model->editData('user_sub_menu',$id);
		echo json_encode($data);

	}
	public function updateSubMenu()
	{
		$where = $this->input->post('id');

		$data = [
			'title' => $this->input->post('title'),
			'menu_id' => $this->input->post('menu_id'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active')
		];
		$this->Menu_model->updateData('user_sub_menu',$where,$data);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Menu has been updated !</div>');
		redirect('menu/submenu');
	}
	public function deleteSubMenu($id)
	{
		$this->Menu_model->deleteMenu('user_sub_menu',$id);
		$this->session->set_flashdata('info', '<div class="alert alert-success">Menu has been deleted !</div>');
		redirect('menu/submenu');
	}


}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */