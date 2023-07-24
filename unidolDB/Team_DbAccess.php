<?php
namespace unidolDB;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});


class Team_DbAccess extends DbAccess{
	public function get_query_answer($dbh){
		/**********************/
		/* エリアリスト取得   */
		/**********************/

		// エリア取得クエリ生成
		$sql_areas = "SELECT * FROM area";
		// クエリ実行
		$data_areas = self::get_as_array($dbh, $sql_areas, array());
		// 特殊文字をHTMLエンティティに変換
		$data_areas = Functions::entity_assoc_array($data_areas);

		/**********************/
		/* チームリスト取得   */
		/**********************/
		// チーム取得（エリアごと）クエリ生成
		$sql_teams = "SELECT T.TEAM_ID
					,T.TEAM_CODE
					,T.TEAM_NAME
				FROM team AS T
				WHERE LEFT(T.TEAM_ID,1) = ?
				ORDER BY T.TEAM_NAME_KANA";

		//データ格納用
		$data_teams = array();

		foreach ($data_areas as $value_area){
			// SQLパラメータを配列としてセット
			$area_no = $value_area['AREA_NO'];
			// クエリ実行
			$data_team = self::get_as_array($dbh, $sql_teams, array($area_no));
			// 特殊文字をHTMLエンティティに変換
			$data_team = Functions::entity_assoc_array($data_team);
			//エリア番号とともに配列に入れる
			$data_teams[$area_no] = $data_team;
		}

		/*************************************/
		/* SQLパラメータを配列としてセット   */
		/*************************************/
		$param = array($_GET['ID']); //チームコードをパラメータにセット

		/************************/
		/* チーム基本情報取得   */
		/************************/
		// SQL生成
		$sql_team_info = 'SELECT T.TEAM_NAME
					,T.UNIVERSITY
				FROM team AS T
				WHERE T.TEAM_CODE = ?';

		// クエリ実行
		$data_team_info = self::get_as_array($dbh, $sql_team_info, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_team_info = Functions::entity_assoc_array($data_team_info);

		/************************/
		/* メンバーリスト取得   */
		/************************/
		// SQL生成
		$sql_members = "SELECT M.MEMBER_NAME
					,M.GENERATION
					,YEAR(CURRENT_DATE) - M.ENTER_YEAR - M.GAP + (CASE WHEN MONTH(CURRENT_DATE) >= 4 THEN 1 ELSE 0 END) AS GRADE
				FROM member AS M
				INNER JOIN team AS T
				ON M.TEAM_ID = T.TEAM_ID
				WHERE T.TEAM_CODE = ?
				AND M.GRADUATE_FLG = '0'";

		// クエリ実行
		$data_members = self::get_as_array($dbh, $sql_members, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_members = Functions::entity_assoc_array($data_members);

		/************************/
		/* 卒業メンバーリスト取得   */
		/************************/
		// SQL生成
		$sql_graduates = "SELECT M.MEMBER_NAME
					,M.GENERATION
					,M.GRADUATE_YEAR
				FROM member AS M
				INNER JOIN team AS T
				ON M.TEAM_ID = T.TEAM_ID
				WHERE T.TEAM_CODE = ?
				AND M.GRADUATE_FLG = '1'";

		// クエリ実行
		$data_graduates = self::get_as_array($dbh, $sql_graduates, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_graduates = Functions::entity_assoc_array($data_graduates);

		/************************/
		/* 大会楽曲リスト取得   */
		/************************/
		// SQL生成
		$sql_compe_songs = "SELECT CONCAT(CG.COMPE_GROUP_SHORT_NAME,' ',C.COMPE_SUB_NAME) AS COMPE_NAME
					,CS.SONG_ORDER
					,CONCAT(S.SONG_NAME,' / ',IFNULL(S.REMARK,A.ARTIST_NAME)) AS SONG
				FROM compe_song AS CS
				INNER JOIN compe AS C
				ON CS.COMPE_ID = C.COMPE_ID
				INNER JOIN compe_group AS CG
				ON C.COMPE_GROUP_ID = CG.COMPE_GROUP_ID
				INNER JOIN team AS T
				ON CS.TEAM_ID = T.TEAM_ID
				INNER JOIN song AS S
				ON CS.SONG_ID = S.SONG_ID
				INNER JOIN artist AS A
				ON S.ARTIST_ID = A.ARTIST_ID
				WHERE T.TEAM_CODE = ?";

		// クエリ実行
		$data_compe_songs = self::get_as_array($dbh, $sql_compe_songs, $param);
		// 特殊文字をHTMLエンティティに変換
		$data_compe_songs = Functions::entity_assoc_array($data_compe_songs);

		/**********************************/
		/* 各データを1配列にまとめて返す  */
		/**********************************/
		$data = array(
			"data_areas" => $data_areas,
			"data_teams" => $data_teams,
			"data_team_info" => $data_team_info,
			"data_members" => $data_members,
			"data_graduates" => $data_graduates,
			"data_compe_songs" => $data_compe_songs,
		);

		// 取得したデータの配列を返す
		return $data;
	}
}