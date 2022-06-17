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
        include('includes_admin/presentacion_add_view.php');
        include('includes_admin/nav.php');
    ?>
    <br>

    <form action="" method="post">
        Introduce el nombre de la Encuesta: 
        <input type="text" name="encuesta" size="30"> <br>
        <?php 
            echo "<br>";
            echo '<table>';
            foreach ($data['allPreguntas'] as $pregunta) {
                echo '<tr>';
                echo '<td>' . $pregunta["descripcion_pregunta"] . '<input type="checkbox" name="preguntas[]" value="' . $pregunta['id_pregunta'] . '"></td>';
                echo '</tr>';
            }
            echo '</table><br>';
        ?>
        <input type="submit" name="guardar" value="guardar">
    </form>

    <?php

        if (isset($data['error_pregunta'])) {
            echo "<p>" . $data['error_pregunta'] . "</p>";
        }
    
    ?>

</body>
</html>