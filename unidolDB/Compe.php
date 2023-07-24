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
		$data_groups = $data['data_groups'];			//大会（Gruoup）リスト
		$data_compe_info = $data['data_compe_info'];	//大会情報（配列）
		$value_compe_info = $data_compe_info[0];		//大会情報（1列）
		$data_dates = $data['data_dates'];			//大会（Gruoup）リスト
		$data_ranking1 = $data['data_ranking1'];		//使用回数ランキング
	}
	Html_Temprate::HtmlStart();
	Html_Temprate::Head($value_compe_info['COMPE_GROUP_NAME']);
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();

	//タイトル（ドロップダウンを右に表示するためBodyHeader()を使わない）
	echo '<h3>' . $value_compe_info['COMPE_GROUP_NAME'];
	// チームを変更するためのドロップダウンリスト作成
	echo '<div class="btn-group">
			<button
				type="button" id="dropdown1"
				class="btn btn-secondary dropdown-toggle"
				data-toggle="dropdown"
				aria-haspopup="true"
				aria-expanded="false">大会選択</button>';
	if(isset($data_groups) && count($data_groups) > 0){
		echo '<div class="dropdown-menu" aria-labelledby="dropdown1">';
		//ループして大会グループリストを作成
		foreach ($data_groups as $value_group){
			echo '<a class="dropdown-item '
				. (($value_group['COMPE_GROUP_ID'] == $_GET['ID']) ? 'active' : '') . '" '	//表示中の大会のみactiveをつける
				. 'href="' . __CLASS__ . '?ID=' .$value_group['COMPE_GROUP_ID'] . '">'		//リンク部
				. $value_group['COMPE_GROUP_NAME']											//ラベル部
				. '</a>';
		}
		echo '</div>';
	}
	echo '</div></h3><hr>';

	// 日程リスト
	if(isset($data_dates) && count($data_dates) > 0){
		echo '<h5>大会日程</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>大会名</th><th>大会日程</th><th>会場</th></tr>
				</thead>
				<tbody>';
		foreach ($data_dates as $value_date) {
			echo '<tr>';
			if($value_date['ENABLE_FLG'] == '1'){
				echo '	<td><a href="Compe_Date.php?ID=' . $value_date['COMPE_ID'] . '">' . $value_date['COMPE_SUB_NAME'] . '</a></td>';
			}else{
				echo '<td>' . $value_date['COMPE_SUB_NAME'] . '</td>';
			}
			echo '	<td>' . $value_date['COMPE_DATE'] . '</td>';
			echo '	<td>' . $value_date['LIVEHOUSE_NAME'] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>
			</table>';
	}

	// 使用回数ランキング
	if(isset($data_ranking1) && count($data_ranking1) > 0){
		echo '<h5>アイドル別使用回数ランキング</h5>';
		echo '<hr>';
		echo '<table class="table">
				<thead>
					<tr><th>順位</th><th>グループ名</th><th>使用回数</th></tr>
				</thead>
				<tbody>';
		$line_id = 1;
		foreach ($data_ranking1 as $value_ranking1) {
			echo '<tr>';
			echo '	<td>' . $line_id . '</td>';
			echo '	<td>' . $value_ranking1['ARTIST_NAME'] . '</td>';
			echo '	<td>' . $value_ranking1['COUNT'] . '</td>';
			echo '</tr>';
			$line_id += 1;
		}
		echo '</tbody>
			</table>';
	}

	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
