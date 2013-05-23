<?
/**
 * @param array $user
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-event-remove">
	<form action="" method="post">
		Вы уверены что хотите удалить пользователя <strong><?=self::escape($user['name'])?></strong>?<br>
		<button type="submit" name="remove" value="no">Нет</button> или <button type="submit" name="remove" value="yes">Да</button>
	</form>
</div>