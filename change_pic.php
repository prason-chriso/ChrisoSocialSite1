
<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
#cover{
	background: rgba(63, 64,66, 0.2);
}
#change_image_work{
   	background: rgba(76, 175, 80,0.3);
   	display: inline-block;
	margin-top: 20%;
	margin-left: 30%;
	padding: 2%;
}

input{

	background: rgba(100,34,53, 0.5);
	font-size: 18px;
	border: none;
}

</style>
<link rel="stylesheet" type="text/css" href="login_send_transition.css"/>
</head>
<body>

<?php 
	session_start();
	$user = $_SESSION['userId'];
?>
<div id="change_image_work" >
<form name = "f" method ="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

<input type="file" name="image"/><br/><br/>
<button style="background: #6394e2; padding: 5px;" class="submit_button" name ="upload"><span>Change</span></button>
</form>
</div> <!-- change imgage  working container div ends. -->
<?php
if (isset($_POST['upload'])){
	include "connect.php";
	//property of the files uploaded 

	$imagetemp = $_FILES['image']['tmp_name'];   //this will save the path of the    //    temporary file in the server ;
	$imagetype = $_FILES['image']['type']; //this will save the image type ..

	$image = addslashes(file_get_contents($imagetemp));
	 /* file_get_contents() function is used to get the file content as specified by the path .....
	addslashes function add the slashes in the hexadecimal special character that represent the image ...if addslashes is not included, it display the error ...
*/
	$query = "UPDATE user SET user_picture = '$image', picture_type='$imagetype' WHERE userId ='$user';";
	$exec = mysql_query($query);

	if($exec){
		header("Location: user.php");
	}

}
?>
</body>
</html>