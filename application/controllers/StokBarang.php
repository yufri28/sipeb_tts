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

	public function editfoto() {
		
		$id = htmlspecialchars($this->input->post('id_kondisi_terkini'));
		// Ambil data bencana berdasarkan ID
		$dataKondisi = $this->stokmodel->cek_kondisi_terkini_byid($id);
		
		// Konfigurasi upload
		$config['upload_path'] = FCPATH.'uploads/kondisi/';
		$config['allowed_types'] = 'jpg|jpeg|png';
	
		$this->upload->initialize($config);
		
		$fotoKondisi = $dataKondisi[0]['foto_kondisi']; // Tetap gunakan file lama jika tidak diupload
		if (!empty($_FILES['foto_kondisi']['name'])) {
			if (!$this->upload->do_upload('foto_kondisi')) {
				
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('stokbarang/cek_kondisi/'.$dataKondisi[0]['stok_id']));
			} else {
				
				// Hapus file lama
				if (file_exists($config['upload_path'] . $fotoKondisi)) {
					unlink($config['upload_path'] . $fotoKondisi);
				}
	
				// Upload file baru
				$dataFotoKondisi = $this->upload->data();
				$originalFileName = $dataFotoKondisi['file_name'];
				$fileExtension = $dataFotoKondisi['file_ext'];
				$encryptedFileName =  md5(uniqid(time() . $originalFileName, true)) . $fileExtension;
				rename($dataFotoKondisi['full_path'], $config['upload_path'] . $encryptedFileName);
				$fotoKondisi = $encryptedFileName;
				// Simpan data ke database, dengan file baru jika diupload, atau tetap menggunakan file lama jika tidak diupload
				$data = array(
					'foto_kondisi' => $fotoKondisi
				);
			
				// Update data ke database
				if ($this->stokmodel->update_kondisi($id, $data)) {
					$this->session->set_flashdata('success', 'Foto kondisi berhasil diperbarui.');
				} else {
					$this->session->set_flashdata('error', 'Terjadi kesalahan, foto kondisi gagal diperbarui.');
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, file foto kosong.');
		}
	
	
	
		// Redirect ke halaman
		redirect(base_url('stokbarang/cek_kondisi/'.$dataKondisi[0]['stok_id']));
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