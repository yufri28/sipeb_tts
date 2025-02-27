<?php 

class PeminjamanModel extends CI_Model {
    public function get_join_pinjaman($id){
        $this->db->select('*, sum(barang_pinjam.jumlah) AS jumlah_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang_pinjam', 'barang_pinjam.batch_id = peminjaman.batch_id', 'left');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_pinjam.kondisi_terkini_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('users', 'users.id_user = peminjaman.user_id', 'left');
        $this->db->where('peminjaman.user_id', $id);
        $this->db->group_by('peminjaman.id_pinjam');
        $this->db->order_by('peminjaman.id_pinjam', 'DESC');
        return $this->db->get()->result_array();
    }  
    
    public function get_all_pinjaman($status_diterima){
        $this->db->select('*, sum(barang_pinjam.jumlah) AS jumlah_barang, peminjaman.batch_id AS batch');
        $this->db->from('peminjaman');
        $this->db->join('barang_pinjam', 'barang_pinjam.batch_id = peminjaman.batch_id', 'left');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_pinjam.kondisi_terkini_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('users', 'users.id_user = peminjaman.user_id', 'left');

        if($status_diterima != 'all'){
            $this->db->where('peminjaman.status_diterima', $status_diterima);
        }
        $this->db->group_by('peminjaman.id_pinjam');
        $this->db->order_by('peminjaman.id_pinjam', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_pinjaman($status_diterima){
        $this->db->select('*, sum(barang_pinjam.jumlah) AS jumlah_barang');
        $this->db->from('peminjaman');
        $this->db->join('barang_pinjam', 'barang_pinjam.batch_id = peminjaman.batch_id', 'left');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_pinjam.kondisi_terkini_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('users', 'users.id_user = peminjaman.user_id', 'left');        
        if($status_diterima != 'all'){
            $this->db->where('peminjaman.status_diterima', $status_diterima);
        }
        $this->db->group_by('peminjaman.id_pinjam');
        $this->db->order_by('peminjaman.id_pinjam', 'DESC');
        return $this->db->get()->row_array();
    }
        
    public function get_all_barang_keluar($batch_id){
        $this->db->select('barang_keluar.*, stok.id_stok, kondisi_terkini.id_kondisi_terkini, kondisi_terkini.kondisi_logpal_id, master_jenis_barang.nama_jenisbarang, master_kondisi.nama_kondisi, master_satuan.nama_satuan, master_sumber.nama_sumber');
        $this->db->from('barang_keluar');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_keluar.kondisi_terkini_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->join('master_satuan', 'master_satuan.id_satuan = stok.satuan_id', 'left');
        $this->db->join('master_sumber', 'master_sumber.id_sumber = stok.sumber_id', 'left');
        $this->db->where('barang_keluar.batch_id', $batch_id);
        $this->db->order_by('barang_keluar.id_barang_keluar', 'DESC');
        return $this->db->get()->result_array();
    }    
    
    public function get_data_stok_barang() {
		$this->db->select('kondisi_terkini.id_kondisi_terkini, 
						   master_jenis_barang.nama_jenisbarang, 
						   kondisi_terkini.stok_terkini, 
						   stok.tahun,
						   master_kondisi.nama_kondisi');
		$this->db->from('kondisi_terkini');
		$this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
		$this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
	
		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_jumlah_peminjaman($status, $id_auth = null)
    {   
        $this->db->select('count(id_pinjam) AS jumlah');
        $this->db->from('peminjaman');
        if($id_auth != null){
            $this->db->where('peminjaman.user_id', $id_auth);
        }
        $this->db->where('peminjaman.status_diterima', $status);
        return $this->db->get()->row_array();
    }

    public function get_peminjaman_diterima()
    {   
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->where('status_diterima','terima');
        $this->db->where('status_peminjaman', 'belum');
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_barang_pinjam($id = null)
    {   
        $this->db->select('barang_pinjam.*, master_jenis_barang.*');
		$this->db->from('barang_pinjam');
        $this->db->join('peminjaman', 'peminjaman.batch_id = barang_pinjam.batch_id', 'left');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_pinjam.kondisi_terkini_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
		if($id != null){
            $this->db->where('peminjaman.user_id', $id);
        }
        return $this->db->get()->result_array();
    }

    public function get_data_peminjaman($batch_id)
    {
        return $this->db->get_where('peminjaman', ['batch_id' => $batch_id])->row_array();
    }

    public function get_barang_keluar_per_bulan() {
        $this->db->select('master_jenis_barang.nama_jenisbarang, DATE_FORMAT(barang_keluar.tanggal, "%b %Y") as bulan, SUM(barang_keluar.jumlah) as total_barang, master_kondisi.nama_kondisi');
        $this->db->from('barang_keluar');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_keluar.kondisi_terkini_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->group_by(['master_jenis_barang.nama_jenisbarang', 'bulan']);
        $this->db->order_by('barang_keluar.tanggal', 'DESC');
        
        return $this->db->get()->result_array();
    }       
    
    public function get_jumlah_perbulan() {
        $this->db->select_sum('jumlah', 'barang_keluar_bulan_ini');
        $this->db->where('MONTH(tanggal)', 'MONTH(CURRENT_DATE())', FALSE);
        $this->db->where('YEAR(tanggal)', 'YEAR(CURRENT_DATE())', FALSE);
        $query = $this->db->get('barang_keluar');
        return $query->row_array();
    }   
    
    public function get_barang_keluar_bulan_ini() {
        $this->db->select_sum('jumlah');  // Mengambil jumlah total barang keluar
        $this->db->from('barang_keluar');  // Nama tabel barang keluar
        $this->db->where('MONTH(tanggal)', date('m'));  // Filter berdasarkan bulan saat ini
        $this->db->where('YEAR(tanggal)', date('Y'));   // Filter berdasarkan tahun saat ini
        return $this->db->get()->row()->jumlah;  // Mengembalikan jumlah barang keluar
    }    

    public function update_data_peminjaman($batch_id, $data)
    {
        $this->db->where('batch_id', $batch_id);
        return $this->db->update('peminjaman', $data);
    }

	// Memasukkan data ke tabel
    public function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

	// Memasukkan data ke tabel ba_serah_terima 
    public function insert_data_serah_terima($data) {
        return $this->db->insert('ba_serah_terima', $data);
    }

    public function update_data($id_barang_keluar, $data)
    {
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        return $this->db->update('barang_keluar', $data);
    }

    public function get_barang_pinjam_by_batch($batch_id)
    {
        return $this->db->get_where('barang_pinjam', ['batch_id' => $batch_id])->result_array();
    }

    public function get_barang_keluar_by_id($id_barang_keluar)
    {
        return $this->db->get_where('barang_keluar', ['id_barang_keluar' => $id_barang_keluar])->row_array();
    }


    public function delete_data($id_barang_pinjam)
    {
        // Pastikan id_barang_pinjam valid
        if (empty($id_barang_pinjam)) {
            return false;
        }

        // Start transaction
        $this->db->trans_start();

        // Ambil batch_id dari tabel barang_pinjam
        $this->db->select('batch_id');
        $this->db->from('barang_pinjam');
        $this->db->where('id_barang_pinjam', $id_barang_pinjam);
        $batch_barang_pinjam = $this->db->get()->row_array();

        if (empty($batch_barang_pinjam)) {
            // Rollback jika data tidak ditemukan
            $this->db->trans_rollback();
            return false;
        }

        // Hapus data di tabel peminjaman
        $this->db->delete('peminjaman', ['batch_id' => $batch_barang_pinjam['batch_id']]);

        if ($this->db->affected_rows() == 0) {
            echo 'masuk 1';
            die;
            // Jika penghapusan peminjaman gagal, rollback dan return false
            $this->db->trans_rollback();
            return false;
        }

        

        // Hapus data di tabel barang_pinjam
        $this->db->delete('barang_pinjam', ['id_barang_pinjam' => $id_barang_pinjam]);

        if ($this->db->affected_rows() == 0) {
            echo 'masuk 2';
            die;
            // Jika penghapusan barang_pinjam gagal, rollback dan return false
            $this->db->trans_rollback();
            return false;
        }

        // Commit transaksi jika semua berhasil
        $this->db->trans_commit();
        return true;
    }
        
}


?>