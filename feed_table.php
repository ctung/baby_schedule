<?php
require_once('connectvars.php');

$date = date('Y-m-d');
if (isset($_GET['date'])) $date = $_GET['date'];

try {
    $dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
    $sth = $dbh->prepare("SELECT eid, name, qnty, qlty, TIME_FORMAT(start,'%h:%i %p') starttime FROM event
                                  INNER JOIN baby USING (bid) INNER JOIN type USING (tid)
                                  WHERE type='feed' AND DATE(start) = :date ORDER BY start");
    $sth->bindParam(':date',$date);
    $sth->execute();
    while($row = $sth->fetch()) {
	$data[$row['name']][$row['starttime']] = $row;
	$totals[$row['name']] += $row['qnty'];
    }

    $sth = $dbh->prepare("SELECT name, SUM(qnty) sum, DATE(start) date FROM event
                          INNER JOIN baby USING (bid) INNER JOIN type USING (tid)
                          WHERE type='feed' GROUP BY name,date ORDER BY date DESC LIMIT 7");
    $sth->execute();
    while($row = $sth->fetch()) 
	$daily[$row['date']][$row['name']] = $row;
    
    $sth = null;
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

<form method="post">
<input type="hidden" id="eid" name="delete">
<?php foreach ($data as $name => $bdata) { ?>
    <div class="container top20">
	<label><?php echo $date ?></label>
	<table class="table-bordered">
	    <thead>
		<tr>
		    <th class="name"><?php echo $name; ?></th>
		    <th>Ounces</th>
		    <th>Comfort</th>
		    <th></th>
		</tr>
	    </thead>
	    <tbody>
		<?php foreach ($bdata as $time => $tdata) { ?>
		    <tr>
			<td><?php echo $time; ?></td>
			<td><?php echo $tdata['qnty']; ?></td>
			<td><?php echo $tdata['qlty']; ?></td>
			<td>
			    <div class="eid display-none"><?php echo $tdata['eid']; ?></div>
			    <div class="btn btn-danger delete-btn btn-xs">
				<span class="glyphicon glyphicon-remove"></span>
			    </div>
			</td>
		    </tr>
		<?php } ?>
	    </tbody>
	    <tfoot>
		<tr>
		    <th>Total</th>
		    <th><?php echo $totals[$name]; ?></th>
		    <th></th>
		    <th></th>
		</tr>
	    </tfoot>
	</table>
    </div>
<?php } ?>
</form>

<div class="container top20">
    <table class="table-bordered">
	<thead>
	    <tr>
		<th class="date">Date</th>
		<th>Charlotte</th>
		<th>Sophia</th>
	    </tr>
	</thead>
	<tbody>
	    <?php foreach ($daily as $bdate => $bdata) { ?>
		<?php $url = $_SERVER['PHP_SELF']."?date=$bdate"; ?>
		<tr>
		    <td><?php echo "<a href='$url'>$bdate</a>"; ?></td>
		    <td><?php echo "<a href='$url'>".$bdata['Charlotte']['sum']."</a>"; ?></td>
			<td><?php echo "<a href='$url'>".$bdata['Sophia']['sum']."</a>"; ?></td>
		</tr>
	    <?php } ?>
	</tbody>
    </table>
</div>
    
