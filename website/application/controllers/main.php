<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	// ALL MODELS ARE LOADED IN AUTOLOAD during config setup.

	// 	$this->output->enable_profiler();
	// 

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		// loads data for landing page - products, categories and cart totals data.
		$productInfo = $this->EcomData->get_all_products();	// return list of all products
		$categories = $this->EcomData->get_category_info(); // return list of all categories
		
		if($this->session->userdata('cartid')) {  // should we just use session_id for the cartid??
			$cartid = $this->session->userdata('cartid');
			$cartTotalItems = $this->CartData->cartTotal($cartid);
		} else {
			$cartid = 0;
			$cartTotalItems = 0;
		}
		 // get current cart info

		// by passing these record sets below, we don't have a way to traverse the list unless we use a associative array with a name for each of these.
		$values = array('productInfo'=>$productInfo,'cartItems' => $CartTotalItems, 'numproducts' => count($productInfo), 'categories' => $categories);
		$this->load->view('landing',$values);

	}

	public function showdetails($pid=0) {

		$results = $this->Ecomdata->get_data_id($pid);
		$this->load->view('product_info',array('data' => $results));

	}

	public function cartTotal($cartid=0)
	{
		// must pass cart id in to this function so that database knows which items to pull, and use
		// for calculation. 
		//this function calculates the cart info to be displayed in the header
		//Fully Functional
		$cartInfo = $this->CartData->get_all_data($cartid);
	//	$cartInfo=$this->CartData->get_all_data($cartid=0);
		$items=0;
		$total=0;
		foreach ($cartInfo as $item) {
			$items++;
			$total = $total+$item['price']*$item['quantity'];
		}
		return array('items'=>$items,'total'=>$total);
	}
	public function cart($cartid)
	{
		//load necessary information and display the Cart page
		//Fully Functional
		$cartInfo = $this->CartData->get_all_data($cartid);
		$cart = $this->cartTotal($cartid);
		$this->load->view('cart',array('cartInfo'=>$cartInfo,'cart'=>$cart));
	}
	public function info()
	{
		//Load the view for the Product Info page.
		$cart = $this->cartTotal($cartid);
		$this->load->view('productinfo',array('cart'=>$cart));
	}
	public function add(){
		//from Product Info page.  This will add an item to the cart, but not currently functional.
		$product = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
	}
	public function remove($id)
	{
		//deletes a single item from the cart.  
		//Fully functional.
		$this->load->CartData->remove_from_cart($id);
		redirect('/main/cart');
	}
	public function delete($cartid)
	{
		//deletes the entire cart.  
		//Fully Functional.
		$this->load->CartData->clear_cart($cartid);
		redirect('/');
	}
	public function order()
	{
		//when an order is placed, load the confirmation page.
		//Need to add form validation, Stripe API, and database interaction.
		$shipping=array('first'=>$this->input->post('ship_first'),
						'last'=>$this->input->post('ship_last'),
						'street1'=>$this->input->post('ship_street1'),
						'street2'=>$this->input->post('ship_street2'),
						'city'=>$this->input->post('ship_city'),
						'state'=>$this->input->post('ship_state'),
						'zip'=>$this->input->post('ship_zip')
						);
		if ($this->input->post('same_info')=='same_info'){
			$billing=$shipping;
		}
		else{
			$billing=array('first'=>$this->input->post('bill_first'),
							'last'=>$this->input->post('bill_last'),
							'street1'=>$this->input->post('bill_street1'),
							'street2'=>$this->input->post('bill_street2'),
							'city'=>$this->input->post('bill_city'),
							'state'=>$this->input->post('bill_state'),
							'zip'=>$this->input->post('bill_zip')
						);
		}
		$card=array('number'=>$this->input->post('bill_card'),
						'ccv'=>$this->input->post('bill_security'),
						'expiration'=>$this->input->post('bill_date')
						);
		$this->session->set_userdata('shipping',$shipping);
		$this->session->set_userdata('billing',$billing);
		$this->session->set_userdata('card',$card);
		$this->session->set_userdata('total',$this->input->post('total'));
		echo $this->input->post('total');
		echo $this->session->userdata('total');
		redirect('/main/confirmation');
	}
	public function confirmation(){
		//Loads the confirmation page and then resets all session data and clears the cart.
		//Fully Functional.
		$shipping=$this->session->userdata('shipping');
		$billing=$this->session->userdata('billing');
		$card=$this->session->userdata('card');
		$total=$this->session->userdata('total');
		unset($this->session->userdata);  // does this work or do we use destroy_session??
		$this->load->CartData->clear_cart($cartid);
		$this->load->view('confirmation',array('shipping'=>$shipping,'billing'=>$billing,'card'=>$card,'total'=>$total));
	}


	public function admin()
	{
		// show admin login
		$this->load->view('login');
	} 
}

//end of main controller
