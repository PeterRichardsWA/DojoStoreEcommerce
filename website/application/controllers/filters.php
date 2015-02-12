<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filters extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->output->enable_profiler();
	// }

	public function search($first=0) {
		//finds every product in the database containing the search term in any field
		if (!empty($this->session->flashdata('searchterm'))) 
			$searchterm = $this->session->flashdata('searchterm');
		else
			$searchterm = $this->input->post('product');
		
		$this->session->set_flashdata('searchterm', $searchterm);
		$this->load->model('EcomData');
		$return = $this->EcomData->get_from_db_by_keyword($searchterm);

		for($i = 0+$first; $i < 15 + $first; $i++) {
			if(isset($return[$i]))
				$results[] = $return[$i];
		} 
		//prepares pagination
		$this->load->library('pagination');
		$config['base_url'] = 'filters/search/';
		$config['total_rows'] = count($return);
		$config['per_page'] = 15;

		$this->pagination->initialize($config);
		//reloads the landing page with results as product info
		$categories = $this->EcomData->get_select_category_info($searchterm);
		echo json_encode(array("results"=>$results,"categories"=>$categories, "links" =>$this->pagination->create_links()));
	}
}


//end of filters controller
