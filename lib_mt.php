<?php
define('MT_USER','vlad.teo@gmx.com');
define('MT_PASSWORD','motherfucker');
define('MT_TOKEN','4439468724');

function mt_login()
{
	$query = '	use "'.XML_BASE.'yql_mp3tunes.login.xml" as mp3tunes.login; 
				select * from mp3tunes.login where username="'.MT_USER.'" AND password="'.MT_PASSWORD.'" AND token="'.MT_TOKEN.'";';
	$results = yql_get($query);
	$results = $results->query->results->mp3tunes;
	if (empty($results) || intval($results->status)!=1)
		return null;
	return $results->session_id;
}

function mt_search($query)
{
	//stub
	$sid = mt_login();
	if (empty($sid))//phail
		return null;
	if (empty($query) or empty($sid))
		return null;
	$query = '	use "'.XML_BASE.'yql_mp3tunes.search.xml" as mp3tunes.search; 
				select * from mp3tunes.search where sid="'.$sid.'" AND query="'.$query.'" AND token="'.MT_TOKEN.'";';
	//echo $query;
	$results = yql_get($query);
	$results = $results->results;//don't care that much about yql info
	var_dump($results);
	$results = sort_results($results, $query,array('artistname','tracktitle'));
	if (empty($results) || !is_array($results))
		return null;
	$result = $results[0];
	$ret = new stdClass();
	$ret->title = $result->artistname.' - '.$result->tracktitle;
	$ret->url = $result->playurl;
	$ret->score = $result->score;//we care because we will run compare it against other service's scores
	return $ret;	
}

//$x = mt_search('sleepwalker');
//var_dump($x);
?>
