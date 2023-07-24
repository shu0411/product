<?php
namespace unidolDB;
use PDO;
use PDOException;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

/**
 * DB接続時に使用する共通クラス
 * @author shu32
 *
 */
class Common_DbAccess{
//	const DSN          = 'mysql:host=localhost;dbname=unidol;charset=utf8;'; //テスト用データソース名
    const DSN          = 'mysql:host=157.112.147.201;dbname=unidoldb_main;charset=utf8;'; //本番用データソース名
	const DB_USER      = 'unidoldb_main';  // MySQLのユーザ名
	const DB_PASSWORD  = '0216unidol';    // MySQLのパスワード

	/**
	 * DBとの接続オブジェクトを取得
	 * @return PDO
	 */
	public function get_db_connection() {
			try {
				$dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);       //定数を使ってDBとの接続オブジェクトを取得
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage(); //接続が失敗したらエラーメッセージを出力
			}

			return $dbh;
	}

	/**
	 * DBとの接続切断
	 * @param PDO $dbh 切断するPDOオブジェクト
	 */
	public function close_db_connection($dbh) {
		// 接続を閉じる
		$dbh = null;
	}
}