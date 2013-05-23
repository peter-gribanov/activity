<?
/**
 * @param array $groups
 * @param array $current_user
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<table>
	<tr>
		<th>Группа</th>
		<th><a href="<?=self::path('groups_add')?>" class="bt-group-add">Добавить</a></th>
	</tr>
	<?foreach ($groups as $group):?>
		<tr>
			<td><?=$group['name']?></td>
			<td>
				<a href="<?=self::path('groups_edit', array('id' => $group['id']))?>" class="bt-group-edit">Редактировать</a>
				<?if($group['id'] != $current_user['group_id']):?>
					<a href="<?=self::path('groups_remove', array('id' => $group['id']))?>" class="bt-group-remove">Удалить</a>
				<?endif?>
			</td>
		</tr>
	<?endforeach;?>
</table>