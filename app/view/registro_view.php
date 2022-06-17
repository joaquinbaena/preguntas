<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registro:</h1>
    <form method="post">
        <label for="usuario">Usuario: </label><input type="text" name="usuario" id="usuario">
        <br><br>
        <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre">
        <br><br>
        <label for="password">Password: </label><input type="password" name="password" id="password">
        <br><br>
        <label for="perfil">Rol: </label><select name="perfil" id="perfil">
            <option value="admin">admin</option>
            <option value="usuario">usuario</option>
        </select>
        <br><br>
        <input type="submit" name="registrar" value="Registrar">
    </form>
    <p>
        Volver a <a href=".">Inicio</a>
    </p>
</body>
</html>