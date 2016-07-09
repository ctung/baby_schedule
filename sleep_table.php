<?php
require_once('connectvars.php');

try {
    $dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
    $sth = $dbh->prepare("SELECT eid, name, qnty, qlty, location, TIME_FORMAT(start,'%h:%i %p') starttime FROM event
                                  INNER JOIN baby USING (bid) INNER JOIN type USING (tid) INNER JOIN location USING (lid)
                                  WHERE type='sleep' AND start BETWEEN :start AND :end ORDER BY start");
    $endwindow = date('Y-m-d H:i:s',strtotime('6pm'));
    $startwindow = date('Y-m-d H:i:s',strtotime('Yesterday 6pm'));
    $sth->bindParam(':start',$startwindow);
    $sth->bindParam(':end',$endwindow);
    $sth->execute();
    while($row = $sth->fetch()) {
	$data[$row['name']][$row['starttime']] = $row;
	$totals[$row['name']] += $row['qnty'];
    }
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
	    <table class="table-bordered">
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

