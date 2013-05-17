<?
/**
 * @param string $content Контент
 */
?>
<?self::extend('html.html.tpl')?>
<header>
	<h1>Мероприятия</h1>
	<div class="user">
	<?if(!empty($user)):?>
		Добрый день <?=$user['name']?>.
	<?else:?>
		<form action="" method="post">
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<button>Войти</button>
		</form>
	<?endif?>
	</div>
</header>
<?=$content?>