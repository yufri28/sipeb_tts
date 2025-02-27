<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function __construct()
	{
        parent::__construct();
        $this->load->model('authmodel');
        $this->load->model('usermodel');
		
		if($this->authmodel->cek_default_admin() == false){
			$this->authmodel->add_default_admin();
		}
		if($this->session->userdata('role')) {
			redirect(base_url('dashboard'));
		}
	}
    
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<h5 class="text-danger">Login gagal!</h5>');
            redirect(base_url('auth'));
        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));

            $user = $this->authmodel->get_user_by_username($username);

            if (!empty($user) && password_verify($password, $user['password'])) {
                if($user['role'] == 'pengguna'){
                    $this->set_user_session($user);
                    redirect(base_url('useraccess'));
                }elseif($user['role'] == 'kepala_dinas'){
                    $this->set_user_session($user);
                    redirect(base_url('hodaccess'));
                }else{
                    $this->set_user_session($user);
                    redirect(base_url('dashboard'));
                }
            } else {
                $this->session->set_flashdata('message', '<h5 class="text-danger">Login gagal!</h5>');
                redirect(base_url('auth'));
            }
        }
    }

    private function set_user_session($user) {
        $data_session = array(
            'id_auth' => $user['id_user'],
            'name' => $user['name'],
            'username' => $user['username'],
            'role' => $user['role']
        );
        $this->session->set_userdata($data_session);
    }

    public function register()
	{
		$this->load->view('auth/register');
	}

	public function register_save()
	{
		// Tangkap data dari form POST
		$name = htmlspecialchars($this->input->post('name'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$role = 'pengguna';

		// Cek apakah username sudah digunakan
		if ($this->usermodel->isUsernameTaken($username)) {
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

			$saved = $this->usermodel->saveUser($user_data);

			if ($saved) {
				// Jika berhasil disimpan, redirect atau set pesan sukses
				$this->session->set_flashdata('success', 'Register berhasil.');
			} else {
				// Jika gagal simpan, redirect atau set pesan error
				$this->session->set_flashdata('error', 'Register Gagal.');
			}

			redirect('auth');
		}
	}
	
}