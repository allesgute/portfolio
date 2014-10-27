<?php 
session_start();
if(!isset($_SESSION['AdminID'])){
	header("Location: userlogin.php");
	exit();
}
else{
	session_id($_SESSION['AdminID']);
}

$pageTitle = "Mailing List";
include_once("header.php");
$conn = new mysqli('localhost', 'wp_eatery', 'password', 'wp_eatery');

// check connection
if ($conn->connect_error) 
{
	trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
else
{
	$tableName = "mailinglist";
	$sql = "SELECT * FROM $tableName";
	if($result = mysqli_query($conn, $sql))
	{
		echo "<div><table border='1' style='width:100%'><tr><th>Customer Name</th><th>Phone Number</th><th>Email Address</th></tr>";
		// Numeric array
		$rowNum = $result->num_rows;
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td style='text-align:center'>" . $row['customerName']. "</td><td style='text-align:center'>" . $row['phoneNumber'] . "</td><td style='text-align:center'>" . $row['emailAddress'] . "</td></tr>";
		}
		echo "</table>";
		echo "<br><p> Current SessionID is: " . session_id() . "</p>";
		echo "<br><p> Session AdminID is: " . $_SESSION['AdminID'] . "</p>";
		echo "<br><p> Last login time: " . $_SESSION['Lastlogin'] . "</p>";
		echo "<br><p style='text-align:center;'><a href='logout.php'>Logout</p></a><br>";
		echo "</div>";
		include_once("footer.php");
		// Free result set
		mysqli_free_result($result);
		
		mysqli_close($conn);
	}
	else{
		echo "Query failed!";
	}
}

?>