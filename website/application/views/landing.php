<html>
<head>
<<<<<<< HEAD
=======
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
	<title>Products</title>
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
		#sidebar, #content{
			display: inline-block;
			vertical-align: top;
			border: 1px solid black;
		}
		#sidebar{
			padding:20px;
		}
		#sidebar li{
			margin: 10px;
			margin-left: 30px;
		}
		#content{
			margin-left: 50px;
			width:70%;
			padding: 20px;
		}
		#nav{
			margin-left: 85%
		}
<<<<<<< HEAD
		td{
			border: 1px solid black;
			height:250px;
			width:250px;
			padding:120px;
=======


		.cell {
			border: 1px solid black;
			height:150px;
			width:150px;
			margin:15px;
			display: inline-block;
		}

		.cell img {
			width:150px;
			height:150px;
			margin:0px;
		}

		.infobanner {
			border:1px solid black;
			height:36px;
			margin-top:-36px;
			background-color:#bbbbbb;
			opacity: 0.7;
		}

		.infocell {
			display: inline-block;
			width:45%;
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
		}
	</style>
</head>
<body>
	<div id="header">
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
<<<<<<< HEAD
=======
<!-- df1bb20cfee300205e1736a7652a2dd62f0c0da8 -->
		<a href="/main/cart">View Cart</a>
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
	</div>
	<div id="sidebar">
		<form id="search" action="/main/search">
			<input type="text" name="product">
			<input type="submit" value="Search">
		</form>
		<h4>Categories:</h4>
		<ul>
			<li><a href='#'>All Products</a></li>
<<<<<<< HEAD
			<?php 		foreach ($productcategories as $category) {
?>			<li><a href='#'>$categoryname (#)</a></li>
=======
<?php 		foreach ($productcategories as $category) {
?> 			<li><a href='#'>$categoryname (#)</a></li>
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
<?php 		}
?> 
		</ul>
	</div>
	<div id="content">
		<h2>Products (Page $)</h2>
		<div id="nav">
		<a href="#">Prev</a>
		<a href="#">Next</a>
		<form action="/main/sort" method="post">
			<p>Sort By:<select><option>Price</option><option>Most Popular</option></select></p>
		</form>
		</div>
<<<<<<< HEAD
		<?php 	$this->load->view('productdisplay');
?>	
=======
<?php 	$this->load->view('productdisplay');
?>		
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
		<?php 
			$pages=floor(count($productInfo)/15)+1;
			for($i=1;$i<=$pages;$i++){
				echo "<a href='/main/page/".$i."'>".$i."</a>";
			}
		?>		

	</div>
<<<<<<< HEAD
=======
	<div id="footer">
		<a href="/main/admin">Admin Login</a>
	</div>
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
</body>
</html>