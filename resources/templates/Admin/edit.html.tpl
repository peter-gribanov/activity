<?
/**
 * @param string|null $error
 * @param array       $event
 */
?>
<?self::extend('layouts/default.html.tpl')?>

<?self::block('page_headers')?>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
		selector: '#event-edit-note',
		language_url: '/tinymce_languages_ru.js',
		plugins: [
			"advlist autolink lists link",
			"searchreplace",
			"contextmenu paste"
		],
		toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
	});
	tinymce.init({
		selector: '#event-edit-program',
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

<div class="b-event-edit">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-name">Название</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="event-edit-name"
					required="required" 
					value="<?if(empty($_POST['name'])):?><?=self::escape($event['name'])?><?else:?><?=self::escape($_POST['name'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-date_start">Дана начала</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_start"
					id="event-edit-date_start"
					required="required"
					value="<?if(empty($_POST['date_start'])):?><?=date('Y-m-d', $event['date_start'])?><?else:?><?=self::escape($_POST['date_start'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-date_end">Дата окончания</label>
			</div>
			<div class="b-coll">
				<input
					type="date"
					name="date_end"
					id="event-edit-date_end"
					required="required"
					value="<?if(empty($_POST['date_end'])):?><?=date('Y-m-d', $event['date_end'])?><?else:?><?=self::escape($_POST['date_end'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-company">Организатор</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="company"
					id="event-edit-company"
					required="required"
					value="<?if(empty($_POST['company'])):?><?=self::escape($event['company'])?><?else:?><?=self::escape($_POST['company'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-venue">Место проведения</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="venue"
					id="event-edit-venue"
					required="required"
					value="<?if(empty($_POST['venue'])):?><?=self::escape($event['venue'])?><?else:?><?=self::escape($_POST['venue'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-price">Цена</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="price"
					id="event-edit-price"
					value="<?if(!isset($_POST['price'])):?><?=self::escape($event['price'])?><?else:?><?=self::escape($_POST['price'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-offer">Что предлагают</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="offer"
					id="event-edit-offer"
					value="<?if(!isset($_POST['offer'])):?><?=self::escape($event['offer'])?><?else:?><?=self::escape($_POST['offer'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-used">Чем воспользовались и представитель</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="used"
					id="event-edit-used"
					value="<?if(!isset($_POST['used'])):?><?=self::escape($event['used'])?><?else:?><?=self::escape($_POST['used'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-note">Пометки</label>
			</div>
			<div class="b-coll">
				<textarea
					rows="6"
					cols="40"
					name="note"
					id="event-edit-note"
				><?if(!isset($_POST['note'])):?><?=self::escape($event['note'])?><?else:?><?=self::escape($_POST['note'])?><?endif?></textarea>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="event-edit-program">Программа</label>
			</div>
			<div class="b-coll">
				<textarea
					name="program"
					id="event-edit-program"
				><?if(!isset($_POST['program'])):?><?=self::escape($event['program'])?><?else:?><?=self::escape($_POST['program'])?><?endif?></textarea>
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