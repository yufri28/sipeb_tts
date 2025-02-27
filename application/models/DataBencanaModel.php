<?php 
class DataBencanaModel extends CI_Model{

    // Mengambil semua data dari tabel
    public function get_all_data() {
        return $this->db->get('bencana')->result_array();
    }

    // Mengambil dan join semua data dari tabel yang dibutuhkan
    public function get_join_all_data() {
        $this->db->select('bencana.*, master_jenis_bencana.nama_bencana');
        $this->db->from('bencana');
        $this->db->join('master_jenis_bencana', 'bencana.jenis_bencana_id = master_jenis_bencana.id_jenis_bencana', 'left'); // Left join
        $this->db->order_by('bencana.id_bencana', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_total_bencana() {
        $this->db->from('bencana'); // Gantilah 'bencana' dengan nama tabel yang sesuai.
        return $this->db->count_all_results();
    }    

    public function get_bencana_bulan_ini() {
        $this->db->from('bencana');  // Nama tabel bencana
        $this->db->where('MONTH(tanggal)', date('m'));  // Filter berdasarkan bulan saat ini
        $this->db->where('YEAR(tanggal)', date('Y'));   // Filter berdasarkan tahun saat ini
        return $this->db->count_all_results();  // Mengembalikan jumlah total bencana
    }    

    // Memasukkan data ke tabel
    public function insert_data($data) {
        return $this->db->insert('bencana', $data);
    }

    // Mengambil data berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('bencana', ['id_bencana' => $id])->row_array();
    }

    // Memperbarui data berdasarkan ID
    public function update_data($id, $data) {
        $this->db->where('id_bencana', $id);
        return $this->db->update('bencana', $data);
    }

    // Menghapus data berdasarkan ID
    public function delete_data($id) {
        $this->db->where('id_bencana', $id);
        return $this->db->delete('bencana');
    }


}


?>