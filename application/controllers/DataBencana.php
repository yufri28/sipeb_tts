<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBencana extends CI_Controller {

	public function __construct() {
        parent::__construct();
		require_once FCPATH . 'vendor/autoload.php';
        $this->load->model('databencanamodel');
        $this->load->model('masterdatamodel');
    }
	
	public function index()
	{
		$jenis_bencana = $this->masterdatamodel->get_all_data('master_jenis_bencana');
		$data_bencana = $this->databencanamodel->get_join_all_data();
		$data = [
			'menu' => 'databencana',
			'jenis_bencana' => $jenis_bencana,
			'data_bencana' => $data_bencana
		];
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/databencana');
		$this->load->view('templates/footer');
		$this->load->view('pages/modals/databencana');
	
	}

	public function add() {
		// Konfigurasi upload
		$config['upload_path'] = FCPATH.'uploads/bencana/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
		// $config['max_size'] = 2048; // Ukuran maksimal 2MB
	
		$this->upload->initialize($config);
	
		// Proses upload bukti lapor
		if (!$this->upload->do_upload('bukti_lap_pusdolops')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('databencana'));
		} else {
			$buktiLapData = $this->upload->data();
			$originalFileName = $buktiLapData['file_name']; // Nama asli file yang diunggah
			$fileExtension = $buktiLapData['file_ext']; // Ekstensi file
			$encryptedFileName = md5(uniqid(time() . $originalFileName, true)) . $fileExtension; // Enkripsi nama file
			rename($buktiLapData['full_path'], $config['upload_path'] . $encryptedFileName); // Ubah nama file
			$buktiLapFile = $encryptedFileName; // Simpan nama file terenkripsi
		}
	
		// Proses upload SK tanggap darurat (jika ada)
		if (!$this->upload->do_upload('sk_tanggap_darurat')) {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('databencana'));
		} else {
			$skTanggapDaruratData = $this->upload->data();
			$originalSkFileName = $skTanggapDaruratData['file_name']; // Nama asli file SK
			$skFileExtension = $skTanggapDaruratData['file_ext']; // Ekstensi file SK
			$encryptedSkFileName = md5(uniqid(time() . $originalSkFileName, true)) . $skFileExtension; // Enkripsi nama file SK
			rename($skTanggapDaruratData['full_path'], $config['upload_path'] . $encryptedSkFileName); // Ubah nama file
			$skTanggapDaruratFile = $encryptedSkFileName; // Simpan nama file SK yang terenkripsi
		}
	
		// Simpan data ke database dengan path file yang diunggah
		$data = array(
			'jenis_bencana_id' => $this->input->post('jenis_bencana_id'),
			'tanggal' => $this->input->post('tanggal'),
			'lokasi' => $this->input->post('lokasi'),
			'bukti_lap_pusdolops' => $buktiLapFile, // Simpan nama file bukti lapor yang terenkripsi
			'sk_tanggap_darurat' => $skTanggapDaruratFile // Simpan nama file SK tanggap darurat yang terenkripsi
		);
	
		// Simpan ke database
		if ($this->databencanamodel->insert_data($data)) {
			$this->session->set_flashdata('success', 'Data Bencana berhasil ditambahkan.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, data Bencana gagal ditambahkan.');
		}
	
		// Redirect ke halaman
		redirect(base_url('databencana'));
	}

	public function update() {
		
		$id = htmlspecialchars($this->input->post('id_bencana'));
		// Ambil data bencana berdasarkan ID
		$dataBencana = $this->databencanamodel->get_data_by_id($id);
	
		if(empty($dataBencana['id_bencana'])){
			$this->session->set_flashdata('error', 'Data tidak ditemukan!');
		}
		
		// Konfigurasi upload
		$config['upload_path'] = FCPATH.'uploads/bencana/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
	
		$this->upload->initialize($config);
	
		// Proses upload bukti lapor (opsional)
		$buktiLapFile = $dataBencana['bukti_lap_pusdolops']; // Tetap gunakan file lama jika tidak diupload
		if (!empty($_FILES['bukti_lap_pusdolops']['name'])) {
			if (!$this->upload->do_upload('bukti_lap_pusdolops')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('databencana'));
			} else {
				// Hapus file lama
				if (file_exists($config['upload_path'] . $buktiLapFile)) {
					unlink($config['upload_path'] . $buktiLapFile);
				}
	
				// Upload file baru
				$buktiLapData = $this->upload->data();
				$originalFileName = $buktiLapData['file_name'];
				$fileExtension = $buktiLapData['file_ext'];
				$encryptedFileName =  md5(uniqid(time() . $originalFileName, true)) . $fileExtension;
				rename($buktiLapData['full_path'], $config['upload_path'] . $encryptedFileName);
				$buktiLapFile = $encryptedFileName;
			}
		}
	
		// Proses upload SK tanggap darurat (opsional)
		$skTanggapDaruratFile = $dataBencana['sk_tanggap_darurat']; // Tetap gunakan file lama jika tidak diupload
		if (!empty($_FILES['sk_tanggap_darurat']['name'])) {
			if (!$this->upload->do_upload('sk_tanggap_darurat')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(base_url('databencana'));
			} else {
				// Hapus file lama
				if (file_exists($config['upload_path'] . $skTanggapDaruratFile)) {
					unlink($config['upload_path'] . $skTanggapDaruratFile);
				}
	
				// Upload file baru
				$skTanggapDaruratData = $this->upload->data();
				$originalSkFileName = $skTanggapDaruratData['file_name'];
				$skFileExtension = $skTanggapDaruratData['file_ext'];
				$encryptedSkFileName =  md5(uniqid(time() . $originalSkFileName, true)) . $skFileExtension;
				rename($skTanggapDaruratData['full_path'], $config['upload_path'] . $encryptedSkFileName);
				$skTanggapDaruratFile = $encryptedSkFileName;
			}
		}
	
		// Simpan data ke database, dengan file baru jika diupload, atau tetap menggunakan file lama jika tidak diupload
		$data = array(
			'jenis_bencana_id' => htmlspecialchars($this->input->post('jenis_bencana_id')),
			'tanggal' => htmlspecialchars($this->input->post('tanggal')),
			'lokasi' => htmlspecialchars($this->input->post('lokasi')),
			'bukti_lap_pusdolops' => $buktiLapFile, // Nama file bukti lapor
			'sk_tanggap_darurat' => $skTanggapDaruratFile // Nama file SK tanggap darurat
		);
	
		// Update data ke database
		if ($this->databencanamodel->update_data($id, $data)) {
			$this->session->set_flashdata('success', 'Data Bencana berhasil diperbarui.');
		} else {
			$this->session->set_flashdata('error', 'Terjadi kesalahan, data Bencana gagal diperbarui.');
		}
	
		// Redirect ke halaman
		redirect(base_url('databencana'));
	}

	public function delete() {
		
		$id = htmlspecialchars($this->input->post('id_bencana'));
		// Dapatkan data dari database berdasarkan ID
		$data = $this->databencanamodel->get_data_by_id($id);
	
		if ($data) {
			// Folder tempat file disimpan
			$upload_path = FCPATH . 'uploads/bencana/';
			
			// Cek dan hapus file 'bukti_lap_pusdolops' jika ada
			if (!empty($data['bukti_lap_pusdolops']) && file_exists($upload_path . $data['bukti_lap_pusdolops'])) {
				unlink($upload_path . $data['bukti_lap_pusdolops']);
			}
	
			// Cek dan hapus file 'sk_tanggap_darurat' jika ada
			if (!empty($data['sk_tanggap_darurat']) && file_exists($upload_path . $data['sk_tanggap_darurat'])) {
				unlink($upload_path . $data['sk_tanggap_darurat']);
			}
	
			// Hapus data dari database
			$this->db->where('id_bencana', $id);
			if ($this->db->delete('bencana')) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data.');
			}
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
	
		// Redirect kembali ke halaman utama
		redirect(base_url('databencana'));
	}	
	
}