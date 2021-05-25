<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
    </head>
    <body>
        <?php
            include "funcions.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_REQUEST["login"]) && isset($_REQUEST["user"]) && isset($_REQUEST["password"])) {
                    iniciar_sessio(comprovar_camp($_REQUEST["user"]), comprovar_camp($_REQUEST["password"]));
                }

            }
        ?>
        <h1>iniciar sessió</h1>
        <form method="post">
            
            <label>Correu: </label><input type="text" name="user"><br>
            <label>Contrasenya: </label><input type="password" name="password"><br>
            <button type="submit" name="login" value="login">Iniciar sessio</button><br>
        </form>
        
        <br>
        
       <a href="recuperar.php">recuperar contrasenya</a>
       
    </body>
</html>