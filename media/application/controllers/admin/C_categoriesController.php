<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_categoriesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('M_category', 'm_category');
        $this->load->model('M_log', 'm_log');
	}

	public function index()
	{
        $list_categories = $this->m_category->getall();

        echo json_encode($list_categories);
	}
    
    public function store()
    {
        $item_category = array(
            'name' => $this->input->post('name'),
            'slug' => str_replace($this->input->post('name'), ' ', '-'),
        );

        $category = $this->m_category->add($item_category);

        $show_category = $this->m_category->getbyid($category);

        $itemLog = array(
            'page' => '-',
            'action' => 'create',
            'description' => $_SESSION['email'].' menambahkan category dengan id = '.$category,
            'database' => 'categories',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        echo json_encode($show_category);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $item_category = array(
            'name' => $this->input->post('name'),
            'slug' => str_replace($this->input->post('name'), ' ', '-'),
        );

        $category = $this->m_category->edit($id, $item_category);

        $show_category = $this->m_category->getbyid($id);

        if($category == true){

            $itemLog = array(
                'page' => '-',
                'action' => 'update',
                'description' => $_SESSION['email'].' mengubah category dengan id = '.$show_category[0]->id,
                'database' => 'categories',
                'author' => $_SESSION['email'],
            );
            $this->m_log->add($itemLog);

        }

        echo json_encode($show_category);
    }

    public function destroy()
    {
        $show_category = $this->m_category->getbyid($this->input->post('id'));

        $itemLog = array(
            'page' => '-',
            'action' => 'delete',
            'description' => $_SESSION['email'].' menghapus category dengan nama = '.$show_category[0]->name,
            'database' => 'categories',
            'author' => $_SESSION['email'],
        );
        $this->m_log->add($itemLog);

        $delete_category = $this->m_category->delete($this->input->post('id'));

        echo $delete_category;

    }
    
}