<!DOCTYPE html>
<html lang="en">
    <head>
	<?php require_once('header.php'); ?>
    </head>
    <body>
	<?php require_once('nav.php'); ?>
	<?php
	$start = date('Y-m-d\TH:i:00');
	if (isset($_POST['start'])) $start=$_POST['start'];
	?>
	<form method="post">
	    <div class="container" >
		<h1>Add Awake</h1>
		<input type="hidden" name="event" value="awake">
		<div class="row">
		    <div class="col-sm-2">
			<label class="inline" for="date" >Date</label>
			<input type="datetime-local" name="start" required="true" value="<?php echo $start; ?>">
		    </div>
		</div>

		<div class="row top20">
		    <div class="col-xs-6 col-sm-1 text-center" >
			<button type="submit" class="btn btn-primary" name="baby" value="charlotte">Charlotte</button>
		    </div>
		    <div class="col-xs-6 col-sm-1 text-center" >
			<button type="submit" class="btn btn-primary" name="baby" value="sophia">Sophia</button>
		    </div>
		</div>
	    </div>
	</form>
	<?php require_once('writedb.php'); ?>
	<?php require_once('awake_table.php'); ?>
	<?php require_once('scripts.php'); ?>
    </body>
</html>

