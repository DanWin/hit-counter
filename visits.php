<?php
/*
* Hit Counter - Visitor statistics
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
try{
	$db=new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_PERSISTENT=>PERSISTENT]);
}catch(PDOException $e){
	exit($I['nodb']);
}
$fallback=false;
if(isset($_REQUEST['id'])){
	$stmt=$db->prepare('SELECT * FROM ' . PREFIX . 'registered WHERE api_key=?;');
	$stmt->execute([$_REQUEST['id']]);
	if($id=$stmt->fetch(PDO::FETCH_NUM)){
		$id=$id[0];
	}else{
		$fallback=true;
		$id=1;
	}
}else{
	$fallback=true;
	$id=1;
}
$stmt=$db->prepare('SELECT SUM(count) FROM ' . PREFIX . 'visitors WHERE id=? AND time>=? AND time<?;');
$stmt2=$db->prepare('SELECT SUM(unique_count) FROM ' . PREFIX . 'visitors WHERE id=? AND time>=? AND time<?;');
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html><head>';
echo "<title>$I[titlestat]</title>";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<meta name=viewport content="width=device-width, initial-scale=1">';
echo '</head><body>';
echo "<h2>$I[titlestat]</h2>";
$time=time();
$update_time=$time-$time%3600;
print_langs();
echo "<p>$I[descriptionstat]</p>";
if($fallback){
	echo "<p style=\"color:red;\">$I[fallback]</p>";
}
echo '<table>';
echo "<tr><th>$I[when]</th><th>$I[count]</th><th>$I[unique]</th></tr>";
echo "<tr><td>$I[lasthour]</td>";
$num=fetch_numbers($id, $update_time-3600, $update_time);
echo "<td>$num[0]</td><td>$num[1]</td></tr>";
echo "<tr><td>$I[lastday]</td>";
$num=fetch_numbers($id, $update_time-86400, $update_time);
echo "<td>$num[0]</td><td>$num[1]</td></tr>";
echo "<tr><td>$I[lastweek]</td>";
$num=fetch_numbers($id, $update_time-604800, $update_time);
echo "<td>$num[0]</td><td>$num[1]</td></tr>";
echo "<tr><td>$I[lastmonth]</td>";
$num=fetch_numbers($id, $update_time-2592000, $update_time);
echo "<td>$num[0]</td><td>$num[1]</td></tr>";
echo "<tr><td>$I[overall]</td>";
$num=fetch_numbers($id, 0, $time);
echo "<td>$num[0]</td><td>$num[1]</td></tr>";
echo '</table>';
echo "<br><p>$I[graphs]</small></p>";
echo "<p>$I[lastday]</p>";
$visits=[];
$unvisits=[];
$highest=1;
for($i=24; $i>0; --$i){
	$stmt->execute([$id, $time-3600*($i+1), $time-3600*$i]);
	$tmp=$stmt->fetch(PDO::FETCH_NUM);
	$stmt2->execute([$id, $time-3600*($i+1), $time-3600*$i]);
	$tmp2=$stmt2->fetch(PDO::FETCH_NUM);
	$visits[]=$tmp[0];
	$unvisits[]=$tmp2[0];
	if($highest<$tmp[0]){
		$highest=$tmp[0];
	}
}
$im=imagecreate(230, 100);
$bg=imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, $bg);
$color=imagecolorallocate($im, 255, 0, 0);
$uncolor=imagecolorallocate($im, 0, 0, 255);
for($i=0; $i<23; ++$i){
	imageline($im, $i*10, 100-($visits[$i]/$highest)*100, ($i+1)*10, 100-($visits[$i+1]/$highest)*100, $color);
	imageline($im, $i*10, 100-($unvisits[$i]/$highest)*100, ($i+1)*10, 100-($unvisits[$i+1]/$highest)*100, $uncolor);
}
echo '<img width="230" height="100" src="data:image/gif;base64,';
ob_start();
imagegif($im);
imagedestroy($im);
echo base64_encode(ob_get_clean()).'">';

echo "<br><p>$I[lastweek]</p>";
$visits=[];
$unvisits=[];
$highest=1;
for($i=28; $i>0; --$i){
	$stmt->execute([$id, $time-21600*($i+1), $time-21600*$i]);
	$tmp=$stmt->fetch(PDO::FETCH_NUM);
	$stmt2->execute([$id, $time-21600*($i+1), $time-21600*$i]);
	$tmp2=$stmt2->fetch(PDO::FETCH_NUM);
	$visits[]=$tmp[0];
	$unvisits[]=$tmp2[0];
	if($highest<$tmp[0]){
		$highest=$tmp[0];
	}
}
$im=imagecreate(270, 100);
$bg=imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, $bg);
$color=imagecolorallocate($im, 255, 0, 0);
$uncolor=imagecolorallocate($im, 0, 0, 255);
for($i=0; $i<27; ++$i){
	imageline($im, $i*10, 100-($visits[$i]/$highest)*100, ($i+1)*10, 100-($visits[$i+1]/$highest)*100, $color);
	imageline($im, $i*10, 100-($unvisits[$i]/$highest)*100, ($i+1)*10, 100-($unvisits[$i+1]/$highest)*100, $uncolor);
}
echo '<img width="270" height="100" src="data:image/gif;base64,';
ob_start();
imagegif($im);
imagedestroy($im);
echo base64_encode(ob_get_clean()).'">';

echo "<br><p>$I[lastmonth]</p>";
$visits=[];
$unvisits=[];
$highest=1;
for($i=30; $i>0; --$i){
	$stmt->execute([$id, $time-86400*($i+1), $time-86400*$i]);
	$tmp=$stmt->fetch(PDO::FETCH_NUM);
	$stmt2->execute([$id, $time-86400*($i+1), $time-86400*$i]);
	$tmp2=$stmt2->fetch(PDO::FETCH_NUM);
	$visits[]=$tmp[0];
	$unvisits[]=$tmp2[0];
	if($highest<$tmp[0]){
		$highest=$tmp[0];
	}
}
$im=imagecreate(290, 100);
$bg=imagecolorallocate($im, 0, 0, 0);
imagefill($im, 0, 0, $bg);
$color=imagecolorallocate($im, 255, 0, 0);
$uncolor=imagecolorallocate($im, 0, 0, 255);
for($i=0; $i<29; ++$i){
	imageline($im, $i*10, 100-($visits[$i]/$highest)*100, ($i+1)*10, 100-($visits[$i+1]/$highest)*100, $color);
	imageline($im, $i*10, 100-($unvisits[$i]/$highest)*100, ($i+1)*10, 100-($unvisits[$i+1]/$highest)*100, $uncolor);
}
echo '<img width="290" height="100" src="data:image/gif;base64,';
ob_start();
imagegif($im);
imagedestroy($im);
echo base64_encode(ob_get_clean()).'">';
echo '<br><p style="text-align:center;font-size:small;"><a target="_blank" href="https://github.com/DanWin/hit-counter">Hit Counter - ' . VERSION . '</a></p>';
echo '</body></html>';

function fetch_numbers($id, $start, $end){
	global $stmt, $stmt2, $num, $num2;
	$stmt->execute([$id, $start, $end]);
	$num=$stmt->fetch(PDO::FETCH_NUM);
	$stmt2->execute([$id, $start, $end]);
	$num2=$stmt2->fetch(PDO::FETCH_NUM);
	if(!$num[0]){
		$num[0]=0;
	}
	if(!$num2[0]){
		$num2[0]=0;
	}
	return [number_format($num[0]), number_format($num2[0])];
}
?>
