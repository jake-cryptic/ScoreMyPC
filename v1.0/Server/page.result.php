<?php 
$ramModCount = 0;
$totalRamInt = 0;
for($i=0;$i < count($ramArray);$i++) {
	if ($ramArray[$i] == "START_ARRAY") {
		$ramModCount = $ramModCount + 1;
	} else if (is_numeric($ramArray[$i])) {
		$totalRamInt = $totalRamInt + $ramArray[$i];
	} else {
		$brands[] = $ramArray[$i];
	}
}
$totalRamGiga = $totalRamInt / 1073741824;
$brandsRAM = "";
foreach ($brands as $brand=>$key) {
	$ramAmount = $ramArray[($key*2)+2] / 1073741824;
	$brandsRAM .= "{$key}({$ramAmount}GB)<br />";
}
$ramBody = "<h1>Total RAM: {$totalRamGiga}<br />Total RAM sticks: {$ramModCount}</h1><br /><h2>Sticks of RAM:<br /><br />{$brandsRAM}</h2>";
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	
		<title>ScoreMyPC</title>
		<link rel="stylesheet" type="text/css" href="css/homepage.css" media="screen" />
		<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
		
	</head>
	<body>
	
		<div id="navigation">
			<a href="http://underscored.co.nf/SysInfo/" title="Underscored Development"><h1>ScoreMyPC</h1></a>
			<div id="navigation_links">
				<a class="link" href="#home" title="System Overview"><div class="nav-button">Overview</div></a>
				<a class="link" href="#info_cpu" title="CPU"><div class="nav-button">CPU</div></a>
				<a class="link" href="#info_ram" title="RAM"><div class="nav-button">RAM</div></a>
				<a class="link" href="#info_gpu" title="GPU"><div class="nav-button">GPU</div></a>
			</div>
		</div>
		
		<div id="page">
			<div class="full_sect" id="overview">
				<div class="sect_title">Overview - <?php echo end($cpuArray); ?></div>
				
			</div>
			
			<div class="full_sect" id="info_cpu">
				<div class="sect_title">CPU Information</div>
				
			</div>
			
			<div class="full_sect" id="info_ram">
				<div class="sect_title">RAM Information</div>
				<?php echo $ramBody; ?>
			</div>
			
			<div class="full_sect" id="info_gpu">
				<div class="sect_title">GPU Information</div>
				
			</div>
			
			<div id="footer">&copy; Underscored Development 2015</div>
		</div>
	
	</body>
</html>