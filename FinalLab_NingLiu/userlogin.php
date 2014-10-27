<?php 
session_start();
$pageTitle = "Login";
include("header.php");
?>
<?php
$errUserName = "";
$errPassword = "";
$hasError = false;
$result = "";
 
if(isset($_POST['username'])){
	$username = $_POST['username'];
	if(empty($username)){
		$errUserName = "Please enter user name.";
		$hasError = true;	
	}
}
if(isset($_POST['password'])){
	$password = $_POST['password'];
	if(empty($password)){
		$errPassword = "Please enter password.";
		$hasError = true;	
	}
}
if (! empty( $username ) && ! empty( $password ) && !$hasError) {
	$conn = new mysqli ( 'localhost', 'wp_eatery', 'password', 'wp_eatery' );
	
	// check connection
	if ($conn->connect_error) {
		trigger_error( 'Database connection failed: ' . $conn->connect_error, E_USER_ERROR );
		$result = "Database connection failed.";
		mysqli_close( $conn );
		include_once("footer.php");
		exit( 1 );
	}
	
	$sql = "SELECT * FROM adminusers WHERE Username = '$username';";
	$lastLogin = date("Y-m-d H:i:s");
	
	$sqlUpdate = "UPDATE adminusers SET Lastlogin = '$lastLogin' WHERE Username = '$username';";

	if ($qResult = $conn->query( $sql )) {

		if ($rows = $qResult->fetch_assoc()) {
			if ($rows['Password'] == $password){			
				$uResult = $conn->query($sqlUpdate);
				$_SESSION['AdminID'] = $rows['AdminID'];
				$_SESSION['Lastlogin'] = $rows['Lastlogin'];
				header("Location: mailing_list.php");
				exit();
			}
			else
				$result = "Incorrect password, please try again.";
		} else
			$result = "Invalid user name, please try again.";
		
		$qResult->free ();
	} else {
		$result = "Username does not exist. Please try again.";
	}
	$conn->close();
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<table border="0" align="center">
		<tr>
			<td><h2>Username:</h2></td>
			<td><input type="text" name="username" maxlength="60"> <span
				id="errUserName" style="color: #FF0000;"><?php echo $errUserName;?></span>
			</td>
		</tr>
		<tr>
			<td><h2>Password:</h2></td>
			<td><input type="password" name="password" maxlength="10"> <span
				id="errPassword" style="color: #FF0000;"><?php echo $errPassword;?></span>
			</td>
		</tr>
		<tr>
			<th colspan=2><input type="submit" name="submit" value="Login"> <span
				id="result" style="color: #0000FF;"><?php echo $result;?></span></th>
		</tr>
	</table>
</form>
<?php include('footer.php');?>