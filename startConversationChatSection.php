<?php 
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
		<div id="chatsection">
			<div id="friend_name">
			<p style="float: left; color:#a59393; font-weight: bold; font-size: 22px; padding-left: 10px;"> Start  New Conversation </p>
			<p style="float : right; color: green; font-weight: bold; font-size: 14px; padding-right: 10px;">ONLINE</p>
			</div><!-- friend_name div ends here-->
			<div id="messagebody"> <!-- placce where message will be displayed-->
			
			<?php 
			echo "<p style='font-size:35px;color: #1e3022; font-weight: bold;' align='center'> Hello $userName,<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;
					Choose any friend  from the list 
					<br/>to start the conversation </p>"; ?>
			
		</div> <!-- message body div ends here-->
			<div id="sendmessage">
				<form name="f3" method="POST" action="sendMessage.php" >
					<input type="hidden" name="friendId" 
								value="<?php echo $friendId ?>">

					<textarea id="messagebox" name="text_msg" rows="7" cols="80" placeholder="enter your message..."></textarea>
					<button style="background-color: #7f9381; padding: 8px;" class="submit_button" name ="send"><span>SEND</span></button>
						
				</form>
			</div><!-- send message div ends here-->
		</div><!--chatsection div ends-->


</body>
</html>