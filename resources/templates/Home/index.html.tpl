<?
/**
 * @param array   $list
 * @param boolean $is_admin
 */
?>
<?self::extend('layouts/default.html.tpl')?>
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
				<th><a href="<?=self::path('admin_add')?>" class="bt-action-add">Добавить</a></th>
			<?endif;?>
		</tr>
		<?foreach ($list as $action):?>
			<tr>
				<td><?=self::rudateinterval($action['date_start'], $action['date_end'])?></td>
				<td><a href="<?=self::path('home_show', array('id' => $action['id']))?>"><?=$action['name']?></a></td>
				<td><?=$action['company']?></td>
				<td><?=$action['venue']?></td>
				<td><?=$action['price']?></td>
				<td><?=$action['offer']?></td>
				<td><?=$action['used']?></td>
				<?if($is_admin):?>
					<td><?=$action['note']?></td>
				<?endif;?>
				<td>
					<?if($action['comment']):?>
						<?=self::rudate($action['comment']['time'])?> <?=date('H:i', $action['comment']['time'])?><br>
						<?=$action['comment']['author']?>
					<?endif?>
				</td>
				<?if($is_admin):?>
					<td>
						<a href="<?=self::path('admin_edit', array('id' => $action['id']))?>" class="bt-action-edit">Редактировать</a>
						<a href="<?=self::path('admin_remove', array('id' => $action['id']))?>" class="bt-action-remove">Удалить</a>
					</td>
				<?endif;?>
			</tr>
		<?endforeach?>
	</table>
<?else:?>
	<div class="b-error">Нет мероприятий</div>
<?endif?>