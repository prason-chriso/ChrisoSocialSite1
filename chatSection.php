<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
	.time{
	display: none;
}
.message_pack:hover .time{
		display: inline-block;

}

</style>
</head>
<body>
	<div id="chatsection">
			<div id="friend_name">
			<p style="float: left; color:#a59393; font-weight: bold; font-size: 22px; padding-left: 10px;"> <?php echo $name;  ?> </p>
			<p style="float : right; color: green; font-weight: bold; font-size: 14px; padding-right: 10px;">ONLINE</p>
			</div><!-- friend_name div ends here-->
			<div id="messagebody"> <!-- placce where message will be displayed-->
			
			<?php include"getMessage_new.php"; ?>
			
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