<?php

session_start();
unset($_SESSION['badPass']);
// username and password sent from form
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];
// Connect to server and select database.
require_once 'DataBaseConnection.php';
// To protect MySQL injection
$myusername - mysql_fix_string($con, $myusername);
$mypassword - mysql_fix_string($con, $mypassword);

//hashing
$Hashed = hash("ripemd128", $mypassword);

/*
 * $sql = "SELECT * FROM ACME.FriendAndFamily WHERE username='"
        . $myusername . "' and thepassword='" . $Hashed . "'";
 */

$sql = "SELECT * FROM Library.Family WHERE UserName='"
        . $myusername . "' and Password='" . $Hashed . "'";
$result = $con->query($sql);

if (!$result) {
    $message = "Whole query " . $sql;
    echo $message;
    die('Invalid query: ' . mysqli_error());
}

// MySQL num_row is counting table row
$count = $result->num_rows;

// If results matched mysusername and mypassword, table row must be 1 row
if ($count == 1) {
    $_SESSION['user'] = $myusername;
    $_SESSION['password'] = $mypassword;
    // Register myusername, mypassword and redirect to file "login_success.php"
    header("Location:catalogue.php");
} else {
    header("Location:loginForm.php");
    $_SESSION['badPass']++;
    //echo "Wrong Username or Password";
}
?>