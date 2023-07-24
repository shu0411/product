<?php
use unidolDB\Html_Temprate;
spl_autoload_register(function ($class) {
	$parts = explode('\\', $class);
	$class = end($parts);
	include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

	Html_Temprate::HtmlStart();
	Html_Temprate::Head();
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();
?>

<button class="btn btn-secondary" onclick="location.href='Team_List.php'">チーム一覧</button><br><br>
<button class="btn btn-secondary" onclick="location.href='Compe_List.php'">大会一覧</button>

<?php
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
?>
