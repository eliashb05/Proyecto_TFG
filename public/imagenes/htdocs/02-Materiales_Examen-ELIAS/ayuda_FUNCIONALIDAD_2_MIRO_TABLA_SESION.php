<?php

	header('Content-Type: text/html; charset=UTF-8');
	
	// si no pusiera esto
	// no podría acceder en esta página a la información almacenada de la sesión
	session_start();
	
	echo ("<h2><font color='brown'>MIRO TABLA DE SESIÓN:"."</font></h2>") ;
	echo "Visualizo todos los ficheros:<br><br>";
	
	if (isset($_SESSION['el_fichero']))
	{
		// para contar el nº de registros con "count()" en una array bidimensional hay que poner el nombre de alguno de sus campos
		$nregistros=count($_SESSION['el_fichero']);
	
		// visualizamos el contenido de $_SESSION
		for ($i = 0; $i < $nregistros; $i++)
		  {
		   echo "<font face='Calibri' color='blue' size='5'>"." ".$_SESSION['el_fichero'][$i]."</font>";
		   echo "<font face='Calibri' color='red' size='5'>"." ".$_SESSION['el_tipo'][$i]."</font>";
		   echo "<br>";
		  }
		echo "<br>";
	}
	else
	{echo "No hay nada en el array $-SESSION !!";}	
?>




	

