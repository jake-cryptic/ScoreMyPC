<?php require("result.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	
		<title>ScoreMyPC</title>
		<link rel="stylesheet" type="text/css" href="css/homepage.css" media="screen" />
		<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js" type="text/javascript"></script> <!-- https://github.com/nnnick/Chart.js -->
		
	</head>
	<body>
	
		<div id="navigation">
			<a href="http://projects.absolutedouble.co.uk/scoremypc/" title="Underscored Development"><h1>ScoreMyPC</h1></a>
			<div id="navigation_links">
				<a class="link" href="#overview" title="System Overview"><div class="nav-button">Overview</div></a>
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
				<div class="sect_title">GPU Information</div>
				<?php echo $gpuBody; ?>
			</div>
			
			<div class="full_sect" id="info_bse">
				<div class="sect_title">MotherBoard Information</div>
				<?php echo $bseBody ?>
			</div>
			
			<div class="full_sect" id="info_hdd">
				<div class="sect_title">Storage Information</div>
				<?php echo $hddBody; ?>
				<canvas id="storage_chart" width="300" height="300"/>
			</div>
			
			<div class="full_sect" id="info_nic">
				<div class="sect_title">Network Information - Work in progress</div>
				<?php echo $nicBody ?>
			</div>
			
			<div class="full_sect" id="info_nic">
				<div class="sect_title">User Information - Work in progress</div>
				<?php echo $usrBody; ?>
			</div>
			
			<div id="footer">&copy; Underscored Development 2015</div>
		</div>
		
		<script type="text/javascript">
		var storageChartLoaded = false;
		function isShown(el) {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();
			var elemTop = $(el).offset().top;
			return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
		}
		var pieData = [
			{
				value: <?php echo $hdd_Sused; ?>,
				color: "#949FB1",
				highlight: "#A8B3C5",
				label: "Used"
			},
			{
				value: <?php echo $hdd_Sfree; ?>,
				color: "#4D5360",
				highlight: "#616774",
				label: "Free"
			}
		];
		$(window).scroll(function(){
			console.log("000000000000000000000000000000000000000000000000000000000000000");
			if (isShown("#info_hdd") && storageChartLoaded == false){
				console.log("1");
				var ctx = document.getElementById("storage_chart").getContext("2d");
				window.myPie = new Chart(ctx).Pie(pieData);
				storageChartLoaded = true;
			}
		});
		</script>
	
	</body>
</html>