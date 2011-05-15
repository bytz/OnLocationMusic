<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
	<div class="span-3" id="colb">
	<div id="viewmode">
		<a href="index.php?view=artists&location=<?php echo $location; ?>">Artists</a>
		<a href="index.php?view=tracks&location=<?php echo $location; ?>" id="active">Tracks</a>
	</div>
		<div id="tracks">
			<ol>
<?php
	require('artisttracks.inc.php');
	if(!is_null($tracks->query->results)){
		$i=1;
		foreach($tracks->query->results->tr as $track){
			print_r($track);
			$track_name=$_GET['artist']." - ".$track->td[2]->div->a->content;
?>
				<li><a href="http://play.last.fm/preview/<?php echo $track->td[1]->a->data-track-id; ?>.mp3"><?php echo $track_name; ?></a></li>
<?php
			$i++;
		}
	}
?>
			</ol>
		</div>
    </div>