<?php
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
			echo "<br>";
		}
		return true;
}
//*****************************************************
function sumo($t1,$t2)
{
	$resultado=array();
	$f=0;$c=0;
	$suma=0;
	while(isset($t1[$f]) or isset($t2[$f]) )
	{
		$c=0;
		while(isset($t1[$f][$c]) || isset($t2[$f][$c]) )
		{
			$suma=0;
			if (isset($t1[$f][$c])) {$suma=$suma+$t1[$f][$c];}
			if (isset($t2[$f][$c])) {$suma=$suma+$t2[$f][$c];}
			$resultado[$f][$c]=$suma;
			$c++;
		}
		$f++;
	}
	
	return $resultado;
}
//*****************************************************

$tabla1[0]=array('1','1','1','1','1','1','1');
$tabla1[1]=array('2','2','2','2','2');
$tabla1[2]=array('3','3','3','3','3','3');
$tabla1[3]=array('4','4','4');
$tabla1[4]=array('1','2','3','4','5','6','7');


$tabla2[0]=array('1','2','3','4','5');
$tabla2[1]=array('3','4','5');
$tabla2[2]=array('1','2','3','4');
$tabla2[3]=array('1','2','3');
$tabla2[4]=array('1','1','1','1','1','1','1');
$tabla2[5]=array('8','8');
$tabla2[6]=array('9','9','9','9');



visualizo($tabla1);
echo "<br><br>";
visualizo($tabla2);
echo "<br><br>";

$mitabla=sumo($tabla1,$tabla2);

echo "Resultado:<br>";
visualizo($mitabla);
?>
