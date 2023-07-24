<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
	$parts = explode('\\', $class);
	$class = end($parts);
	include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Compe_Date_DbAccess extends DbAccess{
	public function get_query_answer($dbh){

		/*************************************/
		/* SQLパラメータを配列としてセット   */
		/*************************************/
		$param = array($_GET['ID']); //大会グループIDをパラメータにセット

		/*************************************/
		/* 大会（COMPE_GROUP）基本情報取得   */
		/*************************************/
		// SQL生成
		$sql_compe_info = 'SELECT C.COMPE_NAME
								,C.COMPE_GROUP_ID
						FROM compe AS C
						WHERE C.COMPE_ID = ?';

		// クエリ実行
		$data_compe_info = self::get_as_array($dbh, $sql_compe_info, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_compe_info = Functions::entity_assoc_array($data_compe_info);

		/**********************/
		/* 大会日程リスト取得   */
		/**********************/
		// 大会日程取得クエリ生成
		$sql_dates = "SELECT C.COMPE_ID
					,C.COMPE_SUB_NAME
				FROM compe AS C
				WHERE C.COMPE_GROUP_ID = ?
				AND C.ENABLE_FLG = '1'
				ORDER BY C.COMPE_DATE ASC
						,C.COMPE_ID ASC";
		// クエリ実行
		$data_dates = self::get_as_array($dbh, $sql_dates, array($data_compe_info[0]["COMPE_GROUP_ID"]));
		// 特殊文字をHTMLエンティティに変換
		$data_dates = Functions::entity_assoc_array($data_dates);

		/*************************************/
		/* ランクインチーム取得   */
		/*************************************/
		// SQL生成
		$sql_rank = 'SELECT CT.TOTAL_RANK
								,T.TEAM_NAME
								,CT.JUDGE_RANK
								,CT.AUDIENCE_RANK
								,CT.TOTAL_POINT
						FROM compe AS C
						INNER JOIN compe_team AS CT
						ON C.COMPE_ID = CT.COMPE_ID
						INNER JOIN team AS T
						ON CT.TEAM_ID = T.TEAM_ID
						WHERE C.COMPE_ID = ?
						AND CT.TOTAL_RANK <= C.RANK_IN
						ORDER BY CT.TOTAL_RANK';

		// クエリ実行
		$data_rank = self::get_as_array($dbh, $sql_rank, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_rank = Functions::entity_assoc_array($data_rank);

		/*********************************/
		/* 披露曲リスト取得   */
		/*********************************/
		// SQL生成
		$sql_songs = "SELECT CT.COMPE_ORDER
					,CT.TEAM_ID
					,T.TEAM_NAME
					,CS.SONG_ORDER
					,CONCAT(S.SONG_NAME,' / ',IFNULL(S.REMARK,A.ARTIST_NAME)) AS SONG
				FROM compe_team AS CT
				INNER JOIN team AS T
				ON CT.TEAM_ID = T.TEAM_ID
				LEFT OUTER JOIN compe_song AS CS
				ON CT.COMPE_ID = CS.COMPE_ID
				AND CT.TEAM_ID = CS.TEAM_ID
				LEFT OUTER JOIN song AS S
				ON CS.SONG_ID = S.SONG_ID
				LEFT OUTER JOIN artist AS A
				ON S.ARTIST_ID = A.ARTIST_ID
				WHERE CT.COMPE_ID = ?
				ORDER BY CT.COMPE_ORDER ASC, CS.SONG_ORDER";

		// クエリ実行
		$data_songs = self::get_as_array($dbh, $sql_songs, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_songs = Functions::entity_assoc_array($data_songs);

		/****************************/
		/* 使用回数ランキング取得   */
		/****************************/
		// SQL生成
		$sql_ranking_song = "SELECT A.ARTIST_NAME
							,TMP.COUNT
						FROM
							(SELECT S.ARTIST_ID
								,COUNT(*) AS COUNT
							FROM compe_song CS
							INNER JOIN song  S
							ON CS.SONG_ID = S.SONG_ID
							WHERE CS.COMPE_ID = ?
							GROUP BY S.ARTIST_ID ) AS TMP
						INNER JOIN artist AS A
						ON TMP.ARTIST_ID = A.ARTIST_ID
						WHERE COUNT >= 2
						ORDER BY TMP.COUNT DESC
								,A.ARTIST_NAME_KANA ASC";

		// クエリ実行
		$data_ranking_song = self::get_as_array($dbh, $sql_ranking_song, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_ranking_song = Functions::entity_assoc_array($data_ranking_song);


		/**********************************/
		/* 各データを1配列にまとめて返す  */
		/**********************************/
		$data = array(
			"data_compe_info" => $data_compe_info,
			"data_dates" => $data_dates,
			"data_rank" => $data_rank,
			"data_songs" => $data_songs,
			"data_ranking_song" => $data_ranking_song,
		);

		// 取得したデータの配列を返す
		return $data;
	}
}