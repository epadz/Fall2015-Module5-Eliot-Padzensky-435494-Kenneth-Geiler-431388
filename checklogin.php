<?php
session_start();
require "config.php";

if(!isset($_POST['username']) || !isset($_POST['password'])){
	header("Location: login.php?error=1");
}

$un = strip_tags($_POST['username']);
$pw = strip_tags($_POST['password']);

//checks if the user exists
$stmt = $mysqli->prepare("select * from users where username=?");
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
