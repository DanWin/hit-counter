<?php
/*
* Hit Counter - Configuration
*
* Copyright (C) 2016-2020 Daniel Winzen <daniel@danwin1210.me>
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
$I = $T = [];
$language=LANG;
$L=[
	'de' => 'Deutsch',
	'en' => 'English',
	'ja' => '日本語',
];
if(isSet($_REQUEST['lang']) && isSet($L[$_REQUEST['lang']])){
	$language=$_REQUEST['lang'];
	if(!isSet($_COOKIE['language']) || $_COOKIE['language']!==$language){
		set_secure_cookie('language', $language);
	}
}elseif(isSet($_COOKIE['language']) && isSet($L[$_COOKIE['language']])){
	$language=$_COOKIE['language'];
}
require_once('counter_lang_en.php'); //always include English
if($language!=='en'){
	require_once("counter_lang_$language.php"); //replace with translation if available
	foreach($T as $name=>$translation){
		$I[$name]=$translation;
	}
}

function print_langs(){
	global $I, $L;
	echo "<small>$I[language]: ";
	$query=ltrim(preg_replace('/&?lang=[a-z_\-]*/i', '', $_SERVER['QUERY_STRING']), '&');
	foreach($L as $code=>$name){
		if($query===''){
			$uri="?lang=$code";
		}else{
			$uri='?'.htmlspecialchars($query)."&amp;lang=$code";
		}
		echo " <a href=\"$uri\" hreflang=\"$code\">$name</a>";
	}
	echo '</small>';
}

function send_headers(array $styles = []){
	header('Content-Type: text/html; charset=UTF-8');
	header('Pragma: no-cache');
	header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0, private');
	header('Expires: 0');
	header('Referrer-Policy: no-referrer');
	header("Permissions-Policy: accelerometer 'none'; ambient-light-sensor 'none'; autoplay 'none'; battery 'none'; camera 'none'; cross-origin-isolated 'none'; display-capture 'none'; document-domain 'none'; encrypted-media 'none'; geolocation 'none'; fullscreen 'none'; execution-while-not-rendered 'none'; execution-while-out-of-viewport 'none'; gyroscope 'none'; magnetometer 'none'; microphone 'none'; midi 'none'; navigation-override 'none'; payment 'none'; picture-in-picture 'none'; publickey-credentials-get 'none'; screen-wake-lock 'none'; sync-xhr 'none'; usb 'none'; web-share 'none'; xr-spatial-tracking 'none'; clipboard-read 'none'; clipboard-write 'none'; gamepad 'none'; speaker-selection 'none'; conversion-measurement 'none'; focus-without-user-activation 'none'; hid 'none'; idle-detection 'none'; sync-script 'none'; vertical-scroll 'none'; serial 'none'; trust-token-redemption 'none';");
	$style_hashes = '';
	foreach($styles as $style) {
		$style_hashes .= " 'sha256-".base64_encode(hash('sha256', $style, true))."'";
	}
	header("Content-Security-Policy: base-uri 'self'; default-src 'none'; form-action 'self'; frame-ancestors 'none'; img-src 'self' data:; style-src $style_hashes");
	header('X-Content-Type-Options: nosniff');
	header('X-Frame-Options: sameorigin');
	header('X-XSS-Protection: 1; mode=block');
	if($_SERVER['REQUEST_METHOD'] === 'HEAD'){
		exit; // headers sent, no further processing needed
	}
}

function set_secure_cookie(string $name, string $value){
	if (version_compare(PHP_VERSION, '7.3.0') >= 0) {
		setcookie($name, $value, ['expires' => 0, 'path' => '/', 'domain' => '', 'secure' => is_definitely_ssl(), 'httponly' => true, 'samesite' => 'Strict']);
	}else{
		setcookie($name, $value, 0, '/', '', is_definitely_ssl(), true);
	}
}

function is_definitely_ssl() : bool {
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
		return true;
	}
	if (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
		return true;
	}
	if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ('https' === $_SERVER['HTTP_X_FORWARDED_PROTO'])) {
		return true;
	}
	return false;
}
