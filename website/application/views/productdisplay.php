<!-- generate product info area 
	make 5x3 
	from db, pull image, name, price
-->

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
?>
</div> -->