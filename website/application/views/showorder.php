<?php 		$this->load->view('adminheader');
?>

		<div class="container">
			<div class="row">
				<div class="col-sm-3 bordered" id="orderinfotable">
					<div class="row">
						<p>Order ID:<?= $order[0]['oid'] ?></p>
					</div>
					<div class="row">
						<p>Customer Shipping Info:</p>
					</div>
					<div class="row">
						<p>Name:<?= $order[0]['ship_name'] ?></p>
						<p>Address: <?= $order[0]['ship_street']." ".$order[0]['ship_street2'] ?>
						<p>City: <?= $order[0]['ship_city'] ?></p>
						<p>State:<?= $order[0]['ship_state'] ?></p>
						<p>Zip:<?= $order[0]['ship_zip'] ?></p>
					</div>
					<div class="row">
						<p>Customer Billing Info:</p>
					</div>
					<div class="row">
						<p>Name:<?= $order[0]['bill_name'] ?></p>
						<p>Address: <?= $order[0]['bill_street']. " ".$order[0]['bill_street2'] ?></p>
						<p>City: <?= $order[0]['bill_city'] ?></p>
						<p>State:<?= $order[0]['bill_state'] ?></p>
						<p>Zip:<?= $order[0]['bill_zip'] ?></p>
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
<?php 							foreach ($order as $item) {
?>								<tr>
									<TD><?= $item['pid'] ?></TD>
	 								<TD><?= $item['product'] ?></TD>
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
							<h2>Status: <?= $order[0]['status'] ?></h2>
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