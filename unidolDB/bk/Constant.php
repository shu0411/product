<?php
class Constant{
	function __construct(){
		define('DSN' ,        'mysql:host=localhost;dbname=unidol;charset=utf8;'); //データソース名
		define('DB_USER',     'Admin');  // MySQLのユーザ名
		define('DB_PASSWORD', 'Admin');    // MySQLのパスワード
		//define('DB_HOST',   'localhost'); // データベースのホスト名又はIPアドレス
		//define('DB_NAME',   'unidol');    // データベース名
		//define('DB_CHARACTER_SET',   'UTF8');   // DB文字エンコーディング

		define('HTML_CHARACTER_SET', 'UTF-8');  // HTML文字エンコーディング
	}
}