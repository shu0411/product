<?php
use unidolDB\Html_Temprate;
use unidolDB\Control_Select;
spl_autoload_register(function ($class) {
	$parts = explode('\\', $class);
	$class = end($parts);
	include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

	//データ取得
	$data = Control_Select::getdata(__FILE__, true);

	if(isset($data)){
		$data_compe_info = $data['data_compe_info'];	//大会情報
		$value_compe_info = $data_compe_info[0];		//大会情報（1列）
		$data_dates = $data['data_dates'];				//大会日程リスト
		$data_rank = $data['data_rank'];				//大会日程リスト
		$data_songs = $data['data_songs'];				//披露曲リスト
		$data_ranking_song = $data['data_ranking_song'];	//使用回数ランキング
	}
	Html_Temprate::HtmlStart();
	Html_Temprate::Head($value_compe_info['COMPE_NAME']);
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();

	//タイトル（ドロップダウンを右に表示するためBodyHeader()を使わない）
	echo '<h3>' . $value_compe_info['COMPE_NAME'];
	// チームを変更するためのドロップダウンリスト作成
	echo '<div class="btn-group">
			<button
				type="button" id="dropdown1"
				class="btn btn-secondary dropdown-toggle"
				data-toggle="dropdown"
				aria-haspopup="true"
				aria-expanded="false">日程選択</button>';
	if(isset($data_dates) && count($data_dates) > 0){
		echo '<div class="dropdown-menu" aria-labelledby="dropdown1">';
		//ループして大会日程リストを作成
		foreach ($data_dates as $value_date){
			echo '<a class="dropdown-item '
				. (($value_date['COMPE_ID'] == $_GET['ID']) ? 'active' : '') . '" '	//表示中の大会のみactiveをつける
				. 'href="' . __CLASS__ . '?ID=' .$value_date['COMPE_ID'] . '">'		//リンク部
				. $value_date['COMPE_SUB_NAME']										//ラベル部
				. '</a>';
		}
		echo '</div>';
	}
	echo '</div></h3><hr>';

	// 入賞
	if(isset($data_rank) && count($data_rank) > 0){
		echo '<h5>入賞チーム</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>総合順位</th><th>チーム名</th><th>審査員順位</th><th>観客票順位</th><th>総合得点</th></tr>
				</thead>
				<tbody>';
		foreach ($data_rank as $value_rank) {
			echo '<tr>';
			echo '	<td>' . $value_rank['TOTAL_RANK'] . '</td>';
			echo '	<td>' . $value_rank['TEAM_NAME'] . '</td>';
			echo '	<td>' . $value_rank['JUDGE_RANK'] . '</td>';
			echo '	<td>' . $value_rank['AUDIENCE_RANK'] . '</td>';
			echo '	<td>' . $value_rank['TOTAL_POINT'] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>
			</table>';
	}
	// 披露曲リスト
	if(isset($data_songs) && count($data_songs) > 0){
		echo '<h5>披露曲</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>出場順</th><th>チーム名</th><th>曲順</th><th>曲</th></tr>
				</thead>
				<tbody>';
		$prev_team_id = ''; //同チーム判定に使用
		foreach ($data_songs as $value_song) {
			echo '<tr>';
			if($prev_team_id != $value_song['TEAM_ID']){
				echo '<td>' . $value_song['COMPE_ORDER'] . '</td>';
				echo '<td>' . $value_song['TEAM_NAME'] . '</td>';
			} else {
				echo '<td></td><td></td>'; //前行と同じチームの場合、出場順とチームは空白表示
			}
			echo '	<td>' . $value_song['SONG_ORDER'] . '</td>';
			echo '	<td>' . $value_song['SONG'] . '</td>';
			echo '</tr>';
			$prev_team_id = $value_song['TEAM_ID'];
		}
		echo '</tbody>
			</table>';
	}

	// 使用回数ランキング
	if(isset($data_ranking_song) && count($data_ranking_song) > 0){
		echo '<h5>アイドル別使用回数ランキング</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>順位</th><th>グループ名</th><th>使用回数</th></tr>
				</thead>
				<tbody>';
		$line_id = 1;
		foreach ($data_ranking_song as $value_ranking_song) {
			echo '<tr>';
			echo '	<td>' . $line_id . '</td>';
			echo '	<td>' . $value_ranking_song['ARTIST_NAME'] . '</td>';
			echo '	<td>' . $value_ranking_song['COUNT'] . '</td>';
			echo '</tr>';
			$line_id += 1;
		}
		echo '</tbody>
			</table>';
	}

	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
