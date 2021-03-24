<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Site Welcome</title>
<?php
//php library loading first
require("library/phpfunctions.php");

// local php startup code goes here
secure_test();
?>
</head>
<?php myheader() ?>
<body>
<p>Welcome to the Page</p>
<!--<form method="POST">
        <p>username: <input type="text" name="username155"></p>
        <p>password: <input type="password" name="password155"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
</form>-->

<?php myfooter(); ?>

<?php echo $_SESSION['user'];?>
</body>
</html>
