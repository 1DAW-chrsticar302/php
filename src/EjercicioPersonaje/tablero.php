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
function getArrowsMarkup ($arrowsData,$personaje) {
    $output='';
    if(isset($personaje)) {
        $fila = $personaje[0];
        $col = $personaje[1];

        $nextF = $fila + 1;
    $nextC = $col + 1;
    $prevF = $fila-1;
    $prevC = $col-1;
    if ($prevF==-1) {
        $prevF=11;
    }
    if ($prevC==-1) {
        $prevC=11;
    }
    if ($nextF==12) {
        $nextF=0;
    }
    if ($nextC==12) {
        $nextC=0;
    }
    foreach($arrowsData as $array => $datosArray) {
        foreach($datosArray as $tecla => $datosTecla) {
            if($datosTecla == "n") {
                $output.=".";
            }
            if($datosTecla == "izquierda" && $col != 0) {
                $output.='<a href="http://localhost/src/EjercicioPersonaje/tablero.php?fila='.$personaje[0].'&columna='.$prevC.'"><button>'.$datosTecla.'</button></a>';
            }

            if($datosTecla == "arriba" && $fila != 0) {
                $output.='<a href="http://localhost/src/EjercicioPersonaje/tablero.php?fila='.$prevF.'&columna='.$personaje[1].'"><button>'.$datosTecla.'</button></a>';
            }
            if($datosTecla == "abajo" && $fila != 11) {
                $output.='<a href="http://localhost/src/EjercicioPersonaje/tablero.php?fila='.$nextF.'&columna='.$personaje[1].'"><button>'.$datosTecla.'</button></a>';
            }

            if($datosTecla == "derecha" && $col != 11) {
                $output.='<a href="http://localhost/src/EjercicioPersonaje/tablero.php?fila='.$personaje[0].'&columna='.$nextC.'"><button>'.$datosTecla.'</button></a>';
            }
            
        }
    }
    }else {
        $fila = 0;
        $col = 0;
    }
    
    return $output;
}


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

function getMensajesMarkup($arrayMensajes) {
    $output='';

    if(isset($arrayMensajes)){
        foreach($arrayMensajes as $mensajes) {
            $output.='<p>'. $mensajes . '</p>';
        }
    }
    else {
        $output.="Ningún error";
    }
    return $output;
}


//Lógica de negocio

function getPersonaje() {
    $col = filter_input(INPUT_GET, 'columna', FILTER_VALIDATE_INT);
    $row = filter_input(INPUT_GET, 'fila', FILTER_VALIDATE_INT);

    return (isset($col) && isset($row))? array(
            $row,$col,"personaje/sonic.png"
        ) : null;   
}

function procesaredirect() {
    if(!isset($_GET['fila']) && !isset($_GET['columna']) ) {
        header('HTTP/1.1 308 Permanent Redirect');
    }
}

procesaredirect();
$personaje=getPersonaje();
$tablero = cargarCSV("../../data/tabla.csv");
$arrowsData=cargarCSV("../../data/arrows.csv");
$mensajes=getMensaje($personaje);
$arrowsMarkup = getArrowsMarkup($arrowsData,$personaje);


function cargarCSV($archivo) {
    $archivoCSV=fopen($archivo,"r");

    while(($linea = fgetcsv($archivoCSV)) !== false) {
        $tablero[] = $linea;
    }

    fclose($archivoCSV);


return $tablero;
}

function getMensaje($posPersonaje) {

    if(!isset($posPersonaje)) {
        return array('La posición del parsonaje no está bien definida');
    }
    return null;
}




//Lógica de presentación
$tableroMarkup = getTableroMArkup($tablero,$personaje);
$mensajesMarkup = getMensajesMarkup($mensajes);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="tablero.css">
</head>
<body>
    <h1>Tablero juego super rol DWES</h1>
    <?php echo $mensajesMarkup ?>
    <div class="contenedorTablero">
        <?php 
        echo $tableroMarkup; 
        ?>
    </div>
     <div class="arrows">
        <?php echo $arrowsMarkup ?>
     </div>
</body>
</html>