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
for($i=0;$i < count($ramArray);$i++) {
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
for($i=0;$i < count($cpuArray);$i++) {
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
?>