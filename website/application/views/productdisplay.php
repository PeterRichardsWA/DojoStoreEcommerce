<!-- generate product info area 
	make 5x3 
	from db, pull image, name, price
-->

<<<<<<< HEAD
product display here
<?php 		for($j = 0;$j<3;$j++){
?>
			<div class="row">
<?php 			for($i=0;$i<5;$i++){
?>				<div class="cell">
						<img src="imgfromdb" alt="$imgname">
						<div class="infobanner">
							<div class="infocell">
								<h4>$name</h4>
							</div>
							<div class="infocell">
								<h4>$pricefromdb</h4>
							</div>
						</div>
					</div>
<?php 			}
			}
=======
<?php 	
		for($j = 0;$j<3;$j++){
?>			<div class="row">
<?php 			for($i=0;$i<5;$i++){
					if($i+($j*5) < $numproducts) {
?>						<div class="cell">
<?php 						echo img("assets/images/".$productInfo[$i+($j*5)]['file_path']); 
?>							<div class="infobanner">
								<div class="infocell">
									<h6><?=$productInfo[$i+$j]['product'] ?></h6> 
								</div>
								<div class="infocell">
									<h4><?= $productInfo[$i+$j]['price'] ?></h4>
								</div>
							</div>
						</div>
<?php 				} //if
				} //for-i
			} //for-j
>>>>>>> 3b2292a5f192a0f38576bf3d36134087918be07b
?>
</div> -->