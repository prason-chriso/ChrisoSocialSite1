<?php
session_start();
$_SESSION['userId']= null;
$_SESSION['userName']= null;
$_SESSION['email']= null;
$_SESSION['messageId'] = null;
?>
<!-- login form demo -->
<html>
<head>
	<title>login.html</title>
		<link rel="stylesheet" type="text/css" href="login_styles.css">
		<!-- the login_styles.css file will be liinked here-->
		<link rel="stylesheet" type="text/css" href="login_send_transition.css"/>
</head> <!-- head tag ends-->
<body>

	<div id="container" >
	<form name="f" method ="POST" action="checkEntry.php" >
	<fieldset>
	
		<legend>Sign IN </legend> <!-- the ouline box will appear with the head text ass login -->
	<div>
		<label for="email" class="title">Email </label>
		<input type="text" id= "email" title="enter your email here" name="user_email"/></div> <!-- the email box will appear now-->
	<div>
		<label for="password" class="title">Password</label>
		<input type="text" id="password" title="enter your password here" name="pass"/></div>		<!-- the pasword box will appear now-->
	<div>
		<input type="checkbox" value="1" name="remember_me" checked="checked"/>Remember me</div>
		<hr size ="3px"/>
	<div style="font-size: 12px; color:#adebeb">No account yet?&nbsp;&nbsp;<a href="signup.php" style="font-size: 16px;color:#303030; font-weight:bold;">Sign UP</a> </div>
		<hr size ="3px"/>
	<div> 
		<button class="submit_button" name ="login_btn"><span>sign in</span></button>  </div>
	</fieldset>
	
	</form>
	</div>
	
	
	<div  id="error_display" 
	style="height:100px; width:400px; margin: 0px auto; display: none; background-color:#ff8080; color:green;
	border-radius:20px; border:1px; margin-top:1%; text-align: center;">
	<?php
	echo " error div is this";
	?>
	
	</div> <!-- error display div end here-->
<!--	<div id="logo_spacing">
	<img src="logo.jpg" alt="welcome from  surfzone" title="surfzone_logo" height="500px" width="1000px" style="float: right;margin-right: 50px;"/>
	</div> <!--lOgo spacing div ends here-->
	
	</body>
	</html>

