<?php
	require 'config.php';

	if (isset($_POST)){
		$connect_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		mysqli_query($connect_db, 'SET NAMES utf8');

		switch ($_POST['action']){
			case 'reportscam':
				$coin = $_POST['coin'];
				$scam_type = $_POST['scam_type'];
				$address = $_POST['address'];
				$description = $_POST['description'];

				$sql = "INSERT INTO `scams` (`address`, `scam_type`, `description`, `moderated`, `website`, `link`, `coin`) VALUES ('$address', '$scam_type', '$description', '0', '', '', '$coin');";
				$query = mysqli_query($connect_db, $sql);
				if ($query === true){
					echo json_encode(true);
				} else {
					echo json_encode(false);
				}
				break;
			case 'signin':
				$secret = $_POST['secret'];
				$_SESSION['auth_time'] = time();
				if ($secret == SECRET){
					echo json_encode(true);
				}
				break;
			default:
				break;
		}

		mysqli_close($connect_db);
	}
?>