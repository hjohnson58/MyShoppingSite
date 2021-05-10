<?php
echo "<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->";
function myfooter() {
        echo "<p style='text-align:center; position: fixed; left: 0; bottom: 0; width: 100%;'>";
        echo "CSC-155-201F_2021SP";
        echo "&nbsp;|&nbsp;";
        echo "<img src='library/images/avatar.png' alt='Gomez' width='100' height='100'>";
        echo "&nbsp;|&nbsp;";
	echo "Henry Johnson";
        echo "</p>";
}
function myheader() {
if(isset($_COOKIE["color"])) {
        $color = $_COOKIE["color"];
}
else {
        $color = "gray";
}

if(isset($_COOKIE["ordername"])) {
        $name = $_COOKIE["ordername"];
}
else {
        $name = "Noone";
}
        echo "<table cellpadding='4' align='center' bgcolor='$color'><tr style='text-align: center; vertical-align: middle; height: 50px; position: relative;'><td style='text-align: center; vertical-align: middle; height: 50px; position: relative;'>";
        echo "<strong>"; 
        echo "<img src='library/images/mylogo.png' alt='StoreIcon' width='50' height='50'>";
       // echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/login.php'>Login</a>";
       // echo "&nbsp;|&nbsp;";
        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/welcome.php'>Welcome</a>";
        echo "&nbsp;|&nbsp;";
		foreach (array("swords","staves","grenades","pickaxes") as $weapon) {
			echo "<a href='" . $weapon . ".php'>" . $weapon . "</a>";
			echo "&nbsp;|&nbsp;";
			//echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/swords.php'>Swords</a>";
			//echo "&nbsp;|&nbsp;";
			//echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/staves.php'>Staves</a>";
			//echo "&nbsp;|&nbsp;";
			//echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/grenades.php'>Grenades</a>";
			//echo "&nbsp;|&nbsp;";
			//echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/pickaxes.php'>Pickaxes</a>";
			//echo "&nbsp;|&nbsp;";
		}
        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/shoppingcart.php'>Shopping Cart</a>";
        echo "&nbsp;|&nbsp;";
        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/sellback.php'>Sell Back</a>";
        echo "&nbsp;|&nbsp;";
        if(isset($_SESSION['group'])) {
                if($_SESSION['group'] == 'admin') {
                        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/displayusers.php'>Display Users</a>";
                        echo "&nbsp;|&nbsp;";
                        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/displayorders.php'>Display Orders</a>";
                        echo "&nbsp;|&nbsp;";
                }
        }
        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/logout.php'>Logout</a>";
        echo "&nbsp;|&nbsp;"; 
        echo "$name was here";
        echo "</strong>";
        echo "</td></td></table>";
}

function secure_test() {
	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: login.php");
	}
}

function getPost ($name) {
        if( isset($_POST[$name]) ) {
                return htmlspecialchars($_POST[$name]);
        }
        return "";
}

function print_weapons($letters, $times) {
	if ($letters == 'sw') {
		echo $times;
		for ($i = 0; $i < $times; $i++) {
			echo " ->===> ";
		}
	}
	elseif ($letters == 'st') {
		echo $times;
		for ($i = 0; $i < $times; $i++) {
			echo " -}-o ";
		}
	}
	elseif ($letters == 'g') {
		echo $times;
		for ($i = 0; $i < $times; $i++) {
			echo " Q";
		}
	}
	elseif ($letters == 'p') {
		echo $times;
		for ($i = 0; $i < $times; $i++) {
			echo " -=-} ";
		}
	}
}

function weapons_check($weapon) {
	if (!isset($_SESSION[$weapon])) {
		$_SESSION[$weapon] = 0;
	}
}

function add_or_remove_weapon($weapon) {
	if (!isset($_SESSION[$weapon])) {
		$_SESSION[$weapon] = 0;
	}

	if (isset($_POST['submit'])) {
		if ($_POST['submit'] == 'Buy 1') {
			$_SESSION[$weapon]++;
		}
		else if ($_POST['submit'] == 'Buy 10') {
			$_SESSION[$weapon] = $_SESSION[$weapon] + 10;
		}
		else if ($_POST['submit'] == 'Buy 100') {
			$_SESSION[$weapon] = $_SESSION[$weapon] + 100;
		}
		else if ($_POST['submit'] == 'Remove 1') {
			if ($_SESSION[$weapon] > 0) {
				$_SESSION[$weapon]--;
			}
		}
		else if ($_POST['submit'] == 'Remove 10') {
			if ($_SESSION[$weapon] > 0) {
				$_SESSION[$weapon] = $_SESSION[$weapon]-10;
			}
		}
		else if ($_POST['submit'] == 'Remove 100') {
			if ($_SESSION[$weapon] > 0) {
				$_SESSION[$weapon] = $_SESSION[$weapon]-100;
			}
		}
		else if ($_POST['submit'] == 'Remove All') {
			$_SESSION[$weapon]=0;
		}
	}
}

function testinput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}


function lookupUsername($conn, $username, $table) {
        $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows == 0) {
                //Does not exist yet
                return 0;
        }
        elseif($num_rows > 1) {
                //too many results exits
                header("Location: goodbye.php");
        }
        else {
                //One result means username is taken
                return $result->fetch_assoc();
        }
}

