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
	
$dname = $_POST['name'];
echo $dname;

if ($dname != "deleteALL"){	
	if (!($stmt = $mysqli->query("DELETE FROM vidstore WHERE name='".$dname."'"))){
		echo "Failed to remove video";
	}
}

else if ($dname == "deleteALL"){
if (!$mysqli->query("DROP TABLE IF EXISTS vidstore") ||
!$mysqli->query("CREATE TABLE vidstore(id INT NOT NULL AUTO_INCREMENT, 
name VARCHAR(255) UNIQUE NOT NULL, 
category VARCHAR(255) NOT NULL,
length INT NOT NULL,
rented INT NOT NULL,
PRIMARY KEY( id ))") ){
		echo "Failed to remove videos";
	}
}



	


echo 'Click <a href="http://web.engr.oregonstate.edu/~rechstee/assignment4_2/movie.php">here<a/> to return to the table.';
?>