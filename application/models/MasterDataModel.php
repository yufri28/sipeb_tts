<?php 
class MasterDataModel extends CI_Model {

    // Mengambil semua data dari tabel
    public function get_all_data($table) {
        return $this->db->get($table)->result_array();
    }

    // Memasukkan data ke tabel
    public function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

    // Mengambil data berdasarkan ID
    public function get_data_by_id($table, $where) {
        return $this->db->get_where($table, $where)->row_array();
    }

    // Memperbarui data berdasarkan ID
    public function update_data($table, $where, $data) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    // Menghapus data berdasarkan ID
    public function delete_data($table, $where) {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    
}

?>