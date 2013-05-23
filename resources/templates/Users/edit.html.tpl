<?
/**
 * @param array       $groups
 * @param array       $users
 * @param string|null $error
 */
use Framework\Model\Users;
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-user-edit">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-name">ФИО</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="user-edit-name"
					required="required"
					value="<?if(!empty($_POST['name'])):?><?=self::escape($_POST['name'])?><?else:?><?=self::escape($user['name'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-email">Email</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="email"
					id="user-edit-email"
					required="required"
					value="<?if(!empty($_POST['email'])):?><?=self::escape($_POST['email'])?><?else:?><?=self::escape($user['email'])?><?endif?>"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-group">Подразделение</label>
			</div>
			<div class="b-coll">
				<select name="group">
					<?foreach ($groups as $group):?>
						<option
							value="<?=$group['id']?>"
							<?if((!empty($_POST['group']) && $_POST['group'] == $group['id']) ||
								(empty($_POST['group']) && $user['group_id'] == $group['id'])
							):?>
								selected="selected"
							<?endif?>
						><?=$group['name']?></option>
					<?endforeach?>
				</select>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-role">Роль</label>
			</div>
			<div class="b-coll">
				<select name="role">
					<option
						value="<?=Users::ROLE_USER?>"
						<?if((!empty($_POST['role']) && $_POST['role'] == Users::ROLE_USER) ||
							(empty($_POST['role']) && $user['role'] == Users::ROLE_USER)
						):?>
							selected="selected"
						<?endif?>
					>Пользователь</option>
					<option
						value="<?=Users::ROLE_ADMIN?>"
						<?if((!empty($_POST['role']) && $_POST['role'] == Users::ROLE_ADMIN) ||
							(empty($_POST['role']) && $user['role'] == Users::ROLE_ADMIN)
						):?>
							selected="selected"
						<?endif?>
					>Администратор</option>
				</select>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-password">Пароль</label>
			</div>
			<div class="b-coll">
				<input
					type="password"
					name="password"
					id="user-edit-password"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-edit-password-confirm">Подтверждение пароля</label>
			</div>
			<div class="b-coll">
				<input
					type="password"
					name="password-confirm"
					id="user-edit-password-confirm"
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