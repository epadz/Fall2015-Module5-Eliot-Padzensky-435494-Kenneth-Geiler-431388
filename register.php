<?php
session_start();
require "config.php";

if(!isset($_POST['username']) || !isset($_POST['password'])){
	header("Location: login.php?error=1");
}
$un = strip_tags($_POST['username']);
$pw = strip_tags($_POST['password']);
//checks if the user exists. if not, then create the account
if(!isUser($un)){
	$cpt_pwd = crypt($pw);
	
	$stmt = $mysqli->prepare("insert into users (username, password) values ( ?, ?)");
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
		header("Location: calendar.php");
	}else{
		header("Location: login.php?error=3");
	}
}else{
	header("Location: login.php?error=2");
}

function isUser($u){
	global $mysqli;
	$stmt = $mysqli->prepare("select username from users where username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $u);
	$stmt->execute();
	$stmt->store_result();
    $num = $stmt->num_rows;
	$stmt->close();
	return ($num == 1);
}

//checks a log in
//parameters are username and password
//returns if login is correct, it returns an associative array of the users information including id, first name, last name and username. If login fails, NULL is returned
function checkLogin($username, $password){
	global $mysqli;
	$stmt = $mysqli->prepare("select * from users where username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($qid, $qun, $qpw);
	$stmt->store_result();
	
	$stmt->fetch();
		
	$isValid = false;
    if($stmt->num_rows == 1){
		$isValid = 	crypt($password, $qpw)==$qpw;
		//echo $isValid;
	}
	$stmt->close();
	
	if($isValid){
		$results = array(
			"uid" => $qid,
			"un" => $qun
		);
		return $results;
	}
	return NULL;
}
?>
