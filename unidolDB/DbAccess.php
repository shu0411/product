<?php
namespace unidolDB;
use PDO;
spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});
/**
 * DB接続時に使用するチームごとのクラスの親クラス
 * @author shu32
 *
 */
class DbAccess{

	/**
	 * クエリを実行しその結果を配列で取得する
	 * @param PDO $dbh DBハンドル
	 * @param string $sql SQL文
	 * @param array $param パラメータの配列
	 * @return array 結果配列データ
	 */
	protected function get_as_array($dbh, $sql, $param) {
		$data = array();            // 返却用配列
		$sth = $dbh->prepare($sql); // SQLステートメントを準備
		if(isset($param)){
			$sth->execute($param);  // パラメータありでクエリを実行する
		}else{
			$sth->execute();        // パラメータなしでクエリを実行する
		}
		$data = $sth->fetchAll();   // 結果を返却用配列にセット
		return $data;
	}

	/**
	 * クエリを作成し、実行する
	 * @param PDO $dbh
	 * @return array
	 */
	public function get_query_answer($dbh){
		$sql = 'SELECT CURDATE();';     // SQL生成
		$param = null;              // SQLパラメータを配列でセット
		return self::get_as_array($dbh, $sql, $param);  // クエリ実行
	}
}