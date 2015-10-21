<?php
$mysqli = new mysqli("localhost", "epadz", "epadz", "module5");
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
