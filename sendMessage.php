<?php  
session_start();

	include "connect.php";
	$user = $_SESSION['userId'];	
	$message = $_POST['text_msg'];
	$friendId = $_POST['friendId'];
	$messageId = $_SESSION['messageId'];
	$sentTime = date("Y-m-d h:i:s .a");
	$meridian = (end(explode(".",strval($sentTime)))); //storing am or pm
	$posted =(current(explode(" ",strval($sentTime)))); //storing the posted date of status 
	$postedhr = (next(explode(" ",strval($sentTime))));	//storing the posted hour of the status


	//coding to send the message 
	$query = "INSERT INTO `messages`
			(`description`, `userId`,`sentDate`, `sentHour`, `am_pm`,`friendId`) 
						VALUES 
			('$message', '$user','$posted','$postedhr', '$meridian','$friendId');";
	
	$a = mysql_query($query,$connect); //successfully inserted the message records...

	$_SESSION['lastMessageId'] = mysql_insert_id(); //id of new record
	
/*	$fetchMessageIdQuery = mysql_query("SELECT messageId FROM messages 
	WHERE userId ='$user';",$connect);
	
	while($data = mysql_fetch_array($fetchMessageIdQuery)){
								$_SESSION['messageId'] = $data['messageId'];
									// storing the messaage Id in the session variable 
		}// end of while loop
		//echo //$_SESSION['messageId']; 
		//echo $user; */
	
	header("Location: message.php");
		
?>