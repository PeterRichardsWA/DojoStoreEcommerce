<html>
<head>
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
		td{
			border: 1px solid black;
			height:250px;
			width:250px;
			padding:120px;
		}
	</style>
</head>
<body>
	<div id="header">
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
	</div>
	<div id="sidebar">
		<form id="search" action="/main/search">
			<input type="text" name="product">
			<input type="submit" value="Search">
		</form>
		<h4>Categories:</h4>
		<ul>
			<li><a href='#'>All Products</a></li>
			<?php 		foreach ($productcategories as $category) {
?>			<li><a href='#'>$categoryname (#)</a></li>
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
</body>
</html>