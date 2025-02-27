<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangMasuk extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('masterdatamodel');
        $this->load->model('barangmasukmodel');
        $this->load->model('kondisiterkinimodel');
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
		$jenis_barang = $this->masterdatamodel->get_all_data('master_jenis_barang');
		$jenis_bencana = $this->masterdatamodel->get_all_data('master_jenis_bencana');
		$kondisi = $this->masterdatamodel->get_all_data('master_kondisi');
		$satuan = $this->masterdatamodel->get_all_data('master_satuan');
		$sumber = $this->masterdatamodel->get_all_data('master_sumber');
		$klasifikasi = $this->masterdatamodel->get_all_data('klasifikasi');
		$barang_masuk = $this->barangmasukmodel->get_join_all_data();
		
		$data = [
			'menu' => 'barangmasuk',
			'jenis_barang' => $jenis_barang,
			'jenis_bencana' => $jenis_bencana,
			'kondisi' => $kondisi,
			'satuan' => $satuan,
			'sumber' => $sumber,
			'klasifikasi' => $klasifikasi,
			'barang_masuk' => $barang_masuk
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/barangmasuk');
		$this->load->view('templates/footer');
		$this->load->view('pages/admin/modals/barangmasuk');
	}

	public function add()
	{
		// Mulai transaksi
		$this->db->trans_start();

		// Ambil data dari form
		$tanggal_masuk = htmlspecialchars($this->input->post('tanggal_masuk'));
		$stok_id = htmlspecialchars($this->input->post('stok_id'));
		$jenis_barang_id = htmlspecialchars($this->input->post('jenis_barang_id'));
		$klasifikasi_id = htmlspecialchars($this->input->post('klasifikasi_id'));
		$satuan_id = htmlspecialchars($this->input->post('satuan_id'));
		$sumber_id = htmlspecialchars($this->input->post('sumber_id'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$tahun = htmlspecialchars($this->input->post('tahun'));
		$keterangan_tambahan = $this->input->post('keterangan_tambahan') == ''
			? null : htmlspecialchars($this->input->post('keterangan_tambahan'));

		// Insert data barang masuk terlebih dahulu
		$data_barang_masuk = [
			'id_stok' => $stok_id,
			'jenis_barang_id' => $jenis_barang_id,
			'klasifikasi_id' => $klasifikasi_id,
			'satuan_id' => $satuan_id,
			'sumber_id' => $sumber_id,
			'jumlah' => $jumlah,
			'tahun' => $tahun,
			'keterangan_tambahan' => $keterangan_tambahan,
			'tanggal_masuk' => $tanggal_masuk
		];

		// Insert data barang masuk
		$this->barangmasukmodel->insert_data($data_barang_masuk);

		// Loop data kondisi terkini dan insert satu per satu
		$count_insert = 0;
		$data_master_kondisi = $this->masterdatamodel->get_all_data('master_kondisi');

		foreach ($data_master_kondisi as $key => $value) {
			$jumlah_perkondisi = htmlspecialchars($this->input->post($value['id_kondisi']));
			$data_kondisi = [
				'kondisi_logpal_id' => $value['id_kondisi'],
				'stok_id' => $stok_id,
				'stok_masuk' => $jumlah_perkondisi,
				'stok_terkini' => $jumlah_perkondisi
			];

			// Insert data kondisi terkini
			if ($this->kondisiterkinimodel->insert_data($data_kondisi)) {
				$count_insert++; // Tambah hitungan jika berhasil insert
			}
		}

		// Cek apakah jumlah insert sesuai dengan jumlah data yang diinput
		if ($count_insert == count($data_master_kondisi)) {
			// Commit transaksi jika semua data berhasil disimpan
			$this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
		} else {
			// Rollback transaksi jika ada data yang gagal disimpan
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Data gagal disimpan!');
		}

		// Redirect ke halaman barang masuk
		redirect('barangmasuk');
	}

	public function update()
	{
		// Mulai transaksi
		$this->db->trans_start();

		// Ambil data dari form
		$tanggal_masuk = htmlspecialchars($this->input->post('tanggal_masuk'));
		$stok_id = htmlspecialchars($this->input->post('stok_id'));
		$jenis_barang_id = htmlspecialchars($this->input->post('jenis_barang_id'));
		$klasifikasi_id = htmlspecialchars($this->input->post('klasifikasi_id'));
		$satuan_id = htmlspecialchars($this->input->post('satuan_id'));
		$sumber_id = htmlspecialchars($this->input->post('sumber_id'));
		$jumlah = htmlspecialchars($this->input->post('jumlah'));
		$tahun = htmlspecialchars($this->input->post('tahun'));
		$keterangan_tambahan = $this->input->post('keterangan_tambahan') == ''
			? null : htmlspecialchars($this->input->post('keterangan_tambahan'));

		// Siapkan data barang masuk
		$data_barang_masuk = [
			'jenis_barang_id' => $jenis_barang_id,
			'klasifikasi_id' => $klasifikasi_id,
			'satuan_id' => $satuan_id,
			'sumber_id' => $sumber_id,
			'jumlah' => $jumlah,
			'tahun' => $tahun,
			'keterangan_tambahan' => $keterangan_tambahan,
			'tanggal_masuk' => $tanggal_masuk
		];

		if ($stok_id) {
			// Jika ID ada, maka update data
			$this->barangmasukmodel->update_data($stok_id, $data_barang_masuk);
			$this->session->set_flashdata('success', 'Data berhasil diperbarui!');
		}

		// Loop data kondisi terkini dan insert atau update satu per satu
		$count_processed = 0;
		$data_master_kondisi = $this->masterdatamodel->get_all_data('master_kondisi');

		foreach ($data_master_kondisi as $key => $value) {
			$jumlah_perkondisi = htmlspecialchars($this->input->post($value['id_kondisi']));
			$data_kondisi = [
				'kondisi_logpal_id' => $value['id_kondisi'],
				'stok_id' => $stok_id,
				'stok_masuk' => $jumlah_perkondisi,
				'stok_terkini' => $jumlah_perkondisi
			];

			// Periksa apakah data kondisi sudah ada untuk stok ini
			$existing_kondisi = $this->kondisiterkinimodel->get_by_stok_and_kondisi($stok_id, $value['id_kondisi']);
			
			if ($existing_kondisi) {
				// Jika data kondisi sudah ada, lakukan update
				if ($this->kondisiterkinimodel->update_data($existing_kondisi['id_kondisi_terkini'], $data_kondisi)) {
					$count_processed++;
				}
			} 
		}
		
		// Cek apakah semua kondisi berhasil diproses (insert/update)
		if ($count_processed == count($data_master_kondisi)) {
			// Commit transaksi jika semua data berhasil disimpan
			$this->db->trans_commit();
		} else {
			// Rollback transaksi jika ada yang gagal
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Data gagal disimpan!');
		}

		// Redirect ke halaman barang masuk
		redirect('barangmasuk');
	}

	public function delete()
	{
		// Ambil stok_id dari form
		$stok_id = htmlspecialchars($this->input->post('stok_id'));

		// Mulai transaksi
		$this->db->trans_start();

		// Hapus data dari tabel barangmasuk berdasarkan stok_id
		$this->db->where('id_Stok', $stok_id);
		$this->db->delete('stok');

		// Hapus data kondisi terkini yang terkait dengan stok_id
		$this->db->where('stok_id', $stok_id);
		$this->db->delete('kondisi_terkini');

		// Cek jika transaksi berhasil atau gagal
		if ($this->db->trans_status() == FALSE) {
			// Rollback transaksi jika ada kesalahan
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Data gagal dihapus.');
		} else {
			// Commit transaksi jika berhasil
			$this->db->trans_commit();
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
		}

		// Redirect kembali ke halaman barang masuk
		redirect('barangmasuk');
	}

	public function masuk_stok()
	{
		// Ambil stok_id dari form
		$stok_id = htmlspecialchars($this->input->post('stok_id'));
		if ($stok_id) {
			$stok_masuk = [
				'masuk_stok' => 'sudah'
			];
			// Jika ID ada, maka update data
			$update = $this->barangmasukmodel->update_data($stok_id, $stok_masuk);
			if($update){
				$this->session->set_flashdata('success', 'Data berhasil dimasukan ke stok!');
			}else{
				$this->session->set_flashdata('error', 'Data gagal dimasukan ke stok!');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}

		// Redirect kembali ke halaman barang masuk
		redirect('barangmasuk');
	}

}