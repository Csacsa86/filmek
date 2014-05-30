<?php
$verem[] = 'krumpli';
$verem[] = 'répa';
$verem[] = 'karalábé';
$verem[] = 'alma';
$verem[] = 'körte';

#$veremx = array('xxx', 'asdad', 'asdasf'); // igy is lehet tömböt feltölteni

foreach ($verem as $key=>$value){
	echo $key . '. ' . $value.'<br />';
}

#print_r($verem);

#$verem[] = 'barack';

array_push($verem, 'barack'); //beteszünk
echo '<br />';

array_push ($verem, 'dinnye');
echo '<br />';

array_push ($verem, 'banán');
echo '<br />';

foreach ($verem as $key=>$value){
	echo $value.'<br />';
}

#$n = count($verem);
#$verem[$n] = '';
#unset($verem[$n]);

array_pop($verem); //kiveszünk a verembõl
array_pop($verem);

echo '<br />';

foreach ($verem as $key=>$value){
	echo $value . '<br />';
}

?>