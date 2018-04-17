<?php
include "connect.php";
if(isset($_POST['submit'])){
	
	/*all the variables are defined accordingly in
		below  section of the script */
	
	$fName = $_POST['fname'];
	$lName = $_POST['lname'];
	$email = $_POST['email'];
	$userName = $_POST['uname'];
	$pass = $_POST['pass'];
	$rePass = $_POST['repass'];
	$gender = $_POST['gender'];
	$bornYear = $_POST['year'];
	$bornMonth = $_POST['month'];
	$bornDay = $_POST['day'];
	$agree = $_POST['agree_condition'];
	$date = "$bornYear"."-"."$bornMonth"."-"."$bornDay"; //date converted into the specific format as per the mySql
	
	//variable declaration ends
	
	$qryInsert = "INSERT INTO `user`
	(`firstName`, `lastName`, `email`, `userName`, `password`, `retypePassword`, `gender`, `dateOfBirth`)
	VALUES 
	('$fName', '$lName', '$email', '$userName', '$pass', '$rePass', '$gender', '$date');";
	
	$ok = mysql_query($qryInsert); //insert query executed
	if(!$ok){
		echo "data isnot inserted in the database".mysql_error();
			}
	else{
		header("Location: login.php");
	}
}// end of the isset of the signup 


?>