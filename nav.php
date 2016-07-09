<nav class="navbar navbar-default">
    <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>">Add Event</a>
	</div>
	
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
		<li <?php if (basename($_SERVER['PHP_SELF']) == "feed.php") echo 'class="active"' ?>><a href="feed.php">Feeding</a></li>
		<li <?php if (basename($_SERVER['PHP_SELF']) == "sleep.php") echo 'class="active"' ?>><a href="sleep.php">Sleep</a></li>
		<li <?php if (basename($_SERVER['PHP_SELF']) == "poop.php") echo 'class="active"' ?>><a href="poop.php">Poop</a></li>
		<li <?php if (basename($_SERVER['PHP_SELF']) == "awake.php") echo 'class="active"' ?>><a href="awake.php">Awake</a></li>
	    </ul>
	</div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
