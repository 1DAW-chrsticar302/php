<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Indice</title>
</head>
<body>

    <h1>Ejemplo formulario</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="text" name="mensaje">
        <input type="submit" value="Enviar">
    </form>
    
</body>
</html>