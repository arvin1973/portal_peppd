<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_loginController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_user', 'm_user');
        $this->load->model('M_log', 'm_log');
	}

	public function login()
	{
		if (isset($_SESSION['email']) == null) {

			$this->load->view('auth/V_login');
		
		}elseif (($_SESSION['email']) != null) {
			redirect(base_url('dashboard'));
		}
	}

	public function login_action()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$where = array(
			'email' => $email,
			'password' => md5($password)
			);
		$data = $this->m_user->getby($where);
		if ($data != null) {
			
			$data_session = array(
                'name' => $data[0]->name,
                'email' => $data[0]->email,
				'hak_akses' => 'admin'
                );
            $this->session->set_userdata($data_session);

			$log = array(
	            'page' => '-',
	            'action' => 'login',
                'description' => $data[0]->email.' melakukan login admin portal PEPPD',
                'database' => '-',
                'author' => $data[0]->email,

	            );
			$this->m_log->add($log);

			redirect(base_url('dashboard'));

		}else{
			$this->session->set_flashdata('message', 'Username / Password salah'); // Buat session flashdata
			redirect(base_url('login'));
		}
	}

	public function register()
	{
		if (isset($_SESSION['email']) == null) {
            
		
		}elseif (($_SESSION['email']) != null) {
			redirect(base_url('dashboard'));
		}
	}

	public function register_action($direct)
	{
		/* $name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$view_pass = $this->input->post('password');
		$hak_akses = $this->input->post('hak_akses');

		$data = array(
			'name' => $name,
			'username' => $username,
			'password' => md5($password),
			'view_pass' => $view_pass,
			'hak_akses' => $hak_akses
			);
		$this->m_user->add($data);

		$log = array(
              'username'=> 'Pengguna Baru',
              'action' => 'Melakukan registrasi dengan nama = '.$name
          );

        $this->m_log->add($log); */

		if ($direct == 'register') {
			redirect(base_url('login'));
		}else{
			redirect(base_url($direct));
		}
	}

	public function logout()
	{
        $log = array(
            'page' => '-',
            'action' => 'logout',
            'description' => $_SESSION['email'].' melakukan logout admin portal PEPPD',
            'database' => '-',
            'author' => $_SESSION['email'],

        );
        $this->m_log->add($log);

		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}