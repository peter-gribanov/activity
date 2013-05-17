<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title><?if(!empty($page_title)):?><?=$page_title?> &mdash; <?endif;?>Activity</title>
		<link rel="stylesheet" href="/main.css">
		<script type="text/javascript" src="/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/main.js"></script>
		<?if(!empty($page_headers)):?><?=$page_headers?><?endif?>
	</head>
	<body>
		<?=$content?>
	</body>
</html>
