<?php
require_once('connectvars.php');

//var_dump($_POST);
//return;

if(isset($_POST['event'])) {
    $start = strtotime($_POST['start']);
    $datetime = date('Y-m-d H:i:s',$start);
    $qnty = $_POST['qnty'];
    if(isset($_POST['end'])) { // sleep event
	$end = strtotime($_POST['end']);
	$qnty = round(($end - $start)*10/(60*60))/10;
    }
    
    try {
	$dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
	$sth = $dbh->prepare("INSERT INTO event (bid,tid,lid,start,qnty,qlty) VALUES (
(SELECT bid FROM baby WHERE name=?),
(SELECT tid FROM type WHERE type=?),
(SELECT lid FROM location WHERE location=?),?,?,?)
ON DUPLICATE KEY UPDATE qnty=VALUES(qnty), qlty=VALUES(qlty)");
	$sth->bindParam(1,$_POST['baby']);
	$sth->bindParam(2,$_POST['event']);
	$sth->bindParam(3,$_POST['location']);
	$sth->bindParam(4,$datetime);
	$sth->bindParam(5,$qnty);
	$sth->bindParam(6,$_POST['qlty']);
	$sth->execute();
	$sth = null;
	$dbh = null;
    } catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
    }
    
    //echo "INSERT INTO event (bid,tid,start,qnty,qlty) VALUES ((SELECT bid FROM baby WHERE name='".$_POST['baby'].
    //"'),(SELECT tid FROM type WHERE type='".$_POST['event']."'),'$datetime',".$_POST['qnty'].",".$_POST['qlty'].")";
} else if (isset($_POST['delete'])) {
    try {
	$dbh = new PDO('mysql:host=localhost;dbname='. DBNAME, USER, PASS);
	$sth = $dbh->prepare("DELETE FROM event WHERE eid=?");
	$sth->bindParam(1,$_POST['delete']);
	$sth->execute();
	$sth = null;
	$dbh = null;
    } catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
    }
}
?>

