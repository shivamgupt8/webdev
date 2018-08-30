<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div class="loginBox">
		<img src="log.jpg" class="user">
		
		<h1 style="text-align:center;color:white;">Login</h1>
	<form action="login2.php" method="post">
	<fieldset class="textfield"><h3 class="desc">Email</h3>
		<input type="email" name="email" placeholder="Your email"><br>
	</fieldset>
	<fieldset class="textfield"><h3 class="desc">Password</h3>
		<input type="password" name="password" placeholder="Your password"><br>
	</fieldset>
	
	<fieldset class="textfield">
		<button type="submit" name="submit" id="contact-submit" value="submit">Submit</button>
	</fieldset>	
	</form>
</div>
</body>
</html>

<?php

    $connection = mysqli_connect("localhost", "root", "", "my_db");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    } 
 

    $db_select = mysqli_select_db($connection, "my_db");
    if (!$db_select) {
        die("Database selection failed: " . mysqli_connect_error());
    }
	if(isset($_POST['submit']))
	{	
	$email=$_POST['email'];
	$password=$_POST['password'];
	if(empty($email) || empty($password)) 
	{
		header("Location: login2.php");
	}
	else
	{
		$query="SELECT * FROM registration WHERE email='$email' AND password='$password'";
		$run=(mysqli_query($connection,$query));
    	if(!$run || mysqli_num_rows($run)>0)
    	{
    		session_start();
    		$_SESSION['email']=$email;
    		header("Location: loginside.php");
    	}	
    	else
    {
    	 echo '<script language="javascript">';echo 'alert("Wrong login info")';echo '</script>';
    }
	}
    

}

mysqli_close($connection);
?>