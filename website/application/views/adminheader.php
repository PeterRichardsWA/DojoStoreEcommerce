<!doctype html>
<html>
<head>
	<title>Admin</title>
	<style>
	/*
		#adminnavbar .navbar-default {
		  background-color: #990000;
		  border-color: #ffffff;
		}
		.navbar-default .navbar-brand {
		  color: #ffffff;
		}
		.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
		  color: #ab3f44;
		}
		.navbar-default .navbar-text {
		  color: #ffffff;
		}
		.navbar-default .navbar-nav > li > a {
		  color: #ffffff;
		}
		.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
		  color: #990000;
		}
		.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
		  color: #990000;
		  background-color: #ffffff;
		}
		.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
		  color: #990000;
		  background-color: #ffffff;
		}
		.navbar-default .navbar-toggle {
		  border-color: #ffffff;
		}
		.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
		  background-color: #ffffff;
		}
		.navbar-default .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}

		.navbar-default .navbar-collapse,
		.navbar-default .navbar-form {
		  border-color: #ffffff;
		}
		.navbar-default .navbar-link {
		  color: #ffffff;
		}
		.navbar-default .navbar-link:hover {
		  color: #ab3f44;
		}

		@media (max-width: 767px) {
		  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
		    color: #ffffff;
		  }
		  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ab3f44;
		  }
		  .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ab3f44;
		    background-color: #ffffff;
		  } */
		body {
			padding-top:70px;
		}
		.bordered {
			border:1px solid black;
		}
		#orderinfotable div {
			padding:10px;
		}
		#statusbox, #totalpricebox  {
			margin-top:20px;
		}
		img {
			height:50px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

	<script>
	$(document).on('click', '.modaltrigger', function(){
		if($(this).attr('which')=="add") {
			$('#myModalLabel').html('Add Product');
		} else {
			$('#myModalLabel').html('Edit Product - ID ##ID##');
		}
	});
	</script>

</head>
<body>

<!-- if admin is logged in, show nav bar -->
<?php if(isset($adminid)) {
?>		<nav id="adminnavbar" class="nav navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<div class="navbar-brand">Dashboard</div>
					<ul class="nav navbar-nav">
						<li role="presentation"><a href="dashboard">Orders</a></li>
						<li role="presentation"><a href="adminproducts">Products</a></li>
					</ul>
					<div class="navbar-right navbar-nav"><a href="logooff">log off</a></div>
				</div>
			</div>
		</nav>

<?php	}
?>