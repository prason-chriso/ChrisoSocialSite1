<?php
 	echo "<div id='status_container'";

					echo"<div id='user_description' style='display: inline-block;'>";

					echo "<img style='display: inline-block; height: 60px; width: 60px; float:left; margin-left: 2%;'src=getImage.php?id=$user/>
						</div>"; //user image div ends here

					echo "&nbsp;&nbsp;&nbsp;
						<div style='display: inline-block;; font-size : 20px; font-weight: bold; color: #444444;'>".$res['firstName']." ".$res['lastName']." has updated $gender_type status
						</div>";  //user description div ends heree....



						echo"<div style='border: 1px solid green; padding: 5px; width:80%; margin:5px; margin-left: 10%; background-color:#f2f2f2;'>";
						echo $res['content'];
						
						echo "</div>"; //content div ends here 

						echo "<div style='text-align: right; margin-top:-5px;
						color: #902903; font-weight: bold;'>";
						echo "<p style='font-style:italic; display: inline-block;'>Posted on:&nbsp;&nbsp;&nbsp;&nbsp;
									</p>";
						echo $res['statusPost_Date']." ".$res['statusPost_Hour']." ".$res['am_pm'];
						echo "</div>"; //time div ends here;
						echo "<hr/>";
//			echo "</div>"; //status container div ends here 
?>
