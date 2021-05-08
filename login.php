<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Site Login</title>
<?php

//php library loading first
require("library/phpfunctions.php");

session_start();

//Create connection object
$user = "hjohnson58";
$conn = mysqli_connect("localhost",$user,$user,$user);
//Check connection
if(mysqli_connect_errno()) {
        echo "<b>Failed to connect to MySQL: " .mysqli_connect_error() ."</b>";
}
else {
        echo "Connect established";
}

//if (!isset($_SESSION['user'])) {
//	header("Location: login.php");
//}
// local php startup code goes here
if (isset($_POST["submit"])) {
        //this script is being reloaded
        if ($_POST["submit"] == "Log In") {
                //Login attempt
                $row = lookupUsername($conn, getPost('username155'));
                if ($row != 0 && password_verify($_POST['password155'], $row['encrypted_password'])) {
                        $_SESSION['user'] = $_POST['username155'];
		        header("Location: welcome.php");
                }
                else {
                        echo "Invalid username or password";
                }
        }
        else if ($_POST["submit"] == "Create New Account") {
                header("Location: newuser.php");               
        }
        else if ($_POST["submit"] == "Forgot your password?") {
                echo "Hint: try 'henry' and 'P@ssw0rd'";               
        }
}
else {
        //no form info passed
}

?>
</head>
<body>
<?php myheader() ?>
<h2>DO NOT USE A REAL PASSWORD! THIS IS A CLASS SITE!!!</h2>
<form method="POST">
<p>username: <input type="text" name="username155"></p>
<p>password: <input type="password" name="password155"> DO NOT USE A REAL PASSWORD</p>
<p><input type="submit" name="submit" value="Log In"></p>
<p><input type="submit" name="submit" value="Create New Account"></p>
<p><input type="submit" name="submit" value="Forgot your password?"></p>
</form>

<?php myfooter(); ?>

</body>
</html>
