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
	$conn = new mysqli("","","","");
	
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
	
	while($item = $results->fetch_object()) {
		$ram = base64_decode($item->e_ram);
		$cpu = base64_decode($item->e_cpu);
		$gpu = base64_decode($item->e_gpu);
		$inf = base64_decode($item->e_info);
	}
	
	$ramArray = explode("@@!~@",$ram);
	$cpuArray = explode("@@!~@",$cpu);
	$gpuArray = explode("@@!~@",$gpu);
	$infArray = explode("@@!~@",$inf);
	
	require("page.result.php");
} else if ($page == 2) {
	require("page.error.php");
	die();
} else {
	require("page.home.php");
	die();
}
?>