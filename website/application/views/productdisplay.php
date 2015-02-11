<!-- generate product info area 
	make 5x3 
	from db, pull image, name, price
-->

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
									<h4>$<?= $productInfo[$i+$j]['price'] ?></h4>
								</div>
							</div>
						</div>
<?php 				} //if
				} //for-i
			} //for-j
?>
</div>