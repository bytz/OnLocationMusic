<?php
	define('XML_BASE','http://olm.jurubita.ro/');
	require_once('functions.inc.php');
	require_once('libs_base.php');
	require_once('lib_sc.php');
	require_once('lib_mt.php');
	
	
	function search($query)
	{
		$results[] = sc_search($query);
		$results[] = mt_search($query);
		
		$results = sort_results($results, $query);
		$results = $results[0];
		if (empty($results))
			return null;
		return $results;
	}
?>
