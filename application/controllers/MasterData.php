<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterData extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('masterdatamodel');
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
		
		$data = [
			'menu' => 'masterdata',
			'jenis_barang' => $jenis_barang,
			'jenis_bencana' => $jenis_bencana,
			'kondisi' => $kondisi,
			'satuan' => $satuan,
			'sumber' => $sumber,
			'klasifikasi' => $klasifikasi,
		];
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/admin/masterdata');
		$this->load->view('pages/admin/modals/masterdata');
		$this->load->view('pages/admin/modals/script-js');
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$nama = htmlspecialchars($this->input->post('nama'));
		$tabel = htmlspecialchars($this->input->post('tabel'));
		
		switch ($tabel) {
			case 'master_jenis_barang':
				$keterangan_tambahan = htmlspecialchars($this->input->post('keterangan_tambahan'));
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_jenisbarang' => $nama, 'keterangan_tambahan' => $keterangan_tambahan]);
				break;
			case 'master_jenis_bencana':
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_bencana' => $nama]);
				break;
			case 'master_kondisi':
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_kondisi' => $nama]);
				break;
			case 'master_satuan':
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_satuan' => $nama]);
				break;
			case 'master_sumber':
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_sumber' => $nama]);
				break;
			case 'klasifikasi':
				$keterangan_tambahan = htmlspecialchars($this->input->post('keterangan_tambahan'));
				$simpan = $this->masterdatamodel->insert_data($tabel, ['nama_klasifikasi' => $nama, 'keterangan_tambahan' => $keterangan_tambahan]);
				break;
		}

		if($simpan){
			// Menyimpan pesan sukses ke dalam session flashdata
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
		} else {
			// Menyimpan pesan error ke dalam session flashdata
			$this->session->set_flashdata('error', 'Data gagal disimpan!');
		}

		redirect('masterdata'); 
		
	}

	public function update()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$nama = htmlspecialchars($this->input->post('nama'));
		$tabel = htmlspecialchars($this->input->post('tabel'));
		
		switch ($tabel) {
			case 'master_jenis_barang':
				$keterangan_tambahan = htmlspecialchars($this->input->post('keterangan_tambahan'));
				$update = $this->masterdatamodel->update_data($tabel, ['id_jenisbarang' => $id], ['nama_jenisbarang' => $nama, 'keterangan_tambahan' => $keterangan_tambahan]);
				break;
			case 'master_jenis_bencana':
				$update = $this->masterdatamodel->update_data($tabel, ['id_jenis_bencana' => $id], ['nama_bencana' => $nama]);
				break;
			case 'master_kondisi':
				$update = $this->masterdatamodel->update_data($tabel, ['id_kondisi' => $id], ['nama_kondisi' => $nama]);
				break;
			case 'master_satuan':
				$update = $this->masterdatamodel->update_data($tabel, ['id_satuan' => $id], ['nama_satuan' => $nama]);
				break;
			case 'master_sumber':
				$update = $this->masterdatamodel->update_data($tabel, ['id_sumber' => $id], ['nama_sumber' => $nama]);
				break;
			case 'klasifikasi':
				$keterangan_tambahan = htmlspecialchars($this->input->post('keterangan_tambahan'));
				$update = $this->masterdatamodel->update_data($tabel, ['id_klasifikasi' => $id], ['nama_klasifikasi' => $nama,'keterangan_tambahan' => $keterangan_tambahan]);
				break;
		}

		if($update){
			$this->session->set_flashdata('success', 'Data berhasil diupdate!');
		} else {
			$this->session->set_flashdata('error', 'Data gagal diupdate!');
		}
		
		redirect('masterdata');
	}

	public function delete()
	{
		$id = htmlspecialchars($this->input->post('id'));
		$tabel = htmlspecialchars($this->input->post('tabel'));
		
		switch ($tabel) {
			case 'master_jenis_barang':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_jenisbarang' => $id]);
				break;
			case 'master_jenis_bencana':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_jenis_bencana' => $id]);
				break;
			case 'master_kondisi':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_kondisi' => $id]);
				break;
			case 'master_satuan':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_satuan' => $id]);
				break;
			case 'master_sumber':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_sumber' => $id]);
				break;
			case 'klasifikasi':
				$delete = $this->masterdatamodel->delete_data($tabel, ['id_klasifikasi' => $id]);
				break;
		}

		if($delete){
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus!');
		}
		
		redirect('masterdata');
	}

	
}