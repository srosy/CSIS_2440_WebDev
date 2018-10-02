<!DOCTYPE html>
<?php
require_once 'DataBaseConnection.php';

$action = $_POST['action'];

//Get first and last name in correct case
$firstName = htmlentities($_POST['FirstName']);
$firstName = strtolower($firstName);
$firstName = ucwords($firstName);

$lastName = htmlentities($_POST['LastName']);
$lastName = strtolower($lastName);
$lastName = ucwords($lastName);

$name = $firstName . " " . $lastName;

$phoneNumber = $_POST['PhoneNumber'];


$address = $_POST['Address'];
$city = $_POST['City'];
$state = $_POST['State'];
$zip = $_POST['Zip'];

$birthDate = $_POST['BirthDate'];

$userName = $_POST['UserName'];
$password = hash("ripemd128", $_POST['Password']);

$sex = $_POST['Sex'];
$relationship = $_POST['Relationship'];
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>Results</title>
        <style>
            body {
                font-family: "Trebuchet MS", Verdana, sans-serif;
                font-size: 16px;
                background-color: dimgrey; 
                color: #696969;
                padding: 3px;
            }

            #main {
                padding: 5px;
                padding-left:  15px;
                padding-right: 15px;
                background-color: #ffffff;
                border-radius: 0 0 5px 5px;
            }

            h1 {
                font-family: Georgia, serif;
                border-bottom: 3px solid #cc9900;
                color: #996600;
                font-size: 30px;
            }
        </style>
    </head>
    <body>
        <h1>Results</h1>
        <div id="main">
            <?php
            //print_r($_POST);
            switch ($action) {

                case "Create":
                    $insert = "INSERT INTO `Library`.`Family` (`FirstName`, `LastName`, `PhoneNumber`, `Address`, `City`, "
                            . "`State`, `Zip`, `BirthDate`, `UserName`, `Password`, `Sex`, `Relationship`) "
                            . "VALUES ('$firstName', '$lastName', '$phoneNumber', '$address', '$city', '$state',"
                            . " '$zip','$birthDate', '$userName', '$password', '$sex', '$relationship')";
                    $success = $con->query($insert);

                    if ($success == FALSE) {
                        $failmess = "Whole query " . $insert . "<br>";
                        echo $failmess;
                        die('Invalid query: ' . mysqli_error($con));
                    } else {
                        echo "$name was added<br>";
                    }

                    break;
                case "Update":
                    $update = "UPDATE `Library`.`Family` SET `Password`='$password' "
                            . "WHERE `UserName`='$userName'";
                    $success = $con->query($update);
                    if ($success == FALSE) {
                        $failmess = "Whole query " . $update . "<br>";
                        echo $failmess;
                        die('Invalid query: ' . mysqli_error($con));
                    } else {
                        echo "Password changed for " . $name . "<br>";
                    }
                    break;
                case "Search":
                    $search = "SELECT * FROM Library.Family where FirstName Like '%$firstName%' AND LastName Like '%$lastName%' Order by FirstName";

                    $return = $con->query($search);

                    if (!$return) {
                        $message = "Whole query " . $search;
                        echo $message;
                        die('Invalid query: ' . mysqli_error($con));
                    }
                    echo "<table class='table'><thead><th>First Name</th><th>Last Name</th>"
                    . "<th>Phone Number</th><th>Address</th><th>City</th><th>State</th><th>Zip</th>"
                    . "<th>Birth Date</th><th>Username</th><th>Password</th><th>Sex"
                    . "</th><th>Relationship</th></thead><tbody>\n";
                    while ($row = $return->fetch_assoc()) {
                        echo "<tr><td>"
                        . $row['FirstName']
                        . "</td><td>" . $row['LastName']
                        . "</td><td>" . $row['PhoneNumber']
                        . " </td><td>" . $row['Address']
                        . " </td><td>" . $row['City']
                        . " </td><td>" . $row['State']
                        . " </td><td>" . $row['Zip']
                        . " </td><td>" . $row['BirthDate']
                        . " </td><td>" . $row['UserName']
                        . " </td><td>" . $row['Password']
                        . " </td><td>" . $row['Sex']
                        . " </td><td>" . $row['Relationship']
                        . "</td></tr>\n";
                    }
                    echo "</tbody></table><br>";
                    break;
                default: echo "This is bad<br>";
            }
            $con->close;
            ?>
        </div>
        <form action="http://ec2-35-165-192-237.us-west-2.compute.amazonaws.com/CSIS2440/Homework/HW3/Form.php">
            <input type="submit" value="Back" />
        </form>

    </body>
</html>
