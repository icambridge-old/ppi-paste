<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="/styles/main.css" type="text/css">
		<link href="/prettify/prettify.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="/prettify/prettify.js"></script>		
		<title>Pastes - p.iain.at</title>
	</head>
	<body  onload="prettyPrint()">
		<div id="body">
			<div id="header">
				<a href="<?php echo $baseUrl; ?>"><h1>Pastes - p.iain.at</h1></a>
			</div>
			<div id="content">
				<?php include_once($viewDir . $actionFile); ?>
			</div>
			
			<div id="footer">
				&copy; Copyright Iain Cambridge 2011, all rights reserved.
			</div>
		</div>
		<div class="ribbon">
		  <a href="https://github.com/icambridge/ppi-paste" rel="me">Fork me on GitHub</a>
		</div>
	</body>
</html>
