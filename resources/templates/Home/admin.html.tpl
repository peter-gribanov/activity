<?
/**
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<nav>
	<ul>
		<li><a href="<?=self::path('statistics')?>">Статистика</a></li>
		<li><a href="<?=self::path('users_list')?>">Список пользователей</a></li>
		<li><a href="<?=self::path('users_add')?>">Добавить пользователя</a></li>
		<li><a href="<?=self::path('groups_list')?>">Список групп</a></li>
		<li><a href="<?=self::path('groups_add')?>">Добавить группу</a></li>
		<li><a href="<?=self::path('event_add')?>">Добавить мероприятие</a></li>
	</ul>
</nav>