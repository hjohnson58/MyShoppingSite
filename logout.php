<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->";
<html>
<head>
<title>Henry J. - Site</title>
<?php
// php library loading first
require("library/phpfunctions.php");


// local php startup code goes here
// local php startup code goes here
secure_test();
unset( $_SESSION['user'] );
header( "refresh:5;url=login.php" );

?>
</head>
<body>
<?php myheader() ?>
<center><b><p>Thanks for visiting!</p></b></center>
<!--<form method="POST">
        <p>username: <input type="text" name="username155"></p>
        <p>password: <input type="password" name="password155"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
</form>-->

<?php myfooter(); ?>
</body>
</html>
