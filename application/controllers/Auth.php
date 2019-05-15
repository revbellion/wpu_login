<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			
			$data['title'] = 'WPU - Login Page';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
		// validasi sukses !!
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password1');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

			// usernya ada 
		if ($user) {
			// jika user aktif
			if ($user['is_active'] == '1') {
				if (password_verify($password,$user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];

					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					}else{
						redirect('user');

					}

				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Wrong Password !!</strong></div>');
					redirect('auth');
				}
			}else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>This Email not activated !</strong></div>');
				redirect('auth');
			}

		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Email is not registered ! </strong></div>');
			redirect('auth');
		}

	}
	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]',
			[
				'is_unique' => 'This email has already registered.'
			]);
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]',
			[
				'matches' => 'Password don\'t match !',
				'min_length' => 'Password too short !'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]',
			[
				'matches' => 'Password don\'t match !',
				'min_length' => 'Password too short !'
			]);
		if ($this->form_validation->run() == FALSE) {
			
			$data['title'] = 'WPU - Registration Page';

			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');

		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name',true)),
				'email' => htmlspecialchars($this->input->post('email',true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];			

			
			// data token

			$token = base64_encode(uniqid()) ;
			$user_token = [
				'email' => $this->input->post('email',true),
				'token' => $token,
				'date_created' => time()
			];


			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token,'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Activated</div>');
			redirect('auth');
		}
	}
	private function _sendEmail($token,$type)
	{
		$config = [

			'protocol' 	=> 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'hendrikadi08@gmail.com',
			'smtp_pass' => 'everyoneisrich1234',
			'smtp_port' => 465,
			'mailtype' 	=> 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n"

		];
		$this->load->library('email',$config);

		$this->email->from('hendrikadi08@gmail.com', 'RevCode');
		$this->email->to($this->input->post('email'));
		
		if ($type == 'verify') {

			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href="'.base_url().'auth/verify?email='. $this->input->post('email') .'&token='. $token . '">Activated</a>');
		} elseif($type == 'forgot'){
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password account : <a href="'.base_url().'auth/resetPasword?email='. $this->input->post('email') .'&token='. $token . '">Reset Password</a>');
		}
		
		if ($this->email->send()) {
			return true;
		}else{
			echo $this->email->print_debugger();
		}
		
		
		
		

	}
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user_token',['email' => $email])->row_array();
		$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
		
		if ($user) {

			if ($user_token) {

				$this->db->set('is_active',1);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->db->delete('user_token',['email' => $email]);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'.$email.'<strong> has been activated! Please login.</strong></div>');
				redirect('auth');


			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Activation account failed! Token invalid.</strong></div>');
				redirect('auth');
			}

			
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Email not registered !!</strong></div>');
			redirect('auth');
		}

	}
	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			
			$data['title'] = 'WPU - Forgot Password';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/forgotPassword');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$result = $this->db->get_where('user',['email' => $email,'is_active' => 1])->row_array();

			if ($result) {
				$token = base64_encode(uniqid()) ;
				$user_token = [
					'email' => $this->input->post('email',true),
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);

				$this->_sendEmail($token,'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Please check your email to reset password !</strong></div>');
				redirect('auth/forgotPassword');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Email not registered or not activated !</strong></div>');
				redirect('auth/forgotPassword');

			}
		}
	}
	public function resetPasword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user_token',['email' => $email])->row_array();
		$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();

		if ($user) {
			if ($user_token) {
				$this->session->set_userdata('reset',$email);
				
				$this->changePassword();
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Reset password failed ! Token invalid</strong></div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Reset password failed ! Wrong email</strong></div>');
			redirect('auth');
		}
	}
	public function changePassword()
	{
		if (!$this->session->userdata('reset')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[passconf]',
			[
				'matches' => 'Password don\'t match !',
				'min_length' => 'Password too short !'
			]);
		$this->form_validation->set_rules('passconf', 'Password', 'trim|required|matches[password]',
			[
				'matches' => 'Password don\'t match !',
				'min_length' => 'Password too short !'
			]);
		
		if ($this->form_validation->run() == FALSE) {
			
			$data['title'] = 'WPU - Change Password';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/changePassword');
			$this->load->view('templates/auth_footer');
		} else {
			
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			$this->db->set('password',$password);
			$this->db->where('email', $this->session->userdata('reset'));
			$this->db->update('user');

			$this->db->delete('user_token',['email' => $this->session->userdata('reset')]);

			$this->session->unset_userdata('reset');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Reset password success ! Please login.</strong></div>');
			redirect('auth');
		}
		
	}


	public function blocked()
	{
		$this->load->view('error_404');
	}
	public function logout()
	{

		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>You have been logout !!!</strong></div>');
		redirect('auth');

	}


}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */