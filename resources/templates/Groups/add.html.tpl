<?
/**
 * @param array       $groups
 * @param string|null $error
 */
use Framework\Model\Users;
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-group-add">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="group-add-name">Название</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="group-add-name"
					required="required"
					<?if(!empty($_POST['name'])):?> value="<?=self::escape($_POST['name'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll"></div>
			<div class="b-coll">
				<button type="submit">Создать</button>
			</div>
		</div>
	</form>
</div>