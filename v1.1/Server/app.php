<?php

// Check if anything was set
if (!empty($_POST)) {
	// Check if what we need was set
	if (!empty($_POST["RAM"]) && !empty($_POST["CPU"]) && !empty($_POST["GPU"]) && !empty($_POST["BSE"]) && !empty($_POST["NIC"]) && !empty($_POST["HDD"]) && !empty($_POST["INF"])) {
		// Make safe what was set
		$ram = htmlspecialchars($_POST["RAM"]);
		$cpu = htmlspecialchars($_POST["CPU"]);
		$gpu = htmlspecialchars($_POST["GPU"]);
		$bse = htmlspecialchars($_POST["BSE"]);
		$nic = htmlspecialchars($_POST["NIC"]);
		$hdd = htmlspecialchars($_POST["HDD"]);
		$inf = htmlspecialchars($_POST["INF"]);
		
		// Now Database time.. Yay?
		$conn = new mysqli("","","","");
		
		// Check Connection
		if ($conn->connect_error) {
			unset($conn);
			die("Couldn't Connect To Database");
		} else {
			$conn->set_charset("utf8");
		}
		
		// Make safer the variables
		$sRAM = $conn->real_escape_string($ram);
		$sCPU = $conn->real_escape_string($cpu);
		$sGPU = $conn->real_escape_string($gpu);
		$sBSE = $conn->real_escape_string($bse);
		$sNIC = $conn->real_escape_string($nic);
		$sHDD = $conn->real_escape_string($hdd);
		$sINF = $conn->real_escape_string($inf);
		$time = time();
		
		// Create and execute query
		$query = "INSERT INTO results (`timestamp`,`e_info`,`e_cpu`,`e_ram`,`e_gpu`,`e_bse`,`e_nic`,`e_hdd`) 
		VALUES ('{$time}','{$sINF}','{$sCPU}','{$sRAM}','{$sGPU}','{$sBSE}','{$sNIC}','{$sHDD}')";
		$result = $conn->query($query);
		
		if (!$result) {
			die("_3");
		} else {
			// Now find the ID in the database and send it to the client
			$query = "SELECT id FROM results WHERE timestamp='{$time}' AND e_info='{$sINF}' AND e_CPU='{$sCPU}' AND e_RAM='{$sRAM}' AND e_GPU='{$sGPU}'";
			$result = $conn->query($query);
			
			if (!$result) {
				die("_0");
			} else {
				$id = $result->fetch_object()->id;
				
				// End the script
				$conn->close();
				die($id);
			}
		}
	} else {
		die("_2");
	}
} else {
	die("_1");
}

?>