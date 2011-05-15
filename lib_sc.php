<?php
	define('CLIENT_ID', 'UE9kdC5cPSyJUTDPVO0Pg');
	define('CLIENT_SECRET','loUm3N8O80BGcthuHZBleiSiBqguY0fYqNB1qnQ');	
	
	function sc_search($query='',$limit=0)
	{
		$results = get_results($query,'soundcloud');
		$results = sort_results($results, $query,'title');
		if (empty($results) || !is_array($results))
			return null;
		$result = $results[0];
		$ret = new stdClass();
		$ret->title = $result->title;
		$ret->url = $result->stream_url.'?client_id='.CLIENT_ID;
		$ret->score = $result->score;//we care because we will run compare it against other service's scores
		return $ret;
	}
?>
