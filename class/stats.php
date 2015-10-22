<?php
function Stats ()
	{
// Kolejna, funkcja pokazuje obecne wyniki, ale ich nie obliczna na onload. 
			
			
			//Średnia
			$avg_arr = file("class/data/main/db_avg.txt");
			$avg_length = count($avg_arr);
			// Mediana
			$med_arr = file("class/data/main/db_median.txt");
			$med_length = count($med_arr);
			// Dominanta
			$dom_arr = file("class/data/main/db_dominante.txt");
			$dom_length = count ($dom_arr);
			
			// Zapisujemy ostatni wynik obliczeń.
			$plain_text_1 = $avg_arr[$avg_length-1]; 
			$plain_text_2 = $med_arr[$med_length-1];
			$plain_text_3 = $dom_arr[$dom_length-1];
			
			// Wyświetlamy wynik.
			
			$arr_stats = array ( $plain_text_1 , $plain_text_2 , $plain_text_3);
			
			
			for ($a = 0 ; $a < 3 ; $a++)
				{
				
				echo $arr_stats[$a]."&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp";
				}
	}

	?>