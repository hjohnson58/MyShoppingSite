<?php
echo "<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->";
function myfooter() {
        echo "<center>";
        echo "CSC-155-201F_2021SP";
        echo "&nbsp;|&nbsp;";
        echo "<img src='library/images/avatar.png' alt='Gomez' width='100' height='100'>";
        echo "&nbsp;|&nbsp;";
	echo "Henry Johnson";
        echo "</center>";
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
        echo "<table cellpadding='4' align='center' bgcolor='$color'><tr><td>";
        echo "<center><strong>"; 
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
        echo "<a href='http://www.csit.parkland.edu/~hjohnson58/csc155labs/php/phpsites/logout.php'>Logout</a>";
        echo "&nbsp;|&nbsp;";
        echo "$name was here";
        echo "</strong></center>";
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
		for ($i = 0; $i < $times; $i++) {
			echo " -}-o ";
		}
	}
	elseif ($letters == 'g') {
		for ($i = 0; $i < $times; $i++) {
			echo " Q";
		}
	}
	elseif ($letters == 'p') {
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
		if ($_POST['submit'] == 'Buy One') {
			$_SESSION[$weapon]++;
		}
		else if ($_POST['submit'] == 'Buy Ten') {
			$_SESSION[$weapon] = $_SESSION[$weapon] + 10;
		}
		else if ($_POST['submit'] == 'Remove One') {
			if ($_SESSION[$weapon] > 0) {
				$_SESSION[$weapon]--;
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

?>
