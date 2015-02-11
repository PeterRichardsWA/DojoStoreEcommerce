<?php
//
// MODEL for userData DB.  Kristy/Matt/Peter
//
class userData extends CI_model {

	// admin functions.  get data to login.
	// set last_login date.
	public function get_admin($uEmail,$uPassword) {
		return $this->db->query('SELECT * FROM admins WHERE email = ? AND password = ?', array($id))->row_array();
	}
	
	public function update_login($id) {
		$this->db->query('UPDATE admins SET last_login = now() WHERE aid = ?');
		return;
	}
}
?>