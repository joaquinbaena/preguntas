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
        <label for="pregunta">Introduce la pregunta:</label>
        <br>
        <br>
        <input type="text" name="pregunta" size="45" 
        <?php
            if (isset($data['numOpciones']['pregunta'])) {
                echo 'value="' . $data['numOpciones']['pregunta'] . '"';
            }
        ?> >   
        <br>
        <br>
        <label for="opciones">Selecciona el número de opciones: </label>
        <select name="varios">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <input type="submit" name="actualizar" value="actualizar">
        <br>
        <br>
        <?php 
            if (isset($data['numOpciones'])) {
                // imprimir tantos input como opciones seleccionadas
                for ($i=1; $i <= $data['numOpciones']['varios']; $i++) {
                    echo '<label for="opcion' . $i . '">Opción ' . $i . ':</label>              ';
                    echo '<input type="text" name="opcion' . $i . '"  ';
                    echo "<br><br><br>";
                }
                echo '<input type="submit" name="guardar" value="guardar">';
            }
        ?>
    </form>

    <?php

        if (isset($data['error_pregunta'])) {
            echo "<p>" . $data['error_pregunta'] . "</p>";
        }
    
    ?>

</body>
</html>