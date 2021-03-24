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

//if (!isset($_SESSION['user'])) {
//	header("Location: login.php");
//}
// local php startup code goes here
if (isset($_POST["submit"])) {
        //this script is being reloaded
        if ($_POST["submit"] == "Log In") {
                //Login attempt
                if ($_POST["username155"] == "henry" and $_POST["password155"] == "Passw0rd") {
                        $_SESSION['user'] = $_POST['username155'];
						header("Location: welcome.php");
                }
                else {
                        echo "Invalid username or password";
                }
        }
        else if ($_POST["submit"] == "Create New Account") {
                echo "OK: I created username: 'henry' and password: 'Passw0rd'";               
        }
        else if ($_POST["submit"] == "Forgot your password?") {
                echo "Hint: try 'henry' and 'Passw0rd'";               
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
