<!DOCTYPE html>
<html>
<head>
    <title>Loginside</title>
    <link rel="stylesheet" type="text/css" href="loginside.css">
</head>
<body>
    <form action="loginside.php" method="POST">
    <button type="submit" name="log_out" value="submit" id="button">Log out</button>
    </form>
</body>


<?php
	session_start();
    $email=$_SESSION['email'];
    echo "<h3><strong>$email</strong></h3>";
    $connection = mysqli_connect("localhost", "root", "", "my_db");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    } 
 

    $db_select = mysqli_select_db($connection, "my_db");
    if (!$db_select) {
        die("Database selection failed: " . mysqli_connect_error());
    }
    

	
	$events="SELECT events FROM registration WHERE email='$email';";
    $phone="SELECT phone FROM registration WHERE email='$email';";
    $event=mysqli_query($connection,$events);
    $number=mysqli_query($connection,$phone);
    while ($row=mysqli_fetch_assoc($event)) {
        $show=$row['events'];
    }
    echo "<h1><br><strong>Your Events are</strong></h1>";
    if(strpos($show,"iga")!=FALSE)
    {
    
        echo "<h3 class=\"events\"><a href=\"./pages.htm\" >Giga Hertz</h3>";
    }
    if(strpos($show,"cous")!=FALSE)
    {
        echo "<h3 class=\"events\"><a href=\"./acou.htm\">Acoustics</h3>";
    }
    if(strpos($show,"ree")!=FALSE)
    {
        echo "<h3 class=\"events\"><a href=\"./free.htm\">Free Style Solo</h3>";
    }
    if(strpos($show,"eat")!=FALSE)
    {
        echo "<h3 class=\"events\"><a href=\"./class.htm\">Classical Beats</h3>";
    }
    if(strpos($show,"yaan")!=FALSE)
    {
        echo "<h3 class=\"events\"><a href=\"./film.htm\">Filmy Gyaan</h3>";
    }
    if(strpos($show,"cene")!=FALSE)
    {
        echo "<h3 class=\"events\"><a href=\"./cret.htm\">Create a Scene</h3>";
    }
    if(isset($_POST['log_out']))
    {
        
        session_destroy();
        header("Location: login2.php");
        exit;
    }

?>
</html>