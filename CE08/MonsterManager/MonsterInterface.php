<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAC9qnMA9ubeAObKrAD///8A7s60AO7WvQDNupQA1bJ7AMWqcwD/8v8A//r2AM2qcwDevpwAtJ1aAN7StAC9oWIA//b2AN7CiwD27uYAtJlaAMWhYgCkhTEAzbqLAP/y7gD24s0A5trFAP/6/wD26t4AzaFiAN7KrADNtoMA/+7uAM2ycwD23s0A1cKcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMiHQMDAwMDAwMDAwMDAwMNBQMDAwMDAwMDGgkDAwMaHRwCAwMDAwMPGCIDAwMDAw4RGgMDAwMEAhUDAwMDARMhAwMDAwMDEQoCAwMDAw8aAwMDAwMDAyIDAwMDAx8eAwMDAwMDAwMYGQMDAwMgEgMDAwMDAwMDBwMDAwMBAAMDAwMDAwMDEgIaAwMKDQMDAwMDAwMDAwwJBQMhExoDAwMDAwMDAxsiFxYUBgMDAwMDAwMDAwMECAsQAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />
        <meta charset="UTF-8">
        <title>Monster Manager</title>
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
        <img src="images/dragon.png" alt=""/>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <?php
                    require_once 'DataBaseConnection.php';
                    print("<h4>Here is a list of the waifus we have in the Database</h4>");

                    $search = "SELECT * FROM Library.waifus Order by MonsterName";

                    $return = $con->query($search);

                    if (!$return) {
                        $message = "Whole query " . $search;
                        echo $message;
                        die('Invalid query: ' . mysqli_error($con));
                    }
                    echo "<table class='table'><thead><th>Name</th><th>AC</th><th>Hit Dice</th><th>XP</th><th>Active</th></thead><tbody>\n";
                    while ($row = $return->fetch_assoc()) {
                        echo "<tr><td>" . $row['MonsterName']
                        . "</td><td>" . $row['MonsterAC']
                        . "</td><td>" . $row['HitDice']
                        . " </td><td>" . $row['MonsterXP']
                        . " </td><td>" . $row['Active'] . "</td></tr>\n";
                    }
                    echo "</tbody></table>";
                    // put your code here
                    ?>
                </div>
                <div class="col-md-5 col-sm-5">
                    <form action="MonsterResult.php" method="post" role="form">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "name">Monster Name:</label>
                                    <input name='name'type="text" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "ac">Monster AC:</label>
                                        <input type="number" name="ac" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "hd">Hit Dice:</label>
                                        <input type="number" name="hd" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "att">Attack:</label>
                                    <input type="number" name="att" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "damage">Damage:</label>
                                    <input name='damage'type="text" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "move">Movement:</label>
                                    <input type="number" name="move" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "teasure">Treasure:</label>
                                    <select name='teasure' class = "form-control">
                                        <option value='--'>--</option>
                                        <?php
                                        for ($L = "A"; $L != "W"; $L++) {
                                            print("<option value='$L'>$L</option>\n");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <label for = "xp">Experience Value:</label>
                                    <input type="number" name="xp" class = "form-control">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class = "form-group">
                                    <input type="submit" value="insert" name='action' class = "btn btn-default">
                                    <input type="submit" value="update" name='action' class = "btn btn-default">
                                    <input type="submit" value="search" name='action' class = "btn btn-default">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
