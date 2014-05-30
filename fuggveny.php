<?php
function osszeadas($a, $b){
	$osszeg = $a + $b;
	$osszeg .= ' Ft';
	return $osszeg;
}

echo '<h1>Függvénnyel:</h1>';
echo osszeadas(3, 9);

//Osztály
class szam{
	public $ertek;
        public $deviza;
        
        function deviza_beall($dev){
            $this->deviza = $dev;
        }

	function osszeadas($a, $b){
		$osszeg = $a + $b;
		$osszeg .= ' '. $this->deviza;
		$this->ertek = $osszeg;
	}
        
        function szorzas($a, $b){
		$osszeg = $a * $b;
		$osszeg .= ' '. $this->deviza;
		$this->ertek = $osszeg;
	}
}

echo '<h1>Objektummal:</h1>';

//Objektum létrehozása osztályból, példányositás
$objektum = new szam;
$objektum->szorzas(20, 3);
$objektum->deviza_beall('Ft');
echo $objektum->ertek . $objektum->deviza;


?>