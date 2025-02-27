<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccess extends CI_Controller {
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

		if ($this->session->userdata('role') != 'pengguna') {
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
		
		$peminjaman_diterima = $this->peminjamanmodel->get_jumlah_peminjaman('terima',$this->session->userdata('id_auth'));
		$peminjaman_ditolak = $this->peminjamanmodel->get_jumlah_peminjaman('tolak',$this->session->userdata('id_auth'));
		$peminjaman_tunggu = $this->peminjamanmodel->get_jumlah_peminjaman('tunggu',$this->session->userdata('id_auth'));
		
	
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
		$this->load->view('pages/user/index');
		$this->load->view('templates/footer');
		$this->load->view('templates/dashboard-js');
		
	}

	public function peminjaman(){
		
		$jenis_bencana = $this->masterdatamodel->get_all_data('master_jenis_bencana');
		$kondisi = $this->masterdatamodel->get_all_data('master_kondisi');
		$satuan = $this->masterdatamodel->get_all_data('master_satuan');
		$sumber = $this->masterdatamodel->get_all_data('master_sumber');
		$klasifikasi = $this->masterdatamodel->get_all_data('klasifikasi');
		$barang_masuk = $this->barangmasukmodel->get_join_all_data();
		
		
		$data_stok_barang = $this->barangkeluarmodel->get_data_stok_barang();
		$data_peminjaman = $this->peminjamanmodel->get_join_pinjaman($this->session->userdata('id_auth'));
		$barang_pinjam = $this->peminjamanmodel->get_barang_pinjam($this->session->userdata('id_auth'));
		
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
		$this->load->view('pages/user/peminjaman');
		$this->load->view('templates/footer');
		$this->load->view('pages/user/modals/peminjaman');
	}

	public function add()
	{		
		// Ambil data dari form
		$tanggal_pinjam = htmlspecialchars($this->input->post('tanggal_pinjam'));
		$tanggal_kembali = htmlspecialchars($this->input->post('tanggal_kembali'));
		$nama_penanggungjawab = htmlspecialchars($this->input->post('nama_penanggungjawab'));
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
			'nama_penanggungjawab' => $nama_penanggungjawab,
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
					redirect('useraccess/peminjaman');
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
					redirect('useraccess/peminjaman');
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
		redirect('useraccess/peminjaman');
		
	}

	public function delete_peminjaman()
	{
		// Ambil ID barang pinjam yang akan dihapus dan sanitasi input
		$batch_id = $this->input->post('batch_id', true);

		// Pastikan batch_id ada
		if (empty($batch_id)) {
			$this->session->set_flashdata('error', 'Batch ID tidak valid!');
			redirect('useraccess/peminjaman');
			return;
		}

		// Ambil data barang pinjam berdasarkan ID
		$barang_pinjam = $this->peminjamanmodel->get_barang_pinjam_by_batch($batch_id);

		// Cek apakah data barang pinjam ditemukan
		if (empty($barang_pinjam)) {
			$this->session->set_flashdata('error', 'Data barang pinjam tidak ditemukan!');
			redirect('useraccess/peminjaman');
			return;
		}

		// Mulai transaksi
		$this->db->trans_start();

		try {
			// Looping untuk setiap barang pinjam
			foreach ($barang_pinjam as $value) {
				// Hapus data barang pinjam
				$this->db->delete('barang_pinjam', ['id_barang_pinjam' => $value['id_barang_pinjam']]);
				
				// Cek apakah penghapusan berhasil
				if ($this->db->affected_rows() == 0) {
					throw new Exception('Gagal menghapus data barang pinjam dengan ID: ' . $value['id_barang_pinjam']);
				}
			}

			// Hapus juga dari tabel peminjaman berdasarkan batch_id (jika ada)
			$this->db->delete('peminjaman', ['batch_id' => $batch_id]);

			// Cek apakah penghapusan berhasil
			if ($this->db->affected_rows() == 0) {
				throw new Exception('Gagal menghapus data peminjaman dengan batch ID: ' . $batch_id);
			}

			// Commit transaksi jika semua operasi berhasil
			$this->db->trans_complete();

			// Cek status transaksi
			if ($this->db->trans_status() === false) {
				throw new Exception('Terjadi kesalahan saat melakukan transaksi.');
			}

			// Jika sukses
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		} catch (Exception $e) {
			// Rollback transaksi jika ada kesalahan
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', $e->getMessage());
		}

		// Redirect kembali ke halaman barang pinjam
		redirect('useraccess/peminjaman');
	}
}