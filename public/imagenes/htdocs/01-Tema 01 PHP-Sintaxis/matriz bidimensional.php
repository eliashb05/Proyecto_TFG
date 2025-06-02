<?php
header('Content-Type: text/html; charset=UTF-8');
// *****************************************************************************************

$original[0][0]= "H"; $original[0][1]= "S"; $original[0][2]= "E"; $original[0][3]= "A";
$original[0][4]= "F";$original[0][5]= "P";

$original[1][0]= "O"; $original[1][1]= "U"; $original[1][2]= "S"; $original[1][3]= "Q";
$original[1][4]= "E";$original[1][5]= "E";

$original[2][0]= "L"; $original[2][2]= "T"; $original[2][3]= "U"; $original[2][4]= "L";
$original[2][5]= "N";

$original[3][0]= "A"; $original[3][2]= "O"; $original[3][3]= "I"; $original[3][4]= "I";
$original[3][5]= "S";

$original[4][2]= "Y"; $original[4][4]= "Z"; $original[4][5]= "A";

$original[5][5]= "N";
$original[6][5]= "D";
$original[7][5]= "O";


for ($i = 0; $i < 8; $i++) { // Filas
    for ($j = 0; $j < 6; $j++) { // Columnas
        echo isset($original[$i][$j]) ? $original[$i][$j] . " " : "- "; // Muestra "-" si el valor no está definido
    }
    echo "<br>";
}

?>

