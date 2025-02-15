<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = [
			'menu' => 'dashboard',
		];
		$this->load->view('templates/header',$data);
		$this->load->view('pages/index');
		$this->load->view('templates/footer');
		$this->load->view('templates/dashboard-js');
	}
}