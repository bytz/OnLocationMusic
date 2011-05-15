<?php
require_once('functions.inc.php');
$yql_query="select * from html where url='http://www.last.fm/tag/".$location."/artists?page=".$page."' and xpath='//div[@class=\"skyWrap\"]/ul/li'";
$artists=getJSON_for_YQL($yql_query);
?>