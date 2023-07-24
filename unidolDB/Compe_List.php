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
	Html_Temprate::Head('大会一覧');
	Html_Temprate::BodyStart();
	Html_Temprate::BodyHeader('大会一覧');

	if(isset($data) && count($data) > 0){
		Html_Temprate::MakeLinkList('Compe',$data,'COMPE_GROUP_ID','COMPE_GROUP_NAME');
		echo '<hr>';
	}
	Html_Temprate::BodyEnd();
	Html_Temprate::HtmlEnd();
