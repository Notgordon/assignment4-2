<?php 
ini_set('display_errors','On');
include 'storedInfo.php';

$dname = $_POST['name'];
echo $dname;

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "rechstee-db",$myPassword, "rechstee-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
	}
else {
		echo "Connection Worked!<br>";
	}
	

if (!($stmt = $mysqli->query("DELETE FROM vidstore WHERE name='".$dname."'")))
{
	echo "Failed to remove video";
}



	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filePath = implode('/',$filePath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	header("Location: {$redirect}/movie.php", true);

?>