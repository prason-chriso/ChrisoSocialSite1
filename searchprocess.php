<?php
session_start();
$user = $_SESSION['userId'];
$userName = $_SESSION['userName'];
$_SESSION['friendId']= null;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="profile_style.css">
<link rel="stylesheet" type="text/css" href="navigation_style.css">
<link rel="stylesheet" type="text/css" href="search_result_styles.css">
</head>
<body>
<?php 
	include "navigationPane.php";
?>		
		<div id="container">		
			<div id="newsfeed">
<?php
	if (isset($_POST['search_field']))
			$keyValue = $_POST['search_field'];  #store the input query into variable
	
	if(isset($_GET['key'])) {
			$keyValue = $_GET['key'];
	#store the internally called key value send from the friendship_button.php page
			$_POST['submit_search'] = 1; 
// random value to make the below if statement condition hold true even the internal #  call occur
	}
	if(isset($_POST['submit_search']) && !empty($keyValue)){
	include "connect.php";
	
	$key = $keyValue;
	$query = "SELECT userId,firstName, lastName FROM `user` 
	WHERE firstName LIKE '$key%' AND firstName NOT LIKE '$userName';";
	$a = mysql_query($query);
	
	$total_rows = mysql_num_rows($a); //to see how many record are mathched..


	if(empty($total_rows)) //if not any record are found then jump to the  end ..
		noResult();

	//to liist the total friend of the user 	
	$query1 = "SELECT friendId FROM user_makes_friends WHERE userId = '$user';";
	$exec1 = mysql_query($query1);
	if(!$exec1) die(mysql_error());
	$friend_id_list_for_button = array();
	while($r = mysql_fetch_assoc($exec1)){
		array_push($friend_id_list_for_button, $r['friendId']);
	}
		

echo "<table cellspacing='0'>
		<tr><th>S.N.</th><th colspan='2'>Friend Name</th><th>Friend Photo</th>
		<th>Friendship Option</th></tr>";

	for($i=0; $i<$total_rows; $i++){ 
		echo "<tr>";
		$sn = 1;
		while ($row = mysql_fetch_assoc($a)) {
		echo "<td>".($sn++)."</td>";
		echo "<td>".$row['firstName']."</td>";
		echo "<td>".$row['lastName']."</td>";
		$id = $row['userId'];
		$_SESSION['friendId'] = $id;
		echo "<td>"."<img src='getImage.php?id=$id'/>"."</td>";

		//....to list the total friend whom the user has send the invitation in #.....senderIdList variable  
		$qry = "SELECT request_from FROM user WHERE userId = '$id'; ";
		$b = mysql_query($qry);
		while($row = mysql_fetch_array($b)){
		$value = $row['request_from'];
		}//end of while loop
		$senderIdList = explode(",", $value);

		#if the search result diplay that user who is already friend then the #invitation must not be given as option 
		if(in_array($id, $friend_id_list_for_button)){
			echo "<td>
					<div id='already_friend'>
					CONNECTED
					</div>

					</td>";
		echo "</tr>";
		} //end of if(result have the user already listed as friend )
		elseif ($id==$user) {
		echo "<td>
					<div id='already_friend'>
					Your profile
					</div>

					</td>";
		echo "</tr>";
		}
		elseif(in_array($user, $senderIdList)){ //if the friend is already invited 

			echo "<td><form method='POST' action='friendship_button.php'>
				<input type='hidden' name= 'friendId' value='$id'/>
				<input type='hidden' name= 'k' value='$key'/>
				<input type='submit' class='invite_btn' disabled='disabled' value='Invited'/><span>
							<img id='invited' src='images/invited.jpg'
							 style=' height: 50px; width:50px;'/></span>
				<input type='submit' class = 'invite_btn' name='nofriend' value='cancel Invite'/>
						</form>
					</td>";
		echo "</tr>";

		}
		else{
			echo "<td><form method='POST' action='friendship_button.php'>
				<input type='hidden' name= 'friendId' value='$id'/>
				<input type='hidden' name= 'k' value='$key'/>
				<input type='submit' class = 'invite_btn' name='addfriend' value='Invite'/><span></span>
				<input type='submit' class = 'invite_btn' name='nofriend' value='cancel Invite'/>
						</form>
					</td>";
		echo "</tr>";
	}
	}//end of while loop 	
}//end of outer for loop */ 
echo "</table>";
}//end of the isset function for the search
else{
		noResult();
} 
function noResult(){
	echo "<h2 style='color: #902830; font-size: 18px;text-align: center;'>NO Search Result</h2>";
	die();

}
?>

							
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
				<?php 
									include "get_friend_list_in_online_view_div.php";	?>
				
			</div>
		</div> <!--	container div ends-->

</body>
</html>





