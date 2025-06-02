<?php

// conexión con la Base de Datos
require('conexion.php');

// configuramos la librería para que se puedan tratar errores
// si no configuramos esto -> no podremos tratar errores
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_OFF);

// diseñamos la consulta SQL
$consulta="SELECT * FROM tabla1 ORDER BY CODC";

// la "@" se pone para que no aparezca un "warning" -> no hace falta "warning" -> ya tratamos error
// ejecutamos la consulta

// en $resultado tengo los datos del empleado pero esa información es inaccesible
// ver documento pdf -> "Recuperar Datos PHP-SQL.pdf"
$resultado=@mysqli_query($conexion,$consulta); 

//****************************************************************
//                                                  Comprobación de errores
//****************************************************************
// comprobamos el resultado de la "consulta" con "mysqli_errno()"
// hay que comprbar si se ha producido algún error
// el error CERO significa NO ERROR 
// el error 1064 significa Error de sintaxis 

if (mysqli_errno($conexion)==0)
{
	echo "<font color='green' size='3'>ÉXITO:<br></font>";
	echo "No se ha producido ningún error<br><br>";
}
else 
{
	// aquí tratamos el posible error y lo visualizamos	
	$numerror=mysqli_errno($conexion); 
	$descrerror=mysqli_error($conexion); 
	
	// aquí devolvemos el nº de error y la descripción del error
	echo "<font color='red' size='3'> ERROR Nº: ".$numerror."<br></font>";
	echo "DESCRIPCIÓN ERROR: ".$descrerror."<br>";
}	
//****************************************************************
//****************************************************************


// calculo los registros que me ha devuelto la consulta SQL y lo visualizo
$nregistros=mysqli_num_rows($resultado);
echo "La consulta me ha devuelto: ".$nregistros." registros<br><br>";

if ($nregistros>0)
{
	
	// forma-1
	
	while($registro = mysqli_fetch_array($resultado))
	{
		echo $registro["CODC"]."<br>";
		echo $registro["NOMBRE"]."<br>";
		echo $registro["FECHA"]."<br>";
		echo $registro["EDAD"]."<br><br><br>";
	}
	
	/*
	// forma-2
	$registro = mysqli_fetch_array($resultado);
	while($registro)
	{
		echo $registro["CODC"]."<br>";
		echo $registro["NOMBRE"]."<br>";
		echo $registro["FECHA"]."<br>";
		echo $registro["EDAD"]."<br><br><br>";
		$registro = mysqli_fetch_array($resultado);
	}*/
}
else
{
	echo "No hay registros en la tabla";
}	

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
 mysqli_close($conexion); 
?>
