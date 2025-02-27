<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokBarang extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('stokmodel');
		if (!$this->session->userdata('id_auth')) {
			redirect(base_url('auth'));
		}

		if ($this->session->userdata('role') == 'pengguna' || $this->session->userdata('role') == 'kepala_dinas') {
			$this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman tersebut. Silahkan login dan masuk ke halaman yang diizinkan!');
			redirect(base_url('logout'));
		}
    }

	public function index()
	{
		$stok = $this->stokmodel->get_join_all_data();

		$data = [
			'menu' => 'stokbarang',
			'stok' => $stok
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/stokbarang');
		$this->load->view('templates/footer');
	}

	public function cek_kondisi($id = null)
	{
		if($id != null){
			$kondisi = $this->stokmodel->cek_kondisi_terkini($id);

			$data = [
				'menu' => 'stokbarang',
				'kondisi' => $kondisi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('pages/admin/kondisi');
			$this->load->view('templates/footer');
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan!');
			redirect('stokbarang'); 
		}
	}

	public function get_data_kondisi_by_id($id) {
        $kondisi = $this->stokmodel->get_kondisi_by_barang_id($id);
        // Cek apakah data berhasil ditemukan
        if ($kondisi) {
            echo json_encode([
                'success' => true,
                'kondisi' => $kondisi
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data kondisi tidak ditemukan'
            ]);
        }
    }

	public function get_stok_barang()
	{
		$search = $this->input->get('q'); // Menangkap parameter pencarian (jika ada)
        
        $data = $this->get_data_stok_barang($search);

        // Membentuk respons sesuai dengan format Select2
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'id' => $row['id_satuan'],
                'text' => $row['nama_satuan']
            ];
        }

        // Mengembalikan respons dalam format JSON
        echo json_encode(['results' => $result]);
	}

	public function get_data_stok_barang($search = '') {
		$this->db->select('kondisi_terkini.id_kondisi_terkini, 
						   master_jenis_barang.nama_jenisbarang, 
						   kondisi_terkini.stok_terkini, 
						   stok.tahun,
						   master_kondisi_terkini.nama_kondisi');
		$this->db->from('kondisi_terkini');
		$this->db->join('stok', 'stok.id_stok = kondisi_terkini.stok_id', 'left');
		$this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenisbarang = stok.jenis_barang_id', 'left');
		$this->db->join('master_kondisi_terkini', 'master_kondisi_terkini.id_kondisi_terkini = kondisi_terkini.kondisi_terkini_id', 'left');
	
		// Pencarian melibatkan tiga field
		if (!empty($search)) {
			$this->db->group_start(); // Mulai grup kondisi pencarian
			$this->db->like('master_jenis_barang.nama_jenisbarang', $search);
			$this->db->or_like('stok.tahun', $search);
			$this->db->or_like('master_kondisi_terkini.nama_kondisi', $search);
			$this->db->group_end(); // Akhir grup kondisi pencarian
		}
	
		$query = $this->db->get();
		return $query->result_array();
	}
	
}