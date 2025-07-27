<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HodAccess extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model("barangkeluarmodel");
		$this->load->model("peminjamanmodel");
		$this->load->model('masterdatamodel');
        $this->load->model('barangmasukmodel');
        $this->load->model('kondisiterkinimodel');
        $this->load->model('stokmodel');
        $this->load->model('databencanamodel');
		if (!$this->session->userdata('id_auth')) {
			redirect(base_url('auth'));
		}

		if ($this->session->userdata('role') != 'kepala_dinas') {
			$this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman tersebut. Silahkan login dan masuk ke halaman yang diizinkan!');
			redirect(base_url('logout'));
		}
	}
	
	public function index()
	{
		$jumlah_stok_terkini = $this->stokmodel->get_total_stok_terkini();
		$jumlah_masuk_perbulan = $this->barangmasukmodel->get_jumlah_barang_masuk_perbulan();
		$jumlah_keluar_perbulan = $this->barangkeluarmodel->get_jumlah_perbulan();
		$jumlah_bencana = $this->databencanamodel->get_total_bencana();
		
		$barang_masuk_bulan_ini = $this->barangmasukmodel->get_barang_masuk_bulan_ini();
		$barang_keluar_bulan_ini = $this->barangkeluarmodel->get_barang_keluar_bulan_ini();
		$bencana_bulan_ini = $this->databencanamodel->get_bencana_bulan_ini();
		$statistik_barang_masuk = $this->barangmasukmodel->get_barang_masuk_per_bulan();
		$statistik_barang_keluar = $this->barangkeluarmodel->get_barang_keluar_per_bulan();

		
		$peminjaman_diterima = $this->peminjamanmodel->get_jumlah_peminjaman('terima');
		$peminjaman_ditolak = $this->peminjamanmodel->get_jumlah_peminjaman('tolak');
		$peminjaman_tunggu = $this->peminjamanmodel->get_jumlah_peminjaman('tunggu');
	
		$data = [
			'menu' => 'dashboard',
			'jumlah_stok_terkini' => $jumlah_stok_terkini,
			'jumlah_masuk_perbulan' => $jumlah_masuk_perbulan,
			'jumlah_keluar_perbulan' => $jumlah_keluar_perbulan,
			'jumlah_bencana' => $jumlah_bencana,
			'barang_masuk_bulan_ini' => $barang_masuk_bulan_ini,
			'barang_keluar_bulan_ini' => $barang_keluar_bulan_ini,
			'bencana_bulan_ini' => $bencana_bulan_ini,
			'statistik_barang_masuk' => $statistik_barang_masuk,
			'statistik_barang_keluar' => $statistik_barang_keluar,
			'peminjaman_ditolak' => $peminjaman_ditolak,
			'peminjaman_diterima' => $peminjaman_diterima,
			'peminjaman_tunggu' => $peminjaman_tunggu
		];
		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/hod/index');
		$this->load->view('templates/footer');
		$this->load->view('templates/dashboard-js');
	}

	public function peminjaman($status_diterima = 'all'){
		
		$jenis_bencana = $this->masterdatamodel->get_all_data('master_jenis_bencana');
		$kondisi = $this->masterdatamodel->get_all_data('master_kondisi');
		$satuan = $this->masterdatamodel->get_all_data('master_satuan');
		$sumber = $this->masterdatamodel->get_all_data('master_sumber');
		$klasifikasi = $this->masterdatamodel->get_all_data('klasifikasi');
		$barang_masuk = $this->barangmasukmodel->get_join_all_data();
		
		
		$data_stok_barang = $this->barangkeluarmodel->get_data_stok_barang();
		$data_peminjaman = $this->peminjamanmodel->get_all_pinjaman($status_diterima);
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

		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/hod/peminjaman');
		$this->load->view('templates/footer');
		$this->load->view('pages/hod/modals/peminjaman');
	}

	public function add()
	{		
		// Ambil data dari form
		$tanggal_pinjam = htmlspecialchars($this->input->post('tanggal_pinjam'));
		$tanggal_kembali = htmlspecialchars($this->input->post('tanggal_kembali'));
		$no_hp = htmlspecialchars($this->input->post('no_hp'));
		$alamat = htmlspecialchars($this->input->post('alamat'));
		$keperluan = htmlspecialchars($this->input->post('keperluan'));
		$batch_id = generate_uuid(); // Buat UUID batch baru
		$user_id = $this->session->userdata('id_auth');
		
		// Data untuk disimpan
		$data_peminjaman = [
			'tanggal_pengajuan' => date('Y-m-d'),
			'tanggal_pinjam' => $tanggal_pinjam,
			'tanggal_kembali' => $tanggal_kembali,
			'no_hp' => $no_hp,
			'alamat' => $alamat,
			'keperluan' => $keperluan,
			'batch_id' => $batch_id,
			'status_diterima' => 'tunggu',
			'user_id' => $user_id
		];

		// Mulai transaksi database
		$this->db->trans_start();

		// Insert data peminjaman
		if ($this->peminjamanmodel->insert_data('peminjaman', $data_peminjaman)) {
			$id_kondisi_terkini = $this->input->post('id_kondisi_terkini[]');
			$jumlah = preg_replace('/[^0-9,]/', '', $this->input->post('jumlah'));
			$jumlahArray = explode(',', $jumlah);
			$jumlah = htmlspecialchars($jumlah); // Mengamankan input

			// Periksa setiap barang yang dipilih
			foreach ($id_kondisi_terkini as $i => $kondisi_terkini_id) {
				// Pastikan jumlah barang valid
				if ($jumlahArray[$i] <= 0) {
					$this->session->set_flashdata('error', 'Jumlah barang tidak valid.');
					redirect('hodaccess/peminjaman');
				}

				// Data untuk tabel barang_pinjam
				$data_barang_keluar = [
					'jumlah' => $jumlahArray[$i],
					'kondisi_terkini_id' => $kondisi_terkini_id,
					'batch_id' => $batch_id
				];

				// Simpan data barang pinjam
				if (!$this->peminjamanmodel->insert_data('barang_pinjam', $data_barang_keluar)) {
					// Jika insert barang gagal, rollback
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Gagal menyimpan data barang pinjam.');
					redirect('hodaccess/peminjaman');
				}
			}

			// Selesaikan transaksi
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('error', 'Transaksi gagal, perubahan dibatalkan.');
			} else {
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
			}
		} else {
			// Jika insert peminjaman gagal, rollback
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Gagal menyimpan data peminjaman.');
		}

		// Redirect ke halaman peminjaman
		redirect('hodaccess/peminjaman');
		
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
			redirect('hodaccess/peminjaman');
			return;
		}

		// Ambil data barang pinjam berdasarkan batch_id
		$barang_pinjam = $this->peminjamanmodel->get_barang_pinjam_by_batch($batch_id);

		// Cek apakah data barang pinjam ditemukan
		if (empty($barang_pinjam)) {
			$this->session->set_flashdata('error', 'Data barang pinjam tidak ditemukan!');
			redirect('hodaccess/peminjaman');
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

		} elseif ($status == 'tolak') {
			// Update peminjaman status menjadi tolak
			$this->db->where('batch_id', $batch_id);
			$this->db->update('peminjaman', ['status_diterima' => 'tolak']);
		}

		// Redirect kembali ke halaman peminjaman
		redirect('hodaccess/peminjaman');
	}

	public function stokbarang()
	{
		$stok = $this->stokmodel->get_join_all_data();

		$data = [
			'menu' => 'stokbarang',
			'stok' => $stok
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hod/stokbarang');
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
			$this->load->view('pages/hod/kondisi');
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


}