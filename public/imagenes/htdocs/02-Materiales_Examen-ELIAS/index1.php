<?php 
session_start();
if (isset($_SESSION['cliente']))
// existe una sesión abierta
{
	$dir=$_SESSION['lacarpeta']."/";
	$handle=opendir($dir);
	while ($elemento = readdir($handle))
	{ 
		if( is_file($dir.$elemento)) {unlink($dir.$elemento);}
	}	
	session_destroy();
}	
?>

<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Examen Gestión de Ficheros-Sesiones-Login en Servidor">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Sesiones</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		

		<!-- estilo formularios-botones -->
		<link href="ficheros/formularios.css" rel="stylesheet">		

		<!-- estilo tablas -->
		<link href="ficheros/tablas.css" rel="stylesheet">	
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">
		
		<!-- librería jQuery -->
		<script type="text/javascript" src="ficheros/jquery.js"></script>		
</head>

<script type="text/javascript">
//*******************************************************************************
//*******************************************************************************
//																	    inicio
//*******************************************************************************
//*******************************************************************************
function inicio()
{
	document.getElementById('elcliente').select();	
}

//*******************************************************************************
//*******************************************************************************
//													   FUNCIONALIDAD-1 ->hago_login()
//													     Llamo a "PHP-Verificacion.php" 
//*******************************************************************************
//*******************************************************************************
function hago_login()
{
		// compruebo que las cajas de texto no estén vacías	
		if ((document.getElementById('elcliente').value==""))
		{
			document.getElementById('elcliente').focus();	
			document.getElementById('info1').innerHTML="&nbsp";
			document.getElementById('info2').innerHTML="&nbsp";
		}
		else if ((document.getElementById('contrasenia').value==""))
		{
			document.getElementById('contrasenia').focus();	
			document.getElementById('info1').innerHTML="&nbsp";
			document.getElementById('info2').innerHTML="&nbsp";
		}		
		else
		{
			// visualizo estrella
			document.getElementById('estrella').style.visibility='visible';	
			// deshabilito botón
			document.getElementById('boton1').disabled=true;
			// borro mensajes etiquetas
			document.getElementById('info1').innerHTML="&nbsp";
			document.getElementById('info2').innerHTML="&nbsp";
					
			elusuario=document.getElementById('elcliente').value;
			lacontrasenia=document.getElementById('contrasenia').value;
			
			// hago la llamada utilizando AJAX jQuery
			// el script PHP obligatoriamente se llamará "PHP-Verificacion.php"
			
			var url = "php/PHP-Verificacion.php";
			// ************************************************************************
			// aquí hacemos la llamada asíncrona jQuery a "PHP-Verificacion.php"
			// ************************************************************************
			$.post(url,{el_user:elusuario.trim(), la_password:lacontrasenia.trim()}, function(datos)
				{
						// alert('llego:'+datos);
						// oculto estrella
						document.getElementById('estrella').style.visibility='hidden';

						// trato ERROR de VALIDACIÓN
						//**************************************************************
						// si los datos de login son incorrectos -> "PHP-Verificacion.php" devuelve 0
						//**************************************************************
						if (datos==0)
						{
							document.getElementById('info1').innerHTML="<font face='Calibri' color='red' size='3'>Error Validación !!</font>";
							document.getElementById('elcliente').select();	
							document.getElementById('boton1').disabled=false;	
						}
						//**************************************************************
						// si los datos de login son correctos -> "PHP-Verificacion.php" devuelve la carpeta de usuario
						//**************************************************************
						else
						{
							// aviso validación
							document.getElementById('info1').innerHTML="<font face='Calibri' color='green' size='3'>Validación Correcta !!</font>";
							// aviso carpeta usuario
							document.getElementById('info2').innerHTML="<font face='Calibri' color='red' size='3'>"+datos+"</font>";	
							// habilito botones
							document.getElementById('boton_f').disabled=false;	
							document.getElementById('los_ficheros').disabled=false;		
							document.getElementById('boton_s').disabled=false;	
							// deshabilito CAJAS DE TEXTO
							document.getElementById('elcliente').disabled=true;	
							document.getElementById('contrasenia').disabled=true;	
							// habilito botón LOGOUT
							document.getElementById('boton2').disabled=false;	
							document.getElementById('boton2').focus();
						}				
				});
		}	
}
//*******************************************************************************
//*******************************************************************************
//													   FUNCIONALIDAD-2 -> subo_ficheros()
//													     Llamo a "PHP-Subo-Ficheros.php" 
//											Esta funcionalidad ya está programada y operativa
// 		suponiendo que hayas hecho bien la FUNCIONALIDAD-1 y hayas creado las variables
// 									$_SESSION['cliente'] y $_SESSION['lacarpeta'] 
//*******************************************************************************
//*******************************************************************************
function subo_ficheros()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
			
	// borro si hay algo en el div donde se ven los ficheros subidos
	document.getElementById('ficherossubidos').innerHTML="";		

	// preparo variables
	var formData = new FormData(document.getElementById("formulario1"));	
	
	//formData.append("directorio", valor.trim());
	var ruta="php/PHP-Subo-Ficheros.php";
	
	// hago la llamada
	$.ajax({
		url: ruta,
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,		
		success: function(datos)
		{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
			// situación inicial
			document.getElementById('los_ficheros').value="";
			
			// visualizo el mensaje que me envía el servidor
			document.getElementById('ficherossubidos').innerHTML=datos;			
		}});	
}
//*******************************************************************************
//*******************************************************************************
//														   VER FICHEROS desde la CARPETA
//											Esta funcionalidad ya está programada y operativa
// 		suponiendo que hayas hecho bien la FUNCIONALIDAD-1 y hayas creado las variables
// 									$_SESSION['cliente'] y $_SESSION['lacarpeta'] 
//
//												Llamo a "PHP-Ver-Ficheros-CARPETA.php"
//*******************************************************************************
//*******************************************************************************
function ver_ficheros_carpeta()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// borro si hay algo en el div donde se ven los ficheros del usuario
	document.getElementById('ficherossubidos').innerHTML="";	
	
	var url = "php/PHP-Ver-Ficheros-CARPETA.php";
	
	// hago la llamada
	$("#ficherossubidos").load(url,{}, function()
		{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';		
			
		});	
}

