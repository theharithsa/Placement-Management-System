<?php
session_start();
$connect = mysql_connect("localhost", "root", ""); // Establishing Connection with Server
mysql_select_db("placement"); // Selecting Database from Server

	$Username = $_SESSION['username'];
	$Password = $_POST['Password'];
	$repassword = $_POST['repassword'];
	$cur = $_POST['curpassword'];
	if($Password && $repassword && $cur) 
	{
		if($Password == $repassword)
		{
			$sql = mysql_query("SELECT * FROM `placement`.`slogin` WHERE `USN`='$Username'");
			if(mysql_num_rows($sql) == 1)
			{
				$row = mysql_fetch_assoc($sql);
				$dbpassword = $row['PASSWORD'];
			    
				if($cur == $dbpassword)
				{
					if($query = mysql_query("UPDATE `placement`.`slogin` SET `PASSWORD` = '$Password' WHERE `slogin`.`USN` = '$Username'"))
					{
						echo "<center>Password Changed Successfully</center>";
					} else {
						echo "<center>Can't Be Changed! Try Again</center>";
					}
				} else {
					die("<center>Error! Please Check ur Password</center>");
				}
			} else {
				die("<center>Username not Found</center>");
			}
		} else{
			die("<center>Passwords Donot Match</center>");
		}
	} else {
		die ("<center>Enter All Fields</center>");
	}
