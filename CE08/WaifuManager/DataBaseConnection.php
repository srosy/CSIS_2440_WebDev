<?php

$host = "localhost";
$user = "root";
$password = "DBAdmin";
$dbname = "Library";
echo $dbname;
//phpinfo();
$con = new mysqli($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error($con));
//print_r($con);
if ($con->connect_error == FALSE) {
    echo "<h2>We Connected</h2>";
} else {
    echo $con->connect_error;
}
?>

