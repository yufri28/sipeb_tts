<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }
    
    public function get_user() {
        $this->db->where('username !=', 'administrator');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function add_default_admin() {
        $data = array(
            'username' => 'administrator',
            'name' => 'administrator',
            'password' => password_hash("administrator123", PASSWORD_DEFAULT),
            'role' => 'administrator',
            'aktifitas' => 'aktif'
        );
        $this->db->insert('users', $data);
    }

    public function cek_default_admin() {
        $get_data = $this->db->get_where('users', ['username' => 'administrator'])->num_rows();
        return $get_data > 0;
    }
}