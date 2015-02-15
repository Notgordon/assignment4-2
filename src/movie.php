<html>
<header>
Video Store Database
</header>
<body>
<table border = 1>
<thead border = 2>
<tr>
	<th> Name </th>
	<th> Category </th>
	<th> Length </th>
	<th> Rented </th>
</tr>
</thead>
<tbody>
<?php


ini_set('display_errors','On');
include 'storedInfo.php';



$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "rechstee-db",$myPassword, "rechstee-db");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
	}
else {
		echo "Connection Worked!<br>";
	}

	
$sql = "SELECT name, category, length, rented FROM vidstore";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
     // output data for each row
     while($row = $result->fetch_assoc()) {
		if ( $row["rented"] == 1 )
		{
			$r = "Checked In";
			//$stat = "rent";
		}
		else if ( $row["rented"] == 0)
		{
			$r = "Checked Out";
			//$stat = "return";
		}
         echo "<tr>" . "<td>". $row["name"] . "<td>". $row["category"] . "<td> " . $row["length"] . "<td> " . $r;
		
		echo "<td><form method=\"POST\" action=\"delete.php\">";
		echo "<input type=\"hidden\" name=\"name\" value=\"".$row["name"]."\">";
		echo "<input type=\"submit\" value=\"delete\">";
		echo "</form></td>";
		
		echo "<td><form method=\"POST\" action=\"status.php\">";
		echo "<input type=\"hidden\" name=\"name\" value=\"".$row["name"]."\">";
		echo "<input type=\"hidden\" name=\"rent\" value=\"".$row["rented"]."\">";
		echo "<input type=\"submit\" value=\"rent/return\">";
		echo "</form></td>";
	}
}

/*
if (!$mysqli->query("DROP TABLE IF EXISTS vidstore") ||
!$mysqli->query("CREATE TABLE vidstore(id INT NOT NULL AUTO_INCREMENT, 
name VARCHAR(255) UNIQUE NOT NULL, 
category VARCHAR(255) NOT NULL,
length INT NOT NULL,
rented INT NOT NULL,
PRIMARY KEY( id ))") ) {
	echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
*/




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
    //printf("id = %s (%s), name = %s (%s), category = %s(%s) length = %s(%s)\n", $out_id, gettype($out_id), $out_name, gettype($out_name), $out_category, gettype($out_category), $out_length, gettype($out_length));
	
}



?>
</tbody>
</table>
<form method="post" action ="add.php">
Name: <input type = "text" name="name"> <br>
Category: <select name="category">
			<option value="action">Action</option>
			<option value="drama">Drama</option>
			<option value="comedy">Comedy</option>
			<option value="romantic">Romantic</option>
		  </select> <br>
Length: <input type = "number" name="length"> <br> 
<input type = "submit">

</form>

<form method="post" action = "delete.php">
	<input type = "hidden" name="name" value="deleteALL">
	<input type = "submit" value = "Delete All Videos">
</form>
</body>
</html>