<?php 

class BarangKeluarModel extends CI_Model {
    public function get_join_barang_keluar(){
        $this->db->select('barang_keluar.*, sum(barang_keluar.jumlah) AS total_barang, stok.id_stok, kondisi_terkini.id_kondisi_terkini, kondisi_terkini.kondisi_logpal_id, master_jenis_barang.nama_jenisbarang, master_kondisi.nama_kondisi, IFNULL(ba_serah_terima.id_serah_terima, NULL) AS id_serah_terima');
        $this->db->from('barang_keluar');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = barang_keluar.kondisi_terkini_id', 'left');
        $this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
        $this->db->join('master_kondisi', 'master_kondisi.id_kondisi = kondisi_terkini.kondisi_logpal_id', 'left');
        $this->db->join('ba_serah_terima', 'ba_serah_terima.batch_id = barang_keluar.batch_id', 'left');
        $this->db->group_by('barang_keluar.batch_id');
        $this->db->order_by('barang_keluar.id_barang_keluar', 'DESC');
        return $this->db->get()->result_array();
    }    
        
    public function get_all_barang_keluar($batch_id){
        $this->db->select('barang_keluar.*, stok.id_stok, kondisi_terkini.id_kondisi_terkini, kondisi_terkini.kondisi_logpal_id, master_jenis_barang.nama_jenisbarang, master_kondisi.nama_kondisi, master_satuan.nama_satuan, master_sumber.nama_sumber');
        $this->db->from('barang_keluar');
        $this->db->join('detail_kondisi', 'detail_kondisi.id_detail = barang_keluar.kondisi_terkini_id', 'left');
        $this->db->join('kondisi_terkini', 'kondisi_terkini.id_kondisi_terkini = detail_kondisi.kondisi_terkini_id', 'left');
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

    public function get_data_detail_terkini()
    {
        $query = $this->db->query("
			SELECT stok.id_stok, stok.tahun, stok.keterangan_tambahan, stok.tanggal_masuk,
				master_jenis_barang.nama_jenisbarang,
				detail_kondisi.foto, kondisi_terkini.id_kondisi_terkini, detail_kondisi.id_detail, 
                detail_kondisi.kode, detail_kondisi.status,
                kondisi_terkini.stok_terkini
			FROM stok 
			LEFT JOIN master_jenis_barang ON master_jenis_barang.id_jenisbarang = stok.jenis_barang_id
			LEFT JOIN kondisi_terkini ON kondisi_terkini.stok_id = stok.id_stok
			JOIN detail_kondisi ON detail_kondisi.kondisi_terkini_id = kondisi_terkini.id_kondisi_terkini
			WHERE stok.masuk_stok = 'sudah'
		");

		$data = $query->result_array();
       
        return $data;
    }

    public function get_data_serah_terima($batch_id)
    {
        return $this->db->get_where('ba_serah_terima', ['batch_id' => $batch_id])->row_array();
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

    public function update_data_serah_terima($batch_id, $data)
    {
        $this->db->where('batch_id', $batch_id);
        return $this->db->update('ba_serah_terima', $data);
    }

	// Memasukkan data ke tabel
    public function insert_data($data) {
        return $this->db->insert('barang_keluar', $data);
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

    public function get_barang_keluar_by_batch($batch_id)
    {
        return $this->db->get_where('barang_keluar', ['batch_id' => $batch_id])->result_array();
    }

    public function get_barang_keluar_by_id($id_barang_keluar)
    {
        return $this->db->get_where('barang_keluar', ['id_barang_keluar' => $id_barang_keluar])->row_array();
    }

    public function get_fkp(){
        $this->db->select('foto_kondisi_peminjaman.*');
        $this->db->from('foto_kondisi_peminjaman');
        $this->db->join('peminjaman', 'peminjaman.batch_id = foto_kondisi_peminjaman.batch_id', 'left');
         
        return $this->db->get()->result_array();
    }

    public function get_foto_peminjaman($batch_id)
    {
        return $this->db->get_where('foto_kondisi_peminjaman', [
            'batch_id' => $batch_id
        ])->result_array();
    }


    // public function delete_data($id_barang_keluar)
    // {
    //     return $this->db->delete('barang_keluar', ['id_barang_keluar' => $id_barang_keluar]);
    // }

    public function delete_data($id_barang_keluar)
    {
        // Start the transaction
        $this->db->trans_begin();
        
        // Step 1: Retrieve the batch_id based on id_barang_keluar
        $this->db->select('batch_id');
        $this->db->from('barang_keluar');
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        $batch_barang_keluar = $this->db->get()->row_array();
        
        $this->db->select('batch_id');
        $this->db->from('ba_serah_terima');
        $this->db->where('batch_id', $batch_barang_keluar['batch_id']);
        $batch_ba_serah_terima = $this->db->get()->row_array();

        // Step 2: Delete related record from ba_serah_terima using batch_id (if batch_id is found)
        if ($batch_ba_serah_terima && !empty($batch_ba_serah_terima['batch_id'])) {
            $this->db->delete('ba_serah_terima', ['batch_id' => $batch_ba_serah_terima['batch_id']]);
            // Check if the deletion failed
            if ($this->db->affected_rows() == 0) {
                // If deletion failed, rollback and return failure
                $this->db->trans_rollback();
                return false;
            }
        }

        // Step 3: Delete the record from barang_keluar table
        $this->db->delete('barang_keluar', ['id_barang_keluar' => $id_barang_keluar]);

        // Check if the deletion from barang_keluar failed
        if ($this->db->affected_rows() == 0) {
            // If deletion failed, rollback and return failure
            $this->db->trans_rollback();
            return false;
        }

        // If both deletions were successful, commit the transaction
        $this->db->trans_commit();

        return true;
    }
    
}


?>