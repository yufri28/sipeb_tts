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

    public function update_jumlah($id, $jumlah, $action = 'kurangi')
    {
        if ($action === 'kurangi') {
            // Mengurangi stok_terkini dengan jumlah yang diberikan
            $this->db->set('stok_terkini', 'stok_terkini - ' . (int)$jumlah, FALSE);
        } elseif ($action == 'tambah') {
            // Menambah stok_terkini dengan jumlah yang diberikan
            $this->db->set('stok_terkini', 'stok_terkini + ' . (int)$jumlah, FALSE);
        } else {
            return false; // Action tidak valid
        }

        // Update stok_terkini berdasarkan id_kondisi_terkini
        $this->db->where('id_kondisi_terkini', $id);
        $this->db->update('kondisi_terkini');

        // Cek apakah ada baris yang di-update
        if ($this->db->affected_rows() > 0) {
            return true; // Menandakan bahwa pembaruan berhasil
        } else {
            return false; // Menandakan tidak ada perubahan (misalnya ID tidak ditemukan)
        }
    }


    // public function update_jumlah($id, $jumlah)
    // {
    //     // Mengurangi kondisi_terkini dengan jumlah yang diberikan
    //     $this->db->set('stok_terkini', 'stok_terkini - ' . (int)$jumlah, FALSE);
    //     $this->db->where('id_kondisi_terkini', $id);
    //     $this->db->update('kondisi_terkini'); // Ganti 'produk' dengan nama tabel yang sesuai

    //     if ($this->db->affected_rows() > 0) {
    //         return true; // Menandakan bahwa pembaruan berhasil
    //     } else {
    //         return false; // Menandakan bahwa tidak ada perubahan (misalnya ID tidak ditemukan)
    //     }
    // }
    


}

?>