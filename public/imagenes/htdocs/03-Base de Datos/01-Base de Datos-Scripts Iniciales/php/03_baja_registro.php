<?php

// aquí almacenaremos el nº de registros que se borran
$nborrados=0;

// conexión con la Base de Datos
require('conexion.php');

// configuramos la librería para que se puedan tratar errores
// si no configuramos esto -> no podremos tratar errores
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_OFF);

// OJO-> DELETE -> si no borra nada -> no da error
// es necesario saber si al final se ha borrado algo o no
// pensad que esta tabla la pueden estar utilizando cientos de personas al mismo tiempo

//****************************************************************
// OJO: cuando hagamos una página web, la variable "$codigo" cogerá el valor que le envíe el formulario
// el registro o registros que queremos borrar
$codigo="2222";
//****************************************************************

// diseñamos la consulta SQL -> aquí como máximo se borra 1 registro si existe
$consulta1="DELETE FROM tabla1 WHERE CODC=".$codigo;

// otro ejemplo -> aquí se borran varios registros
$consulta2="DELETE FROM tabla1 WHERE EDAD>35";

// la "@" se pone para que no aparezca un "warning" -> no hace falta "warning" -> ya tratamos error
// ejecutamos la consulta SQL que hemos diseñado
@mysqli_query($conexion,$consulta1); 

//****************************************************************
//                                                  Comprobación de errores
//****************************************************************
// comprobamos el resultado de la "consulta" con "mysqli_errno()"
// hay que comprbar si se ha producido algún error
// el error CERO significa NO ERROR 
// el error 1064 significa Error de sintaxis 

if (mysqli_errno($conexion)==0)
{
	// esta instrucción "mysqli_affected_rows" nos devuelve el nº de registros afectados por la consulta SQL
	// los registros borrados pueden ser 0 -> y eso no es un "error"
	$nborrados=mysqli_affected_rows($conexion);
	echo "<font color='green' size='3'>ÉXITO:<br></font>";
	echo "No se ha producido ningún error<br><br>";
	echo "Registros borrados: ".$nborrados;
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

//MUY IMPORTANTE
//siempre hay que hacer esto
//cerramos la conexion  con la base de datos
 mysqli_close($conexion); 
?>
