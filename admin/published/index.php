<?php
	require '../../config.php';

	if (time() - $_SESSION['auth_time'] >= 1200){
		session_destroy();
	}

	if (!isset($_SESSION['auth_time'])){
		exit(header('Location: /admin/login.php'));
	}

	$connect_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	mysqli_query($connect_db, 'SET NAMES utf8');

	$sql = 'SELECT * FROM `scams` WHERE `moderated` = 1 ORDER BY `id` DESC';
	$query = mysqli_query($connect_db, $sql);

	$html = '';

	while ($report = mysqli_fetch_array($query)){
		$html .= '
		<tr>
			<td class="data-address"><input type="text" name="address" placeholder="Website" value="' . $report['address'] . '" disabled=""></td>
			<td class="data-scam_type"><input type="text" name="scam_type" placeholder="Scam Type" value="' . $report['scam_type'] . '"></td>
			<td class="data-coin"><input type="text" name="coin" placeholder="Coin" value="' . $report['coin'] . '"></td>
			<td class="data-website"><input type="text" name="website" placeholder="Website" value="' . $report['website'] . '"></td>
			<td class="data-description"><textarea name="description" placeholder="Description">' . $report['description'] . '</textarea></td>
			<td class="data-link"><input type="text" name="blockchain_link" placeholder="Blockchain Link" value="' . $report['link'] . '"></td>
			<td class="data-actions"><button type="button" class="btn btn-success">Save</button><button type="button" class="btn btn-danger">Delete</button><input type="hidden" value="' . $report['id'] . '"></td>
		</tr>';
	}

	mysqli_close($connect_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/font/stylesheet.css">
	<link rel="stylesheet" href="/assets/css/styles.css">
	<style>
		header {
			text-align: center;
		} header ul {
			margin: 0;
			list-style: none;
		} header ul li {
			display: inline-block;
			margin: 0;
			padding: 0;
		} header ul li a {
			display: inline-block;
			text-decoration: none;
			padding: 16px 28px;
			margin: 0 -2px;
			border: 4px solid transparent;
		} header ul li a:hover {
			background: #1dd79b;
			color: #1e2423;
		} .header__active-link {
			border-top: 4px solid #1dd79b;
		} input, textarea {
			margin: 0;
		} td {
			vertical-align: middle !important;
		} td button {
			margin: 1px;
		}
	</style>
</head>
<body>
	<header>
		<ul class="p-0">
			<li><a href="/admin/">New Reports</a></li>
			<li><a href="/admin/published/" class="header__active-link">Published Reports</a></li>
		</ul>
	</header>
	<main>
		<div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover table-sm table-dark text-center mt-5" style="min-width: 850px;">
					<thead>
						<tr>
							<td>Address</td>
							<td style="width: 128px">Scam Type</td>
							<td style="width: 70px;">Coin</td>
							<td>Website</td>
							<td>Description</td>
							<td>Blockchain</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						<?php echo $html; ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>

	<script src="/assets/js/jquery-3.3.1.min.js"></script>
	<script>
		var id, address, scam_type, website, description, link, json, coin;

		$('.btn-success').on('click', function(){
			id = $(this).parents('tr').find('.data-actions').find('input').val();
			coin = $(this).parents('tr').find('.data-coin').find('input').val();
			address = $(this).parents('tr').find('.data-address').find('input').val();
			scam_type = $(this).parents('tr').find('.data-scam_type').find('input').val();
			website = $(this).parents('tr').find('.data-website').find('input').val();
			description = $(this).parents('tr').find('.data-description').find('textarea').val();
			link = $(this).parents('tr').find('.data-link').find('input').val();

			$.ajax({
				type: 'POST',
				url: '/admin/ajax.php',
				data: {
					action: 'update-report',
					id: id,
					coin: coin,
					address: address,
					scam_type: scam_type,
					website: website,
					description: description,
					link: link
				},
				success: function(data){
					json = JSON.parse(data);
					if (json == true){
						alert('Changes are saved!')
					} else {
						alert('An error occured!')
					}
				}
			});
		});

		$('.btn-danger').on('click', function(){
			var th = $(this);
			id = $(this).parents('tr').find('.data-actions').find('input').val();

			$.ajax({
				type: 'POST',
				url: '/admin/ajax.php',
				data: {
					action: 'delete-report',
					id: id
				},
				success: function(data){
					json = JSON.parse(data);
					if (json == true){
						th.parents('tr').hide(100);
					} else {
						alert('An error occured!')
					}
				}
			});
		});
	</script>
</body>
</html>