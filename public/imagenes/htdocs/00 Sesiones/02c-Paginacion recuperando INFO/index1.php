<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<meta http-equiv="Pragma" content="no-cache">
		 
		<meta name="description" content="Paginación-Base de Datos">
		<meta name="author" content="Jorge López">

		<link rel="shortcut icon" href="imagenes/icon.png"/>

		<title>Paginación</title>

		<!-- estilo general de la página -->
		<link href="ficheros/estilo_pagina.css" rel="stylesheet">
		
		<!-- estilo barra de menú -->
		<link href="ficheros/barra_menu.css" rel="stylesheet">		
		
		<!-- estilo de formularios -->
		<link href="ficheros/formularios.css" rel="stylesheet">
		
		<!-- estilo de tablas -->
		<link href="ficheros/tablas.css" rel="stylesheet">
		
		<!-- estilo barra de Navegar -->
		<link href="ficheros/navegacion.css" rel="stylesheet">
		
		<!-- librería jQuery -->
		<!-- librería que utilizo para utilizar tecnología ASÍNCRONA -> AJAX -->
		<script src="ficheros/jquery-3.3.1.js"></script>			
		
		<!-- biblioteca de iconos -->
		<link href="ficheros/all.css" rel="stylesheet">

 </head>


<script language='javascript'>

// número de registros
var NR;
// tamaño de página
var TP=8;
// página actual
var PA=1;
// número de páginas
var NP;
// registro inicial y final
var RI=0;
var RF=TP;
// trozo
var TROZO;

//*********************************************************************
//*************************** INICIO() **********************************
//*********************************************************************
function inicio()
{
	// des-habilito todos los elementos de la barra de navegación
	document.getElementById("primera").classList.add('disabled');
	document.getElementById("anterior").classList.add('disabled');
	document.getElementById("ultima").classList.add('disabled');
	document.getElementById("siguiente").classList.add('disabled');			
}

