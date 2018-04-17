<?php

//to liist the total friend of the user 	
	$query1 = "SELECT friendId FROM user_makes_friends WHERE userId = '$user';";
	$exec1 = mysql_query($query1);
	if(!$exec1) die(mysql_error());
	$friend_id_list = array();
	while($r = mysql_fetch_assoc($exec1)){
		array_push($friend_id_list, $r['friendId']);
	}

echo "<table cellspacing='0' align='center'>
		<tr><th>S.N.</th><th colspan='2'>Friend Name</th><th>Friend Photo</th>
		<th>Friendship Status</th></tr>";
array_walk($friend_id_list, "get_friendlist");
#---------------------------------------------
function get_friendlist($value,$key){
$query = "SELECT userId,firstName, lastName FROM `user` 
	WHERE userId = '$value'";
	$a = mysql_query($query);
	
echo "<tr>";
		while ($row = mysql_fetch_assoc($a)) {
		echo "<td>".($key+1)."</td>";
		echo "<td>".$row['firstName']."</td>";
		echo "<td>".$row['lastName']."</td>";
		$id = $row['userId'];
		echo "<td>"."<img src='getImage.php?id=$id' style='width: auto;'/>"."</td>";

		echo "<td>
					<div id='already_friend'>
					CONNECTED
					</div>

					</td>";
		echo "</tr>";
		
	}//end of while loop 	

}//get_friendlist function ...block ends

echo "</table>"; 
function noResult(){
	echo "<h2 style='color: #902830; font-size: 18px;text-align: center;'>NO friend yet <br/>
		Search the friend to send invitation...</h2>";
	die();

}
?>