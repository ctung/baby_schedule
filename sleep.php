<!DOCTYPE html>
<html lang="en">
    <head>
	<?php require_once('header.php'); ?>
    </head>
    <body>
	<?php require_once('nav.php'); ?>
	<?php
	$qnty = 1;
	$start = date('Y-m-d\TH:i:00');
	$end = date('Y-m-d\TH:i:00');
	if (isset($_POST['start'])) $start=$_POST['start'];
	if (isset($_POST['end'])) $end=$_POST['end'];
	?>
	<form method="post">
	    <div class="container" >
		<h1>Add Sleep</h1>
		<input type="hidden" name="event" value="sleep">
		<div class="row top10">
		    <div class="col-sm-2">
			<label class="inline" for="date" >Start Time</label>
			<input type="datetime-local" name="start" required="true" value="<?php echo $start; ?>">
		    </div>
		</div>
		<div class="row top10">
		    <div class="col-sm-2">
			<label class="inline" for="end" >End Time</label>
			<input type="datetime-local" name="end" required="true" value="<?php echo $end; ?>">
		    </div>
		</div>

		<div class="row top10">
		    <div class="col-sm-2 col-md-4">
			<label class="inline" for="location" >Location </label>
			<div>
			    <label class="radio-inline"><input type="radio" name="location" value="Crib" checked="checked"> Crib</label>
			    <label class="radio-inline"><input type="radio" name="location" value="RockNPlay"> RNPlay</label>
			    <label class="radio-inline"><input type="radio" name="location" value="Bjorn"> Bjorn</label>
			    <label class="radio-inline"><input type="radio" name="location" value="Swing"> Swing</label>
			    <label class="radio-inline"><input type="radio" name="location" value="Held"> Held</label>
			</div>
		    </div>
		</div>

		<div class="row top10">
		    <div class="col-sm-2">
			<label class="inline">Comfort: <span id="qlty_lbl" >5</span></label>
			<input id="qlty_inp" name="qlty" value="5" type="hidden">
			<div id="qlty_sli"></div>
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
	<?php require_once('sleep_table.php'); ?>
	<?php require_once('scripts.php'); ?>
	<script>
	 var qlty_sli = document.getElementById('qlty_sli');
	 noUiSlider.create(qlty_sli, {
	     start: [5],
	     connect: 'lower',
	     range: {
		 'min': 0.5,
		 'max': 10
	     }
	 });
	 qlty_sli.noUiSlider.on('update', function ( values, handle ) {
	     document.getElementById('qlty_lbl').innerHTML = Math.round(values[handle]);
	     document.getElementById('qlty_inp').value = Math.round(values[handle]);
	 });

	</script>
    </body>
</html>

