<?php
$verem[] = 'krumpli';
$verem[] = 'r�pa';
$verem[] = 'karal�b�';
$verem[] = 'alma';
$verem[] = 'k�rte';

#$veremx = array('xxx', 'asdad', 'asdasf'); // igy is lehet t�mb�t felt�lteni

foreach ($verem as $key=>$value){
	echo $key . '. ' . $value.'<br />';
}

#print_r($verem);

#$verem[] = 'barack';

array_push($verem, 'barack'); //betesz�nk
echo '<br />';

array_push ($verem, 'dinnye');
echo '<br />';

array_push ($verem, 'ban�n');
echo '<br />';

foreach ($verem as $key=>$value){
	echo $value.'<br />';
}

#$n = count($verem);
#$verem[$n] = '';
#unset($verem[$n]);

array_pop($verem); //kivesz�nk a veremb�l
array_pop($verem);

echo '<br />';

foreach ($verem as $key=>$value){
	echo $value . '<br />';
}

?>