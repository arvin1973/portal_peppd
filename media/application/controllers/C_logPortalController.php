<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_logPortalController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_logPortal', 'm_logPortal');
	}
    
    public function store()
    {
        // $data['token'] = $this->security->get_csrf_hash();

        $action = $this->input->post('action');
        $ip = $_SERVER['REMOTE_ADDR'];

        $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
        $location = $getloc->city;
	    
	    $item = array(
	            'action' => $action,
                'location' => $location,
                'ip' => $ip,
	        );
	    $LogPortal = $this->m_logPortal->add($item); 

        return $LogPortal;
    }

	
}