function primera_consulta()
{
		// visualizo estrella
		document.getElementById('estrella').style.visibility='visible';	
	
		// in-habilito botón consulta 
		document.getElementById('boton1').disabled=true;	

		// calculo el nº de registros que tiene la tabla
		// algo necesario para organizar todo el trabajo y calcular algunos valores de variables
		var url = "CalculoNregistros.php";
		
		$.post(url,{},function(datos)
		{
			// alert(datos);
			
			// informo del nº de registros devueltos
			document.getElementById('mensaje_label').value=datos;	
			
			// calculo el valor de algunas cosas importantes
			NR=parseInt(datos);
			NP=parseInt(NR/TP);

			TROZO=NR%TP;	
			if (TROZO>0) NP++;
			
			//alert('trozo: '+TROZO);

			// habilito todos los elementos "siguiente" y "última" de la barra de navegación	(si tengo más de una página)	
			// botón "primera" y "anterior" siguen deshabilitados
			if (NP!=1)
			{
				document.getElementById("ultima").classList.remove('disabled');
				document.getElementById("siguiente").classList.remove('disabled');			
			}	
			
			//pinto los valores de nº páginas y nº página actual
			if (PA<=9)	document.getElementById("pa").value="0"+PA;
			else document.getElementById("pa").value=PA;
			if (NP<=9)	document.getElementById("np").value="0"+NP;
			else document.getElementById("np").value=NP;
			
			// cargo la 1ª página
			fetch_listado(RI,RF);	
		});
}
//*********************************************************************
//*********************************************************************
//********************** BOTÓN 1ª PÁGINA*******************************
//*********************************************************************
//*********************************************************************
function primera()
{
	// si estoy en la 1ª página no hago nada
	if (PA>1)
	{
			  // actualizo algunas variables
			  RI=0;
			  RF=TP;
			  PA=1;
			  
			  repinto_botones();
			  // cargo la 1ª página
			  fetch_listado(RI,RF);	
	}	  
}
//*********************************************************************
//*********************************************************************
//******************* BOTÓN ÚLTIMA PÁGINA ****************************
//*********************************************************************
//*********************************************************************
function ultima()
{
	 // si ya estoy en la última página no hago nada
	 if (PA<NP)
	{
			// actualizo variables
			if (TROZO==0)
			{
				RI=TP*(NP-1);
			    RF=RI+TP;
			}
			else
			{
			    RI=(NR-TROZO);
				RF=TROZO;
			}
			  
			PA=NP;
	  
			repinto_botones();
		    // cargo la última página
			fetch_listado(RI,RF);			
	}
}
//*********************************************************************
//*********************************************************************
//********************** BOTÓN SIGUIENTE ******************************
//*********************************************************************
//*********************************************************************
function siguiente()
{
	// si estoy en la última página no hago nada
	if (PA<NP)
	{
  		    // actualizo variables
			RI=TP*(PA);
			RF=TP;
			PA++;
			
			repinto_botones();
			// cargo la siguiente página
            fetch_listado(RI,RF);		
	}
}
//*********************************************************************
//*********************************************************************
//********************** BOTÓN ANTERIOR ******************************
//*********************************************************************
//*********************************************************************
function anterior()
{
	// si estoy en la primera página no hago nada
	if (PA>1)
	{
			// actualizo variables
			RI=(RI-TP);
			RF=TP;
			PA--;			

			repinto_botones();
			// cargo la página anterior
            fetch_listado(RI,RF);		
	}
}
//***********************************************************************
function repinto_botones()
{
	var i=0;
	
	//pinto valor de nº página actual
	if (PA<=9)	document.getElementById("pa").value="0"+PA;
	else document.getElementById("pa").value=PA;

	//************ configuro botones de primera-siguiente-anterior-última página
	if (PA==NP)
	{
		document.getElementById("primera").classList.remove('disabled');
		document.getElementById("anterior").classList.remove('disabled');
		document.getElementById("ultima").classList.add('disabled');
		document.getElementById("siguiente").classList.add('disabled');		
	}
	else if (PA==1)
	{ 
		document.getElementById("primera").classList.add('disabled');
		document.getElementById("anterior").classList.add('disabled');
		document.getElementById("ultima").classList.remove('disabled');
		document.getElementById("siguiente").classList.remove('disabled');	
	}
	else
	{
		document.getElementById("primera").classList.remove('disabled');
		document.getElementById("anterior").classList.remove('disabled');
		document.getElementById("ultima").classList.remove('disabled');
		document.getElementById("siguiente").classList.remove('disabled');	
	}	
}
//***********************************************************************
function fetch_listado(REGI,REGF)
{
	// visualizo estrella
	document.getElementById('estrella').style.visibility='visible';	
	//alert(REGI+" "+REGF);

	$.post("pintotabla.php", {inicio:REGI, fin:REGF}, function(datos)
	{
			// oculto estrella
			document.getElementById('estrella').style.visibility='hidden';
	
			// en "datos" tengo el array que devuelve "pintotabla.php" en formato JSON
			// $jsondatos["lista"]
			var lista = datos.lista;
			
			// puntero a la tabla html
			var table = document.getElementById("mitabla");
				
			// obligatorio
			// borro todo el contenido de la tabla
			// con otra política de paginación -> no tendría que borrar el contenido
			table.innerHTML = "";
			
			//****************************************************
			//****************************************************
			// creo CUERPO <tbody>
			var body = table.createTBody();
			//****************************************************
			//****************************************************
			
			// me recorro el array y voy añadiendo las filas a la tabla
			//alert("tamaño tabla "+lista.length);
			
			// creo la 1ª fila
			var fila = body.insertRow(0);    
			filas_en_tabla=1;
			columnas_en_tabla=0;
			
			lista.forEach(elemento =>
			{
				var fecha_aux=elemento.fecha.substr(8,2)+"-"+elemento.fecha.substr(5,2)+"-"+elemento.fecha.substr(0,4);
				
				fila.insertCell(columnas_en_tabla).innerHTML =
				"<label data-info='"+elemento.dni+"' >"+elemento.dni+"</label>"+
				"<label data-info='"+elemento.nombre+"' >"+elemento.nombre+"</label>"+
				"<label data-info='"+elemento.edad+"' >"+elemento.edad+"</label>"+
				"<label data-info='"+elemento.precio+"' >"+elemento.precio+" €</label>"+				
				"<label data-info='"+fecha_aux+"' >"+fecha_aux+"</label>"+
				"<img class='laimagen' width='45px' height='45px' style='margin-top:2px' src='data:image/jpeg;base64,"+elemento.imagen+"'>"+
				"<img class='laimagen' onclick='consulto_celda();' width='35px' height='35px' style='cursor:pointer;margin-top:2px' src=imagenes/info.png>";
				
				columnas_en_tabla++;
				// para crear la 2ª fila
				if (columnas_en_tabla==4 && filas_en_tabla==1)
				{
					// creo la 2ª fila
					// alert('entro fila');
					fila = body.insertRow(1);    
					columnas_en_tabla=0;
					filas_en_tabla++;
				}	
			});
			//*******************************************************************
			// 									SOLAMENTE TENGO 1 FILA INCOMPLETA 
			//*******************************************************************			
			if (filas_en_tabla==1)
			{
				//alert('1 '+columnas_en_tabla);
				var columna=columnas_en_tabla;
				for (aux=columna; aux<4; aux++)
				{
					//alert('entro');
					fila.insertCell(aux).innerHTML ="";
				}	
				fila = body.insertRow(1);    
				for (var aux=0; aux<4; aux++)
				{
					//alert('entro');
					fila.insertCell(aux).innerHTML ="";
					filas_en_tabla++;
				}
			}	
			//*******************************************************************
			//						             TENGO 2 FILAS, LA 2ª FILA INCOMPLETA 
			//*******************************************************************
			if (filas_en_tabla==2)
			{
				//alert('1 '+columnas_en_tabla);
				var columna=columnas_en_tabla;
				for (aux=columna; aux<4; aux++)
				{
					//alert('entro');
					fila.insertCell(aux).innerHTML ="";
				}	
			}	
	});
}

