<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        print_r($_POST);
        
        $name = htmlentities($_POST['HeroName']);
        $name = strtolower($name);
        $name = ucwords($name);
        $race = $_POST['Race'];
        $class = $_POST['Class'];
        $age = $_POST['Age'];
        $gender = $_POST['gender'];
        $kingdom = $_POST['KingdomName'];
        
        require "CharacterArrays.php"; // similar to pythons import, connects the files.
        //require "AdventureCharacter.php";
        
        
        $characterport = "<img src ='images/"; // build an image tag. String builder for image path.
        $charactersheet = "<header><h4>$name from $kingdom</h4><br>"
            . "<b>$race $class</b?<br>At the age of $age</header>";
        
        
                
        switch($race){
            case "Human":
                $characterport .= "Hu"; // concatinating strings
                $charactersheet = $charactersheet . $charDesc[0];
                break;
            
            case "Elf":
                $characterport .= "El";
                $charactersheet = $charactersheet . $charDesc[1];
                break;
            
            case "Halfling":
                $characterport .= "Ha";
                $charactersheet = $charactersheet . $charDesc[2];
                break;
            
            case "Dwarf":
                $characterport .= "Dw";
                $charactersheet = $charactersheet . $charDesc[3];
                break;
            
            default:
                echo "blah";
        }
        
        switch($class){
            case "Cleric":
                $characterport .= "Cl";
                $charactersheet = $charactersheet . $charClass[1];
                break;
            
            case "Fighter":
                $characterport .= "Fi";
                $charactersheet = $charactersheet . $charClass[0];
                break;
            
            case "Magic-User":
                $characterport .= "Ma";
                $charactersheet = $charactersheet . $charClass[2];
                break;
            
            case "Thief":
                $characterport .= "Th";
                $charactersheet = $charactersheet . $charClass[3];
                break;
            
            default:
                echo "blah";
        }
        
        if ($gender == "Male") {
            $characterport .= "Ma.jpg'>";
        }
        else {
            $characterport .= "Fe.jpg'>";
        }
    ?>
    <head>
        <meta charset="utf-8">
        <link href=$characterport/>
        <title> A made Adventurer</title>
        <link href="characterCSS.css" rel="stylesheet" type="text/css"/>
        <style>
            img {
                height: 250px;
                padding: 3pt;
                float: right;
            }
        </style>
    </head>
    
    
    <body>
        <div id="form_container">
            
            <h3 class="Content">The Brave Adventurer</h3>
            <div class="charactersheet">
                <?php
                print($characterport);
                print($charactersheet);
                ?>
            </div>
        </dev>
    </body>  
</html>
