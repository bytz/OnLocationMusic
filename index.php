<?php
include('session.inc.php');
$location="Romania";
if($_GET['location']){
	$geo_location=$_GET['location'];
	include('country.inc.php');
	if(!is_null($country->query->results)){
		if(is_array($country->query->results->place))$place=$country->query->results->place[0];
		else $place=$country->query->results->place;
		$location=$place->country->content;
	}
	else $location=$geo_location;
}
if($_GET['share'])$_SESSION['location']=$_GET['location'];
require('header.php');
include('cola.php');
$location=urlencode($location);
if(!$_GET['view']||$_GET['view']=="artists"){
	include('colb-a.php');
}
else if($_GET['view']=="tracks"){
	include('colb-t.php');
}
else if($_GET['view']=="artist"){
	include('colb-at.php');
}
include('colc.php');
require('footer.php');
?>