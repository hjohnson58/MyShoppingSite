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

weapons_check('swords');
weapons_check('staves');
weapons_check('grenades');
weapons_check('pickaxes');

// local php startup code goes here
// local php startup code goes here

$my_sql = "SELECT balance FROM users WHERE username='".$_SESSION['user']."'";
$my_result = $conn->query($my_sql);
$my_row = $my_result->fetch_assoc();
$my_balance = $my_row['balance'];

function checkout($conn) {
        if(isset($_POST['submit'])) {
                if($_POST['submit'] == "Checkout") { 
                        //If user does not exist create a new row
                        date_default_timezone_set("America/Chicago"); 
                        if(lookupUsername($conn, $_SESSION['user'], "shoppingcart") == 0) {
                                $stmt = $conn->prepare("INSERT INTO shoppingcart (username, time, swords, staves, grenades, pickaxes) VALUES (?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("ssiiii", $username, $time, $swords, $staves, $grenades, $pickaxes);
                                //set param
                                $username = $_SESSION['user'];
                                $time = "Posted ".date('Y-m-d')." at ".date('h:i:sa');
                                $swords = $_SESSION['swords'];
                                $staves = $_SESSION['staves'];
                                $grenades = $_SESSION['grenades'];
                                $pickaxes = $_SESSION['pickaxes'];
                                
                                $money = ($swords + $staves + $grenades + $pickaxes)*10;
                                if(subtractMoney($conn,$money) == 0) {
                                        $stmt->execute();
                                        echo "<p style='text-align:center;'>Added a new user record!</p>";
                                        $_SESSION['swords'] = 0;
                                        $_SESSION['staves'] = 0;
                                        $_SESSION['grenades'] = 0;
                                        $_SESSION['pickaxes'] = 0;
                                }
                                else {
                                        echo "<p style='text-align:center;'>Remove some items to be able to purchase the rest</p>";
                                }
                                
                                //header("Location: login.php");
                        } 
                        //If it does then add values to that username row, do
                        //not create a new row
                        else {
                                $stmt = $conn->prepare("UPDATE shoppingcart SET time=?, swords=?+swords, staves=?+staves, grenades=?+grenades, pickaxes=?+pickaxes WHERE username=?");
                                $stmt->bind_param("siiiis", $time, $swords, $staves, $grenades, $pickaxes, $username);
                                //set param
                                $username = $_SESSION['user'];
                                $time = "Posted ".date('Y-m-d')." at ".date('h:i:sa');
                                $swords = $_SESSION['swords'];
                                $staves = $_SESSION['staves'];
                                $grenades = $_SESSION['grenades'];
                                $pickaxes = $_SESSION['pickaxes'];
                                
                                $money = ($swords + $staves + $grenades + $pickaxes)*10;
                                if(subtractMoney($conn,$money) == 0) {
                                        $stmt->execute();
                                        echo "<p style='text-align:center;'>Updated the user record!</p>";
                                        $_SESSION['swords'] = 0;
                                        $_SESSION['staves'] = 0;
                                        $_SESSION['grenades'] = 0;
                                        $_SESSION['pickaxes'] = 0;
                                }
                                else {
                                        echo "<p style='text-align:center;'>Remove some items to be able to purchase the rest</p>";
                                }
                                //header("Location: login.php");
                        }
                }
        }
}
?>
</head>
<?php myheader();
checkout($conn);
 ?>
<body>
<div style="text-align:center;">
<h3>Check Out</h3>
<h4>Balance: <?php echo $my_balance; ?></h4>
<p>Swords: <?php echo print_weapons('sw', $_SESSION['swords']);?></p>
<br><p>Staves: <?php echo print_weapons('st', $_SESSION['staves']);?></p>
<br><p>Grenades: <?php echo print_weapons('g', $_SESSION['grenades']);?></p>
<br><p>Pickaxes: <?php echo print_weapons('p', $_SESSION['pickaxes']);?></p>
<br>

<form method="POST">
       <!-- <input type="hidden" name="swords" value="">
        <input type="hidden" name="staves" value="">
        <input type="hidden" name="grenades" value="">
        <input type="hidden" name="pickaxes" value="">-->
        <p><input type="submit" name="submit" value="Checkout"></p>
</form>
</div>
<?php myfooter(); ?>
</body>
</html>
