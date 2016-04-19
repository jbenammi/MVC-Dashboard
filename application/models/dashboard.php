<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Model{

	public function signin($user_info){
		$query = "SELECT concat(first_name, \" \", last_name) as full_name, first_name, last_name, admin_rights, id, created_on, description FROM users where email = ? AND password = ?";
		$user = [$user_info['email'], $user_info['password']];
		return $this->db->query($query, $user)->row_array();
	}


}


 ?>