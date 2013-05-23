<?
/**
 * @param array   $users
 * @param integer $current_user_id
 */
use Framework\Model\Users;
?>
<?self::extend('layouts/default.html.tpl')?>
<table>
	<tr>
		<th>ФИО</th>
		<th>Email</th>
		<th>Подразделение</th>
		<th>Роль</th>
		<th><a href="<?=self::path('users_add')?>" class="bt-user-add">Добавить</a></th>
	</tr>
	<?foreach ($users as $user):?>
		<tr>
			<td><?=$user['name']?></td>
			<td><?=$user['email']?></td>
			<td><?=$user['group']?></td>
			<td><?if($user['role'] == Users::ROLE_ADMIN):?>Администратор<?else:?>Пользователь<?endif?></td>
			<td>
				<a href="<?=self::path('users_edit', array('id' => $user['id']))?>" class="bt-user-edit">Редактировать</a>
				<?if($user['id'] != $current_user_id):?>
					<a href="<?=self::path('users_remove', array('id' => $user['id']))?>" class="bt-user-remove">Удалить</a>
				<?endif?>
			</td>
		</tr>
	<?endforeach;?>
</table>