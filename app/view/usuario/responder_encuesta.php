<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include('includes_usuario/presentacion_responder_encuesta.php');
        include('includes_usuario/nav.php');

        // imprimir $data['allEncuestas'] dentro de un select
        echo '<form action="" method="post">';
        echo '<select name="encuesta">';
        foreach ($data['allEncuestas'] as $encuesta) {
            echo '<option value="' . $encuesta['id_encuesta'] . '">' . $encuesta['nombre_encuesta'] . '</option>';
        }
        echo '</select>';
        echo '              <input type="submit" name="actualizar" value="actualizar">';
        
        echo '</form>';        
    ?>
</body>
</html>