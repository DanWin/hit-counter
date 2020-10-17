<?php
/*
* Hit Counter - Registration
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

include_once('counter_config.php');
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html><head>';
echo "<title>$I[titlereg]</title>";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<meta name=viewport content="width=device-width, initial-scale=1">';
echo '</head><body>';
echo "<h2>$I[titlereg]</h2>";
print_langs();
echo "<p>$I[descriptionreg]</p>";
echo "<form action=\"$_SERVER[SCRIPT_NAME]\" method=\"POST\">";
echo '<p>'.sprintf($I['preload'], '<input type="number" placeholder="0" name="preload">').'</p>';
echo "<input type=\"submit\" name=\"register\" value=\"$I[register]\">";
echo '</form>';
if($_SERVER['REQUEST_METHOD']==='POST'){
	try{
		$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
	}catch(PDOException $e){
		exit($I['nodb']);
	}
	$stmt=$db->prepare('SELECT * FROM ' . PREFIX . 'registered WHERE api_key=?;');
	do{
		if(function_exists('random_bytes')){
			$key=bin2hex(random_bytes(16));
		}else{
			$key=md5(uniqid('', true).mt_rand());
		}
		$stmt->execute([$key]);
	}while($stmt->fetch(PDO::FETCH_NUM));
	$stmt=$db->prepare('INSERT INTO ' . PREFIX . 'registered (api_key) VALUES (?);');
	$stmt->execute([$key]);
	if(isset($_REQUEST['preload'])){
		settype($_REQUEST['preload'], 'int');
		if($_REQUEST['preload']>0){
			$stmt=$db->prepare('INSERT INTO ' . PREFIX . 'visitors (id, time, count) VALUES ((SELECT id FROM ' . PREFIX . 'registered WHERE api_key=?), 0, ?)');
			$stmt->execute([$key, $_REQUEST['preload']]);
		}
	}
	echo '<p style="color:green;">'.sprintf($I['regsuccess'], $key).'</p>';
}else{
	$key='YOUR_API_KEY';
}
echo "<p>$I[embedinstruct]<br>";
echo '&lt;a href=&quot;' . BASEURL . "visits.php?id=$key&quot;&gt;&lt;img style=&quot;height:24px;width:auto;&quot; src=&quot;" . BASEURL . "counter.php?id=$key&amp;bg=000000&amp;fg=FFFFFF&amp;tr=0&amp;unique=0&amp;mode=0&quot;&gt;&lt;/a&gt;</p>";
echo "<p>$I[modifyinstruct]</p>";
echo '<ul>';
echo "<li>$I[modid]</li>";
echo "<li>$I[modbg]</li>";
echo "<li>$I[modfg]</li>";
echo "<li>$I[modtr]</li>";
echo "<li>$I[modunique]<ul>";
echo "<li>$I[modmode]<ul>";
echo "<li>$I[modmode0]</li>";
echo "<li>$I[modmode1]</li>";
echo "<li>$I[modmode2]</li>";
echo "<li>$I[modmode3]</li>";
echo "<li>$I[modmode4]</li>";
echo '</ul></li>';
echo '</ul>';
echo '<br><p style="text-align:center;font-size:small;"><a target="_blank" href="https://github.com/DanWin/hit-counter">Hit Counter - ' . VERSION . '</a></p>';
echo '</body></html>';
?>
