<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar extends CI_Controller {

	public function index()
	{
		$data = [
			'menu' => 'barangkeluar',
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/barangkeluar');
		$this->load->view('templates/footer');
	}
}