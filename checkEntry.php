<?php
session_start();
$_SESSION['userName'] = null;

	// php scripting for the entry to the surfzone profile page 
	if(isset($_POST['login_btn'])){
		
		include "connect.php";
		//$id = $_GET['userId'];
		$name = $_POST['user_email'];
		$pass = $_POST['pass'];
		$qry = "SELECT userName, password FROM user
					WHERE userName= '$name' AND password ='$pass'";
		$a =mysql_num_rows(
							mysql_query($qry, $connect));
		if($a){
			
			//we have to store the id of the user to the session variable for the future use 
				$qry1 = "SELECT userId,userName,email FROM user WHERE userName = '$name' ";
						$qr = mysql_query($qry1,$connect);
						while($value = mysql_fetch_array($qr))
						{			
								$_SESSION['userId'] = $value['userId'];
								$_SESSION['userName'] = $value['userName'];
								$_SESSION['email'] = $value['email'];
					//				echo $_SESSION['userId'];
						}
				header('Location:profile.php'); //redirecting the page to the user profile
			}
		else{
			echo header('Location:login.php'); //deniel of the request due to the invalid input
		}
	}// end of the if
?>
	