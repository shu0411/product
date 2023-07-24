<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
	$parts = explode('\\', $class);
	$class = end($parts);
	include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

	class Compe_List_DbAccess extends DbAccess{
		public function get_query_answer($dbh){
			// SQL生成
			$sql = 'SELECT CG.COMPE_GROUP_ID
					,  CG.COMPE_GROUP_NAME
					,  CG.ENABLE_FLG
				FROM   compe_group AS CG
				WHERE CG.VISIBLE_FLG = \'1\'
				ORDER BY CG.COMPE_GROUP_ID ASC;';

			$param = array();

			// クエリ実行
			return self::get_as_array($dbh, $sql, $param);
		}
	}