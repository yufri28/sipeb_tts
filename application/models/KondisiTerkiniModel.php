<?php 
class KondisiTerkiniModel extends CI_Model {

    // Mengambil semua data dari tabel
    public function get_all_data() {
        return $this->db->get('kondisi_terkini')->result_array();
    }

    // Memasukkan data ke tabel
    public function insert_data($data) {
        // Insert data ke database
        if ($this->db->insert('kondisi_terkini', $data)) {
            return true;  // Berhasil insert
        } else {
            return false; // Gagal insert
        }
    }

    // Mengambil data berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('kondisi_terkini', ['id_kondisi_terkini' => $id])->row_array();
    }

    // Mengambil data berdasarkan ID
    public function get_data_kondisi_by_id($id) {
        return $this->db->get_where('kondisi_terkini', ['id_kondisi_terkini' => $id])->row_array();
    }

    // Memperbarui data berdasarkan ID
    public function update_data($id, $data) {
        $this->db->where('id_kondisi_terkini', $id);
        return $this->db->update('kondisi_terkini', $data);
    }

    // Menghapus data berdasarkan ID
    public function delete_data() {
        $this->db->where('id_kondisi_terkini', $id);
        return $this->db->delete('kondisi_terkini');
    }

    public function get_by_stok_and_kondisi($stok_id, $kondisi_id)
    {
        // Query untuk mendapatkan data kondisi berdasarkan stok_id dan kondisi_id
        $this->db->where('stok_id', $stok_id);
        $this->db->where('kondisi_logpal_id', $kondisi_id);
        $query = $this->db->get('kondisi_terkini');

        // Cek apakah ada hasil yang ditemukan
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Kembalikan hasil sebagai array
        } else {
            return false; // Jika tidak ditemukan, kembalikan false
        }
    }

}

?>