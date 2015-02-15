<?php
$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filePath = implode('/',$filePath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	header("Location: {$redirect}/movie.php", true);

	
ini_set('display_errors','On');
include 'storedInfo.php';
	
	
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "rechstee-db",$myPassword, "rechstee-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
	}
else {
		echo "Connection Worked!<br>";
	}

	$name = $_POST['name'];
	$category = $_POST['category'];
	$length = $_POST['length'];
	$rented = 1;
	
	if(!$mysqli->query("INSERT INTO vidstore(name, category, length, rented) VALUES ('".$name."', '".$category."', ".$length.", ".$rented.")")){
		echo " couldn't be inserted" . '<br>';
	}
	
?>