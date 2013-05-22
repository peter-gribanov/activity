<?
/**
 * @param array   $event
 * @param booelan $is_admin
 * @param booelan $is_login
 * @param array   $comments
 */
?>
<?self::extend('layouts/default.html.tpl')?>
<div class="b-event-card">
<h2><?=self::escape($event['name'])?></h2>
<p><strong>Дата</strong> <?=self::rudateinterval($event['date_start'], $event['date_end'])?></p>
<p><strong>Организатор</strong> <?=self::escape($event['company'])?></p>
<?if($event['price']):?>
	<p><strong>Цена</strong> <?=self::escape($event['price'])?>
<?endif?>
<p><strong>Место проведения</strong> <?=self::escape($event['venue'])?></p>
<?if($event['offer']):?>
	<p><strong>Что предлагают</strong> <?=self::escape($event['offer'])?></p>
<?endif?>
<?if($event['used']):?>
	<p><strong>Чем воспользовались и представитель</strong> <?=self::escape($event['used'])?></p>
<?endif?>
<?if($is_admin && $event['note']):?>
	<p><strong>Пометки</strong></p>
	<div><?=$event['note']?></div>
<?endif?>
<?if($event['program']):?>
	<p><strong>Программа</strong></p>
	<div><?=$event['program']?></div>
<?endif?>
</div>
<a href="<?=self::path('home')?>" class="bt-go-home">Назад, к списку мероприятий</a>
<?if($comments):?>
<div class="b-comments">
	<?foreach($comments as $comment):?>
		<section>
			<header><?=self::rudate($comment['time'])?> <?=date('H:i', $comment['time'])?> <?=self::escape($comment['name'])?> (<?=self::escape($comment['department'])?>)</header>
			<article><?=self::escape($comment['comment'])?></article>
		</section>
	<?endforeach?>
</div>
<?else:?>
Нет комментариев<br>
<?endif?>
<?if($is_login):?>
	<div class="b-add-comment">
		<form event="" method="post">
			<textarea rows="5" cols="60" name="comment"></textarea><br />
			<button type="submit">Отправить</button>
		</form>
	</div>
<?else:?>
	Вам необходимо авторизоваться для того чтобы добавить комментарий<br>
<?endif;?>