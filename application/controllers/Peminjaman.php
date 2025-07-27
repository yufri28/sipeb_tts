<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct() {
        parent::__construct();
		require_once FCPATH . 'vendor/autoload.php';
		$this->load->model('masterdatamodel');
		$this->load->model("barangkeluarmodel");
       	$this->load->model("peminjamanmodel");
	   	$this->load->model('barangmasukmodel');
        $this->load->model('kondisiterkinimodel');
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
		$jenis_bencana = $this->masterdatamodel->get_all_data('master_jenis_bencana');
		$kondisi = $this->masterdatamodel->get_all_data('master_kondisi');
		$satuan = $this->masterdatamodel->get_all_data('master_satuan');
		$sumber = $this->masterdatamodel->get_all_data('master_sumber');
		$klasifikasi = $this->masterdatamodel->get_all_data('klasifikasi');
		$barang_masuk = $this->barangmasukmodel->get_join_all_data();
		
		
		$data_stok_barang = $this->barangkeluarmodel->get_data_stok_barang();
		$data_peminjaman = $this->peminjamanmodel->get_all_pinjaman('all');
		$barang_pinjam = $this->peminjamanmodel->get_barang_pinjam();
		
		$data = [
			'menu' => 'peminjaman',
			'data_peminjaman' => $data_peminjaman,
			'data_stok_barang' => $data_stok_barang,
			'jenis_bencana' => $jenis_bencana,
			'barang_pinjam' => $barang_pinjam,
			'kondisi' => $kondisi,
			'satuan' => $satuan,
			'sumber' => $sumber,
			'klasifikasi' => $klasifikasi,
			'barang_masuk' => $barang_masuk
		];
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/peminjaman');
		$this->load->view('templates/footer');
		$this->load->view('pages/admin/modals/peminjaman');
	
	}

	public function konfirmasi_peminjaman()
	{
		// Ambil ID barang pinjam dan status dari input yang sudah disanitasi
		$batch_id = $this->input->post('batch_id', true);
		$pesan = $this->input->post('pesan', true);
		$status = $this->input->post('status', true);

		// Pastikan batch_id ada
		if (empty($batch_id)) {
			$this->session->set_flashdata('error', 'Batch ID tidak valid!');
			redirect('peminjaman');
			return;
		}

		// Ambil data barang pinjam berdasarkan batch_id
		$barang_pinjam = $this->peminjamanmodel->get_barang_pinjam_by_batch($batch_id);

		// Cek apakah data barang pinjam ditemukan
		if (empty($barang_pinjam)) {
			$this->session->set_flashdata('error', 'Data barang pinjam tidak ditemukan!');
			redirect('peminjaman');
			return;
		}

		// Proses jika status adalah 'terima'
		if ($status == 'terima') {
			// Mulai transaksi
			$this->db->trans_start();

			try {
				// Looping untuk setiap barang pinjam
				foreach ($barang_pinjam as $value) {
					// Ambil stok dari kondisi_terkini
					$stok_terkini = $this->kondisiterkinimodel->get_data_by_id($value['kondisi_terkini_id']);

					// Cek apakah stok cukup
					if ($stok_terkini < $value['jumlah']) {
						throw new Exception('Stok tidak cukup, silakan sesuaikan permintaan sesuai stok yang tersedia.');
					}

					// Insert data ke barang keluar
					$data_barang_keluar = [
						'jumlah' => $value['jumlah'],
						'tanggal' => date('Y-m-d'),
						'kondisi_terkini_id' => $value['kondisi_terkini_id'],
						'batch_id' => $value['batch_id'],
						'kategori' => 'pinjaman',
					];

					// Simpan ke database
					if ($this->barangkeluarmodel->insert_data($data_barang_keluar)) {
						// Update stok
						if (!$this->kondisiterkinimodel->update_jumlah($value['kondisi_terkini_id'], $value['jumlah'], 'kurangi')) {
							throw new Exception('Gagal mengupdate jumlah stok.');
						}
					} else {
						throw new Exception('Gagal menyimpan data barang keluar.');
					}

				}

				// Update status diterima pada peminjaman
				$this->db->where('batch_id', $batch_id);
				$this->db->update('peminjaman', ['status_diterima' => 'terima', 'pesan' => $pesan]);

				// Cek apakah konfirmasi berhasil
				if ($this->db->affected_rows() == 0) {
					throw new Exception('Gagal konfirmasi data peminjaman dengan batch ID: ' . $batch_id);
				}

				// Commit jika semua operasi berhasil
				$this->db->trans_complete();

				// Cek status transaksi
				if ($this->db->trans_status() === false) {
					throw new Exception('Terjadi kesalahan saat melakukan konfirmasi.');
				}

				// Jika sukses
				$this->session->set_flashdata('success', 'Konfirmasi berhasil!');
			} catch (Exception $e) {
				// Rollback jika ada kesalahan
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', $e->getMessage());
			}

		} elseif ($status == 'tunggu') {
			// Update peminjaman status menjadi tolak
			$this->db->where('batch_id', $batch_id);
			$this->db->update('peminjaman', ['status_diterima' => $status]);
		}
		 elseif ($status == 'tolak') {
			// Update peminjaman status menjadi tolak
			$this->db->where('batch_id', $batch_id);
			$this->db->update('peminjaman', ['status_diterima' => 'tolak', 'pesan' => $pesan]);
		}

		// Redirect kembali ke halaman peminjaman
		redirect('peminjaman');
	}

	
}