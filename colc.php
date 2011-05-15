    <div class="span-1 last" id="colc">
    	<h3>Find music by location</h3>
    	<div class="sidebox">
			<div class="corner"></div>
			<form method="get" action="index.php" id="search">
				<input type="text" id="location" name="location" value="enter location" tabindex="1"  onblur="if(this.value==''){this.value='enter location'};" onfocus="if(this.value=='enter location'){this.value=''};" /><input type="submit" id="submit" value="Go"/>
			</form>
		</div>
    	<h3>You are now located in</h3>
    	<div class="sidebox">
	    	<div class="corner"></div>
    		<h4><a href="/index.php?location=<?php echo $_SESSION['location']; ?>"><?php echo $_SESSION['location']; ?></a></h4>
    	</div>
    </div>
