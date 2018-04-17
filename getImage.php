<?php

if(isset($_GET['id'])){
	include "connect.php";
	$id = $_GET['id'];
	$qry = "SELECT user_picture,picture_type FROM user where userId = '$id'";
	$a = mysql_query($qry);
	while ($row = mysql_fetch_array($a)){
		$imageData = $row['user_picture'];
		$imageType = $row['picture_type'];
	}

	header("content-type: $imageType");
	echo $imageData;

}


?>