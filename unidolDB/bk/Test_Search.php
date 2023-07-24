<?php
use unidolDB\Html_Temprate;

require_once "vendor/autoload.php";

	Html_Temprate::HtmlStart();
	Html_Temprate::Head();
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader();
?>

<form action="Test.php" method="post">
	<div class="form-group row">
		<div class="col-auto">
			<label class="col-form-label" for="team">チーム：</label>
		</div>
		<div class="col-auto">
			<input class="form-control" type="text" name="team" />
		</div>
	</div>
	<button class="btn btn-primary" type="submit">検索</button>
</form>

<?php
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
?>
