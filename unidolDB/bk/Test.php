<?php
use unidolDB\Html_Temprate;
use unidolDB\Control_Select;

spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

	$data = Control_Select::getdata('Test');
	Html_Temprate::HtmlStart();
	Html_Temprate::Head();
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader('Prismile');
?>

	<table class="table">
		<thead>
			<tr><th>メンバー名</th><th>期</th></tr>
		</thead>
		<tbody>
		<?php foreach ($data as $value) { ?>
			<tr>
				<td><?php print $value['MEMBER_NAME']; ?></td>
				<td><?php print $value['GENERATION']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

<?php
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
?>

