<?php
function is_curl()
{
	if  (in_array  ('curl', get_loaded_extensions())) 
		return true;
	return false;
}

function music_echo($result)
{
	echo '<a href="'.$result->url.'" target="_blank">'.$result->title.'</a><br />';
}
function x_explode($delimiters, $what)
{
	if (empty($delimiters))
		return $what;
	if (!is_array($what))
		$what = array($what);
	if (!is_array($delimiters))
		$delimiters = array($delimiters);
	$delimiter = array_pop($delimiters);
	
	$ret = array();
	foreach ($what as $wh)
		$ret = array_merge($ret, explode($delimiter, $wh));
	return x_explode($delimiters, $ret);
}

function yql_get($yql_query, $format='json')
{
	$format = strtolower(trim($format));
	$yql_query_url=YQL_BASE_URL."?debug=true&q=".urlencode($yql_query)."&format=".$format;
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'header'=>"Accept-language: en\n"
		)
	); 
	$context = stream_context_create($opts);
	$f = fopen($yql_query_url,'r',false, $context);
	ob_start();
	fpassthru($f);
	$response = ob_get_clean();
	if ($format=='json')
		return json_decode($response);
	else
		return simplexml_parse_string($response);
}
function get_results($what, $table)
{
	$func = 'yql_get';
	if (is_curl())
		$func = 'getJSON_for_YQL';
	
	$query = 'use "'.XML_BASE.'yql_'.$table.'.xml" as soundcloud; select * from '.$table.' where query="'.$what.'";';
	$results = $func($query);
	
	$results = $results->query->results->json;
	//var_dump($results);
	if (empty($results))
		return null;
	return $results;
}
function score($title, $query)
{
	$score = 0;
	$delims = array(' ',',','-');
	
	$elements = x_explode($delims, $query);//assume the user entered dashes between the elements
	$titles = x_explode($delims, $title);//the title, broken in pieces
	$is_remix = false;
	$is_cover = false;
	
	foreach ($elements as $element)
	{
		if (trim(strtolower($element))=='remix')//the user searched for a remix
			$is_remix = true;
		if (trim(strtolower($element))=='cover')
			$is_cover = true;
	}
	foreach ($titles as $title)
	{
		if (empty($title))
			continue;
		if (!$is_remix)
		{
			$aux = strtolower(str_ireplace('remix','',$title));
			if ($aux!=strtolower($title))//remixes are bad
				$score-=25;//remixes usually suck
		}
		if (!$is_cover)
		{
			$aux = strtolower(str_ireplace('cover','',$title));
			if ($aux!=strtolower($title))//remixes are bad
				$score-=50;//covers suck even more
		}
		foreach ($elements as $element)
		{
			if (empty($element))
				continue;
			//magic goes here
			$aux = trim(str_ireplace($element,'', $title));//we replace the title
			if (!strlen($aux))//horray, match
				$score+=150;
			else
				$score -=10 * strlen($aux);//phail
		}
	}
	$score+= rand(0,10);//add some randomness to the elements, but not much
	return $score;
}
function sort_results($results, $query, $title_var='title')
{
	if (empty($results))
		return null;
	if (empty($title_var))
		return null;
	$ret = array();
	foreach ($results as $result)
	{
		if (empty($result))
			continue;//filter out null values
		$title='';
		if (!is_array($title_var))
			$title = $result->$title_var;
		else
		{
			foreach ($title_var as $tv)
				$title.=$result->$tv.' ';
		}
		$title = trim($title);
		$result->score = score($title, $query);
		$ret[] = $result;
	}
	$results = $ret;
	
	for ($i = 0;$i<sizeof($results)-1;$i++)
		for ($j=$i+1;$j<sizeof($results);$j++)
			if ($results[$i]->score < $results[$j]->score)
			{
				$aux = $results[$i];
				$results[$i] = $results[$j];
				$results[$j] = $aux;
				unset($aux);
			}
	return $results;
}

?>
