</html>
<body>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<input style="border-radius: 5px; opacity: 0.8; font-size: 20px; font-weight: bolder; color: #893893; margin-left: 40px; " type="submit" name="logout" value="LOG OUT">
					</form>	
					<?Php 
						if(isset($_POST['logout'])){
							session_unset();
							session_destroy();
							header("Location: login.php");
						}
					?>				
</body>
</html>