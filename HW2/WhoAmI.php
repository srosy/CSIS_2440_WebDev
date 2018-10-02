<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>WhoAmI</title>
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
        <h1>WhoAmI Assignment</h1>
        <div id="main">
            <form action="WhoYouAre.php" method="post">
                <?php
                    print <<<TACO
                    Name: <input type="text" name="Name"><br>
                    
                    Age: <input type="text" name="Age"><br>
                    
                    Address: <input type="text" name="Address"><br>
                    
                    State: <input type="text" name="State"><br>
                    
                    Sex: <select name="Sex">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    </select><br>

                    <input type="submit" value="Submit" name="Create"><br>
                    <input type="hidden" value ="1" name="sneaky">
TACO;

                ?>
            </form>                          
        </div>
    </body>
</html>
