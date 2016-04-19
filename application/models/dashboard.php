<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Model{

	public function signin($user_info){
		$query = "SELECT concat(first_name, \" \", last_name) as full_name, first_name, last_name, admin_rights, id, created_on, description FROM users where email = ? AND password = ?";
		$user = [$user_info['email'], $user_info['password']];
		return $this->db->query($query, $user)->row_array();
	}

	public function get_all_users(){
		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users";
		return $this->db->query($query)->result_array();
	}

	public function add_user($user_info){
		$query = "INSERT INTO users(first_name, last_name, email, password, admin_rights, created_on, updated_on) VALUES(?, ?, ?, ?, 0, now(), now())";
		$query2 = "SELECT users.email FROM users WHERE email = ?;";
		$user = [$user_info['first_name'], $user_info['last_name'], $user_info['email'], $user_info['password']];
		$user2 = [$user_info['email']]; 
		if($this->db->query($query2, $user2)->row_array() == null){
			$this->db->query($query, $user);
			return TRUE;
		}
		else {
			return FALSE;
		}
	}



}


 ?>