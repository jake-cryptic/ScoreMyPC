<?php

// Check if anything was set
if (!empty($_POST)) {
	// Check if what we need was set
	if (!empty($_POST["RAM"]) && !empty($_POST["CPU"]) && !empty($_POST["GPU"]) && !empty($_POST["INF"])) {
		// Make safe what was set
		$ram = htmlspecialchars($_POST["RAM"]);
		$cpu = htmlspecialchars($_POST["CPU"]);
		$gpu = htmlspecialchars($_POST["GPU"]);
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
		$sINF = $conn->real_escape_string($inf);
		$time = time();
		
		// Create and execute query
		$query = "INSERT INTO results (`timestamp`,`e_info`,`e_cpu`,`e_ram`,`e_gpu`) VALUES ('{$time}','{$sINF}','{$sCPU}','{$sRAM}','{$sGPU}')";
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