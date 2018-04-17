<?php
session_start();

	if (isset($_POST['comment_text']) && !empty($_POST['comment_text'])){
		require "connect.php";
		$comment_text = $_POST['comment_text'];
		$user = $_SESSION['userId'];
		$statusId = $_POST['statusId'];
	
	$sentTime = date("Y-m-d h:i:s .a");
	$meridian = (end(explode(".",strval($sentTime)))); //storing am or pm
	$posted =(current(explode(" ",strval($sentTime)))); //storing the posted date of status
	$posted = strtotime($posted); 
	$postedhr = (next(explode(" ",strval($sentTime))));	//storing the posted hour of the status


	//coding to send the message 
	$query = "INSERT IGNORE INTO `comments` 
		(`comment_text`, `comment_date`, `comment_hrs`, `comment_am_pm`, `userId`, `statusId`)
		VALUES 
		('$comment_text', '$posted', '$postedhr', '$meridian', '$user', '$statusId');";
	
	$a = mysql_query($query); //successfully inserted the message records...

	if($a){
 		header("Location: profile.php");
	}
	else{
		echo mysql_error();
	}

	}//end of isset['commment']
	else{
		header("Location: profile.php");
	}//end of the else when comment is not provided and only button is clicked 

	if (isset($_POST['like'])) {
		require "connect.php";
		$statusId = $_POST['statusId'];

		$query = "SELECT total_likes FROM status WHERE statusId='$statusId';";
		$a = mysql_query($query);
		if(!$a){
			die(mysql_error());
					}
		while($row = mysql_fetch_assoc($a)){
			$total_likes = $row['total_likes'];
			}//end of while 
		++$total_likes;
		$query1 = "UPDATE status
					 SET total_likes='$total_likes' 
					 WHERE statusId ='$statusId';";
		$b = mysql_query($query1);
		if(!$b){
			die(mysql_error());
		}
	}//end of isset when like is pressed 


?>