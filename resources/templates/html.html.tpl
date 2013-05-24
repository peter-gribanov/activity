<?
/**
 * @param string $content
 * @param string|null $page_title
 * @param string|null $page_headers
 */
?>
<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title><?if(!empty($page_title)):?><?=$page_title?> &mdash; <?endif;?>Мероприятия</title>
		<link rel="stylesheet" href="/main.css">
		<?if(!empty($page_headers)):?><?=$page_headers?><?endif?>
	</head>
	<body>
		<img src="<?=self::path('zeropixel')?>" alt="" id="zeropixel">
		<?=$content?>
	</body>
</html>