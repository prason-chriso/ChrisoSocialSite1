<?php
session_start();
$user = $_SESSION['userId'];
$_SESSION['Curentwebpage'] ="user.php";
include "connect.php";
?>

<html>
<head>

	<title>user Information</title>
<link rel="stylesheet" type="text/css" href="user_styles.css"/>
<link rel="stylesheet" type="text/css" href="navigation_style.css"/>
<link rel="stylesheet" type="text/css" href="search_result_styles.css"/>
</head>
<body>  
	<?php include "navigationPane.php"; ?>
	
	<div id="profile_pic">
		<img id="user_img" alt="user_profile_picture" 
		src="getImage.php?id=<?php  echo $user ?>" />
		
		<a id="change" href="change_pic.php" title="click to change the profile picture" onclick ="show_change_pic()" >Change Image</a>
		
		
	</div><!-- profile_pic div-->
	<p style="font-size:40px; font-weight: 800; color: #990292;">Hello <?php echo 	$_SESSION['userName'];?>,</p>
		<div id="status_update">
		<form name="f1" action="statusProcess.php" method="POST">
			<textarea id="status" name="status" cols="80" rows="8" placeholder="what's going on user...???"></textarea>
			<input type= "submit" name="status_update" class="personal" value="post status"/>
		</form>
		</div><!-- status_update div-->
		<div id="user_rightbar">
		<div id="friends_list_heading_div"> <?php //changed ?>
					<p id="online">Friends&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					active</p>
					<hr size="3px" color="#aaa"/>
					<hr size="15px" color="#ff9999"/>
					<hr size="3px" color="#aaa"/>
					<div id="friends">	
							<?php 
									include "get_friend_list_in_online_view_div.php";	?>
						</div><!--friends div ends-->
				</div><!--friends_list_heading_div div ends-->
		</div><!-- user_rightbar div ends here-->
		<hr color="#aaa" size="3px" width="75%" align="left"/>
<div id="select_tab">
	<ul id="tab_list">
	<form name="f4" method="POST" action ="<?php echo $_SERVER['PHP_SELF']; ?>">
		<li><input type="submit" class="tab_head" name="about_info" value ="About user"/></li>
			<li><input type="submit" class="tab_head" name="timeline_info" 
			value="Timeline"></li>
				<li><input type="submit" class="tab_head" name="friends_info" value="Friends"></li>
					<li><input type="submit" class="tab_head" name="photo_info" value="Photos"></li>
						<li><input type="submit" class="tab_head" name="feedback_info" value="Feedback"></li>
	</form>	
		</ul>
	</div><!-- Select tab div ends here-->
	<script type="text/javascript">
		function show_change_pic(){
		

		}
	</script>

	<div id="display_section">
	
		
		<?php
				if(isset($_POST['about_info'])){
						include "about_user_section.php";						
				}
		?>
		
 
		<?php 
		// content to be displayed in the timeline 
				if(isset($_POST['timeline_info'])){
					include "timeline.php";
					
				}
		?>
	
		<?php
				if(isset($_POST['friends_info'])){
					include "friend_list.php";
				}
		?>
	
		<?php
				if(isset($_POST['photo_info'])){
					
				}
		?>
	
		<?php
				if(isset($_POST['feedback_info'])){
					
					include "feedback_form.php";
				}
		?>
	
		</div> <!-- display section ends here-->
<?php 
function display(){
	echo "hello chriso";
}
?>
</div>
</body>
</html>
