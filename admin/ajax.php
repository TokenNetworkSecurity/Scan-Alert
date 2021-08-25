<?php
	require_once '../config.php';

	if (isset($_POST['action'])){
		$connect_db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		mysqli_query($connect_db, 'SET NAMES utf8');

		$result = false;

		switch ($_POST['action']){
			case 'update-report':
				$sql = "UPDATE `scams` SET `address` = '{$_POST['address']}', `scam_type` = '{$_POST['scam_type']}', `website` = '{$_POST['website']}', `description` = '{$_POST['description']}', `link` = '{$_POST['link']}', `coin` = '{$_POST['coin']}', `moderated` = 1 WHERE `id` = ".$_POST['id'];
				$query = mysqli_query($connect_db, $sql);
				if ($query === true){
					$result = true;
				}
				break;
			case 'delete-report':
				$sql = 'DELETE FROM `scams` WHERE `id` = '.$_POST['id'];
				$query = mysqli_query($connect_db, $sql);
				if ($query === true){
					$result = true;
				}
				break;
		}

		mysqli_close($connect_db);

		echo json_encode($result);
	}
?>