<?php
namespace unidolDB;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Test_DbAccess extends DbAccess{
	public function get_query_answer($dbh){
		$param1 = $_POST['team'];
		if($param1 == ''){
			// SQL生成
			$sql = 'SELECT MEMBER_NAME,GENERATION FROM MEMBER WHERE 1=1;';
			// SQLパラメータを配列でセット
			$param = array();
		}
		else{
			// SQL生成
			$sql = 'SELECT MEMBER_NAME,GENERATION FROM MEMBER WHERE TEAM_ID = ? ;';
			// SQLパラメータを配列でセット
			$param[0] = $param1;
		}
		// クエリ実行
		return self::get_as_array($dbh, $sql, $param);
	}
}