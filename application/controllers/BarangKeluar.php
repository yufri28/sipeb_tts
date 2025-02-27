<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("barangkeluarmodel");
		$this->load->model('masterdatamodel');
        $this->load->model('barangmasukmodel');
        $this->load->model('kondisiterkinimodel');
        $this->load->model('peminjamanmodel');
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
		
		
		$data_barang_keluar = $this->barangkeluarmodel->get_join_barang_keluar();
		$data_stok_barang = $this->barangkeluarmodel->get_data_stok_barang();
		
		// $cek_serah_terima = $this->barangkeluarmodel->get_data_serah_terima();
		
		$data = [
			'menu' => 'barangkeluar',
			'data_barang_keluar' => $data_barang_keluar,
			'data_stok_barang' => $data_stok_barang,
			'jenis_bencana' => $jenis_bencana,
			'kondisi' => $kondisi,
			'satuan' => $satuan,
			'sumber' => $sumber,
			'klasifikasi' => $klasifikasi,
			'barang_masuk' => $barang_masuk
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/barangkeluar');
		$this->load->view('templates/footer');
		$this->load->view('pages/admin/modals/barangkeluar');
	}

	// public function add()
	// {
	
	// 	// Ambil data dari form
	// 	$tanggal_keluar = htmlspecialchars($this->input->post('tanggal_keluar'));
	// 	$id_kondisi_terkini = $this->input->post('id_kondisi_terkini[]');

	// 	// Mengambil input jumlah, membersihkan karakter selain angka dan koma
	// 	$jumlah = $this->input->post('jumlah');
	// 	$jumlah = preg_replace('/[^0-9,]/', '', $jumlah); // Menghapus karakter selain angka dan koma

	// 	// Mengubah string yang dibersihkan menjadi array
	// 	$jumlahArray = explode(',', $jumlah);

	// 	// Mengamankan input setelah pembersihan
	// 	$jumlah = htmlspecialchars($jumlah);

	// 	for ($i=0; $i < count($id_kondisi_terkini); $i++) { 
	// 		if($jumlah <= 0){
	// 			$this->session->set_flashdata('error', 'Stok barang tersebut kosong.');
	// 			redirect('barangkeluar');
	// 		}
	
	// 		// Data untuk disimpan ke dalam tabel barang_keluar
	// 		$data = [
	// 			'jumlah' => $jumlah[$i],
	// 			'tanggal' => $tanggal_keluar,
	// 			'kondisi_terkini_id' => $id_kondisi_terkini[$i]
	// 		];
	
	// 		// Mulai transaksi
	// 		$this->db->trans_start();
	
	// 		// Insert data barang keluar
	// 		$insert = $this->barangkeluarmodel->insert_data($data);
	
	// 		if ($insert) {
	// 			// Update jumlah stok jika insert berhasil
	// 			$update_jumlah = $this->kondisiterkinimodel->update_jumlah($id_kondisi_terkini[$i], $jumlah[$i], 'kurangi');
	// 			if ($update_jumlah) {
	// 				// Commit transaksi jika semua operasi berhasil
	// 				$this->db->trans_complete(); // End the transaction
	// 				if ($this->db->trans_status() === FALSE) {
	// 					// Rollback jika ada kesalahan
	// 					$this->session->set_flashdata('error', 'Gagal mengupdate jumlah stok.');
	// 				} else {
	// 					$this->session->set_flashdata('success', 'Data berhasil disimpan!');
	// 				}
	// 			} else {
	// 				// Rollback transaksi jika update gagal
	// 				$this->db->trans_rollback();
	// 				$this->session->set_flashdata('error', 'Gagal mengupdate jumlah stok.');
	// 			}
	// 		} else {
	// 			// Rollback transaksi jika insert gagal
	// 			$this->db->trans_rollback();
	// 			$this->session->set_flashdata('error', 'Data gagal disimpan!');
	// 		}
	// 	}
		
	// 	// Redirect ke halaman barang keluar
	// 	redirect('barangkeluar');
	// }

	public function add()
	{
		// Ambil data dari form
		$tanggal_keluar = htmlspecialchars($this->input->post('tanggal_keluar'));
		$id_kondisi_terkini = $this->input->post('id_kondisi_terkini[]');
		$batch_id = generate_uuid();
		// Mengambil dan membersihkan input jumlah
		$jumlah = preg_replace('/[^0-9,]/', '', $this->input->post('jumlah'));
		$jumlahArray = explode(',', $jumlah);
		$jumlah = htmlspecialchars($jumlah); // Mengamankan input

		// Periksa setiap barang yang dipilih
		foreach ($id_kondisi_terkini as $i => $kondisi_terkini_id) {
			// Validasi jumlah tidak boleh kosong atau nol
			if ($jumlahArray[$i] <= 0) {
				$this->session->set_flashdata('error', 'Stok barang tersebut kosong.');
				redirect('barangkeluar');
			}

			// Data untuk disimpan
			$data = [
				'jumlah' => $jumlahArray[$i],
				'tanggal' => $tanggal_keluar,
				'kondisi_terkini_id' => $kondisi_terkini_id,
				'batch_id' => $batch_id
			];

			// Mulai transaksi dan simpan data
			$this->db->trans_start();

			if ($this->barangkeluarmodel->insert_data($data)) {
				// Update stok
				if ($this->kondisiterkinimodel->update_jumlah($kondisi_terkini_id, $jumlahArray[$i], 'kurangi')) {
					$this->db->trans_complete();
					$this->session->set_flashdata('success', 'Data berhasil disimpan!');
				} else {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Gagal mengupdate jumlah stok.');
				}
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
			}

			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('error', 'Gagal mengupdate jumlah stok.');
			}
		}

		// Redirect ke halaman barang keluar
		redirect('barangkeluar');
	}

	public function delete()
	{
		// Ambil ID barang keluar yang akan dihapus
		$batch_id = $this->input->post('batch_id');
		$kembalikan_stok = $this->input->post('kembalikan_stok');

		// Ambil data barang keluar berdasarkan ID
		$barang_keluar = $this->barangkeluarmodel->get_barang_keluar_by_batch($batch_id);

		// Jika data ditemukan
		if (!empty($barang_keluar)) {
			// Mulai transaksi
			$this->db->trans_start();

			$isSuccess = true; // Flag untuk status operasi
			
			// Looping untuk setiap barang keluar
			foreach ($barang_keluar as $key => $value) {
				// Cek apakah perlu mengembalikan stok
				if ($kembalikan_stok === 'ya') {
					// Update stok hanya jika 'ya'
					$update_stok = $this->kondisiterkinimodel->update_jumlah(
						$value['kondisi_terkini_id'], 
						$value['jumlah'], 
						'tambah'
					);

					if (!$update_stok) {
						$isSuccess = false; // Jika gagal update stok, set status gagal
						break;
					}
				}

				// Hapus data barang keluar
				$delete = $this->barangkeluarmodel->delete_data($value['id_barang_keluar']);
				if (!$delete) {
					$isSuccess = false; // Jika gagal hapus data, set status gagal
					break;
				}
			}

			// Cek apakah semua operasi berhasil
			if ($isSuccess) {
				// Commit transaksi jika semua operasi berhasil
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					// Rollback jika ada kesalahan dalam transaksi
					$this->session->set_flashdata('error', 'Gagal menghapus data atau mengembalikan stok!');
				} else {
					// Jika sukses
					$this->session->set_flashdata('success', 'Data berhasil dihapus!');
				}
			} else {
				// Rollback transaksi jika ada kesalahan
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Gagal menghapus data atau mengembalikan stok!');
			}
		} else {
			// Data barang keluar tidak ditemukan
			$this->session->set_flashdata('error', 'Data barang keluar tidak ditemukan!');
		}

		// Redirect kembali ke halaman barang keluar
		redirect('barangkeluar');
	}

	// public function delete()
	// {
	// 	// Ambil ID barang keluar yang akan dihapus
	// 	$batch_id = $this->input->post('batch_id');
	// 	$kembalikan_stok = $this->input->post('kembalikan_stok');


	// 	// Ambil data barang keluar berdasarkan ID
	// 	$barang_keluar = $this->barangkeluarmodel->get_barang_keluar_by_batch($batch_id);

	// 	// Jika data ditemukan
	// 	if (!empty($barang_keluar)) {
	// 		// Kembalikan stok
	// 		$id_kondisi_terkini = $barang_keluar['kondisi_terkini_id'];
	// 		$jumlah = $barang_keluar['jumlah'];
			
	// 		// Update stok
	// 		if($kembalikan_stok == 'ya'){
	// 			foreach ($barang_keluar as $key => $value) {
	// 				$update_stok = $this->kondisiterkinimodel->update_jumlah($value['kondisi_terkini_id'], $value['jumlah'], 'tambah');
	// 				// Jika update stok berhasil
	// 				if ($update_stok) {
	// 					// Hapus data barang keluar
	// 					$delete = $this->barangkeluarmodel->delete_data($value['id_barang_keluar']);
						
	// 					// Cek apakah penghapusan berhasil
	// 					if ($delete) {
	// 						$this->session->set_flashdata('success', 'Data berhasil dihapus!');
	// 					} else {
	// 						$this->session->set_flashdata('error', 'Gagal menghapus data!');
	// 					}
	// 				} else {
	// 					$this->session->set_flashdata('error', 'Gagal mengembalikan stok!');
	// 				}
	// 			}
	// 		}else{
	// 			foreach ($barang_keluar as $key => $value) {
	// 				$delete = $this->barangkeluarmodel->delete_data($value['id_barang_keluar']);
	// 				if ($delete) {
	// 					$this->session->set_flashdata('success', 'Data berhasil dihapus!');
	// 				} else {
	// 					$this->session->set_flashdata('error', 'Gagal menghapus data!');
	// 				}
	// 			}
	// 		}
			
	// 	} else {
	// 		$this->session->set_flashdata('error', 'Data barang keluar tidak ditemukan!');
	// 	}

	// 	// Redirect kembali ke halaman barang keluar
	// 	redirect('barangkeluar');
	// }

	public function detail_peminjaman($batch_id)
	{
		if($batch_id == null){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
		
		$data_peminjaman = $this->peminjamanmodel->get_pinjaman('terima');
		
		$data_barang_keluar = $this->barangkeluarmodel->get_all_barang_keluar($batch_id);
		if(empty($data_barang_keluar)){
			$this->session->set_flashdata('error', 'Data tidak ditemukan untuk Batch ID ' . $batch_id);
			redirect('barangkeluar');
		}
		
		$data = [
			'menu' => 'barangkeluar',
			'data_barang_keluar' => $data_barang_keluar,
			'data_peminjaman' => $data_peminjaman
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/detail_peminjaman');
		$this->load->view('templates/footer');		
		$this->load->view('pages/admin/modals/indexmodal');
	}

	public function update_peminjaman()
	{
		$tanggal_pinjam = htmlspecialchars($this->input->post('tanggal_pinjam'));
		$nama_pihak_pertama = htmlspecialchars($this->input->post('nama_pihak_pertama'));
		$jabatan_pihak1 = htmlspecialchars($this->input->post('jabatan_pihak_pertama'));
		$nama_pihak2 = htmlspecialchars($this->input->post('nama_pihak_kedua'));
		$no_hp = htmlspecialchars($this->input->post('no_hp'));
		$kepala_pelaksana = htmlspecialchars($this->input->post('kepala_pelaksana'));
		$jabatan_pelaksana = htmlspecialchars($this->input->post('jabatan_pelaksana'));
		$nip_pelaksana = htmlspecialchars($this->input->post('nip_pelaksana'));
		$batch_id = htmlspecialchars($this->input->post('batch_id'));

		// Fetch existing serah_terima data based on the ID
		$cek_data_peminjaman = $this->peminjamanmodel->get_data_peminjaman($batch_id);

		if (!$cek_data_peminjaman) {
			$this->session->set_flashdata('error', 'Data Serah Terima tidak ditemukan.');
			redirect('barangkeluar/detail_peminjaman/'.$batch_id);
			return;
		}
		
		$data = [
			'tanggal_pinjam' => $tanggal_pinjam,
			'nama_pihak_pertama' => $nama_pihak_pertama,
			'jabatan_pihak_pertama' => $jabatan_pihak1,
			'nama_penanggungjawab' => $nama_pihak2,
			'no_hp' => $no_hp,
			'kepala_pelaksana' => $kepala_pelaksana,
			'jabatan_pelaksana' => $jabatan_pelaksana,
			'nip_pelaksana' => $nip_pelaksana
		];

		// Update the data in the database
		$update_peminjaman = $this->peminjamanmodel->update_data_peminjaman($batch_id, $data);

		if ($update_peminjaman) {
			$this->session->set_flashdata('success', 'Berhasil data peminjaman.');
		} else {
			$this->session->set_flashdata('error', 'Gagal data peminjaman.');
		}

		redirect('barangkeluar/detail_peminjaman/'.$batch_id);
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
		$this->load->view('pages/admin/add_peminjaman');
		$this->load->view('templates/footer');
		$this->load->view('pages/admin/script-peminjaman');
	}

	public function add_peminjaman()
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
					redirect('barangkeluar/');
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
					redirect('barangkeluar/');
				}
			}

			// Selesaikan transaksi
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('error', 'Transaksi gagal, perubahan dibatalkan.');
			} else {
				$this->session->set_flashdata('success', 'Data berhasil disimpan. Silahkan menunggu konfirmasi dari Kepala Dinas!');
			}
		} else {
			// Jika insert peminjaman gagal, rollback
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Gagal menyimpan data peminjaman.');
		}

		// Redirect ke halaman peminjaman
		redirect('barangkeluar/');
		
	}

	public function konfirmasi_selesai()
	{
		$batch_id = htmlspecialchars($this->input->post('batch_id'));

		// Fetch existing serah_terima data based on the ID
		$data_peminjaman = $this->peminjamanmodel->get_data_peminjaman($batch_id);

		// Jika data peminjaman tidak ditemukan, kembalikan ke halaman detail
		if (!$data_peminjaman) {
			$this->session->set_flashdata('error', 'Data Peminjaman tidak ditemukan.');
			return redirect('barangkeluar/detail_peminjaman/' . $batch_id);
		}

		// Ambil data barang keluar berdasarkan ID batch
		$barang_keluar = $this->barangkeluarmodel->get_barang_keluar_by_batch($batch_id);

		// Jika data barang keluar tidak ditemukan
		if (empty($barang_keluar)) {
			$this->session->set_flashdata('error', 'Data barang keluar tidak ditemukan!');
			return redirect('barangkeluar/detail_peminjaman/' . $batch_id);
		}

		// Mulai transaksi
		$this->db->trans_begin();

		foreach ($barang_keluar as $item) {
			// Update stok barang
			if (!$this->update_stok_barang($item)) {
				// Rollback transaksi jika gagal
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Gagal mengembalikan stok barang.');
				return redirect('barangkeluar/detail_peminjaman/' . $batch_id);
			}
		}

		// Jika semua operasi berhasil, commit transaksi
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Terjadi kesalahan dalam transaksi.');
		} else {
			// Update status peminjaman menjadi selesai
			$update_data = ['status_peminjaman' => 'selesai'];
			if ($this->peminjamanmodel->update_data_peminjaman($batch_id, $update_data)) {
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Konfirmasi peminjaman berhasil.');
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Gagal mengubah status peminjaman.');
			}
		}

		// Redirect kembali ke halaman detail peminjaman
		redirect('barangkeluar');
	}

	private function update_stok_barang($item)
	{
		return $this->kondisiterkinimodel->update_jumlah(
			$item['kondisi_terkini_id'], 
			$item['jumlah'], 
			'tambah'
		);
	}

	
	public function detail_serah_terima($batch_id)
	{
		if($batch_id == null){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
		
		$data_serah_terima = $this->barangkeluarmodel->get_data_serah_terima($batch_id);
		$data_barang_keluar = $this->barangkeluarmodel->get_all_barang_keluar($batch_id);
		if(empty($data_barang_keluar)){
			$this->session->set_flashdata('error', 'Data tidak ditemukan untuk Batch ID ' . $batch_id);
			redirect('barangkeluar');
		}
		
		$data = [
			'menu' => 'barangkeluar',
			'data_barang_keluar' => $data_barang_keluar,
			'data_serah_terima' => $data_serah_terima
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/detail_serah_terima');
		$this->load->view('templates/footer');
	}
	
	public function cetak_serah_terima_peminjaman($batch_id){
	
		if($batch_id == null){
			$this->session->set_flashdata('error', 'Cetak Serah Terima Gagal. Batch ID tidak ditemukan!');
			redirect('barangkeluar');
		}
	
		$data_barang_keluar = $this->barangkeluarmodel->get_all_barang_keluar($batch_id);
	
		if(empty($data_barang_keluar)){
			$this->session->set_flashdata('error', 'Data tidak ditemukan untuk Batch ID ' . $batch_id);
			redirect('barangkeluar');
		}
						
		try {
			ob_start();
			$this->load->library("Phpword");
			
			$data_peminjaman = $this->peminjamanmodel->get_data_peminjaman($batch_id);
			$array_tanggal = $this->tanggal_format_indo($data_peminjaman['tanggal_pinjam']);
			
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH . 'assets/docx/format_serah_terima_peminjaman.docx');
			$isiText = "Pada hari ini ".$array_tanggal[0]." Tanggal ".$array_tanggal[1]." Bulan ".$array_tanggal[2]." Tahun ".$array_tanggal[3].", telah dilakukan serah terima peminjaman barang antara lain : ";
			$isiParagraph = new \PhpOffice\PhpWord\Element\TextRun();
			$isiParagraph->addText($isiText, array('name' => 'Times New Roman', 'size' => 11));
	
			$templateProcessor->setComplexValue('isi', $isiParagraph);
	
			$table = new \PhpOffice\PhpWord\Element\Table(array('borderSize' => 11, 'borderColor' => 'black', 'width' => 50 * 50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
	
			$table->addRow();
			$table->addCell(300)->addText('NO', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('JENIS BANTUAN', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('VOLUME', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('SATUAN', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('SUMBER', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('KET', array('name' => 'Times New Roman','bold' => true));
	
			$i = 0;
			foreach ($data_barang_keluar as $barang_keluar_value) {
				$i++;
				$table->addRow();
				$table->addCell(300)->addText($i . '.', array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_jenisbarang'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['jumlah'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_satuan'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_sumber'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText('', array('name' => 'Times New Roman', 'size' => 11));
			}
	
			$templateProcessor->setComplexBlock('table', $table);
	
			$templateProcessor->setValue('nama_pihak1', $data_peminjaman['nama_pihak_pertama']);
			$templateProcessor->setValue('jabatan_pihak1', $data_peminjaman['jabatan_pihak_pertama']);
			$templateProcessor->setValue('nama_pihak2',$data_peminjaman['nama_penanggungjawab']);
			$templateProcessor->setValue('nohp_pihak2', $data_peminjaman['no_hp']);
			$templateProcessor->setValue('kepala_pelaksana', $data_peminjaman['kepala_pelaksana']);
			$templateProcessor->setValue('jabatan_pelaksana', $data_peminjaman['jabatan_pelaksana']);
			$templateProcessor->setValue('nip_pelaksana', $data_peminjaman['nip_pelaksana']);
	
			$tempFilename = 'Berita_Acara_Serah_Terima_Peminjaman_' . time() .'_'.$batch_id. '.docx';
			$templateProcessor->saveAs($tempFilename);
	
			header('Content-Description: File Transfer');
			header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
			header('Content-Disposition: attachment; filename=' . basename($tempFilename));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($tempFilename));
			flush();
			readfile($tempFilename);
			unlink($tempFilename);
			exit;
		} catch (\Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses dokumen. Silakan coba lagi nanti.');
		}
		redirect('barangkeluar/detail_peminjaman/'.$batch_id);
	}

	public function cetak_serah_terima($batch_id){
	
		if($batch_id == null){
			$this->session->set_flashdata('error', 'Cetak Serah Terima Gagal. Batch ID tidak ditemukan!');
			redirect('barangkeluar');
		}
	
		$data_barang_keluar = $this->barangkeluarmodel->get_all_barang_keluar($batch_id);
	
		if(empty($data_barang_keluar)){
			$this->session->set_flashdata('error', 'Data tidak ditemukan untuk Batch ID ' . $batch_id);
			redirect('barangkeluar');
		}
						
		try {
			ob_start();
			$this->load->library("Phpword");
			
			$data_serah_terima = $this->barangkeluarmodel->get_data_serah_terima($batch_id);
			$array_tanggal = $this->tanggal_format_indo($data_serah_terima['tanggal']);
			
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH . 'assets/docx/format_serah_terima.docx');
			$isiText = "Pada hari ini ".$array_tanggal[0]." Tanggal ".$array_tanggal[1]." Bulan ".$array_tanggal[2]." Tahun ".$array_tanggal[3].", telah dilakukan serah terima bantuan Logistik antara lain : ";
			$isiParagraph = new \PhpOffice\PhpWord\Element\TextRun();
			$isiParagraph->addText($isiText, array('name' => 'Times New Roman', 'size' => 11));
	
			$templateProcessor->setComplexValue('isi', $isiParagraph);
	
			$table = new \PhpOffice\PhpWord\Element\Table(array('borderSize' => 11, 'borderColor' => 'black', 'width' => 50 * 50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
	
			$table->addRow();
			$table->addCell(300)->addText('NO', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('JENIS BANTUAN', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('VOLUME', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('SATUAN', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('SUMBER', array('name' => 'Times New Roman','bold' => true));
			$table->addCell(2000)->addText('KET', array('name' => 'Times New Roman','bold' => true));
	
			$i = 0;
			foreach ($data_barang_keluar as $barang_keluar_value) {
				$i++;
				$table->addRow();
				$table->addCell(300)->addText($i . '.', array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_jenisbarang'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['jumlah'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_satuan'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText($barang_keluar_value['nama_sumber'], array('name' => 'Times New Roman', 'size' => 11));
				$table->addCell(2000)->addText('', array('name' => 'Times New Roman', 'size' => 11));
			}
	
			$templateProcessor->setComplexBlock('table', $table);
	
			$templateProcessor->setValue('nama_pihak1', $data_serah_terima['nama_pihak_pertama']);
			$templateProcessor->setValue('jabatan_pihak1', $data_serah_terima['jabatan_pihak_pertama']);
			$templateProcessor->setValue('nama_pihak2',$data_serah_terima['nama_pihak_kedua']);
			$templateProcessor->setValue('no_hp', $data_serah_terima['alamat_pihak_kedua']);
			$templateProcessor->setValue('desa', $data_serah_terima['nama_desa']);
			$templateProcessor->setValue('nama_kades', $data_serah_terima['nama_kades']);
			$templateProcessor->setValue('kepala_pelaksana', $data_serah_terima['kepala_pelaksana']);
			$templateProcessor->setValue('jabatan_pelaksana', $data_serah_terima['jabatan_pelaksana']);
			$templateProcessor->setValue('nip_pelaksana', $data_serah_terima['nip_pelaksana']);
	
			$tempFilename = 'Berita_Acara_Serah_Terima_' . time() .'_'.$batch_id. '.docx';
			$templateProcessor->saveAs($tempFilename);
	
			header('Content-Description: File Transfer');
			header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
			header('Content-Disposition: attachment; filename=' . basename($tempFilename));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($tempFilename));
			flush();
			readfile($tempFilename);
			unlink($tempFilename);
			exit;
		} catch (\Exception $e) {
			log_message('error', $e->getMessage());
			$this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses dokumen. Silakan coba lagi nanti.');
		}
		redirect('barangkeluar');
	}

	public function generate_serah_terima()
	{
		$nama_pihak1 = htmlspecialchars($this->input->post('nama_pihak_pertama'));
		$jabatan_pihak1 = htmlspecialchars($this->input->post('jabatan_pihak_pertama'));
		$nama_pihak2 = htmlspecialchars($this->input->post('nama_pihak_kedua'));
		$alamat_pihak2 = htmlspecialchars($this->input->post('alamat_pihak_kedua'));
		$desa = htmlspecialchars($this->input->post('nama_desa'));
		$nama_kades = htmlspecialchars($this->input->post('nama_kades'));
		$kepala_pelaksana = htmlspecialchars($this->input->post('kepala_pelaksana'));
		$jabatan_pelaksana = htmlspecialchars($this->input->post('jabatan_pelaksana'));
		$nip_pelaksana = htmlspecialchars($this->input->post('nip_pelaksana'));
		
		$tanggal = htmlspecialchars($this->input->post('tanggal_serah_terima'));
		$batch_id = htmlspecialchars($this->input->post('batch_id'));

		$data = [
			'tanggal' => $tanggal,
			'nama_pihak_pertama' => $nama_pihak1,
			'jabatan_pihak_pertama' => $jabatan_pihak1,
			'nama_pihak_kedua' => $nama_pihak2,
			'alamat_pihak_kedua' => $alamat_pihak2,
			'nama_desa' => $desa,
			'nama_kades' => $nama_kades,
			'kepala_pelaksana' => $kepala_pelaksana,
			'jabatan_pelaksana' => $jabatan_pelaksana,
			'nip_pelaksana' => $nip_pelaksana,
			'batch_id' => $batch_id
		];

		$insert_berita_acara = $this->barangkeluarmodel->insert_data_serah_terima($data);

		
		if($insert_berita_acara){
			$this->session->set_flashdata('success', 'Berhasil Generate BA Serah Terima.');
		}else{
			$this->session->set_flashdata('error', 'Gagal Generate BA Serah Terima.');
		}
		
		redirect('barangkeluar');
	}

	public function update_serah_terima()
	{
		$id_serah_terima = htmlspecialchars($this->input->post('id_serah_terima'));
		$nama_pihak1 = htmlspecialchars($this->input->post('nama_pihak_pertama'));
		$jabatan_pihak1 = htmlspecialchars($this->input->post('jabatan_pihak_pertama'));
		$nama_pihak2 = htmlspecialchars($this->input->post('nama_pihak_kedua'));
		$alamat_pihak2 = htmlspecialchars($this->input->post('alamat_pihak_kedua'));
		$desa = htmlspecialchars($this->input->post('nama_desa'));
		$nama_kades = htmlspecialchars($this->input->post('nama_kades'));
		$kepala_pelaksana = htmlspecialchars($this->input->post('kepala_pelaksana'));
		$jabatan_pelaksana = htmlspecialchars($this->input->post('jabatan_pelaksana'));
		$nip_pelaksana = htmlspecialchars($this->input->post('nip_pelaksana'));

		$tanggal = htmlspecialchars($this->input->post('tanggal_serah_terima'));
		$batch_id = htmlspecialchars($this->input->post('batch_id'));

		// Fetch existing serah_terima data based on the ID
		$serah_terima_data = $this->barangkeluarmodel->get_data_serah_terima($batch_id);

		if (!$serah_terima_data) {
			$this->session->set_flashdata('error', 'Data Serah Terima tidak ditemukan.');
			redirect('barangkeluar/detail_serah_terima/'.$batch_id);
			return;
		}
		
		$data = [
			'tanggal' => $tanggal,
			'nama_pihak_pertama' => $nama_pihak1,
			'jabatan_pihak_pertama' => $jabatan_pihak1,
			'nama_pihak_kedua' => $nama_pihak2,
			'alamat_pihak_kedua' => $alamat_pihak2,
			'nama_desa' => $desa,
			'nama_kades' => $nama_kades,
			'kepala_pelaksana' => $kepala_pelaksana,
			'jabatan_pelaksana' => $jabatan_pelaksana,
			'nip_pelaksana' => $nip_pelaksana
		];

		// Update the data in the database
		$update_berita_acara = $this->barangkeluarmodel->update_data_serah_terima($batch_id, $data);

		if ($update_berita_acara) {
			$this->session->set_flashdata('success', 'Berhasil Update BA Serah Terima.');
		} else {
			$this->session->set_flashdata('error', 'Gagal Update BA Serah Terima.');
		}

		redirect('barangkeluar/detail_serah_terima/'.$batch_id);
	}


	public function tanggal_format_indo($tanggal = null)
	{
		if ($tanggal != null) {
			// Array nama hari dalam bahasa Indonesia
			$hari = array(
				'Minggu',
				'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu'
			);
			
			// Array nama bulan dalam bahasa Indonesia
			$bulan = array(
				1 => 'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);

			// Memecah tanggal input menjadi format Y-m-d
			$pecahkan = explode('-', $tanggal);

			// Mendapatkan timestamp dari tanggal input
			$timestamp = strtotime($tanggal);

			// Mendapatkan nama hari dari timestamp
			$nama_hari = $hari[date('w', $timestamp)];

			// Mengubah tanggal dan tahun (angka) menjadi teks
			$tanggal_terbilang = $this->terbilang((int)$pecahkan[2]);
			$tahun_terbilang = $this->terbilang((int)$pecahkan[0]);

			// Format akhir: Hari, Tanggal (dalam teks) Bulan Tahun (dalam teks)
			$result = [$nama_hari, $tanggal_terbilang, $bulan[(int)$pecahkan[1]], $tahun_terbilang];

			return $result;
		} else {
			return false;
		}
	}

	// Fungsi untuk mengubah angka menjadi teks bahasa Indonesia
	public function terbilang($angka)
	{
		$angka = abs($angka);
		$angka_terbilang = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";

		if ($angka < 12) {
			$temp = " " . $angka_terbilang[(int)$angka];
		} else if ($angka < 20) {
			$temp = $this->terbilang($angka - 10) . " Belas ";
		} else if ($angka < 100) {
			$temp = $this->terbilang($angka / 10) . " Puluh " . $this->terbilang($angka % 10);
		} else if ($angka < 200) {
			$temp = " Seratus" . $this->terbilang($angka - 100);
		} else if ($angka < 1000) {
			$temp = $this->terbilang($angka / 100) . " Ratus " . $this->terbilang($angka % 100);
		} else if ($angka < 2000) {
			$temp = " Seribu" . $this->terbilang($angka - 1000);
		} else if ($angka < 1000000) {
			$temp = $this->terbilang($angka / 1000) . " Ribu " . $this->terbilang($angka % 1000);
		} else if ($angka < 1000000000) {
			$temp = $this->terbilang($angka / 1000000) . " Juta " . $this->terbilang($angka % 1000000);
		}

		return trim($temp);
	}

}