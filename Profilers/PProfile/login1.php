<?php
	session_start();
	$pusername = $_POST['username'];
	$password  = $_POST['password'];
?>

	
<?php 	
	if ($pusername&&$password)
	{
		$connect = mysql_connect("localhost","root","") or die("Couldn't Connect");
		mysql_select_db("placement") or die("Cant find DB");
		
		$query = mysql_query("SELECT * FROM plogin WHERE Username='$pusername'");
		
		$numrows = mysql_num_rows($query);
		
		if ($numrows!=0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				$dbusername = $row['Username'];
				$dbpassword = $row['Password'];
				
			}
			if ($pusername==$dbusername&&$password==$dbpassword)
			{
			  echo "<center>Login Successfull..!! <br/>Redirecting you to HomePage! </br>If not Goto <a href='index.php'> Here </a></center>";
			  echo "<meta http-equiv='refresh' content ='3; url=index.php'>";
			 $_SESSION['pusername'] = $pusername;
			} else {
			$message = "Username and/or Password incorrect.";
  			echo "<script type='text/javascript'>alert('$message');</script>";
			  echo "<center>Redirecting you back to Login Page! If not Goto <a href='index.php'> Here </a></center>";
			  echo "<meta http-equiv='refresh' content ='1; url=index.php'>";
			}
		}else
			die("User not exist");
		
	}
	else
	header("location: index.php");
	?>