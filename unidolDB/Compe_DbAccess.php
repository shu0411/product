<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
	$parts = explode('\\', $class);
	$class = end($parts);
	include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Compe_DbAccess extends DbAccess{
	public function get_query_answer($dbh){
		/**********************/
		/* 大会リスト取得   */
		/**********************/
		// 大会取得クエリ生成
		$sql_groups = 'SELECT CG.COMPE_GROUP_ID
						,  CG.COMPE_GROUP_NAME
						,  CG.ENABLE_FLG
						FROM   compe_group AS CG
						WHERE CG.ENABLE_FLG = \'1\'
						ORDER BY CG.COMPE_GROUP_ID ASC;';
		// クエリ実行
		$data_groups = self::get_as_array($dbh, $sql_groups, array());
		// 特殊文字をHTMLエンティティに変換
		$data_groups = Functions::entity_assoc_array($data_groups);

		/*************************************/
		/* SQLパラメータを配列としてセット   */
		/*************************************/
		$param = array($_GET['ID']); //大会グループIDをパラメータにセット

		/*************************************/
		/* 大会（COMPE_GROUP）基本情報取得   */
		/*************************************/
		// SQL生成
		$sql_compe_info = 'SELECT CG.COMPE_GROUP_NAME
						FROM compe_group AS CG
						WHERE CG.COMPE_GROUP_ID = ?';

		// クエリ実行
		$data_compe_info = self::get_as_array($dbh, $sql_compe_info, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_compe_info = Functions::entity_assoc_array($data_compe_info);

		/*********************************/
		/* 大会日程（COMPE）リスト取得   */
		/*********************************/
		// SQL生成
		$sql_dates = "SELECT C.COMPE_ID
				,C.COMPE_SUB_NAME
				,L.LIVEHOUSE_NAME
				,DATE_FORMAT( C.COMPE_DATE, '%Y/%m/%d') AS COMPE_DATE
				,C.ENABLE_FLG
			FROM compe AS C
			INNER JOIN livehouse AS L
			ON C.LIVEHOUSE_ID = L.LIVEHOUSE_ID
			WHERE C.COMPE_GROUP_ID = ?
			AND C.VISIBLE_FLG = '1'
			ORDER BY C.COMPE_DATE ASC
				,C.COMPE_ID ASC";

		// クエリ実行
		$data_dates = self::get_as_array($dbh, $sql_dates, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_dates = Functions::entity_assoc_array($data_dates);

		/****************************/
		/* 使用回数ランキング取得   */
		/****************************/
		// SQL生成
		$sql_ranking1 = "SELECT A.ARTIST_NAME
							,TMP.COUNT
						FROM
							(SELECT S.ARTIST_ID
								,COUNT(*) AS COUNT
							FROM compe C
							INNER JOIN compe_song CS
							ON C.COMPE_ID = CS.COMPE_ID
							INNER JOIN song  S
							ON CS.SONG_ID = S.SONG_ID
							WHERE C.COMPE_GROUP_ID = ?
							GROUP BY S.ARTIST_ID ) AS TMP
						INNER JOIN artist AS A
						ON TMP.ARTIST_ID = A.ARTIST_ID
						WHERE COUNT >= 5
						ORDER BY COUNT DESC";

		// クエリ実行
		$data_ranking1 = self::get_as_array($dbh, $sql_ranking1, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_ranking1 = Functions::entity_assoc_array($data_ranking1);


		/**********************************/
		/* 各データを1配列にまとめて返す  */
		/**********************************/
		$data = array(
			"data_groups" => $data_groups,
			"data_compe_info" => $data_compe_info,
			"data_dates" => $data_dates,
			"data_ranking1" => $data_ranking1,
		);

		// 取得したデータの配列を返す
		return $data;
	}
}