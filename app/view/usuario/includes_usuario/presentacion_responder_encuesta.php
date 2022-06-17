<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Responde la encuesta.</h1>
    <?php 
    // PRESENTACIÓN.
    echo "<h3> Bienvenido " . $data['presentacion']['nombre']  .  " te logueaste a las: ".  $data['presentacion']['hora'] . "</h3>";
    echo "<p> Ust. está cómo " . $data['presentacion']['perfil']  . ".</p>";
    ?>
</body>
</html>