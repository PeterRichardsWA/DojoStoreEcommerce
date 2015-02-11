<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ecomm</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/ecom.css">
	<script type="text/javascript" src="/assets/scripts/jquery-2.1.3.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function() {

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

<h1>Welcome to the Ecom Site</h1>


</body>
</html>