//*********************************************************
//								          consulto CELDA
//									otra forma de hacerlo
//           OJO: no pasamos ningún parámetro a la función
//*********************************************************
function consulto_celda()
{
		// "event.target" :
		// este comando se refiere al elemento que está emitiendo un evento.
		// "closest('td')" :
		// este método recorre el elemento y sus padres (dirigiéndose hacia la raiz del documento)
		// hasta encontrar un nodo que coincida con el CSS selector especificado, 'td' en este caso.
		// "event.target.closest('td')" :
		// nos devuelve la "td" donde está la imagen (sobre la que hicimos click) que disparó el evento click

		// la <td> donde está la imagen que originó el evento click
		var la_celda = event.target.closest('td');

		// la <tr> donde está la <td> anterior
		var la_fila = la_celda.closest('tr');

		// nº de fila pulsada
		var fila_pulsada = la_fila.rowIndex;

		// nº de columna pulsada  dentro de la fila pulsada
		// aquí lo que hacemos es convertir todos los hijos de la <tr> en un array
		// ¿quien son los hijos de la <tr> ? -> pues las <td>
		// luego con indexOf(la_celda) obtenemos el índice de esa <td> en dicho array
		var columna_pulsada = Array.from(la_fila.children).indexOf(la_celda);
		 
		alert("fila: "+fila_pulsada+" columna: "+columna_pulsada);
		  
		// Obtengo todos los elementos dentro de la celda <td>
		// "td.children" : devuelve todos los nodos hijos directos (elementos)
		// ¿qué son todos los nodos hijos directos dentro de la <td>? ->
		// pues toda la información que contenga la <td>
		var elementos = la_celda.children;  

		var dni=elementos[0].getAttribute('data-info');
		var nombre=elementos[1].getAttribute('data-info');
		var edad=elementos[2].getAttribute('data-info');
		var precio=elementos[3].getAttribute('data-info');
		var fecha=elementos[4].getAttribute('data-info');
		var imagen=elementos[5].getAttribute('src');
		
		//alert(dni+"****"+nombre+"****"+edad+"****"+precio+"****"+fecha+" ");
		alert(dni+"****"+nombre+"****"+edad+"****"+precio+"****"+fecha+"****"+imagen);
 }
//*********************************************************
//*********************************************************
//*********************************************************
</script>

<body onload="inicio();">
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<!-- **************************** CABECERA ************************************************ -->
<header>
<div class="BarraNavegar">
		<i class="fas fa-tv fa-2x" ></i>
		<label  class="L1">Servidor 2º DAW&nbsp&nbsp&nbsp</label>		
		<label  class="L2"><b>PAGINACIÓN-SIMPLE_2</b></label>		
		<label  class="L3">ASÍNCRONA (Fetch)</label>	
		<label  class="L4">Thin-Server/Fat-Client</label>	
</div>
</header>
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<!-- **************************** CUERPO ************************************************ -->
<div class="contenedor1">
<div id="cajapagina" class="contenedor2">
		
		<!-- botón inicio consulta -->
		<div class="contenedor3">
				<button class="boton" id="boton1" type="button"  style="margin:10px;"
					onclick="primera_consulta();">
					<i class="fas fa-question"></i> Iniciar Consulta
				</button>

				<input class="caja_mensaje" id="mensaje_label" value="0">
		</div>
		
		<!-- donde se visualiza la tabla -->
		<div  class="contenedor4" id="pongotabla">
				<!-- la Tabla donde visualizo los datos -->
				<table class='table' id="mitabla" style='border:0px solid red'>
				</table>
		</div>	

		<!-- donde se visualiza la barra de navegación -->
		<div  class="paginacion" id="navegacion" style='border:0px solid red;margin-bottom:10px;margin-top:10px'>
				<!-- botón PRIMERA -->
				<a id="primera" onclick="primera()" href='#'>Primera</a>

				<!-- botón ANTERIOR -->
				<a id="anterior" onclick="anterior()" href='#'><<</a>
		
				<!-- botón SIGUIENTE -->
				<a id="siguiente" onclick="siguiente()"  href='#'>>></a>

				<!-- botón ÚLTIMA -->
				<a id="ultima" onclick="ultima()" href='#'>Última</a>
			
				<!-- botón Nº PÁGINA ACTUAL -->
				<input id="pa" class="marcador" value="00">
				<!-- botón Nº PÁGINAS -->
				<input id="np" class="marcador" value="00">
		</div>	
</div>
</div>
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<!-- **************************** FOOTER ************************************************ -->
<footer class="footer">
		<img  id="estrella" src="imagenes/estrella.gif"  height="40" width="40" style="visibility:hidden;"/>
		&nbsp&nbsp<i class="fas fa-building fa-2x" ></i>
		<label>&nbsp © 2025 IES Amparo Sanz</label>		
</footer>
</body>
</html>