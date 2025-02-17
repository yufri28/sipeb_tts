<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokBarang extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('stokmodel');
    }

	public function index()
	{
		$stok = $this->stokmodel->get_join_all_data();

		$data = [
			'menu' => 'stokbarang',
			'stok' => $stok
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/stokbarang');
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
			$this->load->view('pages/kondisi');
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