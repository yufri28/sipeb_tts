<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBencana extends CI_Controller {

	public function index()
	{
		$data = [
			'menu' => 'databencana',
		];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/databencana');
		$this->load->view('templates/footer');
	}
}