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
		<th class="tb-controls"><a href="<?=self::path('groups_add')?>" class="bt-group-add bt-icon bt-icon-add" title="Добавить">Добавить</a></th>
	</tr>
	<?foreach ($groups as $group):?>
		<tr>
			<td><?=$group['name']?></td>
			<td class="tb-controls">
				<a href="<?=self::path('groups_edit', array('id' => $group['id']))?>" class="bt-group-edit bt-icon bt-icon-edit" title="Редактировать">Редактировать</a>
				<?if($group['id'] != $current_user['group_id']):?>
					<a href="<?=self::path('groups_remove', array('id' => $group['id']))?>" class="bt-group-remove bt-icon bt-icon-remove" title="Удалить">Удалить</a>
				<?endif?>
			</td>
		</tr>
	<?endforeach;?>
</table>