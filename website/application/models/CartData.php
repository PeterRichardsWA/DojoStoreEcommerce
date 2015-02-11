<?php
//
// MODEL for Cart Data while shopping.  Kristy/Matt/Peter
// this will manage the entries for the cart as users shop through the site.
//
class CartData extends CI_model {

	// model allows for methods to manipulate data: add/update/remove data
	// to view the data is: one record, many records
	//
	// use session id to hold cart information.  once cart times out after session ends,
	// we need to clear the unused carts.
	//
	

	//
	// *******************************************************************
	// Get data files towards top of file as they will be used more than
	// write functions
	//
	public function get_all_data($cartid=0) {
		// get all data in the current cart
		return $this->db->query('SELECT * FROM carts LEFT JOIN products ON products.product=carts.name')->result_array();
	
	}

<<<<<<< HEAD
	public function get_data_id($id=0) {
=======
/*	public function get_data_id($id=0) {
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
		// get one item from cart.  Not sure why this is here?
		//Matt: This shouldn't be needed for anything, but I'll leave it for now.
		return $this->db->query('', array($id))->row_array();
	
	}

	//
	// *************************************************************************
	// functions that change data in the database
	//
	public function add_data($data) {

		// make this a generic insert by counting the number fields in the assoc array,
		// and then make a string of (?,?) for that number, and then create a NAMES section
		// for the fields to insert. --- might be security concern, so we'll have to be careful.
		//
		$myDate = date('Y-m-d H:m'); // make a valid date for create and update

		// only put in title and desc since we are doing triggers for auto updates on timestamp and created
		$query = '';
		// # values must match field count above.
		$values = array();

		// doesn't return anything but a true to show it succeeded. if 0 then broke.
		// NOT id of the entered item.
		$tmp = $this->db->query($query, $values);
		return $this->db->insert_id; // return id of record inserted. more useful.

	}

	public function update_data($id) {

		// template
		$query = 'UPDATE <table> SET fieldname = ?, field2 = ? WHERE id = ?';
	}

	public function remove_data($id) {
		// only put in title and desc since we are doing triggers for auto updates on timestamp and created
		
		$query = 'DELETE FROM carts WHERE id = ?';
		$values = array('id' => $id);

		// doesn't return anything but a value to show it succeeded. if 0 then broke.
		return $this->db->query($query, $values);

	}

	public function clear_cart(){
		//deletes the entire cart
		return $this->db->query('DELETE FROM carts');
<<<<<<< HEAD
	}
}
=======
	} */
} 
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
?>