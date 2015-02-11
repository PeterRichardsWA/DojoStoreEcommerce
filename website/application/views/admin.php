<?php 		$this->load->view('adminheader');
?>


		<div class="container">
			<div class="row">
				<div class="col-sm-4" "col-sm-offset-2">
					<h1>Admin Login Page</h1>
				</div>
			</div>
<?php if (null !== ($this->session->flashdata('errors'))) {
?>		<div class="row">
			<div class="col-sm-10">
				<h1 style="color:red"><?= $this->session->flashdata('errors') ?></h1>
			</div>
		</div>
<?php }	
?>			<div class="row">
				<div class="col-sm-4 col-sm-offset-2">
					<form role="form" action="login" method="post">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control" name="email">
						</div>
						<div class="form-group">	
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<input class="btn btn-success" type="submit" value="log in">
					</form>
		</div>
		</div>
	</body>
</html>