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

        <script type="text/javascript">
            // Form validation code will come here.

            //var test = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;


            function validate()
            {
                var testName = /^[a-zA-Z]+$/;
                var testPhoneNumber = /^[0-9]+$/;

                if (document.myForm.FirstName.value === "" || document.myForm.LastName.value === ""
                        || testName.test(document.myForm.FirstName.value) === false ||
                        testName.test(document.myForm.LastName.value) === false)
                {
                    alert("Please provide both your first and last name!");
                    document.myForm.FirstName.focus();
                    return false;
                }

                if (document.myForm.PhoneNumber.value === "" || testPhoneNumber.test(document.myForm.PhoneNumber.value) === false)
                {
                    alert("Please provide your phone number!");
                    document.myForm.PhoneNumber.focus();
                    return false;
                }

                if (document.myForm.Address.value === "")
                {
                    alert("Please provide an address!");
                    document.myForm.Address.focus();
                    return false;
                }

                if (document.myForm.City.value === "")
                {
                    alert("Please provide a city!");
                    document.myForm.City.focus();
                    return false;
                }

                if (document.myForm.State.value === "")
                {
                    alert("Please provide a state!");
                    document.myForm.State.focus();
                    return false;
                }

                if (document.myForm.Zip.value === "" ||
                        isNaN(document.myForm.Zip.value) ||
                        document.myForm.Zip.value.length !== 5)
                {
                    alert("Please provide a zip in the format #####.");
                    document.myForm.Zip.focus();
                    return false;
                }

                if (document.myForm.BirthDate.value === "")
                {
                    alert("Please provide a Birth Date");
                    document.myForm.BirthDate.focus();
                    return false;
                }

                if (document.myForm.UserName.value === "")
                {
                    alert("Please provide a user name");
                    document.myForm.UserName.focus();
                    return false;
                }

                if (document.myForm.Password.value === "")
                {
                    alert("Please provide a Password");
                    document.myForm.Password.focus();
                    return false;
                }
                if (document.myForm.Sex.value === "")
                {
                    alert("Please provide a Sex");
                    document.myForm.Sex.focus();
                    return false;
                }

                if (document.myForm.Relationship.value === "")
                {
                    alert("Please provide a Relationship.");
                    document.myForm.Relationship.focus();
                    return false;
                }


                return(true);
            }
        </script>
    </head>


    <body>
        <h1>Form</h1>
        <div id="main">
            <form onsubmit="return (validate());" action="Results.php" method="post" name="myForm">
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
                echo "</tbody></table><br><br>";
                ?>

                <b>First Name:</b> <input type="text" name="FirstName"><br>
                <b>Last Name:</b> <input type="text" name="LastName"><br>

                <b>Phone Number:</b> <input type="text" name="PhoneNumber"><br>

                <b>Address:</b> <input type="text" name="Address"><br>
                <b>City:</b> <input type="text" name="City"><br>
                <b>State:</b> <input type="text" name="State"><br>
                <b>Zip:</b> <input type="text" name="Zip"><br>

                <b>Birth Date:</b> <input type="text" name="BirthDate"><br>

                <b>User Name:</b> <input type="text" name="UserName"><br>
                <b>Password:</b> <input type="text" name="Password"><br>

                <b>Sex: </b> <select name="Sex">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select><br>

                <b>  Relationship:</b> <input type="text" name="Relationship"><br><br>

                <?php
                print "To Update Password, change password in form and press Update.<br><br>";
                ?>

                <input type="submit" value="Create" name="action" class = "btn btn-default"><br>
                <input type="submit" value="Update" name="action" class = "btn btn-default"><br>
                <input type="submit" value="Search" name="action" class = "btn btn-default"><br>
            </form>                          
        </div>
    </body>
</html>
