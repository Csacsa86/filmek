<?php
$result = mysql_query("SELECT cim, ismerteto FROM filmek");

if ($result){			
while ($element = mysql_fetch_array($result)){ //az element nev� t�mbbe k�rj�k az adatokat
	$sorok .= $element['cim']. '<br />';
	echo mysql_error();
}
}

$sorok .= '<br /><br />';

//Mysql be�pitett f�ggv�nnyel
$result = mysql_query("SELECT sorszam, kep FROM `kepek` WHERE CHAR_LENGTH(kep) > 13;");
while ($element = mysql_fetch_array($result)){
	$sorok .= $element['kep']. '<br />';
}

$sorok .= '<br /><br />';

//be�pitett f�ggv�ny n�lk�l
$result = mysql_query("SELECT kep FROM `kepek`");
while ($element = mysql_fetch_array($result)){
	$hossz = strlen($element['kep']);
	if ($hossz > 13){
		$sorok .= $element['kep']. '<br />';
	}
}


$tartalom .= $sorok;
?>