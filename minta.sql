-- MySQL Server el�r�se parancssorb�l
mysql -h localhost -u root -p

-- Adatb�zis l�trehoz�sa
CREATE DATABASE teszt;

-- Adatb�zis t�rl�se
DROP DATABASE teszt;

-- Adatb�zis kiv�laszt�sa
USE teszt;

-- Adatt�bla l�trehoz�sa
CREATE TABLE IF NOT EXISTS `kepek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
  );
  
-- Adatt�bla t�rl�se
DROP TABLE `kepek`;
  
-- Rekord (sor) hozz�ad�sa az adatt�bl�hoz
INSERT INTO `kepek` (`id`, `file`, `description`)
	VALUES
	(NULL, '2.jpg', 'xx');
	
-- Rekord (sor) t�rl�se az adatt�bl�b�l
DELETE FROM `kepek` WHERE `id` = 2;

-- Rekord (sor) m�dos�t�sa az adatt�bl�ban
UPDATE `kepek` SET `description` =  'xxx' WHERE  `id` = 2;

-- �j mez� (oszlop) hozz�ad�sa az adatt�bl�hoz
ALTER TABLE `kepek` ADD `folder` VARCHAR( 100 ) NULL AFTER `file`;

-- Mez� (oszlop) elt�vol�t�sa az adatt�bl�b�l
ALTER TABLE `kepek` DROP `folder`;

-- Mez� (oszlop) m�dos�t�sa az adatt�bl�ban
ALTER TABLE  `kepek` CHANGE  `folder`  `folder` VARCHAR(100) NULL DEFAULT NULL;

-- Hossz v�ltoztat�sa
ALTER TABLE `eladasok` CHANGE `leiras` `leiras` VARCHAR(20);

-- Sz�m tipusra �llitja a mez�t
ALTER TABLE `eladasok` CHANGE `leiras` `leiras` INT(20);

-- Mez� (oszlop) index l�trehoz�sa
ALTER TABLE `kepek` ADD INDEX (`file`);

-- Mez� (oszlop) index t�rl�se
ALTER TABLE `kepek` DROP INDEX file;

-- K�t mez� lek�r�se sz�r�ssel
SELECT `id`, `file` FROM `kepek` WHERE `id` = 2;

-- Adatt�bla l�trehoz�sa (idegen kulcs p�ld�hoz)
CREATE TABLE IF NOT EXISTS `kepek_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
  );
  
-- Idegen kulcs be�ll�t�sa, kepek t�bla type mez�je kepek_type t�bla id mez�j�hez
-- (kapcsol�d�si t�pusok: cascade, restrict, no action, set null, set default)
ALTER TABLE  `kepek` ADD FOREIGN KEY (`type`)
REFERENCES `kepek_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- K�t t�bla �sszekapcsolt lek�rdez�se LEFT JOIN-al
SELECT `k`.`file` AS `file`, `k`.`description` AS `description`, `kt`.`type` AS `type`
FROM `kepek` AS `k`
LEFT JOIN `kepek_type` AS `kt`
ON `k`.`type` = `kt`.`id`
ORDER BY `file`;

-- Mos�g�pes p�lda
SELECT t.nev, e.ido
FROM termek AS t
LEFT JOIN eladasok AS e ON t.id = e.termek_id
WHERE e.ido > '2014-01-01'

--Mos�g�pes p�lda  megsz�mol�ssal
SELECT COUNT(t.nev)
FROM termek AS t
LEFT JOIN eladasok AS e ON t.id = e.termek_id
WHERE e.ido > '2014-01-01'

-- N�zet t�bla l�trehoz�sa k�t t�bla �sszekapcsol�s�val (az el�z� p�ld�b�l vett lek�rdez�s alapj�n)
CREATE VIEW `kepek_nezet` AS 
SELECT `k`.`file` AS `file`, `k`.`description` AS `description`, `kt`.`type` AS `type`
FROM `kepek` AS `k`
LEFT JOIN `kepek_type` AS `kt`
ON `k`.`type` = `kt`.`id`
ORDER BY `file`;

-- MySQL user l�trehoz�sa
CREATE USER 'john' IDENTIFIED BY 'jelszo';

-- MySQL user t�rl�se
DROP USER 'john';

-- Minden jog megad�sa a teszt adatb�zishoz
GRANT ALL ON teszt.* TO 'john';	

-- Csak SELECT jog megad�sa a teszt.kepek adatt�bl�hoz
GRANT SELECT ON teszt.kepek TO 'john';  

-- Minden jog megvon�sa a teszt.kepek adatt�bl�r�l
REVOKE ALL PRIVILEGES ON teszt.kepek FROM 'john';	

-- INSERT jog megvon�sa a teszt.kepek adatt�bl�r�l
REVOKE INSERT ON teszt.kepek FROM 'john';	


-- BE�P�TETT MySQL F�GGV�NYEK
-- http://dev.mysql.com/doc/refman/5.0/en/functions.html

-- egy mez� rekordjai hossz�nak lek�rdez�se
SELECT CHAR_LENGTH(kep) FROM `kepek`;

-- csak a 10 karaktern�l hosszabb k�pnevek jelennek meg
SELECT kep FROM `kepek` WHERE CHAR_LENGTH(kep) > 10;

-- egy mez� rekordjait nagybet�sen list�zza
SELECT UPPER(kep) FROM `kepek`;

-- a mez� rekordjainak 2 �s 6 karakterek k�zti r�sz�t list�zza
SELECT SUBSTRING(file, 2, 6) FROM `kepek`;

-- a mez� rekordjait hatv�nyra emelj�k (itt �pp n�gyzetre)
SELECT POW(id, 2) FROM `kepek`;

-- csak azt a rekordot list�zzuk melynek sorsz�m�nak n�gyzete egyenl� 16-al (teh�t 4)
SELECT file FROM `kepek` WHERE POW(id,2)=16;

-- csak azt a rekordot list�zzuk melynek els� bet�je "p"
SELECT file FROM `kepek` WHERE SUBSTRING(file, 1, 1) = 'p';