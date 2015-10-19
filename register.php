<?php
//require "config.php";
$mysqli = new mysqli("localhost", "wustl_inst", "wustl_pass", "module5");
if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}


session_start();
if(!isset($_POST['username']) || !isset($_POST['password'])){
	header("Location: ../login.php?error=1");
}
//NEED INPUT FILTERING HERE!
$un = $_POST['username'];
$pw = $_POST['password'];
//checks if the user exists. if not, then create the account
if(!isUser($un)){
	$cpt_pwd = crypt($pw);
	
	$stmt = $mysqli->prepare("insert into users (user_name, password) values ( ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	 
	$stmt->bind_param('ss', $un, $cpt_pwd);	 
	$stmt->execute();	 
	$stmt->close();
	
	$ud = checkLogin($un, $pw);
	if(isset($ud)){
		$_SESSION['uid'] = $ud['uid'];
		$_SESSION['username'] = $ud['un'];
		header("Location: ../calender.js");
	}else{
		header("Location: ../login.php?error=3");
	}
}else{
	header("Location: ../login.php?error=2");
}
 
?>
