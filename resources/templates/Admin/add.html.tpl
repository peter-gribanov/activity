<?
/**
 * @param string|null $error
 */
?>
<?self::extend('layouts/default.html.tpl')?>

<?self::block('page_headers')?>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
		selector: '#event-add-note',
		language_url: '/tinymce_languages_ru.js',
		plugins: [
			"advlist autolink lists link",
			"searchreplace",
			"contextmenu paste"
		],
		toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
	});
	tinymce.init({
		selector: '#event-add-program',
		language_url: '/tinymce_languages_ru.js',
		plugins: [
			"advlist autolink link",
			"searchreplace",
			"table contextmenu paste"
		],
		toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
	});
	</script>
<?self::endblock()?>

<div class="b-event-add">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-name">Название</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="event-add-name"
					required="required"
					<?if(!empty($_POST['name'])):?> value="<?=self::escape($_POST['name'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-date_start">Дана начала</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_start"
					id="event-add-date_start"
					required="required"
					min="<?=date('Y-m-d')?>"
					value="<?if(!empty($_POST['date_start'])):?><?=self::escape($_POST['date_start'])?><?else:?><?=date('Y-m-d')?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-date_end">Дата окончания</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_end"
					id="event-add-date_end"
					min="<?=date('Y-m-d')?>"
					required="required"
					value="<?if(!empty($_POST['date_end'])):?><?=self::escape($_POST['date_end'])?><?else:?><?=date('Y-m-d')?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-company">Организатор</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="company"
					id="event-add-company"
					required="required"
					<?if(!empty($_POST['company'])):?> value="<?=self::escape($_POST['company'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-venue">Место проведения</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="venue"
					id="event-add-venue"
					required="required"
					<?if(!empty($_POST['venue'])):?> value="<?=self::escape($_POST['venue'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-price">Цена</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="price"
					id="event-add-price"
					<?if(!empty($_POST['price'])):?> value="<?=self::escape($_POST['price'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-offer">Что предлагают</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="offer"
					id="event-add-offer"
					<?if(!empty($_POST['offer'])):?> value="<?=self::escape($_POST['offer'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-used">Чем воспользовались и представитель</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="used"
					id="event-add-used"
					<?if(!empty($_POST['used'])):?> value="<?=self::escape($_POST['used'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-note">Пометки</label>
			</div>
			<div class="b-coll">
				<textarea
					rows="6"
					cols="40"
					name="note"
					id="event-add-note"
				><?if(!empty($_POST['note'])):?><?=self::escape($_POST['note'])?><?endif?></textarea>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-add-program">Программа</label>
			</div>
			<div class="b-coll">
				<textarea
					rows="6"
					cols="40"
					name="program"
					id="event-add-program"
				><?if(!empty($_POST['program'])):?><?=self::escape($_POST['program'])?><?endif?></textarea>
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