<?php
if ($page == 2) {
	if (!isset($postData[1]) || !is_numeric($postData[1])) {
		$error = "That's not an error";
	} else {
		switch($postData[1]) {
			case 0:
				$error = "Data was saved but we have lost it now..";
				break;
			case 1:
				$error = "No data was sent to the server";
				break;
			case 2:
				$error = "Not all required data was sent to the server";
				break;
			case 3:
				$error = "Your results couldn't be stored in our database";
				break;
			case 4:
				$error = "Your version of ScoreMyPC is out of date";
				break;
			default:
				$error = "Unknown Error";
				break;
		}
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	
		<title>ScoreMyPC | Error</title>
		<link rel="stylesheet" type="text/css" href="css/homepage.css" media="screen" />
		<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
		
	</head>
	<body>
	
		<div id="navigation">
			<a href="http://projects.absolutedouble.co.uk/scoremypc/" title="Underscored Development"><h1>ScoreMyPC</h1></a>
		</div>
		
		<div id="page">
			<h1>An error occurred</h1>
			<?php echo $error; ?>
		</div>
	
	</body>
</html>