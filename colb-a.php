	<div class="span-3" id="colb">
	<div id="viewmode">
		<a href="index.php?view=artists&location=<?php echo $location; ?>" id="active">Artists</a>
		<a href="index.php?view=tracks&location=<?php echo $location; ?>">Tracks</a>
	</div>
<?php
include('artistslastpage.inc.php');
if(is_null($nextpage))$pages=1;
else $pages=intval($nextpage->query->results->a[1]->content);
?>
<ul id="artists">
<?php
for($page=1;$page<=$pages;){
	require('artists.inc.php');
	if(!is_null($artists->query->results)){
		if($page==1)$i=0;
		foreach($artists->query->results->li as $artist){
			if(is_array($artist->a))$artist_a=$artist->a[0];
			else $artist_a=$artist->a;
?>
      <li<?php if(($i+1)%4==0)echo ' class="last"'; ?>><a href="#"><img src="<?php echo $artist_a->span->span->img->src; ?>" alt="<?php echo $artist_a->strong->content; ?>"/><h4><?php echo $artist_a->strong->content; ?></h4></a></li>
<?php
			$i++;
		}
	}
	$page++;
}
?>
</ul>
    </div>