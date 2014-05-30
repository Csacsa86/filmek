<?php
error_reporting ( E_ALL ^ E_NOTICE );

include('adatkapcsolat.php');

//post-tal nem látszik az elküldött adat, get-tel látszik

$menu = '
<div>
<a href="?menu=filmjeim">Filmjeim</a>
<a href="?menu=kereses">Keresés</a>
<a href="?menu=ujfilm">Új film</a>
<a href="?menu=proba">Próba</a>
</div>';

if ($_REQUEST['menu'] == 'kereses'){
	$tartalom = '
	<form action="" method="post">
		<label>Film:</label><input type="text" name="film" value="" /><br />
		<label>Szerepel:</label><input type="text" name="szinesz" /><br />
		<input type="submit" name="ok" value="OK" />
	</form>';
}

if ($_REQUEST['menu'] == 'filmjeim'){ 
	include('filmjeim.php');
}

if ($_REQUEST['menu'] == 'ujfilm'){ 
	include('ujfilm.php');
}

if ($_REQUEST['menu'] == 'proba'){
	include('proba.php');
}

if ($_REQUEST['film']){
	include('lista.php');	
}

#$sql = 'ALTER TABLE `filmek` ADD `egyebek` VARCHAR( 100 ) NULL AFTER `cim`;';
#mysql_query($sql);

echo $menu . $tartalom;				
?>