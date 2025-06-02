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
			echo "<br>";
		}
		return true;
}
//*****************************************************
//*****************************************************
function transformo_2($original)
{
	$resultado=array();

	for($f=0;$f<count($original);$f++)
	{
		$nc=count($original[$f]);
		for($c=0;$c<count($original[$f]);$c++)
		{
			$resultado[$f][($nc-$c-1)]=$original[$f][$c];
		}	
	}	
	
	return $resultado;
}
//*****************************************************
//*****************************************************
function transformo_1($original)
{
	$resultado=array();
	$f=0;
	for($f;$f<count($original);$f++)
	{
		$c=0;$c2=0;
		$ncolumnas=count($original[$f]);
		for($c=$ncolumnas-1;$c>=0;$c--)
		{
			$resultado[$f][$c2]=$original[$f][$c];
			$c2++;
		}	
	}
	return $resultado;
}

//*****************************************************
//*****************************************************
$original[0]=array('H','O','L','A');
$original[1]=array('S','U');
$original[2]=array('E','S','T','O','Y');
$original[3]=array('A','Q','U','I');
$original[4]=array('F','E','L','I','Z');

visualizo($original);
echo "<br><br>";


// llamo a la función transformo
$mitabla=transformo_1($original);
echo "Resultado transformo_1:<br>";
visualizo($mitabla);
echo "<br><br>";

// llamo a la función transformo
$mitabla=transformo_2($original);
echo "Resultado transformo_2:<br>";
visualizo($mitabla);
echo "<br><br>";

?>