<?php
session_start();
$user = $_SESSION['userId'];
$userName = $_SESSION['userName'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invitation list</title>
<link rel="stylesheet" type="text/css" href="invitation_style.css"/>
<link rel="stylesheet" type="text/css" href="profile_style.css"/>
<link rel="stylesheet" type="text/css" href="navigation_style.css"/>
</head>
<body>
<?php
	include "navigationPane.php";
?>

		
		<div id="container">		
			<div id="newsfeed">
				<h1>Friendship Invitation</h1>
				<br/>
		
			<div id="heading">
					<div class="topic"><strong>S.N.</strong></div>
					<div class="topic"><strong>Friend Name</strong></div>
					<div class="topic"><strong>Friend Photo</strong></div>
			</div> <!-- heading div ends here -->

	<?php
		include "connect.php";
		
		$query1 = "SELECT request_from FROM `user` WHERE userId = '$user';";
		$b = mysql_query($query1);
		while($row = mysql_fetch_assoc($b)){
				$friendsAre = $row['request_from'];
		}

		$friendId_list = explode(",",$friendsAre);
		foreach($friendId_list as $id){
			 fetchData($id,$userName);
		}

		//now we define the function that will fetch the data of the friend who has 	// send invitation 
		function fetchData($id,$userName){
			echo "<hr/>";
			$query = "SELECT firstName,lastName 
								FROM user WHERE userId ='$id'";
			$c = mysql_query($query);
			while($row = mysql_fetch_assoc($c)){
				$fullName = $row['firstName']."<br/>".$row['lastName'];

			}
			echo "<div id='section'>
					<div class='data'>
						<img id='envelope_icon' src='images/envelope.jpg'/></div>
					
					<div class='data' id ='name'>$fullName</div>
					
					<div class='data'>
						<img id ='friend_image' src ='getImage.php?id=$id'/></div>
					<div class='data' id ='choice_button'>
							<form name ='f' method='POST' action='invitation_process.php'>
									<input type='hidden' name='friend_is' 			value='$id'/>
									<input type ='submit' value='Accept' name='accepted'/>
									&nbsp;&nbsp;&nbsp;
									<input type ='submit' value ='Unknown' name='ignored'/>
							</form>
					</div>
					
					<div class='data' id ='invite_message'><p>Hi $userName,<br/>&nbsp;&nbsp;&nbsp;I think you are such a cool person and fun to be with! If you may, I would like to be your friend.<br/>Thanks! </div>
			</div> "; //end of  the echo 
		}//end of the fetch data function ...
			?>
		

	</div><!-- container div ends here -->

							
			</div> <!--	newsfeeed div ends-->
			<div id="leftsidebar">
			</div> <!--	leftsidebar div ends-->
			<div id="rightsidebar">
				<div id="friends">
					<p id="online">Friends&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					active</p>
					<hr size="3px" color="#aaa"/>
					<hr size="15px" color="#ff9999"/>
					<hr size="3px" color="#aaa"/>
				</div><!--friends div ends-->
			</div>
		</div> <!--	container div ends-->


</body>
</html>