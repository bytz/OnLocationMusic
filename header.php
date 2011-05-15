<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>On Location Music</title>
<link rel="icon" href="favicon.ico">
<!-- Framework CSS -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<!--[if lt IE 8]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection"><![endif]-->
</head>
<body onload="getGeoLocation()">
<?php if(!$_SESSION['location']){ ?>
<script type="text/javascript" >
	// Check for geolocation support
	function getGeoLocation(){
		if (navigator.geolocation) {
			// Use method getCurrentPosition to get coordinates
			navigator.geolocation.getCurrentPosition(function (position) {
				// Access them accordingly
				//alert(position.coords.latitude + ", " + position.coords.longitude);
				location.href='/index.php?location='+position.coords.latitude+'%2C+'+position.coords.longitude+'&share=1';
			});
		}
	}
</script>
<?php } ?>
<div id="header">
	<div id="logo">
		<a href="/"><img src="img/olm.png" alt="On Location Music" /></a>
	</div>
</div>
<div class="container ">
  <div class="clear span-5 last" id="content">
