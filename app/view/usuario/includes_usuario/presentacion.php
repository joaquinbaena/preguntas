<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Responde a las encuestas.</h1>
    <?php 
    // PRESENTACIÓN.
    echo "<h3> Bienvenido " . $data['nombre']  .  " te logueaste a las: ".  $data['hora'] . "</h3>";
    echo "<p> Ust. está cómo " . $data['perfil']  . ".</p>";
    ?>
</body>
</html>