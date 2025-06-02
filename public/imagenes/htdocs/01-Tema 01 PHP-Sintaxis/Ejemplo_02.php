<!DOCTYPE html>
<html lang="es">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<TITLE>Ejemplo 02</TITLE>
</HEAD>
<BODY>
		<?php 
		// Este comentario no se verá en la página

		/* ponemos <br> al final del texto para que cuando se ejecute cada una
		   de las instrucciones echo se escriba, además del texto, un
		   salto de línea HTML. De este modo, el resultado de cada ECHO
		   aparecerá en una línea diferente */

		echo "Este texto se leerá <br> "; // Esto no se leerá

		/* Este es un comentario de múltiples líneas no terminará
		   hasta que no lo cerremos con el siguiente símbolo */

		echo "Este es el segundo texto que se leerá<br>";
   
		# Este es un comentario tipo shell que tampoco se leerá
		# Este, tampoco
 
		echo ("Aquí el tercer texto visible<br><br>"); #comentario invisible 
		?>
<!--Esto es un comentario en HTML fuera del script de PHP-->     
</BODY>
</HTML>

