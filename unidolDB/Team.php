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
		$data_areas = $data['data_areas'];			//エリアのリスト
		$data_teams = $data['data_teams'];			//エリアごとのチームリスト
		$data_team_info = $data['data_team_info'];	//チーム情報（テーブル）
		$value_team_info = $data_team_info[0];		//チーム情報（1列）
		$data_members = $data['data_members'];		//メンバーのリスト
		$data_graduates = $data['data_graduates'];		//卒業メンバーのリスト
		$data_compe_songs = $data['data_compe_songs'];		//大会曲のリスト
	}
	Html_Temprate::HtmlStart();
	Html_Temprate::Head($value_team_info['TEAM_NAME']);
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();

	//タイトル（ドロップダウンを右に表示するためBodyHeader()を使わない）
	echo '<h3>' . $value_team_info['TEAM_NAME'];
	// チームを変更するためのドロップダウンリスト作成
	echo '<div class="btn-group">
			<button
				type="button" id="dropdown1"
				class="btn btn-secondary dropdown-toggle"
				data-toggle="dropdown"
				aria-haspopup="true"
				aria-expanded="false">チーム選択</button>';
	if(isset($data_areas) && count($data_areas) > 0){
		echo '<div class="dropdown-menu" aria-labelledby="dropdown1">';
		foreach ($data_areas as $area){
			echo '<h6 class=".dropdown-header">'.$area['AREA_NAME'] .'</h6>';		//ドロップダウンヘッダ
			$data_area_teams = $data_teams[$area['AREA_NO']];						//対象エリアのチームリスト取得
			//エリアごとにループしてチームリストを作成
			foreach ($data_area_teams as $data_team){
				echo '<a class="dropdown-item '
					. (($data_team['TEAM_CODE'] == $_GET['ID']) ? 'active' : '') . '" '	//表示中のチームのみactiveをつける
					. 'href="' . __CLASS__ . '?ID=' .$data_team['TEAM_CODE'] . '">'		//リンク部
					. $data_team['TEAM_NAME']											//ラベル部
					. '</a>';
			}
		}
		echo '</div>';
	}
	echo '</div></h3><hr>';

	// チーム情報
	echo '<h5>基本情報</h5>';
	echo '<hr>';
	echo '<ul>';
	echo '	<li>大学：' . $value_team_info['UNIVERSITY'] . '</li>';
	echo '</ul>';

	// メンバーリスト
	if(isset($data_members) && count($data_members) > 0){
		echo '<h5>メンバー</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>メンバー名</th><th>期</th><th>学年</th></tr>
				</thead>
				<tbody>';
		foreach ($data_members as $value_member) {
			echo '<tr>';
			echo '	<td>' . $value_member['MEMBER_NAME'] . '</td>';
			echo '	<td>' . rtrim( rtrim($value_member['GENERATION'], '0'), '.') . '</td>';
			echo '	<td>' . $value_member['GRADE'] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>
			</table>';
	}

	// 卒業生リスト
	if(isset($data_graduates) && count($data_graduates) > 0){
		echo '<h5>卒業メンバー</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>メンバー名</th><th>期</th><th>卒業年</th></tr>
				</thead>
				<tbody>';
		foreach ($data_graduates as $value_graduate) {
			echo '<tr>';
			echo '	<td>' . $value_graduate['MEMBER_NAME'] . '</td>';
			echo '	<td>' . rtrim( rtrim($value_graduate['GENERATION'], '0'), '.') . '</td>';
			echo '	<td>' . $value_graduate['GRADUATE_YEAR'] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>
			</table>';
	}

	// 大会曲リスト
	if(isset($data_compe_songs) && count($data_compe_songs) > 0){
		echo '<h5>大会曲</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>大会</th><th>曲順</th><th>曲</th></tr>
				</thead>
				<tbody>';
		foreach ($data_compe_songs as $value_compe_song) {
			echo '<tr>';
			echo '	<td>' . $value_compe_song['COMPE_NAME'] . '</td>';
			echo '	<td>' . $value_compe_song['SONG_ORDER'] . '</td>';
			echo '	<td>' . $value_compe_song['SONG'] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>
			</table>';
	}

	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
