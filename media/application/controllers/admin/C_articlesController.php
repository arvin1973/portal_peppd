<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_articlesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('M_article', 'm_article');
        $this->load->model('M_log', 'm_log');
	}

	public function article()
	{
		if (isset($_SESSION['email']) != null) {

            $data['list_articles'] = $this->m_article->joinCategories();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/article/index', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}

    public function updateStatus()
    {
        $id = $this->input->post('id');
        
        $item_article = array(
            'status' => $this->input->post('status'),
        );
        $status_article = $this->m_article->edit($id, $item_article);

        if($status_article == 1){
            $get_article = $this->m_article->joinCategorieswhere1('articles.id', $id);
        }

        echo json_encode($get_article);
    }

    public function create()
	{
		if (isset($_SESSION['email']) != null) {

            $data['list_articles'] = $this->m_article->joinCategories();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/article/create', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}

    public function edit($slug)
    {
        if (isset($_SESSION['email']) != null) {

            $where_article = array(
                'slug' => $slug,
            );
            $data['article'] = $this->m_article->getby($where_article);

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/article/edit', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}    
    }

     //Upload image summernote
     public function saveImageSummernote(){

        $return_value = "";
		if ($_FILES['image']['name']) {
			if (!$_FILES['image']['error']) {
				
				$name = md5(rand(100,200));
                $date = str_replace(' ', '', date('d m Y'));
				$ext = explode('.', $_FILES['image']['name']);
				$filename = $date.'_'.$name.'.'.$ext[1];

				$config['upload_path']          = './assets/images/summernote';
		        $config['allowed_types']        = 'jpg|jpeg|png|gif';
		        $config['overwrite']			= TRUE;
		        $config['max_size']             = 0;
		        $config['max_width']            = 0;
		        $config['max_height']           = 0;
		        $config['file_name']            = $filename;

		        $this->load->library('upload', $config);

		        if ( ! $this->upload->do_upload('image')) {
		            $return_value = 'Ooops! Your upload triggered the following error:'.$_FILES['image']['error'];
		        }else{
		        	$image_source = base_url().'assets/images/summernote/'.$filename;
		            $return_value = $image_source;

		            //get image size
	                list($width, $height) = getimagesize('./assets/images/summernote/'.$filename);

		            //Compress Image
	                $config['image_library']='gd2';
	                $config['source_image']='./assets/images/summernote/'.$filename;
	                $config['create_thumb']= FALSE;
	                $config['maintain_ratio']= TRUE;
	                $config['quality']= '100%';
	                if ($width > 600) {
	                	$config['width']= 600;
	                }
	                $config['new_image']= './assets/images/summernote/'.$filename;
	                $this->load->library('image_lib', $config);
	                $this->image_lib->resize();
		        }
		    }
		}
		echo $return_value;


    }
 
    //Delete image summernote
    public function deleteImageSummernote(){
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
    }

    public function store()
    {
        $text = $this->input->post('text');

        $title_picture = $_FILES['title_picture']['name'];

        if ($_FILES['title_picture']['name'] != null) {
            $upload = $this->upload_foto();
           if ($upload == null) {
               $title_picture = "default.jpg";
           }else{
                $title_picture = $upload;
           }
       }

       $string_replace_dash = str_replace(' ', '-', $this->input->post('title'));
       $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string_replace_dash);

        $item_article = array(
            'id_category' => $this->input->post('id_category'),
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'description' => $this->input->post('description'),
            'title_picture' => $title_picture,
            'text' => $text,
            'author' => $_SESSION['email'],
            'status' => 'draft',
            'created_at' => $this->input->post('created_at'),
        );

        $create_article = $this->m_article->add($item_article);

        $itemLog = array(
            'page' => 'Article',
            'action' => 'create',
            'description' => $_SESSION['email'].' menambahkan article dengan id = '.$create_article,
            'database' => 'articles',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data article berhasil ditambahkan!'); // Buat session flashdata
		redirect(base_url('article'));
   
    }

    public function update()
    {
        $slug = $this->input->post('slug');
        $text = $this->input->post('text');

        $where_get_article = array(
            'slug' => $slug,
        );
        $get_article = $this->m_article->getby($where_get_article);

        if ($_FILES['title_picture']['name'] != null) {
            $upload = $this->upload_foto();
           if ($upload == null) {
                $title_picture = "default.jpg";
           }else{
                unlink('assets/images/summernote/'.$get_article[0]->title_picture);

                $title_picture = $upload;
                $where_picture_article = array(
                    'slug' => $slug,
                );
                $item_picture_article = array(
                    'title_picture' => $title_picture,
                );
                $this->m_article->editby($where_picture_article, $item_picture_article);

           }
        }

        $where_article = array(
            'slug' => $slug,
        );
        $item_article = array(
            'id_category' => $this->input->post('id_category'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'text' => $text,
            'author' => $_SESSION['email'],
            'status' => 'draft',
            'created_at' => $this->input->post('created_at'),
        );
        $update_article = $this->m_article->editby($where_article, $item_article);

        $itemLog = array(
            'page' => 'Article',
            'action' => 'update',
            'description' => $_SESSION['email'].' mengubah article dengan id = '.$update_article,
            'database' => 'articles',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->session->set_flashdata('status', 'Data article berhasil diubah!'); // Buat session flashdata
		redirect(base_url('article'));
   
    }

    public function upload_foto()
	{
        $name = md5(rand(100,200));
        $date = str_replace(' ', '', date('d m Y'));
        $title_picture = 'title_picture_'.$date.'_'.$name;

		$config['upload_path']          = './assets/images/summernote/';
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

    public function destroy($id)
    {
        $article = $this->m_article->getbyid($id);

        $itemLog = array(
            'page' => 'Article',
            'action' => 'delete',
            'description' => $_SESSION['email'].' menghapus article dengan judul = '.$article[0]->title,
            'database' => 'articles',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $this->m_article->delete($id);

        $this->session->set_flashdata('status', 'Data article berhasil dihapus!'); // Buat session flashdata
		redirect(base_url('article'));
    }
    
    
}