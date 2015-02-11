<!doctype html>
<html>
<head>
	<title>Admin</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<style>

		.navbar-default, nav li{
			background-color: #990000;
			background-image:none;
			color:#ffffff;
		}
		.navbar-default .navbar-nav>li>a, .navbar-default .navbar-brand {
			color:#ffffff;
		}

		.navbar-default a {
			color:#ffffff;
		}
		body {
			padding-top:70px;
		}
		.bordered {
			border:1px solid black;
		}
		.navbar-right {
			padding-top:15px;
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
		echo $adminid; 
?>		<nav id="adminnavbar" class="nav navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="nav navbar-header">
					<div class="navbar-brand">Dashboard
					</div>
				</div>
				<div class="nav navbar-nav">
					<ul class="nav navbar-nav">
						<li><a href="/dashboard">Orders</a></li>
						<li><a href="/adminproducts">Products</a></li>
					</ul>
				</div>
				<div class="nav navbar-right navbar-nav"><a href="/logoff">log off</a>
				</div>
			</div>
		</nav>

<?php	}
?>