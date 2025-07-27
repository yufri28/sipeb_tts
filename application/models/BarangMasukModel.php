<?php 
class BarangMasukModel extends CI_Model {

    // Mengambil semua data dari tabel
    public function get_all_data() {
        return $this->db->get('stok')->result_array();
    }

    // Mengambil semua data dari tabel stok dan join dengan master_jenis_barang
    public function get_join_all_data() {
        $this->db->select('stok.*, master_jenis_barang.nama_jenisbarang, master_jenis_barang.id_jenisbarang, master_sumber.nama_sumber');
        $this->db->from('stok');
        $this->db->join('master_jenis_barang', 'stok.jenis_barang_id = master_jenis_barang.id_jenisbarang', 'left'); // Left join
        $this->db->join('master_sumber', 'stok.sumber_id = master_sumber.id_sumber', 'left'); // Left join
        return $this->db->get()->result_array();
    }

    public function get_barang_masuk_per_bulan() {
        // Query untuk menghitung total barang masuk per jenis barang dan per bulan
        $this->db->select('master_jenis_barang.nama_jenisbarang, DATE_FORMAT(stok.tanggal_masuk, "%b %Y") as bulan, SUM(stok.jumlah) as jumlah');
        $this->db->from('stok');
        $this->db->join('master_jenis_barang', 'stok.jenis_barang_id = master_jenis_barang.id_jenisbarang'); // Join untuk mendapatkan nama barang
        $this->db->group_by(['master_jenis_barang.nama_jenisbarang', 'bulan']);  // Kelompokkan berdasarkan nama barang dan bulan
        $this->db->order_by('bulan', 'ASC');  // Urutkan berdasarkan bulan
    
        return $this->db->get()->result_array();  // Kembalikan hasil dalam bentuk array
    }    

    public function get_jumlah_barang_masuk_perbulan() {
        $this->db->select_sum('jumlah', 'barang_masuk_bulan_ini');
        $this->db->where('MONTH(tanggal_masuk)', 'MONTH(CURRENT_DATE())', FALSE);
        $this->db->where('YEAR(tanggal_masuk)', 'YEAR(CURRENT_DATE())', FALSE);
        $query = $this->db->get('stok');
        return $query->row_array();
    }    

    public function get_barang_masuk_bulan_ini() {
        $this->db->select_sum('jumlah');  // Mengambil jumlah total barang masuk
        $this->db->from('stok');  // Nama tabel barang masuk
        $this->db->where('MONTH(tanggal_masuk)', date('m'));  // Filter berdasarkan bulan saat ini
        $this->db->where('YEAR(tanggal_masuk)', date('Y'));   // Filter berdasarkan tahun saat ini
        return $this->db->get()->row()->jumlah;  // Mengembalikan jumlah barang masuk
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