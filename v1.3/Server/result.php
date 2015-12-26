<?php

//
/// INF
//

for($i=0;$i < count($infArray);$i++) {
	if ($i != 0) {
		switch($i) {
			case 1:
				$systemOS = $infArray[$i];
				break;
			case 2:
				$systemCountry = $infArray[$i];
				break;
			case 3:
				$systemInstallDate = $infArray[$i];
				break;
			case 4:
				$systemArch = $infArray[$i];
				break;
			case 5:
				$systemUsers = $infArray[$i];
				break;
			default:
				break;
		}
	}
}
$systemOSInstallDate = substr($systemInstallDate,0,4) . "-" . substr($systemInstallDate,4,2) . "-" . substr($systemInstallDate,6,2) . " @ " . substr($systemInstallDate,8,2) . ":" . substr($systemInstallDate,10,2) . ":" . substr($systemInstallDate,12,2);
$infBody = "<span class='info_item'>OS: {$systemOS}<br />Architecture: {$systemArch}<br />User Accounts: {$systemUsers}<br />OS First Boot: {$systemOSInstallDate}</span>";

//
/// RAM
//

$ramModCount = 0;
$totalRamInt = 0;
for($i = 0;$i < count($ramArray);$i++) {
	if ($ramArray[$i] == "START_ARRAY") {
		$ramModCount = $ramModCount + 1;
	} else if (is_numeric($ramArray[$i])) {
		$totalRamInt = $totalRamInt + $ramArray[$i];
	} else {
		$RAMbrands[] = $ramArray[$i];
	}
}
$totalRamGiga = $totalRamInt / 1073741824;
$brandsRAM = "";
foreach ($RAMbrands as $brand=>$key) {
	$ramAmount = $ramArray[($key*2)+2] / 1073741824;
	$brandsRAM .= "{$key}({$ramAmount}GB)<br />";
}
$ramBody = "<span class='info_item'>Total RAM: {$totalRamGiga}GB<br />Total RAM sticks: {$ramModCount}</span><br /><br /><span class='info_item'>Sticks of RAM:<br />{$brandsRAM}</span>";

//
/// CPU
//

$cpuCount = 0;
for($i = 0;$i < count($cpuArray);$i++) {
	if ($cpuArray[$i] == "START_ARRAY") {
		$cpuCount = $cpuCount + 1;
	} else if ($i == 1) {
		$cpuClockSpeed = $cpuArray[$i];
	} else if ($i == 2) {
		$cpuVoltage = $cpuArray[$i];
	} else if ($i == 3) {
		$cpuMaker = $cpuArray[$i];
	} else if ($i == 4) {
		$cpuMaxSpeed = $cpuArray[$i];
	} else if ($i == 5) {
		$cpuName = $cpuArray[$i];
	} else if ($i == 6) {
		$cpuCores = $cpuArray[$i];
	} else if ($i == 7) {
		$cpuThreads = $cpuArray[$i];
	} else {
		$cpuSysNam = $cpuArray[$i];
	}
}
$speedInGHZ = $cpuClockSpeed / 1000;
$maxSpeedInGHZ = $cpuMaxSpeed / 1000;
$cpuBody = "<span class='info_item'>CPU: {$cpuName}<br />Manufacturer: {$cpuMaker}<br />Speed: {$speedInGHZ}GHz / {$maxSpeedInGHZ}GHz<br />Cores: {$cpuCores} ({$cpuThreads} Threads)<br />Voltage: {$cpuVoltage}V</h1>";

//
/// GPU
//

