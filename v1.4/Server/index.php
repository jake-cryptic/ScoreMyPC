<?php

if (!empty($_GET["a"])) {
	// Get post data and split result
	$postData = explode("_",$_GET["a"],2);
	$resultID = end($postData);

	// Choose the page to show
	if ($postData[0] == "accepted") {
		$page = 1;
	} elseif($postData[0] == "error") {
		$page = 2;
	} else {
		$page = 0;
	}

} else {
	$page = 0;
}

if ($page == 1) {
	// Database time
	$conn = new mysqli("127.0.0.1","","","");

	// Check Connection
	if ($conn->connect_error) {
		unset($conn);
		die("Couldn't Connect To Database");
	} else {
		$conn->set_charset("utf8");
	}

	// Create and execute query
	$query = "SELECT * FROM results WHERE id='{$resultID}'";
	$results = $conn->query($query);

	if (!$results || $results->num_rows == 0) {
		$error = "Database Error";
		require("page.error.php");
	} else {
		while($item = $results->fetch_object()) {
			$ram = base64_decode($item->e_ram);
			$cpu = base64_decode($item->e_cpu);
			$gpu = base64_decode($item->e_gpu);
			$bse = base64_decode($item->e_bse);
			$nic = base64_decode($item->e_nic);
			$hdd = base64_decode($item->e_hdd);
			$usr = base64_decode($item->e_usr);
			$inf = base64_decode($item->e_info);
		}

		$ramArray = explode("@@!~@",$ram);
		$cpuArray = explode("@@!~@",$cpu);
		$gpuArray = explode("@@!~@",$gpu);
		$bseArray = explode("@@!~@",$bse);
		$nicArray = explode("@@!~@",$nic);
		$hddArray = explode("@@!~@",$hdd);
		$usrArray = explode("@@!~@",$usr);
		$infArray = explode("@@!~@",$inf);

		require("page.result.php");
	}
} else if ($page == 2) {
	require("page.error.php");
	die();
} else {
	// Database time
	$conn = new mysqli("127.0.0.1","","","");

	// Check Connection
	if ($conn->connect_error) {
		unset($conn);
		die("Couldn't Connect To Database");
	} else {
		$conn->set_charset("utf8");
	}

	// Create and execute query
	$query = "SELECT * FROM results ORDER BY id DESC LIMIT 3";
	$results = $conn->query($query);

	if (!$results || $results->num_rows == 0) {
		$error = "Database Error";
		require("page.error.php");
		die();
	} else {
		while($item = $results->fetch_object()) {
			$ram = base64_decode($item->e_ram);
			$cpu = base64_decode($item->e_cpu);

			$ramArray = explode("@@!~@",$ram);
			$totalRamInt = 0;
			for($i = 0;$i < count($ramArray);$i++) {
				if (is_numeric($ramArray[$i])) {
					$totalRamInt = $totalRamInt + $ramArray[$i];
				}
			}
			$rSz = $totalRamInt / 1073741824;

			$cpuArray = explode("@@!~@",$cpu);
			$cMk = $cpuArray[3];
			$cNm = $cpuArray[5];
			$pNm = end($cpuArray);

			$recents[] = '
					<div class="score">
						<span class="score_title">' . $pNm . '</span><br />
						<span class="score_info">
							<strong>CPU: </strong>' . $cMk . ' ' . $cNm . '<br />
							<strong>RAM: </strong>' . $rSz . 'GB<br />
						</span>
					</div>';
		}
	}
	require("page.home.php");
	die();
}
?>