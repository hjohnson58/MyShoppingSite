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

if(isset($_POST['submit'])) {
        setcookie("color", $_POST['color'], time() + (86400 * 30));
        $temp_name = testinput($_POST['ordername']);
        setcookie("ordername", $temp_name, time() + (86400 *30));
}
?>
</head>
<?php myheader() ?>
<body>
<p>Welcome to the Page</p>
<form method='POST'>
<table border='1'>
<tr><td colspan='2'>Account Settings</td></tr>
<tr><td>Header Background Color</td><td>
<select name='color'>
<option>white</option>
<option>dodgerblue</option>
<option>hotpink</option>
</select>
</td></tr>
<tr><td>Input a Name</td>
<td><input type ='text' name ='ordername'></td></tr>
<tr><td colspan='2'><input type='submit' name='submit' value='Set Attributes'></td></tr>
</form>
<!--<form method="POST">
        <p>username: <input type="text" name="username155"></p>
        <p>password: <input type="password" name="password155"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
</form>-->

<?php myfooter(); ?>

<?php echo $_SESSION['user'];?>
</body>
</html>
