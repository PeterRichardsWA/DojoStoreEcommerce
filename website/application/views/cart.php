<html>
<head>
	<title>Shopping Cart</title>
	<style type="text/css">
		*{
			margin: 0px;
			padding: 0px;
		}
		#header{
			background-color: black;
			color:white;
			width:100%;
			height:50px;
			font-size: 36px;
			margin-bottom: 50px;
		}
		#header a{
			margin-left: 70%;
			color:white;
		}
		table{
			margin: 0 auto;
		}
		.quantity{
			width:50px;
		}
		#total{
			margin-left:50%;
			margin-top: 10px;
			margin-bottom: 100px;
			font-size: 24px;
		}
		th{
			width:50px;
			border-bottom: 1px solid black;
		}
		th, td{
			font-size: 24px;
			text-align: center;
		}
		form{
			margin-left: 50px;
		}
		p{
			margin: 20px;
		}
		.errors{
			color:red;
		}
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">
	// when the "same as shipping" box is checked, hide the form for billing info
	$('document').ready(function(){
		$('#check').click(function(){
			$('.duplicate').toggle('showOrHide');
		});
	});
	</script>
</head>
<body>
	<div id="header">
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
	</div>
<!-- 	cart displays correctly and allows for deleting items correctly. -->
<!-- need to add ability to update the quantities and have the page update with ajax-->
	<table>
		<tr>
			<th>Item</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
			<th>Remove Item</th>
		</tr>
		<?php 
		$total=0;
		foreach ($cartInfo as $item) {
			$subtotal=$item['price']*$item['quantity'];
			$total=$total+$subtotal;
			$id=$item['id'];
			$quantity=$item['quantity'];
			echo "<tr><td>".$item['name']."</td><td>$".$item['price']."</td><td><form action='/main/update/".$id."' method='post'><input type='number' name='quantity' class='quantity' value='".$quantity."'>"." "."<input type='submit' value='Update Quantity'></form></td><td>".$subtotal."</td><td><a href='/main/remove/".$id."'>X</a></td></tr>";
		}
		?>
	</table>
<!-- 	display the total below the cart -->
	<div id="total">
		<?php echo "<p>Total:$".$total."</p>"; ?>
		<a href="/main/delete"><button>Delete Cart</button></a>
		<a href="/"><button>Continue Shopping</button></a>
	</div>

	<?php echo "<div class='errors'>".$this->session->flashdata('errors')."</div>"; ?>
	<form action="/main/order" method="post">
		<h2>Shipping Information</h2>
		<p>First Name:<input type="text" name="ship_first"></p>
		<p>Last Name:<input type="text" name="ship_last"></p>
		<p>Address:<input type="text" name="ship_street1"></p>
		<p>Address 2:<input type="text" name="ship_street2"></p>
		<p>City:<input type="text" name="ship_city"></p>
		<p>State:<input type="text" name="ship_state"></p>
		<p>Zip Code:<input type="text" name="ship_zip"></p>
		<h2>Billing Information</h2>
		<input id="check" type="checkbox" name="same_info" value="same_info">Same As Shipping Address
	<!-- 	duplicate class gets hidden by jquery -->
		<p class="duplicate">First Name:<input type="text" name="bill_first"></p>
		<p class="duplicate">Last Name:<input type="text" name="bill_last"></p>
		<p class="duplicate">Address:<input type="text" name="bill_street1"></p>
		<p class="duplicate">Address 2:<input type="text" name="bill_street2"></p>
		<p class="duplicate">City:<input type="text" name="bill_city"></p>
		<p class="duplicate">State:<input type="text" name="bill_state"></p>
		<p class="duplicate">Zip Code:<input type="text" name="bill_zip"></p>
		<p>Card Number:<input type="text" name="bill_card"></p>
		<p>Security Code:<input type="text" name="bill_security"></p>
		<p>Expiration Date:<input type="month" name="bill_date"></p>
<!-- 	pass the total through the form to display on confirmation. -->
<!-- 	this could instead be calculated when the order is processed -->
		<input type="hidden" name="total" value='<?php echo $total; ?>' />
		<input type="submit" value="Pay">
	</form>
</body>
</html>