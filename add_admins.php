<?php

require_once('new-connection.php');

// temporary too to create encrypted passwords for the admins
function AddToDatabase($salt,$fname,$lname,$email,$pass) {
	
	$e_password = crypt($salt,$pass);
	$e_email = crypt($salt,$email);

	$query = "INSERT INTO admins (first_name, last_name, email, password, created_on, modified_on) ";
	$query = $query."VALUES ('".$fname."','".$lname."','".$e_email."','".$e_password."',NOW(),NOW() )";
	// echo $query;
	// die('here');

	run_mysql_query($query);
}

echo "STARTING TO ADD....";

$salt = bin2hex(openssl_random_pseudo_bytes(22));

$password = '12345';
$first_name = 'Matt';
$last_name = 'McCullough';
$email = 'mlmcc@umich.edu';

AddToDatabase($salt, $first_name, $last_name, $email, $password);

$password = '12345';
$first_name = 'Kristy';
$last_name = 'Overton';
$email = 'kristy.g.overton@gmail.com';

AddToDatabase($salt, $first_name, $last_name, $email, $password);

$password = '12345';
$first_name = 'Peter';
$last_name = 'Richards';
$email = 'the.peter.richards@gmail.com';

AddToDatabase($salt, $first_name, $last_name, $email, $password);

echo "<p>DONE!";

?>