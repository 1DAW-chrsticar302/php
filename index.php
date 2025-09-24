<?php

function dump($var) {
    echo '<pre>'. print_r($var, 1) . '</pre>';
}

function generarTabla($tablaData, $resources) {
    $contador = 0;
    $output = "";

    if(isset($tablaData) && !empty($tablaData)){
        $output = "<table border='0' cellspacing='0' cellpadding='0' style='border-collapse: collapse;'>";

        foreach ($tablaData as $fila => $valoresFila) {
			$output .= "<tr>";

			foreach ($valoresFila as $columna => $valorCelda) {
				$contador++;
				$output .= "<td>";
				$output .= "<img src='";
				foreach($resources as $claveRecurso => $valorRecurso) {
					if($claveRecurso == $valorCelda) {
						$output .= $valorRecurso;
						break;
					}
				}
				$output.="' height='100%' width='90%'/>";
				$output .= "</td>";
			}

			$output .= "</tr>";
		}
        $output .= "</table>";
        return $output;
    }
    else{
        return "No se ha encontrado datos de la tabla";
    }
}

$resources = array(
	"D" => "imgTabla/darkBrick.png",
	"H" => "imgTabla/hielo.png",
	"L" => "imgTabla/ladrillo.png",
	"R" => "imgTabla/roca.png",
	"T" => "imgTabla/tierra.png",
	""  => "imgTabla/vacio.png"
);

$tablaMakeup = array(
	//Tablero 12x12 bloques editables
	
	0 => array("D","H","L","R","T","D","H","L","R","T","D","H"),
	1 => array("L","R","T","D","H","L","R","T","D","H","L","R"),
	2 => array("T","D","H","L","R","T","D","H","L","R","T","D"),
	3 => array("H","L","R","T","D","H","L","R","T","D","H","L"),
	4 => array("R","T","D","H","L","R","T","D","H","L","R","T"),
	5 => array("D","H","L","R","T","D","H","L","R","T","D","H"),
	6 => array("L","R","T","D","H","L","R","T","D","H","L","R"),
	7 => array("T","D","H","L","R","T","D","H","L","R","T","D"),
	8 => array("H","L","R","T","D","H","L","R","T","D","H","L"),
	9 => array("R","T","D","H","L","R","T","D","H","L","R","T"),
	10 => array("D","H","L","R","T","D","H","L","R","T","D","H"),
	11 => array("L","R","T","D","H","L","R","T","D","H","L","R")
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prueba Tabla</title>
</head>
<body>

<div style="margin: 30%; margin-top:0">
	<?php
	// Mostrar la tabla generada con imágenes
	// dump($tablaMakeup);
	echo generarTabla($tablaMakeup,$resources);
?>
</div>

</body>
</html>
