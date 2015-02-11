<?php
//
// MODEL for Ecommerce Site.  Kristy/Matt/Peter
//
class EcomData extends CI_model {

	//
	// *******************************************************************
	// Get data files towards top of file as they will be used more than
	// write functions
	//
	// 
	public function get_all_products() {
		// gets all products in database with their category and inventory.  order by: category, product title, and category active is true
		$query = 'SELECT products.pid, products.catid, categories.id, categories.active, categories.category, products.inventory, ';
		$query = $query.'products.price, products.taxable, products.product, products.description, photos.sort, photos.file_path, ';
		$query = $query.'photos.caption FROM categories LEFT OUTER JOIN products ON categories.id = products.catid ';
	 	$query = $query.'LEFT OUTER JOIN photos ON products.pid = photos.prod_id WHERE pid IS NOT NULL AND categories.active = 1 ';
	 	$query = $query.'ORDER BY category, product';

		return $this->db->query($query)->result_array(); // return ALL products organized by category, products and all photos.
	}

	public function get_category_info() {
		
		$query = 'SELECT categories.cid, categories.active, categories.category ';
		$query = $query.'FROM categories WHERE active=1 ORDER BY category';
	 
		return $this->db->query($query)->result_array(); // return ALL products organized by category, products and all photos.
	}

	// get an individual row of products from this productid.
	public function get_data_id($pid = 0) {
	
		$query = 'SELECT photos.main, photos.file_path, photos.caption, products.price, ';
		$query = $query.'products.taxable, products.product, products.description, products.inventory, categories.active, ';
		$query = $query.'categories.category, products.pid FROM categories RIGHT OUTER JOIN products ON categories.cid = products.catid ';
		$query = $query.'RIGHT OUTER JOIN photos ON products.pid = photos.prod_id ';
		$query = $query.'WHERE products.pid = ? AND price is not null ORDER BY photos.main DESC';
		// echo $query;
		// exit;
		return $this->db->query($query, array($pid))->result_array();  // array of this row!
	}

	// show all related products to this product id.
	public function get_related_prod($pid=0) {

		$query = 'SELECT products.catid, products.product, products.pid, pivot_related_prods.ref_prod_id ';
		$query = $query.'FROM pivot_related_prods LEFT OUTER JOIN products ON pivot_related_prods.rel_prod_id = products.pid ';
		$query = $query.'WHERE pivot_related_prods.ref_prod_id = ?';
		$values = array($pid);

		return $this->db->query($query, $values)->result_array(); // give us a result array back
	}

	// All related categories based on this products category id.
	public function get_related_cats($cid=0) {

		$query = 'SELECT pivot_related_cats.ref_category, categories.cid, categories.active, categories.category ';
		$query = $query.'FROM pivot_related_cats RIGHT OUTER JOIN categories ON pivot_related_cats.rel_category = categories.cid ';
		$query = $query.'WHERE pivot_related_cats.ref_category = ?';
		$values = array($id);

		return $this->db->query($query, $values)->result_array();  //give a result set back
	}
	//
	// *************************************************************************
	public function add_product($values) {
		// do we need this?  perhaps to update price, taxable product description, etc.
		$query = 'INSERT INTO products (catid, inventory, added_by, price, taxable, product, description, created_on, modified_on) ';
		$query = $query.'VALUES (?,?,?,?,?,?,?,now(),now())';
		$tmp = $this->db->query($query, $values);

		return $this->db->$insert_id; // passback the row id for this insertion
	}

	//
	// *************************************************************************
	public function update_product($id, $values) {
		// do we need this?  perhaps to update price, taxable product description, etc.
		$query = 'UPDATE products SET carid = ?, inventory = ?, add_by = ?, price = ?, taxable = ?, product = ?, description = ?, modified_on = now() WHERE pid = ?';
		
		// ****** we need to add the id onto the values before we execute
		$values = array($id); // push id of this record onto array for update.
		return $this->db->query($query, $values);
	}

	public function remove_data($id) {
		// only put in title and desc since we are doing triggers for auto updates on timestamp and created
		
		$query = 'DELETE FROM products WHERE pid = ?';
		$values = array('id' => $id);

		// doesn't return anything but a value to show it succeeded. if 0 then broke.
		return $this->db->query($query, $values);

	}

}
?>