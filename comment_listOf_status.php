<?php 
	$statusId = $res['statusId'];
	$get_cmt_qry ="SELECT * FROM comments WHERE statusId='$statusId'  ORDER BY commentId DESC";
	$qryArray = mysql_query($get_cmt_qry);

	if(!$qryArray){
		mysql_error();
	}

	while($d = mysql_fetch_array($qryArray) ){
		$id = $d['userId']; // id of the user who has posted the comment 		
		echo "<div class='comment_descp' style='height: auto; width: 100%; margin-left:2.5%; background: rgba(106, 121, 145,0.2); display:inline-block;'>

			<img src='getImage.php?id=$id' style=' display: inline-block; float: left; height:40px; width:auto; margin: 1%;'/>";


		echo"<div style='padding:1%;  word-wrap: break-word; width:80%; margin-left: 11%; margin-bottom: 2%; position: relative; top: 10px;  background-color:#bababa;'>";
						echo $d['comment_text'];
						
				

				echo "<br/><div style='display: inline-block; color: #902903; font-weight: bold; padding: 1px;  font-style:italic; font-size: 10px; line-height: 9px; position: inherit; left: 1%; top: 1%; '>Posted on:&nbsp;&nbsp;&nbsp;&nbsp;";

						echo $d['comment_date']." ".$d['comment_hrs']." ".$d['comment_am_pm'];
				echo "</div>"; //time div ends here;
	echo "</div>"; //content div ends here 
		echo "</div>"; // comment_descp div ends here....
	}//end of while loop


?>