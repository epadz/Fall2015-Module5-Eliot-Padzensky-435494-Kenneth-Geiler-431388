<?php
//handles the creation, deletion and editing of an event.
//one of the get/ post values has to be the action. 1 = create 2 = edit 3 = delete
session_start();
require "config.php";
if(!isset($_SESSION['uid']) || !isset($_POST['uid']) || !isset($_POST['a'])){
	echo 0;
}else{
	if($_POST['a'] == '0'){
		$stmt = $mysqli->prepare("insert into events (userID, title, note, year, month, day, hour, minute, ampm) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param('issiiiiis', $_POST['uid'], $_POST['neT'], $_POST['neN'], $_POST['neDY'], $_POST['neDM'], $_POST['neDD'], $_POST['neH'], $_POST['neM'], $_POST['neA']);
		$qSuccess = $stmt->execute();
		echo $qSuccess;
		$stmt->close();
	}else if($_POST['a'] == '1'){
		$stmt = $mysqli->prepare("update events set title=?, note=?, year=?, month=?, day=?, hour=?, minute=?, ampm=? where eventID=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param('ssiiiiisi', $_POST['neT'], $_POST['neN'], $_POST['neDY'], $_POST['neDM'], $_POST['neDD'], $_POST['neH'], $_POST['neM'], $_POST['neA'], $_POST['eid']);
		$qSuccess = $stmt->execute();
		echo $qSuccess;
		$stmt->close();
	}else if($_POST['a'] == '2'){
		$stmt = $mysqli->prepare("delete from events where eventID=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param('i', $_POST['eid']);
		$qSuccess = $stmt->execute();
		echo $qSuccess;
		$stmt->close();
	}
}

?>