<?
/**
 * @param string $content Контент
 */
?>
<?self::extend('html.html.tpl')?>
<header>
	<a href="<?=self::path('home')?>"><h1>Мероприятия</h1></a>
	<div class="user"><?=self::execute('Home::login')?></div>
</header>
<?=$content?>