<?php
	use unidolDB\Html_Temprate;
	use unidolDB\Control_Select;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});


	//データ取得
	$data = Control_Select::getdata(__FILE__);

	Html_Temprate::HtmlStart();
	Html_Temprate::Head('チーム一覧');
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader('チーム一覧<span class="h6">（50音順）</span>');

	if(isset($data) && count($data) > 0){
		//エリアごとの配列を初期化
		$kanto = array();
		$kansai = array();
		$kyusyu = array();
		$tokai = array();
		$hokkaido = array();

		//エリアごとの配列にチームを振り分け
		foreach($data as $value){
			switch ($value['AREA_NO']){
				case '0':
					$kanto[] = $value;
					break;
				case '4':
					$kansai[] = $value;
					break;
				case '5':
					$kyusyu[] = $value;
					break;
				case '6':
					$tokai[] = $value;
					break;
				case '7':
					$hokkaido[] = $value;
					break;
			}
		}
?>
		<div class="row">
			<div class="col-xl-4 col-sm-6">
				<h4>関東</h4>
				<?php Html_Temprate::MakeLinkList('Team',$kanto,'TEAM_CODE','TEAM_NAME'); ?>
				<hr>
			</div>
			<div class="col-xl-8 col-sm-6">
				<div class="row">
					<div class="col-xl-6">
						<h4>関西</h4>
						<?php Html_Temprate::MakeLinkList('Team',$kansai,'TEAM_CODE','TEAM_NAME'); ?>
						<hr>
						<h4>九州</h4>
						<?php Html_Temprate::MakeLinkList('Team',$kyusyu,'TEAM_CODE','TEAM_NAME'); ?>
						<hr>
					</div>
					<div class="col-xl-6">
						<h4>東海</h4>
						<?php Html_Temprate::MakeLinkList('Team',$tokai,'TEAM_CODE','TEAM_NAME'); ?>
						<hr>
						<h4>北海道</h4>
						<?php Html_Temprate::MakeLinkList('Team',$hokkaido,'TEAM_CODE','TEAM_NAME'); ?>
						<hr>
					</div>
				</div>
			</div>
		</div>
<?php
	}
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();


?>

