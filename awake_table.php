<?php
require_once('connectvars.php');

try {
    $dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
    $sth = $dbh->prepare("SELECT eid, name, TIME_FORMAT(start,'%h:%i %p') starttime FROM event
                                  INNER JOIN baby USING (bid) INNER JOIN type USING (tid)
                                  WHERE type='awake' AND DATE(start) = :date ORDER BY start");
    $sth->bindParam(':date',date('Y-m-d'));
    $sth->execute();
    while($row = $sth->fetch()) {
	$data[$row['name']][$row['starttime']] = $row;
	$totals[$row['name']] += 1;
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
			<th></th>
		    </tr>
		</thead>
		<tbody>
		    <?php foreach ($bdata as $time => $tdata) { ?>
			<tr>
			    <td><?php echo $time; ?></td>
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
		    </tr>
		</tfoot>
	    </table>
	</div>
    <?php } ?>
</form>

