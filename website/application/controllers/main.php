<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->output->enable_profiler();
	// }

	public function index()
	{
		$cart=$this->cartTotal();
		// product info will be obtained through a query.  Set to 0 for now to not error out.
		$productInfo=0;
		$this->load->view('landing',array('productInfo'=>$productInfo,'cart'=>$cart));
	}
	public function cartTotal()
	{
		//this function calculates the cart info to be displayed in the header
		//Fully Functional
		$this->load->model('CartData');
		$cartInfo=$this->CartData->get_all_data($cartid=0);
		$items=0;
		$total=0;
		foreach ($cartInfo as $item) {
			$items++;
			$total=$total+$item['price']*$item['quantity'];
		}
		return array('items'=>$items,'total'=>$total);
	}
	public function cart()
	{
		//load necessary information and display the Cart page
		//Fully Functional
		$this->load->model('CartData');
		$cartInfo=$this->CartData->get_all_data($cartid=0);
		$cart=$this->cartTotal();
		$this->load->view('cart',array('cartInfo'=>$cartInfo,'cart'=>$cart));
	}
	public function info()
	{
		//Load the view for the Product Info page.
		$cart=$this->cartTotal();
		$this->load->view('productinfo',array('cart'=>$cart));
	}
	public function add(){
		//from Product Info page.  This will add an item to the cart, but not currently functional.
		$product=$this->input->post('product_id');
		$quantity=$this->input->post('quantity');
	}
	public function remove($id)
	{
		//deletes a single item from the cart.  
		//Fully functional.
		$this->load->model('CartData');
		$this->CartData->remove_data($id);
		redirect('/main/cart');
	}
	public function delete()
	{
		//deletes the entire cart.  
		//Fully Functional.
		$this->load->model('CartData');
		$this->CartData->clear_cart();
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
		unset($this->session->userdata);
		$this->load->model('CartData');
		$this->CartData->clear_cart();
		$this->load->view('confirmation',array('shipping'=>$shipping,'billing'=>$billing,'card'=>$card,'total'=>$total));
	}
}

