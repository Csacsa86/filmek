<?php
$kapcsolat = mysql_connect("localhost", "root", "");
$adatbazis = mysql_select_db("film");

$lekerdezes = mysql_query("SELECT sorszam, cim, ismerteto FROM filmek");
$tomb1 = mysql_fetch_row($lekerdezes); //egyetlen sor minden mezõjét beolvassuk

echo '<h1>1 sor statikus beolvasása:</h1>';
echo $tomb1[0]. ' '.$tomb1[1].' '.$tomb1[2].'<br /><br />';


echo '<h1>1 sor beolvasása ciklussal:</h1>';
$lekerdezes = mysql_query("SELECT * FROM filmek");

$tomb2 = mysql_fetch_row($lekerdezes);
foreach ($tomb2 as $key => $value){
	echo $tomb2[$key]. '<br />';
}

echo '<h1>Több sor 1 mezõjének beolvasása ciklussal:</h1>';

$lekerdezes3 = mysql_query("SELECT * FROM filmek");

while ($tomb2 = mysql_fetch_row($lekerdezes3)){
	echo $tomb2[1]. '<br />';
}

?>