<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Team_List_DbAccess extends DbAccess{
	public function get_query_answer($dbh){
		// SQL生成
		$sql = 'SELECT T.TEAM_ID
					,T.TEAM_CODE
					,T.TEAM_NAME
					,LEFT(T.TEAM_ID,1) AS AREA_NO
				FROM team AS T
				ORDER BY T.TEAM_NAME_KANA';

		$param = array();

		// クエリ実行
		return self::get_as_array($dbh, $sql,$param);
	}
}