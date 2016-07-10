<?php
require_once('connectvars.php');

$date = date('Y-m-d');
if (isset($_GET['date'])) $date = $_GET['date'];

try {
    $dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
    $sth = $dbh->prepare("SELECT eid, name, qnty, qlty, location, TIME_FORMAT(start,'%h:%i %p') starttime FROM event
                                  INNER JOIN baby USING (bid) INNER JOIN type USING (tid) INNER JOIN location USING (lid)
                                  WHERE type='sleep' AND start BETWEEN :start AND :end ORDER BY start");
    $endwindow = date('Y-m-d H:i:s',strtotime($date)+60*60*18-1);
    $startwindow = date('Y-m-d H:i:s',strtotime($date)-60*60*6);
    $sth->bindParam(':start',$startwindow);
    $sth->bindParam(':end',$endwindow);
    $sth->execute();
    while($row = $sth->fetch()) {
	$data[$row['name']][$row['starttime']] = $row;
	$totals[$row['name']] += $row['qnty'];
    }

    $sth = $dbh->prepare("SELECT name, ROUND(SUM(qnty),1) sum, DATE(DATE_ADD(start, INTERVAL 6 hour)) date FROM event
                          INNER JOIN baby USING (bid) INNER JOIN type USING (tid)
                          WHERE type='sleep' GROUP BY name,date ORDER BY date DESC LIMIT 14");
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
	    <table class="table-bordered table-condensed">
		<thead>
		    <tr>
			<th class="name"><?php echo $name; ?></th>
			<th>Hours</th>
			<th>Location</th>
			<th>Comfort</th>
			<th></th>
		    </tr>
		</thead>
		<tbody>
		    <?php foreach ($bdata as $time => $tdata) { ?>
			<tr>
			    <td><?php echo $time; ?></td>
			    <td><?php echo $tdata['qnty']; ?></td>
			    <td><?php echo $tdata['location']; ?></td>
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
    
