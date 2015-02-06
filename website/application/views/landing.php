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
		Dojo eCommerse
		<a href="/main/cart">View Cart</a>
	</div>
	<div id="sidebar">
		<form id="search" action="/main/search">
			<input type="text" name="product">
			<input type="submit" value="Search">
		</form>
		<h4>Categories:</h4>
		<ul>
			<li><a href='#'>All Products</a></li>
			<li><a href='#'>TShirts</a></li>
			<li><a href='#'>Shoes</a></li>
			<li><a href='#'>Cups</a></li>
			<li><a href='#'>Fruits</a></li>
		</ul>
	</div>
	<div id="content">
		<h2>Products (Page 1)</h2>
		<div id="nav">
		<a href="#">Prev</a>
		<a href="#">Next</a>
		<form action="/main/sort" method="post">
			<p>Sort By:<select><option>Price</option><option>Most Popular</option></select></p>
		</form>
		</div>
		<table>
			<?php
			for($i=0;$i<3;$i++){
				echo "<tr>";
				for ($j=1;$j<6;$j++){
					$ID=$j+$i*5;
					echo"<td><a href='/main/info'>".$ID."</a>".$productInfo[$ID]."</td>";
				}
				echo "</tr>";
			}
			?>
		</table>
		
		<?php 
			$pages=floor(count($productInfo)/15)+1;
			for($i=1;$i<=$pages;$i++){
				echo "<a href='/main/page/".$i."'>".$i."</a>";
			}
		?>		

	</div>
	<div id="footer">
		<a href="/main/admin">Admin Login</a>
	</div>
</body>
</html>