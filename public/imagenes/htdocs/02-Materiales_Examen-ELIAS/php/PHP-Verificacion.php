<?php    
	
	usleep(400000);
	require('../php/conexion.php');
	session_start();
	
	$user=$_POST['el_user'];
	$password=$_POST['la_password'];
	
	// hago la consulta para saber si los datos del usuario son correctos
	$sql = "SELECT * FROM clientes WHERE CLIENTE = '$user' and CONTRASENIA = '$password'";
        
	//echo $sql;
		
	$resultado = mysqli_query($conexion,$sql);
        
	// calculo el nº de registros devueltos
	$nregistros=0;
	$nregistros=mysqli_num_rows($resultado);

	// registro encontrado
	if($nregistros==1)
	{
		$registro = mysqli_fetch_array($resultado);
		//**********************
		// USUARIO EXISTE
		//**********************
		// AQUÍ ES CUANDO SE CREAN LAS VARIABLES DE SESIÓN (las que queramos)
		$_SESSION['userid'] = $registro['ID'];
		$_SESSION['cliente'] = $registro['CLIENTE'];		
		$_SESSION['lacarpeta'] = $registro['LACARPETA'];
		$carpeta = $_SESSION['lacarpeta'];
		echo $carpeta;
	}
	else
	{
		//**********************			
		// USUARIO NO EXISTE
		//**********************		
		return 0;	
}

// cerramos la conexión 
mysqli_close($conexion); 

?>