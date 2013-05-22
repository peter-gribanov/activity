<?
/**
 * @param string|null $error
 * @param array       $action
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
					value="<?if(empty($_POST['name'])):?><?=$action['name']?><?else:?><?=$_POST['name']?><?endif?>"
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
					value="<?if(empty($_POST['date_start'])):?><?=date('Y-m-d', $action['date_start'])?><?else:?><?=$_POST['date_start']?><?endif?>"
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
					required="required"
					value="<?if(empty($_POST['date_end'])):?><?=date('Y-m-d', $action['date_end'])?><?else:?><?=$_POST['date_end']?><?endif?>"
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
					value="<?if(empty($_POST['company'])):?><?=$action['company']?><?else:?><?=$_POST['company']?><?endif?>"
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
					value="<?if(empty($_POST['venue'])):?><?=$action['venue']?><?else:?><?=$_POST['venue']?><?endif?>"
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
					value="<?if(!isset($_POST['price'])):?><?=$action['price']?><?else:?><?=$_POST['price']?><?endif?>"
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
					value="<?if(!isset($_POST['offer'])):?><?=$action['offer']?><?else:?><?=$_POST['offer']?><?endif?>"
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
					value="<?if(!isset($_POST['used'])):?><?=$action['used']?><?else:?><?=$_POST['used']?><?endif?>"
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
					value="<?if(!isset($_POST['note'])):?><?=$action['note']?><?else:?><?=$_POST['note']?><?endif?>"
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