//*******************************************************************************
//*******************************************************************************
//														      VER FICHEROS desde $_SESSION
//													   FUNCIONALIDAD3 -> ver_ficheros_sesion()
//													    Llamo a "PHP-Ver-Ficheros-Sesion.php" 
//*******************************************************************************
//*******************************************************************************
function ver_ficheros_sesion()
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// borro si hay algo en el div donde se ven los ficheros subidos
	document.getElementById('ficherossubidos').innerHTML="";	
	
	var url = "php/PHP-Ver-Ficheros-Sesion.php";
	
	// hago la llamada
	$("#ficherossubidos").load(url,{},function()
		{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
			
						
		});	
}		

//*******************************************************************************
//*******************************************************************************
//										BORRAR FICHERO FÍSICAMENTE Y EN $_SESSION
//										FUNCIONALIDAD-4 -> borro_fichero_sesion(celda)
//											   Llamo a "PHP-Borro-Fichero-Sesion.php" 
//*******************************************************************************
//*******************************************************************************
function borro_fichero_sesion(celda)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	// puntero a la tabla
	var tabla=document.getElementById("mitabla");
	// obtengo la fila pulsada
	var fila_pulsada=celda.parentNode.parentNode.rowIndex;
	// fichero a borrar
	// porque ahora el la columna 1 hay más cosas almacenadas
	var ficheroqueborro=tabla.rows[fila_pulsada].cells[1].innerText;	
	//alert(ficheroqueborro);
	//alert(fila_pulsada);

	var url = "php/PHP-Borro-Fichero-Sesion.php";
	// ************************************************************************
	// aquí hacemos la llamada asíncrona jQuery a "PHP-Borro-Fichero-Sesion.php"
	// borra el fichero físicamente
	// borra el fichero de $_SESSION
	// ************************************************************************
	$.post(url,{elfichero:ficheroqueborro, columna:fila_pulsada}, function()
		{
			ver_ficheros_sesion();		
		});	
}
//*******************************************************************************
//*******************************************************************************
//																 				LOGOUT
//																Llamo a "PHP_Logout.php" 
// 										esta funcionalidad está programada ya y operativa
// cuando llamo a "PHP_Logout.php" se borran todos los ficheros que haya subido el usuario a su carpeta
//*******************************************************************************
//*******************************************************************************
function termino()
{
	location.href = "php/PHP_Logout.php";	
}


</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
				<i class="fas fa-tv fa-2x" ></i>
				<label  class="L1">Servidor 2º DAW</label>		
				<label  class="L2"><b>Gestión de Ficheros-Sesiones</b></label>		
				<label  class="L3">Examen</label>	
</div>
</header>

<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
		
		<div class="contenedor2"><!-- AZUL -->
				<div class="contenedor3"><!-- NARANJA -->
						<div class="form-group">
							<label>Usuario:</label>
							<input class="input-control" id="elcliente" name="elcliente" maxlength="10" VALUE="USER01"
							required autocomplete="off" autofocus>
						</div>
						
						<div class="form-group">
							<label>Contraseña:</label>
							<input class="input-control" id="contrasenia" name="contrasenia" maxlength="10" VALUE="111111"
							required autocomplete="off">
						</div>

						<label id="info1" class="label1"> &nbsp </label>			
						<label id="info2" class="label1"> &nbsp </label>		
						
						<button class="boton" id="boton1" type="button" 
						onclick="hago_login();">
						<i class="fas fa-sign-in-alt"></i> Login
						</button>
				</div>

				<form id="formulario1" name="formulario1" method="post" enctype="multipart/form-data">
					<input class="boton" id="los_ficheros" name="los_ficheros[]" type="file" 
					multiple
					onchange="subo_ficheros()" disabled>
				</form>
				
				<button class="boton" id="boton_f" type="button" disabled
				onclick="ver_ficheros_carpeta();">
				<i class="far fa-play-circle fa-1x"></i>&nbspVer ficheros Carpeta
				</button>								
				
				<button class="boton" id="boton2" type="button" disabled
				onclick="termino();">
				<i class="fas fa-trash-alt"></i>&nbspLogout
				</button>												
		</div>
		
		<div class="contenedor2"><!-- AZUL -->			
				<div class="contenedor3b" id="ficherossubidos">	<!-- NARANJA -->
				</div>		
	
				<div class="contenedor4"><!-- MARRÓN -->
						<button class="boton" id="boton_s" type="button" style="" disabled
						onclick="ver_ficheros_sesion()">
						<i class="far fa-play-circle fa-1x"></i>&nbspVer ficheros $_SESSION
						</button>
				</div>											
		</div>	
		
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer>
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fas fa-building fa-2x" ></i>
		<label>&nbsp © 2025 IES Amparo Sanz</label>		
</footer>

</body>
</html>