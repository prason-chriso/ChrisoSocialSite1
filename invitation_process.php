<?php
session_start();
$user=  $_SESSION['userId'];

include "connect.php";
if(isset($_POST['accepted'])){ //when request is accepted 

$friendId = $_POST['friend_is'];

$query = "SELECT firstName, lastName, dateOfBirth,gender FROM user 
			WHERE userId='$friendId';";
$b = mysql_query($query);

while($row = mysql_fetch_array($b)){
	$friend_fname = $row['firstName'];
	$friend_lname = $row['lastName'];
	$friend_dob = $row['dateOfBirth'];
	$friend_gender = $row['gender'];
	}//end of while loop

//calculate the age
$date1 = date("Y-m-d"); //fetch the current date of server

//$date1 is used to record the date of the record inserted so that the friendship 		//interval can be calculated by subtracting from future date ..whenever required.

/*$date2 = date_create(strval($friend_dob));
//date2 -date1
$diff_age =intval(date_diff($date2,$date1)->format("%y"));//how many year in integer 
echo $diff_age;
*/

//now we will insert the record of the friend in the database table 'friends'
$query1= "INSERT IGNORE INTO `friends`
		(`friendId`,`fren_first_name`,`fren_last_name`,`fren_dob`,`fren_gender`)
		VALUES 
	('$friendId','$friend_fname','$friend_lname','$friend_dob','$friend_gender');";

$y = mysql_query($query1); //successfully insert record in the friend table 

$query2 ="INSERT IGNORE INTO `user_makes_friends`
			(`userId`,`friendId`,`friendshipTime`)
			VALUES 
			('$user', '$friendId','$date1');";

$x = mysql_query($query2); //successfully insert record in the user_makes_table

//now we also require that the current user will be recorded as the friend in the friends a/c...
#---------------------------------------------------------------------------------
$qry = "SELECT firstName, lastName, dateOfBirth,gender FROM user 
			WHERE userId='$user';";
$b = mysql_query($qry);

while($row = mysql_fetch_array($b)){
	$friend_fname = $row['firstName'];
	$friend_lname = $row['lastName'];
	$friend_dob = $row['dateOfBirth'];
	$friend_gender = $row['gender'];
	}//end of while loop

//now we will insert the record of the user as friend in the database table 'friends'
$query3= "INSERT IGNORE INTO `friends`
		(`friendId`,`fren_first_name`,`fren_last_name`,`fren_dob`,`fren_gender`)
		VALUES 
	('$user','$friend_fname','$friend_lname','$friend_dob','$friend_gender');";

$new_y = mysql_query($query3); //successfully insert record in the friend table 

$query4 ="INSERT IGNORE INTO `user_makes_friends`
			(`userId`,`friendId`,`friendshipTime`)
			VALUES 
			('$friendId', '$user','$date1');";
$new_x = mysql_query($query4);

update_request_from($friendId,$user); //call the function to update request_from column
}//accepted isset function ends here...


/* Here, the task for the system to do, 
		when the user will reject the received 
				invitation by conforming that the invitation is unknown..is 				defined....
*/
				
//when request is rejected...
if(isset($_POST['ignored']) ) {

	$friend_is = $_POST['friend_is'];

	update_request_from($friend_is,$user); //call the function 

}//ignored isset function ends here...


function update_request_from($friend_is,$user){

$query1 = "SELECT request_from FROM user WHERE userId = '$user'; ";
$b = mysql_query($query1);
while($row = mysql_fetch_array($b)){
	$value = $row['request_from'];
}//end of while loop

$senderIdList = explode(",", $value);

if(in_array($friend_is, $senderIdList)){//check if the user/fren has send the request

for($i=0 ; $i<count($senderIdList); $i++) {
	if($senderIdList[$i]==$friend_is){
		$position = $i;
	}
}

array_splice($senderIdList,$position,1); //removve the userId who have cancled the 												//request to the specified friend....
$value = implode(",", $senderIdList);

$query2 = "UPDATE `user` SET `request_from` = '$value' WHERE userId ='$user';";
mysql_query($query2);

} // end of if in_array check condition

/*now we have to check if the  request_from column has any id left ..to update the user_notification column to 0 if no request is pending; */

$query1 = "SELECT request_from FROM user WHERE userId = '$user'; ";
$b = mysql_query($query1);
while($row = mysql_fetch_array($b)){
	$value1 = $row['request_from'];
}//end of while loop

if($value1 == null){
		//if there is no request pending then update hte user_notification
$query ="UPDATE `user` SET `user_notification` = '0' WHERE userId ='$user';";
$a = mysql_query($query);
}

header("Location: profile.php");

}//end of function update request_from 
?>