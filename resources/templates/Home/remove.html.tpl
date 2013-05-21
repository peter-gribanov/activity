<?
/**
 * @param array $action
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-action-remove">
	<form action="" method="post">
		Вы уверены что хотите удалить мероприятие <a href="<?=self::path('home_show', array('id' => $action['id']))?>"><?=$action['name']?></a>?<br>
		<button type="submit" name="remove" value="no">Нет</button> или <button type="submit" name="remove" value="yes">Да</button>
	</form>
</div>