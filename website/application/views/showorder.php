<?php 		$this->load->view('adminheader');
?>

		<div class="container">
			<div class="row">
				<div class="col-sm-3 bordered" id="orderinfotable">
					<div class="row">
						<p>Order ID:<?= $order['id'] ?></p>
					</div>
					<div class="row">
						<p>Customer Shipping Info:</p>
					</div>
					<div class="row">
						<p>Name:<?= $order['ship_name'] ?></p>
						<p>Address: <?= $order['ship_addr'] ?></p>
						<p>City: <?= $order['ship_city'] ?></p>
						<p>State:<?= $order['ship_state'] ?></p>
						<p>Zip:<?= $order['ship_zip'] ?></p>
					</div>
					<div class="row">
						<p>Customer Billing Info:</p>
					</div>
					<div class="row">
						<p>Name:<?= $order['bill_name'] ?></p>
						<p>Address: <?= $order['bill_addr'] ?></p>
						<p>City: <?= $order['bill_city'] ?></p>
						<p>State:<?= $order['bill_state'] ?></p>
						<p>Zip:<?= $order['bill_zip'] ?></p>
					</div>
				</div>
				<div class="col-sm-8 col-sm-offset-1">
					<div class="row bordered">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Item</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									</tr>
							</thead>
							<tbody>
<?php 							foreach ($order['items'] as $item) {
?>								<tr>
									<TD><?= $item['id'] ?></TD>
	 								<TD><?= $item['name'] ?></TD>
	 								<TD>$<?= $item['price'] ?></TD>
	 								<TD><?= $item['quantity'] ?></TD>
	 								<TD>$<?= $item['price']*$item['quantity'] ?></TD>
	 							</tr>
<?php 							}
?>							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-sm-5 bordered" id="statusbox">
							<!-- use jquery to set background color basen on status. -->
							<h2>Status: <?= $order['status'] ?></h2>
						</div>
						<div class="col-sm-2">
						</div>
						<div class="col-sm-5 bordered" id="totalpricebox">
							<h3>Subtotal: $ <?= $subtotal ?></h3>
							<h3>Shipping: $Where do we get this from? <?= $shipping ?></h3>
							<h3>Total Price: $<?= $subtotal + $shipping ?></h3>
						</div>
					</div>
				</div>
			</div>
				
		</div> <!-- container-->
	</body> 
</html>