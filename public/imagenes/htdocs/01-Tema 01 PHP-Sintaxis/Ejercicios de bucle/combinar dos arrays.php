<?php

$tabla1=array(1,2,3,4,5);
$tabla2=array(10,20,30,40,50,60,70,80);

//***************************************************
function visualizo($aux)
{
	$c=0;
	while (isset($aux[$c]))
	{
		echo " $aux[$c] ";
		$c++;
	}	
}
//***************************************************
//***************************************************
function transformo_1($t1,$t2)
{
	$nuevo=array();
	$i=0;
	
	while (isset($t1[$i])) 
	{
		$nuevo[$i]=$t1[$i];
		$i++;
	}
	
	$j=0;
	while (isset($t2[$j])) 
	{
		$nuevo[$i]=$t2[$j];
		$i++;
		$j++;
	}
	
	return $nuevo;
}
//******************************************************
//******************************************************
function transformo_2($t1,$t2)
{
	$nuevo=$t1;
	$i=count($nuevo);

	$j=0;
	while (isset($t2[$j])) 
	{
		$nuevo[$i]=$t2[$j];
		$i++;
		$j++;
	}
	
	return $nuevo;
}
//******************************************************
//******************************************************
echo "el array tabla1 es: <br>";
visualizo($tabla1);
echo "<br><br>";

echo "el array tabla2 es: <br>";
visualizo($tabla2);
echo "<br><br>";

$array_resultado=transformo_1($tabla1,$tabla2);
echo "el array obtenido es: <br>";
visualizo($array_resultado);
echo "<br><br>";

$array_resultado=transformo_1($tabla2,$tabla1);
echo "el array obtenido es: <br>";
visualizo($array_resultado);
echo "<br><br>";

$array_resultado=transformo_2($tabla1,$tabla2);
echo "el array obtenido es: <br>";
visualizo($array_resultado);
echo "<br><br>";

$array_resultado=transformo_2($tabla2,$tabla1);
echo "el array obtenido es: <br>";
visualizo($array_resultado);

?>