function lookupGroup($conn, $username) { 
        $stmt = $conn->prepare("SELECT usergroup FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $value = $result->fetch_object();
        $group = $value->usergroup;
        return $group;
}

function printUsers($conn) {
        $sql = "SELECT id, username, encrypted_password, usergroup, email, balance FROM users";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0) {
                echo "<table style='text-align:center; position: fixed; left: 25%; width: 50%; background-color: gray; border-collapse: collapse;'>";
                        echo "<tr style='border: 1px solid black;'><td style='border: 1px solid black;'>ID: </td><td style='border: 1px solid black;'>Username: </td><td style='border: 1px solid black;'>Encrypted_Password: </td>";
                        echo "<td style='border: 1px solid black;'>Usergroup: </td><td style='border: 1px solid black;'>Email: </td><td style='border: 1px solid black;'>Balance: </td></tr>";
                while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['encrypted_password']."</td>";
                        echo "<td>".$row['usergroup']."</td><td>".$row['email']."</td><td>".$row['balance']."</tr>";
                }
                echo "</table>";
        }
}

function printOrders($conn) {
        $sql = "SELECT id, username, time, swords, staves, grenades, pickaxes FROM shoppingcart";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0) {
                echo "<table style='text-align:center; position: fixed; left: 25%; width: 50%; background-color: gray; border-collapse: collapse;'>";
                        echo "<tr style='border: 1px solid black;'><td style='border: 1px solid black;'>ID: </td><td style='border: 1px solid black;'>Username: </td><td style='border: 1px solid black;'>Time: </td>";
                        echo "<td style='border: 1px solid black;'>Swords: </td><td style='border: 1px solid black;'>Staves: </td>";
                        echo "<td style='border: 1px solid black;'>Grenades: </td><td style='border: 1px solid black;'>Pickaxes: </td></tr>";
                while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['time']."</td>";
                        echo "<td>".$row['swords']."</td><td>".$row['staves']."</td>";
                        echo "<td>".$row['grenades']."</td><td>".$row['pickaxes']."</td></tr>"; 
                }
                echo "</table>";
        }
}

function printMoney($conn) {
        if($_SESSION['group'] == "admin") {
                if(isset($_POST['submit'])) {
                        if($_POST['submit'] == "1") {
                                addMoney($conn,1);
                        }
                        elseif($_POST['submit'] == "10") {
                                addMoney($conn,10);
                        }
                        elseif($_POST['submit'] == "100") {
                                addMoney($conn,100);
                        }
                        elseif($_POST['submit'] == "1000") {
                                addMoney($conn,1000);
                        }
                        elseif($_POST['submit'] == "10000") {
                                addMoney($conn,10000);
                        }
                }
                //Form for adding money
                echo "<div style='text-align:center; position: relative; left: 25%; width: 50%;'>";
                echo "<p>Add money(admin only): </p>";
                echo "<form method='POST'>";
                echo "";
                echo "<p><input type='submit' name='submit' value='1'>";
                echo "<input type='submit' name='submit' value='10'>";
                echo "<input type='submit' name='submit' value='100'>";
                echo "<input type='submit' name='submit' value='1000'>";
                echo "<input type='submit' name='submit' value='10000'></p>";
                echo "</form>";
                echo "</div>";
        }
}
function stealMoney($conn) {
        if($_SESSION['group'] == "admin") {
                if(isset($_POST['submit'])) {
                        if($_POST['submit'] == "-1") {
                                subtractMoney($conn,1);
                        }
                        elseif($_POST['submit'] == "-10") {
                                subtractMoney($conn,10);
                        }
                        elseif($_POST['submit'] == "-100") {
                                subtractMoney($conn,100);
                        }
                        elseif($_POST['submit'] == "-1000") {
                                subtractMoney($conn,1000);
                        }
                        elseif($_POST['submit'] == "-10000") {
                                subtractMoney($conn,10000);
                        }
                }
                //Form for adding money
                echo "<div style='text-align:center; position: relative; left: 25%; width: 50%;'>";
                echo "<p>Subtract money(admin only): </p>";
                echo "<form method='POST'>";
                echo "<p><input type='submit' name='submit' value='-1'>";
                echo "<input type='submit' name='submit' value='-10'>";
                echo "<input type='submit' name='submit' value='-100'>";
                echo "<input type='submit' name='submit' value='-1000'>";
                echo "<input type='submit' name='submit' value='-10000'></p>";
                echo "</form>";
                echo "</div>";
        }
}

function addMoney($conn,$money) {
        $stmt = $conn->prepare("UPDATE users SET balance=?+balance WHERE username=?");
        $stmt->bind_param("is", $money, $username);
        //set param
        $username = $_SESSION['user'];                        
        $stmt->execute();
        echo "<p style='text-align:center;'>Added ".$money." money!</p>";
}

function subtractMoney($conn,$money) {
        $stmt = $conn->prepare("UPDATE users SET balance=balance-? WHERE username=?");
        $stmt->bind_param("is", $money, $username);
        //set param
        $username = $_SESSION['user'];
        $sql = "SELECT balance FROM users WHERE username='".$_SESSION['user']."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($row['balance'] - $money < 0) {
                echo "<p style='text-align:center;'>Cannot go under 0 money!</p>";
                return 11;
        }
        else {
                $stmt->execute();
                echo "<p style='text-align:center;'>Subtracted ".$money." money!</p>";
                return 0;
        }                                
}

function checkItem($conn, $item, $sellitem) {
        $sql = "SELECT ".$item." FROM shoppingcart WHERE username='".$_SESSION['user']."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($row[$item] - $sellitem < 0) {
                echo "<p style='text-align:center;'>Cannot go under 0 ".$item."</p>";
                return 11;
        }
        else {
                //echo "<p style='text-align:center;'>Item can be subtracted by sellitem</p>";
                return 0;
        }                                
}

?>
