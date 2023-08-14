<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usersController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('M_user', 'm_user');
        $this->load->model('M_log', 'm_log');
	}

	public function user()
	{
		if (isset($_SESSION['email']) != null) {

            $data['list_users'] = $this->m_user->getall();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/user/index', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}

    public function create()
	{
		if (isset($_SESSION['email']) != null) {

            $data['list_users'] = $this->m_user->getall();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/user/create', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}

    public function store()
    {
        $item = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
        );
        $create_user = $this->m_user->add($item);

        $itemLog = array(
            'page' => 'User',
            'action' => 'create',
            'description' => $_SESSION['email'].' menambahkan user dengan id = '.$create_user->id,
            'database' => 'users',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data user berhasil ditambahkan!'); // Buat session flashdata
		redirect(base_url('user/create'));

    }

    public function show($id)
    {
        if (isset($_SESSION['email']) != null) {

            $data['list_users'] = $this->m_user->getall();

            $data['user'] = $this->m_user->getbyid($id);

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/user/show', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}    
    }

    public function edit($id)
    {
        if (isset($_SESSION['email']) != null) {

            $data['list_users'] = $this->m_user->getall();

            $data['user'] = $this->m_user->getbyid($id);

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/user/edit', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}    
    }

    public function update($id)
    {
        $item = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
        );
        $update_user = $this->m_user->edit($id, $item);

        $itemLog = array(
            'page' => 'User',
            'action' => 'create',
            'description' => $_SESSION['email'].' mengubah user dengan id = '.$update_user->id,
            'database' => 'users',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data user berhasil diubah!'); // Buat session flashdata
		redirect(base_url('user/'.$id));

    }

    public function destroy($id)
    {
        $user = $this->m_user->getbyid($id);

        $itemLog = array(
            'page' => 'User',
            'action' => 'create',
            'description' => $_SESSION['email'].' menghapus user dengan nama = '.$user[0]->id,
            'database' => 'users',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->m_user->delete($id);

        $this->session->set_flashdata('status', 'Data user berhasil diubah!'); // Buat session flashdata
		redirect(base_url('user'));

    }
    
}
