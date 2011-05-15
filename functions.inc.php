<?php
define('YQL_BASE_URL',"https://query.yahooapis.com/v1/public/yql");
function getJSON_for_YQL($yql_query,$format='json'){
//	echo $yql_query."\n";
	$format=strtolower(trim($format));
    $yql_query_url=YQL_BASE_URL."?q=".urlencode($yql_query)."&format=".$format;
    $session=curl_init($yql_query_url);
    curl_setopt($session,CURLOPT_RETURNTRANSFER,true);
    $json=curl_exec($session);
	echo curl_error($session);
	curl_close($session);
	if(strpos($json,"Sorry, Unable to process request at this time -- error 999.")!==false)
		echo "Sorry, Unable to process request at this time -- error 999.";
    if($format=='json')
    	return json_decode($json);
    elseif ($format=='xml')
    	return simplexml_load_string($json);
    return null;
}
?>