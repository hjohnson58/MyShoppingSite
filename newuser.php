<!DOCTYPE html>
<!--  I honor Parkland's core values by affirming that I have 
followed all academic integrity guidelines for this work.
Henry Johnson 
CSC-155-201F_2021SP -->
<html>
<head>
<title>Henry J. - Site Login</title>
<?php
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
        
//php library loading first
require("library/phpfunctions.php");

//session_start();

//if (!isset($_SESSION['user'])) {
//	header("Location: login.php");
//}
// local php startup code goes here
if (isset($_POST["submit"])) {
        //this script is being reloaded
        if ($_POST["submit"] == "Create New Account") {
                //Login attempt
                
                if(empty($_POST['username155'])) {
                        $errormsg = 'CANNOT ACCEPT A BLANK USERNAME';
                }
                else if(empty($_POST['password155'])) {
                        $errormsg = 'CANNOT ACCEPT A BLANK PASSWORD';
                }
                else if($_POST['password155'] != $_POST['password155confirm']) {
                        $errormsg = 'THE PASSWORDS DO NOT MATCH';
                }
                else if(lookupUsername($conn, $_POST['username'], "users") != 0) {
                        $errormsg = 'That username was taken';
                }
                else {
                        $stmt = $conn->prepare("INSERT INTO users (username, encrypted_password, email, usergroup, balance) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $username, $encrypted_password, $email, $usergroup, $balance);
                        //set param
                        $username = getPost('username155');
                        $encrypted_password = password_hash($_POST['password155'], PASSWORD_DEFAULT);
                        $email = getPost('email155');
                        $usergroup = getPost('usergroup155');
                        if($usergroup == "admin") {
                                $balance = 5000;
                        }
                        else {
                                $balance = 100;
                        }
                        
                        $stmt->execute();
                        header("Location: login.php");
                }
        }
        else if ($_POST["submit"] == "Cancel") {
                header("Location: login.php");
        }
}
else {
        //no form info passed
}
if(!isset($errormsg)) {
        $errormsg = "";
}
?>
</head>
<body>
<?php// myheader() ?>
<h2>DO NOT USE A REAL PASSWORD! THIS IS A CLASS SITE!!!</h2>
<br><h3>Create a username, password(confirmed), email, and group</h3>
<form method="POST">
<p>username: <input type="text" name="username155" value='<?php echo getPost('username155');?>'></p>
<p>new password: <input type="password" name="password155" value='<?php echo getPost('password155');?>'> DO NOT USE A REAL PASSWORD</p>
<p>confirm password: <input type="password" name="password155confirm" value='<?php echo getPost('password155confirm');?>'> DO NOT USE A REAL PASSWORD</p>
<p>email: <input type="text" name="email155" value='<?php echo getPost('email155');?>'></p>
<p>group: <select name="usergroup155"></p>
<option>user</option>
<option>admin</option>
</select>
<p><input type="submit" name="submit" value="Create New Account"></p>
<p><input type="submit" name="submit" value="Cancel"></p>
<h1><b><?php echo $errormsg;?></b></h1>
</form>

<?//php myfooter(); ?>

</body>
</html>
