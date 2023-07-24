<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap Sample</title>
		<!-- BootstrapのCSS読み込み -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- jQuery読み込み -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- BootstrapのJS読み込み -->
		<script src="js/bootstrap.min.js"></script>
	<title>UNIDOL データベース</title>
</head>
<body>
<p>Date : <?php echo date("Y/m/d"); ?></p>

<div class="container">
	<table class="table">
		<thead>
			<tr><th>メンバー名</th><th>期</th></tr>
		</thead>
		<tbody>
		<?php foreach ($data as $value) { ?>
			<tr>
				<td><?php print $value['member_name']; ?></td>
				<td><?php print $value['generation']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>
