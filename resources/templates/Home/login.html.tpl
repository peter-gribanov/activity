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
			<a href="<?=self::path('logout')?>" class="bt-logout bt-icon bt-icon-link bt-icon-key">Выйти</a>
			<?if($is_admin):?>
				<a href="<?=self::path('admin')?>" class="bt-admin bt-icon bt-icon-link bt-icon-gear">Админка</a>
			<?endif?>
		</nav>
	</section>
<?else:?>
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<input type="email" name="email" required="required" placeholder="Email">
		<input type="password" name="password" required="required" placeholder="Password">
		<button>Войти</button>
	</form>
<?endif?>