<?php
//
// MODEL for Cart Data while shopping. Kristy/Matt/Peter
// this will manage the entries for the cart as users shop through the site.
//
class CartData extends CI_model {
// model allows for methods to manipulate data: add/update/remove data
// to view the data is: one record, many records
//
// use session id to hold cart information. once cart times out after session ends,
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
public function get_data_id($id=0) {
// get one item from cart. Not sure why this is here?
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
public function update_data($id,$qty) {
// template
$query = 'UPDATE carts SET quantity = ? WHERE id = ?';
$values=array($qty,$id);
return $this->db->query($query,$values);
}
public function remove_data($id) {
// only put in title and desc since we are doing triggers for auto updates on timestamp and created
$query = 'DELETE FROM carts WHERE id = ?';
$values = array('id' => $id);
// doesn't return anything but a value to show it succeeded. if 0 then broke.
return $this->db->query($query, $values);
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
public function clear_cart(){
//deletes the entire cart
return $this->db->query('DELETE FROM carts');
}
}
?>