<html>
<head>
	<meta charset="utf-8">
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
			margin-top:-56px;
			background-color:#bbbbbb;
			opacity: 0.7;
		}

		.infocell {
			display: inline-block;
			width:45%;
		}
	</style>
	<script>
		$(document).on('submit', '#search', function(){	
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data){

					console.log(data);
					$('#category').html("<li><a href='/'>All Products</a></li>");
					$(data.categories).each(function(){
						$('#category').append(
							"<li><a href='search/"+this.category+"'>"+this.category+" ("+this.count+")</a></li>");
					});
					$('#productdisplaygrid').html('');
					$(data.results).each(function(){	
							$('#productdisplaygrid').append(
								"<div class='cell'>"+
								"<a href='products/"+this.pid+"'><img src='assets/images/"+this.file_path+"'></a>"+
								"<div class='infobanner'><div class='infocell'>"+
								"<h6>"+this.product+"</h6></div><div class='infocell'>"+
								"<h4>"+this.price+"</h4></div></div></div></div>");
					}); //results.each
					$('#footer').prepend(data.links);
				}, "json" //data
				);
			return false;
		});

/*		$('option[value="price"]').on('click', function(){
			alert('hi');
	/*<?php  foreach ($productInfo as $row) {
 						foreach ($row as $key => $value){
    						${$key}[]  = $value; //Creates $volume, $edition, $name and $type arrays.
  		  				}	  
					}
					array_multisort($price, SORT_ASC, $productInfo); 
					var_dump($productInfo)?> */
	//	}); 
	</script>
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
		<ul id="category">
			<li><a href='/'>All Products</a></li>
<?php 			foreach ($categories as $category) {
?> 					<li><a href='#'><?=$category['category']?> (<?= $category['count']?>)</a></li>
<?php 			}
?> 
		</ul>
	</div>
	<div id="content">
		<h2>Products (Page $)</h2>
		<div id="nav">
		<a href="#">Prev</a>
		<a href="#">Next</a>
		<form action="sortprodbyprice" id="sortprodbyprice" method="post">
			<input type="hidden" value="$productinfo" name="productInfo">
			<p>Sort By:<select>
						<option value="price">Price</option>
						<option value="pop">Most Popular</option>
					</select></p>
		</form>
		</div>
<?php 	$this->load->view('productdisplay');
?>			
	</div>
</div></div>
	<div id="footer">
		<h6><a href="admin">Admin Login</a></h6>
	</div>
</body>
</html>