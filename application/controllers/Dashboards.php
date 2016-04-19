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
	public function view_admin_dash(){
		$this->load->model('Dashboard');
		$all_users = $this->Dashboard->get_all_users();
		$this->load->view('admin_dashboard', ['all_users' => $all_users]);
	}
	public function view_user_dash(){
		$this->load->model('Dashboard');
		$all_users = $this->Dashboard->get_all_users();
		$this->load->view('user_dashboard', ['all_users' => $all_users]);
	}
	public function add_user(){
		$this->load->view('add_user');
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
				$this->session->set_userdata(['user_info' => $user_signin]);
				if($user_signin['admin_rights'] == 1){
					redirect("Dashboards/view_admin_dash");
				}
				else {
					redirect("Dashboards/view_user_dash");
				}
			}
			else {
				$this->session->set_flashdata("login_error", "The E-Mail or Password information is incorrect.");
				redirect($uri = base_url("/signin"));
			}
		}
	}

	public function logoff(){
		$this->session->sess_destroy();
		redirect($uri = base_url());
	}

	public function reg_process(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean");
		if($this->form_validation->run() === FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url("/register"));
		}
		else
		{
			$this->load->model("Dashboard");
			$user_info = $this->input->post();
			$add_user = $this->Dashboard->add_user($user_info);
			$session_id = $this->session->userdata('user_info');

			if ($add_user){
				if($session_id['id']){
					redirect($uri = base_url('/admin_dashboard'));
				}
				else {
				redirect($uri = base_url("/signin"));
				}
			}	
			else{
				if($session_id['id']){
					$this->session->set_flashdata("login_error", "E-Mail Address is already registered");
					redirect($uri = base_url('/add_user'));
				}
				else {
					die('2');
					$this->session->set_flashdata("login_error", "E-Mail Address is already registered");
					redirect($uri = base_url('/register'));
				}
			}
		}
	}

}

 ?>