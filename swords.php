<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Buy Swords</title>
<?php
// php library loading first
require("library/phpfunctions.php");
secure_test();
weapons_check('swords');
add_or_remove_weapon('swords');

// local php functions go here

// local php startup code goes here


?>
</head>
<?php myheader() ?>
<body>
<p>Need a trusty blade?</p>
<form method="POST">
<input type="submit" name="submit" value="Buy One">
<input type="submit" name="submit" value="Buy Ten">
<input type="submit" name="submit" value="Remove One">
<input type="submit" name="submit" value="Remove All">

</form>

<p>You currently have <?php echo $_SESSION['swords'];?> swords</p>
<p><?php echo print_weapons('sw', $_SESSION['swords']);?></p>

<?php myfooter(); ?>
</body>
</html>
