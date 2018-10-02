<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once 'DataBaseConnection.php';
$name = $_POST['name'];
$ac = $_POST['ac'];
$hd = $_POST['hd'];
$att = $_POST['att'];
$damage = $_POST['damage'];
$move = $_POST['move'];
$treasure = $_POST['treasure'];
$xp = $_POST['xp'];
$action = $_POST['action'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAC9qnMA9ubeAObKrAD///8A7s60AO7WvQDNupQA1bJ7AMWqcwD/8v8A//r2AM2qcwDevpwAtJ1aAN7StAC9oWIA//b2AN7CiwD27uYAtJlaAMWhYgCkhTEAzbqLAP/y7gD24s0A5trFAP/6/wD26t4AzaFiAN7KrADNtoMA/+7uAM2ycwD23s0A1cKcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMiHQMDAwMDAwMDAwMDAwMNBQMDAwMDAwMDGgkDAwMaHRwCAwMDAwMPGCIDAwMDAw4RGgMDAwMEAhUDAwMDARMhAwMDAwMDEQoCAwMDAw8aAwMDAwMDAyIDAwMDAx8eAwMDAwMDAwMYGQMDAwMgEgMDAwMDAwMDBwMDAwMBAAMDAwMDAwMDEgIaAwMKDQMDAwMDAwMDAwwJBQMhExoDAwMDAwMDAxsiFxYUBgMDAwMDAwMDAwMECAsQAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />
        <title>Monsterous Results</title>
        <meta name="viewport"
              content="width=device-width, initial-scale=1">      
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
                    <?php
                    // put your code here
                    //print_r($_POST);
                    switch ($action) {
                        case "insert":
                            $insert = "INSERT INTO `Library`.`waifus` (`MonsterName`, `MonsterAC`, `HitDice`, `MonsterAttack`, `MonsterDamage`, "
                                    . "`MonsterMove`, `MonsterTreasure`, `MonsterXP`, `Active`) VALUES ('$name', $ac, $hd,"
                                    . " $att,'$damage', $move,'$treasure',$xp,'N')";

                            $success = $con->query($insert);

                            if ($success == FALSE) {
                                $failmess = "Whole query " . $insert . "<br>";
                                echo $failmess;
                                die('Invalid query: ' . mysqli_error($con));
                            } else {
                                echo "$name was added<br>";
                            }

                            break;
                        case "update":
                            $update = "UPDATE `Library`.`waifus` SET `Active`='Y' "
                                    . "WHERE `MonsterName`='$name'";
                            $success = $con->query($update);
                            if ($success == FALSE) {
                                $failmess = "Whole query " . $update . "<br>";
                                echo $failmess;
                                die('Invalid query: ' . mysqli_error($con));
                            } else {
                                echo $name . " was made Active<br>";
                            }
                            break;
                        case "search":
                            $search = "SELECT * FROM Library.waifus where MonsterName Like '%$name%' Order by MonsterName";

                            $return = $con->query($search);

                            if (!$return) {
                                $message = "Whole query " . $search;
                                echo $message;
                                die('Invalid query: ' . mysqli_error($con));
                            }
                            echo "<table class='table'><thead><th>Name</th><th>AC</th><th>Hit Dice</th><th>XP</th></thead><tbody>";
                            while ($row = $return->fetch_assoc()) {
                                echo "<tr><td>Name: " . $row['MonsterName']
                                . "</td><td> AC: " . $row['MonsterAC']
                                . "</td><td> HD:" . $row['HitDice']
                                . " </td><td> XP:" . $row['MonsterXP'] . "</td></tr>";
                            }
                            echo "</tbody></table>";
                            break;
                        default: echo "This is bad<br>";
                    }
                    $con->close;
                    ?>
                    <a href="MonsterInterface.php">Back</a>
                    
                </div>
                
            </div>
        </div>

    </body>
</html>
