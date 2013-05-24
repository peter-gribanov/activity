<?
/**
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<nav>
	<ul>
		<li><a href="<?=self::path('statistics')?>" class="bt-statistics bt-icon bt-icon-link bt-icon-statistics">Статистика</a></li>
		<li><a href="<?=self::path('users_list')?>" class="bt-users-list bt-icon bt-icon-link bt-icon-user">Список пользователей</a></li>
		<li><a href="<?=self::path('users_add')?>" class="bt-users-add bt-icon bt-icon-link bt-icon-user">Добавить пользователя</a></li>
		<li><a href="<?=self::path('groups_list')?>" class="bt-groups-list bt-icon bt-icon-link bt-icon-group">Список групп</a></li>
		<li><a href="<?=self::path('groups_add')?>" class="bt-groups-add bt-icon bt-icon-link bt-icon-group">Добавить группу</a></li>
		<li><a href="<?=self::path('event_add')?>" class="bt-event-add bt-icon bt-icon-link bt-icon-calendar">Добавить мероприятие</a></li>
	</ul>
</nav>