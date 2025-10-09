<?php
/* Zona de declaración de funciones */
//*******Funciones de debugueo****
function dump($var){
    global $miVariable;
    echo $miVariable;
    echo '<pre>'.print_r($var,1).'</pre>';
}

//*******Función lógica presentación**********+
function getTableroMarkup ($tablero, $posPersonaje){
    $output = '';
    foreach ($tablero as $filaIndex => $datosFila) {
        foreach ($datosFila as $columnaIndex => $tileType) {
            if(isset($posPersonaje)&&($filaIndex == $posPersonaje['row'])&&($columnaIndex == $posPersonaje['col'])){
                $output .= '<div class = "tile ' . $tileType . '"><img src="./src/super_musculitos.png"></div>';    
            }else{
                $output .= '<div class = "tile ' . $tileType . '"></div>';
            }
        }
    }
    return $output;
}
function getMensajesMarkup($arrayMensajes){
    $output = '';
    foreach ($arrayMensajes as $mensaje){
        $output .= '<p>'.$mensaje.'</p>';
    }
    return $output;
    
}
function getArrowsMarkup($arrows,$posPersonaje){
    
    $output = '';
    if(isset($arrows)){
        foreach($arrows as $nombreBoton => $arrayPos){
            if($nombreBoton == "." || $nombreBoton == ",") {
                $output.='<form  action="<?php echo $_SERVER['."'PHP_SELF'".']; ?>" method="post">';
                $output.='<div></div>';
                $output.='</form>';
            }
            if($nombreBoton == "arriba") {
                $output.='<form  action="<?php echo $_SERVER['."'PHP_SELF'".']; ?>" method="post">';
                $output.='<input type="submit" value="Arriba" name="flecha">';
                $output.='</form>';
            }
            if($nombreBoton == "izquierda") {
                $output.='<form  action="<?php echo $_SERVER['."'PHP_SELF'".']; ?>" method="post">';
                $output.='<input type="submit" value="Izquierda" name="flecha">';
                $output.='</form>';
            }
            if($nombreBoton == "abajo") {
                $output.='<form  action="<?php echo $_SERVER['."'PHP_SELF'".']; ?>" method="post">';
                $output.='<input type="submit" value="Abajo" name="flecha">';
                $output.='</form>';
            }
            if($nombreBoton == "derecha") {
                $output.='<form  action="<?php echo $_SERVER['."'PHP_SELF'".']; ?>" method="post">';
                $output.='<input type="submit" value="Derecha" name="flecha">';
                $output.='<input type="hidden" name="col" value="'.$posPersonaje['col'].'">
                        <input type="hidden" name="row" value="'.$posPersonaje['row'].'">';
                $output.='</form>';
            }
        }
    }
    
    return $output;
    
}


//******+Función Lógica de negocio************
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos valores pueden ser:
// agua
//fuego
//tierra
// hierba
function leerArchivoCSV($rutaArchivoCSV) {
    $tablero = [];

    if (($puntero = fopen($rutaArchivoCSV, "r")) !== FALSE) {
        while (($datosFila = fgetcsv($puntero)) !== FALSE) {
            $tablero[] = $datosFila;
        }
        fclose($puntero);
    }

    return $tablero;
}
function leerInput(){
    
        $row = filter_input(INPUT_POST, 'row', FILTER_DEFAULT);
        $col = filter_input(INPUT_POST, 'col', FILTER_DEFAULT);
        

    return (isset($_POST['flecha']))? array(
            'row' => 0,
            'col' => 0
        ) : array (
            'row' => 5,
            'col' => 5,
        );
}

// function transformPos($posPersonaje,$arrows) {
//     if(isset($_POST['flecha'])) {
//         $posPersonaje = $arrows[$_POST];
//     }
//     else{
//         return $posPersonaje;
//     }
// }

function getMensajes(&$posPersonaje){
    if(!isset($posPersonaje)){
        return array('La posición del personaje no está bien definida');
    }
    return array('');
}

function getArrows($posPersonaje){
    if(isset($posPersonaje)){

        $arrows = array(
            '.' => null,
            
            'arriba' => array(
                'row' => $posPersonaje['row'] -1,
                'col' => $posPersonaje['col'] ,
            ),
            ',' => null,
            'izquierda' => array(
                'row' => $posPersonaje['row'],
                'col' => $posPersonaje['col'] -1,
            ),
            'abajo' => array(
                'row' => $posPersonaje['row'] +1,
                'col' => $posPersonaje['col'],
            ),
            'derecha' => array(
                'row' => $posPersonaje['row'],
                'col' => $posPersonaje['col'] +1,
            ),
        );
        return $arrows;
    }
    return null;

}

