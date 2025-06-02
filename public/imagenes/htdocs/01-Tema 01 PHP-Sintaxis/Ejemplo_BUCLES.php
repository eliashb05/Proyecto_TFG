<?php
header('Content-Type: text/html; charset=UTF-8');

// declaramos las siguientes variables
$numero=10;
$nombre='HOLA PEPE';

// ejemplo WHILE
//*************************************************************
echo "esto es un ejemplo de WHILE:"."<br><br>";
while ($numero>0)
{
     echo 'La variable número tiene el valor: '.$numero; 
	 echo '<br>';
	 $numero=$numero-1;
	 // ejemplo IF
	 if ($numero==5)
	 {
		echo 'AHORA La variable número tiene el valor 5'; 	
		echo '<br>';
	 }
}

echo "<br>";
echo "La variable número tiene el valor: ".$numero; 
echo '<br><br><br><br><br>';

// ejemplo FOR
//*************************************************************
echo "esto es un ejemplo de FOR:"."<br><br>";
for ($i=0;$i<=10;$i++)
{
	// ejemplo IF/ELSE
	// cuando $i tome valor 7 se visualizará el valor 77
	if ($i<>7)
		{
			echo "ITERACIÓN Nº: ".$i."<br>";
		}
	else
		{
			echo "ITERACIÓN Nº: 77"."<br>";
		}
}

echo "<br>";
echo "La variable i tiene el valor: ".$i; 
echo '<br><br><br><br><br>';

// ejemplo DO/WHILE
//*************************************************************
echo "esto es un ejemplo de DO/WHILE:"."<br><br>";
$i=0;
do
{
	echo "ITERACIÓN Nº: ".$i."<br>";
	$i=$i+1;
}
while ($i<=10);

echo "<br>";
echo "La variable i tiene el valor: ".$i; 

?>

