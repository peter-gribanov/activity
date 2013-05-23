<?
/**
 * @param array       $group
 * @param string|null $error
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-group-edit">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="group-edit-name">Название</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="group-edit-name"
					required="required"
					value="<?if(!empty($_POST['name'])):?><?=self::escape($_POST['name'])?><?else:?><?=self::escape($group['name'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll"></div>
			<div class="b-coll">
				<button type="submit">Редактировать</button>
			</div>
		</div>
	</form>
</div>