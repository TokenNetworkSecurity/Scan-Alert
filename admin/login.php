<?php
	require '../config.php';

	if (isset($_SESSION['auth_time'])){
		exit(header('Location: /admin/'));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In</title>
	<link rel="stylesheet" href="../assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="../assets/font/stylesheet.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<main>
		<div class="container">
			<div class="box" style="position: absolute;top: 50%;left: 50%;width: 360px;transform: translate(-50%, -50%);">
				<form onsubmit="return false;" style="text-align:center;">
					<h1 style="text-transform: uppercase;letter-spacing: 2px;">Sign In</h1>
					<input type="password" name="secret" placeholder="Secret Key" style="letter-spacing: 3px;">
					<button type="submit">Sign In</button>
					<a href="/" style="display: block;margin-top: 16px;text-decoration: none;">← Back to the site</a>
				</form>
			</div>
		</div>
	</main>

	<script src="../assets/js/jquery-3.3.1.min.js"></script>

	<script>
		var secret, json;
		$('form').on('submit', function(){
			secret = $('input').val();

			if (secret.length != 0){
				$.ajax({
					url: '/ajax.php',
					type: 'POST',
					data: {
						action: 'signin',
						secret: secret,
					},
					success: function (data){
						json = JSON.parse(data);
						console.log(json);
						if (json){
							window.location.replace('/admin/');
						}
					}
				});
			}
		});
	</script>
</body>
</html>