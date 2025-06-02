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
function transformo($original)
{
	$resultado=array();

	for($f=0;$f<count($original);$f++)
	{
		$nc=count($original[$f]);
		for($c=0;$c<count($original[$f]);$c++)
		{
			$resultado[$nc-1][$c]=$original[$f][$c];
		}	
	}	
	
	return $resultado;
}
//*****************************************************

$originalA[0]=array('H','O','L','A');
$originalA[1]=array('E','S','T','O','Y');
$originalA[2]=array('10','10','10','10','10','10','10','10','10','10');
$originalA[3]=array('6','6','6','6','6','6');
$originalA[4]=array('P','E','N','S','A','N','D','O');
$originalA[5]=array('L','U','Z',);
$originalA[6]=array('L','O');
$originalA[7]=array('7','7','7','7','7','7','7');
$originalA[8]=array('Y');
$originalA[9]=array('9','9','9','9','9','9','9','9','9');

visualizo($originalA);
echo "<br><br>";

$mitabla=transformo($originalA);

echo "Resultado:<br>";
visualizo($mitabla);
?>
