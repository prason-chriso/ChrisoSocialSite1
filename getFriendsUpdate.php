<?php

//first we select the friend list of the user and store it in the array....
$friend_list_array = array($user);
$query =  "SELECT friendId FROM `user_makes_friends` WHERE userId='$user';";
$a = mysql_query($query);
//FOR THE first time when user enter the surfzone then the notice to invite new friend should be reccomended to the user ...
if (mysql_num_rows($a)<1) {

			echo "<p style=' font-size: 58px; font-weight: bold; color: #902847;' align='center'> welcome to surfzone !!!</p>";
			echo "<p style='padding: 30px; font-size:35px;color: #1e3022; font-weight: bold;' align='left'> Hello $userName,
			<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;Search your friends,
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;Send invitation
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;to get news & update  about friends... </p>"; 

}//end of if when first time entered the surfzone


while($row = mysql_fetch_array($a)){
	array_push($friend_list_array,$row['friendId']);
	//insert every new item to the array at last 

}//end of while 

array_walk($friend_list_array,"get_all_the_status",$user);

function get_all_the_status($value, $key,$user){ //$value has friendId STORED 
	static $seen_clm_size = 4;

	$query = "SELECT u.firstName, u.lastName, gender,s.statusId, content,s.statusPost_Date,s.statusPost_Hour,am_pm,total_likes, sv.userId, sv.seen_by_user
			FROM user AS u 
			INNER JOIN status_view_table AS sv
			ON u.userId = sv.userId
			INNER JOIN status AS s 
			ON s.statusId = sv.statusId
			WHERE sv.userId = '$value' 
			ORDER BY s.statusId DESC
			LIMIT 200;";
	$do = mysql_query($query);
	$total_rows = mysql_num_rows($do);
	if($total_rows == 0 ) return false; //if the particular friend has 
	//	not updated status  then return.

	while($res = mysql_fetch_assoc($do)){
				if($res['gender']=='male')
							$gender_type ="his";
						else $gender_type ="her";
				$id = $res['userId'];//get who  has updated the status and store id	
?>								
			<div class="status_contain" style="border-top: 8px groove #d5dae2;">
<?php
				echo"<div style=' display: inline-block; float: left;'>"; //id='user_description'

					echo "<img style='width: 80px; height: 60px; margin-left: 2%;' src=getImage.php?id=$id/>
						</div>";

					echo "&nbsp;&nbsp;&nbsp;<div style='font-size : 20px; color:#1e2844; float: left; padding-left:10px;'>".$res['firstName']." ".$res['lastName']." has updated $gender_type status
				</div>";



				echo"<div style='border: 1px solid green; word-wrap: break-word; padding-left:15px; width:80%; margin:5px; margin-left: 15%; background-color:#f2f2f2;'>";
						echo $res['content'];
						
				echo "</div>"; //content div ends here 

				echo "<div style='display: inline-block; text-align: right; float: right; color: #902903; font-weight: bold;'>";
						echo "Posted on:&nbsp;&nbsp;&nbsp;&nbsp;";
						echo $res['statusPost_Date']." ".$res['statusPost_Hour']." ".$res['am_pm'];
				echo "</div><br/>";
				echo "<div name='total_statistics_of_status' style=' width: auto; padding-left: 15%; color: #5f7291;'>".$res['total_likes']."&nbsp;&nbsp;likes </div>"; //time div ends here;


				//work for like comment and share...	
				echo "<div style='border: 1px solid #f3f3f3; height: 6%; width: 100%; margin-left:0.5%; background: rgba(106, 121, 145,0.2);'>
					<form name='like_cmt_share_btn' method='POST' action='post_cmt.php'>
						<button class='LCS' name='like'><span>Like</span></button>
						<button class='LCS'	name='comment'><span>Comment</span></button>
						<button class='LCS' name='share'><span>Share</span></button>
					</div>";//like comment share option div ends here 
				
				//div for the comment list
				include "comment_listOf_status.php";

				//additional div for user to give comment
				echo "<div style='border-bottom: 2px inset #686869; height: auto; width: 100%; margin-left:2.5%; background: rgba(106, 121, 145,0.2); display:inline-block; '>
					<div class='comment_descp'>
						<img src='getImage.php?id=$user' style='height:40px; width:auto; margin-left: 1%;'/>
						<input type='text' size='60' class='cmt_place' placeholder='write a comment...' name='comment_text' style=' font-size: 14px; position: relative; top: -13px ;  '/>
						<input type='hidden' name='statusId' value='$statusId'/>
						</form>
								</div>

						</div>";

			echo "</div>"; //status container div ends here 
				
	//after the useer has seen the friend status then ..we update the seen_by column
		$seenId_string = $res['seen_by_user'];
		$seenId_string.= $user.",";
	$Id_array = explode(",", $seenId_string);
	$count = count($Id_array);
	$Id_array = array_unique($Id_array); 

	/*even if the user seee the post in the newfeed make sure that his/her id is recorded only oncee....using array_unique();  */
	
	$seenId_string = implode(",", $Id_array);
	
	$seen_clm_value_update ="UPDATE `status_view_table`
					SET `seen_by_user` = '$seenId_string'; ";
	$b = mysql_query($seen_clm_value_update);
	
	if(count(explode(",",$seenId_string)) != $count){
	$seen_clm_size+=4;
	$seen_clm_size_update = "ALTER TABLE `status_view_table` CHANGE `seen_by_user` `seen_by_user` VARCHAR($seen_clm_size) DEFAULT NULL;";
	$a = mysql_query($seen_clm_size_update);
	if(!$a) echo mysql_error();
		}//end of if statement for count ...
	
	}//end of while loop  
		return ;
}//end of function get_all_the_status

?>
