<?php
//*****************************************
// En este caso el ERROR producido se le informa al usuario
// No nos estamos referiendo a un error de tipo SINTAXIS
// Por ejemplo: dar de alta un registro con un CODC que ya existe
// El ERROR es visible al usuario
// Podríamos hacer que el ERROR no fuese visible
//*****************************************

// conexión con la Base de Datos
require('conexion.php');

// configuramos la librería para que se puedan tratar errores
// si no configuramos esto -> no podremos tratar errores
mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_OFF);

//****************************************************************
// OJO: cuando hagamos una página web, la variables "$codigo","$fecha", "$nombre" y "$edad" 
// cogerán el valor que les envíe el formulario
// el registro que queremos dar de alta
$codigo="4567";
$nombre="LUIS";
$fecha="2024-08-24";
$edad=23;

// diseñamos la consulta SQL
// OJO -> los campos numéricos no llevan comillas
$consulta="INSERT INTO tabla1 VALUES ($codigo,'$nombre','$fecha',$edad)";

// también sería válido esto:
//$consulta="INSERT INTO tabla1 (CODC,NOMBRE,FECHA,EDAD) VALUES (4568,'MARIPEPI','2024-08-24',67)";

// la "@" se pone para que no aparezca un "warning"-> no hace falta "warning" -> ya tratamos error
@mysqli_query($conexion,$consulta); 

//****************************************************************
//                                                  Comprobación de errores
//****************************************************************
// comprobamos el resultado de la "consulta" con "mysqli_errno()"
// hay que comprbar si se ha producido algún error
// el error CERO significa NO ERROR 
// el error 1062 significa Clave duplicada 
// el error 1064 significa Error de sintaxis 

if (mysqli_errno($conexion)==0)
{
	echo "<font color='green' size='3'>ÉXITO:<br></font>";
	echo "El registro se ha dado de alta en la tabla";
}
else 
{
	// aquí tratamos el error que se supone que será la clave duplicada	
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
