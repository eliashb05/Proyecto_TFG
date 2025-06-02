<?php
header('Content-Type: text/html; charset=UTF-8');

function sustituir($cadena, $busco, $sustituir)
{
    echo strlen($cadena)."<br>";
	$longitud_cadena=strlen($cadena);
	$cadena_nueva="";
	
    //str_ireplace no distingue entre mayuscuslas y minisculas sin embargo str_replace si
    return str_ireplace($busco, $sustituir, $cadena);
}

echo "xxPepexx"."---Pepe"."<br>";
echo sustituir("xxPepexx","Pepe","Juanito");
echo "<br><br>";

echo "xPepex"."---Pepe"."<br>";
echo sustituir("xPepex","Pepe","Juanito");
echo "<br><br>";

echo "HolaPepe"."---Pepe"."<br>";
echo sustituir("HolaPepe","Pepe","Juanito");
echo "<br><br>";

echo "PepeholaPepecomoestasPepe"."---Pepe"."<br>";
echo sustituir("PepeholaPepecomoestasPepe","Pepe","Juanito");
echo "<br><br>";

echo "PepholaPepecomoestasepep"."---Pepe"."<br>";
echo sustituir("PepholaPepecomoestasepep","Pepe","Juanito");
echo "<br><br>";

echo "PepeHolaPepe"."---pepe"."<br>";
echo sustituir("PepeHolaPepe","pepe","Juanito");
echo "<br><br>";

echo "PepeholaPepecomoestasPepe"."---Pea"."<br>";
echo sustituir("PepeholaPepecomoestasPepe","Pea","Juanito");
echo "<br><br>";

?>


