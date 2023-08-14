<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_publicationController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('M_guide', 'm_guide');
        $this->load->model('M_log', 'm_log');
	}

	public function publication()
	{
		if (isset($_SESSION['email']) != null) {

            $data['list_guides'] = $this->m_guide->getall();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/publication_menu/index', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}

    public function create()
    {
        if (isset($_SESSION['email']) != null) {

            $data['list_guides'] = $this->m_guide->getall();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/publication_menu/create', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
    }

    public function store()
    {
        $foldername = "./assets/file_publication/".str_replace( ' ', '-', $this->input->post('name'));

        if (!is_dir($foldername)) {
            mkdir($foldername, 0777, TRUE);
        }

        /* $title_picture = $_FILES['title_picture']['name'];

        if ($_FILES['title_picture']['name'] != null) {
            $upload_picture = $this->upload_picture($foldername);
            if ($upload_picture == null) {
                $title_picture = "default.jpg";
            }else{
                $title_picture = $upload_picture;
            }
        }else{
            $title_picture = "default.jpg";
        }

       $file = $_FILES['file_publication']['name'];

       if ($_FILES['file_publication']['name'] != null) {
            $upload_file = $this->upload_file($foldername);
            if ($upload_file == null) {
                $file = NULL;
            }else{
                $file = $upload_file;
            }
        }else{
            $file = NULL;
        } */

        $item_publication = array(
            'id_category' => $this->input->post('id_category'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        $create_publication = $this->m_guide->add($item_publication);

        $upload_publication = $this->upload_file_publication($create_publication, $foldername);

        $itemLog = array(
            'page' => 'publication_menu',
            'action' => 'create',
            'description' => $_SESSION['email'].' menambahkan guide dengan id = '.$create_publication,
            'database' => 'guides',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data publication berhasil ditambahkan!'); // Buat session flashdata
		redirect(base_url('publication_menu'));

    }

    public function edit($id)
    {
        if (isset($_SESSION['email']) != null) {

            $data['list_guides'] = $this->m_guide->getall();

            $data['guide'] = $this->m_guide->getbyid($id);

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/publication_menu/edit', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
    }

    public function update()
    {

        $id = $this->input->post('id');

        $get_publication = $this->m_guide->getbyid($id);
        
        $foldername = "./assets/file_publication/".str_replace( ' ', '-', $get_publication[0]->name);
        $newfoldername = "./assets/file_publication/".str_replace( ' ', '-', $this->input->post('name'));

        rename($foldername, $newfoldername);

        $item_publication = array(
            'id_category' => $this->input->post('id_category'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        $update_publication = $this->m_guide->edit($id, $item_publication);

        $upload_publication = $this->upload_file_publication($id, $newfoldername);

        $itemLog = array(
            'page' => 'publication_menu',
            'action' => 'update',
            'description' => $_SESSION['email'].' mengubah guide dengan id = '.$id,
            'database' => 'guides',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data publication berhasil diubah!'); // Buat session flashdata
		redirect(base_url('publication_menu'));
    }

    /* public function upload_picture($foldername)
	{
        $rand = md5(rand(100,200));
        $name = str_replace( ' ', '-', $this->input->post('name'));
        $date = str_replace(' ', '', date('d m Y'));
        $title_picture = 'title_picture_'.$date.'_'.$name.'_'.$rand;

		$config['upload_path']          = $foldername;
        $config['allowed_types']        = 'jpg|jpeg|png|gif';
        $config['overwrite']			= TRUE;
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_name']            = $title_picture;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('title_picture')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }else{
            $data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
        }
	}

    public function upload_file($foldername)
	{
        $rand = md5(rand(100,200));
        $name = str_replace( ' ', '-', $this->input->post('name'));
        $date = str_replace(' ', '', date('d m Y'));
        $title_file = 'file_'.$date.'_'.$name.'_'.$rand;

		$config['upload_path']          = $foldername;
        $config['allowed_types']        = 'docx|doc|pdf|rar|zip|xls|xlsx|7Z|7-Zip|jpg|jpeg|gif|png|ppt|csv|tif';
        $config['overwrite']			= TRUE;
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_name']            = $title_file;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_publication')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }else{
            $data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
        }
        

        if ($this->upload->do_upload('file')) {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        } else {
            return false;
        }

	} */

    public function upload_file_publication($id, $foldername)
	{
        $title_picture = $_FILES['title_picture']['name'];      
        $file_publication = $_FILES['file_publication']['name']; 

        /* if($title_picture !== "") {

            $rand = md5(rand(100,200));
            $name = str_replace( ' ', '-', $this->input->post('name'));
            $date = str_replace(' ', '', date('d m Y'));
            $title_picture = 'title_picture_'.$date.'_'.$name.'_'.$rand;

            $config['upload_path']          = $foldername;
            $config['allowed_types']        = 'docx|doc|pdf|rar|zip|xls|xlsx|7Z|7-Zip|jpg|jpeg|gif|png|ppt|csv|tif';
            $config['overwrite']			= FALSE;
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            $config['file_name']            = $title_picture;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('title_picture')) {
                $data = array('upload_data' => $this->upload->data());

                $item_update_publication = array(
                    'title_picture' => $data['upload_data']['file_name'],
                );
                $update_publication = $this->m_guide->edit($id, $item_update_publication);

                return $data['upload_data']['file_name'];
            } else {
                return false;
            }  

        }

        if($file_publication !== "") {

            $rand = md5(rand(100,200));
            $name = str_replace( ' ', '-', $this->input->post('name'));
            $date = str_replace(' ', '', date('d m Y'));
            $title_file = 'title_file_'.$date.'_'.$name.'_'.$rand;

            $config['upload_path']          = $foldername;
            $config['allowed_types']        = 'docx|doc|pdf|rar|zip|xls|xlsx|7Z|7-Zip|jpg|jpeg|gif|png|ppt|csv|tif';
            $config['overwrite']			= TRUE;
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            $config['file_name']            = $title_file;

            $this->load->library('upload', $config);   

            if ($this->upload->do_upload('file_publication')) {
                $data = array('data_upload' => $this->upload->data());

                $item_update_publication = array(
                    'file' => $data['data_upload']['file_name'],
                );
                $update_publication = $this->m_guide->edit($id, $item_update_publication);

                return $data['data_upload']['file_name'];
            } else {
                return false;
            }

        } */

        if($title_picture !== "") {
            $rand = md5(rand(100,200));
            $name = str_replace( ' ', '-', $this->input->post('name'));
            $date = str_replace(' ', '', date('d m Y'));
            $title = $date.'_'.$name.'_'.$rand;

            $config['upload_path'] = $foldername;                        
            $config['log_threshold'] = 1;
            $config['allowed_types'] = 'docx|doc|pdf|rar|zip|xls|xlsx|7Z|7-Zip|jpg|jpeg|gif|png|ppt|csv|tif';
            $config['max_size'] = 0; // 0 = no file size limit
            $config['file_name']=$title;          
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->do_upload('title_picture');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            $item_update_publication = array(
                'title_picture' => $file_name,
            );
            $update_publication = $this->m_guide->edit($id, $item_update_publication);
        }

        if($file_publication !== "") {
            $rand = md5(rand(100,200));
            $name = str_replace( ' ', '-', $this->input->post('name'));
            $date = str_replace(' ', '', date('d m Y'));
            $title = $date.'_'.$name.'_'.$rand;

            $config['upload_path'] = $foldername;                        
            $config['log_threshold'] = 1;
            $config['allowed_types'] = 'docx|doc|pdf|rar|zip|xls|xlsx|7Z|7-Zip|jpg|jpeg|gif|png|ppt|csv|tif';
            $config['max_size'] = 0; // 0 = no file size limit
            $config['file_name']=$title;           
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_publication');
            $upload_data = $this->upload->data();
            $file_name1 = $upload_data['file_name'];
            $item_update_publication = array(
                'file' => $file_name1,
            );
            $update_publication = $this->m_guide->edit($id, $item_update_publication);
        }

	}

    public function destroy($id)
    {
        $publication = $this->m_guide->getbyid($id);

        $itemLog = array(
            'page' => 'publication_menu',
            'action' => 'delete',
            'description' => $_SESSION['email'].' menghapus guide dengan nama = '.$publication[0]->title,
            'database' => 'guides',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->m_guide->delete($id);

        $this->session->set_flashdata('status', 'Data Guide berhasil dihapus!'); // Buat session flashdata
		redirect(base_url('publication_menu'));
    }
    
}

