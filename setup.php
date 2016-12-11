<?php
/*
* Onion Link List - Setup
*
* Copyright (C) 2016 Daniel Winzen <d@winzen4.de>
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

include('counter_config.php');
if(!extension_loaded('pdo_mysql')){
	die($I['pdo_mysqlextrequired']);
}
if(!extension_loaded('pcre')){
	die($I['pcreextrequired']);
}
if(!extension_loaded('date')){
	die($I['dateextrequired']);
}
try{
	$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
}catch(PDOException $e){
	try{
		//Attempt to create database
		$db=new PDO('mysql:host=' . DBHOST, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
		if(false!==$db->exec('CREATE DATABASE ' . DBNAME)){
			$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
		}else{
			die($I['nodb']);
		}
	}catch(PDOException $e){
		die($I['nodb']);
	}
}
if(!@$db->query('SELECT * FROM ' . PREFIX . 'settings LIMIT 1;')){
	//create tables
	$db->exec('CREATE TABLE ' . PREFIX . 'registered (id int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, api_key char(32) NOT NULL UNIQUE) DEFAULT CHARSET=latin1;');
	$db->exec('CREATE TABLE ' . PREFIX . 'visitors (id int(10) UNSIGNED NOT NULL, time int(10) UNSIGNED NOT NULL, count int(10) UNSIGNED NOT NULL, unique_count int(10) UNSIGNED NOT NULL);');
	$db->exec('ALTER TABLE ' . PREFIX . 'visitors ADD PRIMARY KEY (id,time), ADD KEY id (id), ADD KEY time (time);');
	$db->exec('CREATE TABLE ' . PREFIX . 'settings (setting varchar(50) NOT NULL PRIMARY KEY, value varchar(15000) NOT NULL);');
	$db->exec('INSERT INTO ' . PREFIX . "settings (setting, value) VALUES ('version', '1');");
	echo "$I[succdbcreate]\n";
}else{
	echo "$I[statusok]\n";
}
?>
