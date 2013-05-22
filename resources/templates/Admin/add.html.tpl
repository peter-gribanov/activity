<?
/**
 * @param string|null $error
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-action-add">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-name">Название</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="action-add-name"
					required="required"
					<?if(!empty($_POST['name'])):?> value="<?=$_POST['name']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-date_start">Дана начала</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_start"
					id="action-add-date_start"
					required="required"
					min="<?=date('Y-m-d')?>"
					value="<?if(!empty($_POST['date_start'])):?><?=$_POST['date_start']?><?else:?><?=date('Y-m-d')?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-date_end">Дата окончания</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_end"
					id="action-add-date_end"
					min="<?=date('Y-m-d')?>"
					required="required"
					value="<?if(!empty($_POST['date_end'])):?><?=$_POST['date_end']?><?else:?><?=date('Y-m-d')?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-company">Организатор</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="company"
					id="action-add-company"
					required="required"
					<?if(!empty($_POST['company'])):?> value="<?=$_POST['company']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-venue">Место проведения</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="venue"
					id="action-add-venue"
					required="required"
					<?if(!empty($_POST['venue'])):?> value="<?=$_POST['venue']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-price">Цена</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="price"
					id="action-add-price"
					<?if(!empty($_POST['price'])):?> value="<?=$_POST['price']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-offer">Что предлагают</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="offer"
					id="action-add-offer"
					<?if(!empty($_POST['offer'])):?> value="<?=$_POST['offer']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-used">Чем воспользовались и представитель</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="used"
					id="action-add-used"
					<?if(!empty($_POST['used'])):?> value="<?=$_POST['used']?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="action-add-note">Пометки</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="note"
					id="action-add-note"
					<?if(!empty($_POST['note'])):?> value="<?=$_POST['note']?>"<?endif?>
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