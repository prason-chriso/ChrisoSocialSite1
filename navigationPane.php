<?php 
$_SESSION['key'] = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="navigation">
	<img src="images/logo.jpg"  class="logo_img" alt="surfZone_logo" title="surfzone"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div id="search_div">
						<form name="f" method="POST" action="searchprocess.php" >
								<input type="search" id="search_box" placeholder="Search... Name or Email" name="search_field" size="25"/>
									<input type="submit" id ="button_go" value="GO!" name="submit_search">
						</form>
					</div> <!--search_div ends here-->
					<div id= "hyperlink_div">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="profile.php">Home</a> 
						&nbsp;&nbsp;&nbsp;
							<a href="message.php">Message</a>
						&nbsp;&nbsp;&nbsp;
							<a href="user.php">user</a>
						&nbsp;&nbsp;
					</div> <!--hyperlink_div ends here-->
					<div style="display: inline;">
					<img src="getImage.php?id=<?php  echo $user ?>" alt="user_photo" id="user_photo"/>
									
					<?php include "logout.php";?>
					</div>	
	</div><!-- navigation div-->
</body>
</html>