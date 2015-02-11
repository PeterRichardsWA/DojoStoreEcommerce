<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<title>Products</title>
	<style type="text/css">
		*{
			margin: 0px;
			padding: 0px;
		}
		h6 a {
			float:right;
			text-decoration: none;
			color:silver;
			margin:60px;
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
		}
	</style>
</head>
<body>
	<div id="header">
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
		<a href="/main/cart">View Cart</a>
	</div>
	<div id="sidebar">
		<form id="search" action="search" method="post">
			<input type="text" name="product">
			<input type="submit" value="Search">
		</form>
		<h4>Categories:</h4>
		<ul>
			<li><a href='/'>All Products</a></li>
<?php 		foreach ($categories as $category) {
?> 			<li><a href='#'><?=$category['category']?> (<?= $category['count(*)']?>)</a></li>
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
<?php 	$this->load->view('productdisplay');
?>		
		<?php 
			$pages=floor(count($productInfo)/15)+1;
			for($i=1;$i<=$pages;$i++){
				echo "<a href='/main/page/".$i."'>".$i."</a>";
			}
		?>		

	</div>
</div></div>
	<div id="footer">
		<h6><a href="admin">Admin Login</a></h6>
	</div>
</body>
</html>