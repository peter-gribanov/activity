<?
/**
 * @param array   $list
 * @param boolean $is_admin
 * @param integer $start
 * @param integer $end
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<section class="b-filter">
	<form action="" method="get">
		<label for="filter-start">Начало</label>
		<input
			type="date"
			name="start"
			id="filter-start"
			required="required" 
			value="<?=date('Y-m-d', $start)?>"
		>
		<label for="filter-end">Окончание</label>
		<input
			type="date"
			name="end"
			id="filter-end"
			required="required" 
			value="<?=date('Y-m-d', $end)?>"
		>
		<button type="submit">Отфильтровать</button>
	</form>
</section>
<?if(!empty($list)):?>
	<table class="t-activity">
		<tr>
			<th>Дата</th>
			<th>Наименование мероприятия</th>
			<th>Организатор</th>
			<th>Место проведения</th>
			<th>Цена</th>
			<th>Что предлагают</th>
			<th>Чем воспользовались и представитель</th>
			<?if($is_admin):?>
				<th>Пометки</th>
			<?endif;?>
			<th>Последний комментарий</th>
			<?if($is_admin):?>
				<th><a href="<?=self::path('event_add')?>" class="bt-event-add">Добавить</a></th>
			<?endif;?>
		</tr>
		<?foreach ($list as $event):?>
			<tr>
				<td><?=self::rudateinterval($event['date_start'], $event['date_end'])?></td>
				<td><a href="<?=self::path('event_show', array('id' => $event['id']))?>"><?=self::escape($event['name'])?></a></td>
				<td><?=self::escape($event['company'])?></td>
				<td><?=self::escape($event['venue'])?></td>
				<td><?=self::escape($event['price'])?></td>
				<td><?=self::escape($event['offer'])?></td>
				<td><?=self::escape($event['used'])?></td>
				<?if($is_admin):?>
					<td><?=$event['note']?></td>
				<?endif;?>
				<td>
					<?if($event['comment']):?>
						<?=self::rudate($event['comment']['time'])?> <?=date('H:i', $event['comment']['time'])?><br>
						<?=self::escape($event['comment']['author'])?><br>
						<abbr title="Подразделение"><?=self::escape($event['comment']['group'])?></abbr>
					<?endif?>
				</td>
				<?if($is_admin):?>
					<td>
						<a href="<?=self::path('event_edit', array('id' => $event['id']))?>" class="bt-event-edit">Редактировать</a>
						<a href="<?=self::path('event_remove', array('id' => $event['id']))?>" class="bt-event-remove">Удалить</a>
					</td>
				<?endif;?>
			</tr>
		<?endforeach?>
	</table>
<?else:?>
	<div class="b-error">Нет мероприятий</div>
<?endif?>