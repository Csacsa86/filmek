<?php
if ($_REQUEST['mentes']){
	if ($_REQUEST['cim']){
		$cim = mysql_real_escape_string($_REQUEST['cim']);
		$ismerteto =  mysql_real_escape_string($_REQUEST['leiras']);
		$sql = "INSERT INTO filmek (cim, ismerteto) VALUES ('$cim', '$ismerteto')";
		mysql_query($sql);
	} else {
		$hibauzenet = 'Nem t�lt�tted ki a cimet!';
	}
}


$tartalom = $hibauzenet . '
<form action="" method="post">
	<label>C�M:</label><input type="text" name="cim" />
	<label>LE�R�S:</label><textarea name="leiras"></textarea>
	<input type="submit" name="mentes" value="R�gzit�s" />
</form>
';
?>