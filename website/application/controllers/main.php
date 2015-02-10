<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->output->enable_profiler();
	// }

	public function index()
	{
		$this->load->model('EcomData');
		$productInfo = $this->EcomData->get_all_product_info();	
		$this->load->view('landing',array('productInfo'=>$productInfo));
	}
	public function cart()
	{
		$this->load->view('cart',array('cartInfo'=>$cartInfo));
	}
	public function info()
	{
		$this->load->view('productinfo');
	}
	public function admin()
	{
		$this->load->view('login');
	}
}

//end of main controller