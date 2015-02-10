<?php 		$this->load->view('adminheader');
?>


		<div class="container">
			<div class="row" id="dashheader">
				<div class="col-sm-2"> <!-- search box -->
					<form role="form" action="adminordersearch" method="post">
						<div class="form-group">
							<input type="text" class="form-control" name="adminordersearch" placeholder="search">
						</div>
					</form>
				</div> <!-- search box -->
				<div class="col-sm-2 col-sm-offset-8"> <!-- dropdown -->
					<form role="form" action="adminorderfilter" method="post">
						<div class="form-group">
							  <select class="form-control" name="adminorderfilter">
				   				 <option value="showall">Show All</option>
								 <option value="inprocess">Order In Process</option>
								 <option value="shipped">Shipped</option>
							  </select>
						</div>
					</form>
				</div> <!--dropdown -->
			</div> <!-- dashheader -->
			<div class="row" id="dashbody">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Name</th>
							<th>Date</th>
							<th>Billing Address</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
<?php 					foreach($ordersindb as $row) {
	?>						<tr>
								<td><a href="showorder/<?= $row['id'] ?>"><?= $row['id'] ?></a></td>
								<td><?= $row['name'] ?></td>
								<td><?= $row['date'] ?></td>
								<td><?= $row['address'] ?></td>
								<td><?= $row['total'] ?></td>
								<TD>
									<!-- default value of order status needs to be set by jquery: .attr("selected","true") -->
									<form role="form" action="changeorderstatus" method="post">
										<div class="form-group">
								  			<select class="form-control" name="adminorderfilter" id="<?= $row['id'] ?>">
								   				 <option value="cancelled">Cancelled</option>
												 <option value="inprocess">Order In Process</option>
												 <option value="shipped">Shipped</option>
											</select>
										</div> 
									</form>
								</TD>
							</tr>
<?php 					} //foreach
?>					</tbody>
				</table>
			</div> <!-- dashbody -->
			<div class="row" id="dashpagination">
				<div class="col-sm-3 col-sm-offset-4">
			<!-- how many pages will be determined by db data -->
				 <ul class="pagination">
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">4</a></li>
				  <li><a href="#">5</a></li>
				</ul>
			</div>
			</div> <!-- dashpagination -->
		</div> <!-- container-->
	</body> 
</html>