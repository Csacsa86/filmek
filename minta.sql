-- MySQL Server elérése parancssorból
mysql -h localhost -u root -p

-- Adatbázis létrehozása
CREATE DATABASE teszt;

-- Adatbázis törlése
DROP DATABASE teszt;

-- Adatbázis kiválasztása
USE teszt;

-- Adattábla létrehozása
CREATE TABLE IF NOT EXISTS `kepek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
  );
  
-- Adattábla törlése
DROP TABLE `kepek`;
  
-- Rekord (sor) hozzáadása az adattáblához
INSERT INTO `kepek` (`id`, `file`, `description`)
	VALUES
	(NULL, '2.jpg', 'xx');
	
-- Rekord (sor) törlése az adattáblából
DELETE FROM `kepek` WHERE `id` = 2;

-- Rekord (sor) módosítása az adattáblában
UPDATE `kepek` SET `description` =  'xxx' WHERE  `id` = 2;

-- Új mezõ (oszlop) hozzáadása az adattáblához
ALTER TABLE `kepek` ADD `folder` VARCHAR( 100 ) NULL AFTER `file`;

-- Mezõ (oszlop) eltávolítása az adattáblából
ALTER TABLE `kepek` DROP `folder`;

-- Mezõ (oszlop) módosítása az adattáblában
ALTER TABLE  `kepek` CHANGE  `folder`  `folder` VARCHAR(100) NULL DEFAULT NULL;

-- Hossz változtatása
ALTER TABLE `eladasok` CHANGE `leiras` `leiras` VARCHAR(20);

-- Szám tipusra állitja a mezõt
ALTER TABLE `eladasok` CHANGE `leiras` `leiras` INT(20);

-- Mezõ (oszlop) index létrehozása
ALTER TABLE `kepek` ADD INDEX (`file`);

-- Mezõ (oszlop) index törlése
ALTER TABLE `kepek` DROP INDEX file;

-- Két mezõ lekérése szûréssel
SELECT `id`, `file` FROM `kepek` WHERE `id` = 2;

-- Adattábla létrehozása (idegen kulcs példához)
CREATE TABLE IF NOT EXISTS `kepek_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
  );
  
-- Idegen kulcs beállítása, kepek tábla type mezõje kepek_type tábla id mezõjéhez
-- (kapcsolódási típusok: cascade, restrict, no action, set null, set default)
ALTER TABLE  `kepek` ADD FOREIGN KEY (`type`)
REFERENCES `kepek_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Két tábla összekapcsolt lekérdezése LEFT JOIN-al
SELECT `k`.`file` AS `file`, `k`.`description` AS `description`, `kt`.`type` AS `type`
FROM `kepek` AS `k`
LEFT JOIN `kepek_type` AS `kt`
ON `k`.`type` = `kt`.`id`
ORDER BY `file`;

-- Mosógépes példa
SELECT t.nev, e.ido
FROM termek AS t
LEFT JOIN eladasok AS e ON t.id = e.termek_id
WHERE e.ido > '2014-01-01'

--Mosógépes példa  megszámolással
SELECT COUNT(t.nev)
FROM termek AS t
LEFT JOIN eladasok AS e ON t.id = e.termek_id
WHERE e.ido > '2014-01-01'

-- Nézet tábla létrehozása két tábla összekapcsolásával (az elõzõ példából vett lekérdezés alapján)
CREATE VIEW `kepek_nezet` AS 
SELECT `k`.`file` AS `file`, `k`.`description` AS `description`, `kt`.`type` AS `type`
FROM `kepek` AS `k`
LEFT JOIN `kepek_type` AS `kt`
ON `k`.`type` = `kt`.`id`
ORDER BY `file`;

-- MySQL user létrehozása
CREATE USER 'john' IDENTIFIED BY 'jelszo';

-- MySQL user törlése
DROP USER 'john';

-- Minden jog megadása a teszt adatbázishoz
GRANT ALL ON teszt.* TO 'john';	

-- Csak SELECT jog megadása a teszt.kepek adattáblához
GRANT SELECT ON teszt.kepek TO 'john';  

-- Minden jog megvonása a teszt.kepek adattábláról
REVOKE ALL PRIVILEGES ON teszt.kepek FROM 'john';	

-- INSERT jog megvonása a teszt.kepek adattábláról
REVOKE INSERT ON teszt.kepek FROM 'john';	


-- BEÉPÍTETT MySQL FÜGGVÉNYEK
-- http://dev.mysql.com/doc/refman/5.0/en/functions.html

-- egy mezõ rekordjai hosszának lekérdezése
SELECT CHAR_LENGTH(kep) FROM `kepek`;

-- csak a 10 karakternél hosszabb képnevek jelennek meg
SELECT kep FROM `kepek` WHERE CHAR_LENGTH(kep) > 10;

-- egy mezõ rekordjait nagybetûsen listázza
SELECT UPPER(kep) FROM `kepek`;

-- a mezõ rekordjainak 2 és 6 karakterek közti részét listázza
SELECT SUBSTRING(file, 2, 6) FROM `kepek`;

-- a mezõ rekordjait hatványra emeljük (itt épp négyzetre)
SELECT POW(id, 2) FROM `kepek`;

-- csak azt a rekordot listázzuk melynek sorszámának négyzete egyenlõ 16-al (tehát 4)
SELECT file FROM `kepek` WHERE POW(id,2)=16;

-- csak azt a rekordot listázzuk melynek elsõ betûje "p"
SELECT file FROM `kepek` WHERE SUBSTRING(file, 1, 1) = 'p';