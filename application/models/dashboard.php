<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Model{

	public function signin($user_info){
		$query = "SELECT concat(first_name, \" \", last_name) as full_name, first_name, last_name, admin_rights, id, created_on, description, email FROM users where email = ? AND password = ?";
		$user = [$user_info['email'], $user_info['password']];
		return $this->db->query($query, $user)->row_array();
	}

	public function get_all_users(){
		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users";
		return $this->db->query($query)->result_array();
	}
	public function get_one_user($id){
		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users WHERE id = ?";
		$user_id = [$id];
		return $this->db->query($query, $user_id)->row_array();
	}

	public function get_messages($id){
		$query = "SELECT messages.id, messages.message, messages.created_on, messages.wall_id, concat(users.first_name, \" \", users.last_name) as author FROM messages JOIN users ON users.id = messages.users_id WHERE messages.wall_id = $id ORDER BY created_on desc";
		return $this->db->query($query)->result_array();
	}
	public function get_wall_user($id){
		$query = "SELECT concat(first_name, \" \", last_name) as full_name, first_name, last_name, id, created_on, email, description FROM users where id = $id";
		return $this->db->query($query)->row_array();
	}
	public function get_comments($id){
		$query = "SELECT messages.id as message_id, messages.wall_id, comments.comment, comments.created_on, concat(users.first_name, \" \", users.last_name) as author FROM messages  JOIN comments ON comments.messages_id = messages.id  JOIN users ON comments.users_id = users.id WHERE messages.wall_id = $id";
		return $this->db->query($query)->result_array();
	}
	public function add_message($msg_info){
		$query = "INSERT INTO messages(message, created_on, updated_on, users_id, wall_id) VALUES(?, now(), now(), ?, ?)";
		$q_info = [$msg_info['message'], $msg_info['author_id'], $msg_info['wall_id']];
		$this->db->query($query, $q_info);
	}
	public function add_comment($cmnt_info){
		$query = "INSERT INTO comments(comment, created_on, updated_on, messages_id, users_id) VALUES(?, now(), now(), ?, ?)";
		$q_info = [$cmnt_info['comment'], $cmnt_info['message_id'], $cmnt_info['author_id']];
		$this->db->query($query, $q_info);
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

	public function edit_info($user_info){
		$user = ['first_name' => $user_info['first_name'], 'last_name' => $user_info['last_name'], 'email' =>$user_info['email']];
		$this->db->where('id', $user_info['id']);
		$this->db->update('users', $user);

		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users WHERE id = ?";
		$user_id = [$user_info['id']];
		return $this->db->query($query, $user_id)->row_array();
	}

	public function edit_info_admin($user_info){
		$user = ['first_name' => $user_info['first_name'], 'last_name' => $user_info['last_name'], 'email' =>$user_info['email'], 'admin_rights' => $user_info['admin_rights']];
		$this->db->where('id', $user_info['id']);
		$this->db->update('users', $user);

		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users WHERE id = ?";
		$user_id = [$user_info['id']];
		return $this->db->query($query, $user_id)->row_array();
	}

	public function edit_profile_descript($user_info){
		$user = ['description' => $user_info['description']];
		$this->db->where('id', $user_info['id']);
		$this->db->update('users', $user);
		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users WHERE id = ?";
		$user_id = [$user_info['id']];
		return $this->db->query($query, $user_id)->row_array();
	}

	public function update_pass($user_info){
		$user = ['password' => $user_info['password']];
		$this->db->where('id', $user_info['id']);
		$this->db->update('users', $user);

		$query = "SELECT id, concat(first_name, \" \", last_name) as full_name, first_name, last_name, email,created_on, admin_rights, description FROM users WHERE id = ?";
		$user_id = [$user_info['id']];
		return $this->db->query($query, $user_id)->row_array();
	}
	public function remove_user($id){
		$query = "DELETE FROM users WHERE id = ?";
		$user_id = [$id];
		return $this->db->query($query, $user_id);
	}

}


 ?>