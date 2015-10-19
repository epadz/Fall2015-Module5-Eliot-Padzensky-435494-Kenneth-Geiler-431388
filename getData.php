<?php
/*handles AJAX data requests*/
session_start();
/*if(!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_POST['month'])){
	header("Location: login.php?error=1");
}*/
$uid = $_SESSION['uid'];
$username = $_SESSION['username'];
$month = $_GET['month'];

//database connection info
$mysqli = new mysqli("localhost", "epadz", "epadz", "module5");

//query the events where month = month and uid= uid
$stmt = $mysqli->prepare("select * from events where userID=? and month=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ii', intval($uid), intval($month));
$stmt->execute();

//receive data as  associative array
$events = array();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
	array_push($events, $row);
}	 
$stmt->close();
$json = json_encode($events);
echo $json . "";
?>