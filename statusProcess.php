<?php 

session_start();
if(isset($_POST['status_update'])){
include "connect.php";

$status = mysql_escape_string($_POST['status']); //remember the probblem has    //occur while updating the status as "what's goiing on user????" due to the 's

$user = $_SESSION['userId'];
$userName = $_SESSION['userName'];
$email = $_SESSION['email'];

$postTime = date("Y-m-d h:i:s .a");
$meridian = (end(explode(".",strval($postTime)))); //storing am or pm
$posted =(current(explode(" ",strval($postTime)))); //storing the posted date of status 
$postedhr = (next(explode(" ",strval($postTime))));	//storing the posted hour of the status


$qry ="INSERT INTO `status`(`content`, `statusPost_Date`, `statusPost_hour`, `am_pm`)
		 VALUES 
				 		('$status', '$posted', '$postedhr', '$meridian')";

$a = mysql_query($qry,$connect); //execute query
$status_id_fetch_query = mysql_insert_id($connect);

$qry1 = "INSERT INTO `status_view_table`(`userId`, `statusId`)
		 VALUES 
				 		('$user', '$status_id_fetch_query')";
$b = mysql_query($qry1);
/*$status_id_fetch_query = "SELECT statusId FROM status WHERE userId ='$user'";
$r = mysql_fetch_assoc(
					mysql_query($status_id_fetch_query,$connect)
					);
foreach($r as $v){

// query to insert the record in the status_update table 
$qry2 = "INSERT INTO `status_update` (`userId`, `statusId`) 
					VALUES 
					('$user', '$v');";

$b = mysql_query($qry2, $connect); // inserting the record in the status_user table 

}// end of the foreach table
*/
if($a)
	if($b){
	
		header('Location: user.php');
	//echo "status updated";
}// inner if ends 

		else {
					echo "error in the code".mysql_error();
					}
					
 
} //isset check if ends here

?>