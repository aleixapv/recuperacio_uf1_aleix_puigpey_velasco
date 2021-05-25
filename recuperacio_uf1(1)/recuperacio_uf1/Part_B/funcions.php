<?php
function comprovar_camp($string) {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}
function comprovar_email($mail) {
    $mail = comprovar_camp($mail);
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $emailError = True;
    } else {
        $emailError = False;
    }
    return $emailError;
}
function comprovar_contra($password) {
    $password = comprovar_camp($password);
    if (!preg_match("/[^a-zA-Z\d]/",$password)) {
        $contraError = True;
    } else {
        $contraError = False;
    }
    return $contraError;
}
function iniciar_sessio($username, $password) {
    if (comprovar_email($username) && comprovar_contra($password)) {
        $password = md5($password);
        $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");
                
        $sql = "SELECT * FROM usuaris_examen WHERE username='$username' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuari = $result->fetch_assoc();
            $_SESSION["user"] = $usuari["username"];
            $_SESSION["password"] = $usuari["password"];
            
            $conn->close();
            header("Location: home.php");
        } else {
            echo "<p>sense resultats</p>";
        }
    } else {
        echo "<p>revisa el formulari</p>";
    }
}
function tencar_sessio() {
    session_unset();
    session_regenerate_id();
    session_destroy();
    header("Location: index.php");
}
function cambiar_password($password, $username) {
    $password = md5($password);
    $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");

    $sql = "UPDATE usuaris_examen SET password='$password' WHERE username LIKE '$username'";
    $result = $conn->query($sql);
    $sql = "UPDATE usuaris_examen SET regenerada=0 WHERE username LIKE '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Contrasenya cambiada</p>";
    } else {
        echo "Error: ".$sql."<br>".$conn->error;
    }

    $conn->close();
    $_SESSION["password"] = $password;
}
function comprovar_regenerada($username) {
    $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");
                
    $sql = "SELECT * FROM usuaris_examen WHERE username='$username'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
    $regenerada = $usuario["regenerada"];

    if ($regenerada == 1) {
        return true;
    } else {
        return false;
    }
}
function vuidar_contrasenya($username) {
    $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");

    $sql = "UPDATE usuaris_examen SET password='0' WHERE username LIKE '$username'";
    $result = $conn->query($sql);

    $conn->close();
}
function saludar($username) {
    $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");
                
    $sql = "SELECT * FROM usuaris_examen WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuari = $result->fetch_assoc();
        echo "<h1>Hola ".$usuari["nom"]."!</h1>";
    }
}
function nova_contrasenya($password, $username) {
    $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");

    $sql = "UPDATE usuaris_examen SET password='$password' WHERE username LIKE '$username'";
    $result = $conn->query($sql);
    $sql = "UPDATE usuaris_examen SET regenerada=1 WHERE username LIKE '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Contrasenya cambiada</p>";
    } else {
        echo "Error: ".$sql."<br>".$conn->error;
    }

    $conn->close();
}
function comprovar_email_db($username) {
    if (comprovar_email($username)) {
        $conn = new mysqli("localhost", "apuigpey", "apuigpey", "apuigpey_db_prova");

                
        $sql = "SELECT * FROM usuaris_examen WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function generar_string($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>