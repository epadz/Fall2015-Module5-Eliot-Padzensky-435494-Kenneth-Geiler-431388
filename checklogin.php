<?php
//require "config.php"
$mysqli = new mysqli("localhost", "wustl_inst", "wustl_pass", "module5");
if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}



session_start();

if(!isset($_POST['username']) || !isset($_POST['password'])){
	header("Location: login.php?error=1");
}
//NEED INPUT FILTERING HERE!

$un = $_POST['username'];
$pw = $_POST['password'];

//checks if the user exists
$stmt = $mysqli->prepare("select * from users where user_name=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('s', $un);
$stmt->execute();
$stmt->bind_result($qid, $qun, $qpw);
$stmt->store_result();

$stmt->fetch();
	
$isValid = false;
if($stmt->num_rows == 1){
	$isValid = 	crypt($pw, $qpw)==$qpw;
	//echo $isValid;
}
$stmt->close();
if($isValid){
	$_SESSION['uid'] = $qid;
	$_SESSION['username'] = $qun;
	header("Location: calendar.php");
}else{
	header("Location: login.php?error=0");
}

?>
