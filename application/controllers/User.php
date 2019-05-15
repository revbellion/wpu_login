<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		
		$this->load->model('User_model');

	}
	public function index()
	{
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'My Profile';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer' );

	}
	public function edit()
	{
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Edit Profile';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('user/edit',$data);
		$this->load->view('templates/footer' );
	}
	public function update()
	{
		$fileLama = $this->input->post('fileLama');
		$namaFile = uniqid();

		$config['upload_path']          = './assets/img/profile';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['file_name']           = $namaFile;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$where = $this->session->userdata('email');
			$data = [
				"name" => $this->input->post('name'),
				"email" => $this->input->post('email'),
				"image" => $fileLama,
			];
			$this->User_model->updateData($where,$data);
			$this->session->set_flashdata('info', 'Profile Berhasil diubah !!');
			redirect('user/edit');

		}
		else
		{
			if ($fileLama != 'default.jpg') {
				unlink(FCPATH . 'assets/img/profile/'.$fileLama);
				$where = $this->session->userdata('email');
				$data = [
					"name" => $this->input->post('name'),
					"email" => $this->input->post('email'),
					"image" => $this->upload->data('file_name'),
				];
				$this->User_model->updateData($where,$data);
				$this->session->set_flashdata('info', 'Profile Berhasil diubah !!');
				redirect('user/edit');			
			}else{
				$where = $this->session->userdata('email');
				$data = [
					"name" => $this->input->post('name'),
					"email" => $this->input->post('email'),
					"image" => $this->upload->data('file_name'),
				];
				$this->User_model->updateData($where,$data);
				$this->session->set_flashdata('info', 'Profile Berhasil diubah !!');
				redirect('user/edit');
			}
		}
	}
	public function changePassword()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('curpass', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]',
			[
				'min_length' => 'Password too short !'
			]);
		$this->form_validation->set_rules('passconf', 'Confirm Passowrd', 'trim|required|min_length[6]|matches[password]',
			[
				'matches' => 'Password don\'t match !',
				'min_length' => 'Password too short !'
			]);

		if ($this->form_validation->run() == FALSE) 
		{
			
			$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = 'Change Password';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('user/changePassword',$data);
			$this->load->view('templates/footer' );

		} else {
			$curpass = $this->input->post('curpass');

			$user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

			if (password_verify($curpass, $user['password'])) 
			{
				if (password_verify($curpass, password_hash($this->input->post('password'),PASSWORD_DEFAULT))) {
					$this->session->set_flashdata('danger', ' Password must be different from old password');

					redirect('user/changePassword');
				}else{

					$data = [ "password" => password_hash($this->input->post('password'),PASSWORD_DEFAULT)];

					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user', $data);
					$this->session->set_flashdata('info', ' Password has been Updated !!');

					redirect('user/changePassword');
				}
			}
			else
			{
				$this->session->set_flashdata('danger', 'Wrong current password !!');
				redirect('user/changePassword');
			}
		}
		
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */