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

		//reloads the landing page with results as product info
		$categories = $this->EcomData->get_select_category_info($searchterm);
		$this->load->view('landing',array
			('productInfo'=>$results,/*'cart'=>$cart ,*/ 'numproducts' => count($results), 'categories' => $categories));
	}


	
}

//end of filters controller
