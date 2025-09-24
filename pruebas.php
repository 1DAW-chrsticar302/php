<?php
//Template
//Inicialización del entorno


//Zona de declaración de funciones
//Funciones de debugueo
function dump($var) {
    echo '<pre>'. print_r($var, 1) . '</pre>';
}


//Función lógica de presentación
function getTableroMarkup($tableroData) {
    return '';//todos los divs
}


//Lógica de negocio
$tablero = [

];

$tableroMarkup = getTableroMarkup($tablero);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>
<body style="place-content: center;">
    <center>
        <h1>Pruebas</h1>
    </center>
</body>
</html>