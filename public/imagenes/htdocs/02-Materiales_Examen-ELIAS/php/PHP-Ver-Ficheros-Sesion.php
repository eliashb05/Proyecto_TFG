<?php

	session_start();
	usleep(200000);

	// esta carpeta es donde se copian los ficheros subidos al servidor
	$carpeta = "../".$_SESSION['lacarpeta']."/";	
	
	// calculo nº de ficheros en carpeta
	$total_ficheros = count(glob($carpeta.'/{*.*}',GLOB_BRACE));

	// recogemos el USUARIO activo de $_SESSION
	$usuario=$_SESSION['cliente'];

		// informo de cosas
		echo "<div style='text-align:center'>";
		echo "<font face='Calibri' color='black' size='4'>Método: </font>";
		echo "<font face='Calibri' color='brown' size='3'><b>CARPETA</b></font><br>";	
		echo "<font face='Calibri' color='black' size='4'>Nº Ficheros: </font>";
		echo "<font face='Calibri' color='green' size='4'>".$total_ficheros."</font>";	
		echo "&nbsp&nbsp";
		echo "<font face='Calibri' color='black' size='4'>Usuario: </font>";
		echo "<font face='Calibri' color='red' size='3'>".$usuario."</font>";	
		echo "&nbsp&nbsp";	
		echo "<font face='Calibri' color='black' size='4'>Carpeta: </font>";
		echo "<font face='Calibri' color='blue' size='3'>".$_SESSION['lacarpeta']."</font>";	
		echo "</div>";
	
		// nº de ficheros subidos
		$i=1;

		// creamos una lista de los ficheros del directorio
		if ($handle=opendir($carpeta))
		{
			// vamos leyendo los ficheros del directorio
			// mientras lea ficheros y vaya avanzando readdir($handle) retorna TRUE
			// cuando haya leído el último fichero y no pueda seguir leyendo más ficheros
			// readdir($handle) retorna FALSE
			
			//iniciamos la creación de la tabla
			echo "<table id='mitabla'>";
			while($fichero=readdir($handle))
			{
					// solamente nos interesan los "ficheros" y NO las "carpetas"
					if (is_file($carpeta.$fichero))
					{	
						// recupero el tipo de fichero
						$finfo = finfo_open(FILEINFO_MIME_TYPE); 
						$tipo = finfo_file($finfo, $carpeta.$fichero); 
						finfo_close($finfo);

						$_SESSION['elfichero'] = $fichero;
						$_SESSION['eltipo'] = $tipo;
	
						 echo "<tr>";
						 echo "<td>".$i."</td>";
						 echo "<td>".$_SESSION['elfichero']."</td>";
						 echo "<td>".$_SESSION['eltipo']."</td>";
						 // la papelera en esta versión CARPETA -> No está programada
						 echo "<td> <img id='papelera' src='imagenes/papelera.png'>"."</td>";
						 echo "</tr>";
						 $i++;
					}
			}
			echo "</table><br>";			
			
			// importante: tengo que cerrar la carpeta
			closedir($handle);
		}








?>