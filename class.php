<?php

class film{	// l�trehozunk egy oszt�lyt
	public $cim; // tulajdons�gokat rendel�nk hozz�, a public k�zvetlen�l el�rhet� (pl. 36. sor)
	#public $nezoszam;
	private $nezoszam;	// ha a $nezoszam tulajdons�got private-k�nt defini�ljuk, akkor nem �rhetj�k el k�zvetlen�l csak az oszt�ly met�dusaib�l
	
	function __construct(){  // az oszt�ly konstruktor met�dusa minden objektump�ld�ny l�trehoz�sakor azonnal lefut (minden filmet legal�bb 1 ember megn�z)
		$this->nezoszam = 1;		// a this kulcssz�val hivatkozunk az aktu�lis objektump�ld�nyra
	}
	
	function megnezik($fo){	// l�trehozunk az oszt�lyban egy met�dust �s meghat�rozunk hozz� egy param�tert
		$this->nezoszam += $fo;
	}
        
        function cim_kiiras($film_sorszam){
            $result = mysql_query("SELECT cim FROM filmek WHERE sorszam = $film_sorszam");
            $a = mysql_fetch_row($result);
            $this->cim = $a[0];
            return $this->cim;
        }
	
	function nezettseg_statisztika(){
		$szoveg = 'A/az <i>' . $this->cim . '</i> c�m� filmet eddig �sszesen ' .$this->nezoszam. ' f� l�tta';
		return $szoveg;
	}

}


class interju extends film{	// egy �j interj� nev� oszt�ly sz�rmaztatunk a film oszt�lyb�l, �gy tujduk haszn�lni az �j oszt�lyban a film oszt�ly met�dusait, �rt�keit is
	public $riporter;		// csak annyival tud t�bbet az interju oszt�ly, hogy neki van riporter tulajdons�ga is

}


//
//csak itt kezd t�nylegesen dolgozni a programunk
//

include('adatkapcsolat.php');

$film1 = new film;		// l�trehozunk egy film1 objektumot a film oszt�ly p�ld�nyos�t�s�val

$film1->cim = 'Batman';		// k�zvetlen�l adunk �rt�ket a l�trehozott objektum cim tulajdons�g�nak

$film1->megnezik(10);		// futtatjuk az objektumon a megnezik met�dust a 10-es param�terrel

#echo $film1->nezoszam;		// k�zvetlen�l ki�rjuk az objektum nezoszam tulajdons�g�t

echo '<br />';

echo $film1->nezettseg_statisztika(); // futtatunk egy met�dust �s a visszat�r�si �rt�k�t �ratjuk ki

#echo $film3->cim_kiiras(3);



$film2 = new interju;
$film2->cim = '�tadj�k a fel�j�tott iskol�t';
$film2->riporter = 'Stahl Judit';
echo '<br />' . $film2->cim;
echo '<br />' . $film2->nezettseg_statisztika();

$film1->megnezik(6);
echo '<br />'.$film1->nezettseg_statisztika();

$film_adatbazisbol = new film;
echo '<br />A film cime, adatb�zisb�l: '.$film_adatbazisbol->cim_kiiras(3);