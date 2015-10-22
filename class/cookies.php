<?php

//  Nasze kochane ciasteczko, sprawdza czy kiedykolwiek user był już na stronie.
function cookies()
{
	$ip = $_SERVER['REMOTE_ADDR'].PHP_EOL;
	$arr_ip = file("class/data/data_ip.txt"); 
	if(in_array($ip, $arr_ip))
	{
	$firstVisit = 1;
	}
	else 
	{
	$firstVisit = 0;
	
	}
		
	if (!isset($timeSwap))
		{
		$timeSwap = 0;
		}
	else 
		{
		$timeSwap = 1;
		}



$valueDay = date("t")-date("j")+1;
setcookie ( 'asd' , $firstVisit , time()+ ((60*60)*24)*$valueDay );
setcookie ( 'dsa' , $timeSwap , time()  + 30);
}
?>
