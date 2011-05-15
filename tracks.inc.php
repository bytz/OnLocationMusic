<?php
require_once('functions.inc.php');
$yql_query="select * from html where url='http://www.last.fm/tag/".$location."/tracks' and xpath='//table[@class=\"candyStriped chart\"]/tbody/tr'";
$tracks=getJSON_for_YQL($yql_query);
?>