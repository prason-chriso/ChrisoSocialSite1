<?php

$user = $_SESSION['userId'];	
	if($_SESSION['lastMessageId']== null) {
		
	$qry1 = "SELECT messageId FROM messages 
				WHERE userId= '$user' AND friendId='$friendId' 
						ORDER BY messageId DESC LIMIT 1;";
		$last_id = getValue(mysql_query($qry1));

	}//end of if lastId
	else{
	$last_id = $_SESSION['lastMessageId'];
}//end of else lastId 

function getValue( $qryArray ){
	while($d = mysql_fetch_array($qryArray) ){
		return $d['messageId'];
	}
}//end of function getValue
/*
	$temp = mysql_query("SELECT FIRST(messageId) FROM messages
		WHERE userId= '$user' AND friendId='$friendId' ",$connect);  
*/

	$temp = 0;
	// storing the last id value in the temporary variable for future uses	
				getmessage($temp,$last_id);
				
		function getmessage($temp,$last_id){

			//now the fetchin process  begins for each messages 
			/*Here, i have join the message and the messAge_post table so as to get the full discripction of the messages shared;
			*/

// NOTE:--IT's always better to use the unique reference while generating the   //----result ..even thought it's not useful for the information to display it...

				$qry1 = "SELECT messageId,description,sentDate, sentHour, am_pm FROM messages WHERE messageId = '$last_id'";

				$do = mysql_query($qry1);
					while($res = mysql_fetch_array($do) ){
						echo"<div style='border: 1px solid green; padding-bottom: 5px;  padding-left: 10px; width= 80%; margin-top: 5px; background-color:#f2f2f2'>";
						echo $res['description'];
						echo "</div>";

						echo "<div style='text-align: right; font-size:12px; color: #902903; font-weight: bold;'>";
						echo "<p style='font-style:italic; display: inline-block;'>sent on:&nbsp;&nbsp;&nbsp;&nbsp;
									</p>";
						echo $res['sentDate']." ".$res['sentHour']." ".$res['am_pm'];
						echo "</div>"; //time div ends here;

					} //end of while 
					
/*					if($last_id !=$temp){
							$last_id -=1;
							getmessage($temp,$last_id);

						}// end of if */
						if($temp<=50){
							$temp++;
							getmessage($temp,$last_id);
						}
	
	return;
}//end of the function 

?>