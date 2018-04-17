<!DOCTYPE html>
<html>
<head>
	<title>feedback zone</title>
<style type="text/css">
	#send_feedback{
		border: none;
		margin : 3px;
		padding: 15px;
		background-image: url("images/background3.jpg");
	}
	#feedbackId{
		padding: 5px;
		resize: none;
		background-image: url("images/background6.jpg");
		color: #902328;
		font-size: 20px;
		border: 14px inset #f27a68;
	}
#feedback_heading{
	text-align: center;
	color: #902328;

}
</style>
</head>
<body>	
		<h1 id="feedback_heading" >What do you think of surfzone community...?</h1>
		<br/><br/>
		<form name="feedback_form" method="POST" align="center"action="<?php echo $_SERVER['PHP_SELF'] ?>">
			
			<textarea name="feedback" rows="12" cols="42" id="feedbackId">	Share with us ...!!!</textarea>
			<input type="submit" name="sendf" value="send feedback" id="send_feedback">
		</form>

<?php
	if(isset($_POST['sendf'])){
	$feedback_data = $_POST['feedback'];
	$query = "INSERT INTO `feedbacks` (`userId`, `feedback_data`)
	 VALUES ('$user', '$feedback_data');";
	$a = mysql_query($query);
	if(!$a){
		mysql_error();
	}
	else{
		echo "data inserted";
	}

	}//END of isset feedback sendinng 
	
?>
</body>
</html>