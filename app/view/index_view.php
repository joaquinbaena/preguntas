<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php 
    if (isset($_SESSION['perfil'])) {
        echo '<p>Bienvenido ' . $_SESSION['perfil'] . '</p>';
    }
    ?>
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="login" name="login">
    </form>
    <p>
        ¿No tienes cuenta? <a href=<?php echo "". DIRBASEURL."/registro"?>>Registrate</a>
    </p>
    <?php 
        $bandera = true;

        if (count($data) > 1) {
            $bandera = false;
            echo "<p>Usuario o contraseña incorrectos</p>";
        }

        if (isset($data['error_usuario']) && $bandera) {
            echo "<p>" . $data['error_usuario'] . "</p>";
        }

        if (isset($data['error_password'])  && $bandera) {
            echo "<p>" . $data['error_password'] . "</p>";
        }
    ?>
</body>
</html>