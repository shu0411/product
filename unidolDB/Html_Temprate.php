<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

class Html_Temprate{
	function HtmlStart(){
		echo '
			<!DOCTYPE html>
			<html lang="ja">';
	}

	function HtmlEnd(){
		echo '</html>';
	}

	function Head($title = ''){
		echo '
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">';
		if($title == ''){
			echo '<title>UNIDOL データベース</title>';
		} else{
			echo '<title>'. $title .' - UNIDOL データベース</title>';
		}
		echo '	<!-- BootstrapのCSS読み込み -->
				<link href="css/bootstrap.min.css" rel="stylesheet">
				<!-- 追加CSS読み込み -->
				<link href="css/unidoldb.css" rel="stylesheet">
				<!-- jQuery読み込み -->
				<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
				<!-- Popper読み込み -->
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
				<!-- BootstrapのJS読み込み -->
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

			</head>';
	}

	function BodyStart(){
		echo '<body>';
	}

	function BodyHeader($title = ''){
		echo '<h1><a class="text-body" href="/index.php">UNIDOL データベース</a></h1>';
		echo '<p>Date : ' . date("Y/m/d") . '</p>';
		echo '<hr>';
		echo '<div class="container-fluid">';
		echo '	<div class="row">';
		echo '		<div class="col-12 col-md-3 col-xl-2 bd-sidebar">';
		echo '			<div class="card">';
		echo '				<div class="card-header" role="tab" id="MenuTitle">';
		echo '					<h4><a href="#card_body" class="collapsed text-body d-block p-3 m-n3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="card_body">';
		echo '						メニュー</a></h4></div>';
		echo '				<div class="collapse" role="tabpanel" id="card_body" aria-labelledby="MenuTitle" aria-expanded="false">';
		echo '					<ul class="list-group list-group-flush">';
		echo '						<li class="list-group-item"><a class="text-body" href="Team_List.php">チーム一覧</a></li>';
		echo '						<li class="list-group-item"><a class="text-body" href="Compe_List.php">大会一覧</a></li>';
		echo '					</ul>';
		echo '				</div>';
		echo '			</div>';
		echo '		</div>';
		echo '		<div class="col-md-9 col-xl-10">';
		if($title != ''){
			echo '<h3>' . $title . '</h3>';
			echo '<hr>';
		}
	}

	function SectionTitle($title){

	}

	function BodyEnd(){
		echo '	</div>';
		echo '	</div>';
		echo '	</div>';
		echo '</body>';
	}

	function MakeLinkList($link_page,$data,$id_column,$text_column){
		echo '<ul>';
		foreach ($data as $value) {
			if(array_key_exists('ENABLE_FLG', $value)){
				if($value['ENABLE_FLG'] == '1'){
					echo '<li><a href="'. $link_page .'.php?ID=' . $value[$id_column] . '">' . $value[$text_column] . '</a></li>';
				}else{
					echo '<li>' . $value[$text_column] . '</li>';
				}
			}else{
				echo '<li><a href="'. $link_page .'.php?ID=' . $value[$id_column] . '">' . $value[$text_column] . '</a></li>';
			}
		}
		echo '</ul>';
	}
}