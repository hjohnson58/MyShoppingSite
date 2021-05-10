<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Buy Staves</title>
<?php
// php library loading first
require("library/phpfunctions.php");
secure_test();
weapons_check('staves');
add_or_remove_weapon('staves');

// local php functions go here

// local php startup code goes here

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

?>
</head>
<?php myheader() ?>
<body>
<p style="text-align:center;">You're a user of the art huh?</p>
<div style="text-align:center;">
<form method="POST">
<input type="submit" name="submit" value="Buy 1">
<input type="submit" name="submit" value="Buy 10">
<input type="submit" name="submit" value="Buy 100">
<input type="submit" name="submit" value="Remove 1">
<input type="submit" name="submit" value="Remove 10">
<input type="submit" name="submit" value="Remove 100">
<input type="submit" name="submit" value="Remove All">

</form>

<p>You currently have <?php echo $_SESSION['staves'];?> staves</p>
<p><?php echo print_weapons('st', $_SESSION['staves']);?></p>
</div>
<?php 
        printMoney($conn);
        stealMoney($conn);
 ?>
<?php myfooter(); ?>
</body>
</html>
