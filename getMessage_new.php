<?php

$user = $_SESSION['userId'];
$f = $_SESSION['friendId'];
$last_id_array_sender  = array(); //declaring the empty array	
$last_id_array_receiver =array();

	if($_SESSION['lastMessageId']== null) {
		
	$qry1 = "SELECT messageId FROM messages 
				WHERE userId= '$user' AND friendId='$friendId' 
						ORDER BY messageId ASC LIMIT 50;";
		$qryArray =  mysql_query($qry1);
			while($d = mysql_fetch_array($qryArray) ){
							array_push($last_id_array_sender, $d['messageId'].",S");
				}//end of while loop

	}//end of if lastId
	else{
	$last_id = $_SESSION['lastMessageId'];
	array_push($last_id_array_sender, $last_id.",S");
}//end of else lastId 

//array_walk($last_id_array_sender, "getmessage_sender");
#-----------------------------------------------------------------------------				
function getmessage_sender($value, $key){

			//now the fetchin process  begins for each messages 
			/*Here, i have join the message and the messAge_post table so as to get the full discripction of the messages shared;
			*/

// NOTE:--IT's always better to use the unique reference while generating the   //----result ..even thought it's not useful for the information to display it...


				$qry1 = "SELECT messageId,description,sentDate, sentHour, am_pm FROM messages WHERE messageId = '$value'";

				$do = mysql_query($qry1);
					while($res = mysql_fetch_array($do) ){
						echo "<div class= 'message_pack' style='line-height: 16px; float: right; width: 51%;'>";

								echo"<div class='msg' style='margin-right: 10%; display: inline-block; float: right;
								border-radius: 3px 15px; font-size: 20px; padding: 8px; background-color:#497c50;'>";
											echo $res['description'];
								echo "</div> <br/>";

									echo "<div class='time' style='margin-right: 10%; margin-left: 45%; font-style:italic; font-size:12px; color: #902903; font-weight: bold; float: right;'>sent on:&nbsp;&nbsp;&nbsp;&nbsp;".
												$res['sentDate']." ".$res['sentHour']." ".$res['am_pm']."</div>";
						echo "</div>"; // message_pack div ends here...

					} //end of while 

}//end of the function getmessage_sender

// now to get what other has send to us we define the code as below
$qry2 = "SELECT messageId FROM messages 
				WHERE userId= '$friendId' AND friendId='$user' 
						ORDER BY messageId ASC LIMIT 50;"; 
/* the Id is altered because the accessing the other message ..we are their friend */

$qryArray1 =  mysql_query($qry2);
			while($d = mysql_fetch_array($qryArray1) ){
							array_push($last_id_array_receiver, $d['messageId'].",R");
				}//end of while loop
//array_walk($last_id_array_receiver, "getmessage_receiver");

#-----------------------------------------------------------------------------
function getmessage_receiver($value, $key){
	$qry1 = "SELECT messageId,description,sentDate, sentHour, am_pm,userId FROM messages WHERE messageId = '$value'";

				$do = mysql_query($qry1);
					while($res = mysql_fetch_array($do) ){
							$f = $res['userId'];
						echo "<div class= 'message_pack' style='margin-top: 0px; float: left; width: 51%; line-height: 16px;'>";

						echo "<img style='width: 40px; height: 40px; float: left; margin-left: 2%;' src='getImage.php?id=$f'/>";
							
								echo"<div class='msg' style=' margin-left: 5%; float: left;
								border-radius: 15px 3px; font-size: 20px; padding: 1px 8px 8px 4px; background-color:#dd9c92;'>";
											echo $res['description'];
								echo "</div><br/>";

									echo "<div class='time' style='margin-left: 5%; margin-right: 64%; font-style:italic; font-size:12px; color: #902903; font-weight: bold; float: left;'>".
												$res['sentDate']." ".$res['sentHour']." ".$res['am_pm']."</div>";
						echo "</div>"; // message_pack div ends here...
		if(!mysql_query("UPDATE messages SET msg_seen='1' WHERE messageId = '$value';")) echo mysql_error();
					} //end of while 

}//end of the function getmessage_receiver

#--------------------------------------------------------------------------------
$total_message_id_list = array_merge($last_id_array_sender,$last_id_array_receiver); 
rsort($total_message_id_list, SORT_NATURAL);
/*...Here we have sorted the list of the messageId ..because the message must appear in chronological order of sending by the user ...based on the time stamp of the sending .... */

array_walk($total_message_id_list, "checking");
function checking($value, $key) {
	
	if(end(explode(",", $value)) == "S")
			getmessage_sender(current(explode(",", $value)), $key);
	else
		getmessage_receiver( current(explode(",", $value)), $key);

}


/* 
	---------------------------------------------------------------------------------
		 this is previous body of while loop ..kept for reference... only 
	---------------------------------------------------------------------------------
	echo"<div style='padding-bottom: 5px;  padding-left: 10px; width= 80%; float:left; margin-top: 5px; background-color:#f2f2f2'>";
						echo $res['description'];
						echo "</div>";

						echo "<div style='text-align: right; font-size:12px; color: #902903; font-weight: bold;'>";
						echo "<p style='font-style:italic; display: inline-block;'>sent on:&nbsp;&nbsp;&nbsp;&nbsp;
									</p>";
						echo $res['sentDate']." ".$res['sentHour']." ".$res['am_pm'];
						echo "</div>"; //time div ends here;

*/
?>