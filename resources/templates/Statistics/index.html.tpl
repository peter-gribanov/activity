<?
/**
 * @param array $statistics
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<table>
	<tr>
		<th>Пользователь</th>
		<th>Подразделение</th>
		<th>Дата посещения</th>
		<th>Ссылка</th>
	</tr>
	<?foreach ($statistics as $visit):?>
		<tr>
			<td><?=$visit['name']?></td>
			<td><?=$visit['group']?></td>
			<td><?=self::rudate($visit['time'])?> <?=date('H:i', $visit['time'])?></td>
			<td><a href="<?=$visit['link']?>"><?=$visit['link']?></a></td>
		</tr>
	<?endforeach?>
</table>