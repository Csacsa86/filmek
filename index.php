<?php
error_reporting ( E_ALL ^ E_NOTICE );

include('adatkapcsolat.php');

//post-tal nem l�tszik az elk�ld�tt adat, get-tel l�tszik

$menu = '
<div>
<a href="?menu=filmjeim">Filmjeim</a>
<a href="?menu=kereses">Keres�s</a>
<a href="?menu=ujfilm">�j film</a>
<a href="?menu=proba">Pr�ba</a>
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