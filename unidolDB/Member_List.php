<?php
	namespace unidolDB;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});


	//データ取得
	if(isset($_POST['form1'])){
		$data = Control_Select::getdata('Team_List');
	}

	Html_Temprate::HtmlStart();
	Html_Temprate::Head('メンバー一覧');
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();
?>

<form action="Member_List.php" method="post">
	<div class="form-group row">
		<div class="col-auto">
			<label class="col-form-label" for="form1">メンバー名：</label>
		</div>
		<div class="col-auto">
			<input class="form-control" type="text" name="form1"
			<?php
				if(isset($_POST['form1'])){
					echo 'value=' . $_POST['form1'];
				}
			?>
			>
		</div>
	</div>
	<button class="btn btn-primary" type="submit">検索</button>
</form>

<?php
	if(isset($data)){
?>
		<div class="container">
			<ul>
			<?php foreach ($data as $value) { ?>
				<li><a href="team.php?ID=<?php echo $value['MEMBER_ID']; ?>"><?php echo $value['MEMBER_NAME']; ?></a></li>
			<?php } ?>
			</ul>
		</div>

<?php
	}
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
?>

