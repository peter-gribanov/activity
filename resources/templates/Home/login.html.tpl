<?
/**
 * @param array  $user
 * @param string $error
 */
?>
<?if(!empty($user)):?>
	Добрый день <?=$user['name']?> (<a href="<?=self::path('admin')?>">Админка</a>).
<?else:?>
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<input type="text" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<button>Войти</button>
	</form>
<?endif?>