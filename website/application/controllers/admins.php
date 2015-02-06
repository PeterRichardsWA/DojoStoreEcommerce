<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
//		$this->output->enable_profiler();
	}

	public function index() {
		$this->load->view('admin');
	}

	public function login() {
	//	$this->load->model('testDB');
	//	$this->testDB->get_all_orders();
		$this->dashboard();
	}

	public function dashboard() {
		$this->load->view('dashboard');
	}

	public function showorder($id) {
//		$order = $this->database->get_order_by_id($id);
		$this->load->view('showorder', array('order' => $order));
	}

	public function products() {
		$this->load->view('adminproductpage');
	}


}

//end of main controller