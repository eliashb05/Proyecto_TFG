<?php 
	// OJO: cuando hacemos logout() -> borra todos los archivos que este usuario hubiese subido
	
	session_start();
	
	$dir= "../".$_SESSION['lacarpeta']."/";	
	$handle=opendir($dir);
	
	// borro todos los ficheros
	while ($elemento = readdir($handle))
	{
		// borro los ficheros que hay en la carpeta
		// las carpetas las ignoro
		 if(is_file($dir.$elemento))
		{
				// borro fichero
				unlink($dir.$elemento);
		}
	}	
	
	// borramos "la sesión" y borramos todas las "variables de sesión"
	$_SESSION=null;
	session_destroy();
	
	header('location: ../index1.php');
	exit; 
?>