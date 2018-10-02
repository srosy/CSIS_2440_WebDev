<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Story Idea Generator</title>
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
        <h1>WhoYouAre Assignment</h1>
        <div id="main">
            <?php
            //Declare Variables, get with POST
            $name = htmlentities($_POST['Name']);
            $name = strtolower($name);
            $name = ucwords($name);
            $age = $_POST['Age'];
            $sex = $_POST['Sex'];
            $state = $_POST['State'];
            $address = $_POST['Address'];
            $file = explode("\n", file_get_contents('text.txt')); // get the file and split it into arry at every new line.
            //Changing background color
            if ($sex == "M") {
                echo '<body style="background-color:green">';
            }

            //Print variables with printf
            printf("Name: %s <br>Age: %d<br>Address: %s<br>State: %s<br>Sex: %s<br><br>", $name, $age, $address, $state, $sex);

            // print the years back depending on age entered.
            echo 'Years:<br>';
            for ($i = (int) date(Y); $i >= 2018 - (int) $age; $i--) {
                printf("%s<br>", $i);
            }

            // Text File
            echo '<br>Text File:<br>';
            for ($i = 0; $i < sizeof($file); $i++) {
                printf("%s<br>", $file[$i]);
            }
            ?>                        
        </div>
    </body>
</html>
