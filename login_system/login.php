<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="registration.css">
</head>
<body >
	<div id="main">
	<h1><strong>Registration Form</strong></h1>
	<form action="login.php" method="post">
	<fieldset class="loginBox"> 
		<input type="text" name="name" placeholder="Your name"><br>
	</fieldset>
	<fieldset class="loginBox">
		<input type="email" name="email" placeholder="Your email"><br>
	</fieldset>
	<fieldset class="loginBox">
		<input type="password" name="password" placeholder="Your password"><br>
	</fieldset>
	<fieldset class="loginBox">
		<input type="tel" name="phone" placeholder="Your phone number"><br>
	</fieldset>
	<fieldset class="loginBox">
        <label >Gender:</label>
        <input name="gender" id="male" type="radio"  value="Male">
        <label for="male">Male</label>
        <input name="gender" type="radio" id="female" value="Female">
        <label for="female">Female</label>
	<fieldset class="loginBox">
        Select the Events for which you want to get updates:<br>
        <input type="checkbox" name="events[]" value="GigaHertz">GigaHertz
        <input type="checkbox" name="events[]" value="Acoustic">Acoustic
        <input type="checkbox" name="events[]" value="Create a scene">Create a Scene
        <input type="checkbox" name="events[]" value="Filmy gyaan">Filmy Gyaan
        <input type="checkbox" name="events[]" value="Classical Beats">Classical Beats
        <input type="checkbox" name="events[]" value="Free style solo">Free Style Solo
      </fieldset>
	<fieldset  >
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
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$gender=$_POST['gender'];
	$events=$_POST['events'];
	$phone=$_POST['phone'];
	if(empty($name) || empty($email) || empty($password) || empty($gender) || empty($events) || empty($phone))
	{
		echo '<script language="javascript">';echo 'alert("Fill all values")';echo '</script>';
		header("Location: login.php?Fill all values");
		exit;	
	}
	$quer="SELECT * FROM registration WHERE email='$email'";
		$run=(mysqli_query($connection,$quer));
    	if(!$run || mysqli_num_rows($run)>0)
    	{
    		header("Location: login.php?Username already registered");
    		exit;
    	}	
	else
	{
		$event=implode(',',$events);
		$query= "INSERT INTO registration(name,email,password,gender,events,phone)
		VALUES ('$name','$email','$password','$gender','$event','$phone')";

    }	
	if (mysqli_query($connection, $query)) {
    echo '<script language="javascript">';echo 'alert("Thanks for registering")';echo '</script>';
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
}

mysqli_close($connection);
?>