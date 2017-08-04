<?php
/*
* Hit Counter - Configuration
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

// Configuration
const DBHOST='localhost'; // Database host
const DBUSER='www-data'; // Database user
const DBPASS='YOUR_PASS'; // Database password
const DBNAME='counter'; // Database
const PREFIX=''; // Table Prefix - useful if other programs use the same names for tables - use only alpha-numeric values (A-Z, a-z, 0-9, or _)
const PERSISTENT=true; // Use persistent database conection true/false
const LANG='en'; // Default language
const BASEURL='http://tt3j2x4k5ycaa5zt.onion/'; // URL where the scripts are (e.g. http://example.com/path/)
const VERSION='1.0'; // Script version
const DBVERSION=1; // Database layout version

// Language selection
$L=[
	'de' => 'Deutsch',
	'en' => 'English',
	'ja' => '日本語',
];
if(isSet($_REQUEST['lang']) && isSet($L[$_REQUEST['lang']])){
	$language=$_REQUEST['lang'];
	if(!isSet($_COOKIE['language']) || $_COOKIE['language']!==$language){
		setcookie('language', $language);
	}
}elseif(isSet($_COOKIE['language']) && isSet($L[$_COOKIE['language']])){
	$language=$_COOKIE['language'];
}else{
	$language=LANG;
}
include_once('counter_lang_en.php'); //always include English
if($language!=='en'){
	$T=[];
	include_once("counter_lang_$language.php"); //replace with translation if available
	foreach($T as $name=>$translation){
		$I[$name]=$translation;
	}
}

function print_langs(){
	global $I, $L;
	echo "<small>$I[language]: ";
	$query=preg_replace('/(&?lang=[a-z_\-]*)/i', '', $_SERVER['QUERY_STRING']);
	foreach($L as $code=>$name){
		if($query===''){
			$uri="?lang=$code";
		}else{
			$uri='?'.htmlspecialchars($query)."&amp;lang=$code";
		}
		echo " <a href=\"$uri\">$name</a>";
	}
	echo '</small>';
}
?>
