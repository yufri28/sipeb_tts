<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    // Method untuk menyimpan user baru ke dalam database
    public function saveUser($user_data)
    {
        return $this->db->insert('users', $user_data);
    }

    // Method untuk mengambil data user berdasarkan user_id
    public function getUserById($user_id)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->get('users')->row_array();
    }

    // Method untuk mengupdate data user berdasarkan user_id
    public function updateUser($user_id, $user_data)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->update('users', $user_data);
    }

    // Method untuk menghapus user berdasarkan user_id
    public function deleteUser($user_id)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->delete('users');
    }

    public function isUsernameTaken($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function isUsernameTakenByOther($username, $user_id)
    {
        $this->db->where('username', $username);
        $this->db->where('id_user !=', $user_id);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

}
?>