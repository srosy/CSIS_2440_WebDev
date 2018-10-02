<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
<!--        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA19fXAMCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIBAQECAgICAgICAQEBAgICAQABAgICAgICAgEAAQICAgEAAQECAgECAgEBAAEBAgIBAAAAAQEAAQEAAQAAAAEBAQABAQABAAEBAAEAAQEAAQEAAQEAAQABAQABAAEBAAEBAAEBAAEAAQEAAQABAQABAQAAAAEBAAAAAQEAAAABAQIBAQECAQABAQICAQEBAgICAgICAgEAAQICAgICAgICAgICAgIBAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />-->
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
        <h1>Story Idea Generator</h1>
        <div id="main">
            <form action="CE04.php" method="post">
                <?php
                
                if($_POST['sneaky']==0) {
                    print <<<TACO
                    Please Create a Character to put into the story.<br>
                    Name: <input type="text" name="Name"><br>
                Age: <input type="number" name="Age"><br>
                Gender: F<input type="radio" value="F" name="Gender" checked="true">  M<input type="radio" value="M" name="Gender"><br>
                Class: <select name="Class">
                    <option value="Detective">Detective</option>
                    <option value="Scientist">Scientist</option>
                    <option value="Soldier">Soldier</option>
                    <option value="Doctor">Doctor</option>
                </select><br>
                <input type="submit" value="Show Me" name="Create"><br>
                <input type="hidden" value ="1" name="sneaky">
TACO;
                } else {
                    $name = htmlentities($POST['Name']);
                    $name = strtolower($name);
                    $name = ucwords($name);
                    $age = $_POST['Age'];
                    $gender = $_POST['Gender'];
                    $class = $_POST['Class'];
                    
                    // reading in the files
                    $settings = explode("\n", file_get_contents('settings.txt'));
                    $objectives = explode("\n", file_get_contents('objectives.txt'));
                    $antagonists = explode("\n", file_get_contents('antagonists.txt'));
                    $complications = explode("\n", file_get_contents('complications.txt'));
                    
                    for($i=0; $i<sizeof($settings); $i++){
                        echo $settings[$i] . "<br>";
                    }
                    
                    // shuffling the file arrays
                    shuffle($settings);
                    shuffle($objectives);
                    shuffle($antagonists);
                    shuffle($complications);
                    
                    //setting title
                    if($gender == "F") {
                        $title = "Lady";
                    } else {
                        $title = "Male";
                    }
                    
                    printf("This is a story about %s named %s<br> at only the age of %d is a %s<br>"
                            . "This is the start of the story....<br>", $title, $name, $age, $class);
                    
                    echo '<ul><li>' . $settings[0] . '</li><li> '
                    . $objectives[0] . '</li><li> '
                    . $antagonists[0] . '</li><li> '
                    . $complications[0] . "</li></ul><br>"
                    . "<input type='submit' value='Try Again' name='Create'><br>"
                    . "<input type='hidden' value='0' name='sneaky'>";
                }
                ?>
            </form>                          
        </div>
    </body>
</html>
