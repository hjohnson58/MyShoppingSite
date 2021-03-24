<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Shopping Cart</title>
<?php
// php library loading first
require("library/phpfunctions.php");

secure_test();

weapons_check('swords');
weapons_check('staves');
weapons_check('grenades');
weapons_check('pickaxes');

// local php startup code goes here
// local php startup code goes here
?>
</head>
<?php myheader() ?>
<body>
<h3>Check Out</h3>
<p><?php echo print_weapons('sw', $_SESSION['swords']);?></p>
<p><?php echo print_weapons('sw', $_SESSION['staves']);?></p>
<p><?php echo print_weapons('sw', $_SESSION['grenades']);?></p>
<p><?php echo print_weapons('sw', $_SESSION['pickaxes']);?></p>


<!--<form method="POST">
        <p>username: <input type="text" name="username155"></p>
        <p>password: <input type="password" name="password155"></p>
        <p><input type="submit" name="submit" value="Log In"></p>
</form>-->

<?php myfooter(); ?>
</body>
</html>
