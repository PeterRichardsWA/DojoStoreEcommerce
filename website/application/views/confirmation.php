<html>
<head>
	<title>Order Confirmation</title>
</head>
<body>
<!-- this page simply displays the information that was entered in the order form. -->
<!-- Does not require any further processing or database interaction -->
	<h1>Thank you for your order!</h1>
	<h2>Shipping Address</h2>
	<?php 
		echo "<p>First Name: ".$shipping['first']."</p>
			<p>Last Name: ".$shipping['last']."</p>
			<p>Street Address: ".$shipping['street1']." ".$shipping['street2']."</p>
			<p>City: ".$shipping['city']."</p>
			<p>State: ".$shipping['state']."</p>
			<p>Zip Code: ".$shipping['zip']."</p>";
	?>
	<h2>Billing Address</h2>
	<?php 
		echo "<p>First Name: ".$billing['first']."</p>
			<p>Last Name: ".$billing['last']."</p>
			<p>Street Address: ".$billing['street1']." ".$billing['street2']."</p>
			<p>City: ".$billing['city']."</p>
			<p>State: ".$billing['state']."</p>
			<p>Zip Code: ".$billing['zip']."</p>";
	?>
	<h2>Credit Card Information</h2>
	<?php 
		echo "<p>Card Number: ".$card['number']."</p>
			<p>Expiration Date: ".$card['expiration']."</p>
			<p>Total:".$total."</p>";
	?>
	<a href="/"><button>Back to Home</button></a>
</body>
</html>