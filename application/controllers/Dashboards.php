<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function index(){
		$this->load->view('main');
	}
	public function sign_in(){
		$this->load->view('signin');
	}
	public function registration(){
		$this->load->view('register');
	}
	public function signin_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail Address", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|do_hash");

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect($uri = base_url("/signin"));
		}
		else {
			$this->load->model('Dashboard');
			$user_info = $this->input->post();
			$user_signin = $this->Dashboard->signin($user_info);
			
			if($user_signin) {
				$this->session->set_userdata($user_signin);
				if($user_signin['admin_rights'] == 1){
					$this->load->view('admin_dashboard');
				}
				else {
					redirect($uri = base_url('/dashboard_user'));
				}
			}
			else {
				$this->session->set_flashdata("login_error", "The E-Mail or Password information is incorrect.");
				redirect($uri = base_url("/signin"));
			}
		}
	}

	public function register_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail Address", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|do_hash");
		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect($uri = base_url());
		}

	}

}

 ?>