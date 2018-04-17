<?php

//now the query to find out the list of the friends of the $user 
//	in user_makes_friends table

$qry1 = "SELECT f.friendId, f.fren_first_name, f.fren_last_name
			FROM user_makes_friends AS uf
				LEFT JOIN friends AS f
						ON f.friendId = uf.friendId
							WHERE uf.userId = '$user';";

$do = mysql_query($qry1);
if(!$do) echo mysql_error();
					while($res = mysql_fetch_array($do)){
						$fid = $res['friendId'];
						$unseen_qry = "SELECT friendId,COUNT(msg_seen)As total_unseen_msg FROM messages 
						WHERE friendId ='$user' AND msg_seen = '0' AND userId ='$fid' GROUP BY friendId";
						$find = mysql_query($unseen_qry);
						if(!$find) echo mysql_error();
						$total = ""; //used when there is no unseen msg
						
						if(mysql_num_rows($find)>0){
						while($unseen_out = mysql_fetch_assoc($find)){
							$total = " (".$unseen_out['total_unseen_msg'].")";
						}//end of while
					}//end of if
						$friend_full_name =$res['fren_first_name']." ".$res['fren_last_name'];
						$id = $res['friendId'];
						echo"<div style='font-size: 18px; background-image: url('images/background8.jpg'); font-weight:bold; color:#092249; padding-bottom: 2px; padding-left: 10px; width= 90%; margin-top: 5px; background-color:#f5f5f5'>";
						echo"<a href='message.php?name=$friend_full_name&fId=$id' style='text-decoration:none;'>".$friend_full_name.$total."</a>";
						echo "</div>";

					} //end of while 
	?>