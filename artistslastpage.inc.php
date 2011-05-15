<?php
require_once('functions.inc.php');
$yql_query="select * from html where url='http://www.last.fm/tag/".$location."/artists?page=1' and xpath='//a[@class=\"lastpage\"]'";
$nextpage=getJSON_for_YQL($yql_query);
?>