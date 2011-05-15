<?php
require_once('functions.inc.php');
$yql_query="select * from geo.places where text='".$geo_location."'";
$country=getJSON_for_YQL($yql_query);
?>