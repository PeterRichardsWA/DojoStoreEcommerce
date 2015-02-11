<?php
//
// MODEL for Cart Data while shopping.  Kristy/Matt/Peter
// this will manage the entries for the cart as users shop through the site.
//
class CartData extends CI_model {

	// model allows for methods to manipulate data: add/update/remove data
	// to view the data is: one record, many records
	//
	// *******************************************************************
	// Get data files towards top of file as they will be used more than
	// write functions
	//
	public function get_all_data($cartid=0) {
		// get all data in the current cart
		return $this->db->query('')->result_array();
	
	}

	public function get_data_id($id=0) {
		// get one item from cart.  Not sure why this is here?
		return $this->db->query('', array($id))->row_array();
	
	}

	// gets number of items in the cart through db
	public function get_cart_total($id=0) {
		$query = "SELECT COUNT(oid) AS numitems FROM orders WHERE oid = ?";
		$values = array($id);
		// numitems is returned in this row_array
		return $this->db->query('', array($id))->row_array();
	}
	
	// functions that change data in the database
	//
	// creates the blank order if it doesn't exist. Later we add items to cart.
	//
	public function create_order($data) {

		// this creates a blank order inserting session id into the database for the cart,
		// so we can tie to this in the future.
		$session_id = $this->session->userdata('session_id');
		
		if($session_id) {
			$myDate = date('Y-m-d H:m'); // make a valid date for create and update

			// create the order, passing back the ID of the newly inserted item, then store in session for
			// shopping.
			$query = 'INSERT INTO orders (sessid,status,created_on,modified_on) VALUES (?,?,now(),now())';
			// # values must match field count above.
			$values = array($session_id,0,$myDate,$myDate);

			$tmp = $this->db->query($query, $values);
		
		} else {
			die('no session!!! cannot create cart.');
		}

		return $this->db->insert_id; // return id of record inserted. more useful.

	}

	public function add_to_cart($cartid=0, $prodid=0, $qty=0) {
		
		// first check to see if item exists in cart already. if so, than just add to qty
		// otherwise create a new entry in cart for this prodid.
		
		$query = "SELECT * FROM pivot_order-products WHERE order_id = ? AND product_id = ?";			
		$values = array($cartid,$prodid);
		$results = $this->db->query($query,$values);

		if($results) {
			$total = $results('quantity') + $qty;
			$query = "UPDATE pivot_order-products SET quantity = ?, SET modified_on = NOW() WHERE order_id = ? AND product_id = ?";
			$values = array($total, $cartid, $prodid);

		} else {
			$query = "INSERT INTO pivot_order-products (order_id,product_id,quantity,created_on,modified_on) VALUES ";
			$query = "(?,?,?,NOW(),NOW())";
			$values = array($cartid, $prodid, $qty);

		}
		return $this->db->query($query, $values);
	}

	// update items in cart. if qty = 0, then remove ALL
	public function remove_from_cart($qty=0, $oid=0, $proid=0) {
		if($qty) {
			$query = "UPDATE pivot_order-products SET quantity = ? WHERE order_id = ? AND product_id = ?";
			$values = array($qty,$oid,$prodid);
		
		} else {
			$query = "DELETE FROM pivot_order-products WHERE order_id = ? AND product_id = ?";
			$values = array($oid,$prodid);

		}
		return $this->db->query($query,$values);
	}

	public function clear_cart($cartid=0) {
		$query = "DELETE FROM pivot_order-products WHERE order_id = ?";
		$values = array($cartid);
		return $this->db->query($query,$values);

	}
}
?>