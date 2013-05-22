<?
/**
 * @param array $chenges
 * @param array $event
 * @param array $author
 * @param array $recipient
 */
?>
<?=$recipient['name']?>, <?=self::timeofday(array('доброе утро', 'добрый день' ,'добрый вечер', 'добрый вечер'))?>!<br>
<br>
В мероприятии "<a href="<?=self::url('event_show', array('id' => $event['id']))?>"><?=$event['name']?></a>" произведены изменения:<br>
<ul>
<?foreach ($chenges as $column => $value):?>
	<?switch ($column):
		case 'name':?>
			<li>Изменено название с <strong><?=$event['name']?></strong> на <strong><?=$chenges['name']?></strong></li>
		<?break;?>
		<?case 'date_start':?>
			<li>Изменена дата начала с <strong><?=self::rudate($event['date_start'])?></strong> на <strong><?=self::rudate($chenges['date_start'])?></strong></li>
		<?break;?>
		<?case 'date_end':?>
			<li>Изменена дата окончания с <strong><?=self::rudate($event['date_end'])?></strong> на <strong><?=self::rudate($chenges['date_end'])?></strong></li>
		<?break;?>
		<?case 'company':?>
			<li>Изменено название организатора с <strong><?=$event['company']?></strong> на <strong><?=$chenges['company']?></strong></li>
		<?break;?>
		<?case 'venue':?>
			<li>Изменено место проведения с <strong><?=$event['venue']?></strong> на <strong><?=$chenges['venue']?></strong></li>
		<?break;?>
		<?case 'price':?>
			<li>Изменена цена с <strong><?=$event['price']?></strong> на <strong><?=$chenges['price']?></strong></li>
		<?break;?>
		<?case 'offer':?>
			<li>Изменено что предлагается с <strong><?=$event['offer']?></strong> на <strong><?=$chenges['offer']?></strong></li>
		<?break;?>
		<?case 'used':?>
			<li>Изменено чем воспользовались и(или) изменен представитель с <strong><?=$event['used']?></strong> на <strong><?=$chenges['used']?></strong></li>
		<?break;?>
	<?endswitch?>
<?endforeach?>
</ul>
<br>
С уважением,<br>
<?=$author['name']?>