<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Store: Product Info</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/details.css">
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
			margin-left: 60%;
			color:white;
		}
		#description, #photos{
			display: inline-block;
		}
	</style>
	<script type="text/javascript" src="/assets/scripts/jquery-2.1.3.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function() {

			$('#qty').on('keyup','',function() {
				var x = $('input[id=qty]').val(); 
				var y = $('#qty').attr('valtag');
				var z = x * y;
				$('#total').text('$'+z.toFixed(2));
			});

			$('img[class=picsmall]').hover(function() {
				var tmp = $(this).attr('src');
				$('img[id=pic1]').fadeOut(200);
				$('img[id=pic1]').attr('src',tmp);
				$('img[id=pic1]').fadeIn(200);

			}, function() {


			});

			$('#mainform').on('submit',function() {
				var form = $(this);
				// console.log('here');
				
				$.post(
					form.attr('action'),
					form.serialize(),
					function(output) {
					// 
					}
					,"json");

				return false;
			});
		});
	</script>
</head>
<body>
	<div id="header">
		Dojo eCommerce
		<a href="/main/cart">View Cart<?php echo "(".$cart['items']."): $".$cart['total']; ?></a>
	</div>
<?php
	// echo "<pre>";
	// var_dump($data);
	// echo "</pre>";
	// // die();

	$title = $data[0]['product'];
	$main_file = $data[0]['file_path'];
	$caption = $data[0]['caption'];
	// echo "****".$main_file;
	// exit;
?>
<div id="container">

	<div id="nav">
		<a href="/">Go Back</a>
	</div>

	<div id="photos">

		<h3><?= $title ?></h3>
		<div id="main-phot">
			<img id="pic1" class="mainpic" src="/assets/images/<?= $main_file ?>" alt='Main photo' border=0 width=350 height=350>
			<br><span id="subtitle"><?= $caption ?></span>
		</div>

		<div id="smallpix">
		<?php
		// echo "<pre>";
		// var_dump($results);
		// echo "</pre>";
		// exit;
			foreach($data as $row) {
				echo "<div class='divsmall'>";
				echo "<img class='picsmall' src='/assets/images/".$row['file_path']."' border=0 height='50' width='50'>";
				echo "</div>";
			}
		?>
		<div class='clear'></div>
		</div>
	</div>

	<div id="description">
		<p><?= $data[0]['description'] ?></p>
		<div id="buyarea">
			<form action="/main/add" method="post">
				<input type="hidden" name="product" value="<?php echo $title ?>">
			Qty: <input id='qty' valtag='<?=$data[0]['price']?>' type='number' min='1' size=3 name="qty" maxlength=3 value=0 class="qtyinput"> X <?=$data[0]['price'] ?> :: <label id='total' for='total'>$0.00</label>
			<input type="submit" value="Add to Cart">
			</form>
		</div>
	</div>
	<div class="clear"></div>



</div>

</body>
</html>