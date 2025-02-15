<?php 
class StokModel extends CI_Model {

    // Mengambil semua data dari tabel
    public function get_all_data() {
        return $this->db->get('stok')->result_array();
    }

    // Mengambil semua data dari tabel stok dan join dengan master_jenis_barang
    public function get_join_all_data() {
        $this->db->select('*');
        $this->db->from('stok');
        $this->db->join('master_jenis_barang', 'stok.jenis_barang_id = master_jenis_barang.id_jenisbarang', 'left'); // Left join
        $this->db->join('master_sumber', 'stok.sumber_id = master_sumber.id_sumber', 'left'); // Left join
        $this->db->join('master_satuan', 'stok.satuan_id = master_satuan.id_satuan', 'left'); // Left join
        return $this->db->get()->result_array();
    }

    // Mengambil data berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('stok', ['id_stok' => $id])->row_array();
    }

    // Mengambil data berdasarkan ID
    public function cek_kondisi_terkini($id) {
        $this->db->select('kondisi_terkini.jumlah, kondisi_terkini.id_kondisi_terkini, master_kondisi.nama_kondisi, master_jenis_barang.nama_jenisbarang');
        $this->db->from('kondisi_terkini');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left'); // Left join
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left'); // Left join
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left'); // Left join
        $this->db->where('kondisi_terkini.stok_id', $id);
        return $this->db->get()->result_array();
    }

    public function get_kondisi_by_barang_id($stok_id) {
        $this->db->select('*');
        $this->db->from('kondisi_terkini');
        $this->db->where('stok_id', $stok_id);
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan array kondisi
    }

    // Menghapus data berdasarkan ID
    public function delete_data() {
        $this->db->where('id_stok', $id);
        return $this->db->delete('stok');
    }
}

?>