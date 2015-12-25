<?php require("result.php"); ?>
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
				<a class="link" href="#info_bse" title="Motherboard"><div class="nav-button">MotherBoard</div></a>
				<a class="link" href="#info_hdd" title="Storage Devices"><div class="nav-button">Storage</div></a>
				<a class="link" href="#info_nic" title="Network interface cards"><div class="nav-button">Networking</div></a>
			</div>
		</div>
		
		<div id="page">
			<div class="full_sect" id="overview">
				<div class="sect_title">Overview - <?php echo end($cpuArray); ?></div>
				<?php echo $infBody; ?>
			</div>
			
			<div class="full_sect" id="info_cpu">
				<div class="sect_title">CPU Information</div>
				<?php echo $cpuBody; ?>
			</div>
			
			<div class="full_sect" id="info_ram">
				<div class="sect_title">RAM Information</div>
				<?php echo $ramBody; ?>
			</div>
			
			<div class="full_sect" id="info_gpu">
				<div class="sect_title">GPU Information - Work in progress</div>
				<?php echo $gpuBody; ?>
			</div>
			
			<div class="full_sect" id="info_bse">
				<div class="sect_title">MotherBoard Information - Work in progress</div>
				<?php echo $bse; ?>
			</div>
			
			<div class="full_sect" id="info_hdd">
				<div class="sect_title">Storage Information - Work in progress</div>
				<?php echo str_replace("START_ARRAY","<br />",str_replace("@@!~@"," | ",$hdd)); ?>
			</div>
			
			<div class="full_sect" id="info_nic">
				<div class="sect_title">Network Information - Work in progress</div>
				<?php echo str_replace("START_ARRAY","<br />",str_replace("@@!~@"," | ",$nic)); ?>
			</div>
			
			<div class="full_sect" id="info_nic">
				<div class="sect_title">User Information - Work in progress</div>
				<?php echo str_replace("START_ARRAY","<br />",str_replace("@@!~@"," | ",$usr)); ?>
			</div>
			
			<div id="footer">&copy; Underscored Development 2015</div>
		</div>
	
	</body>
</html>