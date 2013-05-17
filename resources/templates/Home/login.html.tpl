<?
/**
 * 
 */
?>
<?if(!empty($user)):?>
	Добрый день <?=$user['name']?>.
<?else:?>
	<form action="" method="post">
		<input type="text" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<button>Войти</button>
	</form>
<?endif?>