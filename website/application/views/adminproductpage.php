<?php 		$this->load->view('adminheader');
?>


		<div class="container">
			<div class="row" id="dashheader">
				<div class="col-sm-6"> <!-- search box -->
					<form role="form" action="adminproductsearch" method="post">
						<div class="form-group">
							<input type="text" name="adminproductsearch"  class="form-control" placeholder="search">
						</div>
					</form>
				</div> <!-- search box -->
				<div class="col-sm-2 col-sm-offset-8"> <!-- add new product button -->
					<button type="button" class="btn btn-primary modaltrigger" data-toggle="modal" data-target="#editproduct" which="add">Add New Product</button>
				</div> <!--dropdown -->
			</div> <!-- dashheader -->
			<div class="row" id="dashbody">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Picture</th>
							<th>Product ID</th>
							<th>Name</th>
							<th>Inventory Count</th>
							<th>Quantity Sold</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php 		//			foreach($productsindb as $row) {
	?>						<tr>
								<TD><img src="#"></TD>
								<td><?= $row['id'] ?></td>
								<td><?= $row['name'] ?></td>
								<td><?= $row['inventory'] ?></td>
								<td><?= $row['totalqtysold'] ?></td>
								<td><a href="addproduct" class="modaltrigger" data-toggle="modal" data-target="#editproduct" which="edit">edit</a> <a href="deleteproduct">delete</a></td>
							</tr>
<?php 	//				} //foreach
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

<div class="modal fade" id="editproduct" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            					<h4 class="modal-title" id="myModalLabel"><!--supplied by jquery --></h4>
            				</div>
            				<div class="modal-body">
<?php 							$this->load->view('editproduct');
?>            				</div>
            				<div class="modal-footer">
            					  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                					<button type="button" class="btn btn-success" id="previewproduct">Preview</button>
                					<button type="submit" class="btn btn-primary">Save changes</button>
                				</form>
								</div>
        					</div>
						</div>
					</div>
				</div>

	</body> 
</html>