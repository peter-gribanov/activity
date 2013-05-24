<?
/**
 * @param array       $groups
 * @param string|null $error
 */
use Framework\Model\Users;
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-user-add">
	<?if(!empty($error)):?>
		<div class="b-error"><?=$error?></div>
	<?endif?>
	<form action="" method="post">
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-name">ФИО</label>
			</div>
			<div class="b-coll">
				<input
					type="text"
					name="name"
					id="user-add-name"
					required="required"
					<?if(!empty($_POST['name'])):?>value="<?=self::escape($_POST['name'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-email">Email</label>
			</div>
			<div class="b-coll">
				<input
					type="email"
					name="email"
					id="user-add-email"
					required="required"
					<?if(!empty($_POST['email'])):?>value="<?=self::escape($_POST['email'])?>"<?endif?>
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-group">Подразделение</label>
			</div>
			<div class="b-coll">
				<select name="group" id="user-add-group">
					<?foreach ($groups as $group):?>
						<option
							value="<?=$group['id']?>"
							<?if(!empty($_POST['group']) && $_POST['group'] == $group['id']):?>
								selected="selected"
							<?endif?>
						><?=$group['name']?></option>
					<?endforeach?>
				</select>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-role">Роль</label>
			</div>
			<div class="b-coll">
				<select name="role" id="user-add-role">
					<option
						value="<?=Users::ROLE_USER?>"
						<?if(!empty($_POST['role']) && $_POST['role'] == Users::ROLE_USER):?>
							selected="selected"
						<?endif?>
					>Пользователь</option>
					<option
						value="<?=Users::ROLE_ADMIN?>"
						<?if(!empty($_POST['role']) && $_POST['role'] == Users::ROLE_ADMIN):?>
							selected="selected"
						<?endif?>
					>Администратор</option>
				</select>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-password">Пароль</label>
			</div>
			<div class="b-coll">
				<input
					type="password"
					name="password"
					id="user-add-password"
					required="required"
				>
			</div>
		</div>
		<div class="b-row">
			<div class="b-coll">
				<label for="user-add-password-confirm">Подтверждение пароля</label>
			</div>
			<div class="b-coll">
				<input
					type="password"
					name="password-confirm"
					id="user-add-password-confirm"
					required="required"
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