<?php
function getForm()
{
	
		$arr1 = array (9,10,11,12);
		$arr2 = array (10,20,30,40,50,60,70,80,90);
		echo 	'<form id="form" method="post" action="index.php">';
		echo 'Podaj swoją stawkę na godzinę:';
			echo "<select>";
			for ($i = 0 ; $i < 4 ; $i++)
				{
				echo "<option>$arr1[$i],00 zł</option>";
				echo "<br>";
					for ($b = 0; $b < 9; $b++)
					{
					echo "<option>$arr1[$i],$arr2[$b] zł</option>";
					echo "<br>";
					}
				}
		echo "<option> 13,00 zł </option>";
		echo "<select>";
		echo "<br>";
		echo "Rodzaj umowy:";
		echo '<input type="radio" name="umowa" id="checkUmowa" value="0"> Umowa zlecenie <input type="radio" name="umowa" id="checkUmowa" value="1"> Umowa o pracę';
		echo "<br>";
		echo 'Ilość godzin dziennych: <input type="text" name="summaryHourDay" id="checkHourDay">';
		echo "<br>";
		echo 'Ilość godzin nocnych: <input type="text" name="summaryHourDayNight" id="checkHourNight">';
		echo "<br>";
	
		echo '<input type="submit" id="check" name="use" value="Zapisz" value="1">';
		echo "</form>";
		$use = 1;
		setcookie ('xyz' , $use, time() );
		

	
}



?>
