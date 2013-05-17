<?
/**
 * @param string $content Контент
 */
?>
<?self::extend('html.html.tpl')?>
<header>
	<h1>Мероприятия</h1>
	<div class="user"><?=self::execute('Home::login')?></div>
</header>
<?=$content?>