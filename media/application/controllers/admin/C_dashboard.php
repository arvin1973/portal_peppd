<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_article', 'm_article');
		$this->load->model('M_logPortal', 'm_logPortal');
	}

	public function dashboard()
	{
		if (isset($_SESSION['email']) != null) {

			$data['articles'] = $this->m_article->joinCategorieswhere1('status', 'publish');
			$data['log_portal'] = $this->m_logPortal->getlocation();

			$this->load->view('admin/include/V_header');
            $this->load->view('admin/include/V_navigation');
            $this->load->view('admin/include/V_sidebar');
			$this->load->view('admin/main/V_dashboard', $data);
            $this->load->view('admin/include/V_footer');
		
		}elseif (($_SESSION['email']) == null) {
			redirect(base_url('login'));
		}
	}
    
}