<?php

//*****************************************************
//*****************************************************
function visualizo($aux)
{
		$fila=0;
		while(isset($aux[$fila]))
		{
			$columna=0;
			while(isset($aux[$fila][$columna]))
			{
				echo $aux[$fila][$columna]."*";
				$columna++;
			}
			$fila++;
			//echo " columnas: ".$columna;
			echo "<br>";
		}
		echo "<br>";
	return true;
}
//*****************************************************
// algoritmo mejorado -> me da igual si las filas de las tablas coinciden o no
//*****************************************************
function transformo_1($A,$B)
{
	
	//***** medir tiempo *****
	$inicio=microtime(true);
	sleep(1);
	//**********************
	
	$resultado=array();
	
	$f=0;

	// recorrido array n-1
	while(isset($A[$f]))
	{
		$i=0;
		while (isset($A[$f][$i]))
		{
				//echo $A[$f][$i]."<br>";
				$resultado[$f][$i]=$A[$f][$i];
				$i++;
		}
		$f++;
	}	
	
	$i=0;
	$f=0;
	
	
	// recorrido array n-2
	while(isset($B[$f]))		
	{	
		$i=0;
		while (isset($B[$f][$i]))
		{
				//echo $B[$f][$i]."<br>";
				// longitud de cada fila en $resultado
				$longitud=count($resultado[$f]);
				//echo "la longitud de la fila ".$f." es ".$longitud."<br>";
				$resultado[$f][$longitud]=$B[$f][$i];
				$i++;
		}
		$f++;	
	}

	//***** medir tiempo *****
	$final=microtime(true);
	$total=$final-$inicio;
	echo "tiempo de ejecución: ".round(($total-1),6)." segundos<br>";
	//**********************

	return $resultado;
}
//*****************************************************
//*****************************************************
// 											OTRA SOLUCIÓN 
// algoritmo mejorado -> me da igual si las filas de las tablas coinciden o no
//*****************************************************
//*****************************************************
function transformo_2($A,$B)
{
	//***** medir tiempo *****
	$inicio=microtime(true);
	sleep(1);
	//**********************
	
	$resultado=$A;
	$f=0;
	
	// recorrido array n-2
	while(isset($B[$f]))
	// mientras existan filas
	{	
		$i=0;
		while (isset($B[$f][$i]))
		// mientras existan columnas dentro de la fila	
		{
				// calculo el nº de columnas que tiene $resultado en esa fila
				// y es en ese nº donde empezaré a insertar valores
				$ncolumnas=count($resultado[$f]);
				$resultado[$f][$ncolumnas]=$B[$f][$i];
				$i++;
		}
		$f++;	
	}
	
	//***** medir tiempo *****
	$final=microtime(true);
	$total=$final-$inicio;
	echo "tiempo de ejecución: ".round(($total-1),6)." segundos<br>";
	//**********************
	
	return $resultado;
}
//*****************************************************
//*****************************************************
// 											OTRA SOLUCIÓN 
// algoritmo mejorado -> me da igual si las filas de las tablas coinciden o no
//*****************************************************
//*****************************************************
function transformo_3($A,$B)
{
	//***** medir tiempo *****
	$inicio=microtime(true);
	sleep(1);
	//**********************
	
	$resultado=array();
	$f=0;
	
	// recorrido de las 2 tablas a la vez
	// mientras existan filas en alguna tabla
	while(isset($A[$f]) || isset($B[$f]))
	{	
		$c1=0; $c2=0;
		// mientras existan columnas en alguna de las 2 filas	

		// calculo el nº de columnas que tiene $A en esta fila
		// y es en ese nº donde empezaré a insertar las valores de $B en $resultado
		$ncolumnas=count($A[$f]);

		while (isset($A[$f][$c1]) || isset($B[$f][$c2]))
		{
				//leo $A
				if (isset($A[$f][$c1])) {$resultado[$f][$c1]=$A[$f][$c1];} 
				//leo $B
				if (isset($B[$f][$c2])) {$resultado[$f][$ncolumnas]=$B[$f][$c2];}  
				
				$c1++;$c2++; $ncolumnas++;
		}
		$f++;	
	}
	
	//***** medir tiempo *****
	$final=microtime(true);
	$total=$final-$inicio;
	echo "tiempo de ejecución: ".round(($total-1),6)." segundos<br>";
	//**********************
	
	return $resultado;
}

//*****************************************************
// 											     PRUEBAS 
//*****************************************************
$originalA[0]=array('H','O','L','A');
$originalA[1]=array('P','E');
$originalA[2]=array('E','S','T','O','Y');
$originalA[3]=array('A','Q','U','I');
$originalA[4]=array('F','E','L','I','Z');

$originalB[0]=array('1','X','1');
$originalB[1]=array('2','2','Y','Y','2','2','2');
$originalB[2]=array('3','3');
$originalB[3]=array('4','4','X');
$originalB[4]=array('5','5','5','5','5','5');

echo "el array-1 es : <br>";
visualizo($originalA);
echo "<br>";
echo "el array-2 es : <br>";
visualizo($originalB);
echo "<br>";

$mitabla=transformo_1($originalA,$originalB);
echo "Resultado transformo_1:<br>";
visualizo($mitabla);
echo "<br>";

$mitabla=transformo_2($originalA,$originalB);
echo "Resultado transformo_2:<br>";
visualizo($mitabla);
echo "<br>";

$mitabla=transformo_3($originalB,$originalA);
echo "Resultado transformo_3:<br>";
visualizo($mitabla);
echo "<br>";
?>
