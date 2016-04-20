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
	public function view_profile($id){
		$this->load->model('Dashboard');
		$user_info = $this->Dashboard->get_one_user($id);
		$this->load->view('edit_profile', ['profile_info' => $user_info]);
	}
	public function view_user($id){
		$this->load->model('Dashboard');
		$user_info = $this->Dashboard->get_one_user($id);
		$this->load->view('edit_profile', ['profile_info' => $user_info]);
	}
	public function view_user_admin($id){
		$this->load->model('Dashboard');
		$user_info = $this->Dashboard->get_one_user($id);
		$this->load->view('edit_user', ['profile_info' => $user_info]);
	}
	public function show_user_page($id) {
		$this->load->model('Dashboard');
		$message_info = $this->Dashboard->get_messages($id);
		$wall_user = $this->Dashboard->get_wall_user($id);
		$comment_info = $this->Dashboard->get_comments($id);
		$this->load->view('user_page', ['message_info' => $message_info, 'wall_info' => $wall_user, 'comment_info' => $comment_info]);
	}
	public function create_message(){
		$post_message = $this->input->post();
		$this->load->model('Dashboard');
		$this->Dashboard->add_message($post_message);
		redirect("/show_user_page/" . $post_message['wall_id']);
	}
		public function create_comment($id){
		$post_comment = $this->input->post();
		$this->load->model('Dashboard');
		$this->Dashboard->add_comment($post_comment);
		redirect("/show_user_page/" . $id);
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
				$this->session->set_userdata(['logged_info' => $user_signin]);
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
	// This funcation regulates the registration process of new users from the new user registration page or from the admin-add new user page.
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
			$session_id = $this->session->userdata('logged_info');

			if ($add_user){
				if($session_id['admin_rights'] == '1'){
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
					$this->session->set_flashdata("login_error", "E-Mail Address is already registered");
					redirect($uri = base_url('/register'));
				}
			}
		}
	}
	// This function regulates the updating of e mail, first and last names on the user profile page.
	public function edit_profile_info(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean");
		if($this->form_validation->run() === FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url("/edit_profile"));
		}
		else
		{
			$this->load->model("Dashboard");
			$user_info = $this->input->post();
			$edit_user = $this->Dashboard->edit_info($user_info);
			$this->session->set_userdata(['logged_info' => $edit_user]);
			if ($edit_user['admin_rights'] == '1') {
			redirect($uri = base_url("/admin_dashboard"));
			}
			else {
			redirect($uri = base_url("/user_dashboard"));
			}
		}
	}
	//This function regulates the edit user information via the admin dashboard edit link.
		public function edit_user(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean");
		if($this->form_validation->run() === FALSE){
			$errors = $this->form_validation->getErrorsArray();
			$this->session->set_flashdata("errors", $errors);
			redirect(base_url("/edit_user"));
		}
		else
		{
			$this->load->model("Dashboard");
			$user_info = $this->input->post();
			$edit_user = $this->Dashboard->edit_info_admin($user_info);
			redirect($uri = base_url("/admin_dashboard"));
		}
	}
		// This funcation regulates the updating of the description section of the users' profile page.
		public function edit_profile_desc(){
			$this->load->model("Dashboard");
			$user_info = $this->input->post();
			$edit_user = $this->Dashboard->edit_profile_descript($user_info);
			$this->session->set_userdata(['logged_info' => $edit_user]);
			if ($edit_user['admin_rights'] == '1') {
			redirect($uri = base_url("/admin_dashboard"));
			}
			else {
			redirect($uri = base_url("/user_dashboard"));
			}
		}
	
		// This function regulates the editing of a password from either the user profile page or from the Admin Edit user page.
		public function edit_password(){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules("confirmpass", "Confirm Password", "trim|required|matches[password]");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|do_hash");
			if($this->form_validation->run() === FALSE){
				$errors = $this->form_validation->getErrorsArray();
				$this->session->set_flashdata("errors", $errors);
				$session_id = $this->session->userdata('user_info');
				redirect("/profile/" . $session_id['id']);
			}
			else
			{
				$this->load->model("Dashboard");
				$user_info = $this->input->post();
				$update_pass = $this->Dashboard->update_pass($user_info);
				$session_id = $this->session->userdata('user_info');
				if ($session_id['admin_rights'] == 1) {
				redirect($uri = base_url("/admin_dashboard"));
				}
				else {
				redirect($uri = base_url("/user_dashboard"));
				}
			}
		}	
	public function remove ($id){
		$this->load->model("Dashboard");
		$this->Dashboard->remove_user($id);
		redirect($uri = base_url("/admin_dashboard"));
	}

}

 ?>