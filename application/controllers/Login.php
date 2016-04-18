<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		$this->load->view('user_login');
	}
		public function logged_in()
	{
		$this->load->view('user_logged_in');
	}


	public function login_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");

		if($this->form_validation->run() === FALSE)

		{
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url());
		}
		else
		{
			$this->load->model("User");
			$user_info = $this->input->post();
			$get_user = $this->User->get_user($this->input->post());

			if ($get_user)
			{
				$this->session->set_userdata($get_user);
				redirect(base_url("login/logged_in"));
			}
			else
			{
				$this->session->set_flashdata("login_errors", "Invalid email and/or password");
				redirect($uri = base_url());
			}
		}
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect($uri = base_url());
	}

	public function register(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email2", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password2]");
		$this->form_validation->set_rules("password2", "Password", "trim|required|min_length[8]|do_hash");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean");

		if($this->form_validation->run() === FALSE)

		{
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("reg_errors", $errors);
			redirect(base_url());
		}
		else
		{
			$this->load->model("User");
			$user_info = $this->input->post();
			$add_user = $this->User->add_user($user_info);

			if ($add_user){
				$this->session->set_userdata($add_user);
				redirect($uri = base_url("login/logged_in"));
			}
			else{
				$this->session->set_flashdata("login_error2", "E-Mail Address is already registered");
				redirect($uri = base_url());
			}
		}
	}
}

 ?>