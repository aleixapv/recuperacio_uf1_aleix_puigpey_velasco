<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Part A</title>
    </head>
    <body>
        <p style="font-size: 15px;">
            <?php
                $hora = date("G");
                for ($h=0; $h < 24; $h++) { 
                    if ($hora == $h) {
                        echo "<strong>$h</strong> ";
                    } else if ($hora > $h) {
                        echo "<i>$h</i> ";
                    } else {
                        echo "$h ";
                    }    
                }
            ?>
        </p>
        <p style="font-size: 15px;">
            <?php
                $minut = date("i");
                for ($m=0; $m < 60; $m++) { 
                    if ($minut == $m) {
                        echo "<strong>$m</strong> ";
                    } else if ($minut > $m) {
                        echo "<i>$m</i> ";
                    } else {
                        echo "$m ";
                    }        
                }
            ?>
        </p>
        <p style="font-size: 15px;">
            <?php
                $segon = date("s");
                for ($s=0; $s < 60; $s++) { 
                    if ($segon == $s) {
                        echo "<strong>$s</strong> ";
                    } else if ($segon > $s) {
                        echo "<i>$s</i> ";
                    } else {
                        echo "$s ";
                    }        
                }
            ?>
        </p>
    </body>
</html>