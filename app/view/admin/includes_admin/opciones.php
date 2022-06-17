<!DOCTYPE html>
<html lang="en">
<body>
    <?php 
        // IMPRIMIR DOS BOTONES CON LAS OPCIONES DEL USUARIO: CREAR ENCUESTA Y CREAR PREGUNTAS.
        echo "<h3>Opciones del admin</h3>";
        // imprimir un enlace
        echo "<a href='" . DIRBASEURL . "/admin/crear_encuesta'>";
        echo "<button>Crear encuesta</button>";
        echo "</a>                                  ";
        echo "<a href='" . DIRBASEURL . "/admin/crear_pregunta'>";
        echo "<button>Crear pregunta</button>";
        echo "</a>              ";
    ?>
</body>
</html>