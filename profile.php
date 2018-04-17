<?php
session_start();
$user = $_SESSION['userId'];
$userName = $_SESSION['userName'];
$_SESSION['key']= null;
 include "connect.php";

//check if there is any invitation 
$query  = "SELECT user_notification FROM `user` WHERE userId = '$user';";
		$a = mysql_query($query);
		while($row = mysql_fetch_assoc($a)){
				$value = $row['user_notification'];
		}// end of while loop 

if($value == 1){
	header("Location: invitationList.php");
}
?>
<html>
<head>
		<title>profile view</title>
			<link rel ="stylesheet" type="text/css" href="profile_style.css"/>
			<link rel ="stylesheet" type="text/css" href="navigation_style.css"/>
</head>
<body>
	<?php include "navigationPane.php"; ?>
		
		<div id="container">		
			<div id="newsfeed">
					<?php include "getFriendsUpdate.php"; ?>
			</div> <!--	newsfeeed div ends-->
			<div id="leftsidebar">
			</div> <!--	leftsidebar div ends-->
			<div id="rightsidebar">
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
			</div> <!--rightsidebar div ends-->
		</div> <!--	container div ends-->
		</body>
</html>