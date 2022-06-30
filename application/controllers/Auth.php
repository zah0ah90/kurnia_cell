<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}


	function index()
	{
		check_already_login();
		$this->load->view('auth/index');
	}

	function process()
	{
		$post = $this->input->post(null, true);

		// print_r(md5($this->input->post('pasword')));
		// die();
		if (isset($post['login'])) {
			$this->form_validation->set_rules('user', 'user', 'trim|required', ['required' => 'Username tidak boleh kosong']);
			$this->form_validation->set_rules('pasword', 'pasword', 'trim|required', ['required' => 'Password tidak boleh kosong']);
			if ($this->form_validation->run()) {
				$username  = $post['user'];
				$password = md5($post['pasword']);
				$cekDb = $this->db->from('user')->where('username', $username)->where('password', $password)->get()->row();
				if ($cekDb) {
					$params = [
						'id' => $cekDb->id,
						'nama' => $cekDb->nama
					];
					$this->session->set_userdata($params);
					$this->session->set_flashdata('notif', 'Login Berhasil ');
					redirect('dashboard');
				} else {
					// jika tidak ada username
					$this->session->set_flashdata('notif', 'Username dan Password Salah');
					redirect('auth');
				}
			} else {
				// menajlankan validation
				$this->session->set_flashdata('notif', validation_errors());
				redirect('auth');
			}
		}
	}

	function logout()
	{
		echo 'wowo';
		$params = ['id', 'nama'];
		// $params = ['user_id'];
		$this->session->unset_userdata($params);
		$this->session->set_flashdata('notif', 'Berhasil Logout!!');
		redirect('auth');
	}
}
