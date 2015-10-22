<?php
function Summary()
{
$zloty = $_POST['zloty'];
$grosze = $_POST['grosze'];
$hourDay = $_POST['summaryHourDay'];
$hourNight = $_POST ['summaryHourDayNight'];

$umowa = $_POST['umowa'];
$checkStatus_Student = $_POST['czyUczen'];
// $umowa == 0 (Umowa Zlecenie) $umowa == 1 (Umowa o prace)
// $checkStatus_Student == 1 (posiada) $checkStatus_Student == 0 (nie posiada)
if ($umowa == 0)
{
		$text_0 = "Posiadasz umowe zlecenie";
		//Posiada umowe zlecenie
		$sumHour = $hourDay + $hourNight;
		$bruttoSum =( $sumHour *(($zloty * 100) + $grosze))/100;
		$text_1 = "Zarobiłeś brutto: $bruttoSum zł" ;
		$text_2 = "Łączna ilość godzin: $sumHour ";
		
		// Ubezpieczenie spoleczne (emerytalne).
		$tax_social = round ((($bruttoSum * 9.76)/100) , 2);
		// Ubezpieczenie spoleczne (rentowe)
		$tax_rent = round ((($bruttoSum * 1.5)/100) , 2);
		// Ubezpieczenie spoleczne (chorobowe) w groszach
		$tax_sick = round ((($bruttoSum * 2.45)/100) , 2);
		
		$tax_total = $tax_social-$tax_rent - $tax_sick;
					// Z statusem sie oplaca :)
					if ($checkStatus_Student == 1)
					{
					$tax_income  = round ((($bruttoSum - $tax_total )*18)/100);
					$nettoSum = round ( ($bruttoSum - $tax_income) , 2 );
					$text_3 ="Zarobiles netto : $nettoSum  zł" ;
					echo "Posiadasz status ucznia";
					echo "Ile masz tutaj: $tax_income";
					}
					else if ($checkStatus_Student == 0)
					{
					// Bez statusu studenta (dochodzi skladka zdrwotna i reszta podatkow a nie tylko dochodowy
					echo "Nie posiadasz statusu ucznia";
					$cost = (($bruttoSum - $tax_total) * 20)/100;
					$tax_health = round (((($bruttoSum - $tax_total)*7.75)/100));
					$tax_health_1 = round (((($bruttoSum - $tax_total)*9)/100) , 2);
					$tax_income = round (((($bruttoSum - $tax_total - $cost)*18)/100), 2);
					$tax_income_final = $tax_income - $tax_health;
					$nettoSum = round ( ($bruttoSum - $tax_total - $tax_income_final - $tax_health));
					$text_3 = "Zarobiles netto: $nettoSum zł";
					echo "To jaki w koncu jest sygnal?  $checkStatus_Student: $tax_total, $tax_income_final";
					}
					
					// Sprawdzamy pod który przedział pasuje:)
					if( ( $nettoSum < 500) AND ($nettoSum < 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum < 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_1000.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
						if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_1500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum > 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_2000.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum > 1500) AND ($nettoSum > 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_2500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					
				


				// Średnia :).
				$file = fopen ("data_nettoSum.txt" , "a");
				$data_nettoSum = "$nettoSum".PHP_EOL;
				fwrite ($file , $data_nettoSum);
				fclose ($file); 				
					
				//Wydajnosc stawki :). Tak to nazwijmy.
				$posible_HourDay = round(($nettoSum/$sumHour) , 2);
				$text_4 = "Średnio zarabiałeś na godzinę: $posible_HourDay zł" ; 
				$arrayText = array ($text_0 , $text_1, $text_2, $text_3, $text_4);
				for ($i = 0 ; $i < 5 ; $i++)
				{
				echo $arrayText[$i];
				echo "<br>";
				}
		
				}
				
	
	else if ($umowa == 1)
	{
	echo "Co się kurwa zjebało? : $hourDay";
	// Umowa o prace.
	$mouth = date ("n");
	$array_mouthHour = array (160, 160, 176, 168, 160, 168, 184, 160, 176, 176,160,168);
	$mouthHour = $array_mouthHour[$mouth-1];
	$sumHour = $hourNight + $hourDay;
	if ($sumHour > $mouthHour)
		{
		$overHour = $sumHour - $mouthHour;
		$bruttoSum_overHour = round (((((((($zloty * 100) + $grosze)*50)/100)/100) + (($zloty * 100) + $grosze)/100) * $overHour),2);
		$freeJob = round ($overHour/8);
		echo "Posiadasz $overHour nadgodzin.Które, może zaminić na: ";
		echo "<br>";
		echo "Kwota brutto z nadgodzin wynosi $bruttoSum_overHour";
		echo "<br>";
		echo "lub";
		echo "Na dni wolne od pracy: $freeJob";
		echo "<br>";
		}

	$text_0 = "Posiadasz umowe o prace";
	// jezeli nie ma godzin nocnych a sa dzienne
				if ($hourDay == 0)
					{
					$bruttoSum_day = 0;
					}
					
			$bruttoSum_day = ($hourDay*($zloty *100 + $grosze))/100;
			
					if ($hourNight == 0);
					{
					$bruttoSum_night = 0;
					}
			$bruttoSum_night = ($hourNight*(((($zloty * 100 + $grosze)*25)/100) + ($zloty*100 + $grosze)))/100;
			if ($sumHour < $mouthHour)
			{
			$bruttoSum = round (($bruttoSum_day + $bruttoSum_night));
			}
			if ($sumHour > $mouthHour)
			{
			$bruttoSum = round (($bruttoSum_day + $bruttoSum_night + $bruttoSum_overHour));
			}
			$text_1 = "Zarobiles (brutto) : $bruttoSum zł";
			$text_3 = "Godzin nocnych miałeś: $hourNight ";
			$text_2 = "Godzin dziennych miałeś : $hourDay";
			
			
		// Ubezpieczenie spoleczne (emerytalne).
		$tax_social = round ((($bruttoSum * 9.76)/100) , 2);
		// Ubezpieczenie spoleczne (rentowe)
		$tax_rent = round ((($bruttoSum * 1.5)/100) , 2);
		// Ubezpieczenie spoleczne (chorobowe) w groszach
		$tax_sick = round ((($bruttoSum * 2.45)/100) , 2);
		
		$tax_total = $tax_social+ $tax_rent + $tax_sick;
		$p = $bruttoSum - $tax_total;
					
					
		 
	
		// Ubezpieczenie zdrowotne
		$tax_health_0 = round ( ( (($bruttoSum - $tax_total)*9)/100) , 2);
		$tax_health_1 = round  (((($bruttoSum - $tax_total)*7.75)/100), 2);
		// Koszty uzyskania przychodu:
		$cost_tax = 111.25;
		// Kwota wolna od podatku:
		$taxfree = 46.33;
		// Podatek dochodowy 
		$tax_income_0 = round ( (((($bruttoSum - $tax_total - $cost_tax)*18)/100)-$taxfree), 2);
		$tax_income_1 = round (($tax_income_0 - $tax_health_1));
		// Kwota netto 
		$nettoSum = round ($bruttoSum - $tax_total - $tax_health_0 - $tax_income_0);
		$text_4 = "Zarobiłeś (netto): $nettoSum zł";
		// Wydajnosc :)
			
			// Istnieja fodziny nocne ale dzienne nie.
			
			if( (!$hourDay == 0) AND (!$hourNight == 0) )
			{
			$hourAll  = $hourDay + $hourNight;
			$posible_HourDay = round(($nettoSum/$hourAll) , 2);
			$posible_HourNight = round ( (  (($posible_HourDay*25)/100) + $posible_HourDay), 2);
			}
			
			if ( ($hourDay == 0 ) AND (!$hourNight == 0) )
			{
			$posible_HourDay = 0;
			$posible_HourNight = round (($nettoSum/$hourNight),2);
			
			}
			$text_5 = "Średnio w godzinach dziennych zarabiałeś : $posible_HourDay";
			$text_6 = "Średnio w godzinach nocnych zarabiaeś: $posible_HourNight";
			
		
			

			// Sprawdzamy pod który przedział pasuje:)
			
					$db_ip = fopen ("data_ip.txt" , "a");
					$db_ip_record = $_SERVER['REMOTE_ADDR']. PHP_EOL;
					fwrite ($db_ip, $db_ip_record);
					fclose ($db_ip);
					
					if( ( $nettoSum < 500) AND ($nettoSum < 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum < 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_1000.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
						if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum < 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_1500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum > 1500) AND ($nettoSum < 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_2000.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					if( ( $nettoSum > 500) AND ($nettoSum > 1000) AND ($nettoSum > 1500) AND ($nettoSum > 2000) AND ($nettoSum < 2500) )
					{
						$db_file = fopen ("db_sort_2500.txt" , "a");
						$db_record = "$nettoSum" . PHP_EOL;
						fwrite ($db_file , $db_record);
						
					}
					
						$file = fopen ("data_nettoSum.txt" , "a");
						$data_nettoSum = "$nettoSum".PHP_EOL;
						fwrite ($file , $data_nettoSum);
						fclose ($file); 
			}
		
		
		
		$arrayText = array ($text_0 , $text_1, $text_2, $text_3, $text_4, $text_5, $text_6);
			for ($i = 0 ; $i < 7 ; $i++)
				{
				echo $arrayText[$i];
				echo "<br>";
				}
	$use = 1;
	}	
	
	?>