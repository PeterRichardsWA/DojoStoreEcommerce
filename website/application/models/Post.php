<?php
// my model for courses.

class Post extends CI_model {

	public function get_all_data() {
		return $this->db->query('SELECT * FROM posts ORDER BY created_at DESC')->result_array();
	}

	public function get_data_id($id) {
		return $this->db->query('SELECT * FROM posts WHERE id = ?', array($id))->row_array();
	}

	public function add_data($post) {
		
		$myDate = date('Y-m-d H:m'); // this is returning the date from tomorrow.  WTF!??
		// echo $myDate;
		// exit;

		// only put in title and desc since we are doing triggers for auto updates on timestamp and created
		$query = 'INSERT INTO posts (description,created_at,modified_at) VALUES (?,NOW(),NOW())';
		// # values must match field count above.
		$values = array($post['description']);

		// doesn't return anything but a true to show it succeeded. if 0 then broke.
		// NOT id of the entered item.
		$tmp = $this->db->query($query, $values);
		return $this->db->insert_id; // return id of record inserted. more useful.
	}

	public function remove_data($id) {
		// only put in title and desc since we are doing triggers for auto updates on timestamp and created
		
		$query = 'DELETE FROM posts WHERE id = ?';
		$values = array('id' => $id);

		// doesn't return anything but a value to show it succeeded. if 0 then broke.
		return $this->db->query($query, $values);
	}

}
?>