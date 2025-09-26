<?php

/* Inicialización del entorno */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Zona de declaración de funciones */
//Funciones de debugueo
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica presentación
function getTableroMarkup($tableroData,$personaje){
    $output='';
    $x = 0;
    $y = 0;

    foreach($tableroData as $fila => $datosFila) {
        foreach($datosFila as $celda => $datosCelda) {
            if($personaje[0] == $y && $personaje[1] == $x) {
                $output .= '<img src="' . $personaje[2] . '">';
            }else{
                $output.='<div class="tile '. $datosCelda .'"></div>';
            }
            $x++;
        }
        $x=0;
        $y++;
    }

    return $output;
}


//Lógica de negocio

function getPersonaje() {
    $fila=$_GET['fila'];
    $columna=$_GET['columna'];
    $personaje="personaje/sonic.png";


    return array($fila,$columna,$personaje);
}



$personaje=getPersonaje();
$tablero = cargarCSV("tabla.csv");

function cargarCSV($archivo) {
    $archivoCSV=fopen($archivo,"r");

    while(($linea = fgetcsv($archivoCSV)) !== false) {
        $tablero[] = $linea;
    }

    fclose($archivoCSV);


return $tablero;
}

//Lógica de presentación
$tableroMarkup = getTableroMArkup($tablero,$personaje);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .contenedorTablero{
            width:604px;
            height: 604px;
            border-radius: 5px;
            border: solid 2px grey;
            box-shadow: grey;
            display:grid;
            grid-template-columns: repeat(12,1fr);
            grid-template-rows: repeat(12,1fr);
        }
        .tile{
            width: 50px;
            height: 50px;
            float:left;
            margin:0;
            padding:0;
            border-width:0;
            background-size: 209px;
            background-image: url("../imgTabla/464.jpg")
        }
        .fuego{
            background-color: red;
            background-position: 103px -52px;

        }
        .tierra{
            background-color:brown;
            background-position: 50px 0px;
        }
        .agua{
            background-color:blue;
            background-position: 155px 0px;
        }
        .hierba{
            background-color:green;
            background-position: -2px 0px;
        }
        .personaje{
            background-image: url("../imgTabla/sonic.png");

        }
    </style>
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <div class="contenedorTablero">
        <?php echo $tableroMarkup; ?>
    </div>
</body>
</html>