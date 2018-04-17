<?php

$user = $_SESSION['userId'];
$qry = "SELECT statusId FROM status LIMIT 1;";
$qry1 = "SELECT statusId FROM status ORDER BY statusId DESC LIMIT 1;";
$first_status =getValue( mysql_query($qry,$connect));
$last_status =  getValue(mysql_query($qry1, $connect));  
 
/*
now declaring the function for fetching the item, from the database column for simplicity 
 */ 
function getValue($qryArray){
	$d = mysql_fetch_array($qryArray);
	foreach($d as $value){
		return $value;
	}
}


// now calling the function for fetching the status of the user ..to display in the timeline ....
getStatus($first_status,$last_status,$user);
				
		function getStatus($first_status,$last_status,$user){

			//now the fetchin process  begins 
				$qry1 = "SELECT u.firstName, u.lastName, gender,content, statusPost_Date, statusPost_Hour, am_pm FROM status as s 
						INNER JOIN status_view_table AS sv
						ON sv.statusId = s.statusId
						INNER JOIN user as u 
						ON sv.userId = u.userId
						WHERE s.statusId = '$last_status' AND sv.userId = '$user' ;";

				$do = mysql_query($qry1);

					while($res=mysql_fetch_array($do)){
						if($res['gender']=='male')
							$gender_type ="his";
						else $gender_type ="her";
					include "status_container.php";
					} //end of while 
					
					if($last_status !=$first_status){
							$last_status -=1;
							getStatus($first_status,$last_status,$user);

						}// end of if */
	
	return;
}//end of the function 

//*/
?>