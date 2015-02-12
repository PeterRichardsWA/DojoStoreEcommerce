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
		$cart=$this->cartTotal();
		$categories = $this->EcomData->get_category_info();
		$cart=$this->cartTotal();
		$this->load->view('landing',array('productInfo'=>$productInfo,'cart'=>$cart, 'numproducts' => count($productInfo), 'categories' => $categories));

	}
	public function cartTotal()
	{
		//this function calculates the cart info to be displayed in the header
		//Fully Functional
		$this->load->model('CartData');
		$cartInfo=$this->CartData->get_all_data();
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
	public function productinfogpg($id) {
		$data = $this->EcomData->get_product_by_id($id);
		$cart=$this->cartTotal();
		$this->load->view('product_info',array('cart'=>$cart,'data'=>$data));
	}
	public function add(){
		$product=$this->input->post('product');
		$qty=$this->input->post('qty');
		$this->load->model('CartData');
		$this->CartData->add_to_cart($product,$qty);
		redirect('/main/cart');
	}
	public function update($id)
	{
		//updates the quantity in the cart
		//Fully functional.
		$qty=$this->input->post('quantity');
		$this->load->model('CartData');
		$this->CartData->update_data($id,$qty);
		redirect('/main/cart');
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
		//Need to add Stripe API and database interaction.
			//validation the order form before doing any data processing
			$this->validation();
			$this->load->model('EcomData');
			$this->load->model('CartData');
			$cart=$this->CartData->get_all_data();
			//address information goes into the "orders" table
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
			//function to add address informatino to database
			$this->EcomData->add_order($shipping);
			//get the order id of the order that got added
			$oid=$this->EcomData->get_order_id();
			//add the ordered products to the pivot table
			echo $oid;
			foreach ($cart as $item) {
				$qty=$item['quantity'];
				$pid=$item['pid'];
				$this->EcomData->populate_order($oid,$pid,$qty);
			}
			//No card verification or stripe API added yet
			$card=array('number'=>$this->input->post('bill_card'),
							'ccv'=>$this->input->post('bill_security'),
							'expiration'=>$this->input->post('bill_date')
							);
			//session data created for confirmation page
			$this->session->set_userdata('shipping',$shipping);
			$this->session->set_userdata('billing',$billing);
			$this->session->set_userdata('card',$card);
			$this->session->set_userdata('total',$this->input->post('total'));
			redirect('/main/confirmation');
		}

	public function validation()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ship_first','First Name','trim|required|alpha');
		$this->form_validation->set_rules('ship_last','Last Name','trim|required|alpha');
		$this->form_validation->set_rules('ship_street1','Street Address','trim|required');
		$this->form_validation->set_rules('ship_city','City','trim|required');
		$this->form_validation->set_rules('bill_card','Card Number','trim|required|exact_length[16]|numeric');
		$this->form_validation->set_rules('ship_zip','Shipping Zip Code','trim|required|exact_length[5]|numeric');
		$this->form_validation->set_rules('bill_security','CCV','trim|required|exact_length[3]|numeric');
		if($this->form_validation->run()===FALSE){
			$this->session->set_flashdata('errors',validation_errors());
			redirect('/main/cart');
		}
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