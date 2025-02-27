<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model("barangkeluarmodel");
		$this->load->model('masterdatamodel');
        $this->load->model('peminjamanmodel');
        $this->load->model('barangmasukmodel');
        $this->load->model('kondisiterkinimodel');
        $this->load->model('stokmodel');
        $this->load->model('databencanamodel');
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
		$jumlah_stok_terkini = $this->stokmodel->get_total_stok_terkini();
		$jumlah_masuk_perbulan = $this->barangmasukmodel->get_jumlah_barang_masuk_perbulan();
		$jumlah_keluar_perbulan = $this->barangkeluarmodel->get_jumlah_perbulan();
		$jumlah_bencana = $this->databencanamodel->get_total_bencana();
		
		$barang_masuk_bulan_ini = $this->barangmasukmodel->get_barang_masuk_bulan_ini();
		$barang_keluar_bulan_ini = $this->barangkeluarmodel->get_barang_keluar_bulan_ini();
		$bencana_bulan_ini = $this->databencanamodel->get_bencana_bulan_ini();
		$statistik_barang_masuk = $this->barangmasukmodel->get_barang_masuk_per_bulan();
		$statistik_barang_keluar = $this->barangkeluarmodel->get_barang_keluar_per_bulan();

		$peminjaman_diterima = $this->peminjamanmodel->get_peminjaman_diterima();
		
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
			'peminjaman_diterima' => $peminjaman_diterima,
		];
		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/admin/index');
		$this->load->view('templates/footer');
		$this->load->view('pages/admin/modals/indexmodal');
		$this->load->view('templates/dashboard-js');
	}

}