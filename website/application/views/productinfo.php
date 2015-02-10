<html>
<head>
	<title>Product Info</title>
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
		}
		#header a{
			margin-left: 70%;
			color:white;
		}
		#images,#description{
			margin-top: 20px;
			display: inline-block;
			vertical-align: top;
		}
		#images{
			width:20%;
		}
		.blowup{
			height:200px;
			width:200px;
			display: block;
		}
		.thumbnail{
			height:50px;
			width:50px;
		}
		#description{
			width:70%;
			margin-left: 5%;
		}
		#similar div{
			display: inline-block;
		}
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">
	$('document').ready(function(){
		$('.thumbnail').hover(function(){
			$src=$(this).attr('src');
			$('.blowup').attr('src',$src);
		});
	});
	</script>
</head>
<body>
	<div id="header">
<<<<<<< HEAD
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
=======
		Dojo eCommerse
		<a href="/main/cart">View Cart</a>
>>>>>>> remotes/origin/master
	</div>
	<a href="/">Go Back</a>
	<h1>(Product Name Here)</h1>
	<div id="info">
		<div id="images">
			<p>(Pictures Go Here)</p>
			<img class="blowup" src="front.png" alt="product image">
			<img class="thumbnail" src="side.png" alt="product image">
			<img class="thumbnail" src="front.png" alt="product image">
			<img class="thumbnail" src="back.png" alt="product image">
		</div>
		<div id="description">
			description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...description about the product...
			<form action="/main/add" method="post">
<<<<<<< HEAD
				<input type="hidden" name="product_id" value=<?php $product['id'] ?> />
=======
>>>>>>> remotes/origin/master
				<input type="number" name="quantity" min="1">
				<input type="submit" value="Add to Cart">
			</form>
		</div>
	</div>
	<div id="similar">
		<h3>Similar Items</h3>
		<?php 
			foreach ($similar as $row) {
				echo "<div><a href='/main/info/".$row['id']."'><img src=".$row['src']." alt='product image'><p>".$row['name']."</p></a></div>";
			}
		?>
	</div>
</body>
</html>