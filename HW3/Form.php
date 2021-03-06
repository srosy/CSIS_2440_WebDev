<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form</title>
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
        <h1>Form</h1>
        <div id="main">
            <form action="Results.php" method="post">
                <?php
                require_once 'DataBaseConnection.php';

                $search = "SELECT * FROM Library.Family Order by FirstName"; // Column name?

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
                    . "</td><td>"  . $row['LastName']
                    . "</td><td>"  . $row['PhoneNumber']
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
                echo "</tbody></table><br><br>";
                
                print <<<TACO
                    FirstName: <input type="text" name="FirstName"><br>
                    LastName: <input type="text" name="LastName"><br>

                    PhoneNumber: <input type="text" name="PhoneNumber"><br>

                    Address: <input type="text" name="Address"><br>
                    City: <input type="text" name="City"><br>
                    State: <input type="text" name="State"><br>
                    Zip: <input type="text" name="Zip"><br>

                    BirthDate: <input type="text" name="BirthDate"><br>

                    UserName: <input type="text" name="UserName"><br>
                    Password: <input type="text" name="Password"><br>

                    Sex: <select name="Sex">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select><br>

                    Relationship: <input type="text" name="Relationship"><br><br>
TACO;
                    print "To Update Password, change password in form and press Update.<br><br>";
?>
                
                    <input type="submit" value="Create" name="action" class = "btn btn-default"><br>
                    <input type="submit" value="Update" name="action" class = "btn btn-default"><br>
                    <input type="submit" value="Search" name="action" class = "btn btn-default"><br>

                    </form>                          
                    </div>
                    </body>
                    </html>
