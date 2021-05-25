<?php
    
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
        <title>Recuperar</title>
    </head>
    <body>
        <?php
            include "funcions.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if(isset($_REQUEST["recuperar"]) && isset($_REQUEST["numero1"]) && isset($_REQUEST["numero2"]) && isset($_REQUEST["resultat"]) ){
               
                    if ($_REQUEST["numero1"] + $_REQUEST["numero2"] == $_REQUEST["resultat"]) {
                        if (comprovar_email_db($_REQUEST["mail"])) {
                            $pass = generar_string();
                            $username = $_REQUEST["mail"];
                            nova_contrasenya(md5($pass), $username);
                
                            $mail = new PHPMailer(true);
                
                            try {
                               
                                $mail->isSMTP();
                                $mail->Host       = 'smtp.googlemail.com';//'smtp.gmail.com';
                                $mail->SMTPAuth   = true;
                                $mail->Username   = 'aleixaleixaleixaleix@gmail.com';
                                $mail->Password   = 'agexlpegoweyhpgi';
                                $mail->SMTPSecure = 'tls';
                                $mail->Port       = 587;
                
                                //Recipients
                                $mail->setFrom('aleixaleixaleixaleix@gmail.com', 'Mailer');
                                $mail->addAddress($username, 'Usuario');
                
                                // Content
                                $mail->isHTML(true);
                                $mail->Subject = 'Recuperació de contrasenya';
                                $mail->Body    = 'nova contrasenya temporal: '.$pass.'<br>login: <a href="https://dawjavi.insjoaquimmir.cat/apuigpey/m7/recuperacio_uf1/Part_B/">Entrar</a>';
                                $mail->AltBody = 'Codig: ';
                
                                $mail->send();
                                echo "el correu s'ha enviat correctament";
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        } else {
                            echo "aquest correu no esta registrat";
                        }
                    } else {
                        echo "fes la suma be";
                    }
            
                    
                }
            }
        ?>
         <h1>recuperar contrasenya</h1>
        
        <form method="post">
            
            <label>Correu on es enviara la nova contrasenya: </label><input type="text" name="mail"><br>
                <?php
                    $numero1 = rand(1, 9);
                    $numero2 = rand(1, 9);
                    echo '<input type="hidden" name="numero1" value="'.$numero1.'">';
                    echo '<input type="hidden" name="numero2" value="'.$numero2.'">';
                    echo ''.$numero1." + ".$numero2." = ";
                ?>
            <input type="text" name="resultat"><br>
            <button type="submit" name="recuperar" value="recuperar">Regenerar</button><br>
        </form>
        <a href="index.php">inici</a>
    </body>
</html>