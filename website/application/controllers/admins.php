<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
//		$this->output->enable_profiler();
	}

	public function index() {
		// if admin is logged in, take them to the dash, otherwise show login screen
		if (isset($this->session->adminid)) 
			$this->dashboard();
		else
			$this->load->view('admin');
	}

	public function login() {
		//placeholder until we make actual admin logins
		$this->session->set_userdata('adminid', "Kristy");
	//	$this->load->model('testDB');
	//	$this->testDB->get_all_orders();
		$this->dashboard();
	}

	public function logoff() {
		//destroy session data
		$this->session->sess_destroy();
		//redirect to login page
		$this->index();
	}

	public function dashboard() {
		$adminid = $this->session->userdata('adminid');
		$this->load->view('dashboard', array('adminid' => $adminid));
	}

	public function showorder($id) {
	//	$order = $this->post->get_order_by_id($id);
		$this->load->view('showorder', array('order' => $order, 'adminid' => $this->session->userdata('adminid')));
	}

	public function products() {
		$this->load->view('adminproductpage', array('adminid' => $this->session->userdata('adminid')));
	}


}

//end of main controller