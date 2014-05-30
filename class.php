<?php

class film{	// létrehozunk egy osztályt
	public $cim; // tulajdonságokat rendelünk hozzá, a public közvetlenül elérhetõ (pl. 36. sor)
	#public $nezoszam;
	private $nezoszam;	// ha a $nezoszam tulajdonságot private-ként definiáljuk, akkor nem érhetjük el közvetlenül csak az osztály metódusaiból
	
	function __construct(){  // az osztály konstruktor metódusa minden objektumpéldány létrehozásakor azonnal lefut (minden filmet legalább 1 ember megnéz)
		$this->nezoszam = 1;		// a this kulcsszóval hivatkozunk az aktuális objektumpéldányra
	}
	
	function megnezik($fo){	// létrehozunk az osztályban egy metódust és meghatározunk hozzá egy paramétert
		$this->nezoszam += $fo;
	}
        
        function cim_kiiras($film_sorszam){
            $result = mysql_query("SELECT cim FROM filmek WHERE sorszam = $film_sorszam");
            $a = mysql_fetch_row($result);
            $this->cim = $a[0];
            return $this->cim;
        }
	
	function nezettseg_statisztika(){
		$szoveg = 'A/az <i>' . $this->cim . '</i> címû filmet eddig összesen ' .$this->nezoszam. ' fõ látta';
		return $szoveg;
	}

}


class interju extends film{	// egy új interjú nevû osztály származtatunk a film osztályból, így tujduk használni az új osztályban a film osztály metódusait, értékeit is
	public $riporter;		// csak annyival tud többet az interju osztály, hogy neki van riporter tulajdonsága is

}


//
//csak itt kezd ténylegesen dolgozni a programunk
//

include('adatkapcsolat.php');

$film1 = new film;		// létrehozunk egy film1 objektumot a film osztály példányosításával

$film1->cim = 'Batman';		// közvetlenül adunk értéket a létrehozott objektum cim tulajdonságának

$film1->megnezik(10);		// futtatjuk az objektumon a megnezik metódust a 10-es paraméterrel

#echo $film1->nezoszam;		// közvetlenül kiírjuk az objektum nezoszam tulajdonságát

echo '<br />';

echo $film1->nezettseg_statisztika(); // futtatunk egy metódust és a visszatérési értékét íratjuk ki

#echo $film3->cim_kiiras(3);



$film2 = new interju;
$film2->cim = 'Átadják a felújított iskolát';
$film2->riporter = 'Stahl Judit';
echo '<br />' . $film2->cim;
echo '<br />' . $film2->nezettseg_statisztika();

$film1->megnezik(6);
echo '<br />'.$film1->nezettseg_statisztika();

$film_adatbazisbol = new film;
echo '<br />A film cime, adatbázisból: '.$film_adatbazisbol->cim_kiiras(3);