<?php
function osszeadas($a, $b){
	$osszeg = $a + $b;
	$osszeg .= ' Ft';
	return $osszeg;
}

echo '<h1>F�ggv�nnyel:</h1>';
echo osszeadas(3, 9);

//Oszt�ly
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

//Objektum l�trehoz�sa oszt�lyb�l, p�ld�nyosit�s
$objektum = new szam;
$objektum->szorzas(20, 3);
$objektum->deviza_beall('Ft');
echo $objektum->ertek . $objektum->deviza;


?>