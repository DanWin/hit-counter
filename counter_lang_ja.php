<?php
/*
* Hit Counter - Japanese translation
*
* Copyright (C) 2017 Anonymous <noreply@google.com>
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
$T=[
	'titlereg' => 'ヒットカウンター',
	'descriptionreg' => 'ここであなたのヒットカウンターを作成しましょう。',
	'preload' => 'このヒット数を追加しておく: %s (他サービスからの移動の際に便利です。 <small>あるいは偽装目的</small>)',
	'register' => '登録',
	'regsuccess' => '新しいカウンターを登録しました。　あなたのapi_key: %s',
	'embedinstruct' => 'あなたのWebサイトに以下のコードを追加することで、カウンターを設置できます:',
	'modifyinstruct' => 'カウンターをお好みに変更したいなら、以下の値を変更してください:',
	'modid' => 'id - あなたのAPI Key',
	'modbg' => 'bg - バックグラウンドのHexカラーコード (初期値: 000000)',
	'modfg' => 'fg - 最前面のHexカラーコード (初期値: FFFFFF)',
	'modtr' => 'tr - 透過率: 1 or 0 (初期値: 0)',
	'modunique' => 'unique - ユニークを表示する(1) あるいは すべての訪問を表示する(0) (初期値: 0):',
	'modmode' => 'mode - 表示モード (初期値: 0):',
	'modmode0' => '0 - 全体の統計',
	'modmode1' => '1 - 過去１時間',
	'modmode2' => '2 - 過去１日',
	'modmode3' => '3 - 過去一週間',
	'modmode4' => '4 - 過去一ヶ月',
	'titlestat' => '訪問者の統計',
	'descriptionstat' => '統計はカウンターの画像により作成されます。 すべてのリクエストを数えるのではなく、メインページのみカウントされます。 ユニーク数の計測には、Cookieを使うことで重複を数えないようにしています。 ユニーク数はあくまでも参考です。 全員がCookieを許可しているわけでもなく、多くの方はサードパーティのCookieを拒否しているからです。',
	'fallback' => 'IDが不正です。代わりとして、このページの統計を表示します。',
	'when' => 'いつ',
	'count' => 'カウント',
	'unique' => 'ユニーク',
	'lasthour' => '過去一時間',
	'lastday' => '過去一日',
	'lastweek' => '過去一週間',
	'lastmonth' => '過去一ヶ月',
	'overall' => '総合',
	'graphs' => 'グラフ: <small>(<span style="color:#FF0000;">訪問者数</span>, <span style="color:#0000FF;">ユニーク</span>)</small>',
	'language' => '言語',
	'pdo_mysqlextrequired' => 'PHPのpdo_mysqlが必要です。先にインストールしてください。',
	'pcreextrequired' => 'PHPのpcre拡張機能が必要です。先にインストールしてください。',
	'dateextrequired' => 'PHPのdate拡張機能が必要です。先にインストールしてください。',
	'succdbcreate' => 'データベースの作成に成功。',
	'statusok' => '状態: OK',
	'nodb' => 'データベースへの接続がありません！',
];
?>
