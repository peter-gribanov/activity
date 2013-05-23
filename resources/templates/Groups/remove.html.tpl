<?
/**
 * @param array $group
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-event-remove">
	<form action="" method="post">
		Вы уверены что хотите удалить группу <strong><?=self::escape($group['name'])?></strong>?<br>
		<button type="submit" name="remove" value="no">Нет</button> или <button type="submit" name="remove" value="yes">Да</button>
	</form>
</div>