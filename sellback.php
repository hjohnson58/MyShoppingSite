<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - SellBack</title>
<?php
// php library loading first
require("library/phpfunctions.php");

secure_test();

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

weapons_check('sellswords');
weapons_check('sellstaves');
weapons_check('sellgrenades');
weapons_check('sellpickaxes');


// local php startup code goes here
// local php startup code goes here

if(lookupUsername($conn, $_SESSION['user'], "shoppingcart") != 0) {
        $my_sql = "SELECT swords, staves, grenades, pickaxes FROM shoppingcart WHERE username='".$_SESSION['user']."'";
        $my_result = $conn->query($my_sql);
        $my_row = $my_result->fetch_assoc();

        $my_swords = $my_row['swords'];
        $my_staves = $my_row['staves'];
        $my_grenades = $my_row['grenades'];
        $my_pickaxes = $my_row['pickaxes'];
}
function sellback($conn) {
        if(isset($_POST['submit'])) {
                if($_POST['submit'] == "Sell Back") { 
                        //If user does not exist create a new row
                        date_default_timezone_set("America/Chicago"); 
                        if(lookupUsername($conn, $_SESSION['user'], "shoppingcart") != 0) {
                                $stmt = $conn->prepare("UPDATE shoppingcart SET time=?, swords=swords-?, staves=staves-?, grenades=grenades-?, pickaxes=pickaxes-? WHERE username=?");
                                $stmt->bind_param("siiiis", $time, $swords, $staves, $grenades, $pickaxes, $username);
                                //set param
                                $username = $_SESSION['user'];
                                $time = "Posted ".date('Y-m-d')." at ".date('h:i:sa');
                                $swords = testinput($_POST['swords']);
                                $staves = testinput($_POST['staves']);
                                $grenades = testinput($_POST['grenades']);
                                $pickaxes = testinput($_POST['pickaxes']);
                                
                                $check_over = 0;
                                
                                if(checkItem($conn, "swords", $swords) != 0) {
                                        $check_over = 1;
                                }
                                if(checkItem($conn, "staves", $staves) != 0) {
                                        $check_over = 1;
                                }
                                if(checkItem($conn, "grenades", $grenades) != 0) {
                                        $check_over = 1;
                                }
                                if(checkItem($conn, "pickaxes", $pickaxes) != 0) {
                                        $check_over = 1;
                                }
                                
                                $money = ($swords + $staves + $grenades + $pickaxes)*10;
                                if($check_over == 0) {
                                        addMoney($conn, $money);
                                        $stmt->execute();
                                        echo "<p style='text-align:center;'>Updated the user record!</p>";
                                }
                                else {
                                        //echo "<p style='text-align:center;'>Remove some items to be able to purchase the rest</p>";
                                }
                                //header("Location: login.php");
                        } 
                        //If it does then add values to that username row, do
                        //not create a new row
                        else {
                                echo "<p style='text-align:center;'>Please purchase something before trying to sell us stuff</p>";
                        }
                }
        }
}
?>
</head>
<?php myheader();
sellback($conn);
 ?>
<body>
<div style="text-align:center;">
<h3>Sell Back</h3>
<?php 
if(lookupUsername($conn, $_SESSION['user'], "shoppingcart") != 0) {
?>
<p>Swords in database: <?php echo print_weapons('sw', $my_swords);?></p>
<br><p>Staves in database: <?php echo print_weapons('st', $my_staves);?></p>
<br><p>Grenades in database: <?php echo print_weapons('g', $my_grenades);?></p>
<br><p>Pickaxes in database: <?php echo print_weapons('p', $my_pickaxes);?></p>
<br>
<?php } 
else {
        echo "<p style='text-align:center;'>You have not purchased any weapons yet</p>";
}
?>


<form method="POST">
        <p>Sell Swords: <input type="number" name="swords" value="0" required></p>
        <p>Sell Staves: <input type="number" name="staves" value="0" required></p>
        <p>Sell Grenades: <input type="number" name="grenades" value="0" required></p>
        <p>Sell Pickaxes: <input type="number" name="pickaxes" value="0" required></p>
        <p><input type="submit" name="submit" value="Sell Back"></p>
</form>
</div>
<?php myfooter(); ?>
</body>
</html>
