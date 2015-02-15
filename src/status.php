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



	$sname = $_POST['name'];
	$rent = $_POST['rent'];
	
	if ( $rent == 1 ){
		if (!($stmt = $mysqli->query("UPDATE vidstore SET rented = 0 WHERE name = '".$sname."'"))){
			echo "could not rent out the movie";
		}
	}
	
	if ( $rent == 0 ){
	if (!($stmt = $mysqli->query("UPDATE vidstore SET rented = 1 WHERE name = '".$sname."'"))){
			echo "could not rent out the movie";
		}
	}
	
?>