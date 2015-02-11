<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
//		$this->output->enable_profiler();
	}

	public function index() {
		// if admin is logged in, take them to the dash, otherwise, to the login screen
		if (isset($this->session->adminid)) 
			$this->dashboard();
		else
			$this->login();
	}

	public function login() {
	/*	$this->load->model('mydb'); 
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		//checks info against db
		$check = $this->mydb->get_admin_by_email($email); 
		if($check && ($check['password']==$password)) {
			//good info: log in
			$this->dashboard();
		} else {
			//bad info: bounce back with an error message.
			$this->session->set_flashdata('errors', "Credentials don't match. Try again.");
			$this->load->view('admin'); */
			$this->dashboard();
		 
	}

	public function logoff() {
		//destroy session data
		$this->session->sess_destroy();
		//redirect to login page
		$this->index();
	}

	public function dashboard() {
		$this->load->model('EcomData');
		$adminid = $this->session->userdata('adminid');
		$ordersindb = $this->EcomData->get_all_orders();
		$numresults = count($ordersindb);
		//calculate total of order and add it to the data
		$totalarray = [];
		foreach ($ordersindb as $order) {
			$total = $this->EcomData->get_order_total($order['oid']);
			$totalarray[$order['oid']] = $total;
		}
		$this->load->view('dashboard', array('adminid' => $adminid, "ordersindb" => $ordersindb, 'numresults' => $numresults, 'totalarray' => $totalarray));
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