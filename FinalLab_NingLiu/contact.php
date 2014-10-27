
<?php 
	$pageTitle = "Contact Us";
	include_once('header.php');
    include_once('password.php');
	$hasError = false;
	$result = "";
	$fileResult = "";
	
	if(isset($_POST["customerName"]))
	{
		if(!empty($_POST["customerName"])){
			$customerName = $_POST["customerName"];
			$errCustomerName = "";
		}
		else{
			$customerName = "";
			$hasError = true;
			$errCustomerName = "Please enter customer name.";
		}
	}
	else{
		$customerName = "";
		$errCustomerName = "";
	}
	if(isset($_POST["phoneNumber"]))
	{
		if(!empty($_POST["phoneNumber"])){
			$phoneNumber = $_POST["phoneNumber"];
			$errPhoneNumber = "";
		}
		else{
			$phoneNumber = "";
			$hasError = true;
			$errPhoneNumber = "Please enter phone number.";
		}
	}
	else{
		$phoneNumber = "";
		$errPhoneNumber = "";
	}
	if(isset($_POST["emailAddress"]))
	{
		if(!empty($_POST["emailAddress"])){
			$emailAddress = $_POST["emailAddress"];
			$emailAddress = password_hash($emailAddress, PASSWORD_DEFAULT);
			$errEmailAddress = "";
		}
		else{
			$emailAddress = "";
			$hasError = true;
			$errEmailAddress = "Please enter email address.";
		}
	}
	else{
		$emailAddress = "";
		$errEmailAddress = "";
	}
	if(isset($_POST["customerName"]))
	{
		if(isset($_POST["referral"])){
			$referral = $_POST["referral"];
			$errReferral = "";
		}
		else{
			$errReferral = "";
			$hasError = true;
			$errReferral = "Please select a referral.";
		}
	}
	else{
		$referral = "";
		$errReferral = "";
	}

	if(isset($_POST["customerName"]) && !$hasError){
		$conn = new mysqli('localhost', 'wp_eatery', 'password', 'wp_eatery');
		
		// check connection
		if ($conn->connect_error)
		{
			trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
			$result = "Database connection failed.";
			mysqli_close($conn);
			include_once("footer.php");
			exit(1);
		}
		else{
			
				$tableName = "mailinglist";
				$sql = "INSERT INTO " . $tableName . " (customerName, phoneNumber, emailAddress, referrer) VALUES ('" . $customerName . "','"
						. $phoneNumber . "','" . $emailAddress . "','" . $referral . "');";
				//echo $sql;
				if(mysqli_query($conn, $sql))
				{
					$result = "Your data was saved successfully.";
				}
				else
				{
					$result = "Sorry, there was an error saving your data.";
				}
				mysqli_close($conn);
			}
		}
?>
<?php
if (isset ( $_POST ['btnSubmit'] ) && ($_FILES ["file"] ["size"] > 0)) {
	if ($_FILES ["file"] ["error"] > 0) {
		echo "Error: " . $_FILES ["file"] ["error"] . "<br>";
	} else {
/* 
		echo "Upload: " . $_FILES ["file"] ["name"] . "<br>";
		echo "Type: " . $_FILES ["file"] ["type"] . "<br>";
		echo "Size: " . ($_FILES ["file"] ["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES ["file"] ["tmp_name"]; 
*/
		
		if (file_exists("files/" . $_FILES["file"]["name"]))
		{
			$fileResult = $_FILES["file"]["name"] . " already exists. ";
		}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"files/" . $_FILES["file"]["name"]);
			$fileResult = "Stored in: " . "files/" . $_FILES["file"]["name"];
		}
	}
}
?>
<div id="content" class="clearfix">
	<aside>
		<h2>Mailing Address</h2>
		<h3>
			1385 Woodroffe Ave<br> Ottawa, ON K4C1A4
		</h3>
		<h2>Phone Number</h2>
		<h3>(613)727-4723</h3>
		<h2>Fax Number</h2>
		<h3>(613)555-1212</h3>
		<h2>Email Address</h2>
		<h3>info@wpeatery.com</h3>
	</aside>
	<div class="main">
		<h1>Sign up for our newsletter</h1>
		<p>Please fill out the following form to be kept up to date with news,
			specials, and promotions from the WP eatery!</p>
		<form name="frmNewsletter" id="frmNewsletter" method="post"
			action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
			enctype="multipart/form-data">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="customerName" id="customerName"
						size="40" value="<?php echo htmlspecialchars($customerName); ?>">
						<span id="errCustomerName" class="errinfo" style="color: #FF0000;">
					<?php echo $errCustomerName;?>
                     </span></td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td><input type="text" name="phoneNumber" id="phoneNumber"
						size="40" value="<?php echo htmlspecialchars($phoneNumber); ?>"> <span
						id="errPhoneNumber" class="errinfo" style="color: #FF0000;">
                                <?php echo $errPhoneNumber; ?>
	                 </span></td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td><input type="text" name="emailAddress" id="emailAddress"
						size="40" value="<?php echo htmlentities($emailAddress); ?>"> <span
						id="errEmailAddress" class="errinfo" style="color: #FF0000">
                           <?php echo $errEmailAddress;?>
	                 </span></td>
				</tr>
				<tr>
					<td>How did you hear<br> about us?
					</td>
					<td>Newspaper<input type="radio" name="referral"
						id="referralNewspaper" value="newspaper"> Radio<input type="radio"
						name='referral' id='referralRadio' value='radio'> TV<input
						type='radio' name='referral' id='referralTV' value='TV'> Other<input
						type='radio' name='referral' id='referralOther' value='other'> <span
						id="errReferral" class="errinfo" style="color: #FF0000;">
                                    <?php echo $errReferral;?></span></td>
				</tr>
				<tr>
					<td><label for="file">Filename:</label></td>
					<td><input type="file" name="file" id="file">
					<span style="color: #0000FF;"><?php echo $fileResult;?></span></td>
				</tr>
				<tr>
					<td colspan='100%'><input type='submit' name='btnSubmit'
						id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset'
						name="btnReset" id="btnReset" value="Reset Form"
						onClick="location.reload()"> <span style="color: #0000FF;">
                             <?php echo $result; ?>
                        </span></td>
				</tr>
			</table>
		</form>
	</div>
	<!-- End Main -->
</div>
<!-- End Content -->
<?php 

?>
<?php include_once('footer.php');?>