if (count($gpuArray) == 0) {
	$gpuBody = "<h1>No Graphics cards</h1>";
} else {
	$gpuCount = 0;
	for($i=0;$i < count($gpuArray);$i++) {
		if ($gpuArray[$i] == "START_ARRAY") {
			$gpuCount = $gpuCount + 1;
		} else if ($i == 1) {
			$GPUbrands[] = $gpuArray[$i];
		} else if ($i == 2) {
			$GPUrams[] = $gpuArray[$i];
		} else if ($i == 4) {
			$GPUnames[] = $gpuArray[$i];
		}
	}
	$gpuBody = "<span class='info_item'>";
	foreach($GPUbrands as $gpuB=>$key) {
		$thisGPURAMx = $GPUrams[$gpuB] / 1073741824;
		$thisGPURAM = round($thisGPURAMx * 2) / 2; // Fixes it getting stuck at 3.9990234375GB when it is 4
		$gpuBody .= "GPU: " . $GPUnames[$gpuB] . "<br />Manufacturer: " . $key . "<br />RAM: {$thisGPURAM}GB<br />";
	}
	$gpuBody .= "</span>";
}

//
// BSE
//

$bseBody = "<span class='info_item'>";
$bseBody .= "Manufacturer: " . $bseArray[2];
$bseBody .= "<br />Model: " . $bseArray[3];
if (strtolower((string)$bseArray[1]) != "false") {
	$bseBody .= "<br />Can be hot swapped";
}
$bseBody .= "</span>";

//
// HDD
//

$hddBody = "<span class='info_item'>";

for($i = 0;$i < count($hddArray);$i++) {
	if ($hddArray[$i] == "START_ARRAY") {
		if (strtolower($hddArray[($i + 2)]) == "local fixed disk") {
			$cSize = round(($hddArray[($i + 6)] / 1073741824));
			$cUsed = round(($hddArray[($i + 5)] / 1073741824));
			
			$hddBody .= "
				<div class='hdd' style='padding:0 0 1em .2em; width:100%;'>
					Name: " . $hddArray[($i + 7)] . "<br />
					Letter: " . $hddArray[($i + 3)] . "<br />
					Size: " . $cSize . " GB<br />
					Free: " . $cUsed . " GB<br />
					File System: " . $hddArray[($i + 4)] . "<br />
				</div>\n";
		} else {
			$hddBody .= "
				<div class='hdd' style='padding:.5em 0 .5em .2em; width:100%;'>
					CD Drive<br />
					Letter: " . $hddArray[($i + 3)] . "<br />
				</div>\n";
		}
	}
}
$hddBody .= "</span>";


//
// NIC
//

$nicBody = "<span class='info_item'>";
$tnlAdpts = 0;
$tapAdpts = 0;

for($i = 0;$i < count($nicArray);$i++) {
	if ($nicArray[$i] == "START_ARRAY") {
		if ($nicArray[$i + 1] != "IS_TUNNEL_ADAPTER" && $nicArray[$i + 1] != "IS_TAP_ADAPTER" ) {
			$cSpeed = $nicArray[($i + 7)] / 1000000;
			if ($cSpeed > 1000) {
				$cSUnit = "Gbps";
				$cSpeed = $cSpeed / 1000;
			} else {
				$cSUnit = "Mbps";
			}
			if ($cSpeed < 9000000000 && $cSUnit == "Gbps") { // Just because that's mad
				$nicBody .= "
				<div class='hdd' style='padding:0 0 1em .2em; width:100%;'>
					Manufacturer: " . $nicArray[($i + 4)] . "<br />
					Type: " . $nicArray[($i + 6)] . "<br />
					Speed: $cSpeed $cSUnit<br />
					MAC Address: " . $nicArray[($i + 3)] . "<br />
				</div>\n";
			} else {
				$nicBody .= "
				<div class='hdd' style='padding:0 0 1em .2em; width:100%;'>
					Manufacturer: " . $nicArray[($i + 4)] . "<br />
					Type: " . $nicArray[($i + 6)] . "<br />
					MAC Address: " . $nicArray[($i + 3)] . "<br />
				</div>\n";
			}
		} elseif ($nicArray[$i + 1] == "IS_TUNNEL_ADAPTER") {
			$tnlAdpts = $tnlAdpts + 1;
		} else {
			$tapAdpts = $tapAdpts + 1;
		}
	}
}

$nicBody .= "</span>";

//
// USR
//

$usrBody = "<span class='info_item'>";
$usrBody .= str_replace("START_ARRAY","<br />",str_replace("@@!~@"," | ",$usr));
$usrBody .= "</span>";
?>