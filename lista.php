<?php
$sorok = '';

//if ($_GET['film']){  A $_REQUEST tartalmazza a $_GET �s $_POST �rt�keket is
if ($_REQUEST['film']){		//glob�lis t�mb ami tartalmazza a post-tal �s get-tel k�ld�tt adatokat
	$film = $_REQUEST['film'];
	$szures = "WHERE f.cim LIKE '%".$film."%'";
	}
else {
	$film = '';
}

if ($_REQUEST['szinesz']){
	$szinesz = $_REQUEST['szinesz'];
	$szures = "WHERE sze.nev LIKE '%".$szinesz."%'";
	}
else {
	$szinesz = '';
}

$result = mysql_query("SELECT sze.nev AS szinesz, f.cim, k.kep FROM szerepeltek AS sz
						LEFT JOIN szemelyek AS sze ON sz.szerepel = sze.sorszam
						LEFT JOIN filmek AS f ON sz.film = f.sorszam
						LEFT JOIN kepek AS k ON sze.sorszam = k.szemely ". $szures);
if ($result){						
while ($element = mysql_fetch_array($result)){ //az element nev� t�mbbe k�rj�k az adatokat
	#echo $element['szinesz']. '<br />';
	$sorok .= '<tr><td>'.$element[0].'</td><td><img src="kepek/'.$element[2].'" style="width: 200px;" /></td><td>'.$element[1].'</td></tr>';
}
}

$lista = '
	<a href="index.php?film=hihet">Hihetetlen Hulk</a><br/>
	<a href="index.php?film=John">John Rambo</a>
	<table border="1">
		<tr><td>Sz�n�sz</td><td>k�p</td><td>Film</td></tr>
		'.$sorok.'
	</table>';
	
$tartalom .= $lista;
?>