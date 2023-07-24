<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Control_Select{
	/**
	 *
	 * @param string $file_name 呼び出し元のファイル名（DbAccessクラスのクラス名生成に使用）
	 * @param boolean $converted 複数クエリを発行する際はtrue（DbAccessクラス内でHTML変換を行う）
	 */
	function getData($file_name, $converted = false){
		//DbAccessのクラス名を作成
		//$file_parts = explode('\\', $file_name);
		//$page_name = str_replace('.php','',end($file_parts));
		$page_name = basename( $file_name, ".php" );
		$DbAccessClassName = __NAMESPACE__ . '\\' . $page_name . '_DbAccess';

		// DB接続
		$dbh = Common_DbAccess::get_db_connection();

		// クエリの実行結果を取得
		$data = $DbAccessClassName::get_query_answer($dbh);

		// DB切断
		Common_DbAccess::close_db_connection($dbh);

		// 特殊文字をHTMLエンティティに変換
		if(!$converted){
			$data = Functions::entity_assoc_array($data);
		}

		return $data;
	}

}