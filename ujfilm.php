<?php
if ($_REQUEST['mentes']){
	if ($_REQUEST['cim']){
		$cim = mysql_real_escape_string($_REQUEST['cim']);
		$ismerteto =  mysql_real_escape_string($_REQUEST['leiras']);
		$sql = "INSERT INTO filmek (cim, ismerteto) VALUES ('$cim', '$ismerteto')";
		mysql_query($sql);
	} else {
		$hibauzenet = 'Nem töltötted ki a cimet!';
	}
}


$tartalom = $hibauzenet . '
<form action="" method="post">
	<label>CÍM:</label><input type="text" name="cim" />
	<label>LEÍRÁS:</label><textarea name="leiras"></textarea>
	<input type="submit" name="mentes" value="Rögzités" />
</form>
';
?>