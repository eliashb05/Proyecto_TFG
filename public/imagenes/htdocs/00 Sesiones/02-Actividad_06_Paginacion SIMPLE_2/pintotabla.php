<?php
	//sleep(1);
	usleep(100000);
	// conexión con la base de datos
	require('conexion.php');
	
	// en este array almacenaremos los datos de todos los registros
	$jsondataLista = array();
	
	// este será el array que devolvemos
	$jsondatos= array();

	$apartirde=$_POST["inicio"];
	$cantidad=$_POST["fin"];
	
	$query = "SELECT * FROM tabla1 ORDER BY DNI ASC LIMIT $apartirde,$cantidad";
	$resultado = mysqli_query($conexion, $query);
	
	while($fila = $resultado ->fetch_assoc())
	{
		// en este array iremos almacenando los datos de los registros 1 por 1
		$json_data_cliente = array();
		
		$json_data_cliente["dni"] = $fila["DNI"];
		$json_data_cliente["nombre"] = $fila["NOMBRE"];
		$json_data_cliente["edad"] = $fila["EDAD"];
		$json_data_cliente["precio"] = $fila["PRECIO"];
		$json_data_cliente["fecha"] = $fila["FECHA"];
		$json_data_cliente["imagen"] = base64_encode($fila["IMAGEN"]);

		$jsondataLista[]=$json_data_cliente;
	}
	$jsondatos["lista"] = array_values($jsondataLista);
	
header("Content-type:application/json; charset = utf-8"); 
echo json_encode($jsondatos);

//cerramos la conexión  con la base de datos
mysqli_close($conexion); 
exit();
 ?>