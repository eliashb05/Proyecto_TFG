<?php
	header('Content-Type: text/html; charset=utf-8');
	/////////////////////////////////////////////////////////////////////////////////////
	///    Script Que copia los ficheros temporales subidos al servidor en una carpeta    
	///    OJO: posibilidad de subir varios ficheros
	///    Si los ficheros existen -> NO COPIO -> visualizo AVISO numérico
	///	 Si los ficheros NO existen -> COPIO -> NO devuelvo nombres (solamente "nº ficheros subidos")
	///	
	///	 NO realizo ningún tipo de validación
	/////////////////////////////////////////////////////////////////////////////////////
	
	session_start();
	$carpeta = "../".$_SESSION['lacarpeta']."/";	
	usleep(600000);
	
	//conexión con la base de datos
	require('conexion.php');	

	//****************************************************************************************
	function existefichero($nombrefichero)
	{		
		$dir = "../".$_SESSION['lacarpeta']."/";
		// comprobamos si el fichero existe en la carpeta
		if (file_exists($dir.$nombrefichero))
		{
				return true;
		}
		else
		{
				return false;
		}
	}	
	//****************************************************************************************

	$ncopiados=0;

	// calculamos el nº de ficheros subidos
	$nelementos=count($_FILES['los_ficheros']['name']);
	// OJO: ahora tenemos una 2ª dimensión en $_FILES
	// Ahora $_FILES -> es bidimensional
	// recorremos todo el array donde están los ficheros
	for ($i = 0; $i < $nelementos; $i++) 
	{	
			// consultamos si ya existe el fichero
			if (!existefichero($_FILES['los_ficheros']['name'][$i]))
			{	
				// si no existe el fichero
				// copiamos el archivo la carpeta donde copiamos los ficheros subidos.
				// si el fichero existe no hago nada
				copy($_FILES['los_ficheros']['tmp_name'][$i], $carpeta.$_FILES['los_ficheros']['name'][$i]);
				$ncopiados++;
				
				// ****************************************************************
				// ****************************************************************
				// FUNCIONALIDAD-2 
				// ****************************************************************
				// añado el fichero"  "SUBIDO y COPIADO" en $_SESSION 
				// copio en las variables $_SESSION que cree -> "nombre fichero" y "tipo de fichero" 
				// tienes que gestionar bien el como almacenar toda esta información en $_SESSION
				// ten en cuenta que el usuario puede estar subiendo ficheros varias veces y no solamente una vez
				// ****************************************************************
				// ****************************************************************
				if(isset($_SESSION['fichero'][0])){
				$posicion  = count($_SESSION['fichero']);
				$_SESSION['el_fichero'][$posicion] = $_FILES['los_ficheros']['name'][$i];
				$_SESSION['el_tipo'][$posicion] = $_FILES['los_ficheros']['type'][$i];
				}else{
					$_SESSION['el_fichero'][0] =  $_FILES['los_ficheros']['name'][$i];
					$_SESSION['el_tipo'][0] = $_FILES['los_ficheros']['type'][$i];
				}

				






				// ****************************************************************
				// ****************************************************************
				// ****************************************************************
			}   
	}

	// total de ficheros que subo
	echo "<b>Ficheros Subidos:</b>".
	"<font face='Calibri' color='red' size='4'>".$nelementos."</font><br>";
	// total de ficheros que copio del total de subidos	
	echo "<b>Ficheros Copiados:</b>".
	"<font face='Calibri' color='red' size='4'>".$ncopiados."</font>";	
?>