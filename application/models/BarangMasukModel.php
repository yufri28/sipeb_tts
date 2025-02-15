<?php 
class BarangMasukModel extends CI_Model {

    // Mengambil semua data dari tabel
    public function get_all_data() {
        return $this->db->get('stok')->result_array();
    }

    // Mengambil semua data dari tabel stok dan join dengan master_jenis_barang
    public function get_join_all_data() {
        $this->db->select('stok.*, master_jenis_barang.nama_jenisbarang, master_sumber.nama_sumber');
        $this->db->from('stok');
        $this->db->join('master_jenis_barang', 'stok.jenis_barang_id = master_jenis_barang.id_jenisbarang', 'left'); // Left join
        $this->db->join('master_sumber', 'stok.sumber_id = master_sumber.id_sumber', 'left'); // Left join
        return $this->db->get()->result_array();
    }

    // Memasukkan data ke tabel
    public function insert_data($data) {
        return $this->db->insert('stok', $data);
    }

    // Mengambil data berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('stok', ['id_stok' => $id])->row_array();
    }

    // Memperbarui data berdasarkan ID
    public function update_data($id, $data) {
        $this->db->where('id_stok', $id);
        return $this->db->update('stok', $data);
    }

    // Menghapus data berdasarkan ID
    public function delete_data() {
        $this->db->where('id_stok', $id);
        return $this->db->delete('stok');
    }
}

?>