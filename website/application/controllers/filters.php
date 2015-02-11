<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filters extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->output->enable_profiler();
	// }
	public function search() {
		
		// all search is partial match (perhaps do soundex search in future)
		//finds every product in the database containing the search term in any field
		
		$searchterm = $this->input->post('product');
		// sanitize the searchterm
		$searchterm = escape_this_string($searchterm);
		
		$results = $this->EcomData->get_from_db_by_keyword($searchterm);

		if($this->session->userdata('cartid')) {  // should we just use session_id for the cartid??
			$cartid = $this->session->userdata('cartid');
			$cartTotalItems = $this->CartData->cartTotal($cartid); // get total number of items based on current cart id
		
		} else {
			$cartid = 0;
			$cartTotalItems = 0;
		
		}
		
		// search term also gets categories that match as well. we can show the matching cats as well.
		$categories = $this->EcomData->get_select_category_info($searchterm);
		
		$values = array('productinfo' => $results, 'carttotal' => $cartTotalItems, 'categories' => $categories);
		// we don't need to pass count of $results as we can calculate on the fly easily during view.
		$this->load->view('landing',$values);
	}

}
//end of filters controller
