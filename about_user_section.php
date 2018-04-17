<?php
if(!isset($_SESSION['userName']))
	$_SESSION['userName'] = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

<style type="text/css">
	.heading_side, .information_side, .editing_option_side{
			float:  left;
			padding: 5px;
		text-align: left;
	}
	.heading_side{
		width: 25%;
		font-size: 20px;
		font-weight: bold;
		border-bottom: 13px outset #fcfcfc;
	}
	.information_side{
		width: 40%;
	}
	.editing_option_side{
		margin-top: 3px;
		border-top: 1px solid #fafafa;
		width: 15%;
		border-left: 18px solid #923333;
		border-top-left-radius: 15px;
		border-bottom-right-radius: 28px;
		border-bottom: 13px outset #fefefe;
	}
	.outer_container{
		margin-top: 14px;
	}

</style>
</head>
<body>
	<div class="outer_container">
	<!--	<div class="heading_side">
		</div><!--heading_side div ends here-->
		
	<!--	<div class="information_side">
		</div><!--information div ends here-->

<!--		<div class="editing_option_side">
		</div><!--editing option side div ends here-->
	<?php
		$query = "SELECT u.userId,firstName, lastName, email, userName, gender, dateOfBirth, COUNT(um.friendId)AS total_friends 
			FROM  user AS u
			LEFT JOIN user_makes_friends 
			 AS um on u.userId = um.userId 
			WHERE u.userId = '$user'";
		$exec_query = mysql_query($query);
		if(!$exec_query)
				die(mysql_error);

		function user_info_heading_side($heading){
			echo "<div class='heading_side'>
			$heading
					</div>"; //--heading_side div ends here--
		} //heading side function ends

		function user_information_side($data){
		echo "<div class='information_side'>
		$data
		</div>";//--information div ends here-->
		}	
		function user_info_editing_option_side($title){
			echo "<div class='editing_option_side'>
				<a href='#' title='$title'>Edit&nbsp;&nbsp;&nbsp;<img style='height: 20px; width: 20px;' src='images/edit_user_data_icon.jpg'/>
				</a>
			</div>"; //--editing option side div ends here-->";
		}

		while ($row = mysql_fetch_assoc($exec_query)) {
				$fullName = $row['firstName']. " ".$row['lastName'];
				user_info_heading_side("Full Name: ");				
				 user_information_side($fullName);
				 user_info_editing_option_side("edit fullname");
				$email = $row['email'];
				user_info_heading_side("Email");
				 user_information_side($email);
				 user_info_editing_option_side("edit email-id");
				$userName = $row['userName'];
				user_info_heading_side("User-Name : ");
				 user_information_side($userName);
				 user_info_editing_option_side("edit user-name");
				$_SESSION['userName']	= $userName;
				$gender = $row['gender'];
				user_info_heading_side("Gender: ");
				 user_information_side($gender);
				 user_info_editing_option_side("edit gender");
				$dob = $row['dateOfBirth'];
				$d = strtotime($dob); //changing the string format to date format 
				$dob =date("Y-F-d(D)",$d); 
				user_info_heading_side("Date-of-Birth: ");
				 user_information_side($dob);
				 user_info_editing_option_side("edit Date-of-Birth");
				$total_friends = $row['total_friends'];
				user_info_heading_side("total friends: ");
				 user_information_side($total_friends);
			
			}
		
	?>

	</div> <!-- outer container div ends here-->
</body>
</html>