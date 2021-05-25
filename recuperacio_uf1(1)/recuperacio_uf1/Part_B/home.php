<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <?php
            include "funcions.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_REQUEST["logout"])) {
                    tencar_sessio();
                }

                if (isset($_REQUEST["cambiar"])) {
                    cambiar_password(comprovar_camp($_REQUEST["password"]), $_SESSION["user"]);
                }
            }

            if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
                saludar($_SESSION["user"]);
            
                if (comprovar_regenerada($_SESSION["user"])) {
                    vuidar_contrasenya($_SESSION["user"]);
                
        ?>
       
            <h1>cambia la contrasenya</h1>
            <form method="post">
                <label>Contrasenya: </label><input type="password" name="password"><button type="submit" name="cambiar" >Cambiar</button>
            </form>
            en cas de no cambiar la tindras que recuperar una latra vgada
        <br>
        <?php
                }
        ?>
        <form method="post">
            <label>tencar sessio:</label><button type="submit" name="logout" value="si">Log out</button>
        </form>
        <?php
            } else {
                header("Location: index.php");
            }
        ?>
    </body>
</html>