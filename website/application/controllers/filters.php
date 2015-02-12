<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Filters extends CI_Controller {
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->output->enable_profiler();
	// }
	public function search() {
		//finds every product in the database containing the search term in any field
		$searchterm = $this->input->post('product');
		$this->load->model('EcomData');
		$results = $this->EcomData->get_from_db_by_keyword($searchterm);
		//prepares pagination
		$this->load->library('pagination');
		$config['base_url'] = 'localhost/filters/search/';
		$config['total_rows'] = count($results);
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		//reloads the landing page with results as product info
		$categories = $this->EcomData->get_select_category_info($searchterm);
		echo json_encode(array("results"=>$results,"categories"=>$categories, "links" =>$this->pagination->create_links()));
	}

	public function sortprodbyprice() {
		$this->load->model('EcomData');
		$results=$this->EcomData->get_all_products_by_price();
		$this->load->library('pagination');
		$config['base_url'] = 'localhost/filters/search/';
		$config['total_rows'] = count($results);
		$config['per_page'] = 15;
		$this->pagination->initialize($config);
		echo json_encode(array("results"=>$results,"links" =>$this->pagination->create_links()));
	}
}
//end of filters controller
