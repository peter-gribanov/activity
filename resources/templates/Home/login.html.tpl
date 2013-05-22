<?
/**
 * @param array   $user
 * @param string  $error
 * @param boolean $is_admin
 */
?>
<?if(!empty($user)):?>
	<section>
		<header>Добрый день <?=self::escape($user['name'])?></header>
		<nav>
			<a href="<?=self::path('home_logout')?>" class="bt-logout">Выйти</a>
			<?if($is_admin):?>
				<a href="<?=self::path('admin')?>" class="bt-admin">Админка</a>
			<?endif?>
		</nav>
	</section>
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