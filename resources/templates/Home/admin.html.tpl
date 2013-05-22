<?
/**
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<nav>
	<a href="<?=self::path('statistics')?>">Статистика</a>
	<a href="<?=self::path('users_list')?>">Список пользователей</a>
	<a href="<?=self::path('users_add')?>">Добавить пользователя</a>
	<a href="<?=self::path('groups_list')?>">Список групп</a>
	<a href="<?=self::path('groups_add')?>">Добавить группу</a>
</nav>