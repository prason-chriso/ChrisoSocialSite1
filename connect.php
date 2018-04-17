<?php 
$connect = mysql_connect('localhost','root','');
if(!$connect){ // check for the connection establishment
	die("my sql not connected".mysql_error());
	}
else{ // else block of the connect 
		if(!(mysql_select_db('surfZone_Prason',$connect))){
			die("database selection failed".mysql_error());
		}
	} // end else (nested-1)
?>