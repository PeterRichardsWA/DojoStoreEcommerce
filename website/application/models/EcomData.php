<?php
//
// MODEL for Ecommerce Site.  Kristy/Matt/Peter
//
class EcomData extends CI_model {

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
	public function get_all_data() {
		return $this->db->query('SELECT * FROM posts ORDER BY created_at DESC')->result_array();
	
	}

	public function get_all_product_info() {
		return $this->db->query('SELECT * FROM products LEFT JOIN photos ON products.pid = photos.prod_id ORDER BY products.created_on DESC')->result_array();
	
	}

	public function get_data_id($id) {
		return $this->db->query('SELECT * FROM posts WHERE id = ?', array($id))->row_array();
	
	}

	public function get_category_info() {
		return $this->db->query('SELECT count(*), category FROM products 
			JOIN categories ON products.catid = categories.id GROUP BY categories.id')->result_array();
	}

	public function get_select_category_info($keyword) {
		$keyword = "%$keyword%";	
		return $this->db->query("SELECT count(*), category FROM products 
		JOIN photos on photos.prod_id = products.pid 
		JOIN categories ON products.catid = categories.id 
		WHERE products.description LIKE ? OR products.product LIKE ?
		OR categories.category LIKE ? OR photos.caption LIKE ? OR photos.file_path LIKE ? 
		GROUP BY categories.id", 
		array($keyword, $keyword, $keyword, $keyword, $keyword))->result_array();
	}

	public function get_from_db_by_keyword($keyword) {
		$keyword = "%$keyword%";	
		return $this->db->query("SELECT * FROM products 
		JOIN photos on photos.prod_id = products.pid 
		JOIN categories ON products.catid = categories.id 
		WHERE products.description LIKE ? OR products.product LIKE ?
		OR categories.category LIKE ? OR photos.caption LIKE ? OR photos.file_path LIKE ?", 
		array($keyword, $keyword, $keyword, $keyword, $keyword))->result_array();
	}

	public function get_all_orders() {
		return $this->db->query('SELECT *  FROM orders 
			JOIN pivot_order_products on order_id = orders.oid
			JOIN products on pivot_order_products.product_id = products.pid
			GROUP BY orders.oid
			ORDER BY orders.created_at DESC')->result_array();
	}

	public function get_order_total($oid) {
		$total = 0;
		$results = $this->db->query("Select quantity, price from orders
			join pivot_order_products on order_id = orders.oid
 			join products on products.pid = pivot_order_products.product_id
			where orders.oid = ?", $oid)->result_array();
		foreach ($results as $result) {
			$total += $result['price'] * $result['quantity'];
		}
		return $total;
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
		$query = 'INSERT INTO posts (?,created_at,modified_at) VALUES (?,NOW(),NOW())';
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
		
		$query = 'DELETE FROM <table> WHERE id = ?';
		$values = array('id' => $id);

		// doesn't return anything but a value to show it succeeded. if 0 then broke.
		return $this->db->query($query, $values);

	}

}
?>