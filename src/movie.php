<html>
<header>
Video Store Database
</header>
<body>
<?php
ini_set('display_errors','On');
include 'storedInfo.php';
if ($_POST){
$name = $_POST['name'];
$category = $_POST['category'];
$length = $_POST['length'];
}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "rechstee-db",$myPassword, "rechstee-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
	}
	else {
		echo "Connection Worked!<br>";
	}
	
if (!$mysqli->query("DROP TABLE IF EXISTS vidstore") ||
!$mysqli->query("CREATE TABLE vidstore(id INT NOT NULL AUTO_INCREMENT, 
name VARCHAR(255) UNIQUE NOT NULL, 
category VARCHAR(255) NOT NULL,
length INT NOT NULL,
PRIMARY KEY( id ))") ||
!$mysqli->query("INSERT INTO vidstore(id, name, category, length) VALUES (1, 'TEST', 'TESTL', 4)")) {
	echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!($stmt = $mysqli->prepare("SELECT id, name, category, length FROM vidstore"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$out_id = NULL;
$out_name = NULL;
$out_category = NULL;
$out_length = NULL;
if (!$stmt->bind_result($out_id, $out_name, $out_category, $out_length)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}



while ($stmt->fetch()) {
    printf("id = %s (%s), name = %s (%s), category = %s(%s) length = %s(%s)\n", $out_id, gettype($out_id), $out_name, gettype($out_name), $out_category, gettype($out_category), $out_length, gettype($out_length));
}
if ($_POST){
	$name = $_POST['name'];
	$category = $_POST['category'];
	$length = $_POST['length'];
	echo $name, $category, $length;

	if(!$mysqli->query("INSERT INTO vidstore(name, category, length) VALUES ($name, $category, $length)")){
		echo "Couldn't insert";
	}
}

?>

<form method="post">
Name: <input type = "text" name="name"> <br>
Category: <input type = "text" name="category"> <br>
Length: <input type = "number" name="length"> <br>
<input type = "submit">

</form>
</body>
</html>