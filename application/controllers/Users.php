<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
		
		if (!$this->session->userdata('id_auth')) {
			redirect(base_url('auth'));
		}

		if ($this->session->userdata('role') != 'administrator') {
			$this->session->set_flashdata('error', 'Anda tidak punya akses ke halaman tersebut. Silahkan login dan masuk ke halaman yang diizinkan!');
			redirect(base_url('logout'));
		}
	}
	
	public function index()
	{
		$data = [
			'menu' => 'users',
			'data_user' => $this->AuthModel->get_user()
		];
		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/admin/users');
		$this->load->view('templates/footer');
	}

	// Method untuk menangani simpan data user (Save Add User)
	public function save_add()
	{
		// Tangkap data dari form POST
		$name = htmlspecialchars($this->input->post('name'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role = htmlspecialchars($this->input->post('role'));

		// Cek apakah username sudah digunakan
		if ($this->UserModel->isUsernameTaken($username)) {
			// Jika username sudah digunakan, set pesan error
			$this->session->set_flashdata('error', 'Username sudah digunakan. Silahkan pilih username yang lain.');
			redirect('users'); // Ganti 'users/add' dengan path yang sesuai untuk form tambah user
		} else {
			// Simpan data ke dalam database melalui model
			$user_data = array(
				'name' => $name,
				'username' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => $role,
				'aktifitas' => 'aktif'
			);

			$saved = $this->UserModel->saveUser($user_data);

			if ($saved) {
				// Jika berhasil disimpan, redirect atau set pesan sukses
				$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
			} else {
				// Jika gagal simpan, redirect atau set pesan error
				$this->session->set_flashdata('error', 'Gagal menambahkan user.');
			}

			redirect('users'); // Ganti 'users' dengan controller/method yang sesuai
		}
	}

	// Method untuk menangani simpan perubahan data user (Save Edit User)
	public function save_edit()
	{
		// Tangkap data dari form POST
		$user_id = htmlspecialchars($this->input->post('user_id'));
		$name = htmlspecialchars($this->input->post('name'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role = htmlspecialchars($this->input->post('role'));
		$aktifitas = htmlspecialchars($this->input->post('aktifitas'));

		// Cek apakah username sudah digunakan oleh pengguna lain
		if ($this->UserModel->isUsernameTakenByOther($username, $user_id)) {
			// Jika username sudah digunakan, set pesan error
			$this->session->set_flashdata('error', 'Username sudah digunakan. Silahkan pilih username yang lain.');
			redirect('users'); // Ganti 'users/edit/' dengan path yang sesuai untuk form edit user
		} else {
			if ($password != '') {
				// Simpan perubahan data ke dalam database melalui model
				$user_data = array(
					'name' => $name,
					'username' => $username,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'role' => $role,
					'aktifitas' => $aktifitas
				);
			} else {
				$user_data = array(
					'name' => $name,
					'username' => $username,
					'role' => $role,
					'aktifitas' => $aktifitas
				);
			}

			$updated = $this->UserModel->updateUser($user_id, $user_data);

			if ($updated) {
				// Jika berhasil diupdate, redirect atau set pesan sukses
				$this->session->set_flashdata('success', 'Data user berhasil diupdate.');
			} else {
				// Jika gagal update, redirect atau set pesan error
				$this->session->set_flashdata('error', 'Gagal mengupdate data user.');
			}

			redirect('users'); // Ganti 'users' dengan controller/method yang sesuai
		}
	}

	 // Method untuk menangani proses penghapusan user dari database
	 public function delete()
	 {
		
		 $user_id = htmlspecialchars($this->input->post('user_id'));
 
		 // Hapus user dari database melalui model
		 $deleted = $this->UserModel->deleteUser($user_id);
 
		 if ($deleted) {
			 // Jika berhasil dihapus, redirect atau set pesan sukses
			 $this->session->set_flashdata('success', 'User berhasil dihapus.');
		 } else {
			 // Jika gagal hapus, redirect atau set pesan error
			 $this->session->set_flashdata('error', 'Gagal menghapus user.');
		 }
 
		 redirect('users'); // Ganti 'users' dengan controller/method yang sesuai
	 }
}