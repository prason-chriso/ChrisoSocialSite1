<?php
session_start();
$user=  $_SESSION['userId'];

include "connect.php";
if(isset($_POST['addfriend'])){
$key = $_POST['k']; 
$friend = $_POST['friendId']; // it has the id to whom the request has beeen send.
//update the notification column to denote the request has been received from friend
$query ="UPDATE `user` SET `user_notification` = '1' WHERE userId ='$friend';";
$a = mysql_query($query); //execute query to update

// also to store than the user who has send the friend request...
$query1 = "SELECT request_from FROM user WHERE userId = '$friend'; ";
$b = mysql_query($query1);
while($row = mysql_fetch_array($b)){
	$value = $row['request_from'];
}//end of while loop

/*$value is used to store the total number of the users's id with commaa seperation, to identify which which user have send the request ...*/

if($value==null){
	$value=$user; }
else{
	$value.=", ".$user;
	$v = array_unique(explode(",", $value));
	$value = implode(",", $v);
}

$query2 = "UPDATE `user` SET `request_from` = '$value' WHERE userId ='$friend';";
mysql_query($query2);
header ("refresh : 0; url=searchprocess.php?key=$key");

} //end of the issset of the add friend...


/* 
*	now we define the function for the system when the cancel invitation is				clicked...		*/

if(isset($_POST['nofriend'])){
$key = $_POST['k']; 
$friend = $_POST['friendId'];
$query ="UPDATE `user` SET `user_notification` = '0' WHERE userId ='$friend';";
$a = mysql_query($query);

$query1 = "SELECT request_from FROM user WHERE userId = '$friend'; ";
$b = mysql_query($query1);
while($row = mysql_fetch_array($b)){
	$value = $row['request_from'];
}//end of while loop

$senderIdList = explode(",", $value);

if(in_array($user, $senderIdList)){ //check if the user has send the request

for($i=0 ; $i<count($senderIdList); $i++) {
	if($senderIdList[$i]==$user){
		$position = $i;
	}
}//end of for each 
array_splice($senderIdList,$position,1); //removve the userId who have cancled the 												//request to the specified friend....
array_unique($senderIdList);

$value = implode(",", $senderIdList);

$query2 = "UPDATE `user` SET `request_from` = '$value' WHERE userId ='$friend';";
mysql_query($query2);


}//end of if condition to check $user 
header ("refresh : 0; url=searchprocess.php?key=$key");
}//end of the isset nofriend function 
?>