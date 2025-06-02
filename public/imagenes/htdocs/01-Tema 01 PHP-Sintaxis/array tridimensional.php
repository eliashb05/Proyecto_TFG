<?php
		$valor [0] [0] [0]= 1; $valor [0] [1] [0]= 14; $valor [0] [2] [0]= 8; $valor [0] [3] [0]= 3;
		$valor [1] [0] [0]= 6; $valor [1] [1] [0]= 19; $valor [1] [2] [0]= 7; $valor [1] [3] [0]= 2;
		$valor [2] [0] [0]= 3; $valor [2] [1] [0]= 13; $valor [2] [2] [0]= 4; $valor [2] [3] [0]= 1;

		$valor [0] [0] [1]= 10; $valor [0] [1] [1]= 20; $valor [0] [2] [1]= 30; $valor [0] [3] [1]= 40;
		$valor [1] [0] [1]= 50; $valor [1] [1] [1]= 60; $valor [1] [2] [1]= 70; $valor [1] [3] [1]= 80;
		$valor [2] [0] [1]= 90; $valor [2] [1] [1]= 91; $valor [2] [2] [1]= 92; $valor [2] [3] [1]= 93;


		for ($k = 0; $k < 2; $k++) { // Capas
			echo "Capa $k:<br>";
			for ($i = 0; $i < 3; $i++) { // Filas
				for ($j = 0; $j < 4; $j++) { // Columnas
					echo $valor[$i][$j][$k] . " ";
				}
				echo "<br>";
			}
			echo "<br>";
		}

		
?>
