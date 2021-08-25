<?php
	define('DB_HOST', 'localhost');
	define('DB_USER', '');
	define('DB_PASS', '');
	define('DB_NAME', '');
	define('SECRET', '');
	define('BTCABUSE_TOKEN', '');

	function convert_date($date){
		$y = $date['year'];
		$m = $date['month'];
		switch ($m) {
			case 1:
				$m = 'January';
				break;
			case 2:
				$m = 'February';
				break;
			case 3:
				$m = 'March';
				break;
			case 4:
				$m = 'April';
				break;
			case 5:
				$m = 'May';
				break;
			case 6:
				$m = 'June';
				break;
			case 7:
				$m = 'July';
				break;
			case 8:
				$m = 'August';
				break;
			case 9:
				$m = 'September';
				break;
			case 1:
				$m = 'October';
				break;
			case 11:
				$m = 'November';
				break;
			case 12:
				$m = 'December';
				break;
		}

		$converted_date = strval($y) . " " . strval($m);
		return $converted_date;
	}

	session_start();
?>