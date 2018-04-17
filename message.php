<?php
session_start();
$user = $_SESSION['userId'];
$userName = $_SESSION['userName'];
include "connect.php";
$_SESSION['lastMessageId'] = null;

if(isset($_GET['name'])){

 /*this block will update the session value whenever new name is clicked for the message sending..... */ 

	$_SESSION['friend_name'] = $_GET['name'];
	$_SESSION['friendId']=$_GET['fId'];
}

if(isset($_SESSION['friendId']) && isset($_SESSION['friend_name'])){
$friendId = $_SESSION['friendId'];
$name = $_SESSION['friend_name'];//friend name whose name is clicked and store in the $name 
}

?>
<html>
<head>
	<title><?php echo $userName;  ?> Message zone</title>
	<link rel="stylesheet" type="text/css" href="message_styles.css"/>
	<link rel="stylesheet" type="text/css" href="navigation_style.css"/>
	<link rel="stylesheet" type="text/css" href="login_send_transition.css"/>
</head>
<body>
		<?php include "navigationPane.php"; ?>

	<div id="message_conatainer">
		<div id="onlinesection">
			<div id="friends_list_heading_div"> <?php //changed ?>
					<p id="online">Friends&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					active</p>
					<hr size="3px" color="#aaa"/>
					<hr size="15px" color="#ff9999"/>
					<hr size="3px" color="#aaa"/>
					<div id="friends">	
							<?php 
									include "get_friend_list_in_online_view_div.php";	?>
						</div><!--friends div ends-->
				</div><!--friends_list_heading_div div ends-->
		</div><!--online section div ends-->
				 <?php 
				 if(isset($_SESSION['friendId']) && isset($_SESSION['friend_name'])){
				 	include "chatSection.php";}
				 	else{
				 		include "startConversationChatSection.php";
				 		} ?>
		</div> <!-- message container div ends here-->
</body>
</html>