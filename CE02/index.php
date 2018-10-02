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
        $d = date("D"); // create a date object by passing in String D to parameter
        echo "$d<br>";
        if ($d == "Fri" or $d == "Sat" || $d == "Sun") {
            $message = "Have a nice weekend!";
        } else if ($d == "Mon") {
            $message = "Oh no it is Monday";
        } else {
            $message = "Have a nice day!";
        }
        echo $message . "<br>"; // combine (concatenate) strings with a '.'
        
        switch ($d) {
            case "Mon":
                echo "Today is Monday";
                break;
            case "Tue":
                echo "Today is Tuesday";
                break;
            case "Wed":
                echo "Today is Wednesday";
                break;
            case "Thu":
                echo "Today is Thursday";
                break;
            case "Fri":
                echo "Today is Friday";
                break;
            case "Sat":
                echo "Today is Saturday";
                break;
            case "Sun":
                echo "Today is Sunday";
                break;
            
            default:
                echo "Wonder which day is this?";
        }
        
        $a = 0;
        $b = 0;
        
        print('<table width=\'50px\' class="table"><tr><th>$a</th><th>$b</th></tr>');
        for ($i=0; $i < 5; $i++) {
            $a += 10;
            $b += 5;
            print("<tr><td>$a</td><td>$b</td></tr>");
        }
        
        echo ("</table><br>At the end of the loop a=$a and b=$b and i = $i");
        
        $i = rand(0,50);
        $num = rand(51,100);
        
        do{
            $num--;
            $i++;
        }while ($i < $num);
        
        echo ("<br>Loop stopped at i = $i and num = $num");
        
        echo "<br>Year of Birth:<select><option>--</option>";
        $year1 = date("Y");
        for ($y = 0; $y < 100; $y++) {
            if($y > 10) {
                $yearval = $year1 - $y;
                echo "<option>$yearval</option>\n";
            }
        }
        echo "</select>"; // ends the select drop down 

        ?>
    </body>
</html>
