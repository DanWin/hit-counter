<?php
/*
* Hit Counter - English translation
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

$I=[
	'titlereg' => 'Hit Counter',
	'descriptionreg' => 'Here you can register your own hit counter.',
	'preload' => 'Preload with this many hits: %s (Useful when moving from another service <small>or faking</small>)',
	'register' => 'Register',
	'regsuccess' => 'You have successfully registered a new hit counter. Your api_key is: %s',
	'embedinstruct' => 'To embed your counter, you can add the following code to your website:',
	'modifyinstruct' => 'To modify the counter to your needs, you can change the following parameters:',
	'modid' => 'id - Your unique api key',
	'modbg' => 'bg - Hexadecimal colour code for the background colour (Default: 000000)',
	'modfg' => 'fg - Hexadecimal colour code for the forground colour (Default: FFFFFF)',
	'modtr' => 'tr - Transparent: 1 or 0 (Default: 0)',
	'modunique' => 'unique - Show unique (1) or all (0) visits (Default: 0):',
	'modmode' => 'mode - Display mode (Default: 0):',
	'modmode0' => '0 for overall stats',
	'modmode1' => '1 for last hour',
	'modmode2' => '2 for last 24 hours',
	'modmode3' => '3 for last week',
	'modmode4' => '4 and anything else for last month',
	'titlestat' => 'Visitor statistics',
	'descriptionstat' => 'Statistics are generated via a counter image. It does not include every single request to the server, only those on the main pages. Unique visitors get counted by setting a cookie to see who we already counted. Treat unique hits as tainted, because not everyone has cookies enabled and if it\'s the hit counter of another site, many have 3rd party cookies blocked.',
	'fallback' => 'Invalid id, showing statistics of this page instead.',
	'when' => 'When',
	'count' => 'Count',
	'unique' => 'Unique',
	'lasthour' => 'Last hour',
	'lastday' => 'Last 24 hours',
	'lastweek' => 'Last 7 days',
	'lastmonth' => 'Last 30 days',
	'overall' => 'Overall',
	'graphs' => 'Graphs: <small>(<span style="color:#FF0000;">visit count</span>, <span style="color:#0000FF;">unique</span>)</small>',
	'language' => 'Language',
	'pdo_mysqlextrequired' => 'The pdo_mysql extension of PHP is required. Please install it first.',
	'pcreextrequired' => 'The pcre extension of PHP is required. Please install it first.',
	'dateextrequired' => 'The date extension of PHP is required. Please install it first.',
	'succdbcreate' => 'The database has successfully been created!',
	'statusok' => 'Status: OK',
	'nodb' => 'No database connection!',
];
?>
