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
		<h1>Add Feeding</h1>
		<input type="hidden" name="event" value="feed">
		<div class="row top10">
		    <div class="col-sm-2">
			<label class="inline">Time</label>
			<input type="datetime-local" name="start" required="true" value="<?php echo $start; ?>">
		    </div>
		</div>

		<div class="row top10">
		    <div class="col-sm-2">
			<label>Ounces: <span id="qnty_lbl">5</span></label>
			<input id="qnty_inp" name="qnty" value="5" type="hidden">
			<div id="qnty_sli"></div>
		    </div>
		</div>

		<div class="row top10">
		    <div class="col-sm-2">
			<label>Comfort: <span id="qlty_lbl" >5</span></label>
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

	<?php require_once('feed_table.php'); ?>
	
	    
	<?php require_once('scripts.php'); ?>
	<script>

	 var qnty_sli = document.getElementById('qnty_sli');
	 noUiSlider.create(qnty_sli, {
	     start: [5],
	     connect: 'lower',
	     step: 0.5,
	     range: {
		 'min': 0,
		 'max': 8
	     }
	 });
	 qnty_sli.noUiSlider.on('update', function ( values, handle ) {
	     document.getElementById('qnty_lbl').innerHTML = Math.round(values[handle]*10)/10;
	     document.getElementById('qnty_inp').value = Math.round(values[handle]*10)/10;
	 });

	 var qlty_sli = document.getElementById('qlty_sli');
	 noUiSlider.create(qlty_sli, {
	     start: [5],
	     connect: 'lower',
	     range: {
		 'min': 0,
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

